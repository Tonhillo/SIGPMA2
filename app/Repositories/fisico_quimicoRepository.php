<?php

namespace App\Repositories;

use App\Models\fisico_quimico;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class fisico_quimicoRepository
 * @package App\Repositories
 * @version February 15, 2018, 7:36 pm UTC
 *
 * @method fisico_quimico findWithoutFail($id, $columns = ['*'])
 * @method fisico_quimico find($id, $columns = ['*'])
 * @method fisico_quimico first($columns = ['*'])
*/
class fisico_quimicoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'temperatura',
        'pH',
        'nitritos',
        'nitratos',
        'salinidad',
        'amonio',
        'oxigeno'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return fisico_quimico::class;
    }
}
