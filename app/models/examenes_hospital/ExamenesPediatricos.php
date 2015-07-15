<?php

class ExamenesPediatricos extends \Eloquent 
	{
		protected $fillable = [];
		public $table = 'examenes_pediatricos';
		public $timestamps = false;

		public function HistoriaMedicaPediatrica()
			{
				return $this->belongsTo('HistoriaMedicaPediatrica','id_historia_medica','id_historia_medica');
			}

		public static function obtenerHistoricoExamenes()
			{
				$historico_examenes = self::where('id_paciente','=',Session::get('id_paciente_pediatrico'))
										->join('historia_paciente_pediatrico','examenes_pediatricos.id_historia_medica','=','historia_paciente_pediatrico.id_historia_medica')
											->select('id_examen','fecha_examen', 'nombre_examen')
												->get();
				$examenes_json = [];
				$contador_examenes = 0;

				foreach($historico_examenes as $d):
					$contador_examenes++;
					$nueva_fecha = new Date($d->fecha_examen);
					$examenes_json[] = 	[
											'num_exa'		=>	$contador_examenes,
											'fecha_examen'	=>	$nueva_fecha->date_format('d/m/Y'),
											'nombre_examen'	=>	$d->nombre_examen,
											'detalles'		=>	'pruebas',
											'borrar'		=>	'pruebas'
										];
				endforeach;
				return Response::json($examenes_json);
			}


	}