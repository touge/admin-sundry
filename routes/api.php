<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2019-12-18
 * Time: 17:00
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

/**
 * 批改试卷
 */
Route::group([
    'prefix'=> 'touge-sundry',
], function(Router $router){
    /**
     * 用户时间统计
     */
    $router->post('learn-duration/heartbeat', 'LearnDurationController@heartbeat')->name('heartbeat');

    /**
     * 签到系统
     */
    $router->post("calendar/sign-list" ,"CalendarController@sign_list")->name('calendar.sign_list');
    $router->post("calendar/sign-in" ,"CalendarController@sign_in")->name('calendar.store');

});
