<?php

namespace Futbol\Providers;

use Illuminate\Support\ServiceProvider;
use Futbol\Repository\ModuleRepository;
use Validator;
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
        //menu
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

        //set hour

        \Carbon\Carbon::setLocale(config('app.locale'));

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Futbol\RepositoryInterface\RepresentantRepositoryInterface','Futbol\Repository\RepresentantRepository');

        $this->app->bind('Futbol\RepositoryInterface\RegisterStudentFrontendRepositoryInterface','Futbol\Repository\RegisterStudentFrontendRepository');

        $this->app->bind('Futbol\RepositoryInterface\ModuleRepositoryInterface','Futbol\Repository\ModuleRepository');

        $this->app->bind('Futbol\RepositoryInterface\PermissionTypeRepositoryInterface','Futbol\Repository\PermissionTypeRepository');

        $this->app->bind('Futbol\RepositoryInterface\PermissionRepositoryInterface','Futbol\Repository\PermissionRepository');
        
        
        $this->app->bind('Futbol\RepositoryInterface\RoleRepositoryInterface','Futbol\Repository\RoleRepository');

        $this->app->bind('Futbol\RepositoryInterface\PersonTypeRepositoryInterface','Futbol\Repository\PersonTypeRepository');
        
        $this->app->bind('Futbol\RepositoryInterface\UserRepositoryInterface','Futbol\Repository\UserRepository');
        
        $this->app->bind('Futbol\RepositoryInterface\FieldRepositoryInterface','Futbol\Repository\FieldRepository');

        $this->app->bind('Futbol\RepositoryInterface\StudentRepositoryInterface','Futbol\Repository\StudentRepository');

        $this->app->bind('Futbol\RepositoryInterface\AgeRangeRepositoryInterface','Futbol\Repository\AgeRangeRepository');

        $this->app->bind('Futbol\RepositoryInterface\GroupClassRepositoryInterface','Futbol\Repository\GroupClassRepository');

        $this->app->bind('Futbol\RepositoryInterface\SeasonRepositoryInterface','Futbol\Repository\SeasonRepository');

        $this->app->bind('Futbol\RepositoryInterface\AssistanceRepositoryInterface','Futbol\Repository\AssistanceRepository');

        $this->app->bind('Futbol\RepositoryInterface\FieldTypeRepositoryInterface','Futbol\Repository\FieldTypeRepository');

        $this->app->bind('Futbol\RepositoryInterface\CoachRepositoryInterface','Futbol\Repository\CoachRepository');

        $this->app->bind('Futbol\RepositoryInterface\AssistanceCoachRepositoryInterface','Futbol\Repository\AssistanceCoachRepository');
    }
}
