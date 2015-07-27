<?php

class TipoIntervenciones extends \Eloquent 
	{
		public $table = 'tipo_intervenciones';
		protected $fillable = ['tipo_intervencion'];
		public $primaryKey = 'id_tipo_intervencion';
		public $timestamps = false;

		public static function obtenerIntervenciones($intervencion)
			{
				$intervenciones = self::select('id_tipo_intervencion','tipo_intervencion')
										->where('tipo_intervencion','like',strtoupper($intervencion."%"))
											->get();
				$intervenciones_json = [];

				foreach($intervenciones as $d):
					$intervenciones_json[] = 	[
													'id_intervencion'	=>	$d->id_tipo_intervencion,
													'intervencion'		=>	$d->tipo_intervencion,
												];
				endforeach;
				return Response::json($intervenciones_json);
			}
		

	}