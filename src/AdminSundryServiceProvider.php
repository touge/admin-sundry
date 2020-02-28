<?php

namespace Touge\AdminSundry;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AdminSundryServiceProvider extends ServiceProvider
{
    protected $config_file= 'admin-sundry.php';

    /**
     * {@inheritdoc}
     */
    public function boot(AdminSundry $extension)
    {
        if (! AdminSundry::boot()) {
            return ;
        }

        if( !file_exists(config_path($this->config_file))){
            $this->loadConfig();
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'admin-sundry');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'touge-admin-sundry-config');
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
                'prefix'=> 'api',
                'namespace'     => '\Touge\AdminSundry\Http\Controllers\Api',
                'as'=> 'api.sundry.',
                'middleware'=> ['api', 'jwt.auth:api'],
            ],
            AdminSundry::config('route', [])
        );

        Route::group($attributes, $callback);
    }


    protected function loadConfig(){
        $key = substr($this->config_file, 0, -4);
        $full_path= __DIR__ . '/../config/' . $this->config_file;
        $this->app['config']->set($key, array_merge_recursive(config($key, []), require $full_path));
    }
}