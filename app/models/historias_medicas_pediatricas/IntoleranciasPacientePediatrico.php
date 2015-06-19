<?php

class IntoleranciasPacientePediatrico extends \Eloquent {
	protected $fillable = ['id_historia_medica','id_intolerancia'];
	public $primaryKey = 'id_intolernacia_paciente';
	public $table = 'intolerancias_paciente_pediatrico';
	public $timestamps = false;
}