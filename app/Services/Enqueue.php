<?php
namespace App\Services;

class Enqueue 
{
     private $stylessheets         =    [];
     private $scripts              =    [];

     public function __construct()
     {

     }

     /**
      * Enqueue CSS
      * @param string style namespace,
      * @param string style path
      * @param array dependencies
      * @return void
     **/

     public function css( $name, $path, $deps )
     {
          foreach( $this->stylessheets as $name => $style ) {

          }
     }
}