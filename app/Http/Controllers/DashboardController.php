<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Backend\Menus;
use App\Backend\Options;
use App\Backend\Gui;
use App\Helpers\Page;
use Validator;

class DashboardController extends Controller
{   
    private $options;
    
    public function __construct( 
        Menus $menus,
        Options $options,
        Gui $gui
    )
    {
        $this->options      =   $options;
        $this->gui          =   $gui;
        
        // if( Auth::check() == false ) {
        //     $this->middleware( 'auth.viaRememberCookie' );
        // }
        
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
        Page::title( __( 'Dashboard' ), __( 'Main Page' ) );

        $this->gui->columns([
            'foo.width'     =>  6,
            'foo.title'     =>  __( 'Super Section' )
        ]);

        $this->gui->item( 'foo', [
            'type'  =>      'text',
            'name'  =>      'email',
            'label' =>      __( 'Email' ),
            'validation'    =>  'email_or_empty',
            'description'   =>  __( 'Use email to submit' )
        ]);

        $this->gui->item( 'foo', [
            'type'  =>      'text',
            'name'  =>      'foo',
            'label' =>      __( 'Foo field' ),
            'description'   =>  __( 'This is something really cool' )
        ]);

        $this->gui->item( 'foo', [
            'type'  =>      'textarea',
            'name'  =>      'boom',
            'label' =>      __( 'Textarea' ),
            'description'   =>  __( 'This is something really cool' )
        ]);

        $this->gui->item( 'foo', [
            'type'  =>      'select',
            'options'   =>  [
                'foo'   =>  'Foo',
                'bar'   =>  'Bar'
            ],
            'name'  =>      'bar',
            'label' =>      __( 'Bar field' ),
            'description'   =>  __( 'This is something really cool' )
        ]);

        return view( 'dashboard.pages.index', [
            'gui'   =>  $this->gui
        ]);
    }

    /**
     * Dashboard
     * 
     * @param
     * @return
    **/

    public function settings()
    {
        $this->gui->config([
            'page.title'         =>  __( 'Tendoo Settings' ),
            'page.subTitle'      =>  __( 'All application settings.' )
        ]);

        $this->gui->tabs([
            'general.title'         =>  __( 'General' ),
            'general.namespace'     =>  'general',
            'bar.title'     =>  __( 'Advanced' ),
            'bar.namespace'     =>  'advanced'
        ]);

        $this->gui->tabsColumns( 'general', [
            'details.width'     =>  6,
            'details.title'     =>  __( 'Informations' )
        ]);

        $this->gui->tabColumnItems( 'general', 'details', [
            'type'          =>  'text',
            'name'          =>  'app_name',
            'label'         =>  __( 'Application Name' ),
            'validation'    =>  'required',
            'description'   =>  __( 'Provide a name for your installation.' )
        ]);

        Page::config([
            'show.title'    =>  false
        ]);

        Page::title( __( 'Settings' ), __( 'Application Settings' ) );
        return view( 'dashboard.pages.settings', [
            'gui'       =>  $this->gui
        ]);
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
     * Option Save
     * get validation rules saved for each rules
    **/

    public function optionsSave( 
        Request $request,
        Options $options 
    )
    {
        $formNamespaces     =   session( 'form-namespace' );
        $validation         =   @$formNamespaces[ url()->previous() ];
        // validate the form key
        if( @$validation[ request( 'form-namespace' ) ] ) {
            
            $validator      =   Validator::make( $request->all(), $validation[ request( 'form-namespace' ) ] );

            if ( $validator->fails() ) {
                return redirect( url()->previous() )
                ->withErrors($validator)
                ->withInput();
            }

            foreach( request()->except( '_token' ) as $key => $value ) {
                if( $key != '_token' ) {
                    $options->set( $key, $value );
                }
            }
            
            return redirect( url()->previous() )
            ->withResponse([
                'status'    =>  'success',
                'message'   =>  __( 'The options has been saved.' )
            ]);
        }
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
