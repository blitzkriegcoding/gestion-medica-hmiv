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
/*		
		$interrogatorio_items = 
			DB::table('grupo_interrogatorio')
			->join('condicion_interrogatorio','grupo_interrogatorio.id_grupo' ,'=','condicion_interrogatorio.id_grupo')
			->select('grupo', 'id_condicion_grupo','condicion_grupo')
			->orderBy('grupo_interrogatorio.id_grupo','asc')
			->get();*/

			/*->toSql();*/
			#dd($interrogatorio);
		$interrogatorio_items = GrupoInterrogatorio::all();
		$interrogatorio_item = CondicionInterrogatorio::all();
		
		
		
/*		$examen_funcional_items = 
			DB::table('grupo_examen_funcional')
			->join('condicion_examen_funcional','grupo_examen_funcional.id_grupo_examen','=','condicion_examen_funcional.id_grupo_examen')
			->select('grupo_examen', 'id_condicion_examen','condicion')
			->orderBy('grupo_examen_funcional.id_grupo_examen','asc')
			->get();*/
		
/*		$examen_fisico_items = 
			DB::table('grupo_examen_fisico')
			->join('condicion_examen_fisico','grupo_examen_fisico.id_grupo_examen_fisico','=','condicion_examen_fisico.id_grupo_examen_fisico')
			->select('examen_fisico','id_grupo_examen_fisico_condicion','examen_fisico_condicion')
			->orderBy('grupo_examen_fisico.id_grupo_examen_fisico','asc')
			->get();*/
		
		
		

	

	return View::make('pacientes_pediatricos.crear_examenes_medicos_paciente')
				->with(array('interrogatorio_items' => $interrogatorio_items,
								'interrogatorio_item' => $interrogatorio_item
							/*'examen_funcional_items' => $examen_funcional_items, 
							'examen_fisico_items' => $examen_fisico_items*/));

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
	 
