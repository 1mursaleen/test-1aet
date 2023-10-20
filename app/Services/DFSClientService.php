<?php


namespace App\Services;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

/**
 * DataForSeo API Client Service.
 */
class DFSClientService
{
    /**
     * @var array
     */
    public $urlSegments = [
        'serpAdvanced' => ["serp", "google", "organic", "live", "advanced"],
        'serpRegular' => ["serp", "google", "organic", "live", "regular"],
    ];

    /**
     * Default paramters for dataforseo API requests.
     *
     * @var array
     */
    public $defaults = [
        "depth" => 100,
        "os" => "windows",
        "device" => "desktop",
        "language_code" => "en",
        "location_code" => 2826,
    ];

    /**
     * Initiate DataForSeo Service.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get request constructor.
     *
     * @param array $segment
     * @return \Illuminate\Http\Client\Response[]
     */
    public function get(string $url, int $repetitions = 1)
    {
        return Http::pool(function (Pool $pool) use ($url, $repetitions) {
            $requests = [];

            for ($i = 1; $i <= $repetitions; $i++)
                $requests[] = $pool
                    ->withHeader('Content-Type', 'application/json')
                    ->withBasicAuth(
                        config('dataforseo.DATAFORSEO_LOGIN'),
                        config('dataforseo.DATAFORSEO_PASSWORD')
                    )
                    ->get($url);

            return $requests;
        });
    }

    /**
     * Post request constructor.
     *
     * @param array $segment
     * @return \Illuminate\Http\Client\Response[]
     */
    public function post(string $url, array $data, int $repetitions = 1)
    {
        return Http::pool(function (Pool $pool) use ($url, $data, $repetitions) {
            $requests = [];

            for ($i = 1; $i <= $repetitions; $i++)
                $requests[] = $pool
                    ->withHeader('Content-Type', 'application/json')
                    ->withBasicAuth(
                        config('dataforseo.DATAFORSEO_LOGIN'),
                        config('dataforseo.DATAFORSEO_PASSWORD')
                    )
                    // ->retry(3, 100)
                    // ->retry(3, 100, throw: false)
                    ->post($url, $data);

            return $requests;
        });
    }

    /**
     * Build URL for dataforseo endpoints.
     *
     * @param array $segment
     * @return string
     */
    public function buildURL(array $segment)
    {
        $baseURL = config('dataforseo.url');
        $apiVersion = config('dataforseo.apiVersion');

        if (!$baseURL || !$apiVersion)
            abort(500, 'Environment variables not set.');

        return $baseURL . $apiVersion . implode('/', $segment);
    }

    /**
     * Tracks the rank of keyword.
     *
     * @param array $segment
     * @param int $location_code
     * @param string $device
     *
     * @return \Illuminate\Http\Client\Response[]
     */
    public function trackRank(
        string $keyword,
        int $repetitions = 1,
        int $location_code,
        string $device
    ) {
        // test
        // return FileService::jsonFromFile(public_path('sources/data.json'));

        $postData = [
            // "os" => $this->defaults['os'],
            "depth" => $this->defaults['depth'],
            "language_code" => $this->defaults['language_code'],

            "keyword" => $keyword,
            "device" => $device ?? $this->defaults['device'],
            "location_code" => $location_code ?? $this->defaults['location_code'],
        ];

        $responses = $this->post(
            $this->buildURL(
                $this->urlSegments['serpRegular']
            ),
            [
                $postData
            ],
            $repetitions
        );

        return $responses;
    }
}
