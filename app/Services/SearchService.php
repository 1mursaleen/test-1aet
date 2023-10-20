<?php

namespace App\Services;

use App\Models\Search;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Http\Request;

class SearchService
{

    /**
     * Default paramters for dataforseo API requests.
     *
     * @var array
     */
    public $defaults = [
        "depth" => 100,
        "os" => "windows",
        "language_code" => "en",
        "location_code" => 2826,
        "device" => "desktop",
        "repetitions" => 1,
    ];

    /**
     * Relations of the Search model.
     *
     * @var array
     */
    public $relations = [
        'location',
        'analytics',
        'user',
    ];

    /**
     * Get a list of all searches.
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $query = Search::query();

        $query->with($this->relations);

        $query->when(
            $request->keyword,
            function (Builder $q, $keyword) {
                return $q->where('keyword', 'like', '%' . $keyword . '%');
            }
        );

        $query->when(
            $request->location,
            function (Builder $q, $location) {
                return $q->whereHas('location', function ($q) use ($location) {
                    $q->where('name', $location);
                });
            }
        );

        return $query
            ->orderBy('id', 'desc')
            ->paginate();
    }

    /**
     * Create a new search and store it in the database.
     *
     * @param array $data
     * @return \App\Models\Search
     */
    public function create(array $data)
    {
        $search = Search::create(array_merge([
            'device' => $this->defaults['device'],
            'repetitions' => $this->defaults['repetitions'],
            'os' => $this->defaults['os'],
            'depth' => $this->defaults['depth'],
            'language_code' => $this->defaults['language_code'],
            'location_code' => $this->defaults['location_code'],
            // 'api' =>
            // 'function' =>
            // 'se' =>
            // 'se_type' =>
        ], $data));

        return $search;
    }

    /**
     * Retrieve a specific search by its ID.
     *
     * @param \App\Models\Search $search
     * @return \App\Models\Search
     */
    public function show(Search $search)
    {
        return $search->load($this->relations);
    }

    /**
     * Update an existing search with new data.
     *
     * @param \App\Models\Search $search
     * @param array $data
     * @return \App\Models\Search
     */
    public function update(Search $search, array $data)
    {
        $search->update($data);

        return $search->load($this->relations);
    }

    /**
     * Delete a search from the database.
     *
     * @param \App\Models\Search $search
     * @return void
     */
    public function destroy(Search $search)
    {
        $search->delete();
    }
}
