<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Route;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */

    public function render($request, Exception $exception)
    {
        if( ! config( 'tendoo.debug.errors', false ) && ! $request->expectsJson() ) {

            if( $exception instanceof HttpException ) {
                config([ 'page.title' => __( 'An error has occured' )]);
                return response()->view( 'errors.index', [
                    'code'  =>  $exception->getStatusCode()
                ]);
            }

            if( $exception instanceof TokenMismatchException ) {      
                config([ 'page.title' => __( 'Token Error Mismatch' )]);
                return response()->view( 'errors.index', [
                    'code'  =>  'token-error'
                ]);            
            }

            // if( $exception instanceof QueryException ) {
            //     // if error occur everywhere but not during the setup
            //     if( ! in_array( Route::currentRouteName(), [ 'setup.db' ] ) ) {
            //         return response()->view( 'errors.index', [
            //             'code'  =>  'db-error'
            //         ]);
            //     }
            // }
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest( route('sign-in.index') );
    }
}
