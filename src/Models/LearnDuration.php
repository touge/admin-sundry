<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2020-02-27
 * Time: 17:19
 */

namespace Touge\AdminSundry\Models;

class LearnDuration extends BaseModel
{
    use UserRelate;

    protected $table= 'touge_sundry_learn_duration';
    protected $guarded= ['id'];

}