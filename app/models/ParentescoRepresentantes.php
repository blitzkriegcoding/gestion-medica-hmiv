<?php

class ParentescoRepresentantes extends \Eloquent {
	protected $fillable = [];
	protected $table = 'parentesco_representantes';
	public $timestamps = false;
	protected $primaryKey = 'id_representante';

	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePedriatrico');
		}
}