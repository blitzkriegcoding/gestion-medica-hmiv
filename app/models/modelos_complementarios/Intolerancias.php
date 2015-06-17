<?php

class Intolerancias extends \Eloquent {
	protected $fillable = [];
	public $table = 'intolerancias';
	public $primaryKey = 'id_intolerancia';

	public static function mostrarIntolerancia($intolerancia)
		{
			return Response::json(Intolerancias::where('intolerancia','LIKE',strtoupper($intolerancia).'%')->get());
		}

	#public function 	

}