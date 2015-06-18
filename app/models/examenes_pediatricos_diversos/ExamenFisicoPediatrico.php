<?php

class ExamenFisicoPediatrico extends \Eloquent {
	protected $fillable = [
							'id_paciente',
							'id_condicion_examen_fisico', 
							'fecha_examen_pediatrico',
							'detalles',
							'status'
							];
	public $table = 'examen_fisico_pediatrico';
	public $timestamps = false;
	public $primaryKey = 'id_examen_fisico_pediatrico';

	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico');
		}

	public static function existeExamen($id_paciente_pediatrico)
		{
			$respuesta = [];
			$examenes = 0;
			#= ExamenFisicoPediatrico::find($id_paciente_pediatrico);
			$examenes = DB::table('examen_fisico_pediatrico')
						->where('id_paciente',$id_paciente_pediatrico)						
						->count();
			//dd($examenes);

			if($examenes>=1)
				{
					$respuesta = [	'examen_fisico' => 'Realizado', 
									'clase' 		=> 'label label-success' 
								];
					return $respuesta;
				}

			$respuesta = [	'examen_fisico' => 'No realizado a la fecha', 
							'clase' 		=> 'label label-danger'
						];

			return $respuesta;
		}

}