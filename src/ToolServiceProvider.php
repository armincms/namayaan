<?php

namespace Armincms\Namayaan;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova; 
use Armincms\Bios\Bios;
use Armincms\Snail\Snail as NovaSnail;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::resources([
                Namayaan::class
            ]);
        });

        NovaSnail::serving(function () {
            NovaSnail::resources([
                Snail\Company::class,
                Snail\Genre::class,
                Snail\Movie::class,
                Snail\Series::class,
                Snail\Episode::class,
            ]);
        });

        \Config::set('snail.path', 'api');
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['auth:api'])
                ->prefix('api/namayaan')
                ->namespace(__NAMESPACE__.'\\Http\\Controllers')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
