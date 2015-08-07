<?php

class AlergiasPacientePediatrico extends \Eloquent {
	protected $fillable = ['id_historia_medica','id_alergia'];
	public $primaryKey 	= 'id_alergia_historia';
	public $timestamps 	= false;
	public $table 		= 'alergias_historia_pediatrica';

	public function Alergias()
		{
			return $this->belongsTo('AlergiasPacientePediatrico','id_alergia','id_alergia');
		}

	public static function obtenerAlergiasPacienteJSON($input)
		{
			$alergias_json	=	[];
			$contador_alergia	=	0;

			$datos_intolerancia = self::join('historia_paciente_pediatrico',
										'alergias_historia_pediatrica.id_historia_medica',
											'=',
												'historia_paciente_pediatrico.id_historia_medica')
													->join('alergias','alergias_historia_pediatrica.id_alergia','=','alergias.id_alergia')
														->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
															->select('alergia','id_alergia_historia as id_alergia')
																->get();

			foreach($datos_intolerancia as $d):
				$contador_alergia ++;

				$alergias_json[] = 	[ 
											'num_ale' 		=>	$contador_alergia,
											'alergia' 		=>	$d->alergia,	
											'borrar'		=>	"<button class='btn btn-danger' id='".$d->id_alergia."'>Borrar</button"

										];
			endforeach;
			#dd($datos_intolerancia);
			return $alergias_json;
		}	

	public static function reporteAlergiasHistoria($id_historia_medica)
		{
			$datos_alergia = self::join('historia_paciente_pediatrico',
										'alergias_historia_pediatrica.id_historia_medica',
											'=',
												'historia_paciente_pediatrico.id_historia_medica')
													->join('alergias','alergias_historia_pediatrica.id_alergia','=','alergias.id_alergia')
														->where('historia_paciente_pediatrico.id_historia_medica','=',$id_historia_medica)
															->select('alergia','id_alergia_historia as id_alergia')
																->get();
			
			return $datos_alergia;
		}			
	public static function guardarAlergiaPaciente($input)
		{
			$reglas_alergias = 	[
									'alergia_detectada'	=> 'required|exists:alergias,id_alergia'
								];
			$mensajes_error_alergias	=	[
												'required'	=>	'Debe seleccionar alergia antes de guardar',
												'exists'	=>	'Debe selecionar alergia valida'
											];

			$validador_alergias_paciente = Validator::make($input, $reglas_alergias, $mensajes_error_alergias);

			if($validador_alergias_paciente->fails())
				{
					return 	[
								'mensaje'	=>	$validador_alergias_paciente->messages(),
								'clase'		=>	'text-danger',
								'bandera'	=>	1
							];
				}

			$alergia_existente = self::where('id_alergia','=',$input['alergia_detectada'])
										->join('historia_paciente_pediatrico','alergias_historia_pediatrica.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->where('id_paciente','=',Session::get('id_paciente_pediatrico'))
												->pluck('id_alergia');

			if(!empty($alergia_existente))
				{
					return 	[
								'mensaje'	=>	'La alergia seleccionada ya se encuentra asociada a la historia',
								'clase'		=>	'alert alert-danger',
								'bandera'	=>	2
							];
				}

			self::create(
							[
							'id_historia_medica'	=> HistoriaMedicaPediatrica::where('id_paciente','=',Session::get('id_paciente_pediatrico'))->pluck('id_historia_medica'), 
							'id_alergia'			=> $input['alergia_detectada']
							]
						);

			return 	[
						'mensaje'	=>	'Alergia registrada con exito',
						'clase'		=>	'alert alert-success',
						'bandera'	=>	2
					];

		}

	public static function borrarAlergiaPaciente($input)
		{
			$reglas_borrado_alergias	= 	[
												'alergia_detectada'	=>	'required|exists:alergias_historia_pediatrica,id_alergia_historia'
											];
			$mensaje_borrado_alergias 	=	[	
												'required'	=>	'Debe tener un elemento asignado',
												'exists'	=>	'No existe alergia asignada'
											];

			$validador_borrado = Validator::make($input, $reglas_borrado_alergias, $mensaje_borrado_alergias);

			if($validador_borrado->fails())
				{
					return 	[
								'mensaje'	=>	$validador_borrado->messages(),
								'clase'		=>	'alert alert-danger',
								'bandera'	=>	3
							];

				}
			$alergia_existente = self::where('id_alergia_historia','=',$input['alergia_detectada'])
										->join('historia_paciente_pediatrico','alergias_historia_pediatrica.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->where('id_paciente','=',Session::get('id_paciente_pediatrico'))
												->pluck('id_alergia_historia');
			

			if(empty($alergia_existente))
				{
					return 	[
								'mensaje'	=>	'La alergia a borrar no existe',
								'clase'		=>	'alert alert-danger',
								'bandera'	=>	2
							];
				}
			self::destroy($input['alergia_detectada']);
			return 	[
						'mensaje'	=>	'Alergia borrada con exito',
						'clase'		=>	'alert alert-success',
						'bandera'	=>	2
					];
		}

	public static function distribucionPacientesAlergicos()	
		{
			$pacientes_alergicos_json = [];

			$pacientes_alergicos = DB::table('alergias_historia_pediatrica')
			                     ->select(DB::raw('count(alergias.alergia) as cant_alergia, alergias.alergia as ale'))	                     
				                     ->join('historia_paciente_pediatrico','alergias_historia_pediatrica.id_historia_medica','=', 'historia_paciente_pediatrico.id_historia_medica')
					                     ->join('alergias','alergias_historia_pediatrica.id_alergia','=','alergias.id_alergia')	
					                     	->groupBy('alergias.alergia')
					                     		->get();

			foreach($pacientes_alergicos as $d):

	 			$fila[0] = $d->ale;
	 			$fila[1] = $d->cant_alergia;
	 			array_push($pacientes_alergicos_json, $fila);
	 			
			endforeach;
			return json_encode($pacientes_alergicos_json, JSON_NUMERIC_CHECK);				
		}


}