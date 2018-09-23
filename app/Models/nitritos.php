<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class nitritos
 * @package App\Models
 * @version May 25, 2018, 7:58 pm UTC
 *
 * @property integer id_estanque
 * @property integer valor
 * @property date fecha
 * @property time hora
 */
class nitritos extends Model
{
    use SoftDeletes;

    public $table = 'nitritos';


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
        'valor' => 'integer',
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
