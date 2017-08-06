<?php
namespace App\Backend;

use App\Option;

class Options 
{
    private $rawOptions         =   [];
    private static $options     =   [];

    public function __construct()
    {
        $this->rawOptions   =    Option::all();
        $this->build();
    }

    /**
     * Build
     * Build option array
     * @return void
    **/

    public function build()
    {
        self::$options                  =   [];
        foreach( $this->rawOptions as $option ) {
            if( @self::$options[ $option[ 'key' ] ] == null ) {
                if( ( bool ) $option[ 'array' ] ) {
                    self::$options[ $option[ 'key' ] ]      =   [ $option[ 'value' ] ];
                } else {
                    self::$options[ $option[ 'key' ] ]      =   $option[ 'value' ];
                }               
            } else {
                // if value has yet been saved, then well consider it as an array
                if( ! is_array( self::$options[ $option[ 'key' ] ] ) ) {
                    $temp   =   self::$options[ $option[ 'key' ] ];
                    unset( self::$options[ $option[ 'key' ] ] );
                    self::$options[ $option[ 'key' ] ]      =   [ $temp ];
                } else {
                    self::$options[ $option[ 'key' ] ][]    =   $option[ 'value' ];
                }
            }   
        }
    }

    /**
     * Get Raw Options
     * @return array;
    **/

    public function raw()
    {
        return $this->rawOptions;
    }

    /**
     * Set Option
     * @param string key
     * @param any value
     * @param boolean force set
     * @return void
    **/

    public function set( $key, $value, $isArray = false )
    {
        // check if we're pushing array value
        $bracket    =   substr( $key, -2 );

        if( $bracket == '[]' ) {
            // reassign key value
            $key        =   substr( $key, 0, -2 );
            $option     =   Option::key( $key );

            // Fetch if item already exists
            if( $option ) {
                // if option is an array
                if( ! $option[ 'array' ] ) {
                    Option::where( 'id', $option[ 'id' ] )->update([
                        'value'     =>  $value
                    ]);
                } else {
                    $option             =   $option->toArray();
                    $newOption          =   new Option;
                    $newOption->key     =   strtolower( $option[ 'key' ] );
                    $newOption->value   =   $value;
                    $newOption->array   =   $option[ 'array' ];
                    $newOption->save();
                }
                
            } else {
                $this->__save( $key, $value, true );
            }

        } else if( preg_match( '/(.*)\[(\d)\]/', $key, $result ) && ! is_array( $value ) ) {
            // get all array for this input
            $options    =   Option::Allkeys( $result[1] );

            if( $options ) {
                foreach( $options->toArray() as $index => $option ) {
                    // We'll update an index
                    if( $index == $result[2] ) {
                        $_option    =   Option::where( 'id', $option[ 'id' ] )->update([
                            'value' =>  $value
                        ]);
                    }
                }
                return true;
            }
            return false;

        } else {
            $this->__save( $key, $value, $isArray );
        }
        
        return self::$options[ $key ];
    }

    private function __save( $key, $value, $isArray = false )
    {
        $value      =   empty( $value ) ? '' : $value;
        // if options is an array, we should then save it as multiple instance
        if( is_array( $value ) ) {
            foreach( $value as $val ) {
                $this->option           =   new Option;
                $this->option->key      =   trim( strtolower( $key ) );
                $this->option->value    =   empty( $val ) ? '' : $val;
                $this->option->array    =   true;
                $this->option->save();
            }

        } else {
            // if option already exists, we'll just update it
            $option       =   Option::key( $key );
            if( $option ) {
                Option::where( 'key', $key )->update([
                    'value'     =>  $value
                ]);
            } else {
                // if option doesn't exist, we'll just
                $this->option               =   new Option;
                $this->option->key          =   trim( strtolower( $key ) );
                $this->option->value        =   $value;
                $this->option->array        =   $isArray;
                $this->option->save();
            }
            self::$options[ $key ]      =   $value;
        }
    }

    /**
     * Get options
     * @param string key
     * @return any
    **/

    public function get( $key = null )
    {
        if( preg_match( '/(.*)\[(\d)\]/', $key, $result ) ) {
            if( @self::$options[ $result[1] ] != null ) {
                return self::$options[ $result[1] ][ $result[2] ];
            }
        } else if( @self::$options[ $key ] != null ) {
            // if key doesn't exist on the array, we just take it from the database
            // if( $key != null ) {
            //     return Option::allKeys( trim( $key ) );
            // } 
            return @self::$options[ $key ];
        }

        if( $key == null ) {
            return self::$options;
            // return Option::all();
        }
        return null;        
    }

    /**
     * Delete Key
     * @param string key
     * @return Eloquent Model Result
    **/

    public function delete( $key ) 
    {
        if( preg_match( '/(.*)\[(\d)\]/', trim( $key ), $result ) ) {
            // get all array for this input
            $options    =   Option::Allkeys( $result[1] );

            if( $options ) {
                foreach( $options->toArray() as $index => $option ) {
                    // We'll update an index
                    if( $index == $result[2] ) {
                        Option::where( 'id', $option[ 'id' ] )->delete();
                    }
                }
                return true;
            }
            return false;

        } else {
            return Option::where( 'key', $key )->delete();
        }        
    }

}