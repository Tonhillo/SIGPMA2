<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateobservacionRequest;
use App\Http\Requests\UpdateobservacionRequest;
use App\Repositories\observacionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class observacionController extends AppBaseController
{
    /** @var  observacionRepository */
    private $observacionRepository;

    public function __construct(observacionRepository $observacionRepo)
    {
        $this->observacionRepository = $observacionRepo;
    }

    /**
     * Display a listing of the observacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->observacionRepository->pushCriteria(new RequestCriteria($request));
        $observacions = $this->observacionRepository->all();

        return view('observacions.index')
            ->with('observacions', $observacions);
    }

    /**
     * Show the form for creating a new observacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('observacions.create');
    }

    /**
     * Store a newly created observacion in storage.
     *
     * @param CreateobservacionRequest $request
     *
     * @return Response
     */
    public function store(CreateobservacionRequest $request)
    {
        $input = $request->all();

        $observacion = $this->observacionRepository->create($input);

        Flash::success('Observacion saved successfully.');

        return redirect(route('observacions.index'));
    }

    /**
     * Display the specified observacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $observacion = $this->observacionRepository->findWithoutFail($id);

        if (empty($observacion)) {
            Flash::error('Observacion not found');

            return redirect(route('observacions.index'));
        }

        return view('observacions.show')->with('observacion', $observacion);
    }

    /**
     * Show the form for editing the specified observacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $observacion = $this->observacionRepository->findWithoutFail($id);

        if (empty($observacion)) {
            Flash::error('Observacion not found');

            return redirect(route('observacions.index'));
        }

        return view('observacions.edit')->with('observacion', $observacion);
    }

    /**
     * Update the specified observacion in storage.
     *
     * @param  int              $id
     * @param UpdateobservacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateobservacionRequest $request)
    {
        $observacion = $this->observacionRepository->findWithoutFail($id);

        if (empty($observacion)) {
            Flash::error('Observacion not found');

            return redirect(route('observacions.index'));
        }

        $observacion = $this->observacionRepository->update($request->all(), $id);

        Flash::success('Observacion updated successfully.');

        return redirect(route('observacions.index'));
    }

    /**
     * Remove the specified observacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $observacion = $this->observacionRepository->findWithoutFail($id);

        if (empty($observacion)) {
            Flash::error('Observacion not found');

            return redirect(route('observacions.index'));
        }

        $this->observacionRepository->delete($id);

        Flash::success('Observacion deleted successfully.');

        return redirect(route('observacions.index'));
    }
}
