<?php
namespace App\Services;

class Enqueue 
{
     private static $stylesheets             =    [];
     private static $scripts                 =    [
          'onFooter'       =>   [],
          'onHeader'       =>   []
     ];
     private static $bowerScripts            =    [
          'onFooter'       =>   [],
          'onHeader'       =>   []
     ];
     private static $bowerStylesheets         =    [];

     public function __construct()
     {

     }

     /**
      * Enqueue CSS
      * @param string style namespace,
      * @param string style url
      * @param array dependencies
      * @return void
     **/

     public static function css( $name, $url, array $deps = [] )
     {
          self::$stylesheets[ $name ]        =    compact( 'name', 'url', 'deps' );
     }

     /**  
      * Load CSS
      * @return array css files
     **/

     public static function getStylesheets()
     {
          $final_assets       =    [];
          // put assets which doesn't require dependencies
          foreach( self::$stylesheets as $style ) {
               if( count( $style[ 'deps' ] ) == 0 ) {
                    array_unshift( $final_assets, $style );
               } else {
                    $final_assets[]          =    $style;
               }
          }

          return $final_assets;
     }

     public static function js( $name, $url, array $deps = [], $place )
     {
          if( @self::$scripts[ $place ] != null ) {
               self::$scripts[ $place ][ $name ]        =    compact( 'name', 'url', 'deps' );
          }          
     }

     /**  
      * Load CSS
      * @return array css files
     **/

     public static function getScripts( $location )
     {
          $final_assets       =    [];
          // put assets which doesn't require dependencies
          foreach( self::$scripts[ $location ] as $script ) {
               if( count( $script[ 'deps' ] ) == 0 ) {
                    array_unshift( $final_assets, $script );
               } else {
                    $final_assets[]          =    $script;
               }
          }

          return $final_assets;
     }

     /**
      * Enqueue Footer JS
      * @param string code name
      * @param string url
      * @param array dependencies
      * @return void
     **/

     public static function footerJS( $name, $url, array $deps = [] )
     {
          self::$scripts[ 'onFooter' ][ $name ]        =    compact( 'name', 'url', 'deps' );
     }

     /**
      * Bower CSS
      * @param string code name
      * @param string url
      * @return void
     **/

     public static function bowerCSS( $name, $url )
     {
          self::$bowerStylesheets[ $name ]        =    compact( 'name', 'url' );
     }

     /**
      * Get Bower CSS
      * @return array
     **/

     public static function getBowerStylesheets()
     {
          return self::$bowerStylesheets;
     }

     /**
      * Bower Script
      * @param string code name
      * @param string url
      * @return void
     **/

     public static function bowerJS( $name, $url, $location = 'onFooter' )
     {
          self::$bowerScripts[ $location ][ $name ]        =    compact( 'name', 'url' );
     }

     /**
      * Get Bower CSS
      * @return array
     **/

     public static function getBowerScripts( $location )
     {
          return self::$bowerScripts[ $location ];
     }
}