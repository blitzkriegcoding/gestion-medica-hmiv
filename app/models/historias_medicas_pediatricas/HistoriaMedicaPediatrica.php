<?php

class HistoriaMedicaPediatrica extends \Eloquent {
	protected $fillable = [];
	public $table = 'historia_paciente_pediatrico';
	public $primaryKey = 'id_historia_medica';
	public $timestamps = false;
	
	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico','id_paciente','id_paciente');
		}

	public static function existenExamenesMedicos($id_paciente_pediatrico)
		{
			$examen_interrogatorio = [];
			$examen_interrogatorio = ExamenFisicoPediatrico::existeExamen($id_paciente_pediatrico);
			return $examen_interrogatorio;
		}
	public static function cargar_historia_medica($input)
		{
			#dd(input);
			$respuesta = [];
			$reglas_representante_legal =	[
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
										'avenida_calle_representante'			=>	'required|max:40|regex:/([a-zA-ZñÑ\s])/',
										'casa_edificio_representante'			=>	'required|max:40|regex:/([a-zA-ZñÑ\s])/',
										'telefono_1'							=>	'required|max:11|regex:/([0-9]){11}/',
										'telefono_2'							=>	'max:11|regex:/([0-9]){11}/',
										'correo_representante'					=>	'email|unique:representantes,correo',
										'ocupacion_oficio_representante'		=>	'required|integer|exists:ocupacion_oficio,id_ocupacion_oficio',
										'grado_instruccion_representante'		=>	'required|integer|exists:nivel_estudio,id_nivel_estudio',
										];
			$reglas_deficiencias = [];


			$mensajes_error = [
								'required'		=>	'Este campo es obligatorio',
								'in'			=>	'Debe seleccionar un valor entre los mostrados',
								'date_format'	=>	'Fecha en formato incorrecto dd/mm/yyyy',
								'email'			=>	'Correcto electrónico incorrecto',
								'unique'		=>	'Correo electrónico ya existe',
								'exists'		=>	'Debe seleccionar un valor entre los mostrados',
								'integer'		=>	'Esta campo solo puede contener numeros',								
							];
			


			$validador_representante = Validator::make($input,$reglas_representante_legal,$mensajes_error);
			
			if($validador_representante->fails())
				{
					return [
								'error_mensajes'	=> 	true,
								'mensaje'			=> 	$validador_representante->messages(),
								'representante'		=>	$validador_representante->fails(),
								'deficiencias'		=>	'',
							];
				}






		}



}