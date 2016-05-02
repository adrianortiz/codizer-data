<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Form
 *
 * @property-read mixed $title
 * @property-read mixed $title_and_desc
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $user_id
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Form whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Form whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Form whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Form whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Form whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Form whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Form whereUpdatedAt($value)
 */
class Form extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forms';


    protected $fillable = ['name', 'description', 'user_id'];
    protected $hidden = ['remember_token'];

    /*
     * Lógica de las colecciones
     */
    public function getTitleAttribute()
    {
        return $this->name;
    }

    public function getTitleAndDescAttribute()
    {
        return $this->name . ' ' . $this->description;
    }
}
