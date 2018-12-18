<?php

namespace HappyFeet\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Events\Dispatcher;
use TCG\Voyager\Facades\Voyager;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //User
        // $this->app->bind('HappyFeet\RepositoryInterface\UserRepositoryInterface','HappyFeet\Repository\UserRepository');
        //Module
        $this->app->bind('HappyFeet\RepositoryInterface\ModuleRepositoryInterface','HappyFeet\Repository\ModuleRepository');
        //Type Permission
        $this->app->bind('HappyFeet\RepositoryInterface\PermissionTypeRepositoryInterface','HappyFeet\Repository\PermissionTypeRepository');
        //Permission
        $this->app->bind('HappyFeet\RepositoryInterface\PermissionRepositoryInterface','HappyFeet\Repository\PermissionRepository');
        //Role
        $this->app->bind('HappyFeet\RepositoryInterface\RoleRepositoryInterface','HappyFeet\Repository\RoleRepository');
        //Patient
    }
}
