<?php

namespace HappyFeet\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('HappyFeet\RepositoryInterface\RepresentantRepositoryInterface','HappyFeet\Repository\RepresentantRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\RegisterStudentFrontendRepositoryInterface','HappyFeet\Repository\RegisterStudentFrontendRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\ModuleRepositoryInterface','HappyFeet\Repository\ModuleRepository');
    }
}
