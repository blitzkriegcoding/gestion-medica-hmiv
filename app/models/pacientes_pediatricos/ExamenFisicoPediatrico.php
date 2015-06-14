<?php

class ExamenFisicoPediatrico extends \Eloquent {

	protected $fillable = [];
	public $table = 'examen_fisico _pediatrico';
	public $timestamps = false;
	public $primaryKey = 'id_examen_fisico_pediatrico';

	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico');
		}
}