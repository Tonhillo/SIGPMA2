<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createestanque_desobeRequest;
use App\Http\Requests\Updateestanque_desobeRequest;
use App\Repositories\estanque_desobeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class estanque_desobeController extends AppBaseController
{
    /** @var  estanque_desobeRepository */
    private $estanqueDesobeRepository;

    public function __construct(estanque_desobeRepository $estanqueDesobeRepo)
    {
        $this->estanqueDesobeRepository = $estanqueDesobeRepo;
    }

    /**
     * Display a listing of the estanque_desobe.
     *
     * @param Request $request
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(Request $request)
    {
        $this->estanqueDesobeRepository->pushCriteria(new RequestCriteria($request));
        $estanqueDesobes = $this->estanqueDesobeRepository->all();

        return view('estanque_desobes.index')
            ->with('estanqueDesobes', $estanqueDesobes);
    }

    /**
     * Show the form for creating a new estanque_desobe.
     *
     * @return Response
     */
    public function create()
    {
        return view('estanque_desobes.create');
    }

    /**
     * Store a newly created estanque_desobe in storage.
     *
     * @param Createestanque_desobeRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Createestanque_desobeRequest $request)
    {
        $input = $request->all();

        $estanqueDesobe = $this->estanqueDesobeRepository->create($input);

        Flash::success('Estanque Desobe saved successfully.');

        return redirect(route('estanqueDesobes.index'));
    }

    /**
     * Display the specified estanque_desobe.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estanqueDesobe = $this->estanqueDesobeRepository->findWithoutFail($id);

        if (empty($estanqueDesobe)) {
            Flash::error('Estanque Desobe not found');

            return redirect(route('estanqueDesobes.index'));
        }

        return view('estanque_desobes.show')->with('estanqueDesobe', $estanqueDesobe);
    }

    /**
     * Show the form for editing the specified estanque_desobe.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $estanqueDesobe = $this->estanqueDesobeRepository->findWithoutFail($id);

        if (empty($estanqueDesobe)) {
            Flash::error('Estanque Desobe not found');

            return redirect(route('estanqueDesobes.index'));
        }

        return view('estanque_desobes.edit')->with('estanqueDesobe', $estanqueDesobe);
    }

    /**
     * Update the specified estanque_desobe in storage.
     *
     * @param  int $id
     * @param Updateestanque_desobeRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, Updateestanque_desobeRequest $request)
    {
        $estanqueDesobe = $this->estanqueDesobeRepository->findWithoutFail($id);

        if (empty($estanqueDesobe)) {
            Flash::error('Estanque Desobe not found');

            return redirect(route('estanqueDesobes.index'));
        }

        $estanqueDesobe = $this->estanqueDesobeRepository->update($request->all(), $id);

        Flash::success('Estanque Desobe updated successfully.');

        return redirect(route('estanqueDesobes.index'));
    }

    /**
     * Remove the specified estanque_desobe from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estanqueDesobe = $this->estanqueDesobeRepository->findWithoutFail($id);

        if (empty($estanqueDesobe)) {
            Flash::error('Estanque Desobe not found');

            return redirect(route('estanqueDesobes.index'));
        }

        $this->estanqueDesobeRepository->delete($id);

        Flash::success('Estanque Desobe deleted successfully.');

        return redirect(route('estanqueDesobes.index'));
    }
}
