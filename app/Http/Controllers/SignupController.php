<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Helpers\Page;
use App\Frontend\Fields;
use App\Http\Requests\SignupRequest;
use App\User;

class SignupController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware( 'guest' );
    }

    /**
     * Registration Form
    **/

    public function index( Fields $fields )
    {
        Page::title( 'Registration' );
        return view( 'sign-up.pages.index', compact( 'fields' ) );
    }

    /**
     * Sign Up
    **/

    public function submit( SignupRequest $request,  Fields $fields )
    {
        $user   =   new User;
        foreach( $fields->signup() as $name => $field ) {
            if( @$field[ 'ignore' ] != true ) {
                if( @$field[ 'beforeSave' ] != null ) {
                    $user->$name    =   $field[ 'beforeSave' ]( request( $name ) );
                } else {
                    $user->$name    =   request( $name );
                }                
            }            
        }

        // Now save user
        $user->save();
        return redirect()->route( 'sign-in.index' )->withResponse([
            'status'    =>  'success',
            'message'   =>  __( 'You account has been created.' )
        ]);
    }
}
