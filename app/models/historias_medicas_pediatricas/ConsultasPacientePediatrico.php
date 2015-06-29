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
									'required'		=>	'Los valores de Fecha de la consulta, Especialidad y Turno',
									'date_format'	=>	'Valor de fecha invalido',
									'in'			=>	'La consulta debe ser en la mañana o en la tarde'
								];
			$validador_consulta = Validator::make($input, $reglas_consulta,$errores_consulta);

			if($validador_consulta->fails())
				{					
					$respuesta = 	[
										'mensaje' => $validador_consulta->messages()
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
					 				'clase'		=>	'label label-info'
					 				];
					 return $respuesta;
				}
			if($cola < 20)
				{
					$respuesta = [	'mensaje'	=> '',
								'cola'		=> $cola,
								'clase' 	=> 'label label-success'
								];
				}
			if($cola >= 20 && $cola <= 29)
				{
					$respuesta['clase'] = 'label label-warning';	
				}
			if($cola == 30)
				{
					
					#$respuesta['clase'] = 'label label-danger';
					$respuesta = 	[
										'mensaje'	=> 	'No hay mas cupos para consultas en esta especialidad este día',
										'cola'		=>	$cola,
										'clase'		=>	'label label-danger'
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
					 				'clase'		=>	'label label-danger'
					 				];
					 return $respuesta;
				}

												

			if($cola == 30)
				{					
					#$respuesta['clase'] = 'label label-danger';
					$respuesta = 	[
										'mensaje'	=> 	'No hay mas cupos para consultas en esta especialidad este día',
										'cola'		=>	$cola,
										'clase'		=>	'label label-danger'
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
			$respuesta = 	[
								'mensaje'	=> 	'Consulta médica programada con éxito',
								'cola'		=>	$cola,
								'clase'		=>	'label label-success'
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
	public static function listarConsultasHistoricoJSON()
		{
			$nuevo_json = [];
			$nueva_fecha = NULL;
			$respuesta_asistio = NULL;
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
							$respuesta_asistio = 'SI';
						break;

						case 'N':
							$respuesta_asistio = 'NO';
						break;

						case null:
							$respuesta_asistio = "<button class='btn btn-danger' id='".$d->id_consulta_paciente."'>Anular</button";
						break;
					}
				$nuevo_json[]	=	['fecha_consulta' => $nueva_fecha->format('d/m/Y'), 'especialidad' => $d->especialidad, 'asistio_consulta' => $respuesta_asistio ];				
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




}