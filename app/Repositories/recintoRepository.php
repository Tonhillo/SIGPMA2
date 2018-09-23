<?php

namespace App\Repositories;

use App\Models\recinto;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class recintoRepository
 * @package App\Repositories
 * @version February 9, 2018, 1:24 am UTC
 *
 * @method recinto findWithoutFail($id, $columns = ['*'])
 * @method recinto find($id, $columns = ['*'])
 * @method recinto first($columns = ['*'])
*/
class recintoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return recinto::class;
    }
}
