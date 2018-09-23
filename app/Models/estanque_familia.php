<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class estanque_familia
 * @package App\Models
 * @version February 17, 2018, 3:41 am UTC
 *
 * @property integer id_especie
 * @property integer id_estanque
 * @property integer numero_de_machos
 * @property integer numero_de_hembras
 * @property integer numero_de_indefinidos
 * @property date fecha_inicio_familia
 * @property string estado
 */
class estanque_familia extends Model
{
    use SoftDeletes;

    public $table = 'estanque_familias';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_especie',
        'id_estanque',
        'numero_de_machos',
        'numero_de_hembras',
        'numero_de_indefinidos',
        'fecha_inicio_familia',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_especie' => 'integer',
        'id_estanque' => 'integer',
        'numero_de_machos' => 'integer',
        'numero_de_hembras' => 'integer',
        'numero_de_indefinidos' => 'integer',
        'fecha_inicio_familia' => 'date',
        'estado' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_especie' => 'required',
        'id_estanque' => 'required',
        'numero_de_machos' => 'required',
        'numero_de_hembras' => 'required',
        'numero_de_indefinidos' => 'required',
        'fecha_inicio_familia' => 'required',
        'estado' => 'required'
    ];

    //Relación con especie
    public function especie()
    {
        return $this->belongsTo(especie::class, 'id_especie');;
    }   
    
    //Relación con estanque.
    public function estanque()
    {
        return $this->belongsTo(estanque::class, 'id_estanque');;
    } //fin del método
}
