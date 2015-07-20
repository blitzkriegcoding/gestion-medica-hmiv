<?php

class Tratamientos extends \Eloquent {
	protected $fillable = ['id_historia_medica','descripcion','fecha_tratamiento','id_medico'];
	public $table 		= 'tratamientos';
	public $primaryKey 	= 'id_tratamiento';
	public $timestamps	= false;



	public static function obtenerHistoricoTratamientosJSON()
		{
			$historico_tratamiento	= self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
										->join('historia_paciente_pediatrico','tratamientos.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->select('id_tratamiento','fecha_tratamiento as fec_tra')
												->get();
			$contador_tratamiento 	= 0;
			$tratamientos_json 		= [];
			foreach($historico_tratamiento as $d):
				$contador_tratamiento ++;
				$nueva_fecha = new DateTime($d->fec_tra);
				$tratamientos_json[] = [	
											'num_tra'	=>	$contador_tratamiento,
											'fec_tra'	=>	$nueva_fecha->format('d/m/Y'),
											'detalles'	=>	"<button class='btn btn-warning' id='".$d->id_tratamiento."'>Ver</button>",
											'borrar'	=>	"<button class='btn btn-danger' id='".$d->id_tratamiento."'>Borrar</button>"
										];
			endforeach;
			return $tratamientos_json;
		}


	public static function cargarTratamientoNuevo($input)
		{
			$reglas_tratamiento = 	[
										'fecha_tratamiento'				=>	'required|date_format:d/m/Y',
										'medico_ordenante_tratamiento'	=>	'required|exists:medicos,id_medico',
										'descripcion_tratamiento'		=>	'required'
									];

			$mensajes_error	=	[
									'required'	=>	'Campo requerido',
									'exists'	=>	'Debe seleccionar un médico'
								];

			$validador_tratamiento = Validator::make($input, $reglas_tratamiento, $mensajes_error);
			if($validador_tratamiento->fails())
				{
					return 	[
								'mensaje'	=>	$validador_tratamiento->messages(),
								'clase'		=>	'text-danger',
								'bandera'	=>	1
							];
				}

			self::create([
							'id_historia_medica'	=>	HistoriaMedicaPediatrica::where('id_paciente','=',Session::get('id_paciente_pediatrico'))->pluck('id_historia_medica'),
							'descripcion'			=>	$input['descripcion_tratamiento'],
							'fecha_tratamiento'		=>	$input['fecha_tratamiento'],
							'id_medico'				=>	$input['medico_ordenante_tratamiento']
						]);

			return 	Response::json([
									'mensaje'	=>	'Tratamiento asignado con éxito',
									'clase'		=>	'alert alert-success fade in alert-dismissible',
									'bandera'	=>	2
									]);
		}
	public static function borrarTratamientoGuardado($input)
		{
			$tratamiento_pertenece = self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
											->where('id_tratamiento','=',$input['id_tratamiento'])
												->join('historia_paciente_pediatrico','tratamientos.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
													->pluck('id_tratamiento');
			//return $tratamiento_pertenece;

			if(empty($tratamiento_pertenece))
				{
					return 	[
								'mensaje'	=>	'Tratamiento no corresponde al paciente',
								'clase'		=>	'alert alert-danger',
								'bandera'	=>	2
							]; 
				}

			self::destroy($input['id_tratamiento']);
			return 	[
						'mensaje'	=>	'Tratamiento borrado con éxito',
						'clase'		=>	'alert alert-success fade in',
						'bandera'	=>	2
					];			

		}

}