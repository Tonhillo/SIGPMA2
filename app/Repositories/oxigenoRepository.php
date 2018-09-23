<?php

namespace App\Repositories;

use App\Models\oxigeno;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class oxigenoRepository
 * @package App\Repositories
 * @version May 25, 2018, 8:05 pm UTC
 *
 * @method oxigeno findWithoutFail($id, $columns = ['*'])
 * @method oxigeno find($id, $columns = ['*'])
 * @method oxigeno first($columns = ['*'])
*/
class oxigenoRepository extends BaseRepository
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
        return oxigeno::class;
    }
}
