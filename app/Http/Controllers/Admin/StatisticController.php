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
            $groups = $request->gruop;


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







        /**
         * STATISTICS EXTRAS
         */
        if ($request->has('extra')) {

            // RESPUESTA JSON PARA GRAFICAR
            return response()->json([
                "msg" => "Controller say OK"
            ]);

        }



        /*
         * STATISTICS 2 COLUMS
         */
        if ( $request->num_colums >= 2 ) {


            $valRepetidos['value'] = array();
            $series['label'] = array();

            $ordenados = Dvarchar::arrayDatosNum($arrayDataType[0]);

            foreach( $ordenados  as $key => $ordenado)
            {
                $valRepetidos['label'][] = $ordenado;

                $hola = null;
                foreach( $arrayDataType[0]->all()  as $keyB => $desordenado)
                {
                    if( $ordenado == $desordenado['content'] )
                        $hola = $arrayDataType[1][$keyB]->content;
                }

                $series['label'][] = $hola;

            }

            $array[0] = $valRepetidos;
            $array[1] = $series;


            dd( $array );

            // RESPUESTA JSON PARA GRAFICAR
            return response()->json([
                "msg" => "COLUMNOS 2 says OK"
            ]);

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

            $y1 = $request->punto1X;
            $x1 = $request->punto1Y;
            $y2 = $request->punto2X;
            $x2 = $request->punto2Y;

            return response()->json([
                // "respuesta" => "Mi respuesta correcta"
                Dvarchar::puntos_selectos($x1,$y1, $x2,$y2)
            ]);
        }

        return null;
    }
}
