<?php

class PatologiasPacientePediatrico extends \Eloquent {
	protected $fillable = ['id_patologia','id_historia_medica'];
	public $primaryKey 	= 'id_patologia_historia';
	public $timestamps 	= false;
	public $table 		= 'patologias_historia_pediatrica';
}