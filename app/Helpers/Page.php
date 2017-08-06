<?php
namespace App\Helpers;

use App\Backend\Options;

class Page
{
    // Roles::users( 'master' );
    // Roles::all();
    // Roles::remove( 'master', 1 );
    // Roles::delete( 'master' );
    // Roles::delete( 1 );
    // Roles::delete([ 1, 2, 3 ]);
    // Roles::in( 'master' );
    // Roles::in( 'master' );
    // User::is( 'master' );
    // User::is( 'visitor' );
    // User::is( 'subriber' );
    // User::can( 'r@post' );
    // User::can( 'read@post' );
    // User::can( 'delete@post' );
    // User::can([ 'read@post', 'delete@post' ]);
    // User::can([ 'manage@post' ]);
    // User::cannot( 'read@post' );
    // Roles::permission( 'manage@post' ); // will create create@post, delete@post, update@post, read@post
    // Roles::permission( 'master', 'manage@post' );
    // Roles::permission( 'master', [ 'create@post', 'read@post' ]);
    // User::all( 'active' );
    // User::allRoles( 'master' );
    // User::allRoles( 'subscriber' );
    // User::all( 'never-logged' );
    // User::all( 'banned' );

    /**
     * Page Title
     * @param string
     * @return void
    **/

    public static function title( $title, $subTitle = null )
    {
        // if a title is set, then we would probably want to enable it
        config([ 'page.show.title' => config( 'page.show.title', true ) ]);
        config([ 'page.title' => sprintf( __( '%s &mdash; %s' ), $title, config( 'app.name' ) ) ]);
        config([ 'page.subTitle' => $subTitle ]);
    }

    /**
     * Filter Page for title tag
     * @param string page title
     * @return string
    **/

    public static function filterTitle( $title )
    {
        $options        =   app()->make( Options::class );

        if( !empty( $options->get( 'app_name' ) ) ) {
            return sprintf( '%s &rsaquo; %s &mdash; %s', $title, $options->get( 'app_name' ), config( 'app.name' ) );
        }

        return sprintf( '%s &rsaquo; %s', $title, config( 'app.name' ) );
    }

    /**
     * Disable something
     * @param string
     * @return void
    **/

    public static function config( $config )
    {
        $pageConfig             =   config( 'page' );
        foreach( $config as $namespace => $value ) {
            $strings        =   explode( '.', $namespace );
            if( count( $strings ) > 1 ) {
                // if column doesn't exists
                if( @pageConfig[ $strings[0] ] == null ) {
                    $pageConfig[ $strings[0] ]    =   [];
                }
                
                // set the column
                array_set( $pageConfig, $namespace, $value );
            }            
        }
        config([ 'page' => $pageConfig ]);
    }
}