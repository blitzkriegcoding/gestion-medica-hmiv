<?php

class PacientePedriatrico extends \Eloquent {
	
	protected $table = 'pacientes';
	protected $fillable = ['tipo_documento', 'documento', 'primer_nombre','segundo_nombre', 'primer_apellido', 'segundo_apellido', 'fecha_nacimiento', 'id_pais','fotografia', 'sexo', 'tipo_paciente','visible','lugar_nacimiento'];
	public $timestamps = false;
	protected $primaryKey = 'id_paciente';
	
	public static function cargar_paciente_pediatrico($input)				
		{
			
			$respuesta = array();
			$respuesta['error_mensajes'] = '';
			$respuesta['mensaje'] = '';

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

			if($validador_bloques->fails())
				{	
					$respuesta['mensaje'] = $validador_bloques;
					$respuesta['error_mensajes'] = true;					
				}
			else
				{
					$paciente = new PacientePedriatrico();
					$representante = new Representante();
				

					$paciente->tipo_documento = $input['tipo_documento_paciente'];
					if(!isset($input['documento_paciente']) || $input['documento_paciente'] == "")
						{
							$paciente->documento = "NO APLICA";
						}
					else
						{
							$paciente->documento = $input['documento_paciente'];
						}

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


					#$representante->tipo_documento = $input[''];

					$existe_rep = 




					$respuesta['mensaje'] = 'Paciente creado con éxito';
					$respuesta['error_mensajes'] = false;

					/*
						  id_representante bigserial NOT NULL,
						  tipo_documento character varying(1) NOT NULL,
						  documento character varying(16) NOT NULL,
						  primer_nombre character varying(40) NOT NULL,
						  segundo_nombre character varying(40) NOT NULL,
						  primer_apellido character varying(40) NOT NULL,
						  segundo_apellido character varying(40) NOT NULL,
						  fecha_nacimiento date NOT NULL,
						  sexo character varying(1) NOT NULL,
						  id_pais integer NOT NULL,
						  telefono1 character varying(14) NOT NULL,
						  telefono2 character varying(14) NOT NULL,
						  correo character varying(40) NOT NULL,
						  fotografia character varying(255) NOT NULL,
						  id_nivel_estudio bigint NOT NULL,
						  id_ocupacion_oficio bigint NOT NULL,
						  id_estado_civil integer NOT NULL,					
					*/

				}
			#$p1 = $validador_bloques->fails();
			
			//dd($p1);
			return $respuesta;
		}

}