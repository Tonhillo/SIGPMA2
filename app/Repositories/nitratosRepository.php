<?php

namespace App\Repositories;

use App\Models\nitratos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class nitratosRepository
 * @package App\Repositories
 * @version May 25, 2018, 8:00 pm UTC
 *
 * @method nitratos findWithoutFail($id, $columns = ['*'])
 * @method nitratos find($id, $columns = ['*'])
 * @method nitratos first($columns = ['*'])
*/
class nitratosRepository extends BaseRepository
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
        return nitratos::class;
    }
}
