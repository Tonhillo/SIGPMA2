<?php

namespace App\Repositories;

use App\Models\desobe;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class desobeRepository
 * @package App\Repositories
 * @version February 9, 2018, 3:40 am UTC
 *
 * @method desobe findWithoutFail($id, $columns = ['*'])
 * @method desobe find($id, $columns = ['*'])
 * @method desobe first($columns = ['*'])
*/
class desobeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'num_huevos_total',
        'num_huevos_no_viables',
        'num_huevos_viables',
        'porcentaje_viabilidad',
        'diametro_huevo',
        'diametro_gota'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return desobe::class;
    }
}
