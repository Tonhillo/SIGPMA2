<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class desobe
 * @package App\Models
 * @version February 9, 2018, 3:40 am UTC
 *
 * @property integer num_huevos_total
 * @property integer num_huevos_no_viables
 * @property integer num_huevos_viables
 * @property decimal porcentaje_viabilidad
 * @property decimal diametro_huevo
 * @property decimal diametro_gota
 */
class desobe extends Model
{
    use SoftDeletes;

    public $table = 'desobes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'num_huevos_total',
        'num_huevos_no_viables',
        'num_huevos_viables',
        'porcentaje_viabilidad',
        'diametro_huevo',
        'diametro_gota',
        'fecha',
        'hora',
        'id_estanque'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'num_huevos_total' => 'integer',
        'num_huevos_no_viables' => 'integer',
        'num_huevos_viables' => 'integer',
        'fecha' => 'date',
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'num_huevos_total' => 'required',
        'num_huevos_no_viables' => 'required',
        'num_huevos_viables' => 'required',
        'porcentaje_viabilidad' => 'required',
        'diametro_huevo' => 'required',
        'diametro_gota' => 'required',
        'fecha' => 'required',
        'hora' => 'required',
        'id_estanque' => 'required'
    ];

    
}
