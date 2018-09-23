<?php

namespace App\Repositories;

use App\Models\observacion_especie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class observacion_especieRepository
 * @package App\Repositories
 * @version February 20, 2018, 12:46 am UTC
 *
 * @method observacion_especie findWithoutFail($id, $columns = ['*'])
 * @method observacion_especie find($id, $columns = ['*'])
 * @method observacion_especie first($columns = ['*'])
*/
class observacion_especieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_especie',
        'id_observacion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return observacion_especie::class;
    }
}
