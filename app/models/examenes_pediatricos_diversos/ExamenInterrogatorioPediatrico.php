<?php

class ExamenInterrogatorioPediatrico extends \Eloquent {
	protected $fillable = ['id_paciente','id_condicion_interrogatorio','fecha_interrogatorio','detalles','status'];
	public $table = 'interrogatorio_pediatrico';
	public $timestamps = false;
	public $primaryKey = 'id_interrogatorio';


	public function PacientePediatrico()
		{
			return $this->belongsTo('PacientePediatrico','id_paciente','id_paciente');
		}
	public static function existeExamen($id_paciente_pediatrico)
		{
			$respuesta = [];
			$examenes = 0;
			#= ExamenFisicoPediatrico::find($id_paciente_pediatrico);
			$examenes = DB::table('interrogatorio_pediatrico')
						->where('id_paciente',$id_paciente_pediatrico)						
						->count();
			//dd($examenes);

			if($examenes>=1)
				{
					$respuesta = [	'interrogatorio_medico' => 'Realizado', 
									'clase' 		=> 'label label-success' 
								];
					return $respuesta;
				}

			$respuesta = [	'interrogatorio_medico' => 'No realizado a la fecha', 
							'clase' 		=> 'label label-danger'
						];

			return $respuesta;
		}		


}