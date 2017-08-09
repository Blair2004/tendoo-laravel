<?php
namespace App\Services;

use Illuminate\Http\Request;

class Fields
{
    public function __construct( Request $request )
    {
        $this->request      =   $request;
    }
    
    /**
     * signup Fields
    **/

    public function signup()
    {
        $fields     =   [];
        array_set( $fields, 'username.text', __( 'User Name' ) );
        array_set( $fields, 'username.icon', 'la la-user' );
        array_set( $fields, 'username.rule', 'required|min:5|unique:users,username' );

        array_set( $fields, 'email.text', __( 'Email' ) );
        array_set( $fields, 'email.icon', 'la la-at' );
        array_set( $fields, 'email.rule', 'required|email|unique:users,email' );

        array_set( $fields, 'password.text', __( 'Password' ) );
        array_set( $fields, 'password.icon', 'la la-lock' );
        array_set( $fields, 'password.type', 'password' );
        array_set( $fields, 'password.rule', 'required|min:6' );
        array_set( $fields, 'password.beforeSave', function( $value ) {
            return bcrypt( $value );
        });
        

        array_set( $fields, 'confirm.text', __( 'Password Confirm' ) );
        array_set( $fields, 'confirm.icon', 'la la-lock' );
        array_set( $fields, 'confirm.type', 'password' );
        array_set( $fields, 'confirm.rule', 'same:password|required' );
        array_set( $fields, 'confirm.ignore', true );

        return $fields;
    }

    /**
     * Sign in Fields
     * @return array
    **/

    public function signin()
    {
        $fields     =   [];
        array_set( $fields, 'email.text', __( 'Email or Username' ) );
        array_set( $fields, 'email.icon', 'la la-at' );
        array_set( $fields, 'email.rule', 'required' );
        array_set( $fields, 'email.type', 'text' );

        array_set( $fields, 'password.text', __( 'Password' ) );
        array_set( $fields, 'password.icon', 'la la-lock' );
        array_set( $fields, 'password.rule', 'required' );
        array_set( $fields, 'password.type', 'password' );

        array_set( $fields, 'remember_me.text', __( 'Stay Logged' ) );
        array_set( $fields, 'remember_me.type', 'checkbox' );
        array_set( $fields, 'remember_me.value', 1 );

        return $fields;
    }

    /**
     * Setup Fields
     * @return array
    **/

    public function setup( $step )
    {
        $fields         =   [];
        
        if( $step == 1 ) {
            array_set( $fields, 'hostname.text', __( 'Host Name' ) );
            array_set( $fields, 'hostname.icon', 'la la-at' );
            array_set( $fields, 'hostname.rule', 'required' );
            array_set( $fields, 'hostname.type', 'text' );
            array_set( $fields, 'hostname.value', config( 'tendoo.db.hostname' ) );

            array_set( $fields, 'username.text', __( 'User Name' ) );
            array_set( $fields, 'username.icon', 'la la-user' );
            array_set( $fields, 'username.rule', 'required' );
            array_set( $fields, 'username.type', 'text' );
            array_set( $fields, 'username.value', config( 'tendoo.db.username' ) );

            array_set( $fields, 'userpassword.text', __( 'User Passwword' ) );
            array_set( $fields, 'userpassword.icon', 'la la-key' );
            array_set( $fields, 'userpassword.type', 'text' );

            array_set( $fields, 'dbname.text', __( 'Database Name' ) );
            array_set( $fields, 'dbname.icon', 'la la-hdd-o' );
            array_set( $fields, 'dbname.rule', 'required' );
            array_set( $fields, 'dbname.type', 'text' );
            array_set( $fields, 'dbname.value', config( 'tendoo.db.dbname' ) );

            array_set( $fields, 'dbprefix.text', __( 'Database Prefix' ) );
            array_set( $fields, 'dbprefix.type', 'text' );  
            array_set( $fields, 'dbprefix.icon', 'la la-caret-square-o-right' );
            array_set( $fields, 'dbprefix.rule', 'required' );
            array_set( $fields, 'dbprefix.value', config( 'tendoo.db.prefix' ) );         
        } else if( $step == 2 ) {
            array_set( $fields, 'app_name.text', __( 'Application Name' ) );
            array_set( $fields, 'app_name.icon', 'la la-sliders' );
            array_set( $fields, 'app_name.rule', 'required' );
            array_set( $fields, 'app_name.type', 'text' );
            array_set( $fields, 'app_name.value', $this->request->old( 'app_name' ) );

            array_set( $fields, 'username.text', __( 'Admin Username' ) );
            array_set( $fields, 'username.icon', 'la la-user' );
            array_set( $fields, 'username.rule', 'required|min:5' );
            array_set( $fields, 'username.type', 'text' );
            array_set( $fields, 'username.value', $this->request->old( 'username' ) );

            array_set( $fields, 'email.text', __( 'Admin Email' ) );
            array_set( $fields, 'email.icon', 'la la-at' );
            array_set( $fields, 'email.rule', 'required|email' );
            array_set( $fields, 'email.type', 'text' );
            array_set( $fields, 'email.value', $this->request->old( 'email' ) );

            array_set( $fields, 'password.text', __( 'Admin Password' ) );
            array_set( $fields, 'password.icon', 'la la-lock' );
            array_set( $fields, 'password.rule', 'required|min:6|max:20' );
            array_set( $fields, 'password.type', 'password' );

            array_set( $fields, 'password_confirm.text', __( 'Password Confirmation' ) );
            array_set( $fields, 'password_confirm.icon', 'la la-lock' );
            array_set( $fields, 'password_confirm.rule', 'required|same:password' );
            array_set( $fields, 'password_confirm.type', 'password' );
        }        

        return $fields;        
    }
}