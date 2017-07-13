<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Logout the user
     * @return void
    **/

    public function index()
    {
        Auth::logout();
        return redirect()->route( 'sign-in.index' );
    }
}
