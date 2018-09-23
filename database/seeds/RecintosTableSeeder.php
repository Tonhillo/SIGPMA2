<?php

use Illuminate\Database\Seeder;
use App\Models\recinto;

class RecintosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      recinto::create(['nombre' => 'ACUARIO']);
      recinto::create(['nombre' => 'PRODUCCIÓN']);
    }
}
