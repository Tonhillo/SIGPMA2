<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createestanque_fisico_quimicoRequest;
use App\Http\Requests\Updateestanque_fisico_quimicoRequest;
use App\Repositories\estanque_fisico_quimicoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class estanque_fisico_quimicoController extends AppBaseController
{
    /** @var  estanque_fisico_quimicoRepository */
    private $estanqueFisicoQuimicoRepository;

    public function __construct(estanque_fisico_quimicoRepository $estanqueFisicoQuimicoRepo)
    {
        $this->estanqueFisicoQuimicoRepository = $estanqueFisicoQuimicoRepo;
    }

    /**
     * Display a listing of the estanque_fisico_quimico.
     *
     * @param Request $request
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(Request $request)
    {
        $this->estanqueFisicoQuimicoRepository->pushCriteria(new RequestCriteria($request));
        $estanqueFisicoQuimicos = $this->estanqueFisicoQuimicoRepository->all();

        return view('estanque_fisico_quimicos.index')
            ->with('estanqueFisicoQuimicos', $estanqueFisicoQuimicos);
    }

    /**
     * Show the form for creating a new estanque_fisico_quimico.
     *
     * @return Response
     */
    public function create()
    {
        return view('estanque_fisico_quimicos.create');
    }

    /**
     * Store a newly created estanque_fisico_quimico in storage.
     *
     * @param Createestanque_fisico_quimicoRequest $request
     *
     * @return Response
     */
    public function store(Createestanque_fisico_quimicoRequest $request)
    {
        $input = $request->all();

        $estanqueFisicoQuimico = $this->estanqueFisicoQuimicoRepository->create($input);

        Flash::success('Estanque Fisico Quimico saved successfully.');

        return redirect(route('estanqueFisicoQuimicos.index'));
    }

    /**
     * Display the specified estanque_fisico_quimico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estanqueFisicoQuimico = $this->estanqueFisicoQuimicoRepository->findWithoutFail($id);

        if (empty($estanqueFisicoQuimico)) {
            Flash::error('Estanque Fisico Quimico not found');

            return redirect(route('estanqueFisicoQuimicos.index'));
        }

        return view('estanque_fisico_quimicos.show')->with('estanqueFisicoQuimico', $estanqueFisicoQuimico);
    }

    /**
     * Show the form for editing the specified estanque_fisico_quimico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $estanqueFisicoQuimico = $this->estanqueFisicoQuimicoRepository->findWithoutFail($id);

        if (empty($estanqueFisicoQuimico)) {
            Flash::error('Estanque Fisico Quimico not found');

            return redirect(route('estanqueFisicoQuimicos.index'));
        }

        return view('estanque_fisico_quimicos.edit')->with('estanqueFisicoQuimico', $estanqueFisicoQuimico);
    }

    /**
     * Update the specified estanque_fisico_quimico in storage.
     *
     * @param  int              $id
     * @param Updateestanque_fisico_quimicoRequest $request
     *
     * @return Response
     */
    public function update($id, Updateestanque_fisico_quimicoRequest $request)
    {
        $estanqueFisicoQuimico = $this->estanqueFisicoQuimicoRepository->findWithoutFail($id);

        if (empty($estanqueFisicoQuimico)) {
            Flash::error('Estanque Fisico Quimico not found');

            return redirect(route('estanqueFisicoQuimicos.index'));
        }

        $estanqueFisicoQuimico = $this->estanqueFisicoQuimicoRepository->update($request->all(), $id);

        Flash::success('Estanque Fisico Quimico updated successfully.');

        return redirect(route('estanqueFisicoQuimicos.index'));
    }

    /**
     * Remove the specified estanque_fisico_quimico from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estanqueFisicoQuimico = $this->estanqueFisicoQuimicoRepository->findWithoutFail($id);

        if (empty($estanqueFisicoQuimico)) {
            Flash::error('Estanque Fisico Quimico not found');

            return redirect(route('estanqueFisicoQuimicos.index'));
        }

        $this->estanqueFisicoQuimicoRepository->delete($id);

        Flash::success('Estanque Fisico Quimico deleted successfully.');

        return redirect(route('estanqueFisicoQuimicos.index'));
    }
}
