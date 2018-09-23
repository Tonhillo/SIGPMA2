<?php

use App\Models\estanque_fisico_quimico;
use App\Repositories\estanque_fisico_quimicoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class estanque_fisico_quimicoRepositoryTest extends TestCase
{
    use Makeestanque_fisico_quimicoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var estanque_fisico_quimicoRepository
     */
    protected $estanqueFisicoQuimicoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->estanqueFisicoQuimicoRepo = App::make(estanque_fisico_quimicoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateestanque_fisico_quimico()
    {
        $estanqueFisicoQuimico = $this->fakeestanque_fisico_quimicoData();
        $createdestanque_fisico_quimico = $this->estanqueFisicoQuimicoRepo->create($estanqueFisicoQuimico);
        $createdestanque_fisico_quimico = $createdestanque_fisico_quimico->toArray();
        $this->assertArrayHasKey('id', $createdestanque_fisico_quimico);
        $this->assertNotNull($createdestanque_fisico_quimico['id'], 'Created estanque_fisico_quimico must have id specified');
        $this->assertNotNull(estanque_fisico_quimico::find($createdestanque_fisico_quimico['id']), 'estanque_fisico_quimico with given id must be in DB');
        $this->assertModelData($estanqueFisicoQuimico, $createdestanque_fisico_quimico);
    }

    /**
     * @test read
     */
    public function testReadestanque_fisico_quimico()
    {
        $estanqueFisicoQuimico = $this->makeestanque_fisico_quimico();
        $dbestanque_fisico_quimico = $this->estanqueFisicoQuimicoRepo->find($estanqueFisicoQuimico->id);
        $dbestanque_fisico_quimico = $dbestanque_fisico_quimico->toArray();
        $this->assertModelData($estanqueFisicoQuimico->toArray(), $dbestanque_fisico_quimico);
    }

    /**
     * @test update
     */
    public function testUpdateestanque_fisico_quimico()
    {
        $estanqueFisicoQuimico = $this->makeestanque_fisico_quimico();
        $fakeestanque_fisico_quimico = $this->fakeestanque_fisico_quimicoData();
        $updatedestanque_fisico_quimico = $this->estanqueFisicoQuimicoRepo->update($fakeestanque_fisico_quimico, $estanqueFisicoQuimico->id);
        $this->assertModelData($fakeestanque_fisico_quimico, $updatedestanque_fisico_quimico->toArray());
        $dbestanque_fisico_quimico = $this->estanqueFisicoQuimicoRepo->find($estanqueFisicoQuimico->id);
        $this->assertModelData($fakeestanque_fisico_quimico, $dbestanque_fisico_quimico->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteestanque_fisico_quimico()
    {
        $estanqueFisicoQuimico = $this->makeestanque_fisico_quimico();
        $resp = $this->estanqueFisicoQuimicoRepo->delete($estanqueFisicoQuimico->id);
        $this->assertTrue($resp);
        $this->assertNull(estanque_fisico_quimico::find($estanqueFisicoQuimico->id), 'estanque_fisico_quimico should not exist in DB');
    }
}
