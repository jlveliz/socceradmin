<?php

namespace HappyFeet\Providers;

use Illuminate\Support\ServiceProvider;
use HappyFeet\Repository\ModuleRepository;
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
        $this->app->bind('HappyFeet\RepositoryInterface\RepresentantRepositoryInterface','HappyFeet\Repository\RepresentantRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\RegisterStudentFrontendRepositoryInterface','HappyFeet\Repository\RegisterStudentFrontendRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\ModuleRepositoryInterface','HappyFeet\Repository\ModuleRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\PermissionTypeRepositoryInterface','HappyFeet\Repository\PermissionTypeRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\PermissionRepositoryInterface','HappyFeet\Repository\PermissionRepository');
        
        
        $this->app->bind('HappyFeet\RepositoryInterface\RoleRepositoryInterface','HappyFeet\Repository\RoleRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\PersonTypeRepositoryInterface','HappyFeet\Repository\PersonTypeRepository');
        
        $this->app->bind('HappyFeet\RepositoryInterface\UserRepositoryInterface','HappyFeet\Repository\UserRepository');
        
        $this->app->bind('HappyFeet\RepositoryInterface\FieldRepositoryInterface','HappyFeet\Repository\FieldRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\StudentRepositoryInterface','HappyFeet\Repository\StudentRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\AgeRangeRepositoryInterface','HappyFeet\Repository\AgeRangeRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\GroupClassRepositoryInterface','HappyFeet\Repository\GroupClassRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\SeasonRepositoryInterface','HappyFeet\Repository\SeasonRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\AssistanceRepositoryInterface','HappyFeet\Repository\AssistanceRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\FieldTypeRepositoryInterface','HappyFeet\Repository\FieldTypeRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\CoachRepositoryInterface','HappyFeet\Repository\CoachRepository');

        $this->app->bind('HappyFeet\RepositoryInterface\AssistanceCoachRepositoryInterface','HappyFeet\Repository\AssistanceCoachRepository');
    }
}
