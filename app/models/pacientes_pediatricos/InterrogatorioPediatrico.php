<?php

class InterrogatorioPediatrico extends \Eloquent {
	protected $fillable = [];
	public $table = 'interrogatorio_pediatrico';

	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico');
		}

}