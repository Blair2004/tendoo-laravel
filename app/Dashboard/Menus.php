<?php

namespace App\Dashboard;

class Menus
{
    /** 
     * Save/update new menu
     * @param string namespace
     * @param array menus
    **/

    public static function create( $namespace, $menus )
    {
        // save the new menus
        config([ 'dashboard.menus.' . $namespace => $menus ]);
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
     * add
     * @param namespace
     * @return void
    **/

    public static function add( $key, $menus )
    {
        if( ! config( 'dashboard.menus.' . $key, false ) ) {
            config([ 'dashboard.menus.' . $key => $menus ]);
        }
    }
}