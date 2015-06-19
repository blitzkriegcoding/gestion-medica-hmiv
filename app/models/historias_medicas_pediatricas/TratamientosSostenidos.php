<?php

class TratamientosSostenidos extends \Eloquent {
	protected $fillable = ['id_historia_medica','tratamiento_sostenido'];
	public $table ='tratamientos_sostenidos';
	public $primaryKey = 'id_tratamiento_sostenido';
	public $timestamps = false;

	public function HistoriaMedicaPediatrica()
		{
			return $this->HistoriaMedicaPediatrica('HistoriaMedicaPediatrica','id_historia_medica','id_historia_medica');

		}
}