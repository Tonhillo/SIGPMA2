<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\especie;

class UpdateespecieRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      //Se modifico este metodo para que no sea necesario ingresar una img nueva en cada update
      //en el controller se controlla que no vaya un null al campo en la BD
        $validacionesUpdate=especie::$rules;
        $validacionesUpdate['imagen_url']='nullable';
        return $validacionesUpdate;
    }
}
