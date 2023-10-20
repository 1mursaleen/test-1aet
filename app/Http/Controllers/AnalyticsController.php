<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackRankRequest;
use App\Services\AnalyticsService;
use App\Services\DFSClientService;
use Illuminate\Http\Request;
use App\Services\SearchService;
use Exception;
use App\Services\ResponseService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;

class AnalyticsController extends Controller
{
    public function __construct(
        protected DFSClientService $DFSClientService,
        protected SearchService $searchService,
        protected AnalyticsService $analyticsService
    ) {
    }

    /**
     * Tracks Ranks based on keyword, creates search record,
     * fetches ranks from SERP API,
     * creates rank analytics records,
     *
     * @param $request TrackRankRequest
     *
     * @return \Illuminate\Http\Response | \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector | \Illuminate\Http\JsonResponse
     */
    public function trackRank(TrackRankRequest $request)
    {
        $search = null;

        try {
            DB::beginTransaction();

            $search = $this->searchService->create(
                array_merge($request->validated(), [
                    'user_id' => $request->user()->id,
                ])
            );

            $responses = $this->DFSClientService->trackRank(
                $search->keyword,
                $search->repetitions,
                $search->location_code,
                $search->device
            );

            foreach ($responses as $repetition => $response) {

                // if ($response instanceof ConnectionException) continue;

                if (!($response instanceof Response)) continue;
                elseif (!$response->successful()) continue;

                $items = $response->json()['tasks'][0]['result'][0]['items'] ?? null;
                $now = now();

                if (!$items) continue;

                $analytics = [];

                foreach ($items as $item) {
                    $analytics[] = [
                        'repetition' => $repetition + 1,
                        'search_id' => $search->id,
                        'rank_group' => $item['rank_group'],
                        'rank_absolute' => $item['rank_absolute'],
                        'type' => $item['type'],
                        'domain' => $item['domain'],
                        'title' => $item['title'],
                        'description' => $item['description'],
                        'url' => $item['url'],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                $this->analyticsService->create($analytics);
            }

            DB::commit();

            return ResponseService::success(['search' => $search]);
        } catch (Exception $e) {

            DB::rollBack();

            // throw $e;

            Log::error($e->getMessage());

            return ResponseService::error(
                'An error occurred while creating the search.',
                500
            );
        }
    }
}
