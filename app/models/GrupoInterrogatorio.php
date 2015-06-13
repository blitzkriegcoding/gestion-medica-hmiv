<?php

class GrupoInterrogatorio extends \Eloquent {
	protected $fillable = [];
	protected $table = 'grupo_interrogatorio';

	public function condicion()
		{
			return $this->hasMany('CondicionInterrogatorio','id_grupo_interrogatorio','id_grupo_interrogatorio');
		}
}