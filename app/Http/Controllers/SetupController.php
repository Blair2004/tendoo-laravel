<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use App\Services\Fields;
use App\Http\Requests\DBSetupRequest;
use App\Http\Requests\AppSetupRequest;
use App\Services\Options;
use App\Services\Page;
use App\Services\Setup;
use App\Models\User;
use App\Models\Role;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Artisan;

class SetupController extends Controller
{
    public function __construct(
        Fields $fields,
        Setup $setup
    )
    {
        $this->fields   =   $fields;
        $this->setup    =   $setup;
    }

    /**
     * Index
     * @return void
    **/

    public function index( Fields $fields )
    {
        Page::title( __( 'Tendoo CMS installation Wizard' ) );
        return view( 'setup.pages.index', compact( 'fields' ) );
    }

    /** 
     * Steps
     * @return avoid
    **/

    public function step( $step )
    {
        DotenvEditor::load();

        if( $step == 1 ) {
            Page::title( __( 'Database Configuration' ) );
        } elseif ( $step == 2 ) {
            Page::title( __( 'Application Settings' ) );
        }

        $fields     =   $this->fields;        
        return view( 'setup.pages.step', compact( 'fields', 'step' ) ); 
    }

    /**
     * Db configuration
     * @return void
    **/

    public function db( DBSetupRequest $request )
    {
        config([ 'database.connections.mysql' => [
            'driver' => 'mysql',
            'host' => $request->input( 'hostname' ),
            'port' => env('DB_PORT', '3306'),
            'database' => $request->input( 'dbname' ),
            'username' => $request->input( 'username' ),
            'password' => $request->input( 'userpassword' ),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => $request->input( 'dbprefix' ),
            'strict' => true,
            'engine' => null,
        ]]);

        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {

            switch( $e->getCode() ) {
                case 2002   :   
                    $message =  [
                        'hostname'  =>  __( 'Unable to reach the host.' )
                    ]; 
                break;
                case 1045   :   
                    $message =  [
                        'username'  =>  __( 'Unable to connect with the user credentials.' )
                    ];
                break;
                case 1049   :   
                    $message =  [
                        'dbname'  =>  __( 'Unable to select the database.' )
                    ];
                break;
                default     :   
                    $message =  [
                        'hostname'  =>  __( 'An error occured during the connexion.' )
                    ]; 
                break;
            }

            return redirect( route( 'setup.step', [ 'step' => 1 ] ) )->withErrors( $message );
        }
        
        DotEnvEditor::setKey( 'DB_HOST', $request->input( 'hostname' ) );
        DotEnvEditor::setKey( 'DB_DATABASE', $request->input( 'dbname' ) );
        DotEnvEditor::setKey( 'DB_USERNAME', $request->input( 'username' ) );
        DotEnvEditor::setKey( 'DB_PASSWORD', $request->input( 'userpassword' ) );
        DotEnvEditor::setKey( 'DB_PREFIX', $request->input( 'dbprefix' ) );
        DotEnvEditor::setKey( 'DB_PORT', 3306 );
        DotEnvEditor::setKey( 'DB_CONNECTION', 'mysql' );
        DotenvEditor::save();

        // Create Tables
        $this->setup->createTables();

        // We assume everything is okay from here
        $this->setup->createRoles();

        // Create Permissions
        $this->setup->createPermissions();

        // Assign Permissions
        $this->setup->assignPermissions();

        return redirect()->route( 'setup.step', [ 'id' => 2 ] );
    }

    /**
     * Setup App
     * @return void
    **/

    public function app( AppSetupRequest $request, Options $options ) 
    {
        // save app name
        $options->set( 'app_name', $request->input( 'app_name' ) );

        // save main user
        $this->user                 =   new User;
        $this->user->username       =   $request->input( 'username' );
        $this->user->email          =   $request->input( 'email' );
        $this->user->password       =   bcrypt( $request->input( 'password' ) );
        $this->user->role()->associate( Role::namespace( 'master' ) );
        $this->user->active         =   true;
        $this->user->save();

        // send email
        Mail::to( Role::namespace( 'master' )->user()->first() )
        ->send( new WelcomeMail );

        // Set Tendoo as installed
        DotenvEditor::load();
        DotEnvEditor::setKey( 'TENDOO_VERSION', config( 'app.version' ) );
        DotenvEditor::save();

        return redirect()->route( 'sign-in.index' );
    }
}
