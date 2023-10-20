<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Services\ResponseService;
use App\Services\SearchService;
use Illuminate\Http\Request;
use App\Models\Search;
use Illuminate\Support\Facades\Log;
use Exception;

class SearchController extends Controller
{
    public function __construct(
        protected SearchService $searchService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            return ResponseService::success([
                'searches' => $this->searchService->index($request),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return ResponseService::error('Error.', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response | \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector | \Illuminate\Http\JsonResponse
     */
    public function store(SearchRequest $request)
    {
        try {
            $search = $this->searchService->create($request->all());

            return ResponseService::success([
                'search' => $this->searchService->show($search),
            ]);
        } catch (Exception $e) {
            return ResponseService::error(
                'An error occurred while creating the search.',
                500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Search  $search
     *
     * @return \Illuminate\Http\Response | \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector | \Illuminate\Http\JsonResponse
     */
    public function show(Search $search)
    {
        try {
            return ResponseService::success([
                'search' => $this->searchService->show($search),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return ResponseService::error(
                'An error occurred while retrieving the search.',
                500
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Search  $search
     *
     * @return \Illuminate\Http\Response | \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector | \Illuminate\Http\JsonResponse
     */
    public function update(SearchRequest $request, Search $search)
    {
        try {
            return ResponseService::success([
                'search' => $this->searchService->update(
                    $search,
                    $request->all()
                )
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return ResponseService::error(
                'An error occurred while updating the search.',
                500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Search  $search
     *
     * @return \Illuminate\Http\Response | \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector | \Illuminate\Http\JsonResponse
     */
    public function destroy(Search $search)
    {
        try {
            $this->searchService->destroy($search);

            return ResponseService::success([
                'search' => $search
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return ResponseService::error(
                'An error occurred while updating the search.',
                500
            );
        }
    }
}
