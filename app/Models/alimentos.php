<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class alimentos
 * @package App\Models
 * @version February 15, 2018, 5:04 pm UTC
 *
 * @property string nombre
 * @property string tipo
 */
class alimentos extends Model
{
    use SoftDeletes;

    public $table = 'alimentos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'tipo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'tipo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'tipo' => 'required'
    ];

    
}
