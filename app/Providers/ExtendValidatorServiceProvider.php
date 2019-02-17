<?php

namespace HappyFeet\Providers;

use Illuminate\Support\ServiceProvider;
use Tavo\ValidadorEc;
use Validator;

class ExtendValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('valid_dni',function($attribute, $value, $parameters, $validator) {

            $validEc = new ValidadorEc();
            if ($validEc->validarCedula($value)) {
                return true;
            }

            return false;
        });


        Validator::extend('is_used', function ($attribute, $value, $parameters, $validator) {
            dd($attribute,$value,$parameters);
            return $value == 'foo';
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
