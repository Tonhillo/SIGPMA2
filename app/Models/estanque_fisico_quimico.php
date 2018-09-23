<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class estanque_fisico_quimico
 * @package App\Models
 * @version February 15, 2018, 7:56 pm UTC
 *
 * @property integer id_estanque
 * @property integer id_fisicoQuimico
 * @property date fecha
 * @property time hora
 * @property string observacion
 */
class estanque_fisico_quimico extends Model
{
    use SoftDeletes;

    public $table = 'estanque_fisico_quimicos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_estanque',
        'id_fisicoQuimico',
        'fecha',
        'hora',
        'observacion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_estanque' => 'integer',
        'id_fisicoQuimico' => 'integer',
        'fecha' => 'date',
        'observacion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_estanque' => 'required',
        'id_fisicoQuimico' => 'required',
        'fecha' => 'required',
        'hora' => 'required',
        'observacion' => 'required'
    ];

    
}
