<?php

namespace App\Repositories;

use App\Models\Estanque_especie_defuncion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Estanque_especieRepository
 * @package App\Repositories
 * @version February 18, 2018, 6:01 pm UTC
 *
 * @method Estanque_especie_defuncion findWithoutFail($id, $columns = ['*'])
 * @method Estanque_especie_defuncion find($id, $columns = ['*'])
 * @method Estanque_especie_defuncion first($columns = ['*'])
*/
class Estanque_especie_defuncionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_especie',
        'id_estanque',
        'motivo',
        'cantidad',
        'fecha',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Estanque_especie_defuncion::class;
    }
}
