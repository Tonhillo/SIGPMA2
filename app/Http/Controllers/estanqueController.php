<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateestanqueRequest;
use App\Http\Requests\UpdateestanqueRequest;
use App\Repositories\estanqueRepository;
use App\Repositories\Estanque_especieRepository;
use App\Repositories\especieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\estanque;
use App\Models\especie;
use App\Models\Estanque_especie;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
// RECINTO
use App\Models\recinto;
class estanqueController extends AppBaseController
{
    /** @var  estanqueRepository */
    private $estanqueRepository;
    private $estanqueEspecieRepository;
    private $especieRepository;
    public function __construct(estanqueRepository $estanqueRepo, Estanque_especieRepository $estanqueEspecieRepo, especieRepository $especieRepo)
    {
        $this->especieRepository = $especieRepo;
        $this->estanqueEspecieRepository = $estanqueEspecieRepo;
        $this->estanqueRepository = $estanqueRepo;
    }

    /**
     * Display a listing of the estanque.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->estanqueRepository->pushCriteria(new RequestCriteria($request));
        $estanques = $this->estanqueRepository->findByField('id_recinto',Auth::user()->id_recinto);

        return view('estanques.index')
            ->with('estanques', $estanques);
    }

    /**
     * Display a listing of the estanque.
     *
     * @param Request $request
     * @return Response
     */
    public function create()
    {
    $recinto = recinto::pluck('nombre', 'id');

      return view('estanques.create',compact('recinto'));
    }

    /**
     * Store a newly created estanque in storage.
     *
     * @param CreateestanqueRequest $request
     *
     * @return Response
     */
    public function store(CreateestanqueRequest $request)
    {
    	$input = $request->all();
        $volumen = $request->volumen;
        if($volumen <= 0){
            Flash::error('El volumen del estanque no puede ser negativo');
            return redirect(route('estanques.index'));
        }
        else{
        $estanque = $this->estanqueRepository->create($input);
        Flash::success('El estanque se ha guardado correctamente.');
        return redirect(route('estanques.index'));
        }

        return redirect(route('estanques.index'));
    }

    /**
     * Display the specified estanque.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estanque = $this->estanqueRepository->findWithoutFail($id);

        if (empty($estanque)) {
            Flash::error('Estanque no encontrado');

            return redirect(route('estanques.index'));
        }

        return view('estanques.show')->with('estanque', $estanque);
    }

    /**
     * Show the form for editing the specified estanque.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $recinto = recinto::pluck('nombre', 'id');
        $estanque = $this->estanqueRepository->findWithoutFail($id);

        if (empty($estanque)) {
            Flash::error('Estanque no encontrado');

            return redirect(route('estanques.index'));
        }

        return view('estanques.edit', compact('recinto'))->with('estanque', $estanque);
    }

    /**
     * Update the specified estanque in storage.
     *
     * @param  int              $id
     * @param UpdateestanqueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateestanqueRequest $request)
    {
        $estanque = $this->estanqueRepository->findWithoutFail($id);

        if (empty($estanque)) {
            Flash::error('Estanque no encontrado');

            return redirect(route('estanques.index'));
        }

        $estanque = $this->estanqueRepository->update($request->all(), $id);

        Flash::success('Estanque modificado correctamente.');

        return redirect(route('estanques.index'));
    }

    /**
     * Remove the specified estanque from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estanque = $this->estanqueRepository->findWithoutFail($id);

        if (empty($estanque)) {
            Flash::error('Estanque no encontrado');

            return redirect(route('estanques.index'));
        }

        $this->estanqueRepository->delete($id);

        Flash::success('Estanque eliminado correctamente.');

        return redirect(route('estanques.index'));
    }


    //Devuelve Todos los estanques Registrados en acuario
    public function listaPeceras(Request $request){
        $this->estanqueRepository->pushCriteria(new RequestCriteria($request));
        $estanques = $this->estanqueRepository->findByField('id_recinto',1);

//        return view('pecerasList')
//            ->with('estanques', $estanques);
        return response()->json($estanques);
    }
    //Devuelve Todas las especies Registradas en EstanqueEspecie
    public function listaPeces($idEstanque){
//
//        $estanques = estanque::where('id_recinto', '1')->pluck('id', 'num_estanque');
//        $estanqueEspecies = Estanque_especie::where('id_estanque', $idEstanque)->pluck('id_especie', 'id');
//        $especies = especie::where('id', $estanqueEspecies)->get();
//
//        return view('pecesList')->with('especies', $especies);

        $estanques = estanque::where('id_recinto', '1')->pluck('id', 'num_estanque');
        $estanqueEspecies = Estanque_especie::where('id_estanque', $idEstanque)->pluck('id_especie');
        $especies = especie::whereIn('id', $estanqueEspecies)->whereNull('deleted_at')->get();

       // return view('pecesList')->with('especies', $especies);
        return response()->json($especies);
    }
//    public function estanqueEspeciesList(Request $request){
//        $this->estanqueEspecieRepository->pushCriteria(new RequestCriteria($request));
//        $estanqueEspecies = $this->estanqueEspecieRepository->all();
//
//        return view('estanqueEspecie')
//            ->with('estanqueEspecies', $estanqueEspecies);
//    }

}
