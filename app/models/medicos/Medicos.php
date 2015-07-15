<?php

class Medicos extends \Eloquent {
	protected $fillable = [
								'tipo_documento'		,
								'documento'				,
								'primer_nombre'			,
								'segundo_nombre'		,
								'primer_apellido'		,
								'segundo_apellido'		,
								'fecha_nacimiento'		,
								'id_pais'				,
								'lugar_nacimiento'		,														
								'sexo'					,
								'id_estado_civil'		,
								'id_parroquia'			,
								'calle_avenida'			,
								'casa_edificio'			,
								'telefono1'				,
								'telefono2'				,
								'correo'				,
								'id_tipo_medico'		,
									];
	public $table = 'medicos';
	public $timestamps = false;
	public $primaryKey ='id_medico';
	public function IngresoPacientePediatrico()
		{
			return $this->hasMany('IngresoPacientePediatrico','id_medico','id_medico');
		}
	public function EspecialidadesMedicasGaleno()
		{
			return $this->hasMany('EspecialidadesMedicasGaleno','id_medico','id_medico');
		}
	public static function verificarMedico($input)
		{
			$id_medico = "";
			$id_medico = self::where('tipo_documento','=',$input['tipo_documento_medico'])
								->where('documento','=',$input['documento_medico'])
								->pluck('id_medico');
			return is_null($id_medico) ? true : false;

		}
	public static function cargarMedico($input)
		{
			/*
				VERIFICACION DEL MEDICO EN LA BASE DE DATOS PARA EVITAR HACER
				OTRAS OPERACIONES
			*/
			if(self::verificarMedico($input) == false)
				{
					return 	[	'error_mensajes' 	=> 	false,
								'mensaje'			=> 	'Médico existente, verifique los datos',
								'estilo'			=>	'alert alert-danger',
								'bandera'			=>	'glyphicon glyphicon-warning-sign'
							];
				}				
			#dd(self::verificarMedico($input));
			/*CUMPLIMIENTO DEL PATRON "SINGLE RESPONSABILITY PRINCIPLE" */
			$medico_nuevo 			= 	self::validacionDatosMedico($input);
			$contacto_medico_nuevo	= 	self::validacionDatosContacto($input); 
			$especialidades_medicas	= 	self::validacionDatosEspecialidades($input);
			$estudios_realizados 	=	self::validacionEstudios($input);
			#self::verificarMedico($input);

			/*GUARDAR AL NUEVO MEDICO EN LA BASE DE DATOS LUEGO DE HABER VALIDADO SUS DATOS*/
			if($medico_nuevo['error_mensajes'] == true)
				{
					return $medico_nuevo;
				}
			else
				{
				

					$id_medico = self::create(	[
														'tipo_documento'		=>	$input['tipo_documento_medico'],
														'documento'				=>	$input['documento_medico'],
														'primer_nombre'			=>	strtoupper($input['primer_nombre_medico']),
														'segundo_nombre'		=>	strtoupper($input['segundo_nombre_medico']),
														'primer_apellido'		=>	strtoupper($input['primer_apellido_medico']),
														'segundo_apellido'		=>	strtoupper($input['segundo_apellido_medico']),
														'fecha_nacimiento'		=>	$input['fecha_nacimiento_medico_campo'],
														'id_pais'				=>	$input['pais_origen_medico'],
														'lugar_nacimiento'		=>	strtoupper($input['lugar_nacimiento_medico']),
														'sexo'					=>	$input['sexo_medico'],
														'id_estado_civil'		=>	$input['estado_civil_medico'],
														'id_parroquia'			=>	$input['parroquia_medico'],
														'calle_avenida'			=>	strtoupper($input['calle_avenida_medico']),
														'casa_edificio'			=>	strtoupper($input['casa_edificio_medico']),
														'telefono1'				=>	$input['telefono1'],
														'telefono2'				=>	$input['telefono2'],
														'correo'				=>	$input['correo_medico'],
														'id_tipo_medico'		=>	$input['cargo_medico'],
													]);
				}

			/*GUARDAR LA PERSONA CONTACTO DEL MEDICO EN LA BASE DE DATOS*/
			if($contacto_medico_nuevo['error_mensajes'] == true)
				{
					return $contacto_medico_nuevo;
				}

			 $id_contacto = DatosMedicoContacto::create([
		  													'id_medico'				=>	$id_medico['id_medico'],
		  													'tipo_documento'		=>	$input['tipo_documento_contacto'],
		  													'documento'				=>	$input['documento_contacto'],
		  													'direccion_completa'	=>	strtoupper($input['direccion_contacto']),
		  													'telefono1'				=>	$input['telefono1_contacto'],
		  													'telefono2'				=>	$input['telefono2_contacto'],
		  													'id_relacion_medico'	=>	$input['relacion_medico_contacto'],
		  													'primer_nombre'			=>	strtoupper($input['primer_nombre_contacto']),
		  													'segundo_nombre'		=>	strtoupper($input['segundo_nombre_contacto']),
		  													'primer_apellido'		=>	strtoupper($input['primer_apellido_contacto']),
		  													'segundo_apellido'		=>	strtoupper($input['segundo_apellido_contacto']),
			  											]);

			

			/*GUARDAR LAS ESPECIALIDADES MEDICAS QUE POSEE EN LA BASE DE DATOS*/

			if($especialidades_medicas['error_mensajes'] == true)
				{
					return $especialidades_medicas;
				}
			else
				{

					foreach($input['especialidades_medicas'] as $llave => $valor):
						DB::table('medicos_especialidades')->insert(						
																	[
																	'id_especialidad'	=>	$valor,
																	'id_medico'			=>	$id_medico['id_medico'] 
																	]);
					endforeach;
				}



			return 	[
						'error_mensajes'	=>	false,
						'mensaje'			=>	'Médico creado con éxito',
						'estilo'			=>	'alert alert-success',
						'bandera'			=>	'glyphicon glyphicon-ok-sign'
					];

		}

	private static function validacionDatosMedico($input)
		{
			$respuesta = [];
			$validador_datos_medicos = NULL;
			$reglas_datos_medico = [
										'tipo_documento_medico'			=>	'required|in:V,E,P',
										'fecha_nacimiento_medico_campo'	=>	'required|date_format:d/m/Y',
										'documento_medico'				=>	'required|integer',
										'sexo_medico' 					=> 	'required|in:F,M',
										'primer_nombre_medico'			=>	'required|max:30|regex:/([a-zA-ZñÑ\s])/',
										'primer_apellido_medico'		=>	'required|max:30|regex:/([a-zA-ZñÑ\s])/',
										'segundo_nombre_medico'			=>	'max:30|regex:/([a-zA-ZñÑ\s])/',
										'segundo_apellido_medico'		=>	'max:30|regex:/([a-zA-ZñÑ\s])/',
										'pais_origen_medico'			=>	'required|integer|exists:paises,id_pais',
										'lugar_nacimiento_medico'		=>	'required|max:40|regex:/([a-zA-ZñÑ\s\-\.])/',
										'estado_civil_medico'			=>	'required|exists:estado_civil,id_estado_civil',
										'parroquia_medico'				=>	'required|exists:parroquia,id_parroquia',
										'calle_avenida_medico'			=>	'required|max:40|regex:/([a-zA-ZñÑ\s\-\.])/',
										'casa_edificio_medico'			=>	'required|max:40|regex:/([a-zA-ZñÑ\s\-\.])/',
										'telefono1'						=>	'required|max:11|regex:/([0-9]){11}/',
										'telefono2'						=>	'max:11|regex:/([0-9]){11}/',
										'cargo_medico'					=>	'required|exists:tipo_medico,id_tipo_medico',
										'correo_medico'					=>	'required|email',
									];

				$mensajes_error	=	[
										'required'	=> 	'Este campo es obligatorio',
										'exists'	=>	'Seleccione un valor dentro de la lista',
										'in'		=>	'Seleccione un valor dentro de la lista',
										'max'		=>	'Cantidad de caracteres fuera de rango',
										'email'		=>	'Correo electrónico inválido',
									];

			$validador_datos_medicos = Validator::make($input,$reglas_datos_medico,$mensajes_error);

			if($validador_datos_medicos->fails())
				{
					return	[
										'error_mensajes'	=> 	true,
										'mensaje'			=> 	$validador_datos_medicos->messages(),								
							];
				}
			else
				{
					return 	[
										'error_mensajes'	=> 	false,										
							];
				}
		}

	private static function validacionDatosEspecialidades($input)
		{
			/*
				["especialidades_medicas"]=> array(1) { [0]=> string(1) "2" }
			*/
			$validador_especialidades_medicas = NULL;
			$especialidades_medicas = 	[
											'especialidades_medicas'	=>	[]
										];
			$buffer_especialidades = 	[
											'especialidades_medicas'	=>	[]
										];
			$combinado_especialidades = [];
			$mensajes_error	=			[
											'required'	=> 	'Este campo es obligatorio',
											'exists'	=>	'Seleccione un valor dentro de la lista',
											'integer'	=>	'Seleccione un valor dentro de la lista',											
										];


			foreach($input['especialidades_medicas'] as $llave => $valor):

				$especialidades_medicas ['especialidades_medicas'][$llave] = 'especialidades_medicas.'.$llave;
				$buffer_especialidades	['especialidades_medicas'][$llave] = ['exists:especialidades_medicas,id_especialidad','integer'];
			endforeach;
			
			$combinado_especialidades = array_combine($especialidades_medicas['especialidades_medicas'] ,$buffer_especialidades['especialidades_medicas']);
			$validador_especialidades_medicas = Validator::make($input,$combinado_especialidades,$mensajes_error);

			if($validador_especialidades_medicas->fails())
				{
					return	[
										'error_mensajes'	=> 	true,
										'mensaje'			=> 	$validador_especialidades_medicas->messages(),								
							];
				}
			else
				{
					return	[
										'error_mensajes'	=> 	false,										
							];
				}
		}
	private static function validacionEstudios($input)
		{
			$validador_estudios_realizados = NULL;
			$estudios_realizados = 			[
												'institucion'		=>	[],
												'titulo_obtenido'	=>	[],
												'anio_graduacion'	=>	[],
												'pais_graduacion'	=>	[]
											];
			$buffer_estudios_realizados = 	[
												'institucion'		=>	[],
												'titulo_obtenido'	=>	[],
												'anio_graduacion'	=>	[],
												'pais_graduacion'	=>	[]
											];
			$combinados_institucion 	= 	[];
			$combinados_titulo_obtenido = 	[];
			$combinados_anio_graduacion = 	[];
			$combinados_pais_graduacion = 	[];
			$total_combinados_estudios	=	[];
			$mensajes_error	=			[
											'required'	=> 	'Este campo es obligatorio',
											'exists'	=>	'Seleccione un valor dentro de la lista',
											'integer'	=>	'Seleccione un valor dentro de la lista',
											'regex'		=>	'Este campo solo acepta letras',
											'between'	=>	'Seleccione un valor dentro de la lista'
										];
			foreach($input['institucion'] as $llave => $valor):
				$estudios_realizados['institucion'][$llave] = 'institucion.'.$llave;
				$buffer_estudios_realizados['institucion'][$llave] = ['required','regex:/([a-zA-ZñÑ\s\-\.])/'];
			endforeach;

			foreach($input['titulo_obtenido'] as $llave => $valor):
				$estudios_realizados['titulo_obtenido'][$llave] = 'titulo_obtenido.'.$llave;
				$buffer_estudios_realizados['titulo_obtenido'][$llave] = ['required','regex:/([a-zA-ZñÑ\s\-\.])/'];
			endforeach;

			foreach($input['anio_graduacion'] as $llave => $valor):
				$estudios_realizados['anio_graduacion'][$llave] = 'anio_graduacion.'.$llave;
				$buffer_estudios_realizados['anio_graduacion'][$llave] = ['required',"between:1960,".date('Y'),'integer'];
			endforeach;

			foreach($input['pais_graduacion'] as $llave => $valor):
				$estudios_realizados['pais_graduacion'][$llave] = 'pais_graduacion.'.$llave;
				$buffer_estudios_realizados['pais_graduacion'][$llave] = ['required','exists:paises,id_pais','integer'];
			endforeach;
			
			/* 	
				SE COMBINAN UNO POR UNO CADA ARREGLO CON LA CLAVE "CAMPO" => "REGLA DE VALIDACION" PARA POSTERIORMENTE 
				FUSIONARLOS Y ENVIARLOS POR VALOR AL VALIDADOR.
			*/
			$combinados_institucion = array_combine($estudios_realizados['institucion'], $buffer_estudios_realizados['institucion']);
			$combinados_titulo_obtenido = array_combine($estudios_realizados['titulo_obtenido'],$buffer_estudios_realizados['titulo_obtenido']);
			$combinados_anio_graduacion = array_combine($estudios_realizados['anio_graduacion'], $buffer_estudios_realizados['anio_graduacion']);
			$combinados_pais_graduacion = array_combine($estudios_realizados['pais_graduacion'], $buffer_estudios_realizados['pais_graduacion']);
			
			/*
				SE FUSIONAN TODOS LOS ARREGLOS CON LAS REGLAS Y LOS CAMPOS DE VALIDACION PARA FORMAR UNO SOLO Y 
				PASARSELO POR VALOR AL VALIDADOR.
			*/
			$total_combinados_estudios = array_merge($combinados_institucion, $combinados_titulo_obtenido, $combinados_anio_graduacion, $combinados_pais_graduacion);
			$validador_estudios_realizados = Validator::make($input,$total_combinados_estudios,$mensajes_error);
			#dd($validador_estudios_realizados->messages());
			if($validador_estudios_realizados->fails())
				{
					return	[
										'error_mensajes'	=> 	true,
										'mensaje'			=> 	$validador_estudios_realizados->messages(),								
							];
				}
			else
				{
					return 	[
										'error_mensajes'	=> 	false,										
							];
				}
		}	
	private static function validacionDatosContacto($input)
		{
			$respuesta = [];
			$validador_datos_contacto = NULL;
			
			$reglas_datos_contacto = 	[
											'tipo_documento_contacto'		=>	'in:V,E,P',
											'documento_contacto'			=>	'integer',
											'relacion_medico_contacto'		=>	'required|exists:relacion_medico_contacto,id_relacion_medico',
											'primer_nombre_contacto'		=>	'required|max:30|regex:/([a-zA-ZñÑ\s])/',
											'segundo_nombre_contacto'		=>	'max:30|regex:/([a-zA-ZñÑ\s])/',
											'primer_apellido_contacto'		=>	'required|max:30|regex:/([a-zA-ZñÑ\s])/',										
											'segundo_apellido_contacto'		=>	'max:30|regex:/([a-zA-ZñÑ\s])/',																				
											'telefono1_contacto'			=>	'required|max:11|regex:/([0-9]){11}/',
											'telefono2_contacto'			=>	'max:11|regex:/([0-9]){11}/',
											'direccion_contacto'			=>	'required|max:255|regex:/([a-zA-ZñÑ\s\-\.])/',
										];

			$mensajes_error	= 			[
											'required'	=> 	'Este campo es obligatorio',
											'exists'	=>	'Seleccione un valor dentro de la lista',
											'in'		=>	'Seleccione un valor dentro de la lista',
											'max'		=>	'Cantidad de caracteres fuera de rango',
											'email'		=>	'Correo electrónico inválido',
										];

			$validador_datos_contacto = Validator::make($input,$reglas_datos_contacto,$mensajes_error);

			if($validador_datos_contacto->fails())
				{
					return	[
										'error_mensajes'	=> 	true,
										'mensaje'			=> 	$validador_datos_contacto->messages(),								
							];
				}
			else
				{
					return 	[
										'error_mensajes'	=> 	false,
										
							];					  

				}
		}
	public static function obtenerMedicoJSON($medico)
		{
			$medicos = self::where('primer_nombre','like',strtoupper($medico)."%")
											->orWhere('segundo_nombre','like',strtoupper($medico)."%")
												->orWhere('primer_apellido','like',strtoupper($medico)."%")
													->orWhere('segundo_apellido','like',strtoupper($medico)."%")
														->select('id_medico',"primer_nombre", "segundo_nombre", "primer_apellido", "segundo_apellido")
															->get();
			$medicos_json = [];
			foreach($medicos as $d)
				{
					$medicos_json[] = 	[
											'id_medico'	=> 	$d->id_medico,
											'medico'	=>	($d->primer_nombre." ".$d->segundo_nombre." ".$d->primer_apellido." ".$d->segundo_apellido)
										];
				}
			return 	Response::json($medicos_json);

		}
}