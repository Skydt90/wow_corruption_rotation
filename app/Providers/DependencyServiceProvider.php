<?php

namespace App\Providers;

use App\Models\Corruption;
use App\Models\Picture;
use App\Models\Rotation;
use App\Models\Schedule;
use App\Repositories\Corruption\CorruptionRepo;
use App\Repositories\Picture\PictureRepo;
use App\Repositories\Rotation\RotationRepo;
use App\Repositories\Schedule\ScheduleRepo;
use App\Services\Corruption\CorruptionService;
use App\Services\Schedule\ScheduleService;
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
        /* Repositories */
        // Corruption
        $this->app->singleton('App\Repositories\Corruption\CorruptionRepoInterface', function() {
            return new CorruptionRepo(new Corruption());
        });
        // Picture
        $this->app->singleton('App\Repositories\Picture\PictureRepoInterface', function() {
            return new PictureRepo(new Picture());
        });
        // Rotation
        $this->app->singleton('App\Repositories\Rotation\RotationRepoInterface', function() {
            return new RotationRepo(new Rotation());
        });
        // Schedule
        $this->app->singleton('App\Repositories\Schedule\ScheduleRepoInterface', function() {
            return new ScheduleRepo(new Schedule());
        });

        /* Services */
        // Corruption
        $this->app->singleton('App\Services\Corruption\CorruptionServiceInterface', function($app) {
            return new CorruptionService(
                $app->make('App\Repositories\Corruption\CorruptionRepoInterface'),
                $app->make('App\Repositories\Picture\PictureRepoInterface'),
                $app->make('App\Repositories\Rotation\RotationRepoInterface')
            );
        });
        // Schedule
        $this->app->singleton('App\Services\Schedule\ScheduleServiceInterface', function($app) {
            return new ScheduleService(
                $app->make('App\Repositories\Schedule\ScheduleRepoInterface'),
                $app->make('App\Repositories\Rotation\RotationRepoInterface'),
                $app->make('App\Repositories\Corruption\CorruptionRepoInterface')
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
