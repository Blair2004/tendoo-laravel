<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests\SigninRequest;
use App\Services\Page;
use App\Services\Fields;


class SigninController extends Controller
{

    // use ResetsPasswords;
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Login Page index
     * @return void
    **/

    public function index( Fields $fields )
    {
        Page::title( __( 'Login page' ) );
        return view( 'sign-in.pages.index', compact( 'fields' ) );
    }

    /**
     * Password Lost
     * @return void
    **/

    public function passwordLost()
    {
        Page::title( __( 'Password Lost' ) );
        return view( 'sign-in.pages.password-lost' );
    }

    /**
     * Login the user
     * @return void
    **/

    public function login(SigninRequest $request)
    {
        if (
            Auth::attempt(['email' => request( 'email' ), 'password' => request( 'password' )], ( bool ) request( 'remember_me' ) ) || 
            Auth::attempt(['username' => request( 'email' ), 'password' => request( 'password' )], ( bool ) request( 'remember_me' ) )
        ) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }

        // redirect to a login page
        return redirect()->route( 'sign-in.index' )->with( 'response', [
            'status'    =>  'failed',
            'message'   =>  __( 'Wrong username or password' )
        ]);
    }
}
