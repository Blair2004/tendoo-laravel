<?php

use Illuminate\Foundation\Inspiring;
use App\Backend\Options;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command( 'options:list', function( Options $options ){
    $all    =   $options->get();
    $this->table([ 'id', 'key', 'value', 'array', 'created at', 'updated at'], $all );
})->describe( 'List all options.' );

Artisan::command( 'options:get {key}', function( Options $options ) {
    $all    =   $options->get( $this->argument( 'key' ) );
    if( ! empty( $all ) ) {
        if( ! is_array( $all ) ) {
            return $this->line( sprintf( '=> %s', $all ) );
        } else {
            // if result is an array
            $entries          =   [];
            foreach( $all as $index => &$entry ) {
                $entries[]    =   [
                    'index'     =>  $index,
                    'key'       =>  $this->argument( 'key' ),
                    'value'     =>  $entry
                ];
            }
            return $this->table([ 'index', 'key', 'value' ], $entries );
        }        
    } 
    $this->info( sprintf( 'the key "%s" is not set', $this->argument( 'key' ) ) ); 
})->describe( 'Get option(s) for a specific key.' );

Artisan::command( 'options:set {key} {--v=}', function( Options $options ){
    $options->set( $this->argument( 'key' ), $this->option( 'v' ) );
    $this->info( sprintf( 'The option "%s" has been saved', $this->argument( 'key' ) ) );
})->describe( 'set option. Update simple option and push new for array.' );

Artisan::command( 'options:delete {key}', function( Options $options ) {
    $all    =   $options->delete( $this->argument( 'key' ) );
    $this->info( sprintf( 'The option "%s" has been deleted', $this->argument( 'key' ) ) );
})->describe( 'delete option. can use index to delete a specific option from array.' );
