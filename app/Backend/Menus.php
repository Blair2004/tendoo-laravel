<?php

namespace App\Backend;

class Menus
{
    public function __construct( $build = false )
    {
        if( $build == false ) {
            // Sidebar Menu
            // Dashboard index
            config([ 'dashboard.menus.home.index' => [
                'href'          =>  url( 'dashboard' ),
                'text'          =>  _i( 'Dashboard' ),
                'icon'          =>  'la la-dashboard'
            ]]);

            // Dashboard Module List
            config([ 'dashboard.menus.modules.index' => [
                'disable'       =>  true,
                'text'          =>  _i( 'Modules' ),
                'icon'          =>  'la la-plug'
            ]]);

            config([ 'dashboard.menus.modules.all' => [
                'href'          =>  url( 'dashboard/modules' ),
                'text'          =>  _i( 'All Modules' )
            ]]);

            // Module Upload
            config([ 'dashboard.menus.modules.upload' => [
                'href'          =>  url( 'dashboard/modules/upload' ),
                'text'          =>  _i( 'Upload A Module' )
            ]]);

            // dashboard users
            config([ 'dashboard.menus.users.index' => [
                'text'          =>  _i( 'Users' ),
                'icon'          =>  'la la-users',
                'disable'       =>  true
            ]]);

            // list
            config([ 'dashboard.menus.users.list' => [
                'href'          =>  url( 'dashboard/users' ),
                'text'          =>  _i( 'All Users' ),
                'icon'          =>  'la la-users'
            ]]);

            // dashboard users add
            config([ 'dashboard.menus.users.add' => [
                'href'          =>  url( 'dashboard/users/add' ),
                'text'          =>  _i( 'New User' ),
            ]]);

            // dashboard users profile
            config([ 'dashboard.menus.users.profile' => [
                'href'          =>  url( 'dashboard/profile' ),
                'text'          =>  _i( 'My profile' ),
            ]]);

            /**
            * Add Settings Page Menu
            **/
            config([ 'dashboard.menus.settings.index' => [
                'icon'          =>  'la la-cogs',
                'text'          =>  _i( 'Settings' ),
                'disable'       =>  true
            ]]);

            config([ 'dashboard.menus.settings.general' => [
                'href'          =>  url()->route( 'dashboard.settings' ),
                'text'          =>  _i( 'General' )
            ]]);


            // Users Menus
            config([ 'dashboard.user-menus.profile' => [
                'href'  =>  url()->route( 'dashboard.profile' ),
                'text'  =>  _i( 'Profile' ),
                'icon'  =>  'la la-user'
            ]]);

            config([ 'dashboard.user-menus.help' => [
                'href'  =>  url()->route( 'dashboard.help' ),
                'text'  =>  _i( 'Help' ),
                'icon'  =>  'la la-question-circle'
            ]]);

            config([ 'dashboard.user-menus.sign-out' => [
                'href'  =>  url()->route( 'sign-out.index' ),
                'text'  =>  _i( 'Sign Out' ),
                'icon'  =>  'la la-sign-out'
            ]]);
        }
    }

    /**
     * Delete
     * @param menu string
     * @return void
    **/

    public static function delete( $namespace )
    {
        $dashboardMenus     =   config('dashboard.menus');
        config([ 'dashboard.menus' => array_except( $dashboardMenus, $namespace )]);
    }

    /**
     * Insert before a specific key
    **/

    public function before( $filter ) 
    {
        $menus                  =   config( 'dashboard.menus' );
        $saved                  =   array_only( $menus, $this->key );
        $cleared                =   array_except( $menus, $this->key );
        $complete               =   array_insert_before( config( 'dashboard.menus' ), $filter, $saved );
        config([ 'dashboard.menus' => $complete ]);
    }

    /**
     * Insert After
    **/

    public function after( $filter ) 
    {
        $menus                  =   config( 'dashboard.menus' );
        $saved                  =   array_only( $menus, $this->key );
        $cleared                =   array_except( $menus, $this->key );
        $complete               =   array_insert_after( config( 'dashboard.menus' ), $filter, $saved );
        config([ 'dashboard.menus' => $complete ]);
    }

    /**
     * add
     * @param namespace
     * @return void
    **/

    public static function add( $key, $menus )
    {
        config([ 'dashboard.menus.' . $key => $menus ]);
        $config                     =   config( 'dashboard.menus.' . $key );
        $stdClass                   =   new \stdClass;
        $current                    =   new self( true );  // ignore build
        $current->key               =   $key;   
        return $current;  
    }

    /** 
     * User Menu
     * @param string key
     * @param array menu
     * @return void
    **/

    public static function user( $key, $menus )
    {
        return config([ 'dashboard.user-menus.' . $key => $menus ]);
    }

    /**
     * Tools
     * @param string key
     * @param menus
     * @return void
    **/

    public static function tools( $namespace, $menus )
    {
        return config([ 'dashboard.tools-menus.' . $namespace => $menus ]);
    }
}