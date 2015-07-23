<?php

class TiposAltaMedica extends \Eloquent 
	{
		protected $fillable = ['tipo_alta_medica'];
		public $table 		= 'tipos_alta_medica_pediatrica';		
		public $timestamps 	= false;
		public $primaryKey 	= 'id_alta_medica';

		public static function obtenerTiposAltaMedica()
			{
				$array_alta_medica	= "";
				$array_tipo_alta	= "";

				$altas_medicas 		= self::select('id_alta_medica','tipo_alta_medica')->get();

				#$respuesta_altas = [ ''	=>	'SELECCIONE' ];
				$array_alta_medica[] 	= '';
				$array_tipo_alta[]		= 'SELECCIONE';
				foreach($altas_medicas as $d):
					#$respuesta_altas = array_push([ $d->id_alta_medica => $d->tipo_alta_medica ]);
					$array_alta_medica[] 	= $d->id_alta_medica;
					$array_tipo_alta[]		= $d->tipo_alta_medica;
				endforeach;
				//return ($respuesta_altas);
				$respuesta_altas = array_combine($array_alta_medica, $array_tipo_alta);
				#dd($respuesta_altas);
				return ($respuesta_altas);
				#return self::select('id_alta_medica','tipo_alta_medica')->get();

			}
	}