<?php
Route::namespace( 'Modules\Todo\Http\Controllers' )->group(function(){
    Route::get( 'dashboard/foo', 'TodoController@index' );
});



