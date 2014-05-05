<?php

namespace Larapress\Larapress;

use Illuminate\Support\ServiceProvider;
use samjoyce\slugger\Slugger;

class AdminServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('larapress/larapress');

        include __DIR__ . '/../../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('Slugger', function() {
            return new Slugger(\DB::connection()->getPdo());
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array();
    }

}
