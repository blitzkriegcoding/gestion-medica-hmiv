<?php

class DatosMedicoContacto extends \Eloquent {
	protected $fillable = 	[
								'id_medico'				,
								'tipo_documento'		,
								'documento'				,
								'direccion_completa'	,
								'telefono1'				,
								'telefono2'				,
								'id_relacion_medico'	,
								'primer_nombre'			,
								'segundo_nombre'		,
								'primer_apellido'		,
								'segundo_apellido'		,
							];

	public $table = 'datos_medico_contacto';
	public $primaryKey = 'id_medico_contacto';
	public $timestamps = false;

	public function RelacionMedicoContacto()
		{
			return $this->belongsTo('RelacionMedicoContacto','id_relacion_medico','id_relacion_medico');
		}

}