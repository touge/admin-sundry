<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2020-02-27
 * Time: 12:18
 */

namespace Touge\AdminSundry\Models;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table= 'touge_sundry_calendars';

    protected $guarded= ['id'];

    /**
     * 追加到模型数组表单的访问器
     *
     * @var array
     */
    protected $appends = ['calendar_date'];


    /**
     * 签到时间
     * @return false|string
     *
     * //getHadNotLoginDaysAttribute
     */
    public function getCalendarDateAttribute()
    {
        $create= $this->attributes['created_at'];
        return date('Y-m-d', strtotime($create));
    }

    /**
     * 签到时间
     * @return false|string
     *
     * //getHadNotLoginDaysAttribute
     */
    public function setCalendarDateAttribute($value)
    {
        $create= $this->attributes['created_at'];
        return date('Y-m-d', strtotime($create));
    }

}