<?php

class IntoleranciasPacientePediatrico extends \Eloquent {
	protected $fillable = ['id_historia_medica','id_intolerancia'];
	public $primaryKey = 'id_intolernacia_paciente';
	public $table = 'intolerancias_paciente_pediatrico';
	public $timestamps = false;

	public static function obtenerIntoleranciasPacienteJSON($input)
		{

			$intolerancias_json	=	[];
			$contador_intolerancia	=	0;

			$datos_intolerancia = self::join('historia_paciente_pediatrico',
										'intolerancias_paciente_pediatrico.id_historia_medica',
											'=',
												'historia_paciente_pediatrico.id_historia_medica')
													->join('intolerancias','intolerancias_paciente_pediatrico.id_intolerancia','=','intolerancias.id_intolerancia')
														->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
															->select('intolerancia','id_intolernacia_paciente as id_intolerancia')
																->get();

			foreach($datos_intolerancia as $d):
				$contador_intolerancia ++;

				$intolerancias_json[] = 	[ 
											'num_int' 		=>	$contador_intolerancia,
											'intolerancia'	=>	$d->intolerancia,	
											'borrar'		=>	"<button class='btn btn-danger' id='".$d->id_intolernacia_paciente."'>Borrar</button"

										];
			endforeach;			
			return $intolerancias_json;
		}



	public static function guardarIntoleranciaPaciente($input)
		{
			$reglas_intolerancia = 	[
									'intolerancia_detectada'	=> 'required|exists:intolerancias,id_intolerancia'
								];
			$mensajes_error_intolerancias	=	[
												'required'	=>	'Debe seleccionar intolerancia antes de guardar',
												'exists'	=>	'Debe selecionar intolerancia valida'
											];

			$validador_intolerancias_paciente = Validator::make($input, $reglas_intolerancia, $mensajes_error_intolerancias);

			if($validador_intolerancias_paciente->fails())
				{
					return 	[
								'mensaje'	=>	$validador_intolerancias_paciente->messages(),
								'clase'		=>	'text-danger',
								'bandera'	=>	1
							];
				}

			$intolerancia_existente = self::where('id_intolerancia','=',$input['intolerancia_detectada'])
											->join('historia_paciente_pediatrico','intolerancias_paciente_pediatrico.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
												->where('id_paciente','=',Session::get('id_paciente_pediatrico'))
													->pluck('id_intolerancia');

			if(!empty($intolerancia_existente))
				{
					return 	[
								'mensaje'	=>	'La intolerancia seleccionada ya se encuentra asociada a la historia',
								'clase'		=>	'alert alert-danger',
								'bandera'	=>	2
							];
				}

			self::create(
							[
							'id_historia_medica'		=> HistoriaMedicaPediatrica::where('id_paciente','=',Session::get('id_paciente_pediatrico'))->pluck('id_historia_medica'), 
							'id_intolerancia'			=> $input['intolerancia_detectada']
							]
						);

			return 	[
						'mensaje'	=>	'Intolerancia registrada con exito',
						'clase'		=>	'alert alert-success',
						'bandera'	=>	2
					];

		}		

}