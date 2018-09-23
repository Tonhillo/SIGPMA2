<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateoxigenoRequest;
use App\Http\Requests\UpdateoxigenoRequest;
use App\Repositories\oxigenoRepository;
use App\Repositories\estanqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;

class oxigenoController extends AppBaseController
{
    /** @var  oxigenoRepository */
    private $oxigenoRepository;
    private $estanqueRepository;
    public function __construct(oxigenoRepository $oxigenoRepo, estanqueRepository $estanqueRepo)
    {
        $this->oxigenoRepository = $oxigenoRepo;
        $this->estanqueRepository = $estanqueRepo;
    }

    /**
     * Display a listing of the oxigeno.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->estanqueRepository->pushCriteria(new RequestCriteria($request));
        try{


            $estanques = $this->estanqueRepository->findByField('id_recinto',Auth::user()->id_recinto);
            $idEstanques=$estanques->pluck('id')->toArray();
            $this->oxigenoRepository->pushCriteria(new RequestCriteria($request));
            $oxigenos = $this->oxigenoRepository->findWhereIn('id_estanque',$idEstanques)->sortBy('fecha');
            $currentPage = Paginator::resolveCurrentPage() - 1;
            $perPage = 10;
            $currentPageSearchResults = $oxigenos->slice($currentPage * $perPage, $perPage)->all();
            $oxigenos = new LengthAwarePaginator($currentPageSearchResults, count($oxigenos), $perPage);

        }
        catch(\Exception $e){
            Flash::error('Deben Existir Estanques en el recinto.');

            return redirect(route('estanques.index'));
        }


        return view('oxigenos.index')
            ->with('oxigenos', $oxigenos)->with('estanques', $estanques);
    }

    /**
     * Show the form for creating a new oxigeno.
     *
     * @return Response
     */
    public function create()
    {
        return view('oxigenos.create');
    }

    /**
     * Store a newly created oxigeno in storage.
     *
     * @param CreateoxigenoRequest $request
     *
     * @return Response
     */
    public function store(CreateoxigenoRequest $request)
    {
        $input = $request->all();

        $oxigeno = $this->oxigenoRepository->create($input);

        Flash::success('Oxigeno saved successfully.');

        return redirect(route('oxigenos.index'));
    }

    /**
     * Display the specified oxigeno.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $oxigeno = $this->oxigenoRepository->findWithoutFail($id);

        if (empty($oxigeno)) {
            Flash::error('Oxigeno not found');

            return redirect(route('oxigenos.index'));
        }

        return view('oxigenos.show')->with('oxigeno', $oxigeno);
    }

    /**
     * Show the form for editing the specified oxigeno.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $oxigeno = $this->oxigenoRepository->findWithoutFail($id);

        if (empty($oxigeno)) {
            Flash::error('Oxigeno not found');

            return redirect(route('oxigenos.index'));
        }

        return view('oxigenos.edit')->with('oxigeno', $oxigeno);
    }

    /**
     * Update the specified oxigeno in storage.
     *
     * @param  int              $id
     * @param UpdateoxigenoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateoxigenoRequest $request)
    {
        $oxigeno = $this->oxigenoRepository->findWithoutFail($id);

        if (empty($oxigeno)) {
            Flash::error('Oxigeno not found');

            return redirect(route('oxigenos.index'));
        }

        $oxigeno = $this->oxigenoRepository->update($request->all(), $id);

        Flash::success('Oxigeno updated successfully.');

        return redirect(route('oxigenos.index'));
    }

    /**
     * Remove the specified oxigeno from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $oxigeno = $this->oxigenoRepository->findWithoutFail($id);

        if (empty($oxigeno)) {
            Flash::error('Oxigeno not found');

            return redirect(route('oxigenos.index'));
        }

        $this->oxigenoRepository->delete($id);

        Flash::success('Oxigeno deleted successfully.');

        return redirect(route('oxigenos.index'));
    }
}
