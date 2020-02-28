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
     * 获得考试列表
     */
    $router->post('learn-duration/heartbeat', 'LearnDurationController@heartbeat')->name('heartbeat');
});
