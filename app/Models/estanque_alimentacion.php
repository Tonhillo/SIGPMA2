<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class estanque_alimentacion
 * @package App\Models
 * @version February 16, 2018, 1:21 am UTC
 *
 * @property integer id_estanque
 * @property integer id_alimento
 * @property date fecha_alimentacion
 * @property time hora_alimentacion
 * @property decimal peso
 * @property integer porcentaje
 */
class estanque_alimentacion extends Model
{
    use SoftDeletes;

    public $table = 'estanque_alimentacions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_estanque',
        'id_alimento',
        'fecha_alimentacion',
        'hora_alimentacion',
        'peso',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_estanque' => 'integer',
        'id_alimento' => 'integer',
        'fecha_alimentacion' => 'date',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_estanque' => 'required',
        'id_alimento' => 'required',
        'fecha_alimentacion' => 'required',
        'hora_alimentacion' => 'required',
        'peso' => 'required',
    ];

    
}
