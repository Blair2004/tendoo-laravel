<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Config;
use App\Backend\Gui;
use App\Backend\Options;
use App\Frontend\Fields;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        Validator::extend( 'email_or_empty', function ($attribute, $value, $parameters, $validator) {
            if( ! empty( $value ) ) {
                if( preg_match("/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i", $value ) ) {
                    return true;
                }
                return false;
            }
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__ . '/../Helpers.php';

        // Init Config
        $this->app->singleton( Config::class, function(){
            return new Config;
        });

        // bing fields
        $this->app->singleton( Fields::class, function( $app ){
            return new Fields( $app->make( Request::class ) );
        });  
    }
}
