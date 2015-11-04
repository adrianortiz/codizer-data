<?php

namespace App\Http\Controllers\Admin;

use App\Dvarchar;
use App\Form;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $datos = Dvarchar::select('content')
            ->where('form_id', '1')
            ->where('dtitle', 'edad')
            ->first();

        $datos->edad2 = $datos->content * 2;
        $datos->nombreEdad = "Eres un puto";
        $datos->content = 'Mi edad es: = ' . $datos->content;

        /*
        foreach( $datos as $dato){
            $dato->edad2 = $dato->content * 2;
            echo $dato->content . '<br>';
            echo $dato->edad2 . '<br>';
        }*/

        dd($datos);

        /*
        $collections = Form::where('user_id', Auth::user()->id)->get();
        return view('admin.statistics.index', compact('collections'));*/
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show Columns from Collection selected
     *
     * @param Request $request
     * @param $id
     */
    public function showColums(Request $request, $id) {
        return "CONECTADO";
    }
}
