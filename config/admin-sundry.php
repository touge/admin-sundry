<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2020-02-28
 * Time: 11:41
 */
return [
    //插件中使用的用户信息关联表
    'user_relate'=> [
        'model'=> App\Models\Customer\SchoolMember::class,
        'key'=> 'id'
    ],
];