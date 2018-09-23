<?php

namespace App\Repositories;

use App\Models\estanque_familia;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class estanque_familiaRepository
 * @package App\Repositories
 * @version February 17, 2018, 3:41 am UTC
 *
 * @method estanque_familia findWithoutFail($id, $columns = ['*'])
 * @method estanque_familia find($id, $columns = ['*'])
 * @method estanque_familia first($columns = ['*'])
*/
class estanque_familiaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_especie',
        'id_estanque',
        'numero_de_machos',
        'numero_de_hembras',
        'numero_de_indefinidos',
        'fecha_inicio_familia',
        'estado'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return estanque_familia::class;
    }
}
