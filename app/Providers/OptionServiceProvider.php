<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Backend\Options;
use App\Backend\Gui;

class OptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    // protected   $defer  =   true;

    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // save Singleton for options
        $this->app->singleton( Options::class, function(){
            return new Options;
        });

        // App::bind()
        $this->app->singleton( Gui::class, function( $app ) {
            return new Gui( 
                $app->make( Options::class )
            );
        });
    }
}