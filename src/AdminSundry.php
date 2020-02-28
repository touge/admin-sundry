<?php

namespace Touge\AdminSundry;

use Encore\Admin\Extension;

class AdminSundry extends Extension
{
    public $name = 'admin-sundry';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'AdminSundry',
        'path'  => 'admin-sundry',
        'icon'  => 'fa-gears',
    ];
}