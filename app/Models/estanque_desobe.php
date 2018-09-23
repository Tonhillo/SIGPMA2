<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class estanque_desobe
 * @package App\Models
 * @version February 19, 2018, 11:32 pm UTC
 *
 * @property integer id_estanque
 * @property integer id_desobe
 * @property date fecha
 * @property string descripcion
 */
class estanque_desobe extends Model
{
    use SoftDeletes;

    public $table = 'estanque_desobes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_estanque',
        'id_desobe',
        'fecha',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_estanque' => 'integer',
        'id_desobe' => 'integer',
        'fecha' => 'date',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_estanque' => 'required',
        'id_desobe' => 'required',
        'fecha' => 'required',
        'descripcion' => 'required'
    ];

    
}
