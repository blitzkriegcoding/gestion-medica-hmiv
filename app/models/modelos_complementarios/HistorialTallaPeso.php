<?php

class HistorialTallaPeso extends \Eloquent 
	{
		protected $fillable = 	[
									  'id_paciente',
									  'talla',
									  'peso',
									  'fecha_toma',
								];

		public $primaryKey 	= 	'id_historial_talla_peso';
		public $table 		= 	'historial_talla_peso';
		public $timestamps 	= 	false;

		public static function obtenerHistoricoTallaPeso()
			{
				$talla_peso_json = [];
				$contador_talla_peso = 0;

				$talla_peso = self::where('id_paciente', '=', Session::get('id_paciente_pediatrico'))
									->select('talla','peso','fecha_toma','id_historial_talla_peso')
										->get();
				foreach($talla_peso as $d):
					$contador_talla_peso ++;
					$nueva_fecha = new DateTime($d->fecha_toma);
					$talla_peso_json[] = 	[
												'num_tal'	=>	$contador_talla_peso;
												'talla'		=>	$d->talla,
												'peso'		=>	$d->peso,
												'fecha'		=>	$nueva_fecha->format('d/m/Y'),
												'borrar'	=>	"<button class='btn btn-danger' id='".$d->id_historial_talla_peso."'>Borrar</button>"
											];
				endforeach;

				return Response::json($talla_peso_json);
			}


	}