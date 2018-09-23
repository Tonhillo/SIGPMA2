<?php

namespace App\Repositories;

use App\Models\pH;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class pHRepository
 * @package App\Repositories
 * @version May 25, 2018, 7:48 pm UTC
 *
 * @method pH findWithoutFail($id, $columns = ['*'])
 * @method pH find($id, $columns = ['*'])
 * @method pH first($columns = ['*'])
*/
class pHRepository extends BaseRepository
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
        return pH::class;
    }
}
