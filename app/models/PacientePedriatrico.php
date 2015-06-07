<?php

class PacientePedriatrico extends \Eloquent {
	
	protected $table = 'pacientes_pediatricos';
	protected $fillable = [];
	public $timestamps = false;
	protected $primaryKey = 'id_paciente';



	
	public static function cargar_paciente_pediatrico($input)				
		{
			
			$respuesta = array();
			$respuesta['error_mensajes'] = '';
			$respuesta['mensaje'] = '';
			$respuesta['estilo'] = '';

	 		$reglas_bloques = array
									(
										/*BLOQUE 1*/
										'tipo_documento_paciente'=>'required|in:V,E,P,X',										
										'primer_nombre_paciente'=>'required|max:30|regex:/([a-zA-ZñÑ\s])/',
										'segundo_nombre_paciente'=>'max:30|regex:/([a-zA-ZñÑ\s])/',
										'primer_apellido_paciente'=>'max:40|required|regex:/([a-zA-ZñÑ\s])/',
										'segundo_apellido_paciente'=>'max:40|regex:/([a-zA-ZñÑ\s])/',
										'fecha_nacimiento_paciente_campo'=>'date_format:d/m/Y|required',
										'pais_origen_paciente'=>'required|integer|exists:paises,id_pais',
										'sexo_paciente'=>'required|in:F,M',
										'lugar_nacimiento_paciente'=>'required|max:30|regex:/([a-zA-ZñÑ\s])/',
										/*BLOQUE 2*/
										'tipo_documento_representante'=>'required|in:V,E,P',										
										'sexo_representante' =>'required|in:M,F',
										'primer_nombre_representante'=>'required|max:30|regex:/([a-zA-ZñÑ\s])/',
										'segundo_nombre_representante'=>'max:30|regex:/([a-zA-ZñÑ\s])/',
										'primer_apellido_representante'=>'required|max:30|regex:/([a-zA-ZñÑ\s])/',
										'segundo_apellido_representante'=>'max:30|regex:/([a-zA-ZñÑ\s])/',
										'fecha_nacimiento_representante'=>'date_format:d/m/Y|required',
										'pais_origen_representante'=>'required|integer|exists:paises,id_pais',
										/*'parentesco_representante'=>'required|integer|exists:parentesco,id_parentesco',*/
										'parentesco_representante'=>'required|integer',
										/*'estado_civil_representante'=>'required|integer|exists:estado_civil,id_estado_civil',*/
										'estado_civil_representante'=>'required|integer',
										'direccion_est_mun_par_representante'=>'required|integer|exists:parroquia,id_parroquia',
										'avenida_calle_representante'=>'required|max:40|regex:/([a-zA-ZñÑ\s])/',
										'casa_edificio_representante'=>'required|max:40|regex:/([a-zA-ZñÑ\s])/',
										'telefono_1'=>'required|max:11|regex:/([0-9])/',
										'telefono_2'=>'max:11|regex:/([0-9])/',
										'correo_representante'=>'email',
										/*'ocupacion_oficio_representante'=>'required|exists:ocupacion_oficio,id_ocupacion_oficio',*/
										'ocupacion_oficio_representante'=>'required',
										/*'grado_instruccion_representante'=>'required|exists:grado_instruccion,id_grado_instruccion'*/
										'grado_instruccion_representante'=>'required',
										/*BLOQUE 3*/
										'tipo_ingreso_paciente'=>'required|integer',
										'medico_tratante'=>'required|integer',
										'fecha_ingreso_paciente'=>'date_format:d/m/Y|required',
										'ubicacion_hospital_paciente'=>'required',
										'resumen_ingreso_paciente'=>'required',
										'enfermedad_actual_paciente'=>'required',
										'diagnostico_admision_paciente'=>'required'
									);

			$validador_bloques = Validator::make($input,$reglas_bloques);

			switch($input['tipo_documento_paciente'])
				{			
					case 'V':
						$validador_bloques->sometimes('documento_paciente','required|integer|max:32000000',function($input)
							{	
								#return $input['documento_paciente'] > 32000000;
								return ($input['tipo_documento_paciente'] == 'V') && ($input['documento_paciente'] > 32000000);
							});
					break;
					case 'E':
						$validador_bloques->sometimes('documento_paciente','required|integer|min:80000000',function($input)
							{	
								
								#return $input['documento_paciente'] < 80000000;
								return ($input['tipo_documento_paciente'] == "E") && ($input['documento_paciente'] < 80000000);						
							});
					break;
					case "P":
						$validador_bloques->sometimes('documento_paciente','required|regex:/([0-9a-zA-Z])/',function($input)
							{
								return $input['tipo_documento_paciente'] == "P";
							});
					break;
				}
			

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
			/*CHEQUEO EXISTENCIA DEL PACIENTE PEDIATRICO EN LA BASE DE DATOS*/
			$existe_pac = DB::table('pacientes_pediatricos')
							->where('tipo_documento','=', $input['tipo_documento_paciente'])
							->where('documento','=', $input['documento_paciente'])
							->pluck('id_paciente');
					
			/*CHEQUEO LA EXISTENCIA DEL REPRESENTANTE EN LA BASE DE DATOS*/
			$existe_rep = DB::table('representantes')
								->where('tipo_documento','=', $input['tipo_documento_representante'])
								->where('documento','=', $input['documento_representante'])
								->pluck('id_representante');

			if(!is_null($existe_pac) && !is_null($existe_rep))
				{
					$respuesta['mensaje'] = "Paciente y Representante existentes";
					$respuesta['estilo'] = 'alert-warning';	
					//dd($respuesta);
					return $respuesta;
				}
			
			if($validador_bloques->fails())
				{	
					$respuesta['mensaje'] = $validador_bloques;
					$respuesta['error_mensajes'] = true;					
				}
			else
				{
					$paciente = new PacientePedriatrico();
					$parentesco_rep = new ParentescoRepresentantes();
					$detalles_ingreso = new IngresoPacientePediatrico();					
					
					if(is_null($existe_pac))
						{
							if((!isset($input['documento_paciente']) || $input['documento_paciente'] == "") && $input['tipo_documento_paciente']=="X")
								{
									$paciente->documento = "NO APLICA";
								}
							else
								{
									$paciente->documento = $input['documento_paciente'];
								}
							$paciente->tipo_documento = $input['tipo_documento_paciente'];
							$paciente->primer_nombre = strtoupper($input['primer_nombre_paciente']);
							$paciente->segundo_nombre = strtoupper($input['segundo_nombre_paciente']);
							$paciente->primer_apellido = strtoupper($input['primer_apellido_paciente']);
							$paciente->segundo_apellido = strtoupper($input['segundo_apellido_paciente']);
							$paciente->fecha_nacimiento	= $input['fecha_nacimiento_paciente_campo'];
							$paciente->id_pais = $input['pais_origen_paciente'];
							$paciente->sexo = $input['sexo_paciente'];
							switch($input['sexo_paciente'])
								{
									case 'M':
										$paciente->fotografia = asset('img/icono_chamo.jpg');
									break;

									case 'F':
										$paciente->fotografia = asset('img/icono_chama.jpg');
									break;

								}
							$paciente->tipo_paciente = "1";
							$paciente->visible = "1";
							$paciente->lugar_nacimiento = strtoupper($input['lugar_nacimiento_paciente']);
							$paciente->save(); /*GUARDAR PACIENTE PEDIATRICO*/
							$parentesco_rep->id_paciente = $paciente->id_paciente; /*RETORNAR ID PARA RELACION DE PARENTESCO*/
							$detalles_ingreso->id_paciente = $paciente->id_paciente;
						}
					else{
							$parentesco_rep->id_paciente = $existe_pac;
							$detalles_ingreso->id_paciente = $existe_pac;

						}

					

					if(!is_null($existe_rep)) 
						{
							#$existe_rep->id_representante;
							$parentesco_rep->id_representante = $existe_rep;
							$respuesta['mensaje'] = 'Paciente creado con éxito, Representante existente';
							$respuesta['estilo'] = 'alert-success';	
						
						}
					else
						{
							$representante = new Representantes();
							$representante->tipo_documento = $input['tipo_documento_representante'];
							$representante->documento = $input['documento_representante'];
							$representante->primer_nombre = strtoupper($input['primer_nombre_representante']);
							$representante->segundo_nombre = strtoupper($input['segundo_nombre_representante']);
							$representante->primer_apellido = strtoupper($input['primer_apellido_representante']);
							$representante->segundo_apellido = strtoupper($input['segundo_apellido_representante']);
							$representante->fecha_nacimiento = $input['fecha_nacimiento_representante'];
							$representante->sexo = $input['sexo_representante'];
							$representante->id_pais = $input['pais_origen_representante'];
							$representante->id_parroquia = $input['direccion_est_mun_par_representante'];
							$representante->avenida_calle = $input['avenida_calle_representante'];
							$representante->casa_edificio = $input['casa_edificio_representante'];													
							$representante->telefono1 = $input['telefono_1'];
							$representante->telefono2 = $input['telefono_2'];
							$representante->correo = $input['correo_representante'];
							$representante->id_nivel_estudio = $input['grado_instruccion_representante'];
							$representante->id_ocupacion_oficio = $input['ocupacion_oficio_representante'];
							$representante->id_estado_civil = $input['estado_civil_representante'];
							
							$representante->save();
							$parentesco_rep->id_representante = $representante->id_representante;

							$respuesta['mensaje'] = 'Paciente y Representante creados con éxito,';
							$respuesta['estilo'] = 'alert-success';	

						}

					/*GUARDAR DATOS DE PARENTESCO DEL PACIENTE Y REPRESENTANTE*/
					$parentesco_rep->id_parentesco = $input['parentesco_representante'];
					#$parentesco_rep->id_paciente = $existe_pac;

					
					$parentesco_rep->save();

					/*GUARDAR DETALLES DE ADMISION DEL PACIENTE*/
					
					$detalles_ingreso->fecha_hora_ingreso = $input['fecha_ingreso_paciente'];

					
					
					
					$detalles_ingreso->id_tipo_ingreso = $input['tipo_ingreso_paciente'];
					$detalles_ingreso->resumen_ingreso = $input['resumen_ingreso_paciente'];
					$detalles_ingreso->ubicacion_sala = $input['ubicacion_hospital_paciente'];
					$detalles_ingreso->id_medico = $input['medico_tratante'];
					$detalles_ingreso->enfermedad_actual = $input['enfermedad_actual_paciente'];
					$detalles_ingreso->diagnostico_ingreso = $input['diagnostico_admision_paciente'];
					$detalles_ingreso->save();



					#$respuesta['mensaje'] = 'Paciente creado con éxito';
					$respuesta['error_mensajes'] = false;
				}

			return $respuesta;
		}

}