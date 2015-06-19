<?php

class AlergiasPacientePediatrico extends \Eloquent {
	protected $fillable = ['id_historia_medica','id_alergia'];
	public $primaryKey 	= 'id_alergia_historia';
	public $timestamps 	= false;
	public $table 		= 'alergias_historia_pediatrica';

	public function Alergias()
		{
			return $this->belongsTo('AlergiasPacientePediatrico','id_alergia','id_alergia');
		}

}