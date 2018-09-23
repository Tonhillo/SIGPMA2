<?php

namespace App\Repositories;

use App\Models\alimentos;
use App\User;
use InfyOm\Generator\Common\BaseRepository;

class UsuariosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'id_recinto',
        'role',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
