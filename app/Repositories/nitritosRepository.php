<?php

namespace App\Repositories;

use App\Models\nitritos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class nitritosRepository
 * @package App\Repositories
 * @version May 25, 2018, 7:58 pm UTC
 *
 * @method nitritos findWithoutFail($id, $columns = ['*'])
 * @method nitritos find($id, $columns = ['*'])
 * @method nitritos first($columns = ['*'])
*/
class nitritosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_estanque',
        'valor',
        'fecha',
        'hora'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return nitritos::class;
    }
}
