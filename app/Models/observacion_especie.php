<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class observacion_especie
 * @package App\Models
 * @version February 20, 2018, 12:46 am UTC
 *
 * @property integer id_especie
 * @property integer id_observacion
 */
class observacion_especie extends Model
{
    use SoftDeletes;

    public $table = 'observacion_especies';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_especie',
        'id_observacion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_especie' => 'integer',
        'id_observacion' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_especie' => 'required',
        'id_observacion' => 'required'
    ];

    
}
