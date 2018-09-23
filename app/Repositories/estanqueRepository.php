<?php

namespace App\Repositories;

use App\Models\estanque;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class estanqueRepository
 * @package App\Repositories
 * @version February 9, 2018, 3:17 am UTC
 *
 * @method estanque findWithoutFail($id, $columns = ['*'])
 * @method estanque find($id, $columns = ['*'])
 * @method estanque first($columns = ['*'])
*/
class estanqueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'num_estanque',
        'id_recinto',
        'volumen',
        'tipo_agua'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return estanque::class;
    }
}
