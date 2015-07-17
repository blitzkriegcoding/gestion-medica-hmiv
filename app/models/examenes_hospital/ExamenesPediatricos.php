<?php

class ExamenesPediatricos extends \Eloquent 
	{
		protected $fillable = ['id_historia_medica','descripcion', 'fecha_examen','id_medico','nombre_examen'];
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
												'descripcion_examen'	=>	'required|regex:/[a-zA-Z0-9ñÑ\.\s\,-]+/'												
											];

				#return [$input['fecha_examen'], $input['medico_ordenante'], $input['nombre_examen'], $input['descripcion_examen']];
				$mensajes_error = 	[
										'required' 		=>	'Este campo es requerido',
										'date_format'	=>	'Fecha inválida',										
										'exists'		=>	'Debe seleccionar un valor correcto',
										'regex'			=>	'Solo se aceptan letras, numeros, espacios en blanco, comas y puntos',
										'image'			=>	'Solo se aceptan imagenes jpg, png, bmp'

									];	
				$imagenes = [];
				$arreglo_imagenes 		= ['examenes'	=> 	[] ];
				$reglas_imagenes		= ['examenes'	=>	[] ];
				$validacion_imagenes	= [];
				$imagen 				= NULL;
				$extension 				= NULL;
				$directorio				= public_path().'imagenes_examenes/';

				
				foreach($input['examenes'] as $llave => $valor):					
					$arreglo_imagenes['examenes'][$llave]	=	"examenes.".$llave;
					$reglas_imagenes['examenes'][$llave]	=	["required", "image", "max:2097152"];
				endforeach;


				$validacion_imagenes = array_combine($arreglo_imagenes['examenes'] , $reglas_imagenes['examenes']);
				$reglas_datos_examenes = array_merge($reglas_datos_examenes,$validacion_imagenes);

				$validador_datos_examenes = Validator::make($input, $reglas_datos_examenes, $mensajes_error);
				
				if($validador_datos_examenes->fails())
					{
						return 	Response::json([												
												'clase'		=>	'text-danger fade in',												
												'error'		=>	$validador_datos_examenes->messages()		
												]);
					}


				// $examen = self::create([	
				// 						'id_historia_medica'	=>	HistoriaMedicaPediatrica::where('id_paciente','='Session::get('id_paciente_pediatrico')->pluck('id_historia_medica') ),
				// 						'descripcion'			=>	$input['descripcion_examen'], 
				// 						'fecha_examen'			=>	$input['fecha_examen'],
				// 						'id_medico'				=>	$input['medico_ordenante'],
				// 						'nombre_examen'			=>	$input['nombre_examen']
				// 						]);


#  ['id_historia_medica','descripcion', 'fecha_examen','id_medico','nombre_examen']

				foreach($input['examenes'] as $llave => $valor):					
					$imagen 		= 	Input::file("examenes.".$llave);
					$extension		= 	Input::file("examenes.".$llave)->getClientOriginalExtension(); //File::extension($imagen['name']);
					$nombre_archivo	=	sha1(time().time()).".{$extension}";
					#$upload_success = 	Input::upload($imagen, $directorio, $nombre_archivo);
				endforeach;

				return 	Response::json([
						'success'	=>	'Exámenes cargados exitosamente',
						'clase'		=>	'alert alert-success fade in',						

						]);

				
				



			}


	}