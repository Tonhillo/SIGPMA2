<?php

use Faker\Factory as Faker;
use App\Models\estanque_fisico_quimico;
use App\Repositories\estanque_fisico_quimicoRepository;

trait Makeestanque_fisico_quimicoTrait
{
    /**
     * Create fake instance of estanque_fisico_quimico and save it in database
     *
     * @param array $estanqueFisicoQuimicoFields
     * @return estanque_fisico_quimico
     */
    public function makeestanque_fisico_quimico($estanqueFisicoQuimicoFields = [])
    {
        /** @var estanque_fisico_quimicoRepository $estanqueFisicoQuimicoRepo */
        $estanqueFisicoQuimicoRepo = App::make(estanque_fisico_quimicoRepository::class);
        $theme = $this->fakeestanque_fisico_quimicoData($estanqueFisicoQuimicoFields);
        return $estanqueFisicoQuimicoRepo->create($theme);
    }

    /**
     * Get fake instance of estanque_fisico_quimico
     *
     * @param array $estanqueFisicoQuimicoFields
     * @return estanque_fisico_quimico
     */
    public function fakeestanque_fisico_quimico($estanqueFisicoQuimicoFields = [])
    {
        return new estanque_fisico_quimico($this->fakeestanque_fisico_quimicoData($estanqueFisicoQuimicoFields));
    }

    /**
     * Get fake data of estanque_fisico_quimico
     *
     * @param array $postFields
     * @return array
     */
    public function fakeestanque_fisico_quimicoData($estanqueFisicoQuimicoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id_estanque' => $fake->randomDigitNotNull,
            'id_fisicoQuimico' => $fake->randomDigitNotNull,
            'fecha' => $fake->word,
            'hora' => $fake->word,
            'observacion' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $estanqueFisicoQuimicoFields);
    }
}
