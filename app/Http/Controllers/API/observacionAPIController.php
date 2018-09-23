<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateobservacionAPIRequest;
use App\Http\Requests\API\UpdateobservacionAPIRequest;
use App\Models\observacion;
use App\Repositories\observacionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class observacionController
 * @package App\Http\Controllers\API
 */

class observacionAPIController extends AppBaseController
{
    /** @var  observacionRepository */
    private $observacionRepository;

    public function __construct(observacionRepository $observacionRepo)
    {
        $this->observacionRepository = $observacionRepo;
    }

    /**
     * Display a listing of the observacion.
     * GET|HEAD /observacions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->observacionRepository->pushCriteria(new RequestCriteria($request));
        $this->observacionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $observacions = $this->observacionRepository->all();

        return $this->sendResponse($observacions->toArray(), 'Observacions retrieved successfully');
    }

    /**
     * Store a newly created observacion in storage.
     * POST /observacions
     *
     * @param CreateobservacionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateobservacionAPIRequest $request)
    {
        $input = $request->all();

        $observacions = $this->observacionRepository->create($input);

        return $this->sendResponse($observacions->toArray(), 'Observacion saved successfully');
    }

    /**
     * Display the specified observacion.
     * GET|HEAD /observacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var observacion $observacion */
        $observacion = $this->observacionRepository->findWithoutFail($id);

        if (empty($observacion)) {
            return $this->sendError('Observacion not found');
        }

        return $this->sendResponse($observacion->toArray(), 'Observacion retrieved successfully');
    }

    /**
     * Update the specified observacion in storage.
     * PUT/PATCH /observacions/{id}
     *
     * @param  int $id
     * @param UpdateobservacionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateobservacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var observacion $observacion */
        $observacion = $this->observacionRepository->findWithoutFail($id);

        if (empty($observacion)) {
            return $this->sendError('Observacion not found');
        }

        $observacion = $this->observacionRepository->update($input, $id);

        return $this->sendResponse($observacion->toArray(), 'observacion updated successfully');
    }

    /**
     * Remove the specified observacion from storage.
     * DELETE /observacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var observacion $observacion */
        $observacion = $this->observacionRepository->findWithoutFail($id);

        if (empty($observacion)) {
            return $this->sendError('Observacion not found');
        }

        $observacion->delete();

        return $this->sendResponse($id, 'Observacion deleted successfully');
    }
}
