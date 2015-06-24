<?php

class EspecialidadesMedicasGaleno extends \Eloquent {
	protected $fillable = ['id_especialidad','id_medico'];
	public $table = 'medicos_especialidades';
	public $timestamps = false;
	public $primaryKey = ['id_especialidad', 'id_medico'];

	public function Medicos()
		{
			return $this->belongsTo('Medicos','id_medico','id_medico');
		}
	public function EspecialidadesMedicas()
		{
			return $this->belongsTo('EspecialidadesMedicas','id_especialidad','id_especialidad');
		}		

}