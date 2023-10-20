<?php

namespace App\Services;

use App\Models\Analytics;

class AnalyticsService
{
    /**
     * Create a new analytics and store in the database.
     *
     * @param array $data
     * @return \App\Models\Search
     */
    public function create(array $data)
    {
        $analytics = Analytics::insert($data);

        return $analytics;
    }
}
