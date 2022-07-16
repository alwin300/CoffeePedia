<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        paginator::useBootstrap();
        
        {
            //Add this custom validation rule.
            Validator::extend('alpha_spaces', function ($attribute, $value) {
        
                // This will only accept alpha and spaces. 
                // If you want to accept hyphens use: /^[\pL\s-]+$/u.
                return preg_match('/^[\pL\s]+$/u', $value); 
        
            });
        }
}
}
