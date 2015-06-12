<?php

class CondicionInterrogatorio extends \Eloquent {
	protected $fillable = [];
	protected $table = 'condicion_interrogatorio';

	public function grupo()
		{
			return $this->belongsTo('GrupoInterrogatorio');
		}

}