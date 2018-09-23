<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEstanque_especieRequest;
use App\Http\Requests\UpdateEstanque_especieRequest;
use App\Repositories\Estanque_especie_defuncionRepository;
use App\Repositories\Estanque_especie_trasladoRepository;
use App\Repositories\Estanque_especieRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\estanqueRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\especie;
use App\Models\estanque;
use App\Models\alimentos;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class Estanque_especieController extends AppBaseController
{
    /** @var  Estanque_especieRepository */
    private $estanqueEspecieRepository;
    private $estanqueRepository;
    private $estanqueEspecieTrasladoRepository;
    private $estanque_especie_defuncionRepository;

    /**
     * Estanque_especieController constructor.
     * @param Estanque_especieRepository $estanqueEspecieRepo
     * @param estanqueRepository $estanqueRepository
     * @param Estanque_especie_trasladoRepository $estanqueEspecieTrasladoRepository
     * @param Estanque_especie_defuncionRepository $estanque_especie_defuncionRepository
     */
    public function __construct(Estanque_especieRepository $estanqueEspecieRepo, EstanqueRepository $estanqueRepository,
                                Estanque_especie_trasladoRepository $estanqueEspecieTrasladoRepository,
                                Estanque_especie_defuncionRepository $estanque_especie_defuncionRepository)
    {
        $this->estanqueEspecieRepository = $estanqueEspecieRepo;
        $this->estanqueRepository = $estanqueRepository;
        $this->estanqueEspecieTrasladoRepository = $estanqueEspecieTrasladoRepository;
        $this->estanque_especie_defuncionRepository = $estanque_especie_defuncionRepository;
    }

    /**
     * Display a listing of the Estanque_especie.
     *
     * @param Request $request
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(Request $request)
    {
        $this->estanqueEspecieRepository->pushCriteria(new RequestCriteria($request));
        $estanqueEspecies = $this->estanqueEspecieRepository->all();

        return view('estanque_especies.index')
            ->with('estanqueEspecies', $estanqueEspecies);
    }

    /**
     * Show the form for creating a new Estanque_especie.
     *
     * @return Response
     */
    public function create($idEstanque)
    {

        $especies= especie::pluck('nombre_comun','id');
        $aliment=alimentos::all();
        return view('estanque_especies.create',compact('especies','idEstanque','aliment'));
      
    }
    public function createPorEstanqueId($idEstanque)
    {
        $especies = $this->estanqueEspecieRepository->especiesDisponiblesParaAgregar($idEstanque);

        //preguntar por la cantidad dispobnile
        if ($especies->count() === 0) {
            Flash::error('Todas especies las están registradas en este estanque');
            return redirect('estanqueEspecies/estanque/'.$idEstanque);
        }

        $estanque=estanque::where('id', $idEstanque)->get();
        $numeroEstanque=$estanque[0]->num_estanque;


        $especies = $especies->pluck('nombre_comun','id');
        return view('estanque_especies.create',compact('especies','idEstanque', 'numeroEstanque'));

    }
    /**
     * Resturn by id Estanque
     *
     */
    public function porEstanqueId(Request $request, $idEstanque){
        try{
            $this->estanqueEspecieRepository->pushCriteria(new RequestCriteria($request));
            $estanqueEspecies = $this->estanqueEspecieRepository->findByField('id_estanque',$idEstanque);
            $estanque=estanque::where('id', $idEstanque)->get();

            $currentPage = Paginator::resolveCurrentPage() - 1;
            $perPage = 10;
            $currentPageSearchResults = $estanqueEspecies->slice($currentPage * $perPage, $perPage)->all();
            $estanqueEspecies = new LengthAwarePaginator($currentPageSearchResults, count($estanqueEspecies), $perPage);
            $estanques=estanque::where('id_recinto', 1)->get();


            //estanques disponibles para tralado
            $estanquesDisponiblesTraslado =  estanque::whereNotIn('id', [$idEstanque])->where('id_recinto', 1)->get();
            $estanquesDisponiblesTraslado = $estanquesDisponiblesTraslado->pluck('num_estanque', 'id');

            return view('estanque_especies.index')
                ->with('estanqueEspecies', $estanqueEspecies)->with('idEstanque', $idEstanque)
                ->with('numeroEstanque', $estanque[0]->num_estanque)->with('estanques', $estanques)
                ->with('estanquesDisponiblesTraslado', $estanquesDisponiblesTraslado);
        }catch(\Exception $e){
            Flash::error('Deben Existir Especies en el sistema.');

            return redirect(view('estanques.index'));
        }

    }

    /**
     * Store a newly created Estanque_especie in storage.
     *
     * @param CreateEstanque_especieRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */

    public function store(CreateEstanque_especieRequest $request)
    {
        $input = $request->all();
        $idEstanque=$input['id_estanque'];
        $estanqueEspecie = $this->estanqueEspecieRepository->create($input);

        Flash::success('A guardado exitosamente un registro.');

        return redirect('estanqueEspecies/estanque/'.$idEstanque);
    }
    /**
     * Display the specified Estanque_especie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estanqueEspecie = $this->estanqueEspecieRepository->findWithoutFail($id);

        if (empty($estanqueEspecie)) {
            Flash::error('Estanque Especie not found');

            return redirect(route('estanqueEspecies.index'));
        }

        return view('estanque_especies.show')->with('estanqueEspecie', $estanqueEspecie);
    }

    /**
     * Show the form for editing the specified Estanque_especie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $especies= especie::pluck('nombre_comun','id');

        $estanqueEspecie = $this->estanqueEspecieRepository->findWithoutFail($id);
        $estanques=estanque::where('id', $estanqueEspecie->id_estanque)->get();
        $numeroEstanque=$estanques[0]->num_estanque;
        $idEstanque=$estanques[0]->id;
        $estanqueEspecie = $this->estanqueEspecieRepository->findWithoutFail($id);
        if (empty($estanqueEspecie)) {
            Flash::error('Estanque Especie not found');

            return redirect(route('estanqueEspecies.index'));
        }

        return view('estanque_especies.edit',compact('especies','idEstanque', 'numeroEstanque'))->with('estanqueEspecie', $estanqueEspecie);
    }

    /**
     * Update the specified Estanque_especie in storage.
     *
     * @param  int $id
     * @param UpdateEstanque_especieRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, UpdateEstanque_especieRequest $request)
    {
        $estanqueEspecie = $this->estanqueEspecieRepository->findWithoutFail($id);

        if (empty($estanqueEspecie)) {
            Flash::error('Estanque Especie not found');

            return redirect(route('estanques.index'));
        }

        $estanqueEspecie = $this->estanqueEspecieRepository->update($request->all(), $id);

        Flash::success('A modificado correctamente el registro.');

        return redirect(route('estanques.index'));
    }

    /**
     * Remove the specified Estanque_especie from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estanqueEspecie = $this->estanqueEspecieRepository->findWithoutFail($id);

        if (empty($estanqueEspecie)) {
            Flash::error('Estanque Especie not found');
            return redirect('estanqueEspecies/estanque/'.$id);
        }
        $idEstanque = $estanqueEspecie->id_estanque;
        $this->estanqueEspecieRepository->delete($id);

        Flash::success('A eliminado correctamente un registro.');

        return redirect('estanqueEspecies/estanque/'.$idEstanque);
    }

    /**
     * trasladarEspecie
     *
     * @param  int $id
     * @param Request $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function trasladarEspecie($id, Request $request)
    {
        //request debe resiver estanque de origen, estanque destino, id de la especie
        //tralada la especie de un estanque a otro,
        //revisar si la cantidad a trasladar es valida
        //PROCESO
        //1- Del estanque origen se resta la cantidad
        //2- y se agrega la especie al tanque destino
        //3- se registra el translado en una tabla

        $input = $request->all();

        $estanqueEspecie = $this->estanqueEspecieRepository->find($id);

        $idEspecie = $estanqueEspecie->id_especie;
        $idEstanqueOrigen = $estanqueEspecie->id_estanque;

        if (empty($estanqueEspecie)) {
            Flash::error('Estanque Especie no fué encontrado');

            return redirect('estanqueEspecies/estanque/'.$idEstanqueOrigen);
        }

        $estanqueDestino = $this->estanqueRepository->findWithoutFail( $input['estanqueDestino']);
        $idEstanqueDestino = $estanqueDestino->id;

        if (empty($estanqueDestino)) {
            Flash::error('Estanque de destino no fué encontrado');
            return redirect('estanqueEspecies/estanque/'.$idEstanqueOrigen);
        }

        $cantidad = $input['cantidad'];
        $fecha = $input['fecha'];
        $motivo = $input['motivo'];

        //Checar la cantidad
        if($cantidad >$estanqueEspecie->cantidad){
            Flash::error('La cantidad a trasladar es superior a la actual disponible');
            return redirect('estanqueEspecies/estanque/'.$idEstanqueOrigen);
        }

        //Se cumplen todas las condiciones
        //1- Del estanque origen se resta la cantidad,
        if($estanqueEspecie->cantidad - $cantidad <= 0){
            //eliminar $estanqueEspecie por que el valor es 0
            $this->estanqueEspecieRepository->delete($id);
        }else{
            //actualizar el campo de cantidad
            $this->estanqueEspecieRepository->update(['cantidad'=>$estanqueEspecie->cantidad - $cantidad], $id);
        }

        //2- y se agrega la especie al tanque destino
        //preguntar si la especie ya existe en el estanque
        //entonces actualizar el modelo
        //de lo contrario crear el registro

        $existeEstanqueEspeciaDestino =  $this->estanqueEspecieRepository->findByField(['id_especie'=>$idEspecie, 'id_estanque'=> $idEstanqueDestino])->first();
        if (!empty($existeEstanqueEspeciaDestino)) {
            //actualizar el campo de cantidad
            $this->estanqueEspecieRepository->update(['cantidad'=>$existeEstanqueEspeciaDestino->cantidad + $cantidad], $idEstanqueDestino);

        }else{
            $campos = ['id_especie'=> $idEspecie,
                'id_estanque' => $idEstanqueDestino,
                'cantidad' => $cantidad];
            $this->estanqueEspecieRepository->create($campos);
        }

        //3- se registra el translado en una tabla
        $campos = ['id_especie'=> $idEspecie,
            'id_estanque_origen' => $idEstanqueOrigen,
            'id_estanque_destino'=> $idEstanqueDestino,
            'motivo'=> $motivo,
            'fecha'=>$fecha,
            'cantidad' => $cantidad];

        $this->estanqueEspecieTrasladoRepository->create($campos);

        Flash::success('El traslado fué ejecutado correctamente');
        return redirect('estanqueEspecies/estanque/'.$idEstanqueOrigen);
    }

    /**
     * trasladarEspecie
     *
     * @param  int $id
     * @param Request $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function defuncionEspecie($id, Request $request)
    {
        //request debe recivir estanque id de la especie
        //registra la defuncino de una especie,
        //revisar si la cantidad es valida
        //PROCESO
        //1- Del estanque se resta la cantidad
        //2- se registra la defuncion en una tabla

        $input = $request->all();

        $estanqueEspecie = $this->estanqueEspecieRepository->find($id);

        $idEspecie = $estanqueEspecie->id_especie;
        $idEstanque = $estanqueEspecie->id_estanque;

        $cantidad = $input['cantidad'];
        $fecha = $input['fecha'];
        $motivo = $input['motivo'];

        if (empty($estanqueEspecie)) {
            Flash::error('Estanque Especie no fué encontrado');

            return redirect('estanqueEspecies/estanque/'.$idEstanque);
        }

        //Checar la cantidad
        if($cantidad >$estanqueEspecie->cantidad){
            Flash::error('La cantidad de defunción es superior a la cantidad de especies en el estanque');
            return redirect('estanqueEspecies/estanque/'.$idEstanque);
        }

        //Se cumplen todas las condiciones
        //1- Del estanque origen se resta la cantidad,
        if($estanqueEspecie->cantidad - $cantidad <= 0){
            //eliminar $estanqueEspecie por que el valor es 0
            $this->estanqueEspecieRepository->delete($id);
        }else{
            //actualizar el campo de cantidad
            $this->estanqueEspecieRepository->update(['cantidad'=>$estanqueEspecie->cantidad - $cantidad], $id);
        }

        //2- se registra la defuncion en una tabla
        $campos = ['id_especie'=> $idEspecie,
            'id_estanque'=> $idEstanque,
            'motivo'=> $motivo,
            'fecha'=>$fecha,
            'cantidad' => $cantidad];

        $this->estanque_especie_defuncionRepository->create($campos);

        Flash::success('La defunción se registró correctamente');
        return redirect('estanqueEspecies/estanque/'.$idEstanque);
    }
}
