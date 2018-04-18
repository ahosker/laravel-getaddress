<?php
namespace Szhorvath\Getaddress;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Szhorvath\Getaddress\Getaddress;

class GetaddressServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        // use this if your package needs a config file
        $this->publishes([
                __DIR__.'/config/getaddress.php' => config_path('getaddress.php'),
        ]);

        // use the vendor configuration file as fallback
        // $this->mergeConfigFrom(
        //     __DIR__.'/config/config.php', 'skeleton'
        // );
    }
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerGetaddress();

        // use this if your package has a config file
        config([
                'config/getaddress.php',
        ]);
    }
    private function registerGetaddress()
    {
        $this->app->singleton('getaddress', function ($app) {
            return new Getaddress(config('getaddress.api_key'));
        });

        $this->app->alias('getaddress', Getaddress::class);
    }
}
