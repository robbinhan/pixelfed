<?php

namespace App\Providers;

use Storage;
use App\Util\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use App\Adapter\SwarmAdapter;
use App\Util\Filesystem\FilesystemManager;

class SwarmServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('swarm', function ($app, $config) {

            $client = new \GuzzleHttp\Client(['base_uri' => $config['gateway']]);

            return new Filesystem(new SwarmAdapter($client, $config));
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('filesystem', function () {
            return new FilesystemManager($this->app);
        });
    }
}
