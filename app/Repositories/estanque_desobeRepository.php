<?php

namespace App\Repositories;

use App\Models\estanque_desobe;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class estanque_desobeRepository
 * @package App\Repositories
 * @version February 19, 2018, 11:32 pm UTC
 *
 * @method estanque_desobe findWithoutFail($id, $columns = ['*'])
 * @method estanque_desobe find($id, $columns = ['*'])
 * @method estanque_desobe first($columns = ['*'])
*/
class estanque_desobeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_estanque',
        'id_desobe',
        'fecha',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return estanque_desobe::class;
    }
}
