<?php

class ExamenFisicoPediatrico extends \Eloquent {

	protected $fillable = [
							'id_paciente',
							'id_condicion_examen_fisico', 
							'fecha_examen_pediatrico',
							'detalles',
							'status'
							];
	public $table = 'examen_fisico_pediatrico';
	public $timestamps = false;
	public $primaryKey = 'id_examen_fisico_pediatrico';

	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico');
		}
}