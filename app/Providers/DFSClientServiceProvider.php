<?php

namespace App\Providers;

use App\Services\DFSClientService;
use Illuminate\Support\ServiceProvider;

class DFSClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(DFSClientService::class, function ($app) {
            return new DFSClientService();
        });
    }
}
