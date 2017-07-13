<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $dashboard_menu     =   [];

        // Dashboard index
        config([ 'dashboard.menus.home.index' => [
            'href'          =>  url( 'dashboard' ),
            'text'          =>  'Dashboard',
            'icon'          =>  'icon-compass'
        ]]);

        // Dashboard Module List
        config([ 'dashboard.menus.modules.index' => [
            'href'          =>  url( 'dashboard/modules' ),
            'text'          =>  'Modules',
            'icon'          =>  'icon-cursor'
        ]]);

        // dashboard users
        config([ 'dashboard.menus.users.index' => [
            'href'          =>  url( 'dashboard/users' ),
            'text'          =>  'Users',
            'icon'          =>  'icon-users'
        ]]);

        config([ 'dashboard.menus.users.add' => [
            'href'          =>  url( 'dashboard/users/add' ),
            'text'          =>  'Add',
            'icon'          =>  'icon-users'
        ]]);

        config([ 'dashboard.menus.users.profile' => [
            'href'          =>  url( 'dashboard/profile' ),
            'text'          =>  'Your Profile',
            'icon'          =>  'icon-users'
        ]]);

        
    }
}
