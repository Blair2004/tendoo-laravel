<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dashboard\Menus;
use App\Helpers\Page;

class DashboardController extends Controller
{    
    public function __construct( Menus $menus )
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard
     * 
     * @param
     * @return
    **/

    public function index()
    {
        Page::title( _i( 'Dashboard' ), _i( 'Main Page' ) );
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

    public function modules( $page = 'list' )
    {
        if( $page == 'list' ) {
            Page::title( 'Modules List' );
            return view( 'dashboard.pages.modules' ); 
        } else if( $page == 'upload' ) {
            Page::title( 'Modules Upload' );
            return view( 'dashboard.pages.modules-upload' ); 
        }
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
