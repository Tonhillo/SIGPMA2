<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Models\recinto;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'name' => 'acuario',
            'email' => 'acuario@acuario.com',
            'password' => bcrypt('acuario'),
            'id_recinto' => 1,
        ]);
        $user->assignRole('Administrador');
        $user=User::create([
            'name' => 'produccion',
            'email' => 'produccion@produccion.com',
            'password' => bcrypt('produccion'),
            'id_recinto' => 2,
        ]);
        $user->assignRole('Administrador');

    }
}
