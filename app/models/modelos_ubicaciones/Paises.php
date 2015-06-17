<?php

class Paises extends \Eloquent {
	protected $fillable = [];
	protected $table='paises';

	public static function mostrarPaises($pais)
		{
			$paises = Paises::where('pais','LIKE',strtoupper($pais).'%')->get();
			return Response::json($paises);			
		}	


}