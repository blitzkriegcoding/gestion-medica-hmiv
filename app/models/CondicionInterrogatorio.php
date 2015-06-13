<?php

class CondicionInterrogatorio extends \Eloquent {
	protected $fillable = [];
	protected $table = 'condicion_interrogatorio';

	public function GrupoInterrogatorio()
		{
			return $this->belongsTo('GrupoInterrogatorio');
		}

}