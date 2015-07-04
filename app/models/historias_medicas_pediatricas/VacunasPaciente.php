<?php

class VacunasPaciente extends \Eloquent {
	protected $fillable = ['id_historia_medica','id_tipo_vacuna','fecha_vacunacion','refuerzo'];

	public $table = 'vacunas_paciente';
	public $timestamps = false;
	public $primaryKey = 'id_vacuna_paciente';

	public function HistoriaMedicaPediatrica()
		{
			return $this->belongsTo('HistoriaMedicaPediatrica','id_historia_medica','id_historia_medica');
		}

	public static function obtenerVacuna($vacuna)
		{
			$vacunas_json = [];
			$resultado = DB::table('tipo_vacunas')->select("id_tipo_vacuna","tipo_vacuna","edad as edad_aplicacion")

								->where('activo','=','S')
								->where('tipo_vacuna','LIKE',strtoupper($vacuna).'%')
								->orWhere('enfermedad','LIKE',strtoupper($vacuna).'%')
								->get();

			
			foreach($resultado as $d):
				$vacunas_json[] = ['id_tipo_vacuna'=>$d->id_tipo_vacuna, 'vacuna'=> ($d->tipo_vacuna." PARA ".$d->edad_aplicacion)];	
			endforeach;

			return Response::json($vacunas_json);
		}

public static function obtenerHistoricoVacunas()
		{
			$respuesta = self::select('fecha_vacunacion','tipo_vacuna','edad','refuerzo')
											->join('tipo_vacunas','vacunas_paciente.id_tipo_vacuna','=','tipo_vacunas.id_tipo_vacuna')
											->join('historia_paciente_pediatrico','vacunas_paciente.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
											->get();
											#dd($respuesta);
			#return Response::json($respuesta);
			return ($respuesta);											
		}
		
	public static function obtenerHistoricoVacunasJSON()
		{
			$vacunas_json = [];
			$respuesta = self::select('vacunas_paciente.id_vacuna_paciente', 'fecha_vacunacion','tipo_vacuna','edad','refuerzo')
											->join('tipo_vacunas','vacunas_paciente.id_tipo_vacuna','=','tipo_vacunas.id_tipo_vacuna')
											->join('historia_paciente_pediatrico','vacunas_paciente.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
											->get();
											#dd($respuesta);

			
			
			foreach($respuesta as $d):

				$nueva_fecha = new DateTime($d->fecha_vacunacion);
				$boton_quitar = "<button class='btn btn-danger' id='".$d->id_vacuna_paciente."'>Borrar</button>";											
				$vacunas_json[] = [ 'fecha_vacunacion'	=>	$nueva_fecha->format('d/m/Y'),
									'tipo_vacuna'		=>	$d->tipo_vacuna,
									'edad'				=>	$d->edad,
									'refuerzo'			=>	$d->refuerzo,
									'boton_quitar'		=>	$boton_quitar
								  ];
			endforeach;
											
			return Response::json($vacunas_json);
			#return ($respuesta);											
		}
	public static function cargarVacuna($input)
		{
			$reglas_vacunas 	= 	[
									'fecha_vacuna' 		=> 	'required|date_format:d/m/Y',
									'vacuna_aplicada'	=>	'required|exists:tipo_vacunas,id_tipo_vacuna',
									'refuerzo_vacuna'	=>	'required|in:S,N'
									];

			$errores_vacunas	=	[
										'in'			=>	'El valor debe estar dentro de los mostrados',
										'date_format'	=>	'La fecha esta en un formato incorrecto',
										'exists'		=>	'La vacuna no valida',
										'required'		=>	'El valor es requerido'
									];

			$validador_vacunas	=	Validator::make($input,$reglas_vacunas,$errores_vacunas);

			if($validador_vacunas->fails())
				{
					return 	[
								'mensaje'	=>	$validador_vacunas->messages(),
								'clase'		=>	'text-danger',
								'bandera'	=>	1
							];

				}

			$paciente_vacunado = self::select('id_tipo_vacuna')
										->join('historia_paciente_pediatrico','vacunas_paciente.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
										->where('id_paciente','=',Session::get('id_paciente_pediatrico'))
										->where('vacunas_paciente.id_tipo_vacuna','=',$input['vacuna_aplicada'])
										->count('id_tipo_vacuna');

			$historia_paciente = HistoriaMedicaPediatrica::select('historia_paciente_pediatrico.id_historia_medica')										
										->where('id_paciente','=',Session::get('id_paciente_pediatrico'))										
										->pluck('id_historia_medica')/*->toSql()*/;
			#return $paciente_vacunado;
			if($paciente_vacunado > 0)
				{
					return 	[
								'mensaje'	=>	'El paciente ya posee esta vacuna',
								'clase'		=>	'alert alert-danger fade in',
								'bandera'	=>	2
							];
				}

			self::create([
							'id_historia_medica'	=>	$historia_paciente,
							'id_tipo_vacuna'		=>	$input['vacuna_aplicada'],
							'fecha_vacunacion'		=>	$input['fecha_vacuna'],
							'refuerzo'				=>	$input['refuerzo_vacuna']
						]);	
			return 	Response::json([
									'mensaje'	=>	'Vacuna asignada con éxito',
									'clase'		=>	'alert alert-success fade in alert-dismissible',
									'bandera'	=>	3
									]);
		}
	public static function borrarVacunaAplicada($input)
		{
			$reglas_vacuna 	=	[
										'id_vacuna'	=>	'exists:tipo_vacunas,id_tipo_vacuna'
									];
			$errores_vacuna	=	[
										'exists'	=>	'Debe seleccionar uno de los valores mostrados',
									];
			$validador_vacuna = Validator::make($input,$reglas_vacuna,$errores_vacuna);

			if($validador_vacuna->fails())
				{
					return 	[
								'mensaje'	=>	$validador_vacuna->messages(),
								'clase'		=>	'alert alert-danger fade in',
								'bandera'	=>	1
							];
				}
			//return $input['id_vacuna'];
			self::destroy($input['id_vacuna']);
			return 	[
						'mensaje'	=>	'Vacuna borrada con éxito',
						'clase'		=>	'alert alert-success fade in',
						'bandera'	=>	2
					];			

		}		


}