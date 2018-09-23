<?php

namespace App\Repositories;

use App\Models\alimentos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class alimentosRepository
 * @package App\Repositories
 * @version February 15, 2018, 5:04 pm UTC
 *
 * @method alimentos findWithoutFail($id, $columns = ['*'])
 * @method alimentos find($id, $columns = ['*'])
 * @method alimentos first($columns = ['*'])
*/
class alimentosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'tipo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return alimentos::class;
    }
}
