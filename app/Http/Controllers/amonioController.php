<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateamonioRequest;
use App\Http\Requests\UpdateamonioRequest;
use App\Repositories\amonioRepository;
use App\Repositories\estanqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;

class amonioController extends AppBaseController
{
    /** @var  amonioRepository */
    private $amonioRepository;
    /** @var  estanqueRepository */
    private $estanqueRepository;

    public function __construct(amonioRepository $amonioRepo, estanqueRepository $estanqueRepo)
    {
        $this->amonioRepository = $amonioRepo;
        $this->estanqueRepository = $estanqueRepo;
    }

    /**
     * Display a listing of the amonio.
     *
     * @param Request $request
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(Request $request)
    {
        $this->estanqueRepository->pushCriteria(new RequestCriteria($request));
        try{
            $estanques = $this->estanqueRepository->findByField('id_recinto',Auth::user()->id_recinto);
            $idEstanques=$estanques->pluck('id')->toArray();
            $this->amonioRepository->pushCriteria(new RequestCriteria($request));
            $amonios = $this->amonioRepository->findWhereIn('id_estanque',$idEstanques)->sortBy('fecha');
            $currentPage = Paginator::resolveCurrentPage() - 1;
            $perPage = 10;
            $currentPageSearchResults = $amonios->slice($currentPage * $perPage, $perPage)->all();
            $amonios = new LengthAwarePaginator($currentPageSearchResults, count($amonios), $perPage);
        }
        catch(\Exception $e){
            Flash::error('Deben Existir Estanques en el recinto.');

            return redirect(route('estanques.index'));
        }


        return view('amonios.index')
            ->with('amonios', $amonios)->with('estanques', $estanques);
    }

    /**
     * Show the form for creating a new amonio.
     *
     * @return Response
     */
    public function create()
    {
        return view('amonios.create');
    }

    /**
     * Store a newly created amonio in storage.
     *
     * @param CreateamonioRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreateamonioRequest $request)
    {
        $input = $request->all();

        $amonio = $this->amonioRepository->create($input);

        Flash::success('Amonio saved successfully.');

        return redirect(route('amonios.index'));
    }

    /**
     * Display the specified amonio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $amonio = $this->amonioRepository->findWithoutFail($id);

        if (empty($amonio)) {
            Flash::error('Amonio not found');

            return redirect(route('amonios.index'));
        }

        return view('amonios.show')->with('amonio', $amonio);
    }

    /**
     * Show the form for editing the specified amonio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $amonio = $this->amonioRepository->findWithoutFail($id);

        if (empty($amonio)) {
            Flash::error('Amonio not found');

            return redirect(route('amonios.index'));
        }

        return view('amonios.edit')->with('amonio', $amonio);
    }

    /**
     * Update the specified amonio in storage.
     *
     * @param  int $id
     * @param UpdateamonioRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, UpdateamonioRequest $request)
    {
        $amonio = $this->amonioRepository->findWithoutFail($id);

        if (empty($amonio)) {
            Flash::error('Amonio not found');

            return redirect(route('amonios.index'));
        }

        $amonio = $this->amonioRepository->update($request->all(), $id);

        Flash::success('Amonio updated successfully.');

        return redirect(route('amonios.index'));
    }

    /**
     * Remove the specified amonio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $amonio = $this->amonioRepository->findWithoutFail($id);

        if (empty($amonio)) {
            Flash::error('Amonio not found');

            return redirect(route('amonios.index'));
        }

        $this->amonioRepository->delete($id);

        Flash::success('Amonio deleted successfully.');

        return redirect(route('amonios.index'));
    }
}
