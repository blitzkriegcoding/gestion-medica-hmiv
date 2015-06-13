<?php

class ExamenFuncionalPediatrico extends \Eloquent {
	protected $fillable = [];
	public $table = 'examen_funcional_pediatrico';

	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico');

		}
}