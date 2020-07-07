<?php

namespace App\Providers;

use App\Models\Corruption;
use App\Repositories\Base\Corruption\CorruptionRepo;
use App\Services\Base\Corruption\CorruptionService;
use Illuminate\Support\ServiceProvider;

class DependencyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Repositories //
        // Corruption
        $this->app->singleton('App\Repositories\Base\Corruption\CorruptionRepoInterface', function() {
            return new CorruptionRepo(new Corruption());
        });

        // Services //
        // Whales
        $this->app->singleton('App\Services\Base\Corruption\CorruptionServiceInterface', function($app) {
            return new CorruptionService(
                $app->make('App\Repositories\Base\Corruption\CorruptionRepoInterface'),
            );
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
