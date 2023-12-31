<?php

namespace Database\Seeders;

use App\Models\Location;
use Database\Sources\LocationSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::truncate();

        Location::insert(
            LocationSource::$countries
        );
    }
}
