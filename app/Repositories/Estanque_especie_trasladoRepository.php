<?php

namespace App\Repositories;

use App\Models\Estanque_especie_traslado;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Estanque_especieRepository
 * @package App\Repositories
 * @version February 18, 2018, 6:01 pm UTC
 *
 * @method Estanque_especie_traslado findWithoutFail($id, $columns = ['*'])
 * @method Estanque_especie_traslado find($id, $columns = ['*'])
 * @method Estanque_especie_traslado first($columns = ['*'])
*/
class Estanque_especie_trasladoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_especie',
        'id_estanque_origen',
        'id_estanque_destino',
        'motivo',
        'cantidad',
        'fecha',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Estanque_especie_traslado::class;
    }
}
