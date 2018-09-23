<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createestanque_alimentacionRequest;
use App\Http\Requests\Updateestanque_alimentacionRequest;
use App\Repositories\estanque_alimentacionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\estanque;
use App\Models\alimentos;
use App\Repositories\estanqueRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
class estanque_alimentacionController extends AppBaseController
{
    /** @var  estanque_alimentacionRepository */
    private $estanqueAlimentacionRepository;

    public function __construct(estanque_alimentacionRepository $estanqueAlimentacionRepo,estanqueRepository $estanqueRepo)
    {
        $this->estanqueAlimentacionRepository = $estanqueAlimentacionRepo;
        $this->estanqueRepository = $estanqueRepo;
    }

    /**
     * Display a listing of the estanque_alimentacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        try{
            $estanques = $this->estanqueRepository->findByField('id_recinto',Auth::user()->id_recinto);
            $idEstanques=$estanques->pluck('id')->toArray();
            $this->estanqueAlimentacionRepository->pushCriteria(new RequestCriteria($request));
            $estanqueAlimentacions = $this->estanqueAlimentacionRepository->all();
            $currentPage = Paginator::resolveCurrentPage() - 1;
            $perPage = 10;
            $currentPageSearchResults = $estanqueAlimentacions->slice($currentPage * $perPage, $perPage)->sortBy('fecha_alimentacion');
            $estanqueAlimentacions = new LengthAwarePaginator($currentPageSearchResults, count($estanqueAlimentacions), $perPage);

        }catch(\Exception $e){
            Flash::error('Deben Existir Estanques en el recinto.');

            return redirect(route('estanques.index'));
        }
        return view('estanque_alimentacions.index')
            ->with('estanqueAlimentacions', $estanqueAlimentacions)->with('estanques', $estanques);;
    }
    public function alimentacionPorEstanque($idEstanque){
        $estanque=estanque::where('id', $idEstanque)->get();
        $numeroEstanque=$estanque[0]->num_estanque;
        $alimentos=alimentos::all();

        return view('estanque_alimentacions.create', compact('especies','idEstanque', 'numeroEstanque', 'alimentos'));
    }
    /**
     * Show the form for creating a new estanque_alimentacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('estanque_alimentacions.create');
    }

    /**
     * Store a newly created estanque_alimentacion in storage.
     *
     * @param Createestanque_alimentacionRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Createestanque_alimentacionRequest $request)
    {
        $input = $request->all();
        $idEstanque=$input['id_estanque'];
        $estanqueAlimentacion = $this->estanqueAlimentacionRepository->create($input);

        Flash::success('Alimentacion Guardada Correctamente');

        return redirect('estanques');
    }

    /**
     * Display the specified estanque_alimentacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estanqueAlimentacion = $this->estanqueAlimentacionRepository->findWithoutFail($id);

        if (empty($estanqueAlimentacion)) {
            Flash::error('Estanque Alimentacion not found');

            return redirect(route('estanqueAlimentacions.index'));
        }

        return view('estanque_alimentacions.show')->with('estanqueAlimentacion', $estanqueAlimentacion);
    }

    /**
     * Show the form for editing the specified estanque_alimentacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $estanqueAlimentacion = $this->estanqueAlimentacionRepository->findWithoutFail($id);
        $estanque=estanque::where('id', $estanqueAlimentacion->id_estanque)->get();
        $idEstanque=$estanque[0]->id;
        $numeroEstanque=$estanque[0]->num_estanque;
        $alimentos=alimentos::all();
        if (empty($estanqueAlimentacion)) {
            Flash::error('Estanque Alimentacion not found');

            return redirect(route('estanqueAlimentacions.index'));
        }
        return view('estanque_alimentacions.edit', compact('especies','idEstanque', 'numeroEstanque', 'alimentos'))->with('estanqueAlimentacion', $estanqueAlimentacion);
    }

    /**
     * Update the specified estanque_alimentacion in storage.
     *
     * @param  int $id
     * @param Updateestanque_alimentacionRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, Updateestanque_alimentacionRequest $request)
    {
        $estanqueAlimentacion = $this->estanqueAlimentacionRepository->findWithoutFail($id);

        if (empty($estanqueAlimentacion)) {
            Flash::error('Estanque Alimentacion not found');

            return redirect(route('estanqueAlimentacions.index'));
        }

        $estanqueAlimentacion = $this->estanqueAlimentacionRepository->update($request->all(), $id);

        Flash::success('Estanque Alimentacion updated successfully.');

        return redirect(route('estanqueAlimentacions.index'));
    }

    /**
     * Remove the specified estanque_alimentacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estanqueAlimentacion = $this->estanqueAlimentacionRepository->findWithoutFail($id);

        if (empty($estanqueAlimentacion)) {
            Flash::error('Estanque Alimentacion not found');

            return redirect(route('estanqueAlimentacions.index'));
        }

        $this->estanqueAlimentacionRepository->delete($id);

        Flash::success('Estanque Alimentacion deleted successfully.');

        return redirect(route('estanqueAlimentacions.index'));
    }
}
