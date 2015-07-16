<?php

class ExamenesPediatricos extends \Eloquent 
	{
		protected $fillable = [];
		public $table = 'examenes_pediatricos';
		public $timestamps = false;

		public function HistoriaMedicaPediatrica()
			{
				return $this->belongsTo('HistoriaMedicaPediatrica','id_historia_medica','id_historia_medica');
			}

		public static function obtenerHistoricoExamenes()
			{
				$historico_examenes = self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
										->join('historia_paciente_pediatrico','examenes_pediatricos.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->select('id_examen','fecha_examen', 'nombre_examen')
												->get();
				$examenes_json = [];
				$contador_examenes = 0;

				foreach($historico_examenes as $d):
					$contador_examenes++;
					$nueva_fecha = new Date($d->fecha_examen);
					$examenes_json[] = 	[
											'num_exa'		=>	$contador_examenes,
											'fecha_examen'	=>	$nueva_fecha->date_format('d/m/Y'),
											'nombre_examen'	=>	$d->nombre_examen,
											'detalles'		=>	'pruebas',
											'borrar'		=>	'pruebas'
										];
				endforeach;
				return Response::json($examenes_json);
			}

		public static function guardarExamenesMedicos($input)
			{

				$reglas_datos_examenes = 	[
												'fecha_examen'			=>	'required|date_format:d/m/Y',
												'medico_ordenante'		=>	'required|exists:medicos,id_medico',
												'nombre_examen'			=>	'required|regex:/[a-zA-Z0-9ñÑ\.\s\,-]+/',
												'descripcion_examen'	=>	'required|regex:/[a-zA-Z0-9ñÑ\.\s\,-]+/',
												/*'examenes'				=>	'required|image'*/
											];

				#return [$input['fecha_examen'], $input['medico_ordenante'], $input['nombre_examen'], $input['descripcion_examen']];
				$mensajes_error = 	[
										'required' 		=>	'Este campo es requerido',
										'date_format'	=>	'Fecha inválida',										
										'exists'		=>	'Debe seleccionar un valor correcto',
										'regex'			=>	'Solo se aceptan letras, numeros, espacios en blanco, comas y puntos',
										'image'			=>	'Solo se aceptan imagenes jpg, png, bmp'

									];				

				$validador_datos_examenes = Validator::make($input, $reglas_datos_examenes, $mensajes_error);
				
				if($validador_datos_examenes->fails())
					{
						return 	[
									'mensaje'	=>	$validador_datos_examenes->messages(),
									'clase'		=>	'alert alert-danger fade in',
									'bandera'	=>	1
								];
					}
				



			}


	}