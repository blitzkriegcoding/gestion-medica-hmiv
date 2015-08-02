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

	public static function obtenerTratamientosSostenidosJSON()
		{
			$historico_tratamiento	= self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
										->join('historia_paciente_pediatrico','tratamientos_sostenidos.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
										->select('id_tratamiento_sostenido','tratamiento_sostenido')
										->get();

			$contador_tratamiento 	= 0;
			$tratamientos_json 		= [];
			foreach($historico_tratamiento as $d):
				$contador_tratamiento ++;				
				$tratamientos_json[] = 	[	
											'num_tra'		=>	$contador_tratamiento,
											'tratamiento'	=>	$d->tratamiento_sostenido											
										];
			endforeach;
			return $tratamientos_json;
		}		
}