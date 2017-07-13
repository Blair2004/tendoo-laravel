<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dashboard\Menus;
use App\Dashboard\Page;

class DashboardController extends Controller
{
    public function __construct()
    {
        Menus::create( 'nexo.hello',[
            'href'  =>  url( 'dashboard/nexo' ),
            'icon'  =>  'icon- fa fa-home',
            'text'  =>  'Bonjour'
        ]);

        Menus::add( 'nexo.delete', [
            'href'  =>  url( 'dashboard/nexo' ),
            'icon'  =>  'icon- fa fa-home',
            'text'  =>  'Bonsoir',
            'count' =>  1
        ]);

        Menus::add( 'nexo.compact', [
            'href'  =>  url( 'dashboard/compact' ),
            'icon'  =>  'icon- fa fa-zip',
            'text'  =>  'All right'
        ]);
    }

    /**
     * Dashboard
     * 
     * @param
     * @return
    **/

    public function index()
    {
        return view( 'dashboard.pages.index' );
    }

    /**
     * Dashboard
     * 
     * @param
     * @return
    **/

    public function settings()
    {
        return view( 'dashboard.pages.settings' );
    }

    /**
     * Dashboard
     * 
     * @param
     * @return
    **/

    public function users()
    {
        config([ 'dashboard.page.body.padding' => true ]);
        config([ 'dashboard.page.title' => "Bonjour" ]);
        config([ 'dashboard.page.subTitle' => "foo ar" ]);

        return view( 'dashboard.pages.users' );
    }

    /**
     * Dashboard
     * 
     * @param
     * @return
    **/

    public function about()
    {
        return view( 'dashboard.pages.about' );
    }

    /**
     * Dashboard
     * 
     * @param
     * @return
    **/

    public function update()
    {
        return view( 'dashboard.pages.update' );
    }


    /**
     * Dashboard
     * 
     * @param
     * @return
    **/

    public function store()
    {
        return view( 'dashboard.pages.store' );
    }


    /**
     * Dashboard
     * 
     * @param
     * @return
    **/

    public function options()
    {
        return view( 'dashboard.pages.options' );
    }

    /**
     * Dashboard module
     * @param 
     * @return view
    **/

    public function modules()
    {
        config([ 'dashboard.page.show.title' => true ]);
        config([ 'dashboard.page.title' =>  'Modules' ]);
        config([ 'dashboard.page.subTitle' =>  'the modules list' ]);
        return view( 'dashboard.pages.modules' );   
    }

    /**
     * Profilte
     * User Profile
     * @return void
    **/

    public function profile()
    {
        Page::title( 'Profile' );
        return view( 'dashboard.pages.profile' );
    }
}
