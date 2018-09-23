<?php

namespace App\Http\Controllers;

use App\Repositories\UsuariosRepository;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\recinto;
use Prettus\Validator\Exceptions\ValidatorException;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Illuminate\Auth\Events\Registered;


class UserController extends Controller
{

    /** @var  alimentosRepository */
    private $usuariosRepository;

    public function __construct(UsuariosRepository $usuariosRepository)
    {
        $this->usuariosRepository = $usuariosRepository;
    }

    /**
     * Display a listing of the especie.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = (new \App\User)->where('id_recinto', Auth::user()->id_recinto)->get();
        return view('usuarios.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new especie.
     *
     * @return Response
     */
    public function create()
    {
      $list =  Role::all();
      $roles = [];

      foreach ($list as $l) {
          $roles[$l['name']] = $l['name'];
      }
      
      return view('usuarios.create',compact('roles'));
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'id_recinto' => 'required|integer|exists:recintos,id',
            'role' => 'required|string|exists:roles,name',
        ]);
    }
    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'password' => 'string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function crearUsuario(array $data)
    {
        $user = (new \App\User)->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'id_recinto' => Auth::user()->id_recinto,
        ]);
        //se asigna el roles
        $user->assignRole($data['role']);
        return $user;
    }

    /**
     * Store a newly created especie in storage.
     *
     * @param CreateespecieRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request['id_recinto'] = Auth::user()->id_recinto;
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->crearUsuario($request->all())));

        return redirect(route('usuarios.index'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->usuariosRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('usuarios.index'));
        }

        $list =  Role::all();
        $roles = [];

        foreach ($list as $l) {
            $roles[$l['name']] = $l['name'];
        }

        return view('usuarios.edit',compact('roles', 'user'));
    }

    /**
     * Update the specified especie in storage.
     *
     * @param  int              $id
     * @param UpdateespecieRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $user = $this->usuariosRepository->findWithoutFail($id);

        $input = $request->all();
        if (empty($user)) {
            Flash::error('Usuario no encontrado');
            return redirect(route('usuarios.index'));
        }

        if ($input['password'] ==""){
            unset($input['password']);
        }

        $this->validatorUpdate($input)->validate();
        try {

            if ($input['password'] !=""){
                $input['password'] = bcrypt($input['password']);
            }
            $this->usuariosRepository->update($input, $id);
        } catch (ValidatorException $e) {
            Flash::success('Ocurrió un error al actualizar los datos del usuario');
        }

        Flash::success('Se acualizaron los datos del usuario');

        return redirect(route('usuarios.index'));
    }

    /**
     * Remove the specified especie from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->usuariosRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');
            return redirect(route('usuarios.index'));
        }
        if (Auth::user() == $user ) {
            Flash::error('No se puede eliminar el usuario autentificado');
            return redirect(route('usuarios.index'));
        }

        $this->usuariosRepository->delete($id);

        Flash::success('El usuario se eliminó con exito');

        return redirect(route('usuarios.index'));
    }

}