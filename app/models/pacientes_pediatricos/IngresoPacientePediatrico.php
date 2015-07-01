<?php

class IngresoPacientePediatrico extends \Eloquent {
	protected $fillable = 	[
								'id_forma_ingreso',
								'fecha_ingreso' ,
								'id_paciente',
								'id_tipo_ingreso',
								'resumen_ingreso',
								'ubicacion_sala',
								'id_medico',
								'enfermedad_actual',
								'diagnostico_ingreso'
							];	
	protected $table = 'ingreso_paciente_pediatrico';
	public $timestamps = false;
	protected $primaryKey = 'id_forma_ingreso';

	public function Medicos()
		{
			return $this->belongsTo('Medicos','id_medico','id_medico');

		}
	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico','id_paciente','id_paciente');
		}

	private static function validarDatosIngreso($input)
		{
			$reglas_datos_ingreso = [
										'tipo_ingreso_paciente'					=>	'required|integer',
										'medico_tratante'						=>	'required|exists:medicos,id_medico',
										'fecha_ingreso_paciente'				=>	'date_format:d/m/Y|required',
										'ubicacion_hospital_paciente'			=>	'required',
										'resumen_ingreso_paciente'				=>	'required',
										'enfermedad_actual_paciente'			=>	'required',
										'diagnostico_admision_paciente'			=>	'required'										
									];
			$mensajes_error = 	[
									'required'		=> 	'Campo obligatorio',
									'integer'		=>	'Debe ser un numero entero',
									'date_format'	=>	'Formato inválido de fecha',
									'exists'		=>	'Debe seleccionar un valor de la lista'
								];
			$validator_datos_ingreso = Validator::make($input,$reglas_datos_ingreso,$mensajes_error);

			if($validator_datos_ingreso->fails())
					{
						return 	[
									'bandera'			=>	' glyphicon glyphicon-exclamation-sign ',
									'mensaje'			=>	$validator_datos_ingreso->messages(),
									'estilo'			=>	' alert alert-danger ',
									'error_mensajes'	=>	true,
								];
					}

			return 	[
						'bandera'			=>	' glyphicon glyphicon-exclamation-sign ',
						'mensaje'			=>	'',
						'estilo'			=>	' alert alert-danger ',
						'error_mensajes'	=>	true,
					];

		}

	public static function guardarDatosIngreso($input,$id_paciente_nuevo)
		{
			$respuesta = self::validarDatosIngreso($input);

			if($respuesta['error_mensajes'] == true)
				{
					return $respuesta;
				}
			$nuevo_ingreso = [
								
								'fecha_ingreso'			=>	$input['fecha_ingreso_paciente'],
								'id_paciente'			=>	$id_paciente_nuevo,
								'id_tipo_ingreso'		=>	$input['tipo_ingreso_paciente'],
								'resumen_ingreso'		=>	$input['resumen_ingreso_paciente'],
								'ubicacion_sala'		=>	$input['ubicacion_hospital_paciente'],
								'id_medico'				=>	$input['medico_tratante'],
								'enfermedad_actual'		=>	$input['enfermedad_actual_paciente'],
								'diagnostico_ingreso'	=>	$input['diagnostico_admision_paciente']
							];
			self::create($nuevo_ingreso);
			return 	[
						'bandera'			=>	' glyphicon glyphicon-ok-sign ',
						'mensaje'			=>	'Datos de ingreso almacenados con exito',
						'estilo'			=>	' alert alert-success ',
						'error_mensajes'	=>	true,
					];
		}



}