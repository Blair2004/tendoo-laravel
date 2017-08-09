<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Boot;
use App\Services\Page;

class ErrorsController extends Controller
{
    public function __construct( 
        Boot $boo 
    ){}

    public function index( $code )
    {
        Page::title( __( 'Errors' ) );
        return view( 'errors.index', compact( 'code' ) );
    }
}
