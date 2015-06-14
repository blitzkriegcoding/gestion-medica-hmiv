<?php

class ExamenFuncionalPediatrico extends \Eloquent {
	protected $fillable = [
		'id_paciente',
		'id_condicion_examen_funcional',
		'fecha_examen_funcional',
		'detalles',
		'status'
	];
	public $table = 'examen_funcional_pediatrico';

	public $timestamps = false;
	public $primaryKey = 'id_examen_funcional';



	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico');

		}
}