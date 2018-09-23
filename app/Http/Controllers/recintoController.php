<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateestanqueRequest;
use App\Http\Requests\UpdateestanqueRequest;
use App\Repositories\estanqueRepository;
use App\Http\Requests\CreaterecintoRequest;
use App\Http\Requests\UpdaterecintoRequest;
use App\Repositories\recintoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use App\Quotation;

class recintoController extends AppBaseController
{
    /** @var  recintoRepository */
    private $recintoRepository;

    public function __construct(recintoRepository $recintoRepo, estanqueRepository $estanqueRepo)
    {
        $this->estanqueRepository = $estanqueRepo;
        $this->recintoRepository = $recintoRepo;
    }

    /**
     * Display a listing of the recinto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->recintoRepository->pushCriteria(new RequestCriteria($request));
        $recintos = $this->recintoRepository->all();

        return view('recintos.index')
            ->with('recintos', $recintos);
    }

    /**
     * Show the form for creating a new recinto.
     *
     * @return Response
     */
    public function create()
    {
        return view('recintos.create');
    }

    /**
     * Store a newly created recinto in storage.
     *
     * @param CreaterecintoRequest $request
     *
     * @return Response
     */
    public function store(CreaterecintoRequest $request)
    {
        $input = $request->all();

        $recinto = $this->recintoRepository->create($input);

        Flash::success('El recinto se ha guardado correctamente.');

        return redirect(route('recintos.index'));
    }

    /**
     * Display the specified recinto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $recinto = $this->recintoRepository->findWithoutFail($id);

        if (empty($recinto)) {
            Flash::error('Recinto no encontrado');

            return redirect(route('recintos.index'));
        }

        return view('recintos.show')->with('recinto', $recinto);
    }

    /**
     * Show the form for editing the specified recinto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $recinto = $this->recintoRepository->findWithoutFail($id);

        if (empty($recinto)) {
            Flash::error('Recinto no encontrado');

            return redirect(route('recintos.index'));
        }

        return view('recintos.edit')->with('recinto', $recinto);
    }

    /**
     * Update the specified recinto in storage.
     *
     * @param  int              $id
     * @param UpdaterecintoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterecintoRequest $request)
    {
        $recinto = $this->recintoRepository->findWithoutFail($id);

        if (empty($recinto)) {
            Flash::error('Recinto no encontrado');

            return redirect(route('recintos.index'));
        }

        $recinto = $this->recintoRepository->update($request->all(), $id);

        Flash::success('Recinto modificado correctamente.');

        return redirect(route('recintos.index'));
    }

    /**
     * Remove the specified recinto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $recinto = $this->recintoRepository->findWithoutFail($id);

        if (empty($recinto)) {
            Flash::error('Recinto no encontrado');

            return redirect(route('recintos.index'));
        }
        $ToDelete=[$id];
        DB::table('estanques')->whereIn('id_recinto', $ToDelete)->delete();
        $this->recintoRepository->delete($id);

        Flash::success('Recinto eliminado correctamente.');

        return redirect(route('recintos.index'));
    }
}
