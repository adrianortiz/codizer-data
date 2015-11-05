<?php

namespace App\Http\Controllers\Admin;

use App\Dvarchar;
use App\Form;
use App\Input;
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
        $collections = Form::where('user_id', Auth::user()->id)->get();
        return view('admin.statistics.index', compact('collections'));
    }



    /**
     * Show Columns from Collection selected
     *
     * @param Request $request
     */
    public function showColums(Request $request) {

        $columns = Input::where('form_id', $request->id)->get();
        $columns->message = "Correcto";
        return response()->json(
            $columns->toArray()
        );

    }

    public function getDataColumns(Request $request) {

        // $titlesColumns = $request->input('title');
        // dd($titlesColumns, $request->frecuencia);

        $arrayDataType = array();
        if ($request->has('title')) {
            foreach ($request->input('title') as $titleX) {
                $arrayDataType[] =  Dvarchar::select('content')
                                    ->where('form_id', $request->form)
                                    ->where('dtitle', $titleX)
                                    ->get();
            }
        }

        return response()->json(
            $arrayDataType[0]->toArray()
        );

        dd($request->all());
        dd($arrayDataType[0]->toArray()[0]);  // dd( $request->all());


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


}