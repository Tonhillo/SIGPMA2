<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesalinidadRequest;
use App\Http\Requests\UpdatesalinidadRequest;
use App\Repositories\salinidadRepository;
use App\Repositories\estanqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
class salinidadController extends AppBaseController
{
    /** @var  salinidadRepository */
    private $salinidadRepository;
    private $estanqueRepository;

    public function __construct(salinidadRepository $salinidadRepo, estanqueRepository $estanqueRepo)
    {
        $this->salinidadRepository = $salinidadRepo;
        $this->estanqueRepository = $estanqueRepo;
    }

    /**
     * Display a listing of the salinidad.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->salinidadRepository->pushCriteria(new RequestCriteria($request));
        $salinidads = $this->salinidadRepository->all();
        $this->estanqueRepository->pushCriteria(new RequestCriteria($request));
        try{
            $estanques = $this->estanqueRepository->findByField('id_recinto',Auth::user()->id_recinto);
            $idEstanques=$estanques->pluck('id')->toArray();
            $this->salinidadRepository->pushCriteria(new RequestCriteria($request));
            $salinidades = $this->salinidadRepository->findWhereIn('id_estanque',$idEstanques)->sortBy('fecha');
            $currentPage = Paginator::resolveCurrentPage() - 1;
            $perPage = 10;
            $currentPageSearchResults = $salinidades->slice($currentPage * $perPage, $perPage)->all();
            $salinidades = new LengthAwarePaginator($currentPageSearchResults, count($salinidades), $perPage);

        }
        catch(\Exception $e){
            Flash::error('Deben Existir Estanques en el recinto.');

            return redirect(route('estanques.index'));
        }


        return view('salinidads.index')
            ->with('salinidades', $salinidades)->with('estanques', $estanques);
    }

    /**
     * Show the form for creating a new salinidad.
     *
     * @return Response
     */
    public function create()
    {
        return view('salinidads.create');
    }

    /**
     * Store a newly created salinidad in storage.
     *
     * @param CreatesalinidadRequest $request
     *
     * @return Response
     */
    public function store(CreatesalinidadRequest $request)
    {
        $input = $request->all();

        $salinidad = $this->salinidadRepository->create($input);

        Flash::success('Salinidad saved successfully.');

        return redirect(route('salinidads.index'));
    }

    /**
     * Display the specified salinidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $salinidad = $this->salinidadRepository->findWithoutFail($id);

        if (empty($salinidad)) {
            Flash::error('Salinidad not found');

            return redirect(route('salinidads.index'));
        }

        return view('salinidads.show')->with('salinidad', $salinidad);
    }

    /**
     * Show the form for editing the specified salinidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $salinidad = $this->salinidadRepository->findWithoutFail($id);

        if (empty($salinidad)) {
            Flash::error('Salinidad not found');

            return redirect(route('salinidads.index'));
        }

        return view('salinidads.edit')->with('salinidad', $salinidad);
    }

    /**
     * Update the specified salinidad in storage.
     *
     * @param  int              $id
     * @param UpdatesalinidadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesalinidadRequest $request)
    {
        $salinidad = $this->salinidadRepository->findWithoutFail($id);

        if (empty($salinidad)) {
            Flash::error('Salinidad not found');

            return redirect(route('salinidads.index'));
        }

        $salinidad = $this->salinidadRepository->update($request->all(), $id);

        Flash::success('Salinidad updated successfully.');

        return redirect(route('salinidads.index'));
    }

    /**
     * Remove the specified salinidad from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $salinidad = $this->salinidadRepository->findWithoutFail($id);

        if (empty($salinidad)) {
            Flash::error('Salinidad not found');

            return redirect(route('salinidads.index'));
        }

        $this->salinidadRepository->delete($id);

        Flash::success('Salinidad deleted successfully.');

        return redirect(route('salinidads.index'));
    }
}
