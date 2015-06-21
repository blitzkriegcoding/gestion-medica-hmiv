<?php

class TipoMedico extends \Eloquent {
	protected $fillable = [];
	public $table = 'tipo_medico';
	public $primaryKey = 'id_tipo_medico';

	public function Medicos()
		{
			return $this->hasMany('medicos','id_tipo_medico','id_tipo_medico');
		}
}