<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class observacionApiTest extends TestCase
{
    use MakeobservacionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateobservacion()
    {
        $observacion = $this->fakeobservacionData();
        $this->json('POST', '/api/v1/observacions', $observacion);

        $this->assertApiResponse($observacion);
    }

    /**
     * @test
     */
    public function testReadobservacion()
    {
        $observacion = $this->makeobservacion();
        $this->json('GET', '/api/v1/observacions/'.$observacion->id);

        $this->assertApiResponse($observacion->toArray());
    }

    /**
     * @test
     */
    public function testUpdateobservacion()
    {
        $observacion = $this->makeobservacion();
        $editedobservacion = $this->fakeobservacionData();

        $this->json('PUT', '/api/v1/observacions/'.$observacion->id, $editedobservacion);

        $this->assertApiResponse($editedobservacion);
    }

    /**
     * @test
     */
    public function testDeleteobservacion()
    {
        $observacion = $this->makeobservacion();
        $this->json('DELETE', '/api/v1/observacions/'.$observacion->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/observacions/'.$observacion->id);

        $this->assertResponseStatus(404);
    }
}
