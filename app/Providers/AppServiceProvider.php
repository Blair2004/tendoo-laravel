<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Blade;
use App\Config;
use App\Services\Gui;
use App\Services\Options;
use App\Services\Fields;
use App\Models\User;


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

        Blade::directive( 'css', function ( $component ) {
            return "<?php echo '<link rel=\"stylesheet\" type=\"text/css\" href=\"' . asset( 'css/' . $component  . '.css' );?>\">";            
        });

        Blade::directive( 'js', function( $component ) {
            return "<?php echo '<script type=\"text/javascript\" src=\"' . asset( 'js/' . $component  . '.js' );?>\"></script>";            
        });

        Blade::directive( 'bower_js', function( $component ) {
            return "<?php echo '<script type=\"text/javascript\" src=\"' . asset( 'bower_components/' . $component  . '.js' );?>\"></script>";            
        });

        Blade::directive( 'bower_css', function( $component ) {
            return "<?php echo '<link rel=\"stylesheet\" type=\"text/css\" href=\"' . asset( 'bower_components/' . $component  . '.css' );?>\">";            
        });

        Blade::directive( 'fonts', function( $component ) {
            return "<?php echo '<link rel=\"stylesheet\" type=\"text/css\" href=\"' . asset( 'fonts/' . $component  . '.css' );?>\">";            
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__ . '/../Services/Helpers.php';

        // Init Config
        $this->app->singleton( Config::class, function(){
            return new Config;
        });

        // bing fields
        $this->app->singleton( Fields::class, function( $app ){
            return new Fields( $app->make( Request::class ) );
        });
        
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
