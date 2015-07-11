<?php

class AlergiasPacientePediatrico extends \Eloquent {
	protected $fillable = ['id_historia_medica','id_alergia'];
	public $primaryKey 	= 'id_alergia_historia';
	public $timestamps 	= false;
	public $table 		= 'alergias_historia_pediatrica';

	public function Alergias()
		{
			return $this->belongsTo('AlergiasPacientePediatrico','id_alergia','id_alergia');
		}

	public static function obtenerAlergiasPacienteJSON($input)
		{
			$alergias_json	=	[];
			$contador_alergia	=	0;

			$datos_intolerancia = self::join('historia_paciente_pediatrico',
										'alergias_historia_pediatrica.id_historia_medica',
											'=',
												'historia_paciente_pediatrico.id_historia_medica')
													->join('alergias','alergias_historia_pediatrica.id_alergia','=','alergias.id_alergia')
														->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
															->select('alergia','id_alergia_historia as id_alergia')
																->get();

			foreach($datos_intolerancia as $d):
				$contador_alergia ++;

				$alergias_json[] = 	[ 
											'num_ale' 		=>	$contador_alergia,
											'alergia' 		=>	$d->alergia,	
											'borrar'		=>	"<button class='btn btn-danger' id='".$d->id_alergia."'>Borrar</button"

										];
			endforeach;
			#dd($datos_intolerancia);
			return $alergias_json;
		}		

}