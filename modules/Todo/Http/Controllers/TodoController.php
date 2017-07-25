<?php

namespace Modules\Todo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Helpers\Page;
use App\Backend\Menus;
use App\Backend\Notices;

class TodoController extends Controller
{
    public function __construct( Menus $menus )
    {
        Menus::add( 'todo.index', [
            'url'   =>  url( 'dashboard/todo' ),
            'text'  =>  'My Todo',
            'icon'  =>  'la la-home'
        ])->before( 'modules' );

        Menus::add( 'todo.boo', [
            'url'   =>  url( 'dashboard/todo' ),
            'text'  =>  'Bar',
            'icon'  =>  'la la-home'
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('todo::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('todo::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('todo::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('todo::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
