<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Services\Interfaces\DashboardSettings as SettingsUI;
use App\Services\Menus;
use App\Services\Options;
use App\Services\Gui;
use App\Services\Boot;
use App\Services\Page;
use Validator;

class DashboardController extends Controller
{   
    private $options;
    
    public function __construct(
        Options $options,
        Gui $gui,
        Menus $menus,
        Boot $boot     
    )
    {     
        $this->options      =    $options;
        $this->gui          =    $gui;
        $this->menu         =    $menus;
        $this->middleware( 'auth' );
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

    public function settings( SettingsUI $interface )
    {
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

        $this->gui->config([ 'table.filter' => false ]);
        $this->gui->config([ 'table.name'   =>  __( 'Users List' )]);
        $this->gui->config([ 'table.namespace' => 'users' ]);
        $this->gui->config([ 'table.columns'    =>  [
            'name'      =>  __( 'User Name' ),
            'email'     =>  __( 'Email' ),
            'role'      =>  __( 'Role' ),
            'status'    =>  __( 'Status' ),
        ]]);

        return view( 'dashboard.pages.users', [
            'gui'       =>   $this->gui
        ]);
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
            
        foreach( ( array ) request( 'form-namespace' ) as $namespace => $code ) {
            // if validation exists
            if( @$validation[ $namespace ] ) {

                // validation code match session validation code
                if( @$validation[ $namespace ][ 'code' ] == $code ) {
                    
                    $validator      =   Validator::make( $request->all(), $validation[ $namespace ][ 'rules' ] );

                    if ( $validator->fails() ) {
                        return redirect( url()->previous() )
                        ->withErrors($validator)
                        ->withInput();
                    }

                    foreach( request()->except( '_token', 'form-namespace' ) as $key => $value ) {
                        if( $key != '_token' ) {
                            $options->set( $key, $value );
                        }
                    }
                    
                    return redirect( url()->previous() )
                    ->withResponse([
                        'status'    =>  'success',
                        'message'   =>  __( 'The options has been saved.' )
                    ]);

                    break;
                }
            }
        }

        // give a reason
        Log::error( sprintf( 'Unable to save options from %s, since the validation rules are not set or doesn\'t match the session validation rules', 
            url()->previous()
        ) );

        return redirect( url()->previous() )
        ->withResponse([
            'status'    =>  'error',
            'message'   =>  __( 'Validation rules required.' )
        ]);
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
