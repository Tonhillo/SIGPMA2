<?php

namespace App\Repositories;

use App\Models\estanque_fisico_quimico;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class estanque_fisico_quimicoRepository
 * @package App\Repositories
 * @version February 15, 2018, 7:56 pm UTC
 *
 * @method estanque_fisico_quimico findWithoutFail($id, $columns = ['*'])
 * @method estanque_fisico_quimico find($id, $columns = ['*'])
 * @method estanque_fisico_quimico first($columns = ['*'])
*/
class estanque_fisico_quimicoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_estanque',
        'id_fisicoQuimico',
        'fecha',
        'hora',
        'observacion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return estanque_fisico_quimico::class;
    }
}
