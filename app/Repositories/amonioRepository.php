<?php

namespace App\Repositories;

use App\Models\amonio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class amonioRepository
 * @package App\Repositories
 * @version May 25, 2018, 8:04 pm UTC
 *
 * @method amonio findWithoutFail($id, $columns = ['*'])
 * @method amonio find($id, $columns = ['*'])
 * @method amonio first($columns = ['*'])
*/
class amonioRepository extends BaseRepository
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
        return amonio::class;
    }
}
