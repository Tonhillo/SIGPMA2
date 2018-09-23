<?php

namespace App\Repositories;

use App\Models\estanque_alimentacion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class estanque_alimentacionRepository
 * @package App\Repositories
 * @version February 16, 2018, 1:21 am UTC
 *
 * @method estanque_alimentacion findWithoutFail($id, $columns = ['*'])
 * @method estanque_alimentacion find($id, $columns = ['*'])
 * @method estanque_alimentacion first($columns = ['*'])
*/
class estanque_alimentacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_estanque',
        'id_alimento',
        'fecha_alimentacion',
        'hora_alimentacion',
        'peso',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return estanque_alimentacion::class;
    }
}
