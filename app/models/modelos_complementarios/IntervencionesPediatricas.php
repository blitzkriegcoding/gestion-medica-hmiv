<?php

class IntervencionesPediatricas extends \Eloquent 
	{
		protected $fillable = 	[ 'id_historia_medica',
								  'descripcion',
								  'fecha_intervencion',
								  'id_medico',
								  'status',
								  'id_tipo_intervencion'
								];

		public $timestamps 	= false;
		public $primaryKey 	= 'id_intervencion';
		public $table 		= 'intervenciones_pediatricas';

		public function HistoriaMedicaPediatrica()
			{
				return $this->belongsTo('HistoriaMedicaPediatrica','id_historia_medica','id_historia_medica');
			}

		public static function obtenerIntervencionesPaciente()
			{
				$intervenciones_json = [];
				$intervenciones	= self::where('id_paciente','=', Session::get('id_paciente_pediatrico'))
									->join('historia_paciente_pediatrico','intervenciones_pediatricas.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
										->join('tipo_intervenciones','intervenciones_pediatricas.id_tipo_intervencion','=','tipo_intervenciones.id_tipo_intervencion')
											->select('fecha_intervencion','status','tipo_intervencion','id_intervencion')
												->get();

				foreach($intervenciones as $d):
					$nueva_fecha = new DateTime($d->fecha_intervencion);
					$intervenciones_json = 	[
												'fecha_intervencion'	=>	$nueva_fecha->format('d/m/Y'),
												'status'				=>	$d->status,
												'tipo_intervencion'		=>	$d->tipo_intervencion
											];
				endforeach;
				return Response::json($intervenciones_json);
			}

		




	}