<?php

class GrupoExamenFisico extends \Eloquent {
	protected $fillable = [];
	protected $table = 'grupo_examen_fisico';

	public function CondicionFisico()
		{
			return $this->hasMany('CondicionExamenFisico','id_grupo_fisico','id_grupo_fisico');
		}

}