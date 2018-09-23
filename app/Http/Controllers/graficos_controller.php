<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\observacion;
use App\Repositories\observacionRepository;
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
use App\Models\estanque;
use App\Models\temperatura;
use App\Models\Estanque_especie_defuncion;
use App\Models\pH;
use App\Models\nitritos;
use App\Models\nitratos;
use App\Models\salinidad;
use App\Models\estanque_alimentacion;
use App\Models\amonio;
use App\Models\oxigeno;
use App\Models\desobe;

class graficos_controller extends AppBaseController
{
    /** @var  recintoRepository */
    private $recintoRepository;
    /** @var  estanqueRepository */
    private $estanqueRepository;
    private $observacionRepository;
    public function __construct(estanqueRepository $estanqueRepo, observacionRepository $observacionRepo)
    {
        $this->estanqueRepository = $estanqueRepo;
        $this->observacionRepository = $observacionRepo;
    }

    /**
     * Display a listing of the recinto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('graficos.index');
    }

    public function chartCreate($idEstanque)
    {
        //Preguntar si el estanque existe
        $estanque = $this->estanqueRepository->findWithoutFail($idEstanque);

        if (empty($estanque)) {
            Flash::error('No se encontró el estanque: '.$estanque->num_estanque);

            return redirect(route('estanques.index'));
        }

        return view('graficos.index')->with('idEstanque', $idEstanque)
            ->with('numeroEstanque', $estanque->num_estanque);
    }

    public function enviarFechas(Request $request)
    {

        $input = $request->all();
        $fecha_inicial = $input['fechaInicial'];
        $fecha_final = $input['fechaFinal'];
        $id_estanque = $input['idEstanque'];

        // $diferencia = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
        // $diferencia = abs($diferencia);
        // $diferencia = floor($diferencia);

        // if($diferencia < 122) {
        //     Flash::error('El período máximo para generar gráficos es de 4 meses');

        //     return redirect(route('estanques.index'));
        // }

        /* DATOS PARA PASAR A LA VISTA */
        // $arrayAlimentacion = self::datos_alimentacion($fecha_inicial, $fecha_final, $id_estanque);;
        $arrayMortalidad = self::datos_mortalidad($fecha_inicial, $fecha_final, $id_estanque);;
        $arrayTemperaturas = self::datos_temperaturas($fecha_inicial, $fecha_final, $id_estanque);
        $arrayPh = self::datos_ph($fecha_inicial, $fecha_final, $id_estanque);
        $arrayNitritos = self::datos_nitritos($fecha_inicial, $fecha_final, $id_estanque);
        $arrayNitratos = self::datos_nitratos($fecha_inicial, $fecha_final, $id_estanque);
        $arraySalinidad = self::datos_salinidad($fecha_inicial, $fecha_final, $id_estanque);
        $arrayAmonio = self::datos_amonio($fecha_inicial, $fecha_final, $id_estanque);
        $arrayOxigeno = self::datos_oxigeno($fecha_inicial, $fecha_final, $id_estanque);
        //TRAE LA OBSERVACIONES POR MES
        $observacions = observacion::where('id_estanque', $id_estanque)->whereBetween('fecha', [$fecha_inicial, $fecha_final])->orderBy('fecha')->get();

        //Preguntar si el estanque existe
        $estanque = $this->estanqueRepository->findWithoutFail($id_estanque);

        if (empty($estanque)) {
            Flash::error('No se encontró el estanque: '.$estanque->num_estanque);

            return redirect(route('estanques.index'));
        }

        $desoves = self::desoves_totales($fecha_inicial, $fecha_final, $id_estanque);
              return view('graficos.graficos')
                  ->with('estanque', $estanque)
                  ->with('fechaInicio', $fecha_inicial)
                  ->with('fechaFinal', $fecha_final)
                  ->with('arrayTemperaturas', $arrayTemperaturas)
                  ->with('arrayPh', $arrayPh)
                  ->with('arrayNitritos', $arrayNitritos)
                  ->with('arrayNitratos', $arrayNitratos)
                  ->with('arraySalinidad', $arraySalinidad)
                  ->with('arrayAmonio', $arrayAmonio)
                  ->with('arrayOxigeno', $arrayOxigeno)
                  ->with('observaciones', $observacions)
                  ->with('arrayMortalidad', $arrayMortalidad)
                  // ->with('arrayAlimentacion', $arrayAlimentacion)
                  ->with('desoves', $desoves);

    }

    /* METODOS PARA OBTENER LOS DATOS DESDE LA BASE DE DATOS POR CADA VARIABLE FISICO-QUIMICA */
    // protected function datos_alimentacion($fecha_inicial, $fecha_final, $id_estanque) {
    //
    //     $datos = estanque_alimentacion::where('id_estanque', $id_estanque)
    //         ->whereBetween('fecha_alimentacion', [$fecha_inicial, $fecha_final])
    //         ->whereNull('deleted_at')
    //         ->get();
    //
    //     //Se obtiene la cantidad de elementos del array obtenido en la consulta, y se crea uno nuevo
    //     $tamanioDatos = sizeof($datos);
    //     $arrayDatos = array();
    //     $fechas = array();
    // //     $alimento = array();
    // //     $collection = collect(['nombre', 'cantidad']);
    // // $combined = $collection->combine(['George', 29]);
    //     //Se recorre el array de la consulta, para guardar los datos en un nuevo array
    //     for($indice = 0; $indice < $tamanioDatos; $indice++) {
    //         $arrayDatos[$indice] = $datos[$indice]->peso;
    //         // el format() es para que la fecha tenga un formato para las etiquetas en los graficos
    //         $fechas[$indice] = ($datos[$indice]->fecha_alimentacion)->format('Y-m-d');
    //     }
    //     return ['fechas_alimentacion'=>$fechas, 'datos_alimentacion'=>$arrayDatos];
    // }

    protected function datos_mortalidad($fecha_inicial, $fecha_final, $id_estanque) {

        $datos = Estanque_especie_defuncion::where('id_estanque', $id_estanque)
            ->whereBetween('fecha', [$fecha_inicial, $fecha_final])
            ->whereNull('deleted_at')
            ->get();

        //Se obtiene la cantidad de elementos del array obtenido en la consulta, y se crea uno nuevo
        $tamanioDatos = sizeof($datos);
        $arrayDatos = array();
        $fechas = array();

        //Se recorre el array de la consulta, para guardar los datos en un nuevo array
        for($indice = 0; $indice < $tamanioDatos; $indice++) {
            $arrayDatos[$indice] = $datos[$indice]->cantidad;
            // el format() es para que la fecha tenga un formato para las etiquetas en los graficos
            $fechas[$indice] = ($datos[$indice]->fecha)->format('Y-m-d');
        }
        return ['fechas_mortalidad'=>$fechas, 'datos_mortalidad'=>$arrayDatos];
    }

    protected function datos_temperaturas($fecha_inicial, $fecha_final, $id_estanque) {

        $datos = temperatura::where('id_estanque', $id_estanque)
            ->whereBetween('fecha', [$fecha_inicial, $fecha_final])
            ->whereNull('deleted_at')
            ->get();

        //Se obtiene la cantidad de elementos del array obtenido en la consulta, y se crea uno nuevo
        $tamanioDatos = sizeof($datos);
        $arrayDatos = array();
        $fechas = array();

        //Se recorre el array de la consulta, para guardar los datos en un nuevo array
        for($indice = 0; $indice < $tamanioDatos; $indice++) {
            $arrayDatos[$indice] = $datos[$indice]->valor;
            // el format() es para que la fecha tenga un formato para las etiquetas en los graficos
            $fechas[$indice] = ($datos[$indice]->fecha)->format('Y-m-d');
        }

        return ['fechas_temperaturas'=>$fechas, 'datos_temperaturas'=>$arrayDatos];
    }

    protected function datos_ph($fecha_inicial, $fecha_final, $id_estanque) {
        $datos = pH::where('id_estanque', $id_estanque)
            ->whereBetween('fecha', [$fecha_inicial, $fecha_final])
            ->whereNull('deleted_at')
            ->get();

        //Se obtiene la cantidad de elementos del array obtenido en la consulta, y se crea uno nuevo
        $tamanioDatos = sizeof($datos);
        $arrayDatos = array();
        $fechas = array();

        //Se recorre el array de la consulta, para guardar los datos en un nuevo array
        for($indice = 0; $indice < $tamanioDatos; $indice++) {
            $arrayDatos[$indice] = $datos[$indice]->valor;
            // el format() es para que la fecha tenga un formato para las etiquetas en los graficos
            $fechas[$indice] = ($datos[$indice]->fecha)->format('Y-m-d');
        }

        return ['fechas_ph'=>$fechas, 'datos_ph'=>$arrayDatos];
    }

    protected function datos_nitritos($fecha_inicial, $fecha_final, $id_estanque) {
        $datos = nitritos::where('id_estanque', $id_estanque)
        ->whereBetween('fecha', [$fecha_inicial, $fecha_final])
        ->whereNull('deleted_at')
        ->get();

        //Se obtiene la cantidad de elementos del array obtenido en la consulta, y se crea uno nuevo
        $tamanioDatos = sizeof($datos);
        $arrayDatos = array();
        $fechas = array();

        //Se recorre el array de la consulta, para guardar los datos en un nuevo array
        for($indice = 0; $indice < $tamanioDatos; $indice++) {
            $arrayDatos[$indice] = $datos[$indice]->valor;
            // el format() es para que la fecha tenga un formato para las etiquetas en los graficos
            $fechas[$indice] = ($datos[$indice]->fecha)->format('Y-m-d');
        }

        return ['fechas_nitritos'=>$fechas, 'datos_nitritos'=>$arrayDatos];
    }

    protected function datos_nitratos($fecha_inicial, $fecha_final, $id_estanque) {
        $datos = nitratos::where('id_estanque', $id_estanque)
        ->whereBetween('fecha', [$fecha_inicial, $fecha_final])
        ->whereNull('deleted_at')
        ->get();

        //Se obtiene la cantidad de elementos del array obtenido en la consulta, y se crea uno nuevo
        $tamanioDatos = sizeof($datos);
        $arrayDatos = array();
        $fechas = array();

        //Se recorre el array de la consulta, para guardar los datos en un nuevo array
        for($indice = 0; $indice < $tamanioDatos; $indice++) {
            $arrayDatos[$indice] = $datos[$indice]->valor;
            // el format() es para que la fecha tenga un formato para las etiquetas en los graficos
            $fechas[$indice] = ($datos[$indice]->fecha)->format('Y-m-d');
        }

        return ['fechas_nitratos'=>$fechas, 'datos_nitratos'=>$arrayDatos];
    }

    protected function datos_salinidad($fecha_inicial, $fecha_final, $id_estanque) {
        $datos = salinidad::where('id_estanque', $id_estanque)
        ->whereBetween('fecha', [$fecha_inicial, $fecha_final])
        ->whereNull('deleted_at')
        ->get();

        //Se obtiene la cantidad de elementos del array obtenido en la consulta, y se crea uno nuevo
        $tamanioDatos = sizeof($datos);
        $arrayDatos = array();
        $fechas = array();

        //Se recorre el array de la consulta, para guardar los datos en un nuevo array
        for($indice = 0; $indice < $tamanioDatos; $indice++) {
            $arrayDatos[$indice] = $datos[$indice]->valor;
            // el format() es para que la fecha tenga un formato para las etiquetas en los graficos
            $fechas[$indice] = ($datos[$indice]->fecha)->format('Y-m-d');
        }

        return ['fechas_salinidad'=>$fechas, 'datos_salinidad'=>$arrayDatos];
    }

    protected function datos_amonio($fecha_inicial, $fecha_final, $id_estanque) {
        $datos = amonio::where('id_estanque', $id_estanque)
        ->whereBetween('fecha', [$fecha_inicial, $fecha_final])
        ->whereNull('deleted_at')
        ->get();

        //Se obtiene la cantidad de elementos del array obtenido en la consulta, y se crea uno nuevo
        $tamanioDatos = sizeof($datos);
        $arrayDatos = array();
        $fechas = array();

        //Se recorre el array de la consulta, para guardar los datos en un nuevo array
        for($indice = 0; $indice < $tamanioDatos; $indice++) {
            $arrayDatos[$indice] = $datos[$indice]->valor;
            // el format() es para que la fecha tenga un formato para las etiquetas en los graficos
            $fechas[$indice] = ($datos[$indice]->fecha)->format('Y-m-d');
        }

        return ['fechas_amonio'=>$fechas, 'datos_amonio'=>$arrayDatos];
    }

    protected function datos_oxigeno($fecha_inicial, $fecha_final, $id_estanque) {
        $datos = oxigeno::where('id_estanque', $id_estanque)
        ->whereBetween('fecha', [$fecha_inicial, $fecha_final])
        ->whereNull('deleted_at')
        ->get();

        //Se obtiene la cantidad de elementos del array obtenido en la consulta, y se crea uno nuevo
        $tamanioDatos = sizeof($datos);
        $arrayDatos = array();
        $fechas = array();

        //Se recorre el array de la consulta, para guardar los datos en un nuevo array
        for($indice = 0; $indice < $tamanioDatos; $indice++) {
            $arrayDatos[$indice] = $datos[$indice]->valor;
            // el format() es para que la fecha tenga un formato para las etiquetas en los graficos
            $fechas[$indice] = ($datos[$indice]->fecha)->format('Y-m-d');
        }

        return ['fechas_oxigeno'=>$fechas, 'datos_oxigeno'=>$arrayDatos];
    }

    protected function desoves_totales($fecha_inicial, $fecha_final, $id_estanque) {
        $datos = desobe::where('id_estanque', $id_estanque)
            ->whereBetween('fecha', [$fecha_inicial, $fecha_final])
            ->whereNull('deleted_at')
            ->get();

        $huevos_totales = array();
        $no_viables = array();
        $viables = array();
        $porc_viabilidad = array();
        $diametro_huevo = array();
        $diametro_gota = array();
        $fechas = array();
        $cantidadDeDatos = sizeof($datos);

        for ($indice=0; $indice < $cantidadDeDatos; $indice++) {
            $huevos_totales[$indice] = $datos[$indice]->num_huevos_total;
            $no_viables[$indice] = $datos[$indice]->num_huevos_no_viables;
            $viables[$indice] = $datos[$indice]->num_huevos_viables;
            $porc_viabilidad[$indice] = $datos[$indice]->porcentaje_viabilidad;
            $diametro_huevo[$indice] = $datos[$indice]->diametro_huevo;
            $diametro_gota[$indice] = $datos[$indice]->diametro_gota;
            $fechas[$indice] = ($datos[$indice]->fecha)->format('Y-m-d');
        }

        return [
            'total'=>$huevos_totales,
            'no_viables'=>$no_viables,
            'viables'=>$viables,
            'porcentaje_viabilidad'=>$porc_viabilidad,
            'diam_huevo'=>$diametro_huevo,
            'diam_gota'=>$diametro_gota,
            'fechas'=>$fechas
        ];
    }
}
