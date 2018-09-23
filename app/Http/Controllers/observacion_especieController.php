<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createobservacion_especieRequest;
use App\Http\Requests\Updateobservacion_especieRequest;
use App\Repositories\observacion_especieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class observacion_especieController extends AppBaseController
{
    /** @var  observacion_especieRepository */
    private $observacionEspecieRepository;

    public function __construct(observacion_especieRepository $observacionEspecieRepo)
    {
        $this->observacionEspecieRepository = $observacionEspecieRepo;
    }

    /**
     * Display a listing of the observacion_especie.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->observacionEspecieRepository->pushCriteria(new RequestCriteria($request));
        $observacionEspecies = $this->observacionEspecieRepository->all();

        return view('observacion_especies.index')
            ->with('observacionEspecies', $observacionEspecies);
    }

    /**
     * Show the form for creating a new observacion_especie.
     *
     * @return Response
     */
    public function create()
    {
        return view('observacion_especies.create');
    }

    /**
     * Store a newly created observacion_especie in storage.
     *
     * @param Createobservacion_especieRequest $request
     *
     * @return Response
     */
    public function store(Createobservacion_especieRequest $request)
    {
        $input = $request->all();

        $observacionEspecie = $this->observacionEspecieRepository->create($input);

        Flash::success('Observacion Especie saved successfully.');

        return redirect(route('observacionEspecies.index'));
    }

    /**
     * Display the specified observacion_especie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $observacionEspecie = $this->observacionEspecieRepository->findWithoutFail($id);

        if (empty($observacionEspecie)) {
            Flash::error('Observacion Especie not found');

            return redirect(route('observacionEspecies.index'));
        }

        return view('observacion_especies.show')->with('observacionEspecie', $observacionEspecie);
    }

    /**
     * Show the form for editing the specified observacion_especie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $observacionEspecie = $this->observacionEspecieRepository->findWithoutFail($id);

        if (empty($observacionEspecie)) {
            Flash::error('Observacion Especie not found');

            return redirect(route('observacionEspecies.index'));
        }

        return view('observacion_especies.edit')->with('observacionEspecie', $observacionEspecie);
    }

    /**
     * Update the specified observacion_especie in storage.
     *
     * @param  int              $id
     * @param Updateobservacion_especieRequest $request
     *
     * @return Response
     */
    public function update($id, Updateobservacion_especieRequest $request)
    {
        $observacionEspecie = $this->observacionEspecieRepository->findWithoutFail($id);

        if (empty($observacionEspecie)) {
            Flash::error('Observacion Especie not found');

            return redirect(route('observacionEspecies.index'));
        }

        $observacionEspecie = $this->observacionEspecieRepository->update($request->all(), $id);

        Flash::success('Observacion Especie updated successfully.');

        return redirect(route('observacionEspecies.index'));
    }

    /**
     * Remove the specified observacion_especie from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $observacionEspecie = $this->observacionEspecieRepository->findWithoutFail($id);

        if (empty($observacionEspecie)) {
            Flash::error('Observacion Especie not found');

            return redirect(route('observacionEspecies.index'));
        }

        $this->observacionEspecieRepository->delete($id);

        Flash::success('Observacion Especie deleted successfully.');

        return redirect(route('observacionEspecies.index'));
    }
}
