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
/**************************RUTAS INICIO SESION********************************/
Route::get('/',function() 
		{
			return View::make('InicioSesion');
		}
	);
Route::get('/iniciar_sesion',function() 
		{
			return View::make('InicioSesion');
		}
	);

/**************************RUTAS PACIENTES PEDIATRICOS********************************/

Route::group(['prefix' => 'pacientes_pediatricos'] ,function()
	{
		/*TODOS LOS GET*/
		Route::get('creacion_pacientes_pediatricos',									['uses'=>	'PacientesPediatricosController@nuevo_paciente_pediatrico'] );
		Route::get('creacion_examenes_medicos_pediatricos/{id_paciente_pediatrico}',	['uses'	=>	'ExamenesPediatricosController@crear_examenes_medicos_pediatricos']);
		
		/*TODOS LOS POST*/
		Route::post('crear_paciente_pediatrico',		['uses'	=>	'PacientesPediatricosController@crear_paciente_pediatrico']);
		Route::post('crear_examenes_medicos_paciente',	['uses'	=>	'ExamenesPediatricosController@crear_examenes_paciente_pediatrico']);

		/*RUTAS PARA CONSULTAS VIA AJAX*/
		Route::get('obtener_paises/{pais}',					['uses'=>'PaisesController@mostrarPaises'])->where('pais','[a-zA-Z]+');
		Route::get('obtener_direccion/{dir}',				['uses'=>'RepresentanteController@mostrarDireccion'])->where('dir','[a-zA-Z]+');
		Route::get('obtener_ocupacion/{ocupacion}',			['uses'=>'RepresentanteController@mostrarOcupacionOficio'])->where('ocupacion','[a-zA-Z]+');
		Route::get('obtener_alergia/{alergia}',				['uses'=>'AlergiasController@mostrarAlergia'])->where('alergia','[a-zA-Z\s]+');
		Route::get('obtener_patologia/{patologia}',			['uses'=>'PatologiasController@mostrarPatologia'])->where('patologia','[a-zA-Z\s]+');
		Route::get('obtener_intolerancia/{intolerancia}',	['uses'=>'IntoleranciasController@mostrarIntolerancia'])->where('intolerancia','[a-zA-Z\s]+');
	});
/**************************RUTAS HISTORIAS PEDIATRICAS********************************/
Route::group(['prefix' => 'historias_medicas_pediatricas'], function()
	{
		/*TODOS LOS GET*/
		Route::get('creacion_historia_medica_pediatrica/{id_paciente_pediatrico}',		['uses'	=>	'HistoriaMedicaPediatricaController@nueva_historia_medica_pediatrica']);		
		Route::get('creacion_historia_medica_federada/{id_paciente_pediatrico}',		['uses' =>	'HistoriaMedicaFederadaController@nueva_historia_medica_federada']);
		Route::get('recargar_historico_consultas',										['uses'	=> 'HistoriaMedicaFederadaController@recargar_historico_consultas'] );
		Route::get('obtener_historico_vacunas',											['uses' =>	'HistoriaMedicaFederadaController@obtener_historico_vacunas' ]);
		
		/*TODOS LOS POST*/
		Route::post('cola_consultas',													['uses' => 	'HistoriaMedicaFederadaController@verificar_cola_consultas']);
		Route::post('cargar_consulta_nueva',											['uses'	=>	'HistoriaMedicaFederadaController@cargar_consulta_nueva']);
		Route::post('anular_consulta_medica',											['uses'	=>	'HistoriaMedicaFederadaController@anular_consulta_medica']);
		Route::post('borrar_vacuna_aplicada',											['uses'	=>	'HistoriaMedicaFederadaController@borrar_vacuna_aplicada']);
		Route::post('crear_historia_medica_pediatrica',									['uses'	=>	'HistoriaMedicaPediatricaController@crear_historia_medica_pediatrica' ] );
		Route::post('cargar_vacuna_nueva',												['uses'	=>	'HistoriaMedicaFederadaController@cargar_vacuna_nueva']);
		
		/*RUTAS PARA CONSULTA VIA AJAX*/
		Route::get('obtener_vacuna/{vacuna}',											['uses'	=> 'HistoriaMedicaFederadaController@obtener_vacuna'] );
	});

/*********************RUTAS MEDICOS*********************/
Route::group(['prefix' => 'medicos'], function()
	{
		/*TODOS LOS GET*/
		Route::get('creacion_medicos', 		['uses'	=>	'MedicosController@crear_nuevo_medico']);

		/*TODOS LOS POST*/
		Route::post('nuevo_medico',			['uses' => 	'MedicosController@nuevo_medico']);

		/*RUTAS PARA CONSULTAS VIA AJAX*/
		Route::get('obtener_especialidades_medicas/{especialidad_medica}',['uses' => 'EspecialidadesMedicasController@mostrarEspecialidades'] );
	}
);
/*****************FIN RUTAS MEDICOS*********************/

/*********************RUTAS DE BUSQUEDA*********************/
Route::group(['prefix' => 'busquedas'], function()
	{
		/*TODOS LOS GETS*/
		Route::get('busqueda_nueva', 	['uses' => 'BusquedasController@crear_nueva_busqueda']);

		/*TODOS LOS POST*/

		/*RUTAS PARA CONSULTA VIA AJAX*/
		Route::post('generar_busqueda',	['uses' => 'BusquedasController@generar_busqueda']);

	}
);
/*********************FIN RUTAS MEDICOS*********************/


/**********************RUTAS PACIENTES OBSTETRICOS***********************/
Route::get('creacion_pacientes_obstetricos', function()
	{
		return View::make('pacientes.crear_paciente_obstetrico');
	});
/*********************FIN RUTAS PACIENTES OBSTETRICOS********************/

/***PATRONES DE SEGURIDAD BASADOS EN EXPRESIONES REGULARES***/
Route::pattern('id_paciente_pediatrico','[0-9]+');
/*FIN PATRONES DE SEGURIDAD BASADOS EN EXPRESIONES REGULARES*/

	 
/*********RUTA ESPECIAL PARA ENTRUST**************/
Route::get('crear_perfil', function()
	{
	    $admin = new Role();
	    $admin->name = 'Administrador';
	    $admin->save();
	  
	    $user = new Role();
	    $user->name = 'Usuario Generico';
	    $user->save();
	  
	    $read = new Permission();
	    $read->name = 'can_read';
	    $read->display_name = 'Puede Leer';
	    $read->save();
	  
	    $edit = new Permission();
	    $edit->name = 'can_edit';
	    $edit->display_name = 'Puede Listar';
	    $edit->save();
	  
	    $user->attachPermission($read);
	    $admin->attachPermission($read);
	    $admin->attachPermission($edit);
	 
	    $adminRole = DB::table('roles')->where('name', '=', 'Admin')->pluck('id');
	    $userRole = DB::table('roles')->where('name', '=', 'User')->pluck('id');
	    // print_r($userRole);
	    // die();
	  
	    $user1 = User::where('username','=','imron02')->first();
	    $user1->roles()->attach($adminRole);
	    $user2 = User::where('username','=','asih')->first();
	    $user2->roles()->attach($userRole);
	    $user3 = User::where('username','=','sarah')->first();
	    $user3->roles()->attach($userRole);
	    return 'Woohoo!';
	}
);

/*************************************************///

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');
