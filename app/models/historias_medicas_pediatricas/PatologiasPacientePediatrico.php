<?php

class PatologiasPacientePediatrico extends \Eloquent {
	protected $fillable = ['id_patologia','id_historia_medica'];
	public $primaryKey 	= 'id_patologia_historia';
	public $timestamps 	= false;
	public $table 		= 'patologias_historia_pediatrica';


	public static function obtenerPatologiasPaciente()
		{
			$cantidad = 0;
			$patologias_paciente = self::join('patologias.id_patologia','=','patologias_historia_pediatrica.id_patologia')
									->join('historia_paciente_pediatrico.id_historia_medica','=','patologias_historia_pediatrica.id_historia_medica')
										->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
											->select('patologias.patologia as pat')
												->get();

					
			foreach($patologias_paciente as $patologia):
				$cantidad ++;
				$pat_json[] = ['num' => $cantidad, 'patologia'=>$patologia->pat];
			endforeach;
			return Response::json($pat_json);
		}
}