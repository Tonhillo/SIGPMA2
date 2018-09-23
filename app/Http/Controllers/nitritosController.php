<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatenitritosRequest;
use App\Http\Requests\UpdatenitritosRequest;
use App\Repositories\nitritosRepository;
use App\Repositories\estanqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;

class nitritosController extends AppBaseController
{
    /** @var  nitritosRepository */
    private $nitritosRepository;
    private $estanqueRepository;

    public function __construct(nitritosRepository $nitritosRepo, estanqueRepository $estanqueRepo)
    {
        $this->nitritosRepository = $nitritosRepo;
        $this->estanqueRepository = $estanqueRepo;
    }

    /**
     * Display a listing of the nitritos.
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
            $this->nitritosRepository->pushCriteria(new RequestCriteria($request));
            $nitritos = $this->nitritosRepository->findWhereIn('id_estanque',$idEstanques)->sortBy('fecha');
            $currentPage = Paginator::resolveCurrentPage() - 1;
            $perPage = 10;
            $currentPageSearchResults = $nitritos->slice($currentPage * $perPage, $perPage)->all();
            $nitritos = new LengthAwarePaginator($currentPageSearchResults, count($nitritos), $perPage);

        }
        catch(\Exception $e){
            Flash::error('Deben Existir Estanques en el recinto.');

            return redirect(route('estanques.index'));
        }

        return view('nitritos.index')
            ->with('nitritos', $nitritos)->with('estanques', $estanques);
    }

    /**
     * Show the form for creating a new nitritos.
     *
     * @return Response
     */
    public function create()
    {
        return view('nitritos.create');
    }

    /**
     * Store a newly created nitritos in storage.
     *
     * @param CreatenitritosRequest $request
     *
     * @return Response
     */
    public function store(CreatenitritosRequest $request)
    {
        $input = $request->all();

        $nitritos = $this->nitritosRepository->create($input);

        Flash::success('Nitritos saved successfully.');

        return redirect(route('nitritos.index'));
    }

    /**
     * Display the specified nitritos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nitritos = $this->nitritosRepository->findWithoutFail($id);

        if (empty($nitritos)) {
            Flash::error('Nitritos not found');

            return redirect(route('nitritos.index'));
        }

        return view('nitritos.show')->with('nitritos', $nitritos);
    }

    /**
     * Show the form for editing the specified nitritos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nitritos = $this->nitritosRepository->findWithoutFail($id);

        if (empty($nitritos)) {
            Flash::error('Nitritos not found');

            return redirect(route('nitritos.index'));
        }

        return view('nitritos.edit')->with('nitritos', $nitritos);
    }

    /**
     * Update the specified nitritos in storage.
     *
     * @param  int              $id
     * @param UpdatenitritosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatenitritosRequest $request)
    {
        $nitritos = $this->nitritosRepository->findWithoutFail($id);

        if (empty($nitritos)) {
            Flash::error('Nitritos not found');

            return redirect(route('nitritos.index'));
        }

        $nitritos = $this->nitritosRepository->update($request->all(), $id);

        Flash::success('Nitritos updated successfully.');

        return redirect(route('nitritos.index'));
    }

    /**
     * Remove the specified nitritos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nitritos = $this->nitritosRepository->findWithoutFail($id);

        if (empty($nitritos)) {
            Flash::error('Nitritos not found');

            return redirect(route('nitritos.index'));
        }

        $this->nitritosRepository->delete($id);

        Flash::success('Nitritos deleted successfully.');

        return redirect(route('nitritos.index'));
    }
}
