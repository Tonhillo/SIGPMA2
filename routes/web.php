<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Ruta Base
Route::get('/', function () {
  return redirect('home');
});

//Ruta Base de Usuarios
Auth::routes();
//Ruta a la Pagina de Bienvenida
Route::get('/welcome','estanqueController@listaPeceras');

//Rutas para enviar datos a la app de exibición.
Route::get('/pecerasList','estanqueController@listaPeceras');
Route::get('api/pecerasList','estanqueController@listaPeceras');
Route::get('/pecesList/{idEstanque}','estanqueController@listaPeces');
Route::get('api/pecesList/{idEstanque}','estanqueController@listaPeces');
//Route::get('/estanqueEspecieList/','estanqueController@estanqueEspeciesList');

//
Route::get('/home', 'HomeController@index');

//Rutas para la Gestión de Recintos-Estanques-Especies
Route::resource('recintos', 'recintoController');

Route::resource('especies', 'especieController');

Route::resource('estanques', 'estanqueController');

//Rutas Para Las gestión individual en estanques
Route::get('estanques/desove/{idEstanque}','desobeController@createDesobePorId');

Route::get('estanques/fisico_quimicos/{idEstanque}','fisico_quimicoController@createPorEstanqueId');

Route::get('estanqueEspecies/alimentacion/{idEstanque}', 'estanque_alimentacionController@alimentacionPorEstanque');

Route::get('estanques/familias/{idEstanque}','estanque_familiaController@createPorEstanqueId');

Route::get('estanqueEspecies/estanque/{idEstanque}', 'Estanque_especieController@porEstanqueId');

Route::get('/newEstanqueEspecies/{idEstanque}', 'Estanque_especieController@createPorEstanqueId');


Route::post('estanqueEspecies/defuncion/{id}', 'Estanque_especieController@defuncionEspecie')->name('estanqueEspecies.defuncionEspecie');
Route::post('estanqueEspecies/traslado/{id}', 'Estanque_especieController@trasladarEspecie')->name('estanqueEspecies.trasladarEspecie');


// Rutas Iniciales
Route::resource('fisicoQuimicos', 'fisico_quimicoController');


Route::resource('estanqueAlimentacions', 'estanque_alimentacionController');


Route::resource('estanqueFamilias', 'estanque_familiaController');


Route::resource('estanqueEspecies', 'Estanque_especieController');


Route::resource('estanqueDesobes', 'estanque_desobeController');


Route::resource('observacionEspecies', 'observacion_especieController');

//Ruta para los usuarios
Route::resource('usuarios', 'UserController');

//Ruta para la vista de gráficos
Route::get('estanques/grafico/{idEstanque}', 'graficos_controller@chartCreate');

Route::post('/charts', 'graficos_controller@enviarFechas');


//Rutas para la gestión de entradas(Fisico-Quimimcos-Desoves-Especies En el Estanque.
Route::resource('alimentos', 'alimentosController');

Route::resource('desobes', 'desobeController');

Route::resource('pHs', 'pHController');

Route::resource('nitritos', 'nitritosController');

Route::resource('nitratos', 'nitratosController');

Route::resource('salinidads', 'salinidadController');

Route::resource('amonios', 'amonioController');

Route::resource('oxigenos', 'oxigenoController');

Route::resource('temperaturas', 'temperaturaController');