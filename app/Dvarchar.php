<?php

namespace App;

use Carbon\Carbon;
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


    /**
     * @param $datos
     * @return mixed
     */
    static function byVar( $datos )
    {
        $valRepetidos['categories'] = array();
        $series['data'] = array();
        foreach( array_count_values( Dvarchar::arrayDatosNum($datos) )  as $key => $value)
        {
            $valRepetidos['categories'][]   = (float) $key;
            $series['data'][]               = (float) $value;
        }

        $array[0] = $valRepetidos;
        $array[1] = 'Alumnos';
        $array[2] = $series;
        $array[3] = $datos[0]->dtitle;
        $array[4] = Dvarchar::media( $datos );
        $array[5] = Dvarchar::mediana($datos);
        $array[6] = Dvarchar::moda($datos);
        $array[7] = 'byVar';

        return $array;
    }


    /**
     * @param $datos
     * @param $group
     * @return mixed
     */
    static function byAutoInterval( $datos, $group )
    {
        $intervalo = array();
        for($i = 0; $i < $group; $i++){
            $intervalo[] = Dvarchar::f_group($datos, $group)[0][$i] . " - " . Dvarchar::f_group($datos, $group)[1][$i];
        }

        $array[1] = 'Alumnos';
        $array[3] = $datos[0]->dtitle; // Name columna

        $array[4] = $intervalo;
        $array[5] = Dvarchar::densidad($datos, $group);
        $array[6] = Dvarchar::freqacum($datos, $group);
        $array[8] = Dvarchar::freq($datos, $group);
        return $array;
    }

    /**
     * Obtener datos y ordenarlos de menor a mayor
     * @param $datos
     * @return array
     */
    static function arrayDatosNum( $datos )
    {

        $array = array();
        foreach ($datos as $numerico) {
            $array[] = $numerico->content;
        }

        /**
         * Ordenar de menor a mayor
         */
        sort($array);
        return $array;
    }

    /**
     * @param $datos
     * @return float
     */
    static function media($datos)
    {
        return array_sum( Dvarchar::arrayDatosNum($datos) ) / count( Dvarchar::arrayDatosNum($datos) );
    }

    /**
     * @param $datos
     * @return float
     */
    static function mediana($datos)
    {
        $array = Dvarchar::arrayDatosNum($datos);
        sort($array);

        $N = count($array);
        $div = $N / 2;

        if($N % 2 == 0){
            return ($array[$div - 1] + $array[$div]) / 2;
        }else{
            return $array[$div - 1];
        }
    }

    /**
     * @param $datos
     * @return mixed|string
     */
    static function moda($datos)
    {
        $control = 0;

        foreach( array_count_values(Dvarchar::arrayDatosNum($datos)) as $dato) {
            if($dato >= 1) {
                $control = $control+1;
            }
        }

        if( $control == 0)
        {
            $moda   =  array_count_values(Dvarchar::arrayDatosNum($datos));
            arsort($moda);
            return key($moda);

        }else{
                return "No hay moda";
        }

    }

    /**
     * @param $datos
     * @return array
     */
    static function order($datos)
    {
        $array = Dvarchar::arrayDatosNum($datos);
        $distinct = array_unique($array);
        sort($distinct);
        return $distinct;
    }

    /**
     * @param $datos
     * @return mixed
     */
    static function range($datos)
    {
        $order = Dvarchar::order($datos);
        return ($order[count($order) - 1] - $order[0]) + 1;
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function width($datos, $group)
    {
        return ceil(Dvarchar::range($datos) / $group);
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function f_group($datos, $group)
    {
        $f1 = Dvarchar::order($datos)[0] - 0.5;

        $fi = array();
        $ff = array();

        for($i = 0; $i < $group; $i++){
            $fi[$i] = $f1;
            $f1 = $f1 + Dvarchar::width($datos, $group);
            $ff[$i] = $f1;
        }

        return $f_group = array(0 => $fi, 1 => $ff);
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function marca($datos, $group)
    {
        $f_group = Dvarchar::f_group($datos, $group);
        $marca = array();
        for($i = 0; $i < $group; $i++){
            $f_group[0][$i] = $f_group[0][$i] + (Dvarchar::width($datos, $group) / 2);
            $marca[] = $f_group[0][$i];
        }
        return $marca;
    }

    /**
     * @param $datos
     * @return int
     */
    static function limit($datos)
    {
        $limit = 0;
        for($i = 1; $i <= 15; $i++){
            if((Dvarchar::range($datos) / $i) >= 1){
                $limit = $i;
            }
        }
        return $limit;
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function freq($datos, $group)
    {
        $f_group = Dvarchar::f_group($datos, $group);
        $array = Dvarchar::arrayDatosNum($datos);
        sort($array);

        $count = array();
        $acum = 0;

        for($i = 0; $i < $group; $i++){
            for($j = 0; $j < count($array); $j++){
                if( $array[$j] > $f_group[0][$i] && $array[$j] < $f_group[1][$i] ){
                    $acum = $acum + 1;
                    $count[$i][] = $acum;
                }else{
                    $acum =0;
                    $count[$i][] = $acum;
                }
            }
        }

        $freq = array();

        for($i = 0; $i < $group; $i++){
            $freq[] = count(array_unique($count[$i])) - 1;
        }

        return $freq;
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function freqacum($datos, $group)
    {
        $freqacum[] = Dvarchar::freq($datos, $group)[0];
        for($i = 1; $i < $group; $i++){
            $freqacum[] = $freqacum[$i - 1] + Dvarchar::freq($datos, $group)[$i];
        }
        return $freqacum;
    }

    static function densidad($datos, $group){
        $densidad = array();
        for($i = 0; $i < $group; $i++){
            $densidad[] = Dvarchar::freq($datos, $group)[$i] / Dvarchar::width($datos, $group);
        }
        return $densidad;

    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function desvm($datos, $group)
    {
        $desvm = array();
        for($i = 0; $i < $group; $i++){
            $desvm[] = Dvarchar::marca($datos, $group)[$i] - Dvarchar::media($datos);
            $desvm[$i] = $desvm[$i] * Dvarchar::freq($datos, $group)[$i];
            $desvm[$i] = abs($desvm[$i]);
        }
        return array_sum($desvm) / array_sum(Dvarchar::freq($datos, $group));
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function desves($datos, $group)
    {
        $deses = array();
        for($i = 0; $i < $group; $i++){
            $deses[] = (Dvarchar::marca($datos, $group)[$i] - Dvarchar::media($datos))^2;
            $deses[$i] = $deses[$i] * Dvarchar::freq($datos, $group)[$i];
            $deses[$i] = abs($deses[$i]);
        }
        return sqrt( array_sum($deses) / array_sum(Dvarchar::freq($datos, $group)) );
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function varianza($datos, $group)
    {
        $varz = array();
        for($i = 0; $i < $group; $i++){
            $varz[] = (Dvarchar::marca($datos, $group)[$i] - Dvarchar::media($datos))^2;
            $varz[$i] = $varz[$i] * Dvarchar::freq($datos, $group)[$i];
        }
        return array_sum($varz) / array_sum(Dvarchar::freq($datos, $group));
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function mo($datos, $group)
    {
        $mo = array();
        for($i = 0; $i < 3; $i++){
            for($j = 0; $j < $group; $j++) {
                $sum[$i][] = pow(Dvarchar::marca($datos, $group)[$j] - Dvarchar::media($datos), $i + 2) *
                    Dvarchar::freq($datos, $group)[$j];
                $mo[$i] = array_sum($sum[$i]) / array_sum(Dvarchar::freq($datos, $group));
            }
        }
        return $mo;
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function sesgomo($datos, $group)
    {
        return (Dvarchar::media($datos) - Dvarchar::moda($datos)) / Dvarchar::desves($datos, $group);
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function sesgomediana($datos, $group)
    {
        return 3 * (Dvarchar::media($datos) - Dvarchar::mediana($datos)) / Dvarchar::desves($datos, $group);
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function sesgoa($datos, $group)
    {
        return Dvarchar::mo($datos, $group)[1] / pow(Dvarchar::desves($datos, $group), 3);
    }

    /**
     * @param $datos
     * @param $group
     * @return array|null|string
     */
    static function curtosisa($datos, $group)
    {
        $curtosisa=null;
        $res = Dvarchar::mo($datos, $group)[2] / pow(Dvarchar::desves($datos, $group), 4);
        if($res == 3){
            $curtosisa = 'Mesocurtica = ' . $res;
        }elseif($res > 3){
            $curtosisa = array('Leptocurtica = ' . $res);
        }elseif($res < 3){
            $curtosisa = array('Platicurtica = ' . $res);
        }
        return $curtosisa;
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function minimoscuadrados($datos, $group)
    {
        $sumXY = array();
        $sumXsquare = array();

        for($i = 0; $i < $group; $i++){
            $sumXY[] = Dvarchar::f_group($datos, $group)[0][$i] * Dvarchar::freq($datos, $group)[$i];
            $sumXsquare[] = pow(Dvarchar::f_group($datos, $group)[0][$i], 2);
        }

        $dA = ($group * array_sum($sumXsquare)) - pow(array_sum(Dvarchar::f_group($datos, $group)[0]), 2);
        $da0 = (array_sum(Dvarchar::freq($datos, $group)) * array_sum($sumXsquare)) -
            (array_sum($sumXY) * array_sum(Dvarchar::f_group($datos, $group)[0]));
        $da1 = ($group * array_sum($sumXY)) -
            (array_sum(Dvarchar::f_group($datos, $group)[0]) * array_sum(Dvarchar::freq($datos, $group)));

        return $minimoscuadrados = array('a0' => $da0 / $dA, 'a1' => $da1 / $dA);
    }
}
