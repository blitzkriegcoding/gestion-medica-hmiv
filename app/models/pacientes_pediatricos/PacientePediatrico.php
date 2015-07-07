<?php

class PacientePediatrico extends \Eloquent {
	
	protected $table = 'pacientes_pediatricos';
	protected $fillable = [
							'tipo_documento',
							'documento',
							'primer_nombre',
							'segundo_nombre',
							'primer_apellido',
							'segundo_apellido',
							'fecha_nacimiento',
							'fecha_muerte',
							'id_pais',
							'fotografia',
							'sexo',
							'visible',
							'lugar_nacimiento'
						];

	public $timestamps = false;
	protected $primaryKey = 'id_paciente';

	public function ParentescoRepresentante()
		{
			return $this->hasMany('ParentescoRepresentantes','id_paciente','id_paciente');	
		}

	public function PacienteInterrogatorio()
		{
			return $this->hasMany('InterrogatorioPediatrico','id_paciente','id_paciente');
		}
	public function PacienteExamenFuncional()
		{
			return $this->hasMany('ExamenFuncionalPediatrico','id_paciente','id_paciente');
		}
	public function PacienteExamenFisico()
		{
			return $this->hasMany('ExamenFisicoPediatrico','id_paciente','id_paciente');
		}

	public function HistoriaMedicaPediatrica()
		{
			return $this->hasOne('HistoriaMedicaPediatrica','id_paciente','id_paciente');
		}

	public static function CalculoEdad($id_paciente_pediatrico)
		{
			return $paciente_edad = DB::table('pacientes_pediatricos') 
                     ->select(DB::raw
                     	( " 
						    REPLACE(
						      REPLACE(
						        REPLACE(
						          REPLACE(
						            REPLACE(
						              REPLACE(
						                AGE(current_date, fecha_nacimiento)::TEXT,
						              'years','años'),
						            'year','año'),
						          'mons','meses'),
						        'mon','mes'),
						       'days','días'),
						    'day','día') as edad"))
                     ->where('id_paciente', '=', $id_paciente_pediatrico)                     
                     ->get();
		}
	public static function crear_examenes_paciente($input)
		{
			$errores = "";
			$respuesta = [];
			$reglas_examenes = [];
			$reglas_signos_vitales = [];
			$reglas_condiciones = [];
			$mensaje_error_condiciones = [];
			$respuesta['error_mensajes'] = '';
			$respuesta['mensaje'] = '';
			$respuesta['estilo'] = '';
			
			$mensajes_error = [
								'required'		=>	'¿Que observó anormal?',
								'integer'		=>	'El campo ":attribute" solo acepta numeros',
								'numeric'		=>	'El campo ":attribute" solo acepta numeros y decimales',								
								];


			$mensaje_error_condiciones = [
										'in'		=>	'Debe seleccionar una condición',										
										'required'	=>	'¿Normal o anormal?',
										'integer'	=>	''
										
									];

			$mensajes_error_signos_vitales = [
												'required'		=>	'Este campo es obligatorio',
												'integer'		=>	'Este campo solo acepta numeros',
												'numeric'		=>	'Este campo solo acepta numeros y decimales',								
												];

			
			$reglas_signos_vitales = [
									'frecuencia_respiratoria'	=>	'required|integer',
									'frecuencia_cardiaca'		=>	'required|integer',
									'peso'						=>	'required|integer',
									'talla'						=>	'required|integer',
									'tension_arterial'			=> 	'required|integer',
									'temperatura'				=> 	'required|integer',
								];

			$buffer_condiciones = [
									'interrogatorio'			=> 	array_fill(1, count($input['interrogatorio']), ['required','in:1,2,3','integer']),
									'funcional'					=>	array_fill(1, count($input['funcional']), ['required','in:1,2,3','integer']),
									'fisico' 					=>	array_fill(1, count($input['fisico']), ['required','in:1,2,3','integer']),
								];

			
			$buffer_examenes = [
									'detalle_interrogatorio'	=> 	array(),
									'detalle_funcional'			=>	array(),
									'detalle_fisico'			=>	array(),
							];
			$reglas_examenes = [
									'detalle_interrogatorio'	=> 	array(),
									'detalle_funcional'			=>	array(),
									'detalle_fisico'			=>	array(),									

							];				

			$reglas_condiciones = [
									'interrogatorio'		=> 	array_fill(1, count($input['interrogatorio']),''),									
									'funcional'				=>	array_fill(1, count($input['funcional']),''),
									'fisico' 				=>	array_fill(1, count($input['fisico']),''),									
								];


			

			/*Finalmente para poder colocar las reglas de validacion es necesario combinar el arreglo 
			que tiene los nombres de los campos en notacion "arreglo.posicion", con el arreglo
			que tiene las reglas de validacion "buffer.tipo"
			*/
			$condiciones_combinado_interrogatorio = [];
			$condiciones_combinado_funcional = [];
			$condiciones_combinado_fisico = [];

			//Arreglos para los combinados de validacion de examenes

			$combinado_detalles_interrogatorio = [];
			$combinado_detalles_funcional = [];
			$combinado_detalles_fisico = [];


			
			foreach($input['interrogatorio'] as $llave=>$valor)
				{
					if($input['interrogatorio'][$llave] == 2 && $input['detalle_interrogatorio'][$llave] =="")
						{							
							$buffer_examenes['detalle_interrogatorio'][$llave] = "detalle_interrogatorio.$llave";
							$reglas_examenes['detalle_interrogatorio'][$llave] = 'required';
						}
					$reglas_condiciones['interrogatorio'][$llave] = "interrogatorio.$llave";
				}
			

			
			foreach ($input['funcional'] as $llave => $valor) 
				{
					if($input['funcional'][$llave] == 2 && $input['detalle_funcional'][$llave] =="")
						{	
							$buffer_examenes['detalle_funcional'][$llave] = "detalle_funcional.$llave";
							$reglas_examenes['detalle_funcional'][$llave] = 'required';

						}
					$reglas_condiciones['funcional'][$llave] = "funcional.$llave";
				}			
			foreach ($input['fisico'] as $llave => $valor) 
				{
					if($input['fisico'][$llave] == 2 && $input['detalle_fisico'][$llave] =="")
						{							
							
							$buffer_examenes['detalle_fisico'][$llave] = "detalle_fisico.$llave";
							$reglas_examenes['detalle_fisico'][$llave] = 'required';							
						}
					$reglas_condiciones['fisico'][$llave] = "fisico.$llave";
				}
			
			/*COMBINADOS DE ARREGLOS DE CAMPOS/REGLAS DE VALIDACION EN CONDICIONES: NORMAL Y ANORMAL */
			$condiciones_combinado_interrogatorio = array_combine($reglas_condiciones['interrogatorio'], $buffer_condiciones['interrogatorio']);
			$condiciones_combinado_funcional = array_combine($reglas_condiciones['funcional'], $buffer_condiciones['funcional']);
			$condiciones_combinado_fisico = array_combine($reglas_condiciones['fisico'], $buffer_condiciones['fisico']);
			
			/*COMBINADOS DE ARREGLOS DE CAMPOS/REGLAS DE VALIDACION EN SELECCION ANORMAL Y RESUMEN*/
			$combinado_detalles_interrogatorio = array_combine($buffer_examenes['detalle_interrogatorio'], $reglas_examenes['detalle_interrogatorio']);
			$combinado_detalles_funcional = array_combine($buffer_examenes['detalle_funcional'], $reglas_examenes['detalle_funcional']);
			$combinado_detalles_fisico = array_combine($buffer_examenes['detalle_fisico'], $reglas_examenes['detalle_fisico']);


			$condiciones_totales = array_merge($condiciones_combinado_interrogatorio,$condiciones_combinado_funcional,$condiciones_combinado_fisico);

			$examenes_totales = array_merge($combinado_detalles_interrogatorio,$combinado_detalles_funcional,$combinado_detalles_fisico);
		

			$validador_examenes = Validator::make($input,$examenes_totales,$mensajes_error);
			$validador_signos_vitales = Validator::make($input,$reglas_signos_vitales, $mensajes_error_signos_vitales);			
			$validador_condiciones = Validator::make($input,$condiciones_totales,$mensaje_error_condiciones);

			

			if($validador_condiciones->fails() || $validador_signos_vitales->fails()  || $validador_examenes->fails())
				{
					
					#dd($validador_condiciones->messages());
					$errores = $validador_examenes->messages()->merge($validador_signos_vitales->messages()->merge($validador_condiciones->messages()));
					$respuesta['mensaje'] = $errores;					
					$respuesta['error_mensajes'] = true;

				}
			else
				{
					$paciente = PacientePediatrico::find(Session::get('id_paciente_pediatrico'));				

					$examen_interrogatorio;
					$examen_fisico;
					$examen_funcional;

					foreach($input['interrogatorio'] as $llave=>$valor)
						{
							$examen_interrogatorio = new ExamenInterrogatorioPediatrico([
														'id_paciente' => $paciente->id_paciente,
														'id_condicion_interrogatorio' => $llave,
														'fecha_interrogatorio' => date('Y-m-d'),
														'detalles' => $input['detalle_interrogatorio'][$llave],
														'status' => $valor]);
							$paciente->PacienteInterrogatorio()->save($examen_interrogatorio);	


						}
					foreach ($input['funcional'] as $llave => $valor) 
						{
							$examen_fisico = new ExamenFuncionalPediatrico([
														'id_paciente' => $paciente->id_paciente,
														'id_condicion_examen_funcional' => $llave, 
														'fecha_examen_funcional' => date('Y-m-d'),
														'detalles' => $input['detalle_funcional'][$llave],
														'status' => $valor]);
							$paciente->PacienteExamenFuncional()->save($examen_fisico);

						}						
					foreach ($input['fisico'] as $llave => $valor) 
						{
									$examen_fisico = new ExamenFisicoPediatrico(array(
														'id_paciente' => $paciente->id_paciente,
														'id_condicion_examen_fisico' => $llave, 
														'fecha_examen_pediatrico' => date('Y-m-d'),
														'detalles' => $input['detalle_fisico'][$llave],
														'status' => $valor));
							$paciente->PacienteExamenFisico()->save($examen_fisico);									
						}
					$respuesta['mensaje'] = "Examenes generados exitosamente";
					$respuesta['error_mensajes'] = false;
				}
			return $respuesta;
		}


	private static function validarDatosPaciente($input)
		{
	 		$reglas_paciente_pediatrico = 
											[
												'tipo_documento_paciente'				=> 	'required|in:V,E,P,X',										
												'primer_nombre_paciente'				=> 	'required|max:30|regex:/([a-zA-ZñÑ\s])/',
												'segundo_nombre_paciente'				=> 	'max:30|regex:/([a-zA-ZñÑ\s])/',
												'primer_apellido_paciente'				=> 	'max:40|required|regex:/([a-zA-ZñÑ\s])/',
												'segundo_apellido_paciente'				=> 	'max:40|regex:/([a-zA-ZñÑ\s])/',
												'fecha_nacimiento_paciente_campo'		=> 	'date_format:d/m/Y|required',
												'pais_origen_paciente'					=> 	'required|integer|exists:paises,id_pais',
												'sexo_paciente'							=> 	'required|in:F,M',
												'lugar_nacimiento_paciente'				=> 	'required|max:30|regex:/([a-zA-ZñÑ\s])/',
											];
			$mensajes_error_paciente = 	[
											'required'		=>	'Campo obligatorio',
											'in'			=>	'Debe seleccionar entre los valores mostrados',
											'date_format'	=>	'Fecha en formato inválido',
											'regex'			=>	'No concuerda el formato del campo',
											'integer'		=>	'El campo debe ser un número entero',
											'exists'		=>	'Debe seleccionar entre los valores de la lista',
										];
			$validador_datos_paciente = Validator::make($input,$reglas_paciente_pediatrico,$mensajes_error_paciente);

			switch($input['tipo_documento_paciente'])
				{			
					case 'V':
						$validador_datos_paciente->sometimes('documento_paciente','required|integer|max:32000000',function($input)
							{
								return ($input['tipo_documento_paciente'] == 'V') && ($input['documento_paciente'] > 32000000);
							});
					break;
					case 'E':
						$validador_datos_paciente->sometimes('documento_paciente','required|integer|min:80000000',function($input)
							{
								return ($input['tipo_documento_paciente'] == "E") && ($input['documento_paciente'] < 80000000);						
							});
					break;
					case "P":
						$validador_datos_paciente->sometimes('documento_paciente','required|regex:/([0-9a-zA-Z])/',function($input)
							{
								return $input['tipo_documento_paciente'] == "P";
							});
					break;
				}

			if($validador_datos_paciente->fails())
				{
					return 	[
								'bandera'			=>	' glyphicon glyphicon-exclamation-sign ',								
								'estilo'			=>	'alert alert-danger',
								'error_mensajes'	=>	true,
								'mensaje'			=>	$validador_datos_paciente->messages()
							];
				}
			return 	[
						'bandera'			=>	' glyphicon glyphicon-exclamation-sign ',						
						'estilo'			=>	'alert alert-danger',
						'error_mensajes'	=>	false,						
						'mensaje'			=>	'',
					];				

		}

	public static function guardarDatosPacientePediatrico($input)				
		{
			$respuesta = 	'';
			$documentos_paciente = 	'';
			$mensaje_final = '';
			/*
				ANTES DE COMENZAR TODOS LOS PROCESOS DE VALIDACION ES NECESARIO VERIFICAR A AMBOS
			  	ACTORES EN LA BASE DE DATOS PARA REDUCIR EL TIEMPO DE PROCESAMIENTO Y DAR UNA RES-
			  	PUESTA DE UNA VEZ
			*/

			/*
				SE CHEQUEA LA EXISTENCIA DEL PACIENTE PEDIATRICO EN LA BASE DE DATOS
			*/
			$paciente_existe = self::where('tipo_documento',		'=', 	$input['tipo_documento_paciente'])
									->where('documento',			'=',	$input['documento_paciente'])
										->pluck('id_paciente');
			if(!empty($paciente_existe))
				{
					$respuesta['paciente_existe']	=	true;
				}
			else
				{
					$respuesta['paciente_existe']	=	false;					
				}										


					
			/*
				SE CHEQUEA LA EXISTENCIA DEL REPRESENTANTE EN LA BASE DE DATOS
			*/
			$representante_existe = Representantes::where('tipo_documento',	'=', $input['tipo_documento_representante'])
													->where('documento',		'=', $input['documento_representante'])
														->pluck('id_representante');
			if(!empty($representante_existe))
				{
					$respuesta['representante_existe']	=	true;
				}
			else
				{
					$respuesta['representante_existe']	=	false;					
				}

			if($respuesta['paciente_existe'] == true && $respuesta['representante_existe'] == true)
				{
					return 	[
								'error_mensajes'		=>	false,
								'mensaje'				=>	'Paciente y representante existentes',
								'estilo'				=>	' alert alert-danger ',
								'bandera'				=>	' glyphicon glyphicon-exclamation-sign '								
							];
				}
			$errores_validacion_paciente = self::validarDatosPaciente($input);
			if($errores_validacion_paciente['error_mensajes'] == true)
				{
					return 	$errores_validacion_paciente;
				}			
			$errores_validacion_representante = Representantes::validarDatosRepresentante($input);
			if($errores_validacion_representante['error_mensajes'] == true)
				{
					return 	$errores_validacion_representante;
				}

			$errores_validacion_parentesco_representante = ParentescoRepresentantes::validarDatosParentescoRepresentante($input);
			if($errores_validacion_representante['error_mensajes'] == true)
				{
					return $errores_validacion_representante;
				}
			if($input['tipo_documento_paciente'] == "X")
				{
					$documentos_paciente = 	[
												'tipo_documento'	=>	'X',
												'documento'			=>	'NO APLICA'								
												];					
				}
			else
				{
					$documentos_paciente = 	[
												'tipo_documento'	=>	$input['tipo_documento_paciente'],
												'documento'			=>	$input['documento_paciente']
												];
				}
			switch($input['sexo_paciente'])
				{
					case 'M':
						$foto_paciente = ['fotografia' => asset('img/icono_chamo.jpg')];
					break;

					case 'F':
						$foto_paciente = ['fotografia' => asset('img/icono_chama.jpg')];						
					break;
				}
			if($respuesta['paciente_existe'] == false)
				{
					$paciente_nuevo	= [
											'tipo_documento'	=>	$documentos_paciente['tipo_documento'],
											'documento'			=>	$documentos_paciente['documento'],
											'primer_nombre'		=>	strtoupper($input['primer_nombre_paciente']),
											'segundo_nombre'	=>	strtoupper($input['segundo_nombre_paciente']),
											'primer_apellido'	=>	strtoupper($input['primer_apellido_paciente']),
											'segundo_apellido'	=>	strtoupper($input['segundo_apellido_paciente']),
											'fecha_nacimiento'	=>	$input['fecha_nacimiento_paciente_campo'],
											'id_pais'			=>	$input['pais_origen_paciente'],
											'sexo'				=>	$input['sexo_paciente'],
											'lugar_nacimiento'	=>	strtoupper($input['lugar_nacimiento_paciente']),
											'visible'			=>	'1',
											'fotografia'		=>	$foto_paciente['fotografia']
										];
					$rs_pac = self::create($paciente_nuevo);
					$id_nuevo_paciente		= $rs_pac->id_paciente;
					$mensaje_final = "Paciente guardado con éxito"."<br>";
				}
			else
				{
					$id_nuevo_paciente = $paciente_existe;
					$mensaje_final = "Paciente existente"."<br>";
				}

			if($respuesta['representante_existe'] == false)
				{
					$rs_rep = Representantes::guardarDatosRepresentante($input);
					$id_nuevo_representante = $rs_rep['id_representante_nuevo'];
					$mensaje_final .= "Representante guardado con éxito"."<br>";
				}
			else
				{
					$id_nuevo_representante = $representante_existe;
					$mensaje_final .= "Representante existente"."<br>";
				}

			$nuevo_parentesco_representante = ParentescoRepresentantes::guardarDatosParentescoRepresentante($input, $id_nuevo_paciente, $id_nuevo_representante);
			if($nuevo_parentesco_representante['parentesco_existe'] == true)
				{
					$mensaje_final .= "Parentesco existente";

				}
			else
				{
					$mensaje_final .= "Parentesco guardado con éxito";

				}
			return	[
								'error_mensajes'		=>	'',
								'mensaje'				=>	$mensaje_final,
								'estilo'				=>	' alert alert-success ',
								'paciente_existe'		=>	'',
								'representante_existe'	=>	'',
								'bandera'				=>	' glyphicon glyphicon-ok-sign '
							];
			
		}

	public static function generarBusquedaPaciente($input)
		{
			$argumentos = 	[
								'pacientes_pediatricos.fecha_nacimiento' 				=> 'busqueda_fecha_nacimiento_campo',
								'pacientes_pediatricos.primer_nombre' 					=> 'nombres_paciente',
								'pacientes_pediatricos.segundo_nombre' 					=> 'nombres_paciente',
								'pacientes_pediatricos.primer_apellido' 				=> 'apellidos_paciente',
								'pacientes_pediatricos.segundo_apellido' 				=> 'apellidos_paciente',								
								'historia_paciente_pediatrico.codigo_historia_medica'	=> 'codigo_historia_medica',								
								'pacientes_pediatricos.tipo_documento' 					=> 'tipo_documento_paciente',
								'pacientes_pediatricos.documento' 						=> 'documento_paciente',
								'representantes.tipo_documento' 						=> 'tipo_documento_representante',
								'representantes.documento' 								=> 'documento_representante',
								'representantes.primer_nombre' 							=> 'nombres_representante',
								'representantes.segundo_nombre' 						=> 'nombres_representante',
								'representantes.primer_apellido' 						=> 'apellidos_representante',
								'representantes.segundo_apellido' 						=> 'apellidos_representante'
							];
			$parametros = [];
			$datos_paciente_json = [];
			$nro_registro = 0;
			$corte_or = 0;
			$doc_completo_pac = "";
			$doc_completo_rep = "";

			foreach($argumentos as $llave => $valor):
				
				if($input[$valor]!="")
					{
						$parametros[$llave] = $input[$valor];						
					}

			endforeach;
			$consulta_parametros = " ";
			foreach($parametros as $llave => $valor):				
				if($corte_or < count($parametros)-1)
					{
						if($llave =='pacientes_pediatricos.fecha_nacimiento')
							{
								$consulta_parametros .= $llave."="."'".($valor)."' or ";
							}
						else
							{
								$consulta_parametros .= $llave." like "."'%".strtoupper($valor)."%' or ";	
							}

						
					}
				else
					{
						if($llave =='pacientes_pediatricos.fecha_nacimiento')
							{
								$consulta_parametros .= $llave."="."'".($valor)."'";
							}
						else
							{
								$consulta_parametros .= $llave." like "."'%".strtoupper($valor)."%'";								
							}
					}					
			$corte_or++;
			endforeach;
			$consulta_parametros .= "and visible='1'";

			$datos_paciente = self::leftJoin('historia_paciente_pediatrico','pacientes_pediatricos.id_paciente','=','historia_paciente_pediatrico.id_paciente')
									->leftJoin('parentesco_representantes','pacientes_pediatricos.id_paciente','=','parentesco_representantes.id_paciente')
										->join('representantes','parentesco_representantes.id_representante','=','representantes.id_representante')
											->whereRaw($consulta_parametros)
												->select(
															'pacientes_pediatricos.fecha_nacimiento as fn_pac', 'pacientes_pediatricos.primer_nombre as p_nombre_paciente', 'pacientes_pediatricos.segundo_nombre as s_nombre_paciente',
															'pacientes_pediatricos.primer_apellido as p_apellido_paciente', 'pacientes_pediatricos.segundo_apellido as s_apellido_paciente', 'historia_paciente_pediatrico.codigo_historia_medica as cod_his_med',
															'pacientes_pediatricos.tipo_documento as nac_pac', 'pacientes_pediatricos.documento as ced_pac', 'representantes.tipo_documento as nac_rep', 'representantes.documento as ced_rep',
															'representantes.primer_nombre as p_nombre_rep', 'representantes.segundo_nombre as s_nombre_rep', 'representantes.primer_apellido as p_apellido_rep', 'representantes.segundo_apellido as s_apellido_rep',
															'historia_paciente_pediatrico.id_historia_medica'
														)
													->get();
			
			foreach($datos_paciente as $d):
				$nro_registro++;
				if($d->ced_pac == "" || $d->nac_pac == "X" || $d->nac_pac == "")
					{
						$doc_completo_pac = "NO APLICA";
					}
				else
					{
						$doc_completo_pac = $d->nac_pac."-".$d->ced_pac;	
					}
				$fecha_nacimiento = new DateTime($d->fn_pac);
				$datos_paciente_json[] = 	[
												'registro' 	=> 	$nro_registro,
												'nom_ape'  	=> 	($d->p_nombre_paciente." ".$d->s_nombre_paciente." ".$d->p_apellido_paciente."".$d->s_apellido_paciente),
												'documento'	=> 	$doc_completo_pac,
												'fecha_nac'	=>	/*$d->fn_pac*/$fecha_nacimiento->format('d/m/Y'),
												'cod_histo'	=>	$d->cod_his_med,
												'represent'	=>	($d->p_nombre_rep." ".$d->s_nombre_rep." ".$d->p_apellido_rep."".$d->s_apellido_rep),
												'opciones'	=>	"<button class='btn btn-success' id='".$d->id_historia_medica."'>Ver detalles</button>"

											];
			endforeach;

			return Response::json($datos_paciente_json);

		}

}