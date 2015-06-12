<?php

class CondicionExamenFisico extends \Eloquent {
	protected $fillable = [];
	protected $table = 'condicion_examen_fisico';

	public function GrupoFisico()
		{
			return $this->belongsTo('GrupoExamenFisico');
		}
}