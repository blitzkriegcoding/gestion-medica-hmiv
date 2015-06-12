<?php

class CondicionExamenFuncional extends \Eloquent {
	protected $fillable = [];
	protected $table = 'condicion_examen_funcional';

	public function grupo_funcional()
		{
			return $this->belongsTo('GrupoExamenFuncional');
		}
}