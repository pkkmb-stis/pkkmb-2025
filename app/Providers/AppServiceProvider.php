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

        defined('LOGO')   || define('LOGO', asset('img/logo/logo_2025.png'));
        defined('maskot0')   || define('maskot0', asset('img/maskot/2025/maskot 0.png'));
        defined('maskot0b')   || define('maskot0b', asset('img/maskot/2025/maskot 0b.png'));
        defined('maskot1')   || define('maskot1', asset('img/maskot/2025/maskot 1.png'));
        defined('maskot2')   || define('maskot2', asset('img/maskot/2025/maskot 2.png'));
        defined('maskot3')   || define('maskot3', asset('img/maskot/2025/maskot 3.png'));
        defined('maskot4')   || define('maskot4', asset('img/maskot/2025/maskot 4.png'));
        defined('maskot5')   || define('maskot5', asset('img/maskot/2025/maskot 5.png'));
        defined('maskot6')   || define('maskot6', asset('img/maskot/2025/maskot 6.png'));

        

        Blade::component('admin-layout', AdminLayout::class);
        Blade::component('home-layout', HomeLayout::class);
    }
}
