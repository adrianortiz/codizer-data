<?php

namespace App\Http\Controllers\Admin;

use App\Dvarchar;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DvarcharController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store data form a newly created resource in storage.
     *
     * @param Request $request
     */

    public function storeFormData(Request $request, $id)
    {
        if ($request->has('val_text')) {
            foreach ($request->input('val_text') as $texto) {
                echo "Text: " . $texto . "<br>";
            }
        } else {
            echo "No hay Text :( ";
        }

        echo "<br>";

        if ($request->has('val_num')) {
            foreach ($request->input('val_num') as $numer) {
                echo "Num: " . $numer . "<br>";
            }
        } else {
            echo "No hay Num :( ";
        }

        /*
        $form = new Dvarchar($request->input('val_num')->all());
        $form->save();
        */


        /*
        $inputs = $request->all();

        $valor1 = "No Existe val_text";
        $valor2 = "No Existe val_num";

        foreach($inputs as $input) {

            if ($request->has('val_text')) {
                $valor1 = "Existe val_text: ";
            }

            if ($request->has('val_num')) {
                $valor2 = "Existe val_num: ";
            }
        }

        return $valor1 . " - ". $valor2;
        */
    }
}
