<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Services\ResponseService;
use Exception;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            return ResponseService::success([
                'locations' => Location::all(),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return ResponseService::error('Error.', 500);
        }
    }
}
