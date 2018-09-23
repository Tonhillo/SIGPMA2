<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createestanque_fisico_quimicoAPIRequest;
use App\Http\Requests\API\Updateestanque_fisico_quimicoAPIRequest;
use App\Models\estanque_fisico_quimico;
use App\Repositories\estanque_fisico_quimicoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class estanque_fisico_quimicoController
 * @package App\Http\Controllers\API
 */

class estanque_fisico_quimicoAPIController extends AppBaseController
{
    /** @var  estanque_fisico_quimicoRepository */
    private $estanqueFisicoQuimicoRepository;

    public function __construct(estanque_fisico_quimicoRepository $estanqueFisicoQuimicoRepo)
    {
        $this->estanqueFisicoQuimicoRepository = $estanqueFisicoQuimicoRepo;
    }

    /**
     * Display a listing of the estanque_fisico_quimico.
     * GET|HEAD /estanqueFisicoQuimicos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->estanqueFisicoQuimicoRepository->pushCriteria(new RequestCriteria($request));
        $this->estanqueFisicoQuimicoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $estanqueFisicoQuimicos = $this->estanqueFisicoQuimicoRepository->all();

        return $this->sendResponse($estanqueFisicoQuimicos->toArray(), 'Estanque Fisico Quimicos retrieved successfully');
    }

    /**
     * Store a newly created estanque_fisico_quimico in storage.
     * POST /estanqueFisicoQuimicos
     *
     * @param Createestanque_fisico_quimicoAPIRequest $request
     *
     * @return Response
     */
    public function store(Createestanque_fisico_quimicoAPIRequest $request)
    {
        $input = $request->all();

        $estanqueFisicoQuimicos = $this->estanqueFisicoQuimicoRepository->create($input);

        return $this->sendResponse($estanqueFisicoQuimicos->toArray(), 'Estanque Fisico Quimico saved successfully');
    }

    /**
     * Display the specified estanque_fisico_quimico.
     * GET|HEAD /estanqueFisicoQuimicos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var estanque_fisico_quimico $estanqueFisicoQuimico */
        $estanqueFisicoQuimico = $this->estanqueFisicoQuimicoRepository->findWithoutFail($id);

        if (empty($estanqueFisicoQuimico)) {
            return $this->sendError('Estanque Fisico Quimico not found');
        }

        return $this->sendResponse($estanqueFisicoQuimico->toArray(), 'Estanque Fisico Quimico retrieved successfully');
    }

    /**
     * Update the specified estanque_fisico_quimico in storage.
     * PUT/PATCH /estanqueFisicoQuimicos/{id}
     *
     * @param  int $id
     * @param Updateestanque_fisico_quimicoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateestanque_fisico_quimicoAPIRequest $request)
    {
        $input = $request->all();

        /** @var estanque_fisico_quimico $estanqueFisicoQuimico */
        $estanqueFisicoQuimico = $this->estanqueFisicoQuimicoRepository->findWithoutFail($id);

        if (empty($estanqueFisicoQuimico)) {
            return $this->sendError('Estanque Fisico Quimico not found');
        }

        $estanqueFisicoQuimico = $this->estanqueFisicoQuimicoRepository->update($input, $id);

        return $this->sendResponse($estanqueFisicoQuimico->toArray(), 'estanque_fisico_quimico updated successfully');
    }

    /**
     * Remove the specified estanque_fisico_quimico from storage.
     * DELETE /estanqueFisicoQuimicos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var estanque_fisico_quimico $estanqueFisicoQuimico */
        $estanqueFisicoQuimico = $this->estanqueFisicoQuimicoRepository->findWithoutFail($id);

        if (empty($estanqueFisicoQuimico)) {
            return $this->sendError('Estanque Fisico Quimico not found');
        }

        $estanqueFisicoQuimico->delete();

        return $this->sendResponse($id, 'Estanque Fisico Quimico deleted successfully');
    }
}
