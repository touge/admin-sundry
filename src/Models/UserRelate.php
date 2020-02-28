<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2020-02-28
 * Time: 11:55
 */

namespace Touge\AdminSundry\Models;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * 用户关联数据
 * Trait UserRelate
 * @package Touge\AdminSundry\Models
 */
trait UserRelate
{
    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        $related_model= config('admin-sundry.user_relate.model');
        $related_key= config('admin-sundry.user_relate.key');
        return $this->hasOne($related_model ,$related_key ,'user_id');
    }
}