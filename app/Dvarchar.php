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

    protected $fillable = ['dtitle', 'content', 'form_id', 'input_id', 'val_text', 'val_textx', 'val_texty', 'val_num', 'val_numx', 'val_numy'];

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
