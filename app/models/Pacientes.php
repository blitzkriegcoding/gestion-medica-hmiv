<?php

class Pacientes extends \Eloquent {
	protected $fillable = [];
	protected $table = 'pacientes';

	private $reglas_bloque_1 = array
									(
										'tipo_documento_paciente'=>'required|in:V,E,P,X',
										'documento_paciente' =>'required|sometimes',
										'primer_nombre_paciente'=>'required|max:30|regex:[a-zA-ZñÑ\s]+',
										'segundo_nombre_pacuente'=>'max:30|regex:[a-zA-ZñÑ\s]+',
										'primer_apellido_paciente'=>'max:40|required|regex:[a-zA-ZñÑ\s]+',
										'segundo_apellido_paciente'=>'max:40|regex:[a-zA-ZñÑ\s]+',
										'fecha_nacimiento_paciente'=>'date_format:dd/mm/yyyy|required',
										'pais_origen_paciente'=>'required|integer|exists:paises,id_pais',
										'sexo_paciente'=>'required|in:F,M',
										'lugar_nacimiento_paciente'=>'required|max:30|regex:[a-zA-ZñÑ\s]+'
									);
	//$validador_bloque_1 = Validator::make(Input)

	private $reglas_bloque_2 = array
									(
										'tipo_documento_representante'=>'required|in:V,E,P',
										'documento_representante'=>'required|min:6|sometimes',
										'sexo_representante' =>'required|in:V,E,P',
										'primer_nombre_representante'=>'required|max:30|regex:[a-zA-ZñÑ\s]+',
										'segundo_nombre_representante'=>'max:30|regex:[a-zA-ZñÑ\s]+',
										'primer_apellido_representante'=>'required|max:30|regex:[a-zA-ZñÑ\s]+',
										'segundo_apellido_representante'=>'max:30|regex:[a-zA-ZñÑ\s]+',
										'fecha_nacimiento_representante'=>'date_format:dd/mm/yyyy|required',
										'pais_origen_representante'=>'required|integer|exists:paises,id_pais',
										'parentesco_representante'=>'required|integer|exists:parentesco,id_parentesco',
										'estado_civil_representante'=>'required|integer|exists:estado_civil,id_estado_civil',
										'direccion_est_mun_par_representante'=>'required|integer|exists:parroquia,id_parroquia',
										'avenida_calle_representante'=>'required|max:40|regex:[0-9a-zA-ZñÑ\s]+',
										'casa_edificio_representante'=>'required|max:40|regex:[0-9a-zA-ZñÑ\s]+',



									);

	private $reglas_bloque_3 = array
									(

									);


}