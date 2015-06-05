<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('creacion_pacientes_pediatricos', function()
{
	return View::make('pacientes_pediatricos.crear_paciente_pediatrico');
});
Route::get('creacion_pacientes_obstetricos', function()
{
	return View::make('pacientes.crear_paciente_obstetrico');
});
#Route::get('pacientes', array('uses'=>'PacientesController@index'));
Route::post('crear_paciente_pediatrico','PacientesPedriatricosController@crear_paciente_pedi');

#Route::post('crear_paciente_obstetrico','PacientesController@crear_paciente_obst');

Route::get('/obtener_paises/{pais}',array('uses'=>'PaisesController@mostrarPaises'))->where('pais','[a-zA-Z]+');
Route::get('/obtener_direccion/{dir}',array('uses'=>'RepresentanteController@mostrarDireccion'))->where('dir','[a-zA-Z]+');
Route::get('/obtener_ocupacion/{ocupacion}',array('uses'=>'RepresentanteController@mostrarOcupacionOficio'))->where('ocupacion','[a-zA-Z]+');

	 
