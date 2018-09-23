<?php

namespace App\Repositories;

use App\Models\especie;
use App\Models\Estanque_especie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Estanque_especieRepository
 * @package App\Repositories
 * @version February 18, 2018, 6:01 pm UTC
 *
 * @method Estanque_especie findWithoutFail($id, $columns = ['*'])
 * @method Estanque_especie find($id, $columns = ['*'])
 * @method Estanque_especie first($columns = ['*'])
*/
class Estanque_especieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_especie',
        'id_estanque',
        'cantidad'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Estanque_especie::class;
    }

    //retorna las especies disponibles
    //si una especie ya esta registrada no la retorna
    //retorna unicamente las especies NO agregadas a la tabla
    public  function especiesDisponiblesParaAgregar($id){

        $listaEscpecies = Estanque_especie::whereNull('deleted_at')->get();
        $listaEscpecies = $listaEscpecies->pluck('id_especie');

        return especie::whereNotIn('id', $listaEscpecies)->get();

    }
}
