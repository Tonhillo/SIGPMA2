<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Estanque_especie
 * @package App\Models
 * @version February 18, 2018, 6:01 pm UTC
 *
 * @property integer id_especie
 * @property integer id_estanque
 * @property integer cantidad
 * @property integer id_alimento
 */
class Estanque_especie extends Model
{
    use SoftDeletes;

    public $table = 'estanque_especies';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_especie',
        'id_estanque',
        'cantidad',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_especie' => 'integer',
        'id_estanque' => 'integer',
        'cantidad' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_especie' => 'required',
        'id_estanque' => 'required',
        'cantidad' => 'required'
    ];

    public function especie()
    {
        return $this->belongsTo(especie::class, 'id_especie');;
    }
    public function estanque()
    {
        return $this->belongsTo(estanque::class, 'id_estanque');;
    }
}
