<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createestanque_familiaRequest;
use App\Http\Requests\Updateestanque_familiaRequest;
use App\Repositories\estanque_familiaRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\estanqueRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

//Se agrega el modelo para poder usarlo y cargar desde la base de datos.
use App\Models\especie; 
use App\Models\estanque;

class estanque_familiaController extends AppBaseController
{
    /** @var  estanque_familiaRepository */
    private $estanqueFamiliaRepository;

    /** @var  estanqueRepository */
    private $estanqueRepository;

    public function __construct(estanque_familiaRepository $estanqueFamiliaRepo, estanqueRepository $estanqueRepo)
    {
        $this->estanqueFamiliaRepository = $estanqueFamiliaRepo;
        $this->estanqueRepository = $estanqueRepo;
    }

    /**
     * Display a listing of the estanque_familia.
     *
     * @param Request $request
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(Request $request)
    {
        $this->estanqueFamiliaRepository->pushCriteria(new RequestCriteria($request));
       
        //Se sustituye -> all() por la cantidad de elementos que 
        //se quieran mostrar por pagina, de estanque familia, en este caso, 10.
        $estanqueFamilias = $this->estanqueFamiliaRepository->paginate(10);
        

        return view('estanque_familias.index')
            ->with('estanqueFamilias', $estanqueFamilias);
    }

    /**
     * Show the form for creating a new estanque_familia.
     *
     * @return Response
     */
    public function create()
    {
        //Obtiene el total de especies de la BD, en numero
        $total_especies = DB::table('especies')
        ->whereNull('deleted_at')
        ->count();

        //Obtiene el total de estanques de la BD, en numero
        $total_estanque = DB::table('estanques')
        ->whereNull('deleted_at')
        ->count();

        //Si hay mas de 1 especie y de 1 estanque, carga la vista para agregar estanque familias
        if($total_especies > 0 && $total_estanque > 0)
        {
            // select e.num_estanque, r.nombre
            // from estanques as e, recintos as r
            // where e.id_recinto=r.id

            //Se obtienen dos columnas en la consulta, una que es el ID del estanque
            //y la otra que es el resultado de concatenar el numero del estanque con el
            //nombre del recinto al que pertenece.
            $coleccionPluck = DB::table('estanques')
                                    ->join('recintos', 'estanques.id_recinto', '=', 'recintos.id')
                                    ->select('estanques.id', DB::raw("CONCAT(estanques.num_estanque, ' / ', recintos.nombre) AS nombre"))
                                    ->get();

            //Se crea una variable que recibe los datos desde la BD
            $especies = especie::pluck('nombre_comun', 'id');
            //Los datos del select, se obtienen con el pluck como un array
            $estanques = $coleccionPluck->pluck('nombre', 'id');

            //Con el metodo compact, se pasan a la vista los datos para rellenar el select.
            return view('estanque_familias.create', compact('especies', 'estanques'));
        }
        else
        {
            //Muestra un error si no existe al menos una especie y un estanque
            Flash::error('Debe de existir al menos una especie y un estanque agregados para poder continuar');

            //Devuelve a la pagina de index
            return redirect(route('estanqueFamilias.index'));
        }
    }

public function createPorEstanqueId($idEstanque)
    {
        //Obtiene el total de especies de la BD, en numero
        $total_especies = DB::table('especies')
        ->whereNull('deleted_at')
        ->count();

        //Obtiene el total de estanques de la BD, en numero
        $total_estanque = DB::table('estanques')
        ->whereNull('deleted_at')
        ->count();

        $estanque = $this->estanqueRepository->findWithoutFail($idEstanque);

        if (empty($estanque)) {
            Flash::error('No se encontró el estanque: '.$idEstanque);

            return redirect(route('estanques.index'));
        }

        //Si hay mas de 1 especie y de 1 estanque, carga la vista para agregar estanque familias

        if($total_especies > 0 && $total_estanque > 0)
        {
            // select e.num_estanque, r.nombre
            // from estanques as e, recintos as r
            // where e.id_recinto=r.id

            //Se obtienen dos columnas en la consulta, una que es el ID del estanque
            //y la otra que es el resultado de concatenar el numero del estanque con el
            //nombre del recinto al que pertenece.
            $coleccionPluck = DB::table('estanques')
                                    ->join('recintos', 'estanques.id_recinto', '=', 'recintos.id')
                                    ->select('estanques.id', DB::raw("CONCAT(estanques.num_estanque, ' / ', recintos.nombre) AS nombre"))
                                    ->get();

            //Se crea una variable que recibe los datos desde la BD
            $especies = especie::pluck('nombre_comun', 'id');
            //Los datos del select, se obtienen con el pluck como un array
            $estanques = $coleccionPluck->pluck('nombre', 'id');

            //Con el metodo compact, se pasan a la vista los datos para rellenar el select.
            return view('estanque_familias.create', compact('especies', 'estanques', 'idEstanque'));
        }
        else
        {
            //Muestra un error si no existe al menos una especie y un estanque
            Flash::error('Debe de existir al menos una especie agregada para poder continuar');

            //Devuelve a la pagina de index
            return redirect(route('estanques.index'));
        }
    }


    /**
     * Store a newly created estanque_familia in storage.
     *
     * @param Createestanque_familiaRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Createestanque_familiaRequest $request)
    {
        $input = $request->all();

        $id_de_la_especie = $input['id_especie'];
        $id_del_estanque = $input['id_estanque'];

        //Se llama a un metodo que valida que exista o no, un registro en la BD con identicos IDs.
        $resultado = self::validarEstanquesFamilia($id_de_la_especie, $id_del_estanque);

        /* Recolecta el nombre de la especie, mediante el ID que el usuario manda. */
        $nombreEspecie = DB::table('especies')
                            ->select('nombre_comun')
                            ->where('id', '=', $id_de_la_especie)
                            ->whereNull('deleted_at')
                            ->first();

        /* Recolecta el numero del estanque, mediante el ID que le usuario manda. */
        $numeroEstanque = DB::table('estanques')
                            ->select('num_estanque')
                            ->where('id', '=', $id_del_estanque)
                            ->whereNull('deleted_at')
                            ->first();

        // Si la variable resultado guarda mas de un registro, quiere decir que existe al menos uno que coincida
        // con lo que el usuario ingreso.
        if($resultado > 0) {
            /* Muestra el mensaje advirtiendo que el regsitro no se puede agregar a la BD. */
            Flash::error('No puedes agregar la especie '.$nombreEspecie->nombre_comun.' al estanque '.$numeroEstanque->num_estanque.', porque ya se encuentra agregada.');
        }
        else
        {
            /* Guarda el registro creado por el usuario en la BD. */
            $estanqueFamilia = $this->estanqueFamiliaRepository->create($input);

            /* Mensaje de exito al guardar */
            Flash::success('La especie '.$nombreEspecie->nombre_comun.' se ha agregado al estanque '.$numeroEstanque->num_estanque.' con éxito.');
        }

        return redirect(route('estanqueFamilias.index'));
    }

    /**
     * Esta función fue creada por Javier Cordero.
     * El objetivo de la función es que, mediante el ID de la especie y el ID del estanque,
     * se pueda seleccionar de la base de datos de la tabla 'estanque_familias', los ID
     * de especie y de estanque que existan en esa tabla, identicos a los recibidos por
     * parámetros. La consulta devolverá un COUNT de los registros obtenidos de la consulta.
     * Si se devuelve un número mayor a cero, quiere decir que existe al menos un registro,
     * que comparte el mismo ID de especie y de estanque que el dato recién ingresado, por
     * lo que se mostrará un mensaje al usuario de éxito o de error, dependiendo del resultado
     * que arroje esta función.
     */
    protected function validarEstanquesFamilia($id_de_la_especie, $id_del_estanque) {
        $consultaQuery = DB::table('estanque_familias')
                            ->select('id_especie', 'id_estanque')
                            ->where('id_especie', '=', $id_de_la_especie)
                            ->where('id_estanque', '=', $id_del_estanque)
                            ->whereNull('deleted_at')
                            ->count();

        return $consultaQuery;
    }

    /**
     * Display the specified estanque_familia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estanqueFamilia = $this->estanqueFamiliaRepository->findWithoutFail($id);

        if (empty($estanqueFamilia)) {
            Flash::error('Estanque Familia no se ha encontrado');

            return redirect(route('estanqueFamilias.index'));
        }

        /* Selecciona el nombre de la especie, según el ID de la especie
        almacenada en estanque_familias. */
        $nombre_especie = DB::table('especies')
        ->select('nombre_comun')
        ->where('id', '=', $estanqueFamilia->id_especie)
        ->whereNull('deleted_at')
        ->first();

        /* Selecciona el número del estanque y el nombre del recinto, para
        unirlos y poder mostrar a que recinto pertenece el estanque. */
        $numero_estanque = DB::table('estanques')
        ->join('recintos', 'estanques.id_recinto', '=', 'recintos.id')
        ->select(DB::raw("CONCAT(estanques.num_estanque, ' / ', recintos.nombre) AS nombre"))
        ->where('estanques.id', '=', $estanqueFamilia->id_estanque)
        ->first();

        /* Manda los datos de las consultas a la vista, para cargar los datos. */
        return view('estanque_familias.show', compact('estanqueFamilia', 'nombre_especie', 'numero_estanque'));
    }

    /**
     * Show the form for editing the specified estanque_familia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //Se crea una variable que recibe los datos desde la BD
        $especies = especie::pluck('nombre_comun', 'id');
        $estanques = estanque::pluck('num_estanque', 'id');

        $estanqueFamilia = $this->estanqueFamiliaRepository->findWithoutFail($id);

        if (empty($estanqueFamilia)) {
            Flash::error('Estanque Familia no se ha encontrado');

            return redirect(route('estanqueFamilias.index'));
        }

        return view('estanque_familias.edit', compact('especies', 'estanques'))->with('estanqueFamilia', $estanqueFamilia);
    }

    /**
     * Update the specified estanque_familia in storage.
     *
     * @param  int $id
     * @param Updateestanque_familiaRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, Updateestanque_familiaRequest $request)
    {
        $estanqueFamilia = $this->estanqueFamiliaRepository->findWithoutFail($id);

        if (empty($estanqueFamilia)) {
            Flash::error('Estanque Familia no se ha encontrado');

            return redirect(route('estanqueFamilias.index'));
        }

        $datosNuevos = $request->all();

        $id_de_la_especie = $datosNuevos['id_especie'];
        $id_del_estanque = $datosNuevos['id_estanque'];

        //se iguala al id que entra por parámetros.
        $id_del_estanqueFamilias = $id;

    /**
     * Creado por Jeniffer Hernández.
     *El objetivos es contar los registros
     *
     */

        $resultado =  DB::table('estanque_familias')
        ->where('id', '!=', $id_del_estanqueFamilias)
        ->where('id_estanque', '=', $id_del_estanque)    
        ->where('id_especie', '=', $id_de_la_especie)    
        ->whereNull('deleted_at')
        ->count();

        /* Recolecta el nombre de la especie, mediante el ID que el usuario manda. */
        $nombreEspecie = DB::table('especies')
                            ->select('nombre_comun')
                            ->where('id', '=', $id_de_la_especie)
                            ->whereNull('deleted_at')
                            ->first(); 

        /* Recolecta el numero del estanque, mediante el ID que le usuario manda. */
        $numeroEstanque = DB::table('estanques')
                            ->select('num_estanque')
                            ->where('id', '=', $id_del_estanque)
                            ->whereNull('deleted_at')
                            ->first();

        // Si la variable resultado guarda mas de un registro, quiere decir que existe al menos uno que coincida
        // con lo que el usuario ingreso.
        if($resultado > 0) {
            /* Muestra el mensaje advirtiendo que el regsitro no se puede modificar a la BD. */
            Flash::error('No puedes modificar la especie '.$nombreEspecie->nombre_comun.' al estanque '.$numeroEstanque->num_estanque.', porque ya se encuentra agregada.');
        }
        else {
            /* Actualiza el registro elegido por el usuario en la BD. */
            $estanqueFamilia = $this->estanqueFamiliaRepository->update($request->all(), $id);

            /* Mensaje de exito al modificar */
            Flash::success('La especie '.$nombreEspecie->nombre_comun.' se ha modificado al estanque '.$numeroEstanque->num_estanque.' con éxito.');
        }

        return redirect(route('estanqueFamilias.index'));
    }

    /**
     * Esta funcion obtiene tres parametros, que son el ID del estanque_familia que
     * se esta modificando, y los ID de la especie y estanque que se han modificado.
     * Permite contar cuantas estanque_familias existen en la BD que tengan el mismo 
     * ID de especie y estanque, diferentes al ID del que se esta modificando, esto para 
     * saber que no se va a agregar una misma especie en un estanque en el que ya existe. 
     */
    private function validateUpdate($id, $idEspecie, $idEstanque)
    {
        $consultaSQL = DB::table('estanque_familias')
        ->where('id', '<>', $id)
        ->where('id_especie', '=', $idEspecie)
        ->where('id_estanque', '=', $idEstanque)
        ->whereNull('deleted_at')
        ->count();
                        
        return $consultaSQL;
    }

    /**
     * Remove the specified estanque_familia from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estanqueFamilia = $this->estanqueFamiliaRepository->findWithoutFail($id);

        if (empty($estanqueFamilia)) {
            Flash::error('Estanque Familia no se ha encontrado');

            return redirect(route('estanqueFamilias.index'));
        }

        $this->estanqueFamiliaRepository->delete($id);

        Flash::success('Estanque Familia eliminado exitosamente.');

        return redirect(route('estanqueFamilias.index'));
    }
}
