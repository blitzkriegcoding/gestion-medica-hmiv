<?php

class NivelEstudio extends \Eloquent {
	protected $fillable = [];
	public $table = 'nivel_estudio';
	public $primaryKey = 'id_nivel_estudio';


	public function Representante()
	{
		return $this->belongsTo('Representante','id_nivel_estudio','id_nivel_estudio');
	}
}