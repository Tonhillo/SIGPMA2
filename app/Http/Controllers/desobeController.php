<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatedesobeRequest;
use App\Http\Requests\UpdatedesobeRequest;
use App\Repositories\desobeRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\estanqueRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class desobeController extends AppBaseController
{
    /** @var  desobeRepository */
    private $desobeRepository;
    /** @var  estanqueRepository */
    private $estanqueRepository;

    public function __construct(desobeRepository $desobeRepo, estanqueRepository $estanqueRepo)
    {
        $this->desobeRepository = $desobeRepo;
        $this->estanqueRepository = $estanqueRepo;
    }

    /**
     * Display a listing of the desobe.
     *
     * @param Request $request
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(Request $request)
    {
        $this->desobeRepository->pushCriteria(new RequestCriteria($request));
        $desobes = $this->desobeRepository->all();

        return view('desobes.index')
            ->with('desobes', $desobes);
    }

    /**
     * Show the form for creating a new desobe.
     *
     * @return Response
     */
    public function create()
    {
        return view('desobes.create');
    }

    public function createDesobePorId($idEstanque)
    {
        $estanque = $this->estanqueRepository->findWithoutFail($idEstanque);

        if (empty($estanque)) {
            Flash::error('No se encontró el estanque: '.$idEstanque);

            return redirect(route('estanques.index'));
        }

        return view('desobes.create')->with('idEstanque', $idEstanque);
    }

    /**
     * Store a newly created desobe in storage.
     *
     * @param CreatedesobeRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreatedesobeRequest $request)
    {
        $input = $request->all();

        $desobe = $this->desobeRepository->create($input);

        Flash::success('Desove saved successfully.');

        return redirect(route('estanques.index'));
    }

    /**
     * Display the specified desobe.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $desobe = $this->desobeRepository->findWithoutFail($id);

        if (empty($desobe)) {
            Flash::error('Desove not found');

            return redirect(route('desoves.index'));
        }

        return view('desobes.show')->with('desobe', $desobe);
    }

    /**
     * Show the form for editing the specified desobe.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $desobe = $this->desobeRepository->findWithoutFail($id);

        if (empty($desobe)) {
            Flash::error('Desobe not found');

            return redirect(route('desobes.index'));
        }

        return view('desobes.edit')->with('desobe', $desobe);
    }

    /**
     * Update the specified desobe in storage.
     *
     * @param  int $id
     * @param UpdatedesobeRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, UpdatedesobeRequest $request)
    {
        $desobe = $this->desobeRepository->findWithoutFail($id);

        if (empty($desobe)) {
            Flash::error('Desobe not found');

            return redirect(route('desobes.index'));
        }

        $desobe = $this->desobeRepository->update($request->all(), $id);

        Flash::success('Desobe updated successfully.');

        return redirect(route('desobes.index'));
    }

    /**
     * Remove the specified desobe from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $desobe = $this->desobeRepository->findWithoutFail($id);

        if (empty($desobe)) {
            Flash::error('Desobe not found');

            return redirect(route('desobes.index'));
        }

        $this->desobeRepository->delete($id);

        Flash::success('Desobe deleted successfully.');

        return redirect(route('desobes.index'));
    }
}
