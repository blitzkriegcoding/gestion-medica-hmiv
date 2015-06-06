<?php

class IngresoPacientePediatrico extends \Eloquent {
	protected $fillable = [];	
	protected $table = 'ingreso_paciente_pediatrico';
	public $timestamps = false;
	protected $primaryKey = 'id_forma_ingreso';
}