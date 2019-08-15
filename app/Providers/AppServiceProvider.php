<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('eachError', function ($campo, $errors) {
            if(!$errors->get($campo)){
                echo old($campo);
            }
        });

        Blade::if('select', function($campo, $comparacion){
            if(old($campo) == $comparacion){
                echo "selected";
            }
        });

        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
