<?php

namespace Touge\AdminSundry;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AdminSundryServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(AdminSundry $extension)
    {
        if (! AdminSundry::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'admin-sundry');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/touge/admin-sundry')],
                'touge-laravel-admin-sundry'
            );
        }

        $this->app->booted(function () {
            AdminSundry::routes(__DIR__.'/../routes/web.php');
            static::api_routes(__DIR__ . '/../routes/api.php');
        });
    }



    /**
     * Set routes for this extension.
     *
     * @param $callback
     */
    public static function api_routes($callback)
    {
        $attributes = array_merge(
            [
                'prefix'=> 'api/sundry',
                'namespace'     => '\Touge\AdminSundry\Http\Controllers\Api',
                'as'=> 'api.sundry.',
                'middleware'=> ['api', 'jwt.auth:api'],
            ],
            AdminSundry::config('route', [])
        );

        Route::group($attributes, $callback);
    }
}