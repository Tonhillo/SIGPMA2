<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class fisico_quimico
 * @package App\Models
 * @version February 15, 2018, 7:36 pm UTC
 *
 * @property integer temperatura
 * @property decimal pH
 * @property integer nitritos
 * @property decimal nitratos
 * @property integer salinidad
 * @property decimal amonio
 * @property decimal oxigeno
 */
class fisico_quimico extends Model
{
    use SoftDeletes;

    public $table = 'fisico_quimicos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'temperatura',
        'pH',
        'nitritos',
        'nitratos',
        'salinidad',
        'amonio',
        'oxigeno'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'temperatura' => 'integer',
        'nitritos' => 'integer',
        'salinidad' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'temperatura' => 'nullable',
        'pH' => 'nullable',
        'nitritos' => 'nullable',
        'nitratos' => 'nullable',
        'salinidad' => 'nullable',
        'amonio' => 'nullable',
        'oxigeno' => 'nullable'
    ];

    
}
