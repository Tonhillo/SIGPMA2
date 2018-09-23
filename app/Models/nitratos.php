<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class nitratos
 * @package App\Models
 * @version May 25, 2018, 8:00 pm UTC
 *
 * @property integer id_estanque
 * @property decimal valor
 * @property date fecha
 * @property time hora
 */
class nitratos extends Model
{
    use SoftDeletes;

    public $table = 'nitratos';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_estanque',
        'valor',
        'fecha',
        'hora'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_estanque' => 'integer',
        'fecha' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_estanque' => 'required|numeric',
        'valor' => 'required|numeric',
        'fecha' => 'required',
        'hora' => 'required'
    ];


}
