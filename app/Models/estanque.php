<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class estanque
 * @package App\Models
 * @version February 9, 2018, 3:17 am UTC
 *
 * @property string num_estanque
 * @property integer id_recinto
 * @property integer volumen
 * @property string tipo_agua
 */
class estanque extends Model
{
    use SoftDeletes;

    public $table = 'estanques';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'num_estanque',
        'id_recinto',
        'volumen',
        'tipo_agua'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'num_estanque' => 'string',
        'id_recinto' => 'integer',
        'volumen' => 'integer',
        'tipo_agua' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'num_estanque' => 'required',
        'id_recinto' => 'required',
        'volumen' => 'required',
        'tipo_agua' => 'required'
    ];

     //Relación con estanque_familia 
     public function estanque_familia()
     {
         return $this->hasOne('App\Models\estanque_familia','id_estanque');
     }//fin del método 
    
}
