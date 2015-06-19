<?php

class ParentescoRepresentantes extends \Eloquent {
	protected $fillable = ['id_parentesco','id_paciente','id_representante','representante_real'];
	protected $table = 'parentesco_representantes';
	public $timestamps = false;
	protected $primaryKey = 'id_representante';

	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePedriatrico');
		}
}