<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SigninRequest;
use App\Helpers\Page;


class SigninController extends Controller
{
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

    public function index()
    {
        Page::title( _i( 'Login page' ) );
        return view( 'sign-in.pages.index' );
    }

    /**
     * Password Lost
     * @return void
    **/

    public function passwordLost()
    {
        Page::title( _i( 'Password Lost' ) );
        return view( 'sign-in.pages.password-lost' );
    }

    /**
     * Login the user
     * @return void
    **/

    public function login(SigninRequest $request)
    {
        if (Auth::attempt(['email' => request( 'email' ), 'password' => request( 'password' )])) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }

        // redirect to a login page
        return redirect()->route( 'sign-in.index' )->with( 'response', [
            'status'    =>  'failed',
            'message'   =>  _i( 'Wrong username or password' )
        ]);
    }

    /**
     * Password Lost
     * @return void
    **/

    public function passwordRecovery()
    {
        
    }
}
