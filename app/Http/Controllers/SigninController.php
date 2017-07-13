<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SigninController extends Controller
{
    public function index( $page = 'index' )
    {
        if( in_array( $page, [ 'password-lost', 'index' ] ) ) {
            return view( 'sign-in.pages.' . $page );
        }                
    }
}
