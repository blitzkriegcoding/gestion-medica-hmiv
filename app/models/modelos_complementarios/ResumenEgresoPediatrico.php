<?php

class ResumenEgresoPediatrico extends \Eloquent {
	protected $fillable = 	[
								'id_hospitalizacion',
								'fecha_resumen_egreso',
								'id_medico_egreso',
								'resumen_egreso'
							];
	public $table = 'resumen_egreso_pediatrico';
	public $primaryKey = 'id_resumen_egreso';
	public $timestamps = false;

	public static function guardarResumenEgreso($input)
		{
			self::create(
							[
								'id_hospitalizacion'	=>	$input['id_hospitalizacion'],
								'fecha_resumen_egreso'	=>	$input['fecha_alta_medica_campo'],
								'id_medico_egreso'		=>	$input['medico_alta'],
								'resumen_egreso'		=>	strtoupper($input['resumen_egreso'])
							]
						);

		}
}
