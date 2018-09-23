<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class observacion
 * @package App\Models
 * @version February 20, 2018, 12:03 am UTC
 *
 * @property string descripcion
 * @property date fecha
 */
class observacion extends Model
{
    use SoftDeletes;

    public $table = 'observacions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_estanque',
        'descripcion',
        'fecha',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_estanque' => 'integer',
        'descripcion' => 'string',
        'fecha' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_estanque' => 'required',
        'descripcion' => 'required',
        'fecha' => 'required',
    ];

    
}
