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
        'connection'=> 'main_system',
    ],
    'user_relate'=> [
        'model'=> \App\Admin\Modals\AdminUser::class,//App\Models\Customer\SchoolMember::class,
        'key'=> 'id'
    ],
];