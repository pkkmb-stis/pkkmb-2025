<?php

namespace App\Providers;

use App\View\Components\AdminLayout;
use App\View\Components\HomeLayout;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {}

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        require_once config_path('constants.php');

        defined('LOGO')   || define('LOGO', asset('img/logo/logo_2024.png'));
        defined('maskot1')   || define('maskot1', asset('img/maskot/kambe.png'));
        defined('maskot2')   || define('maskot2', asset('img/maskot/pika.png'));

        Blade::component('admin-layout', AdminLayout::class);
        Blade::component('home-layout', HomeLayout::class);
    }
}
