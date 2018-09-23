<?php

namespace App\Http\Controllers;
//FISICO-QUIMICOS
use App\Http\Requests\CreatetemperaturaRequest;
use App\Http\Requests\CreatepHRequest;
use App\Http\Requests\CreatenitritosRequest;
use App\Http\Requests\CreatenitratosRequest;
use App\Http\Requests\CreateamonioRequest;
use App\Http\Requests\CreateoxigenoRequest;
use App\Http\Requests\CreatesalinidadRequest;
use App\Http\Requests\CreateobservacionRequest;
use App\Repositories\temperaturaRepository;
use App\Repositories\pHRepository;
use App\Repositories\nitritosRepository;
use App\Repositories\nitratosRepository;
use App\Repositories\amonioRepository;
use App\Repositories\oxigenoRepository;
use App\Repositories\salinidadRepository;
use App\Repositories\observacionRepository;
//
use App\Http\Requests\Createestanque_fisico_quimicoRequest;
use App\Http\Requests\Updateestanque_fisico_quimicoRequest;
use App\Repositories\estanque_fisico_quimicoRepository;
use App\Http\Requests\Createfisico_quimicoRequest;
use App\Http\Requests\Updatefisico_quimicoRequest;
use App\Repositories\estanqueRepository;
use App\Repositories\fisico_quimicoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
//ESTANQUE MODEL
use App\Models\estanque;
class fisico_quimicoController extends AppBaseController
{

    private $estanqueRepository;
    private $temperaturaRepository;
    private $pHRepository;
    private $nitritosRepository;
    private $nitratosRepository;
    private $amonioRepository;
    private $oxigenoRepository;
    private $salinidadRepository;
    private $observacionRepository;

    public function __construct(temperaturaRepository $temperaturaRepo,
                                pHRepository $pHRepo,
                                nitritosRepository $nitritosRepo,
                                observacionRepository $observacionRepo,
                                salinidadRepository $salinidadRepo,
                                nitratosRepository $nitratosRepo,
                                amonioRepository $amonioRepo,
                                oxigenoRepository $oxigenoRepo,
                                estanqueRepository $estanqueRepo)
    {
        $this->temperaturaRepository = $temperaturaRepo;
        $this->pHRepository = $pHRepo;
        $this->nitritosRepository = $nitritosRepo;
        $this->nitratosRepository = $nitratosRepo;
        $this->amonioRepository = $amonioRepo;
        $this->oxigenoRepository = $oxigenoRepo;
        $this->salinidadRepository = $salinidadRepo;
        $this->observacionRepository = $observacionRepo;
        $this->estanqueRepository = $estanqueRepo;
    }




    /**
     * Show the form for creating a new fisico_quimico.
     *
     * @return Response
     */
    public function createPorEstanqueId($idEstanque)
    {
        //Preguntar si el estanque existe
        $estanque = $this->estanqueRepository->findWithoutFail($idEstanque);

        if (empty($estanque)) {
            Flash::error('No se encontró el estanque: '.$idEstanque);

            return redirect(route('estanques.index'));
        }

        return view('fisico_quimicos.create')
            ->with('estanque', $estanque);
    }


    /**
     * Store a newly created fisico_quimico in storage.
     *
     * @param Createfisico_quimicoRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Createfisico_quimicoRequest $request)
    {
        $input = $request->all();
        if ($input['temperatura']){
            $inputTemperatura['id_estanque'] = $input['idEstanque'];
            $inputTemperatura['valor'] = $input['temperatura'];
            $inputTemperatura['fecha'] = $input['fecha'];
            $inputTemperatura['hora'] = $input['horaTemperatura'];

            $temperatura = $this->temperaturaRepository->create($inputTemperatura);
        }
        if ($input['pH']){
            $input_pH['id_estanque'] = $input['idEstanque'];
            $input_pH['valor'] = $input['pH'];
            $input_pH['fecha'] = $input['fecha'];
            $input_pH['hora'] = $input['horaph'];

            $pH = $this->pHRepository->create($input_pH);
        }
        if ($input['nitritos']){
            $input_nitritos['id_estanque'] = $input['idEstanque'];
            $input_nitritos['valor'] = $input['nitritos'];
            $input_nitritos['fecha'] = $input['fecha'];
            $input_nitritos['hora'] = $input['horanitritos'];

            $input_nitritos = $this->nitritosRepository->create($input_nitritos);
        }
        if ($input['nitratos']){
            $input_nitratos['id_estanque'] = $input['idEstanque'];
            $input_nitratos['valor'] = $input['nitratos'];
            $input_nitratos['fecha'] = $input['fecha'];
            $input_nitratos['hora'] = $input['horanitratos'];

            $nitratos = $this->nitratosRepository->create($input_nitratos);
        }

        if ($input['amonio']){
            $input_amonio['id_estanque'] = $input['idEstanque'];
            $input_amonio['valor'] = $input['amonio'];
            $input_amonio['fecha'] = $input['fecha'];
            $input_amonio['hora'] = $input['horaamonio'];

            $amonio = $this->amonioRepository->create($input_amonio);
        }


        if ($input['oxigeno']){
            $input_oxigeno['id_estanque'] = $input['idEstanque'];
            $input_oxigeno['valor'] = $input['oxigeno'];
            $input_oxigeno['fecha'] = $input['fecha'];
            $input_oxigeno['hora'] = $input['horaoxigeno'];

            $oxigeno = $this->oxigenoRepository->create($input_oxigeno);
        }

        if ($input['salinidad']){
            $input_salinidad['id_estanque'] = $input['idEstanque'];
            $input_salinidad['valor'] = $input['salinidad'];
            $input_salinidad['fecha'] = $input['fecha'];
            $input_salinidad['hora'] = $input['horasalinidad'];

            $salinidad = $this->salinidadRepository->create($input_salinidad);
        }
        if ($input['observacion']){
            $input_observacion['id_estanque'] = $input['idEstanque'];
            $input_observacion['fecha'] = $input['fecha'];
            $input_observacion['descripcion'] = $input['observacion'];

            $observacion = $this->observacionRepository->create($input_observacion);
        }





        Flash::success('Entradas Físico Químicas Guardadas Correctamente.');

        return redirect(route('estanques.index'));
    }















    /**
     * Display a listing of the fisico_quimico.
     *
     * @param Request $request
     * @return Response
     */
//    public function index(Request $request)
//    {
//        $this->fisicoQuimicoRepository->pushCriteria(new RequestCriteria($request));
//        $fisicoQuimicos = $this->fisicoQuimicoRepository->all();
//
//        return view('fisico_quimicos.index')
//            ->with('fisicoQuimicos', $fisicoQuimicos);
//    }

    /**
     * Show the form for creating a new fisico_quimico.
     *
     * @return Response
     */
//    public function create()
//    {
//        $estanques = estanque::pluck('num_estanque', 'id');
//        return view('fisico_quimicos.create', compact('estanques'));
//    }




    /**
     * Display the specified fisico_quimico.
     *
     * @param  int $id
     *
     * @return Response
     */
//    public function show($id)
//    {
//        $fisicoQuimico = $this->fisicoQuimicoRepository->findWithoutFail($id);
//
//        if (empty($fisicoQuimico)) {
//            Flash::error('Fisico Quimico not found');
//
//            return redirect(route('fisicoQuimicos.index'));
//        }
//
//        return view('fisico_quimicos.show')->with('fisicoQuimico', $fisicoQuimico);
//    }

    /**
     * Show the form for editing the specified fisico_quimico.
     *
     * @param  int $id
     *
     * @return Response
     */
//    public function edit($id)
//    {
//        $fisicoQuimico = $this->fisicoQuimicoRepository->findWithoutFail($id);
//        $estanques = estanque::pluck('num_estanque', 'id', 'num_estanque');
//        if (empty($fisicoQuimico)) {
//            Flash::error('Fisico Quimico not found');
//
//            return redirect(route('fisicoQuimicos.index'));
//        }
//
//        return view('fisico_quimicos.edit', compact('estanques'))->with('fisicoQuimico', $fisicoQuimico);
//    }

    /**
     * Update the specified fisico_quimico in storage.
     *
     * @param  int              $id
     * @param Updatefisico_quimicoRequest $request
     *
     * @return Response
     */
//    public function update($id, Updatefisico_quimicoRequest $request)
//    {
//        $fisicoQuimico = $this->fisicoQuimicoRepository->findWithoutFail($id);
//
//        if (empty($fisicoQuimico)) {
//            Flash::error('Fisico Quimico not found');
//
//            return redirect(route('fisicoQuimicos.index'));
//        }
//
//        $fisicoQuimico = $this->fisicoQuimicoRepository->update($request->all(), $id);
//
//        Flash::success('Fisico Quimico updated successfully.');
//
//        return redirect(route('fisicoQuimicos.index'));
//    }

    /**
     * Remove the specified fisico_quimico from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
//    public function destroy($id)
//    {
//        $fisicoQuimico = $this->fisicoQuimicoRepository->findWithoutFail($id);
//
//        if (empty($fisicoQuimico)) {
//            Flash::error('Fisico Quimico not found');
//
//            return redirect(route('fisicoQuimicos.index'));
//        }
//
//        $this->fisicoQuimicoRepository->delete($id);
//
//        Flash::success('Fisico Quimico deleted successfully.');
//
//        return redirect(route('fisicoQuimicos.index'));
//    }
}
