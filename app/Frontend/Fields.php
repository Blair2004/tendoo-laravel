<?php
namespace App\Frontend;

class Fields
{
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
}