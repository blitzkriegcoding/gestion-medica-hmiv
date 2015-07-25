<?php

class Hospitalizacion extends \Eloquent 
	{
		protected $fillable = 	[
									'fecha_hospitalizacion',
									'id_historia_medica',
									'fecha_alta',
									'observaciones_hospitalizacion',
									'id_alta_medica',
									'piso',
									'sala',
									'codigo_cama'
								];
		public $primaryKey = 'id_hospitalizacion';
		public $table = 'hospitalizacion';
		public $timestamps = false;

		public function HistoriaMedicaPediatrica()
			{
				return $this->belongsTo('HistoriaMedicaPediatrica','id_historia_medica','id_historia_medica');				
			}

		public static function obtenerHistoricoHospitalizacionJSON()
			{
				$contador_historico = 0;
				$historico_hospitalizacion = self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
													->join('historia_paciente_pediatrico','hospitalizacion.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
														->select('fecha_hospitalizacion as fec_hos','sala','codigo_cama','piso','id_hospitalizacion','fecha_alta','id_alta_medica')
															->get();
				
				#dd($historico_hospitalizacion);
				$historico_json = [];

				

				foreach($historico_hospitalizacion as $d):
					$contador_historico++;
					$nueva_fecha = new DateTime($d->fec_hos);
					if(is_null($d->id_alta_medica))
						{
							$alta = "NO";
							$boton_alta 	= "<button class='btn btn-success' id='".$d->id_hospitalizacion."'>Otorgar</button>";
							$boton_borrar 	= "<button class='btn btn-danger' id='".$d->id_hospitalizacion."'>Borrar</button>";
						}
					else
						{
							$alta = "SI";
							$boton_alta 	= '<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>';
							$boton_borrar 	= '<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>';
						}


					$historico_json[] = [ 
											'num_hos'		=>	$contador_historico,
											'fecha' 		=> 	$nueva_fecha->format('d/m/Y'), 
											'sala'			=>	$d->sala,
											'codigo_cama'	=>	$d->codigo_cama,
											'piso'			=>	$d->piso,
											'alta'			=>	$boton_alta,
											'borrar'		=>	$boton_borrar,
											'detalles'		=>	"<button class='btn btn-info' id='".$d->id_hospitalizacion."'>Ver</button>"
										];
				endforeach;
				return Response::json($historico_json);
			}
		public static function cargarHospitalizacionNueva($input)
			{
				$reglas_hospitalizacion = 	[
												'fecha_hospitalizacion'			=>	'required|date_format:d/m/Y',
												'piso_hospitalizacion'			=>	'required|in:1,2,3,4',
												'sala_hospitalizacion'			=>	'required|regex:/([A-Za-z0-9-])+/',
												'codigo_cama_hospitalizacion'	=>	'required|regex:/([A-Za-z0-9-])+/',
												'observaciones_hospitalizacion'	=>	'required|regex:/([A-Za-z0-9-\.\,])+/',
											];


				$errores_hospitalizacion =	[
												'required'	=>	'El valor de este campo es obligatorio',
												'in'		=>	'Seleccione entre las alternativas de la lista',
												'regex'		=>	'El patron alfanumerico no corresponde'
											];

				$validador_hospitalizacion = Validator::make($input, $reglas_hospitalizacion, $errores_hospitalizacion);

				if($validador_hospitalizacion->fails())
					{
						return 	[
									'mensaje'	=>	$validador_hospitalizacion->messages(),
									'clase'		=>	'text-danger',
									'bandera'	=>	1
								];
					}

				$existe_hospitalizacion_abierta = self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
													->whereNull('id_alta_medica'/*,'=',NULL*/)
														->whereNotNull('id_hospitalizacion')
															->join('historia_paciente_pediatrico','hospitalizacion.id_historia_medica', '=', 'historia_paciente_pediatrico.id_historia_medica')														
																//->pluck('id_hospitalizacion');
																->max('id_hospitalizacion');
																//->toSql();
				//dd($existe_hospitalizacion_abierta);																
				if(($existe_hospitalizacion_abierta)>0)
					{
						return 	[
									'mensaje'	=>	'El paciente ya posee uno hospitalización abierta, es necesario darlo de alta para una nueva hospitalización',
									'clase'		=>	'alert alert-danger fade in',
									'bandera'	=>	2
								];					
					}

				self::create(
								[
									'fecha_hospitalizacion'			=> $input['fecha_hospitalizacion'],
									'id_historia_medica'			=> HistoriaMedicaPediatrica::where('id_paciente','=',Session::get('id_paciente_pediatrico'))->pluck('id_historia_medica'),									
									'observaciones_hospitalizacion'	=> $input['observaciones_hospitalizacion'],
									'piso'							=> $input['piso_hospitalizacion'],
									'sala'							=> $input['sala_hospitalizacion'],
									'codigo_cama'					=> $input['codigo_cama_hospitalizacion'],
								]
							);

				return 	[
							'mensaje'	=>	'Hospitalización creada con éxito',
							'clase'		=>	'alert alert-success fade in',
							'bandera'	=>	2
						];	





			}

		public static function borrarHospitalizacionGuardada($input)
			{
				$reglas_borrado_hospitalizacion = 	[
														'id_hospitalizacion'	=>	'required|integer'
													];
				$mensajes_error_hospitalizacion = 	[
														'integer'	=>	'Dato de borrado'
													];

				$validador_borrado = Validator::make($input, $reglas_borrado_hospitalizacion, $mensajes_error_hospitalizacion);
				if($validador_borrado->fails())
					{
						return 	[
									'mensaje'	=>	$validador_borrado->messages(),
									'clase'		=>	'alert alert-danger fade in',
									'bandera'	=>	2
								];
					}


				$hospitalizacion_existe = self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
													->where('id_hospitalizacion','=',$input['id_hospitalizacion'])
														->join('historia_paciente_pediatrico','hospitalizacion.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
															->pluck('id_hospitalizacion');


				if(empty($hospitalizacion_existe))
					{
						return 	[
									'mensaje'	=>	'Hospitalización no existe',
									'clase'		=>	'alert alert-danger fade in',
									'bandera'	=>	2
								];						
					}

				
				self::destroy($input['id_hospitalizacion']);

				return 	[
							'mensaje'	=>	'Hospitalización borrada con éxito',
							'clase'		=>	'alert alert-success fade in',
							'bandera'	=>	2
						];
			}

		public static function otorgarAltaMedica($input)
			{
				$reglas_alta_medica 	= 	[
												'fecha_alta_medica_campo'	=>	'required|date_format:d/m/Y',
												'tipo_alta_medica'			=>	'required|exists:tipos_alta_medica_pediatrica,id_alta_medica',
												'medico_alta'				=>	'required|exists:medicos,id_medico',
												'resumen_egreso'			=>	'required'
											];

				$mensajes_error_alta	=	[
												'required'		=>	'Este campo es obligatorio',
												'exists'		=>	'Seleccione un médico de la lista',
												'date_format'	=>	'Fecha con formato inválido'
											];

				$validador_alta 		= Validator::make($input, $reglas_alta_medica, $mensajes_error_alta);

				if($validador_alta->fails())
					{
						return 	[
									'mensaje'	=>	$validador_alta->messages(),
									'clase'		=>	'text text-danger',
									'bandera'	=>	1
								];
					}

				$hospitalizacion_existe = self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
													->where('id_hospitalizacion','=',$input['id_hospitalizacion'])
														->join('historia_paciente_pediatrico','hospitalizacion.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
															->pluck('id_hospitalizacion');


				if(empty($hospitalizacion_existe))
					{
						return 	[
									'mensaje'	=>	'Hospitalización no existe',
									'clase'		=>	'alert alert-danger fade in',
									'bandera'	=>	2
								];						
					}
 
				DB::table('hospitalizacion')->where('id_hospitalizacion', '=', $input['id_hospitalizacion'])
											->update([
														'fecha_alta'		=>	$input['fecha_alta_medica_campo'],
														'id_alta_medica' 	=>	$input['tipo_alta_medica']
													]);

				ResumenEgresoPediatrico::guardarResumenEgreso($input);

						return 	[
									'mensaje'	=>	'Alta médica otorgada con éxito',
									'clase'		=>	'alert alert-success fade in',
									'bandera'	=>	2
								];					






			}

	}