<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
Route::group([
    'prefix'        => 'touge-sundry',
    'namespace'     => '\Touge\AdminSundry\Http\Controllers\Admin',
    'middleware'    => config('admin.route.middleware'),
    'as'=> 'sundry.'
],function(Router $router){
    $router->resource('learn-durations', "LearnDurationController");
});