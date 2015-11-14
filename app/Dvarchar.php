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

    /**
     * @param $datos
     * @return float
     */
    static function mediana($datos){
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
    static function moda($datos){

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

    static function order($datos){
        $array = Dvarchar::arrayDatosNum($datos);
        $distinct = array_unique($array);
        sort($distinct);
        return $distinct;
    }

    static function range($datos){
        $order = Dvarchar::order($datos);
        return ($order[count($order) - 1] - $order[0]);
    }

    static function width($datos, $group){
        $range = Dvarchar::range($datos);

        $width = 0;
        for($i = 0; $i < $group; $i++){
            $width = $range--;
        }

        return $width;
    }

    static function f_group($datos, $group){
        $order = Dvarchar::order($datos);
        $width = Dvarchar::width($datos, $group);

        $f1 = $order[0] - 0.5;

        $fi = array();
        $ff = array();

        for($i = 0; $i < $group; $i++){
            $fi[$i] = $f1;
            $f1 = $f1 + $width;
            $ff[$i] = $f1;
        }

        return $f_group = array(0 => $fi, 1 => $ff);
    }

    static function marca($datos, $group){
        $groups = Dvarchar::width($datos, $group);
        $f_group = Dvarchar::f_group($datos, $group);

        $marca = array();
        for($i = 0; $i < $group; $i++){
            $f_group[0][$i] = $f_group[0][$i] + ($groups / 2);
            $marca[$i] = $f_group[0][$i];
        }

        return $marca;
    }
    static function freq($datos, $group){
        $f_group = Dvarchar::f_group($datos, $group);
        $array = Dvarchar::arrayDatosNum($datos);
        sort($array);

        $count = array();
        $acum=0;

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

    static function freqacum($datos, $group){
        $freq = Dvarchar::freq($datos, $group);

        $freqacum = array();
        $freqacum[] = $freq[0];

        for($i = 1; $i < $group; $i++){
            $freqacum[] = $freqacum[$i - 1] + $freq[$i];
        }

        return $freqacum;
    }

    static function desvm($datos, $group){
        $marca = Dvarchar::marca($datos, $group);
        $media = Dvarchar::media($datos);
        $freq = Dvarchar::freq($datos, $group);

        $desvm = array();
        for($i = 0; $i < $group; $i++){
            $desvm[] = $marca[$i] - $media;
            $desvm[$i] = $desvm[$i] * $freq[$i];
            $desvm[$i] = abs($desvm[$i]);
        }

        return array_sum($desvm) / array_sum($freq);
    }

    static function desves($datos, $group){
        $marca = Dvarchar::marca($datos, $group);
        $media = Dvarchar::media($datos);
        $freq = Dvarchar::freq($datos, $group);

        $deses = array();
        for($i = 0; $i < $group; $i++){
            $deses[] = ($marca[$i] - $media)^2;
            $deses[$i] = $deses[$i] * $freq[$i];
            $deses[$i] = abs($deses[$i]);
        }

        return sqrt( array_sum($deses) / array_sum($freq) );
    }

    static function varianza($datos, $group){
        $marca = Dvarchar::marca($datos, $group);
        $media = Dvarchar::media($datos);
        $freq = Dvarchar::freq($datos, $group);

        $varz = array();
        for($i = 0; $i < $group; $i++){
            $varz[] = ($marca[$i] - $media)^2;
            $varz[$i] = $varz[$i] * $freq[$i];
        }

        return array_sum($varz) / array_sum($freq);
    }

    static function deciles($datos, $group){
        $freq = Dvarchar::freq($datos, $group);
        $f_group = Dvarchar::f_group($datos, $group);
        $width = Dvarchar::width($datos, $group);
        $freqacum = Dvarchar::freqacum($datos, $group);


    }

    static function percentiles($datos, $group){
        $freq = Dvarchar::freq($datos, $group);
        $f_group = Dvarchar::f_group($datos, $group);
        $width = Dvarchar::width($datos, $group);
        $freqacum = Dvarchar::freqacum($datos, $group);


    }

    static function cuartiles($datos, $group){
        $freq = Dvarchar::freq($datos, $group);
        $f_group = Dvarchar::f_group($datos, $group);
        $width = Dvarchar::width($datos, $group);
        $freqacum = Dvarchar::freqacum($datos, $group);


    }

    static function mo($datos, $group){
        $freq = Dvarchar::freq($datos, $group);
        $marca = Dvarchar::marca($datos, $group);
        $media = Dvarchar::media($datos);

        $sum = array();
        $mo = array();
        for($i = 0; $i < 3; $i++){
            for($j = 0; $j < $group; $j++) {
                $sum[$i][] = pow($marca[$j] - $media, $i + 2) * $freq[$j];
                $mo[$i] = array_sum($sum[$i]) / array_sum($freq);
            }
        }

        return $mo;
    }

    static function sesgomo($datos, $group){
        $media = Dvarchar::media($datos);
        $moda = Dvarchar::moda($datos);
        $desves = Dvarchar::desves($datos, $group);

        return ($media - $moda) / $desves;
    }

    static function sesgomediana($datos, $group){
        $media = Dvarchar::media($datos);
        $mediana = Dvarchar::mediana($datos);
        $desves = Dvarchar::desves($datos, $group);

        return 3 * ($media - $mediana) / $desves;

    }

    static function sesgoa($datos, $group){
        $mo = Dvarchar::mo($datos, $group);
        $desves = Dvarchar::desves($datos, $group);

        return $mo[1] / pow($desves, 3);
    }

    static function curtosisa($datos, $group){
        $mo = Dvarchar::mo($datos, $group);
        $desves = Dvarchar::desves($datos, $group);

        $curtosisa=array();
        $res = $mo[2] / pow($desves, 4);
        if($res == 3){
            $curtosisa = array('Mesocurtica' => $res);
        }elseif($res > 3){
            $curtosisa = array('Leptocurtica' => $res);
        }elseif($res < 3){
            $curtosisa = array('Platicurtica' => $res);
        }

        return $curtosisa;
    }


}
