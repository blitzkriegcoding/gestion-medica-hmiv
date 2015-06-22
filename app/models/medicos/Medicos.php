<?php

class Medicos extends \Eloquent {
	protected $fillable = [];
	public $table = 'medicos';
	public $timestamps = false;
	public $primaryKey ='id_medico';
	public function IngresoPacientePediatrico()
		{
			return $this->hasMany('IngresoPacientePediatrico','id_medico','id_medico');
		}

}