<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2019-12-12
 * Time: 18:12
 */

namespace Touge\AdminSundry\Models;


use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{
    use DefaultDatetimeFormat;

    public function __construct(array $attributes = [])
    {
        $connection= config('admin-sundry.database.connection');
        $this->setConnection($connection);
        parent::__construct($attributes);
    }
}