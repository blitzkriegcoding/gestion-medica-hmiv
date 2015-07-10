<?php

class Patologias extends \Eloquent {
	protected $fillable = [];
	public $table = 'patologias';
	public $primaryKey = 'id_patologia';

	public static function mostrarPatologia($patologia)
		{
			return Response::json(Patologias::where('patologia','LIKE',strtoupper($patologia).'%')
								->select('id_patologia','patologia')
									->get());
		}

}