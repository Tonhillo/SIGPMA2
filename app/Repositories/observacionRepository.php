<?php

namespace App\Repositories;

use App\Models\observacion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class observacionRepository
 * @package App\Repositories
 * @version February 20, 2018, 12:03 am UTC
 *
 * @method observacion findWithoutFail($id, $columns = ['*'])
 * @method observacion find($id, $columns = ['*'])
 * @method observacion first($columns = ['*'])
*/
class observacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'fecha'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return observacion::class;
    }
}
