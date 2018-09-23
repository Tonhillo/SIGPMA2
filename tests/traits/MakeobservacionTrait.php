<?php

use Faker\Factory as Faker;
use App\Models\observacion;
use App\Repositories\observacionRepository;

trait MakeobservacionTrait
{
    /**
     * Create fake instance of observacion and save it in database
     *
     * @param array $observacionFields
     * @return observacion
     */
    public function makeobservacion($observacionFields = [])
    {
        /** @var observacionRepository $observacionRepo */
        $observacionRepo = App::make(observacionRepository::class);
        $theme = $this->fakeobservacionData($observacionFields);
        return $observacionRepo->create($theme);
    }

    /**
     * Get fake instance of observacion
     *
     * @param array $observacionFields
     * @return observacion
     */
    public function fakeobservacion($observacionFields = [])
    {
        return new observacion($this->fakeobservacionData($observacionFields));
    }

    /**
     * Get fake data of observacion
     *
     * @param array $postFields
     * @return array
     */
    public function fakeobservacionData($observacionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'descripcion' => $fake->word,
            'fecha' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $observacionFields);
    }
}
