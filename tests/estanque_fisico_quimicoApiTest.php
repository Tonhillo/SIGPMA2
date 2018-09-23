<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class estanque_fisico_quimicoApiTest extends TestCase
{
    use Makeestanque_fisico_quimicoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateestanque_fisico_quimico()
    {
        $estanqueFisicoQuimico = $this->fakeestanque_fisico_quimicoData();
        $this->json('POST', '/api/v1/estanqueFisicoQuimicos', $estanqueFisicoQuimico);

        $this->assertApiResponse($estanqueFisicoQuimico);
    }

    /**
     * @test
     */
    public function testReadestanque_fisico_quimico()
    {
        $estanqueFisicoQuimico = $this->makeestanque_fisico_quimico();
        $this->json('GET', '/api/v1/estanqueFisicoQuimicos/'.$estanqueFisicoQuimico->id);

        $this->assertApiResponse($estanqueFisicoQuimico->toArray());
    }

    /**
     * @test
     */
    public function testUpdateestanque_fisico_quimico()
    {
        $estanqueFisicoQuimico = $this->makeestanque_fisico_quimico();
        $editedestanque_fisico_quimico = $this->fakeestanque_fisico_quimicoData();

        $this->json('PUT', '/api/v1/estanqueFisicoQuimicos/'.$estanqueFisicoQuimico->id, $editedestanque_fisico_quimico);

        $this->assertApiResponse($editedestanque_fisico_quimico);
    }

    /**
     * @test
     */
    public function testDeleteestanque_fisico_quimico()
    {
        $estanqueFisicoQuimico = $this->makeestanque_fisico_quimico();
        $this->json('DELETE', '/api/v1/estanqueFisicoQuimicos/'.$estanqueFisicoQuimico->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/estanqueFisicoQuimicos/'.$estanqueFisicoQuimico->id);

        $this->assertResponseStatus(404);
    }
}
