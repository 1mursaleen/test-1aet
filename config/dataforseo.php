<?php

return [

    /*
    |--------------------------------------------------------------------------
    | DataForSEO API Client Configuration
    |--------------------------------------------------------------------------
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'DATAFORSEO_LOGIN' => env('DATAFORSEO_LOGIN', 'login'),
    'DATAFORSEO_PASSWORD' => env('DATAFORSEO_PASSWORD', 'password'),
    'DATAFORSEO_TOKEN' => env('DATAFORSEO_TOKEN', 'token'),
    'timeoutForEachRequests' => env('DATAFORSEO_TIMEOUTFOREACHREQUESTS', 120),
    'apiVersion' => env('DATAFORSEO_APIVERSION', '/v3/'),
    'url' => env('DATAFORSEO_URL', 'https://api.dataforseo.com'),

    // You can set extra paths for Entities
    // For all entity we use namespace: DFSClientV3\Entity\Custom
    // Last index will have the priority
    //
    'extraEntitiesPaths' => [
        //     'your full path to extra entity',
        //     'your full path to extra entity'
    ],

];
