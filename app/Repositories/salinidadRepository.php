<?php

namespace App\Repositories;

use App\Models\salinidad;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class salinidadRepository
 * @package App\Repositories
 * @version May 25, 2018, 8:03 pm UTC
 *
 * @method salinidad findWithoutFail($id, $columns = ['*'])
 * @method salinidad find($id, $columns = ['*'])
 * @method salinidad first($columns = ['*'])
*/
class salinidadRepository extends BaseRepository
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
        return salinidad::class;
    }
}
