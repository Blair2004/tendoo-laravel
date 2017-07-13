<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/dashboard', 'DashboardController@index' );
Route::get( '/dashboard/modules', 'DashboardController@modules' );
Route::get( '/dashboard/settings', 'DashboardController@settings' );
Route::get( '/dashboard/users', 'DashboardController@users' );
Route::get( '/dashboard/about', 'DashboardController@about' );
Route::get( '/dashboard/update', 'DashboardController@update' );
Route::get( '/dashboard/store', 'DashboardController@store' );
Route::get( '/dashboard/options', 'DashboardController@options' );

Route::get( '/sign-in/{page?}', 'SigninController@index' );