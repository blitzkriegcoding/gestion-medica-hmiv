<?php

class Alergias extends \Eloquent {
	protected $fillable = [];
	public $table = 'alergias';

	public $primaryKey = 'id_alergia';

	public static function mostrarAlergia($alergia)
		{
			return Response::json(Alergias::where('alergia','LIKE',strtoupper($alergia).'%')->get());
		}

}