<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dvarchar extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dvarchars';

    // protected $fillable = ['dtitle', 'content', 'form_id', 'input_id', 'val_text', 'val_textx', 'val_texty', 'val_num', 'val_numx', 'val_numy'];
    protected $fillable = ['dtitle', 'content', 'form_id', 'input_id', 'row_id', 'type_validation'];


    /**
     * Generate new row to new store data
     *
     * @param $idForm
     * @return int
     */
    static function getNewRowId($idForm)
    {
        $newRowId = 1;
        $rowId = \DB::table('dvarchars')
            ->where('form_id',$idForm)
            ->max('row_id');

        if ( !($rowId == 0 || empty($rowId) ))
            $newRowId = $rowId + 1;

        return $newRowId;
    }

    /**
     * Valida que el valor sea correcto
     * ['val_text', 'val_text_num', 'val_num', 'val_double', 'val_date']
     *
     * @param $typeValidation
     * @param $val_content
     * @return int
     */
    static function changeValToTypeValidation( $typeValidation , $val_content)
    {

        $val_content = ucwords($val_content);
        $val_content = ucwords(strtolower($val_content));

        if($typeValidation == 'val_text')
            return (string) $val_content;

        if($typeValidation == 'val_num')
            return (int) $val_content;

        if($typeValidation == 'val_double')
            return (double) $val_content;

        return $val_content;
    }

    /**
     * Store Data from Form of Collection
     *
     * @param $request
     * @param $id
     * @param $typeValidation
     * @param $newRowId
     */
    static function storeData( $request, $idForm, $typeValidation, $newRowId )
    {
        // Obtener datos
        $inputsID  = $request->input($typeValidation.'x');
        $inputsNom = $request->input($typeValidation.'y');

        $control = 0;

        // Alamacenar datos
        foreach ($request->input( $typeValidation ) as $val_content)
        {
            \DB::table('dvarchars')->insert([
                'dtitle'            => $inputsNom[$control],
                'content'           => Dvarchar::changeValToTypeValidation( $typeValidation , $val_content),
                'form_id'           => $idForm,
                'input_id'          => $inputsID[$control],
                'row_id'            => $newRowId,
                'type_validation'   => $typeValidation,
                'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'        => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            $control++;
        }
    }


    static function byVar( $datos )
    {

        $valRepetidos['categories'] = array();
        $series['data'] = array();
        foreach( array_count_values( Dvarchar::arrayDatosNum($datos) )  as $key => $value)
        {
            $valRepetidos['categories'][]   = (double) $key;
            $series['data'][]               = (double) $value;
        }

        $array[0] = $valRepetidos;
        $array[1] = 'Alumnos';
        $array[2] = $series;
        $array[3] = $datos[0]->dtitle;
        $array[4] = Dvarchar::media( $datos );

        return $array;
    }

    /**
     * @param $datos
     * @return array
     */
    static function arrayDatosNum( $datos ) {
        $array = array();
        foreach ($datos as $numerico) {
            $array[] = $numerico->content;
        }
        return $array;
    }

    /**
     * @param $datos
     * @return float
     */
    static function media($datos) {

        return array_sum( Dvarchar::arrayDatosNum($datos) ) / count( Dvarchar::arrayDatosNum($datos) );
    }
}
