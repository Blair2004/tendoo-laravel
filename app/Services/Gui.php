<?php
namespace App\Services;

use App\Services\Options;
use Illuminate\Http\Request;

class Gui
{
    private $columns            =   [];
    private $validations        =   [];
    private $options            =   [];
    private $tabs               =   [];
    public  $config             =   [];
    public  $request;

    public function __construct( 
        Options $options
    )
    {
        $this->options      =   $options;
        $this->request      =   app()->make( Request::class );
    }

    /**
     * Set layout. must follow this form [ 'namespace.key'     =>  $value ]
     *
     * @param array config
     * @return void
    **/

    public function columns( $columns ) 
    {
        foreach( $columns as $namespace => $value ) {
            $strings        =   explode( '.', $namespace );
            if( count( $strings ) > 1 ) {
                // if column doesn't exists
                if( @$this->columns[ $strings[0] ] == null ) {
                    $this->columns[ $strings[0] ]    =   [ 'items' => [], 'action' => route( 'dashboard.options-save' ) ];
                }
                
                // set the column
                array_set( $this->columns, $namespace, $value );
            }            
        }
    }

    /**
     * Define Tabs
     * @param array [ 'tab.namespace', 'tab.title' ];
     * @return void
    **/

    public function tabs( $tabs ) 
    {
       foreach( $tabs as $namespace => $value ) {
            $strings        =   explode( '.', $namespace );
            if( count( $strings ) > 1 ) {
                // if column doesn't exists
                if( @$this->tabs[ $strings[0] ] == null ) {
                    $this->tabs[ $strings[0] ]    =   [ 'columns' => [] ];
                }
                
                // set the column
                array_set( $this->tabs, $namespace, $value );
            }            
        } 
    }

    /**
     * tabs Columns
     * add columns to tabs
     * @param string tab namespace
     * @param array column config
     * @return void
    **/

    public function tabsColumns( $tab_namespace, $config )
    {
        if( @$this->tabs[ $tab_namespace ] ) 
        {
            foreach( $config as $namespace => $value ) {
                $strings        =   explode( '.', $namespace );
                if( count( $strings ) > 1 ) {
                    // if column doesn't exists
                    if( @$this->tabs[ $tab_namespace ][ 'columns' ][ $strings[0] ] == null ) {
                        $this->tabs[ $tab_namespace ][ 'columns' ][ $strings[0] ]    =   [ 'items' => [], 'action' => route( 'dashboard.options-save' ) ];
                    }
                    
                    // set the column
                    array_set( $this->tabs[ $tab_namespace ][ 'columns' ], $namespace, $value );
                }            
            }
        }
    }

    /**
     * Get Tab
     * @return array tab
    **/

    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     * Gui Configuration
     * @param array tab title config [ 'title', 'subTitle' ]
     * @return void
    **/

    public function config( $config )
    {
        foreach( $config as $namespace => $value ) {
            $strings        =   explode( '.', $namespace );
            if( count( $strings ) > 1 ) {
                // if column doesn't exists
                if( @$this->config[ $strings[0] ] == null ) {
                    $this->config[ $strings[0] ]    =   [];
                }
                
                // set the column
                array_set( $this->config, $namespace, $value );
            }            
        } 
    }

    /**
     * Form namespace
     * @return string unique form namespace
    **/

    public function formNamespace( $namespace )
    {
        // if this form has a validation rule saved
        if( @$this->validations[ $namespace ] ) {
            $uniqueNamespace    =   str_random(20);
            $formNamespaces     =   ( array ) session( 'form-namespace' );

            // if some rules already exists
            if( ! is_array( @$formNamespaces[ url()->current() ] ) ) {
                $formNamespaces[ url()->current() ]     =   [];
            }

            // save validation rules
            $formNamespaces[ url()->current() ][ $namespace ]    =   [
                'rules'             =>  $this->validations[ $namespace ],
                'code'              =>  @$uniqueNamespace
            ];

            // saving form validation after render
            session([ 'form-namespace' =>   $formNamespaces ]);

            return $uniqueNamespace;
        } 
        return false;       
    }

    /**
     * Get columns
     * @param string column namespace
     * @return array
    **/

    public function getColumns( $namespace = null )
    {
        if( $namespace != null ) {
            return @$this->tabs[ $namespace ][ 'columns' ];
        }
        return $this->columns;
    }

    /**
     * Get Options
     * @return array
    **/

    public function getOptions()
    {
        return $this->options->get();
    }

    /**
     * Add item to a meta
     * @param string column namespace
     * @param array item config
     * @return void
    **/

    public function item( $namespace, $config )
    {
        if( @$config[ 'type' ] != null && @$this->columns[ $namespace ] != null ) {
            if( in_array( $config[ 'type' ], [ 'text', 'password', 'email', 'url', 'textarea' ]) && @$config[ 'name' ] != null ) {
                $this->columns[ $namespace ][ 'items' ][]    =   $config;
            } else if( $config[ 'type' ] == 'select' && @$config[ 'name' ] != null && @$config[ 'options' ] ) {
                $this->columns[ $namespace ][ 'items' ][]    =   $config;
            }
        }
    }

    /**
     * Tab item
     * add item to tab column
     * @param string tab namespace
     * @param string column namespace
     * @param array item config
     * @return void
    **/

    public function tabColumnItems( $tab_namespace, $namespace, $config )
    {
        if( @$this->tabs[ $tab_namespace ] ) {
            if( @$config[ 'type' ] != null && @$this->tabs[ $tab_namespace ][ 'columns' ][ $namespace ] != null ) {
                if( in_array( $config[ 'type' ], [ 'text', 'password', 'email', 'url', 'textarea' ]) && @$config[ 'name' ] != null ) {
                    $this->tabs[ $tab_namespace ][ 'columns' ][ $namespace ][ 'items' ][]    =   $config;
                } else if( $config[ 'type' ] == 'select' && @$config[ 'name' ] != null && @$config[ 'options' ] ) {
                    $this->tabs[ $tab_namespace ][ 'columns' ][ $namespace ][ 'items' ][]    =   $config;
                }
            }
        }        
    }

    /**
     * Render GUI view
     * @return void
    **/

    public function render( $view = 'column' )
    {
        if( $view == 'column' ) {
            Enqueue::css( 'myscript', 'foo/bar', [ 'dependencie' ]);
            return view( 'dashboard.gui.columns', [
                'gui'           =>  $this
            ]);
        } else if( $view == 'crm-table' ) {
            return view( 'dashboard.gui.components.' . $view, [
                'gui'           =>  $this
            ]);
        }        
    }

    /**
     * Save Validation Rules
     * @param array gui item
     * @return void
    **/

    public function saveValidationRules( $namespace, $item ) 
    {
        if( @$this->validations[ $namespace ] == null ) {
            $this->validations[ $namespace ]    =   [];
        }

        $this->validations[ $namespace ][ $item[ 'name' ] ]    =   $item[ 'validation' ];  
    }
}     