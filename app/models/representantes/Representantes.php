<?php

class Representantes extends \Eloquent 
	{
		protected $table = 'representantes';
		protected $fillable = [
								'tipo_documento'		,
								'documento'				,
								'primer_nombre'			,
								'segundo_nombre'		,
								'primer_apellido'		,
								'segundo_apellido'		,
								'fecha_nacimiento'		,
								'sexo'					,
								'id_pais'				,
								'id_parroquia'			,
								'avenida_calle'			,
								'casa_edificio'			,
								'telefono1'				,
								'telefono2'				,
								'correo'				,
								'fotografia'			,
								'id_nivel_estudio'		,
								'id_ocupacion_oficio'	,
								'id_estado_civil'		,
								];
		public $timestamps = false;
		protected $primaryKey = 'id_representante';

		private static function validarDatosRepresentante($input)	
			{
				$reglas_validacion_representante = 	[
														'tipo_documento_representante'			=>	'required|in:V,E,P',										
														'sexo_representante' 					=>	'required|in:M,F',
														'representante_legal'					=>	'required|in:1,2',
														'primer_nombre_representante'			=>	'required|max:30|regex:/([a-zA-ZñÑ\s])/',
														'segundo_nombre_representante'			=>	'max:30|regex:/([a-zA-ZñÑ\s])/',
														'primer_apellido_representante'			=>	'required|max:30|regex:/([a-zA-ZñÑ\s])/',
														'segundo_apellido_representante'		=>	'max:30|regex:/([a-zA-ZñÑ\s])/',
														'fecha_nacimiento_representante'		=>	'date_format:d/m/Y|required',
														'pais_origen_representante'				=>	'required|integer|exists:paises,id_pais',
														'parentesco_representante'				=>	'required|integer|exists:parentesco,id_parentesco',										
														'estado_civil_representante'			=>	'required|integer|exists:estado_civil,id_estado_civil',										
														'direccion_est_mun_par_representante'	=>	'required|integer|exists:parroquia,id_parroquia',
														'avenida_calle_representante'			=>	'required|max:40|regex:/([a-zA-ZñÑ\s])/',
														'casa_edificio_representante'			=>	'required|max:40|regex:/([a-zA-ZñÑ\s])/',
														'telefono_1'							=>	'required|max:11|regex:/([0-9])/',
														'telefono_2'							=>	'max:11|regex:/([0-9])/',
														'correo_representante'					=>	'email',
														'ocupacion_oficio_representante'		=>	'required|exists:ocupacion_oficio,id_ocupacion_oficio',										
														'grado_instruccion_representante'		=>	'required|exists:nivel_estudio,id_nivel_estudio',															
													];
				$mensajes_error_representante = [
													'required'		=>	'Campo obligatorio',
													'in'			=>	'Debe seleccionar entre los valores mostrados',
													'date_format'	=>	'Fecha en formato inválido',
													'regex'			=>	'No concuerda el formato del campo',
													'integer'		=>	'El campo debe ser un número entero',
													'exists'		=>	'Debe seleccionar entre los valores de la lista',
												];
				$validador_datos_representante = Validator::make($input, $reglas_validacion_representante, $mensajes_error_representante);
				switch($input['tipo_documento_representante'])
					{			
						case 'V':
							$validador_bloques->sometimes('documento_paciente','required|integer|max:32000000',function($input)
								{	
									#return $input['documento_paciente'] > 32000000;
									return ($input['tipo_documento_representante'] == 'V') && ($input['documento_representante'] > 32000000);
								});
						break;
						case 'E':
							$validador_bloques->sometimes('documento_representante','required|integer|min:80000000',function($input)
								{	
									
									#return $input['documento_paciente'] < 80000000;
									return ($input['tipo_documento_representante'] == "E") && ($input['documento_representante'] < 80000000);						
								});
						break;
						case "P":
							$validador_bloques->sometimes('documento_paciente','required|regex:/([0-9a-zA-Z])/',function($input)
								{
									return $input['tipo_documento_representante'] == "P";
								});
						break;
					}

				if($validador_datos_representante->fails())
					{
						return 	[
									'bandera'			=>	' glyphicon glyphicon-exclamation-sign ',
									'mensaje'			=>	$validador_datos_representante->messages(),
									'estilo'			=>	' alert alert-danger ',
									'error_mensajes'	=>	true,
								];
					}
				return [
							'bandera'			=>	' glyphicon glyphicon-exclamation-sign ',
							'mensaje'			=>	'',
							'estilo'			=>	' alert alert-warning ',
							'error_mensajes'	=>	false,
						];
				


				
			}
		public static function guardarDatosRepresentante($input)
			{
				$respuesta = self::validarDatosRepresentante($input);
				if($respuesta['error_mensajes'] == true)
					{
						return $respuesta;
					}

				$representante_existe = self::where('tipo_documento'	,'=',	$input['tipo_documento_representante'])
												->where('documento'		,'=',	$input['documento_representante'])
												->pluck('id_representante');
				if(!empty($representante_existe))
					{
						return [
									'bandera'			=>	' glyphicon glyphicon-exclamation-sign ',
									'mensaje'			=>	'Representante ya existe en la base de datos',
									'estilo'			=>	' alert alert-warning ',
									'error_mensajes'	=>	false,
								];
					}

				$nuevo_representante =	[							
							'tipo_documento' 		=> $input['tipo_documento_representante'],
							'documento' 			=> $input['documento_representante'],
							'primer_nombre' 		=> strtoupper($input['primer_nombre_representante']),
							'segundo_nombre' 		=> strtoupper($input['segundo_nombre_representante']),
							'primer_apellido' 		=> strtoupper($input['primer_apellido_representante']),
							'segundo_apellido' 		=> strtoupper($input['segundo_apellido_representante']),
							'fecha_nacimiento' 		=> $input['fecha_nacimiento_representante'],
							'sexo' 					=> $input['sexo_representante'],
							'id_pais' 				=> $input['pais_origen_representante'],
							'id_parroquia' 			=> $input['direccion_est_mun_par_representante'],
							'avenida_calle' 		=> strtoupper($input['avenida_calle_representante']),
							'casa_edificio' 		=> strtoupper($input['casa_edificio_representante']),													
							'telefono1' 			=> $input['telefono_1'],
							'telefono2' 			=> $input['telefono_2'],
							'correo' 				=> $input['correo_representante'],
							'id_nivel_estudio' 		=> $input['grado_instruccion_representante'],
							'id_ocupacion_oficio' 	=> $input['ocupacion_oficio_representante'],
							'id_estado_civil' 		=> $input['estado_civil_representante'],		
						];

				self::create($nuevo_representante);

						return [
									'bandera'			=>	' glyphicon glyphicon-ok-sign ',
									'mensaje'			=>	'Representante creado con exito',
									'estilo'			=>	' alert alert-success ',
									'error_mensajes'	=>	false,
								];


			}

	}