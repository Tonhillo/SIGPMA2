<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatenitratosRequest;
use App\Http\Requests\UpdatenitratosRequest;
use App\Repositories\nitratosRepository;
use App\Repositories\estanqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
class nitratosController extends AppBaseController
{
    /** @var  nitratosRepository */
    private $nitratosRepository;
    private $estanqueRepository;
    public function __construct(nitratosRepository $nitratosRepo, estanqueRepository $estanqueRepo)
    {
        $this->nitratosRepository = $nitratosRepo;
        $this->estanqueRepository = $estanqueRepo;
    }

    /**
     * Display a listing of the nitratos.
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
            $this->nitratosRepository->pushCriteria(new RequestCriteria($request));
            $nitratos = $this->nitratosRepository->findWhereIn('id_estanque',$idEstanques)->sortBy('fecha');
            $currentPage = Paginator::resolveCurrentPage() - 1;
            $perPage = 10;
            $currentPageSearchResults = $nitratos->slice($currentPage * $perPage, $perPage)->all();
            $nitratos = new LengthAwarePaginator($currentPageSearchResults, count($nitratos), $perPage);
        }
        catch(\Exception $e){
            Flash::error('Deben Existir Estanques en el recinto.');

            return redirect(route('estanques.index'));
        }


        return view('nitratos.index')
            ->with('nitratos', $nitratos)->with('estanques', $estanques);
    }

    /**
     * Show the form for creating a new nitratos.
     *
     * @return Response
     */
    public function create()
    {
        return view('nitratos.create');
    }

    /**
     * Store a newly created nitratos in storage.
     *
     * @param CreatenitratosRequest $request
     *
     * @return Response
     */
    public function store(CreatenitratosRequest $request)
    {
        $input = $request->all();

        $nitratos = $this->nitratosRepository->create($input);

        Flash::success('Nitratos saved successfully.');

        return redirect(route('nitratos.index'));
    }

    /**
     * Display the specified nitratos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nitratos = $this->nitratosRepository->findWithoutFail($id);

        if (empty($nitratos)) {
            Flash::error('Nitratos not found');

            return redirect(route('nitratos.index'));
        }

        return view('nitratos.show')->with('nitratos', $nitratos);
    }

    /**
     * Show the form for editing the specified nitratos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nitratos = $this->nitratosRepository->findWithoutFail($id);

        if (empty($nitratos)) {
            Flash::error('Nitratos not found');

            return redirect(route('nitratos.index'));
        }

        return view('nitratos.edit')->with('nitratos', $nitratos);
    }

    /**
     * Update the specified nitratos in storage.
     *
     * @param  int              $id
     * @param UpdatenitratosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatenitratosRequest $request)
    {
        $nitratos = $this->nitratosRepository->findWithoutFail($id);

        if (empty($nitratos)) {
            Flash::error('Nitratos not found');

            return redirect(route('nitratos.index'));
        }

        $nitratos = $this->nitratosRepository->update($request->all(), $id);

        Flash::success('Nitratos updated successfully.');

        return redirect(route('nitratos.index'));
    }

    /**
     * Remove the specified nitratos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nitratos = $this->nitratosRepository->findWithoutFail($id);

        if (empty($nitratos)) {
            Flash::error('Nitratos not found');

            return redirect(route('nitratos.index'));
        }

        $this->nitratosRepository->delete($id);

        Flash::success('Nitratos deleted successfully.');

        return redirect(route('nitratos.index'));
    }
}
