<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepHRequest;
use App\Http\Requests\UpdatepHRequest;
use App\Repositories\pHRepository;
use App\Repositories\estanqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;

class pHController extends AppBaseController
{
    /** @var  pHRepository */
    private $pHRepository;
    private $estanqueRepository;
    public function __construct(pHRepository $pHRepo, estanqueRepository $estanqueRepo)
    {
        $this->pHRepository = $pHRepo;
        $this->estanqueRepository = $estanqueRepo;
    }

    /**
     * Display a listing of the pH.
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
            $this->pHRepository->pushCriteria(new RequestCriteria($request));
            $pHs = $this->pHRepository->findWhereIn('id_estanque',$idEstanques)->sortBy('fecha');
            $currentPage = Paginator::resolveCurrentPage() - 1;
            $perPage = 10;
            $currentPageSearchResults = $pHs->slice($currentPage * $perPage, $perPage)->all();
            $pHs = new LengthAwarePaginator($currentPageSearchResults, count($pHs), $perPage);


        }
        catch(\Exception $e){
            Flash::error('Deben existir Estanques en el recinto');

            return redirect(route('estanques.index'));
        }

        return view('p_hs.index')
            ->with('pHs', $pHs)->with('estanques', $estanques);
    }

    /**
     * Show the form for creating a new pH.
     *
     * @return Response
     */
    public function create()
    {
        return view('p_hs.create');
    }

    /**
     * Store a newly created pH in storage.
     *
     * @param CreatepHRequest $request
     *
     * @return Response
     */
    public function store(CreatepHRequest $request)
    {
        $input = $request->all();

        $pH = $this->pHRepository->create($input);

        Flash::success('P H saved successfully.');

        return redirect(route('pHs.index'));
    }

    /**
     * Display the specified pH.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pH = $this->pHRepository->findWithoutFail($id);

        if (empty($pH)) {
            Flash::error('P H not found');

            return redirect(route('pHs.index'));
        }

        return view('p_hs.show')->with('pH', $pH);
    }

    /**
     * Show the form for editing the specified pH.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pH = $this->pHRepository->findWithoutFail($id);

        if (empty($pH)) {
            Flash::error('P H not found');

            return redirect(route('pHs.index'));
        }

        return view('p_hs.edit')->with('pH', $pH);
    }

    /**
     * Update the specified pH in storage.
     *
     * @param  int              $id
     * @param UpdatepHRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepHRequest $request)
    {
        $pH = $this->pHRepository->findWithoutFail($id);

        if (empty($pH)) {
            Flash::error('P H not found');

            return redirect(route('pHs.index'));
        }

        $pH = $this->pHRepository->update($request->all(), $id);

        Flash::success('P H updated successfully.');

        return redirect(route('pHs.index'));
    }

    /**
     * Remove the specified pH from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pH = $this->pHRepository->findWithoutFail($id);

        if (empty($pH)) {
            Flash::error('P H not found');

            return redirect(route('pHs.index'));
        }

        $this->pHRepository->delete($id);

        Flash::success('P H deleted successfully.');

        return redirect(route('pHs.index'));
    }
}
