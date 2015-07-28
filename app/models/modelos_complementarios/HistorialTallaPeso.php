<?php

class HistorialTallaPeso extends \Eloquent 
	{
		protected $fillable = 	[
									  'id_paciente',
									  'talla',
									  'peso',
									  'fecha_toma',
								];

		public $primaryKey 	= 	'id_historial_talla_peso';
		public $table 		= 	'historial_talla_peso';
		public $timestamps 	= 	false;

		public static function obtenerHistoricoTallaPeso()
			{
				$talla_peso_json 		= [];
				$contador_talla_peso 	= 0;
				$talla_peso = self::where('id_paciente', '=', Session::get('id_paciente_pediatrico'))
									->select('talla','peso','fecha_toma','id_historial_talla_peso')
										->get();
				foreach($talla_peso as $d):
					$contador_talla_peso ++;
					$nueva_fecha = new DateTime($d->fecha_toma);
					$talla_peso_json[] 	= 	[
												'num_tal'	=>	$contador_talla_peso,
												'talla'		=>	$d->talla,
												'peso'		=>	$d->peso,
												'fecha'		=>	$nueva_fecha->format('d/m/Y'),
												'borrar'	=>	"<button class='btn btn-danger' id='".$d->id_historial_talla_peso."'>Borrar</button>"
											];
				endforeach;
				return Response::json($talla_peso_json);
			}

		public static function guardarTallaPeso($input)
			{
					$reglas_talla_peso		= 	[
													'fecha_toma_talla_peso'	=>	'required|date_format:d/m/Y',
													'peso_paciente'			=>	'required|numeric',
													'talla_paciente'		=>	'required|numeric'
												];

					$mensajes_talla_peso	=	[	
													'required'		=>	'Campo obligatorio',
													'numeric'		=>	'Campo de uso numerico',
													'date_format'	=>	'Formato de fecha inválido'
												];

					$validador_talla_peso = Validator::make($input, $reglas_talla_peso, $mensajes_talla_peso);

					if($validador_talla_peso->fails())
						{
							return 	[
										'mensaje'	=>	$validador_talla_peso->messages(),
										'clase'		=>	'text-danger',
										'bandera'	=>	1
									];
						}

					$talla_actual = self::where('id_paciente', '=', Session::get('id_paciente_pediatrico'))
											->max('talla');

					if($input['talla_paciente'] < $talla_actual)
						{
							return 	[
										'mensaje'	=>	'El peso puede descender en un paciente pediátrico pero no la talla',
										'clase'		=>	'alert alert-warning',
										'bandera'	=>	2
									];							
						}

					self::create(
									[
									  'id_paciente'	=>	Session::get('id_paciente_pediatrico'),
									  'talla'		=>	$input['talla_paciente'],
									  'peso'		=>	$input['peso_paciente'],
									  'fecha_toma'	=>	$input['fecha_toma_talla_peso']
									]						
								);
					return 	[
								'mensaje'	=>	'Talla y peso registrados con exito',
								'clase'		=>	'alert alert-success',
								'bandera'	=>	2
							];						

			}
		public static function borrarTallaPeso($input)
			{
				$talla_peso_existe = self::where('id_paciente', '=', Session::get('id_paciente_pediatrico'))
											->where('id_historial_talla_peso','=', $input['id_talla_peso'])
												->pluck('id_historial_talla_peso');

				if(empty($talla_peso_existe))
					{
						return 	[
									'mensaje'	=>	'Talla y peso inválidos',
									'clase'		=>	'alert alert-danger',
									'bandera'	=>	2
								];
					}
				self::destroy($input['id_talla_peso']);

				return 	[
							'mensaje'	=>	'Talla y peso borrados con éxito',
							'clase'		=>	'alert alert-success',
							'bandera'	=>	2
						];						


			}


	}