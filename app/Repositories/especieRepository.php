<?php

namespace App\Repositories;

use App\Models\especie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class especieRepository
 * @package App\Repositories
 * @version February 9, 2018, 2:00 am UTC
 *
 * @method especie findWithoutFail($id, $columns = ['*'])
 * @method especie find($id, $columns = ['*'])
 * @method especie first($columns = ['*'])
*/
class especieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre_comun',
        'nombre_cientifico',
        'familia',
        'nombre_comun_en',
        'descripcion_es',
        'descripcion_en',
        'imagen_url'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return especie::class;
    }
}
