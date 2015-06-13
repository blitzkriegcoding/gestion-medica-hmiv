<?php

class GrupoExamenFuncional extends \Eloquent {
	protected $fillable = [];
	protected $table = 'grupo_examen_funcional';

	public function CondicionFuncional()
		{
			return $this->hasMany('CondicionExamenFuncional','id_grupo_funcional','id_grupo_funcional');
		}
}