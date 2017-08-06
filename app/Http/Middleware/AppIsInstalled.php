<?php

namespace App\Http\Middleware;

use Closure;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class AppIsInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = \Route::getRoutes()->match($request)->getAction();

        // To avoid redirect when error page has to be shown
        if( ! in_array( $route[ 'as' ], array_merge( config( 'tendoo.routes.setup' ), [ 'error' ] ) ) ) {
            DotenvEditor::load();
            $keys       =   DotenvEditor::getKeys();
            
            if( ! DotenvEditor::keyExists( 'TENDOO_VERSION' ) ) {
                return redirect()->route( 'setup.index' );  
            }
        }  else if( in_array( $route[ 'as' ], config( 'tendoo.routes.setup' ) ) )  {
            DotenvEditor::load();
            $keys       =   DotenvEditor::getKeys();

            if( DotenvEditor::keyExists( 'TENDOO_VERSION' ) ) {
                return redirect()->route( 'error', [ 'code' => 'setup-locked'] );  
            }
        }    
        return $next($request);
    }
}
