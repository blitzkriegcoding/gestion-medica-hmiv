<?php

class HistoriaMedicaPediatrica extends \Eloquent {
	protected $fillable = ['codigo_historia_medica','id_paciente','fecha_creacion','observaciones'];
	public $table = 'historia_paciente_pediatrico';
	public $primaryKey = 'id_historia_medica';
	public $timestamps = false;
	
	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico','id_paciente','id_paciente');
		}
	public function AlergiasPacientePediatrico()
		{
			return $this->hasMany('AlergiasPacientePediatrico','id_historia_medica','id_historia_medica');
		}
	public function TratamientosSostenidos()
		{
			return $this->hasMany('TratamientosSostenidos','id_historia_medica','id_historia_medica');
		}

	public static function existenExamenesMedicos($id_paciente_pediatrico)
		{
			$examen_interrogatorio = [];
			$examen_interrogatorio = ExamenFisicoPediatrico::existeExamen($id_paciente_pediatrico);
			return $examen_interrogatorio;
		}
	public static function cargar_historia_medica($input)
		{

			/*VERIFICACION DE LA EXISTENCIA DE HISTORIA MEDICA DEL PACIENTE*/
						
			$codigo_historia_medica = HistoriaMedicaPediatrica::where('id_paciente', '=', Session::get('id_paciente_pediatrico'))->pluck('codigo_historia_medica');

			if(!empty($codigo_historia_medica))
				{
					
					return [	'error_mensajes'			=> 	false,
								'mensaje' 					=> 	'Paciente con historia medica existente',
								'estilo'					=>	' alert alert-danger ',
								'bandera'					=>	' glyphicon glyphicon-alert ',
								'codigo_historia_medica'	=>	"Código ".$codigo_historia_medica,
							];
				}			


			$respuesta = [];
			$codigo_nueva_historia = '';


			$representante_actual =  DB::table('parentesco_representantes')									
									->join('representantes','representantes.id_representante', '=', 'parentesco_representantes.id_representante')									
									->where('parentesco_representantes.id_paciente', '=', Session::get('id_paciente_pediatrico'))
									->where('representante_real','=','1')									
									->pluck('representantes.id_representante');

			$historia_actual = DB::table('historia_paciente_pediatrico')
									->join('parentesco_representantes','parentesco_representantes.id_paciente','=','historia_paciente_pediatrico.id_paciente')									
									->where('parentesco_representantes.id_representante', $representante_actual)
									->where('representante_real','=','1')											
									->max('codigo_historia_medica')
									/*->toSql()*/;


									


			

		if(!empty($representante_actual))
			{
				
				$codigo_nueva_historia = self::crear_codigo_historia_pediatrica($historia_actual, $representante_actual);
				
				#dd($codigo_nueva_historia);
				
				$historia_medica = HistoriaMedicaPediatrica::create(
									[
										'codigo_historia_medica'	=>	$codigo_nueva_historia,
										'id_paciente'				=>	Session::get('id_paciente_pediatrico'),
										'fecha_creacion'			=>	date('Y-m-d'),
										'observaciones'				=>	$input['observaciones_apertura_historia_pediatrica']
									]);
				$deficiencias_cargadas = self::deficiencias_asociadas($input,$historia_medica->id_historia_medica);
				
				if(is_array($deficiencias_cargadas))
					{
						return $deficiencias_cargadas;
					}		

					return [	'error_mensajes'			=> 	false,
								'mensaje' 					=> 	'Historia médica creada exitosamente',
								'estilo'					=>	' alert alert-success ',
								'bandera'					=>	' glyphicon glyphicon-ok ',
								'codigo_historia_medica'	=>	"Código ".$codigo_nueva_historia,
							];					
			}
		else
			{
				$representante_agregado = self::representante_asociado($input);
				if(is_array($representante_agregado))
					{
						return $representante_agregado;
					}
				
				$codigo_nueva_historia = self::crear_codigo_historia_pediatrica($historia_actual,$representante_agregado->id_representante);
				#dd($codigo_nueva_historia,"AUN SIN REPRESENTANTE");
				$historia_medica = HistoriaMedicaPediatrica::create(
									[
										'codigo_historia_medica'	=>	$codigo_nueva_historia,
										'id_paciente'				=>	Session::get('id_paciente_pediatrico'),
										'fecha_creacion'			=>	date('Y-m-d'),
										'observaciones'				=>	$input['observaciones_apertura_historia_pediatrica']
									]);
				$deficiencias_cargadas = self::deficiencias_asociadas($input,$historia_medica->id_historia_medica);
				if(is_array($deficiencias_cargadas))
					{
						return $deficiencias_cargadas;
					}				

				return [	'error_mensajes'			=> 	false,
							'mensaje' 					=> 	'Historia médica creada exitosamente',
							'estilo'					=>	' alert alert-success ',
							'bandera'					=>	' glyphicon glyphicon-ok ',
							'codigo_historia_medica'	=>	"Código ".$codigo_nueva_historia,
						];						



			}

			
		}
	private static function crear_codigo_historia_pediatrica($historia_actual,$id_representante)
		{
			$codigo_nueva_historia = "";
			/*
				AL EXISTIR REPRESENTANTE LEGAL DEL PACIENTE PERO AUN HA SIDO CREADA 
				LA HISTORIA MEDICA CON LA IDENTIFICACION DEL REPRESENTANTE EL CORRE-
				LATIVO EN LA TABLA SERA EL 01, ES DECIR EL PRIMERO
			*/
			
			if(empty($historia_actual))
				{
					$codigo_nueva_historia = 
						Representantes::where('id_representante',$id_representante)->pluck('tipo_documento')	."-".
						Representantes::where('id_representante',$id_representante)->pluck('documento')			."-".
						"01";
				}
			else
				{
				/*
					EN ESTE CASO YA SE HA UTILIZADO LA CEDULA DE  UN REPRESENTANTE AL MENOS 
					PARA HACER LA APERTURA AL MENOS UNA HISTORIA MEDICA PEDIATRICA POR LO 
					TANTO HAY QUE INCREMENTAR EL CORRELATIVO PARA LA PROXIMA HISTORIA MEDICA, 
					EN ESTE CASO SI EL CORRELATIVO DE LA HISTORIA ES MENOR A 10
				*/
				$correlativo_historia_actual = substr($historia_actual, strlen($historia_actual) - 2, 2);
				if($correlativo_historia_actual < 10)
					{
						$correlativo_historia_actual ++;
						$correlativo_historia_actual = '0'.$correlativo_historia_actual;									
						$codigo_nueva_historia = 
						Representantes::where('id_representante',$id_representante)->pluck('tipo_documento')	."-".
						Representantes::where('id_representante',$id_representante)->pluck('documento')			."-".
							$correlativo_historia_actual;

					}
				else
					{
						/*
							EN ESTE CASO YA HAY UN REPRESENTANTE AL MENOS CON UNA HISTORIA ABIERTA
							PARA UN PACIENTE, POR LO TANTO HAY QUE INCREMENTAR EL CORRELATIVO PARA
							LA PROXIMA HISTORIA MEDICA, EN ESTE CASO SI EL CORRELATIVO ES MAYOR O 
							IGUAL A 10.
						*/
						$correlativo_historia_actual ++; //INCREMENTO ORDINARIO
						
						/* CONCANTENAR CON EL CODIGO DE LA NUEVA HISTORIA */
						$codigo_nueva_historia = 
						Representantes::where('id_representante',$id_representante)->pluck('tipo_documento')	."-".
						Representantes::where('id_representante',$id_representante)->pluck('documento')			."-".
							$correlativo_historia_actual;
						
					}
				}
			return $codigo_nueva_historia;			

		}
	private static function representante_asociado($input)
		{

			/***BLOQUE PARA LAS VALIDACIONES DEL REPRESENTANTE***/
			$respuesta = [];
			$mensajes_error_representante = [
									'required'		=>	'Este campo es obligatorio',
									'in'			=>	'Debe seleccionar un valor entre los mostrados',
									'date_format'	=>	'Fecha en formato incorrecto dd/mm/yyyy',
									'email'			=>	'Correcto electrónico incorrecto',
									'unique'		=>	'Correo electrónico ya existe',
									'exists'		=>	'Debe seleccionar un valor entre los mostrados',
									'integer'		=>	'Esta campo solo puede contener numeros',								
								];

			$reglas_representante_legal =	
										[
										'tipo_documento_representante'			=>	'required|in:V,E,P',										
										'documento_representante'				=>	'required|integer',
										'sexo_representante' 					=>	'required|in:M,F',
										'primer_nombre_representante'			=>	'required|max:30|regex:/([a-zA-ZñÑ\s])/',
										'segundo_nombre_representante'			=>	'max:30|regex:/([a-zA-ZñÑ\s])/',
										'primer_apellido_representante'			=>	'required|max:30|regex:/([a-zA-ZñÑ\s])/',
										'segundo_apellido_representante'		=>	'max:30|regex:/([a-zA-ZñÑ\s])/',
										'fecha_nacimiento_representante'		=>	'date_format:d/m/Y|required',
										'pais_origen_representante'				=>	'required|integer|exists:paises,id_pais',
										'parentesco_representante'				=>	'required|integer|exists:parentesco,id_parentesco',										
										'estado_civil_representante'			=>	'required|integer|exists:estado_civil,id_estado_civil',										
										'direccion_est_mun_par_representante'	=>	'required|integer|exists:parroquia,id_parroquia',
										'avenida_calle_representante'			=>	'required|max:40|regex:/([a-zA-ZñÑ\s\-\.])/',
										'casa_edificio_representante'			=>	'required|max:40|regex:/([a-zA-ZñÑ\s\-\.])/',
										'telefono_1'							=>	'required|max:11|regex:/([0-9]){11}/',
										'telefono_2'							=>	'max:11|regex:/([0-9]){11}/',
										'correo_representante'					=>	'email|unique:representantes,correo',
										'ocupacion_oficio_representante'		=>	'required|integer|exists:ocupacion_oficio,id_ocupacion_oficio',
										'grado_instruccion_representante'		=>	'required|integer|exists:nivel_estudio,id_nivel_estudio',
										];
			$validador_representante 	= Validator::make($input,$reglas_representante_legal,$mensajes_error_representante);
			if($validador_representante->fails())
				{
					return [
								'error_mensajes'	=> 	true,
								'mensaje'			=> 	$validador_representante->messages(),
								'representante'		=>	$validador_representante->fails(),								
							];
				}	
			/*FIN BLOQUE PARA LAS VALIDACIONES DEL REPRESENTANTE*/


			$representante_nuevo = [
										'tipo_documento'		=> 	$input['tipo_documento_representante'],
										'documento'				=>	$input['documento_representante'],
										'primer_nombre'			=>	strtoupper($input['primer_nombre_representante']),
										'segundo_nombre'		=>	strtoupper($input['segundo_nombre_representante']),
										'primer_apellido'		=>	strtoupper($input['primer_apellido_representante']),
										'segundo_apellido'		=>	strtoupper($input['segundo_apellido_representante']),
										'fecha_nacimiento'		=>	$input['fecha_nacimiento_representante'],
										'sexo'					=>	$input['sexo_representante'],
										'id_pais'				=>	$input['pais_origen_representante'],
										'id_parroquia'			=>	$input['direccion_est_mun_par_representante'],
										'avenida_calle'			=>	strtoupper($input['avenida_calle_representante']),
										'casa_edificio'			=>	strtoupper($input['casa_edificio_representante']),
										'telefono1'				=>	$input['telefono_1'],
										'telefono2'				=>	$input['telefono_2'],
										'correo'				=>	$input['correo_representante'],
										'fotografia'			=>	'',
										'id_nivel_estudio'		=>	$input['grado_instruccion_representante'],
										'id_ocupacion_oficio'	=>	$input['ocupacion_oficio_representante'],
										'id_estado_civil'		=>	$input['estado_civil_representante'],
									];
			

			$representante_cargado = Representantes::create($representante_nuevo);					
			$parentesco_representante = [
											'id_parentesco' 		=> 	$input['parentesco_representante'],
											'id_paciente' 			=> 	Session::get('id_paciente_pediatrico'),
											'id_representante' 		=> 	$representante_cargado->id_representante,
											'representante_real' 	=> 	1,
										];

			

/*			return [	'error_mensajes'			=> 	false,
						'mensaje' 					=> 	'Historia médica creada exitosamente',
						'estilo'					=>	' alert alert-success ',
						'bandera'					=>	' glyphicon glyphicon-ok ',
						'codigo_historia_medica'	=>	"Código ".$codigo_nueva_historia,
						];*/
			return ParentescoRepresentantes::create($parentesco_representante);

		}

	private static function deficiencias_asociadas($input,$id_historia_medica)
		{
			$respuesta = [];
			$buffer_deficiencias = [
				'alergias_paciente_pediatrico' 		=> 	[],
				'tratamientos_paciente_pediatrico'	=> 	[],
				'patologias_paciente_pediatrico'	=>	[],
				'intolerancias_paciente_pediatrico'	=>	[],
			];

			$deficiencias = [
				'alergias_paciente_pediatrico'		=> 	[],
				'tratamientos_paciente_pediatrico'	=> 	[],
				'patologias_paciente_pediatrico'	=>	[],
				'intolerancias_paciente_pediatrico'	=>	[],
			];

			$combinado_alergias 			= [];
			$combinado_tratamientos			= [];
			$combinado_patologias 			= [];
			$combinado_intolerancias		= [];
			$combinado_total_deficiencias 	= [];

			$mensajes_deficiencias = [
									'exists'	=> 	'Debe seleccionar solo valores mostrados',
									'required'	=>	'Este campo es obligatorio'
									];
			
			if(isset($input['alergias_paciente_pediatrico']))
				{
					
					foreach($input['alergias_paciente_pediatrico'] as $llave => $valor)
						{							
							$deficiencias['alergias_paciente_pediatrico'][$llave] = "alergias_paciente_pediatrico.$llave";
							$buffer_deficiencias['alergias_paciente_pediatrico'][$llave] = ['exists:alergias,id_alergia','integer'];
						}
					$combinado_alergias = array_combine($deficiencias['alergias_paciente_pediatrico'], $buffer_deficiencias['alergias_paciente_pediatrico']);
				}

			if(isset($input['tratamientos_paciente_pediatrico']))
				{
					foreach($input['tratamientos_paciente_pediatrico'] as $llave => $valor)
						{
							$deficiencias['tratamientos_paciente_pediatrico'][$llave] = "tratamientos_paciente_pediatrico.$llave";
							$buffer_deficiencias['tratamientos_paciente_pediatrico'][$llave] = [];							
						}
					$combinado_tratamientos = array_combine($deficiencias['tratamientos_paciente_pediatrico'], $buffer_deficiencias['tratamientos_paciente_pediatrico']);	
				}

			if(isset($input['patologias_paciente_pediatrico']))
				{
					foreach($input['patologias_paciente_pediatrico'] as $llave => $valor)
						{
							$deficiencias['patologias_paciente_pediatrico'][$llave] = "patologias_paciente_pediatrico.$llave";
							$buffer_deficiencias['patologias_paciente_pediatrico'][$llave] = ['exists:patologias,id_patologia','integer'];
						}
					$combinado_patologias = array_combine($deficiencias['patologias_paciente_pediatrico'], $buffer_deficiencias['patologias_paciente_pediatrico']);	
				}

			if(isset($input['intolerancias_paciente_pediatrico']))
				{
					foreach($input['intolerancias_paciente_pediatrico'] as $llave => $valor)
						{
							$deficiencias['intolerancias_paciente_pediatrico'][$llave] = "intolerancias_paciente_pediatrico.$llave";
							$buffer_deficiencias['intolerancias_paciente_pediatrico'][$llave] = ['exists:intolerancias,id_intolerancia','integer'];
						}
					$combinado_intolerancias = array_combine($deficiencias['intolerancias_paciente_pediatrico'], $buffer_deficiencias['intolerancias_paciente_pediatrico']);		
				}
			$combinado_total_deficiencias 	= array_merge($combinado_alergias, $combinado_tratamientos, $combinado_patologias, $combinado_intolerancias);
			$validador_deficiencias 		= Validator::make($input,$combinado_total_deficiencias,$mensajes_deficiencias);

			
			if($validador_deficiencias->fails())
				{

					return [
								'error_mensajes'	=> 	true,
								'mensaje'			=> 	$validador_deficiencias->messages(),
							];
				}			

			/*GUARDAR ALERGIAS, TRATAMIENTOS, PATOLOGIAS Y TRATAMIENTOS EXISTENTES*/							
			if(isset($input['alergias_paciente_pediatrico']))
				{
					foreach($input['alergias_paciente_pediatrico'] as $llave => $valor)
						{								
							AlergiasPacientePediatrico::create([
														'id_historia_medica' 	=>	$id_historia_medica, 
														'id_alergia'			=>	$valor
														]);
						}						
				}				
			if(isset($input['tratamientos_paciente_pediatrico']))
				{
					foreach($input['tratamientos_paciente_pediatrico'] as $llave => $valor)
						{
							TratamientosSostenidos::create([
														'id_historia_medica' 	=>	$id_historia_medica,
														'tratamiento_sostenido'	=>	$valor
														]);								
						}						
				}				
			if(isset($input['patologias_paciente_pediatrico']))
				{
					foreach($input['patologias_paciente_pediatrico'] as $llave => $valor)
						{
							PatologiasPacientePediatrico::create([
														'id_historia_medica' 	=>	$id_historia_medica,
														'id_patologia'			=>	$valor
														]);									
						}						
				}				
			if(isset($input['intolerancias_paciente_pediatrico']))
				{
					foreach($input['intolerancias_paciente_pediatrico'] as $llave => $valor)
						{
							IntoleranciasPacientePediatrico::create([
														'id_historia_medica' 	=>	$id_historia_medica,
														'id_intolerancia'		=>	$valor
														]);
						}						
				}
			return true;
		}

public static function datosPacienteHistoria()		
	{
		$datos_paciente_historia = HistoriaMedicaPediatrica::where('pacientes_pediatricos.id_paciente', '=', Session::get('id_paciente_pediatrico'))
									->join('pacientes_pediatricos','historia_paciente_pediatrico.id_paciente','=','pacientes_pediatricos.id_paciente')
										->select('primer_nombre as p_nombre','segundo_nombre as s_nombre','primer_apellido as p_apellido',
												'segundo_apellido as s_apellido','codigo_historia_medica as cod_his')
											->get();
		return (($datos_paciente_historia));

	}
public static function verificarExistenciaHistoriaMedica($id_paciente_pediatrico)	
	{
		$historia_existe = self::where('id_paciente','=',$id_paciente_pediatrico)->pluck('id_paciente');

		if(!empty($historia_existe))	
			{
				return true;				
			}
		else
			{
				return false;
			}	
	}



}