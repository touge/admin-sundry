<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2020-02-28
 * Time: 11:41
 */
return [
    //插件中使用的用户信息关联表
    'database'=> [
        'connection'=> env('TOUGE_SUNDRY_DB_CONNECTION', 'main_system'),
    ],
    'user_relate'=> [
        'model'=> env('TOUGE_SUNDRY_USER_RELATE_MODEL', \App\Admin\Modals\AdminUser::class),
        'key'=> env('TOUGE_SUNDRY_USER_RELATE_KEY', 'id')
    ],
];
