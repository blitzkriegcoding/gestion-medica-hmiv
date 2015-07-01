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


	public static function validarDatosPaciente($input)
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
				
			



		}

	public static function cargar_paciente_pediatrico($input)				
		{			
			$respuesta 						= [];
			$respuesta['error_mensajes'] 	= '';
			$respuesta['mensaje'] 			= '';
			$respuesta['estilo'] 			= '';

			/*
				ANTES DE COMENZAR TODOS LOS PROCESOS DE VALIDACION ES NECESARIO VERIFICAR A AMBOS
			  	ACTORES EN LA BASE DE DATOS PARA REDUCIR EL TIEMPO DE PROCESAMIENTO Y DAR UNA RES
			  	PUESTA DE UNA VEZ
			*/

			/*
				SE CHEQUEA LA EXISTENCIA DEL PACIENTE PEDIATRICO EN LA BASE DE DATOS
			*/
			$existe_pac = DB::table('pacientes_pediatricos')
							->where('tipo_documento',		'=', 	$input['tipo_documento_paciente'])
							->where('documento',			'=',	$input['documento_paciente'])
								->pluck('id_paciente');
					
			/*
				SE CHEQUEA LA EXISTENCIA DEL REPRESENTANTE EN LA BASE DE DATOS
			*/
			$existe_rep = DB::table('representantes')
								->where('tipo_documento',	'=', $input['tipo_documento_representante'])
								->where('documento',		'=', $input['documento_representante'])
									->pluck('id_representante');

			if((!is_null($existe_pac) && !is_null($existe_rep)) || (!empty($existe_pac) && !empty($existe_rep)))
				{
					$respuesta = [
									'mensaje'			=>	'Paciente y Representante existentes',
									'estilo'			=>	' alert alert-warning ',
									'bandera'			=>	'glyphicon glyphicon-exclamation-sign',
									'error_mensajes'	=> false
								];

					return $respuesta;
				}

			/* SE ESTABLECEN LAS REGLAS DE VALIDACION PARA LARAVEL */
	 		$reglas_bloques = 
									[
										/*BLOQUE 1*/
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

			$validador_bloques = Validator::make($input,$reglas_bloques);



			
			if($validador_bloques->fails())
				{	
					$respuesta['mensaje'] 			= $validador_bloques;
					$respuesta['error_mensajes'] 	= true;

					$respuesta = [
									'bandera'			=>	' glyphicon glyphicon-remove ',
									'mensaje'			=>	'Paciente creado con éxito, Representante existente',
									'estilo'			=>	'alert alert-danger',
									'error_mensajes'	=>	true,
									'mensaje'			=>	$validador_bloques

								];							
				}
			else
				{
					/*	
						SE COMIENZA EL PROCESO PARA CARGAR AL PACIENTE Y REPRESENTANTE EN LA 
						BASE DE DATOS
					*/
					$paciente 			= new PacientePediatrico();
					$parentesco_rep 	= new ParentescoRepresentantes();
					$detalles_ingreso 	= new IngresoPacientePediatrico();	

					/* SI EL PACIENTE NO EXISTE HAY QUE CREARLO NUEVO */				
					if(is_null($existe_pac) || empty($existe_pac))
						{
							if((!isset($input['documento_paciente']) || $input['documento_paciente'] == "") && $input['tipo_documento_paciente']=="X")
								{
									$paciente->documento = "NO APLICA";
								}
							else
								{
									$paciente->documento = $input['documento_paciente'];
								}
							$paciente->tipo_documento 	= $input['tipo_documento_paciente'];
							$paciente->primer_nombre 	= strtoupper($input['primer_nombre_paciente']);
							$paciente->segundo_nombre 	= strtoupper($input['segundo_nombre_paciente']);
							$paciente->primer_apellido 	= strtoupper($input['primer_apellido_paciente']);
							$paciente->segundo_apellido = strtoupper($input['segundo_apellido_paciente']);
							$paciente->fecha_nacimiento	= $input['fecha_nacimiento_paciente_campo'];
							$paciente->id_pais 			= $input['pais_origen_paciente'];
							$paciente->sexo 			= $input['sexo_paciente'];
							switch($input['sexo_paciente'])
								{
									case 'M':
										$paciente->fotografia = asset('img/icono_chamo.jpg');
									break;

									case 'F':
										$paciente->fotografia = asset('img/icono_chama.jpg');
									break;
								}
							#$paciente->tipo_paciente = "1";
							$paciente->visible = "1";
							$paciente->lugar_nacimiento = strtoupper($input['lugar_nacimiento_paciente']);
							
							/* GUARDAR PACIENTE PEDIATRICO */
							$paciente->save(); 

							$parentesco_rep->id_paciente 		= $paciente->id_paciente; /*RETORNAR ID PARA RELACION DE PARENTESCO*/
							$parentesco_rep->representante_real = $input['representante_legal'];
							$detalles_ingreso->id_paciente 		= $paciente->id_paciente;
						}
					else{
							$parentesco_rep->id_paciente = $existe_pac;
							$detalles_ingreso->id_paciente = $existe_pac;

						}

					

					if(!is_null($existe_rep) || !empty($existe_rep)) 
						{							
							$parentesco_rep->id_representante 	= $existe_rep;
							$respuesta = [
											'bandera'			=>	' glyphicon glyphicon-ok ',
											'mensaje'			=>	'Paciente creado con éxito, Representante existente',
											'estilo'			=>	'alert-success',
											'error_mensajes'	=>	false,
										];							

						}
					else
						{
/*							$representante = new Representantes();

							$representante->tipo_documento 		= $input['tipo_documento_representante'];
							$representante->documento 			= $input['documento_representante'];
							$representante->primer_nombre 		= strtoupper($input['primer_nombre_representante']);
							$representante->segundo_nombre 		= strtoupper($input['segundo_nombre_representante']);
							$representante->primer_apellido 	= strtoupper($input['primer_apellido_representante']);
							$representante->segundo_apellido 	= strtoupper($input['segundo_apellido_representante']);
							$representante->fecha_nacimiento 	= $input['fecha_nacimiento_representante'];
							$representante->sexo 				= $input['sexo_representante'];
							$representante->id_pais 			= $input['pais_origen_representante'];
							$representante->id_parroquia 		= $input['direccion_est_mun_par_representante'];
							$representante->avenida_calle 		= $input['avenida_calle_representante'];
							$representante->casa_edificio 		= $input['casa_edificio_representante'];													
							$representante->telefono1 			= $input['telefono_1'];
							$representante->telefono2 			= $input['telefono_2'];
							$representante->correo 				= $input['correo_representante'];
							$representante->id_nivel_estudio 	= $input['grado_instruccion_representante'];
							$representante->id_ocupacion_oficio = $input['ocupacion_oficio_representante'];
							$representante->id_estado_civil 	= $input['estado_civil_representante'];
							
							$representante->save();*/

							#$parentesco_rep->id_representante 	= $representante->id_representante;

/*							$respuesta = [
											'bandera'			=>	' glyphicon glyphicon-ok ',
											'mensaje'			=>	'Paciente y Representante creados con éxito',
											'estilo'			=>	'alert alert-danger',
											'error_mensajes'	=>	false,
										];*/

						}

					/*	GUARDAR DATOS DE PARENTESCO ENTRE PACIENTE Y REPRESENTANTE	*/

					/*$parentesco_rep->id_parentesco 				= $input['parentesco_representante'];
					$parentesco_rep->representante_real			= $input['representante_legal'];*/
					
					// $parentesco_rep->save();

					/*	GUARDAR DETALLES DE ADMISION DEL PACIENTE	*/					
					/* CODIGO REFACTORIZADO EL 30/06/2015 23:30 HRS
					$detalles_ingreso->fecha_ingreso 			= $input['fecha_ingreso_paciente'];					
					$detalles_ingreso->id_tipo_ingreso 			= $input['tipo_ingreso_paciente'];
					$detalles_ingreso->resumen_ingreso 			= $input['resumen_ingreso_paciente'];
					$detalles_ingreso->ubicacion_sala 			= $input['ubicacion_hospital_paciente'];
					$detalles_ingreso->id_medico 				= $input['medico_tratante'];
					$detalles_ingreso->enfermedad_actual 		= $input['enfermedad_actual_paciente'];
					$detalles_ingreso->diagnostico_ingreso 		= $input['diagnostico_admision_paciente'];
					$detalles_ingreso->save();*/
				}
			return $respuesta;
		}


}