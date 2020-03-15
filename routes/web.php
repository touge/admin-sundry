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
    $router->resource('calendar', "CalendarController");


    //院校客户登录日志
    $router->get('login' ,'CustomerMemberLogin@index')->name('member.login.index');

    //院校客户活动日志
    $router->get('record' ,'CustomerMemberRecord@index')->name('member.record.index');

});