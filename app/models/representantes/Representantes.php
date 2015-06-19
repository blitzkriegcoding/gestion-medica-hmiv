<?php

class Representantes extends \Eloquent {
	protected $table = 'representantes';
	protected $fillable = [
							'tipo_documento'		,
							'documento'				,
							'primer_nombre'			,
							'segundo_nombre'		,
							'primer_apellido'		,
							'segundo_apellido'		,
							'fecha_nacimiento'		,
							'sexo'					,
							'id_pais'				,
							'id_parroquia'			,
							'avenida_calle'			,
							'casa_edificio'			,
							'telefono1'				,
							'telefono2'				,
							'correo'				,
							'fotografia'			,
							'id_nivel_estudio'		,
							'id_ocupacion_oficio'	,
							'id_estado_civil'		,
							];
	public $timestamps = false;
	protected $primaryKey = 'id_representante';

}