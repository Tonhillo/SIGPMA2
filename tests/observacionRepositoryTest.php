<?php

use App\Models\observacion;
use App\Repositories\observacionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class observacionRepositoryTest extends TestCase
{
    use MakeobservacionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var observacionRepository
     */
    protected $observacionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->observacionRepo = App::make(observacionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateobservacion()
    {
        $observacion = $this->fakeobservacionData();
        $createdobservacion = $this->observacionRepo->create($observacion);
        $createdobservacion = $createdobservacion->toArray();
        $this->assertArrayHasKey('id', $createdobservacion);
        $this->assertNotNull($createdobservacion['id'], 'Created observacion must have id specified');
        $this->assertNotNull(observacion::find($createdobservacion['id']), 'observacion with given id must be in DB');
        $this->assertModelData($observacion, $createdobservacion);
    }

    /**
     * @test read
     */
    public function testReadobservacion()
    {
        $observacion = $this->makeobservacion();
        $dbobservacion = $this->observacionRepo->find($observacion->id);
        $dbobservacion = $dbobservacion->toArray();
        $this->assertModelData($observacion->toArray(), $dbobservacion);
    }

    /**
     * @test update
     */
    public function testUpdateobservacion()
    {
        $observacion = $this->makeobservacion();
        $fakeobservacion = $this->fakeobservacionData();
        $updatedobservacion = $this->observacionRepo->update($fakeobservacion, $observacion->id);
        $this->assertModelData($fakeobservacion, $updatedobservacion->toArray());
        $dbobservacion = $this->observacionRepo->find($observacion->id);
        $this->assertModelData($fakeobservacion, $dbobservacion->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteobservacion()
    {
        $observacion = $this->makeobservacion();
        $resp = $this->observacionRepo->delete($observacion->id);
        $this->assertTrue($resp);
        $this->assertNull(observacion::find($observacion->id), 'observacion should not exist in DB');
    }
}
