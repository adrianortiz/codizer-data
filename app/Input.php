<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Input
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $title
 * @property string $type_validation
 * @property string $type_input
 * @property string $description
 * @property integer $form_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Input whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Input whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Input whereTypeValidation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Input whereTypeInput($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Input whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Input whereFormId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Input whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Input whereUpdatedAt($value)
 */
class Input extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inputs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'type_validation', 'type_input', 'form_id', 'description'];
}
