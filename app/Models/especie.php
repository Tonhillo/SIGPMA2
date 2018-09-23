<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class especie
 * @package App\Models
 * @version February 9, 2018, 2:00 am UTC
 *
 * @property string nombre_comun
 * @property string nombre_cientifico
 * @property string familia
 * @property string nombre_comun_en
 * @property string descripcion_es
 * @property string descripcion_en
 * @property string imagen_url
 */
class especie extends Model
{
    use SoftDeletes;

    public $table = 'especies';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre_comun',
        'nombre_cientifico',
        'familia',
        'nombre_comun_en',
        'descripcion_es',
        'descripcion_en',
        'imagen_url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre_comun' => 'string',
        'nombre_cientifico' => 'string',
        'familia' => 'string',
        'nombre_comun_en' => 'string',
        'descripcion_es' => 'string',
        'descripcion_en' => 'string',
        'imagen_url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre_comun' => 'required',
        'nombre_cientifico' => 'required',
        'familia' => 'required',
        'nombre_comun_en' => 'required',
        'descripcion_es' => 'required',
        'descripcion_en' => 'required',
        'imagen_url' => 'required'
    ];

    //Relación con estanque familia
    public function estanque_familia()
    {
        return $this->hasOne('App\Models\estanque_familia','id_estanque');
    }
}
