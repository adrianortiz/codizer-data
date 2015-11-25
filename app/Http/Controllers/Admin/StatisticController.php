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

        $columns = Input::where('form_id', $request->id)
                        ->where('type_validation', 'val_num')
                        ->orWhere('form_id', $request->id)
                        ->where('type_validation', 'val_double')
                        ->get();

        $columns->message = "Correcto";
        return response()->json(
            $columns->toArray()
        );

    }

    public function getDataColumns(Request $request)
    {

        /*
         * Grupos a graficar
         */
        $groups = 0;
        if($request->gruop > 1)
        {
            $groups = $request->gruop;
        }

        /*
         * Obtener datos en base al request
         */
        $arrayDataType = array();
        if ($request->has('title')) {
            foreach ($request->input('title') as $titleX) {
                $arrayDataType[] =  Dvarchar::select('dtitle', 'content', 'form_id')
                                    ->where('form_id', $request->form)
                                    ->where('dtitle', $titleX)
                                    ->get();
            }
        }

        // respuesta
        $res = null;
       // dd(Dvarchar::freq($arrayDataType[0]->all(),$groups),
         //   Dvarchar::width($arrayDataType[0]->all(),$groups));

        /*
         * GRAFICAR POR VARIABLE
         */
        if( $request->frecuencia == 'porvar'  )
            $res = Dvarchar::byVar($arrayDataType[0]->all());

        /*
         * GRAFICAR POR INTERVALO AUTOMATICO - HISTOGRAMA
         */
        if( $request->frecuencia == 'intervalAut' )
        {
            $res = Dvarchar::byAutoInterval($arrayDataType[0]->all(), $groups);
            $res[7] = 'byAutoInterval';
        }

        /*
         * GRAFICAR POR INTERVALO AUTOMATICO - OJIVA
         */
        if( $request->frecuencia == 'intervalAutOji' )
        {
            $res = Dvarchar::byAutoInterval($arrayDataType[0]->all(), $groups);
            $res[7] = 'intervalAutOji';
        }

        //
        if( $request->frecuencia == 'intervalAutDisp' )
        {
            $res = Dvarchar::byAutoInterval($arrayDataType[0]->all(), $groups);
            $res[7] = 'intervalAutDisp';
        }


        // RESPUESTA JSON PARA GRAFICAR
        return response()->json([
            // "media" => $media
            $res
        ]);

    }

    public function getPoints(Request $request) {

        if ($request->ajax()) {

            $x1 = $request->punto1X;
            $y1 = $request->punto1Y;
            $x2 = $request->punto2X;
            $y2 = $request->punto2Y;

            return response()->json([
                // "respuesta" => "Mi respuesta correcta"
                $request
            ]);
        }

        return null;
    }


}
