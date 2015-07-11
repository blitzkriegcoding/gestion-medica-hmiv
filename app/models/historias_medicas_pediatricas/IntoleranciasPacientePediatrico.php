<?php

class IntoleranciasPacientePediatrico extends \Eloquent {
	protected $fillable = ['id_historia_medica','id_intolerancia'];
	public $primaryKey = 'id_intolernacia_paciente';
	public $table = 'intolerancias_paciente_pediatrico';
	public $timestamps = false;

	public static function obtenerIntoleranciasPacienteJSON($input)
		{

			$intolerancias_json	=	[];
			$contador_intolerancia	=	0;

			$datos_intolerancia = self::join('historia_paciente_pediatrico',
										'intolerancias_paciente_pediatrico.id_historia_medica',
											'=',
												'historia_paciente_pediatrico.id_historia_medica')
													->join('intolerancias','intolerancias_paciente_pediatrico.id_intolerancia','=','intolerancias.id_intolerancia')
														->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
															->select('intolerancia','id_intolernacia_paciente as id_intolerancia')
																->get();

			foreach($datos_intolerancia as $d):
				$contador_intolerancia ++;

				$intolerancias_json[] = 	[ 
											'num_int' 		=>	$contador_intolerancia,
											'intolerancia'	=>	$d->intolerancia,	
											'borrar'		=>	"<button class='btn btn-danger' id='".$d->id_intolernacia_paciente."'>Borrar</button"

										];
			endforeach;			
			return $intolerancias_json;
		}

}