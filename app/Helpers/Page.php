<?php
namespace App\Helpers;

class Page
{
    /**
     * Page Title
     * @param string
     * @return void
    **/

    public static function title( $title, $subTitle = null )
    {
        // if a title is set, then we would probably want to enable it
        config([ 'page.show.title' => config( 'page.show.title', true ) ]);
        config([ 'page.title' => $title ]);
        config([ 'page.subTitle' => $subTitle ]);
    }

    /**
     * Filter Page for title tag
     * @param string page title
     * @return string
    **/

    public static function filterTitle( $title )
    {
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