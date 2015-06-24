<?php

class RelacionMedicoContacto extends \Eloquent {
	protected $fillable = [];
	public $table = 'relacion_medico_contacto';
	public $primaryKey = 'id_relacion_medico';

	public function DatosMedicoContacto()
		{
			return $this->hasMany('DatosMedicoContacto','id_relacion_medico','id_relacion_medico');
		}



}