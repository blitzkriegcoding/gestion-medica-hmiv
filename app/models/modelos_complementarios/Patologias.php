<?php

class Patologias extends \Eloquent {
	protected $fillable = [];
	public $table = 'patologias';
	public $primaryKey = 'id_patologia';
	public $timestamps = false;

	public static function mostrarPatologia($patologia)
		{


			return Response::json(self::where('patologia','LIKE',strtoupper($patologia).'%')->get());									


		}

}