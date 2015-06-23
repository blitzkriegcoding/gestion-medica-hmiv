<?php

class EspecialidadesMedicas extends \Eloquent {
	protected $fillable = [];
	public $table = 'especialidades_medicas';
	public $primaryKey = 'id_especialidad';


	public static function mostrarEspecialidades($especialidad_medica)
		{
			$especialidades = self::where('especialidad','LIKE',strtoupper($especialidad_medica).'%')->get();
			return Response::json($especialidades);
		}	

}