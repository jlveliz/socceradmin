<?php

namespace HappyFeet\Providers;

use Illuminate\Support\ServiceProvider;
use HappyFeet\Repository\ModuleRepository;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view) {

            $user = Auth::user();
            
            if ($user) {
                
                $moduleRepo = new ModuleRepository();
                
                if ($user->super_admin) {
                    $menu = $moduleRepo->loadAdminMenu();
                } else {
                    $menu = $moduleRepo->loadMenu($user->id);

                }

                view()->share('menu',$menu);
            }
            
        });
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

        $this->app->bind('HappyFeet\RepositoryInterface\PermissionTypeRepositoryInterface','HappyFeet\Repository\PermissionTypeRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\PermissionRepositoryInterface','HappyFeet\Repository\PermissionRepository');
        
        $this->app->bind('HappyFeet\RepositoryInterface\ModuleRepositoryInterface','HappyFeet\Repository\ModuleRepository');
        
        $this->app->bind('HappyFeet\RepositoryInterface\RoleRepositoryInterface','HappyFeet\Repository\RoleRepository');
    }
}
