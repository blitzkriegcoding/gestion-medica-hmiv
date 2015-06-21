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


/**************************RUTAS PACIENTES PEDIATRICOS********************************/

Route::group(['prefix' =>'pacientes_pediatricos'] ,function()
	{
		Route::get('creacion_pacientes_pediatricos',	['uses'=>'PacientesPediatricosController@nuevo_paciente_pediatrico'] );
		Route::get('creacion_examenes_medicos_pediatricos/{id_paciente_pediatrico}',	['uses'	=>	'ExamenesPediatricosController@crear_examenes_medicos_pediatricos']);
		Route::get('creacion_historia_medica_pediatrica/{id_paciente_pediatrico}',	['uses'	=>	'HistoriaMedicaPediatricaController@nueva_historia_medica_pediatrica']);		
	});

/*
Route::get('pacientes_pediatricos/creacion_pacientes_pediatricos',	['uses'=>'PacientesPediatricosController@nuevo_paciente_pediatrico'] );
Route::get('pacientes_pediatricos/creacion_examenes_medicos_pediatricos/{id_paciente_pediatrico}',	['uses'	=>	'ExamenesPediatricosController@crear_examenes_medicos_pediatricos']);
Route::get('pacientes_pediatricos/creacion_historia_medica_pediatrica/{id_paciente_pediatrico}',	['uses'	=>	'HistoriaMedicaPediatricaController@nueva_historia_medica_pediatrica']);
*/
#Route::get('pacientes_pediatricos/nueva_historia_medica_pediatrica');

/*ENVIO DE FORMULARIOS CON DATOS DE PACIENTES PEDIATRICOS*/

Route::group(['prefix' => 'pacientes_pediatricos' ], function()
	{
		Route::post('crear_paciente_pediatrico',		['uses'	=>	'PacientesPediatricosController@crear_paciente_pediatrico']);
		Route::post('crear_examenes_medicos_paciente',	['uses'	=>	'ExamenesPediatricosController@crear_examenes_paciente_pediatrico']);
		Route::post('crear_historia_medica_pediatrica',	['uses'	=>	'HistoriaMedicaPediatricaController@crear_historia_medica_pediatrica' ] );
	});

// Route::post('pacientes_pediatricos/crear_paciente_pediatrico',			['uses'	=>	'PacientesPediatricosController@crear_paciente_pediatrico']);
// Route::post('pacientes_pediatricos/crear_examenes_medicos_paciente',	['uses'	=>	'ExamenesPediatricosController@crear_examenes_paciente_pediatrico']);
// Route::post('pacientes_pediatricos/crear_historia_medica_pediatrica',	['uses'	=>	'HistoriaMedicaPediatricaController@crear_historia_medica_pediatrica' ] );

/*FIN BLOQUE ENVIO DE FORMULARIOS CON DATOS DE PACIENTES PEDIATRICOS*/

/********************FIN RUTAS PACIENTES PEDIATRICOS***********************************/

/*********************RUTAS MEDICOS*********************/
Route::get('medicos/creacion_medicos', 		['uses'	=>	'MedicosController@crear_nuevo_medico']);
Route::post('medicos/crear_nuevo_medico',	['uses' => 	'MedicosController@crear_nuevo_medico']);
/*****************FIN RUTAS MEDICOS*********************/


/**********************RUTAS PACIENTES OBSTETRICOS***********************/
Route::get('creacion_pacientes_obstetricos', function()
	{
		return View::make('pacientes.crear_paciente_obstetrico');
	});
/*********************FIN RUTAS PACIENTES OBSTETRICOS********************/

/***PATRONES DE SEGURIDAD BASADOS EN EXPRESIONES REGULARES***/
Route::pattern('id_paciente_pediatrico','[0-9]+');
/*FIN PATRONES DE SEGURIDAD BASADOS EN EXPRESIONES REGULARES*/


/*RUTAS DE CONSULTAS AJAX*/



/*AGRUPACION DE RUTAS SIMILARES*/
Route::group(['prefix'=>'pacientes_pediatricos'], function()
	{
		Route::get('obtener_paises/{pais}',array('uses'=>'PaisesController@mostrarPaises'))->where('pais','[a-zA-Z]+');
		Route::get('obtener_direccion/{dir}',array('uses'=>'RepresentanteController@mostrarDireccion'))->where('dir','[a-zA-Z]+');
		Route::get('obtener_ocupacion/{ocupacion}',array('uses'=>'RepresentanteController@mostrarOcupacionOficio'))->where('ocupacion','[a-zA-Z]+');
		Route::get('obtener_alergia/{alergia}',array('uses'=>'AlergiasController@mostrarAlergia'))->where('alergia','[a-zA-Z\s]+');
		Route::get('obtener_patologia/{patologia}',array('uses'=>'PatologiasController@mostrarPatologia'))->where('patologia','[a-zA-Z\s]+');
		Route::get('obtener_intolerancia/{intolerancia}',array('uses'=>'IntoleranciasController@mostrarIntolerancia'))->where('intolerancia','[a-zA-Z\s]+');
	}
);

/*LA RECOMENDACION MAS OBVIA SERIA LA AGRUPACION DE LAS RUTAS*/ //<-LISTO

// Route::get('pacientes_pediatricos/obtener_paises/{pais}',array('uses'=>'PaisesController@mostrarPaises'))->where('pais','[a-zA-Z]+');
// Route::get('pacientes_pediatricos/obtener_direccion/{dir}',array('uses'=>'RepresentanteController@mostrarDireccion'))->where('dir','[a-zA-Z]+');
// Route::get('pacientes_pediatricos/obtener_ocupacion/{ocupacion}',array('uses'=>'RepresentanteController@mostrarOcupacionOficio'))->where('ocupacion','[a-zA-Z]+');
// Route::get('pacientes_pediatricos/obtener_alergia/{alergia}',array('uses'=>'AlergiasController@mostrarAlergia'))->where('alergia','[a-zA-Z\s]+');
// Route::get('pacientes_pediatricos/obtener_patologia/{patologia}',array('uses'=>'PatologiasController@mostrarPatologia'))->where('patologia','[a-zA-Z\s]+');
// Route::get('pacientes_pediatricos/obtener_intolerancia/{intolerancia}',array('uses'=>'IntoleranciasController@mostrarIntolerancia'))->where('intolerancia','[a-zA-Z\s]+');

/*FIN RUTAS DE CONSULTAS AJAX*/
	 
