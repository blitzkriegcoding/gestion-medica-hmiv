<?php

class IntervencionesPediatricas extends \Eloquent 
	{
		protected $fillable = 	[ 'id_historia_medica',
								  'descripcion',
								  'fecha_intervencion',
								  'id_medico',
								  'status',
								  'id_tipo_intervencion'
								];

		public $timestamps 	= false;
		public $primaryKey 	= 'id_intervencion';
		public $table 		= 'intervenciones_pediatricas';

		public function HistoriaMedicaPediatrica()
			{
				return $this->belongsTo('HistoriaMedicaPediatrica','id_historia_medica','id_historia_medica');
			}

		public static function obtenerIntervencionesPaciente()
			{
				$intervenciones_json = [];
				$contador_intervenciones = 0;
				$status = NULL;
				$intervenciones	= self::where('id_paciente','=', Session::get('id_paciente_pediatrico'))
									->join('historia_paciente_pediatrico','intervenciones_pediatricas.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
										->join('tipo_intervenciones','intervenciones_pediatricas.id_tipo_intervencion','=','tipo_intervenciones.id_tipo_intervencion')
											->select('fecha_intervencion','status','tipo_intervencion','id_intervencion')
												->get();

				foreach($intervenciones as $d):
					$contador_intervenciones ++;
					$nueva_fecha = new DateTime($d->fecha_intervencion);
					switch($d->status)
						{
							case 'E':
								$status = 'EXITOSA';
							break;

							case 'N':
								$status = 'NO EXITOSA';
							break;

						}

					$intervenciones_json[] = 	[
												'num_inter'				=>	$contador_intervenciones,
												'fecha_intervencion'	=>	$nueva_fecha->format('d/m/Y'),
												'status'				=>	$status,												
												'detalles'				=>	"<button class='btn btn-warning' id='".$d->id_intervencion."'>Ver</button>",
												'borrar'				=>	"<button class='btn btn-danger' id='".$d->id_intervencion."'>Borrar</button>"

											];
				endforeach;
				return Response::json($intervenciones_json);
			}
		public static function cargarIntervencion($input)
			{

				$reglas_intervencion = 	[
											'fecha_intervencion_quirurgica'		=>	'required|date_format:d/m/Y',
											'tipo_intervencion'					=>	'required|exists:tipo_intervenciones,id_tipo_intervencion',
											'medico_intervencion'				=>	'required|exists:medicos,id_medico',
											'status_intervencion'				=>	'required|in:E,N',
											'descripcion_intervencion'			=>	'required'
										];

				$errores_intervencion =	[
											'required'		=>	'Este campo es obligatorio',
											'in'			=>	'Debe seleccionar entre valores de la lista',
											'exists'		=>	'Debe seleccionar un elemento válido',
											'date_format'	=>	'Fecha con formato incorrecto'
										];

				$validador_intervencion = Validator::make($input, $reglas_intervencion, $errores_intervencion);

				if($validador_intervencion->fails())
					{
						return 	[
									'mensaje'	=>	$validador_intervencion->messages(),
									'clase'		=>	'text-danger',
									'bandera'	=>	1
								];
					}

				self::create(
								[ 
									'id_historia_medica'	=>	HistoriaMedicaPediatrica::where('id_paciente','=', Session::get('id_paciente_pediatrico'))->pluck('id_historia_medica'),
								  	'descripcion'			=>	strtoupper($input['descripcion_intervencion']),
								  	'fecha_intervencion'	=>	$input['fecha_intervencion_quirurgica'],
								  	'id_medico'				=>	$input['medico_intervencion'],
								  	'status'				=>	$input['status_intervencion'],
								  	'id_tipo_intervencion'	=>	$input['tipo_intervencion'],
								]
							);
				return 	[
							'mensaje'	=>	'Intervención guardada con éxito',
							'clase'		=>	'alert alert-success fade in',
							'bandera'	=>	2
						];
			}
		public static function borrarIntervencionGuardada($input)
			{
				$intervencion_existe = self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
										->join('historia_paciente_pediatrico','intervenciones_pediatricas.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->pluck('id_intervencion');

				if(empty($intervencion_existe))
					{
						return 	[
									'mensaje'	=>	'Intervención inválida',
									'clase'		=>	'alert alert-danger fade in',
									'bandera'	=>	2
								];						
					}

				self::destroy($input['id_intervencion']);

				return 	[
							'mensaje'	=>	'Intervención borrada con éxito',
							'clase'		=>	'alert alert-success fade in',
							'bandera'	=>	2
						];					
			}



	}