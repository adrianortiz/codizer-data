<?php

namespace App\Http\Controllers\Admin;

use App\Dvarchar;
use App\Form;
use App\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DvarcharController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $form = Form::findOrFail($id);

        // Columnas de los datos
        $dTitlesColums = DB::table('dvarchars')
            ->distinct()
            ->select('dtitle')
            ->where('form_id', $id)
            ->groupBy('input_id')
            ->get();


        // Filas de la tabla
        $dTitlesRows = DB::table('dvarchars')
            ->distinct()
            ->select('row_id')
            ->where('form_id', $id)
            ->groupBy('row_id')
            ->paginate(5);


        // CREAR ARRAY
        $arrayRows = array();
        foreach ($dTitlesRows as $dTitlesRow) {
            $arrayRows[] = Dvarchar::where('form_id', '=', $id)
                ->where('row_id', '=', $dTitlesRow->row_id)
                ->groupBy('input_id')
                ->get();
        }


        //dd($arrayRows);
        $numList = 1;
        $rowIdDelete = 0;
        return view('admin.colections.complements.listaDatos', compact('form', 'inputs', 'dTitlesColums', 'numList', 'dTitlesRows', 'arrayRows', 'rowIdDelete'));
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
        DB::update('update dvarchars set content = ? where id = ?', [ $request->input('content') , $id]);

        $message = 'Registro actualizado';

        if ($request->ajax()) {
            return response()->json([
                'message' => $message
            ]);
        }

        Session::flash('message', $message);
        return \Redirect::route('admin.colecciones.complements.listaDatos');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $input = Dvarchar::where('row_id', $id);
        $input->delete();

        $message = 'Registro eliminado';

        if ($request->ajax()) {
            return response()->json([
                'message' => $message
            ]);
        }

        Session::flash('message', $message);
        return \Redirect::route('admin.colecciones.complements.listaDatos');

    }


    /**
     * @param Request $request
     * @param $id = form_id
     */

    public function storeFormData(Request $request, $id)
    {
        // Generar un row_id para la fila de los datos a ingresar
        $newRowId = 1;

        $rowId = DB::table('dvarchars')
            ->where('form_id', $id)
            ->max('row_id');

        if ( !($rowId == 0 || empty($rowId) )) {
            $newRowId = $rowId + 1;
        }

        // Obtener datos
        $inputsID = $request->input('val_textx');
        $inputsNom = $request->input('val_texty');

        // Alamacenar datos
        $control = 0;

        if ($request->has('val_text')) {
            foreach ($request->input('val_text') as $val_text) {
                DB::table('dvarchars')->insert([
                    'dtitle' => $inputsNom[$control],
                    'content' => $val_text,
                    'form_id' => $id,
                    'input_id' => $inputsID[$control],
                    'row_id' => $newRowId,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]);
                $control++;
            }
        }



        $inputsID = $request->input('val_numx');
        $inputsNom = $request->input('val_numy');
        $control = 0;

        if ($request->has('val_num')) {
            foreach ($request->input('val_num') as $val_num) {
                DB::table('dvarchars')->insert([
                    'dtitle' => $inputsNom[$control],
                    'content' => $val_num,
                    'form_id' => $id,
                    'input_id' => $inputsID[$control],
                    'row_id' => $newRowId,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]);
                $control++;
            }
        }

        // echo dd($inputsID);

        // echo "<br>ID DE MI form_id ES: " . $id . "<br>Actual Row_id es: " . $rowId . "<br>Nuevo row_id es: " . $newRowId;

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

        $message = 'Datos almacenados';
        Session::flash('message', $message);
        return \Redirect::route('admin.colecciones.form.data.index', $id);
    }
}
