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


/*RUTAS PACIENTES PEDIATRICOS*/
Route::get('/pacientes_pediatricos/creacion_pacientes_pediatricos', function()
{
	return View::make('pacientes_pediatricos.crear_paciente_pediatrico');
});

Route::get('/pacientes_pediatricos/creacion_examenes_medicos_pediatricos', function()
{
	return View::make('pacientes_pediatricos.crear_examenes_medicos_paciente');
	//return "Hola";
});
Route::post('crear_paciente_pediatrico','PacientesPedriatricosController@crear_paciente_pedi');
/*FIN RUTAS PACIENTES PEDIATRICOS*/

/*RUTAS MEDICOS*/
Route::get('/medicos/creacion_medicos', function()
{
	return View::make('medicos.crear_medico');
});
Route::post('crear_nuevo_medico','MedicosController@crear_nuevo_medico');
/*FIN RUTAS MEDICOS*/

Route::get('creacion_pacientes_obstetricos', function()
{
	return View::make('pacientes.crear_paciente_obstetrico');
});



/*RUTAS DE CONSULTAS AJAX*/
Route::get('/obtener_paises/{pais}',array('uses'=>'PaisesController@mostrarPaises'))->where('pais','[a-zA-Z]+');
Route::get('/obtener_direccion/{dir}',array('uses'=>'RepresentanteController@mostrarDireccion'))->where('dir','[a-zA-Z]+');
Route::get('/obtener_ocupacion/{ocupacion}',array('uses'=>'RepresentanteController@mostrarOcupacionOficio'))->where('ocupacion','[a-zA-Z]+');
/*FIN RUTAS DE CONSULTAS AJAX*/
	 
