<?php

class HistoriaMedicaPediatrica extends \Eloquent {
	protected $fillable = [];
	public $table = 'historia_paciente_pediatrico';

	public $primaryKey = 'id_historia_medica';
	public $timestamps = false;
	
	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico','id_paciente','id_paciente');
		}



}