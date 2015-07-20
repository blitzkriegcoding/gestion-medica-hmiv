<?php

class Tratamientos extends \Eloquent {
	protected $fillable = ['id_historia_medica','descripcion','fecha_tratamiento','id_medico'];
	public $table 		= 'tratamientos';
	public $primaryKey 	= 'id_tratamiento';
	public $timestamps	= false;



	public static function obtenerHistoricoTratamientosJSON()
		{
			$historico_tratamiento	= self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
										->join('historia_paciente_pediatrico','tratamientos.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->select('id_tratamiento','fecha_tratamiento as fec_tra')
												->get();
			$contador_tratamiento 	= 0;
			$tratamientos_json 		= [];
			foreach($historico_tratamiento as $d):
				$contador_tratamiento ++;
				$nueva_fecha = new DateTime($d->fec_tra);
				$tratamientos_json[] = [	
											'num_tra'	=>	$contador_tratamiento,
											'fec_tra'	=>	$nueva_fecha->format('d/m/Y'),
											'detalles'	=>	'PRUEBAS',
											'borrar'	=>	'PRUEBAS'
										];
			endforeach;
			return $tratamientos_json;
		}

	public static function obtenerTratamientosSostenidosJSON()
		{
			$historico_tratamiento	= self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
										->join('historia_paciente_pediatrico','tratamientos.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->select('id_tratamiento','fecha_tratamiento as fec_tra')
												->get();
			$contador_tratamiento 	= 0;
			$tratamientos_json 		= [];
			foreach($historico_tratamiento as $d):
				$contador_tratamiento ++;
				$nueva_fecha = new DateTime($d->fec_tra);
				$tratamientos_json[] = [	
											'num_tra'	=>	$contador_tratamiento,
											'fec_tra'	=>	$nueva_fecha->format('d/m/Y'),
											'detalles'	=>	'PRUEBAS',
											'borrar'	=>	'PRUEBAS'
										];
			endforeach;
			return $tratamientos_json;
		}	

}
/*
  id_historia_medica bigint NOT NULL,
  descripcion character varying(255) NOT NULL,
  fecha_tratamiento date NOT NULL,
  id_medico bigint NOT NULL,
*/