<?php

class InterrogatorioPediatrico extends \Eloquent {
	protected $fillable = ['id_paciente','id_condicion_interrogatorio','fecha_interrogatorio','detalles','status'];

	public $table = 'interrogatorio_pediatrico';
	public $timestamps = false;
	public $primaryKey = 'id_interrogatorio';


	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico','id_paciente','id_paciente');
		}

}