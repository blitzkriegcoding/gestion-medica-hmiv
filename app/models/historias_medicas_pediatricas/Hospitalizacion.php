<?php

class Hospitalizacion extends \Eloquent 
	{
		protected $fillable = [];
		public $primaryKey = 'id_hospitalizacion';
		public $table = 'hospitalizacion';

		public function HistoriaMedicaPediatrica()
			{
				return $this->belongsTo('HistoriaMedicaPediatrica','id_historia_medica','id_historia_medica');				
			}

		public static function obtenerHistoricoHospitalizacionJSON()
			{
				$contador_historico = 0;
				$historico_hospitalizacion = self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
													->join('historia_paciente_pediatrico','hospitalizacion.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
														->select('fecha_hospitalizacion as fec_hos','sala','codigo_cama','piso')
															->get();
				
				#dd($historico_hospitalizacion);
				$historico_json = [];
				foreach($historico_hospitalizacion as $d):
					$contador_historico++;
					$nueva_fecha = new DateTime($d->fec_hos);


					$historico_json = [ 
											'num_hos'		=>	$contador_historico,
											'fecha' 		=> 	$nueva_fecha->format('d/m/Y'), 
											'sala'			=>	$d->sala,
											'codigo_cama'	=>	$d->codigo_cama,
											'piso'			=>	$d->piso,
											'pruebas'		=>	'PRUEBAS'
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



			}

	}