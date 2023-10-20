<?php

use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => ['web']], function () {
// });

Route::get('/{any}', function () {
    return view('vue');
})->where('any', '.*');
