<?php

namespace App\Repositories;

use App\Models\temperatura;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class temperaturaRepository
 * @package App\Repositories
 * @version May 25, 2018, 8:15 pm UTC
 *
 * @method temperatura findWithoutFail($id, $columns = ['*'])
 * @method temperatura find($id, $columns = ['*'])
 * @method temperatura first($columns = ['*'])
*/
class temperaturaRepository extends BaseRepository
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
        return temperatura::class;
    }
}
