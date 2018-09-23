<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetemperaturaRequest;
use App\Http\Requests\UpdatetemperaturaRequest;
use App\Repositories\temperaturaRepository;
use App\Repositories\estanqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;

class temperaturaController extends AppBaseController
{
    /** @var  temperaturaRepository */
    private $temperaturaRepository;
    private $estanqueRepository;
    public function __construct(temperaturaRepository $temperaturaRepo, estanqueRepository $estanqueRepo)
    {
        $this->temperaturaRepository = $temperaturaRepo;
        $this->estanqueRepository = $estanqueRepo;
    }

    /**
     * Display a listing of the temperatura.
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
            $this->temperaturaRepository->pushCriteria(new RequestCriteria($request));
            $temperaturas = $this->temperaturaRepository->findWhereIn('id_estanque',$idEstanques)->sortBy('fecha');
            $currentPage = Paginator::resolveCurrentPage() - 1;
            $perPage = 10;
            $currentPageSearchResults = $temperaturas->slice($currentPage * $perPage, $perPage)->all();
            $temperaturas = new LengthAwarePaginator($currentPageSearchResults, count($temperaturas), $perPage);
        }
        catch(\Exception $e){
            Flash::error('Deben Existir Estanques en el recinto.');

            return redirect(route('estanques.index'));
        }


        return view('temperaturas.index')
            ->with('temperaturas', $temperaturas)->with('estanques', $estanques);
    }

    /**
     * Show the form for creating a new temperatura.
     *
     * @return Response
     */
    public function create()
    {
        return view('temperaturas.create');
    }

    /**
     * Store a newly created temperatura in storage.
     *
     * @param CreatetemperaturaRequest $request
     *
     * @return Response
     */
    public function store(CreatetemperaturaRequest $request)
    {
        $input = $request->all();

        $temperatura = $this->temperaturaRepository->create($input);

        Flash::success('Temperatura saved successfully.');

        return redirect(route('temperaturas.index'));
    }

    /**
     * Display the specified temperatura.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $temperatura = $this->temperaturaRepository->findWithoutFail($id);

        if (empty($temperatura)) {
            Flash::error('Temperatura not found');

            return redirect(route('temperaturas.index'));
        }

        return view('temperaturas.show')->with('temperatura', $temperatura);
    }

    /**
     * Show the form for editing the specified temperatura.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $temperatura = $this->temperaturaRepository->findWithoutFail($id);

        if (empty($temperatura)) {
            Flash::error('Temperatura not found');

            return redirect(route('temperaturas.index'));
        }

        return view('temperaturas.edit')->with('temperatura', $temperatura);
    }

    /**
     * Update the specified temperatura in storage.
     *
     * @param  int              $id
     * @param UpdatetemperaturaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetemperaturaRequest $request)
    {
        $temperatura = $this->temperaturaRepository->findWithoutFail($id);

        if (empty($temperatura)) {
            Flash::error('Temperatura not found');

            return redirect(route('temperaturas.index'));
        }

        $temperatura = $this->temperaturaRepository->update($request->all(), $id);

        Flash::success('Temperatura updated successfully.');

        return redirect(route('temperaturas.index'));
    }

    /**
     * Remove the specified temperatura from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $temperatura = $this->temperaturaRepository->findWithoutFail($id);

        if (empty($temperatura)) {
            Flash::error('Temperatura not found');

            return redirect(route('temperaturas.index'));
        }

        $this->temperaturaRepository->delete($id);

        Flash::success('Temperatura deleted successfully.');

        return redirect(route('temperaturas.index'));
    }
}
