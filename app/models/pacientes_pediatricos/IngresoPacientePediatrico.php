<?php

class IngresoPacientePediatrico extends \Eloquent {
	protected $fillable = [];	
	protected $table = 'ingreso_paciente_pediatrico';
	public $timestamps = false;
	protected $primaryKey = 'id_forma_ingreso';

	public function Medicos()
		{
			return $this->belongsTo('Medicos','id_medico','id_medico');

		}
}