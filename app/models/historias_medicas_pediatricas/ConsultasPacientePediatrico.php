<?php

class ConsultasPacientePediatrico extends \Eloquent {
	protected $fillable = [	'fecha_consulta',
							'id_medico',
							'id_especialidad',
							'id_historia_medica',
							'sintomas',
							'diagnostico_consulta',
							'tratamiento_indicado',
							'asistio_consulta',
							'turno'
							];

	public $table = 'consultas_paciente_pediatrico';
	public $primaryKey = 'id_consulta_paciente';
	public $timestamps = false;



	public static function verificarColaConsultas($input)
		{
			$respuesta = 	[
							'cola' 		=>	'',
							'mensaje'	=>	'',
							'clase'		=>	''
							];
			$cola = NULL;
			
			$reglas_consulta = 	[
									'fecha_consulta'		=> 	'required|date_format:d/m/Y',
									'especialidad_consulta'	=>	'required|integer|exists:especialidades_medicas,id_especialidad',
									'turno_consulta'		=>	'required|in:M,T'
								];
			$errores_consulta = [
									'integer'		=>	'Debe seleccionar algún valor valido de la lista',
									'exists'		=>	'Debe seleccionar alguna especialidad de la lista',
									'required'		=>	'El valor es obligatorio',
									'date_format'	=>	'Valor de fecha invalido',
									'in'			=>	'La consulta debe ser en la mañana o en la tarde'
								];
			$validador_consulta = Validator::make($input, $reglas_consulta,$errores_consulta);

			if($validador_consulta->fails())
				{					
					$respuesta = 	[
										'mensaje' 	=> 	$validador_consulta->messages(),
										'bandera'	=>	1,
										'clase'		=>	'text text-danger'

									];
					return Response::json($respuesta);
				}
			
			$paciente_posee_consulta = self::join('historia_paciente_pediatrico','consultas_paciente_pediatrico.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
												->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
												->where('fecha_consulta','=',"'".$input['fecha_consulta']."'")
												->where('id_especialidad','=',$input['especialidad_consulta'])
												->count();

			 $cola = self::where('fecha_consulta','=',"'".$input['fecha_consulta']."'")
								->where('id_especialidad','=',$input['especialidad_consulta'])
								->count()." Paciente(s) en cola para esta especialidad y esta fecha";												

			if($paciente_posee_consulta > 0)
				{
					 $respuesta = [	'mensaje'	=> 	'El paciente ya tiene consulta para fecha y especialidad seleccionada',
					 				'cola'		=>	$cola,
					 				'clase'		=>	'alert alert-info',
					 				'bandera'	=>	2	
					 				];
					 return $respuesta;
				}
			if($cola < 20)
				{
					$respuesta = [	
									'mensaje'	=> 'Aun cuenta con suficientes cupos para la consulta',
									'cola'		=> $cola,
									'clase' 	=> 'alert alert-success',
									'bandera'	=>	3	
								];
				}
			if($cola >= 20 && $cola <= 29)
				{
					$respuesta['clase'] = 'alert alert-warning';
								$respuesta = [	
									'mensaje'	=> 'Ya quedan pocos cupos para esta consulta',
									'cola'		=> $cola,
									'clase' 	=> 'alert alert-warning',
									'bandera'	=>	3	
								];
				}
			if($cola == 30)
				{
					
					#$respuesta['clase'] = 'label label-danger';
					$respuesta = 	[
										'mensaje'	=> 	'No hay mas cupos para consultas en esta especialidad este día',
										'cola'		=>	$cola,
										'clase'		=>	'alert alert-danger',
										'bandera'	=>	1	
									];
					
				}		
			

			return ($respuesta);
		}


		
	public static function programarConsulta($input)
		{
			 $cola = self::where('fecha_consulta','=',"'".$input['fecha_consulta']."'")
								->where('id_especialidad','=',$input['especialidad_consulta'])
								->count()." Paciente(s) en cola";				

			$paciente_posee_consulta = self::join('historia_paciente_pediatrico','consultas_paciente_pediatrico.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
												->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
												->where('fecha_consulta','=',"'".$input['fecha_consulta']."'")
												->where('id_especialidad','=',$input['especialidad_consulta'])
												->count();

			if($paciente_posee_consulta > 0)
				{
					 $respuesta = [	'mensaje'	=> 	'El paciente ya tiene consulta para fecha y especialidad seleccionada',
					 				'cola'		=>	$cola,
					 				'clase'		=>	'alert alert-info',
					 				'bandera'	=>	2

					 				];
					 return $respuesta;
				}

												

			if($cola == 30)
				{					
					#$respuesta['clase'] = 'label label-danger';
					$respuesta = 	[
										'mensaje'	=> 	'No hay mas cupos para consultas en esta especialidad este día',
										'cola'		=>	$cola,
										'clase'		=>	'alert alert-danger',
										'bandera'	=>	2
									];
					return $respuesta;					
				}
			$id_historia_medica = HistoriaMedicaPediatrica::where('id_paciente','=',Session::get('id_paciente_pediatrico'))->pluck('id_historia_medica');
			$nueva_cita_medica = 	[
										'fecha_consulta'		=>	$input['fecha_consulta'],
										'id_especialidad'		=>	$input['especialidad_consulta'],										
										'id_historia_medica'	=>	$id_historia_medica,
										'turno'					=>	$input['turno_consulta'],
										'asistio_consulta'		=>	''
									];
			self::create($nueva_cita_medica);
			 $cola = self::where('fecha_consulta','=',"'".$input['fecha_consulta']."'")
								->where('id_especialidad','=',$input['especialidad_consulta'])
								->count()." Paciente(s) en cola";				
			$respuesta = 	[
								'mensaje'	=> 	'Consulta médica programada con éxito',
								'cola'		=>	$cola,
								'clase'		=>	'alert alert-success',
								'bandera'	=>	2
							];			

			return $respuesta;
		}

	public static function listarConsultasHistoricoInicial()
		{
			$consultas_historico = DB::table('consultas_paciente_pediatrico')
											->select('fecha_consulta', 'especialidad', 'asistio_consulta')
											->join('especialidades_medicas','consultas_paciente_pediatrico.id_especialidad','=','especialidades_medicas.id_especialidad')
											->join('historia_paciente_pediatrico','consultas_paciente_pediatrico.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))->get();
			return $consultas_historico;
		}

	public static function historicoConsultas($id_historia_medica)
		{
			$consultas_historico = self::select('fecha_consulta', 'especialidad', 'asistio_consulta')
											->join('especialidades_medicas','consultas_paciente_pediatrico.id_especialidad','=','especialidades_medicas.id_especialidad')
											->join('historia_paciente_pediatrico','consultas_paciente_pediatrico.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))->get();
			return $consultas_historico;
		}		
	public static function listarConsultasHistoricoJSON()
		{
			$nuevo_json = [];
			$nueva_fecha = NULL;
			$respuesta_asistio = NULL;
			$cierre	= NULL;
			$consultas_historico = DB::table('consultas_paciente_pediatrico')
											->select('fecha_consulta', 'especialidad', 'asistio_consulta','id_consulta_paciente')
											->join('especialidades_medicas','consultas_paciente_pediatrico.id_especialidad','=','especialidades_medicas.id_especialidad')
											->join('historia_paciente_pediatrico','consultas_paciente_pediatrico.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))->get();
			foreach($consultas_historico as $d):				
				$nueva_fecha = new DateTime($d->fecha_consulta);
				switch($d->asistio_consulta)
					{
						case 'S':
							$respuesta_asistio	= 'SI';
							$cierre 			= '<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>';
						break;

						case 'N':
							$respuesta_asistio	= 'NO';
							$cierre 			= '<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>';
						break;

						case null:
							$respuesta_asistio 	= "<button class='btn btn-danger' id='".$d->id_consulta_paciente."'>Anular</button";
							$cierre 			= "<button class='btn btn-success' id='".$d->id_consulta_paciente."'>Cerrar</button";
						break;
					}
				$nuevo_json[]	=	[
										'fecha_consulta'	=> $nueva_fecha->format('d/m/Y'), 
										'especialidad'		=> $d->especialidad,
										'asistio_consulta'	=> $respuesta_asistio,
										'cerrar_consulta'	=> $cierre,
									];				
			endforeach;

			return Response::json($nuevo_json);
		}
	public static function anularConsultaMedica($input)
		{
			$respuesta = [];
			$paciente_posee_consulta = self::join('historia_paciente_pediatrico','consultas_paciente_pediatrico.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
												->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
												->where('id_consulta_paciente','=',$input['id_consulta_paciente'])
												->where('asistio_consulta','=','')												
												->count();

			if($paciente_posee_consulta < 1)
				{
					$respuesta[] = [ 'mensaje' => 'No existe la consulta que quiere anular','clase' => 'label label-danger' ];
					return $respuesta;
				}
			self::destroy($input['id_consulta_paciente']);

			$respuesta[] = [ 'mensaje' => 'Consulta anulada satisfactoriamente','clase' => 'label label-success' ];
			return $respuesta;

		}

	public function HistoriaMedicaPediatrica()
		{
			return $this->belongsTo('HistoriaMedicaPediatrica','id_historia_medica','id_historia_medica');
		}

	public static function cerrarConsultaMedica($input)
		{
			

/*
                      'id_consulta_paciente'      : identificador_consulta,
                      'medico_receptor_consulta'  : $('#medico_receptor_consulta').val(),
                      'sintomas_consulta'         : $('#sintomas_consulta').val(),          
                      'diagnostico_consulta'      : $('#diagnostico_consulta').val(),       
                      'paciente_asistio'          : $('#paciente_asistio').val(),    

*/

			$reglas_asistencia 	= 	[
										'paciente_asistio'	=>	'required|in:S,N'
									];

			$mensaje_asistencia	=	[
										'required'	=>	'Este campo es obligatorio',
										'in'		=>	'Debe seleccionar entre las opciones disponibles'
									];


			$validador_asistencia = Validator::make($input, $reglas_asistencia, $mensaje_asistencia);

			if($validador_asistencia->fails())
				{
					return 	[
								'mensaje'	=> 	$validador_asistencia->messages(),
								'clase'		=>	'text text-danger',
								'bandera'	=>	1
							];
				}


		

			$respuesta = NULL;
			$consulta_paciente = self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
									->join('historia_paciente_pediatrico','consultas_paciente_pediatrico.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
										->where('id_consulta_paciente', '=', $input['id_consulta_paciente'])
											->pluck('id_consulta_paciente');
			
			

			if(empty($consulta_paciente))
				{
					$respuesta = 	[
										'mensaje'	=> 	'Consulta inexistente',
										'clase'		=>	'alert alert-danger',
										'bandera'	=>	2
									];
					return $respuesta;
				}
			if($input['paciente_asistio'] == 'N') 
				{
					DB::table('consultas_paciente_pediatrico')
							->where('id_consulta_paciente','=', $input['id_consulta_paciente'])
								->update(['asistio_consulta'	=>	$input['paciente_asistio']]);

					return 	[
								'mensaje'	=> 	'Consulta cerrada con exito',
								'clase'		=>	'alert alert-success',
								'bandera'	=>	2
							];							
				}

			$reglas_cierre 		= 	[
										'medico_receptor_consulta'	=>	'required|exists:medicos,id_medico' ,
										'sintomas_consulta'			=>	'required' ,
										'diagnostico_consulta'		=>	'required' ,
									];

			$mensajes_cierre	=	[
										'required'	=>	'Este campo es obligatorio',
										'exists'	=>	'Debe seleccionar un medico válido de la lista'
									];

			$validador_cierre = Validator::make($input, $reglas_cierre, $mensajes_cierre);


			if($validador_cierre->fails())
				{
					return 	[
								'mensaje'	=> 	$validador_cierre->messages(),
								'clase'		=>	'text text-danger',
								'bandera'	=>	1
							];
				}

			if($input['paciente_asistio'] == 'S') 
				{
					DB::table('consultas_paciente_pediatrico')
							->where('id_consulta_paciente','=', $input['id_consulta_paciente'])
								->update(
											[
												'id_medico'				=>	$input['medico_receptor_consulta'],
												'sintomas'				=>	$input['sintomas_consulta'],
												'diagnostico_consulta'	=>	$input['diagnostico_consulta'],
												'asistio_consulta'		=>	$input['paciente_asistio'],
											]
										);
					return 	[
								'mensaje'	=> 	'Consulta cerrada con exito',
								'clase'		=>	'alert alert-success',
								'bandera'	=>	2
							];							
				}
		}
}