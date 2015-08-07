<?php

/*
	06/08/2015 -10:30
	TE EXTRAÑO <3
	TE QUIERO <3
	ME HACES FALTA <3 

*/

class PatologiasPacientePediatrico extends \Eloquent {
	protected $fillable = ['id_patologia','id_historia_medica'];
	public $primaryKey 	= 'id_patologia_historia';
	public $timestamps 	= false;
	public $table 		= 'patologias_historia_pediatrica';


	public static function obtenerPatologiasPaciente()
		{
			$cantidad = 0;
			$pat_json = [];
			$pat_pac = self::join('patologias','patologias.id_patologia','=','patologias_historia_pediatrica.id_patologia')
									->join('historia_paciente_pediatrico', 'historia_paciente_pediatrico.id_historia_medica','=','patologias_historia_pediatrica.id_historia_medica')
										->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
											->select('patologias.patologia as pat')
												->get();
					
			foreach($pat_pac as $d):
				$cantidad ++;
				$pat_json[] = 	[
									'num_pac' 	=>	$cantidad, 
									'patologia'	=>	$d->pat
								];
			endforeach;
			#dd($pat_json);
			#return Response::json($pat_json);
			return ($pat_json);
		}
	public static function reporteHistoriaPatologia($id_historia_medica)
		{
			$cantidad = 0;
			$pat_json = [];
			$patologia = self::join('patologias','patologias.id_patologia','=','patologias_historia_pediatrica.id_patologia')
									->join('historia_paciente_pediatrico', 'historia_paciente_pediatrico.id_historia_medica','=','patologias_historia_pediatrica.id_historia_medica')
										->where('historia_paciente_pediatrico.id_historia_medica','=', $id_historia_medica)
											->select('patologias.patologia as pat')
												->get();
					

			return ($patologia);
		}		
	public static function obtenerPatologiasPacienteJSON()
		{
			$cantidad = 0;
			$pat_json = [];
			$pat_pac = self::join('patologias','patologias.id_patologia','=','patologias_historia_pediatrica.id_patologia')
									->join('historia_paciente_pediatrico', 'historia_paciente_pediatrico.id_historia_medica','=','patologias_historia_pediatrica.id_historia_medica')
										->where('historia_paciente_pediatrico.id_paciente','=',Session::get('id_paciente_pediatrico'))
											->select('patologias.patologia as pat','id_patologia_historia')
												->get();
					
			foreach($pat_pac as $d):
				$cantidad ++;
				$pat_json[] = 	[
									'num_pac' 	=>	$cantidad, 
									'patologia'	=>	$d->pat,
									'borrar'	=>	"<button class='btn btn-danger' id='".$d->id_patologia_historia."'>Borrar</button"
								];
			endforeach;
			#dd($pat_json);
			return Response::json($pat_json);
			#return ($pat_json);
		}	

public static function cargarPatologiaNueva($input)
	{
		$reglas_validacion_patologia = 	[
											'patologia_detectada' => 'required|exists:patologias,id_patologia'
										];
		$mensajes_error_patologia = [
										'required'	=>	'Patologia detectada es obligatoria',
										'exists'	=>	'Debe seleccionar un valor de la lista'
									];

		$validador_patologias_paciente = Validator::make($input,$reglas_validacion_patologia,$mensajes_error_patologia);

		if($validador_patologias_paciente->fails())
			{		
				return [
							'error_mensajes'	=> 	true,
							'mensaje'			=> 	$validador_patologias_paciente->messages(),
							'clase'				=>	'text text-danger',
							'bandera'			=>	1
						];			
			}

		$codigo_historia_medica = HistoriaMedicaPediatrica::where('id_paciente','=', Session::get('id_paciente_pediatrico'))->pluck('id_historia_medica');

		self::create(
						[	'id_patologia' 			=>	$input['patologia_detectada'],
							'id_historia_medica'	=>	$codigo_historia_medica
						]);
		return [
					'error_mensajes'	=> 	false,
					'mensaje'			=> 	'Patología registrada con éxito',					
					'clase'				=>	'alert alert-success',
					'bandera'			=>	2
				];	

	}

	public static function borrarPatologiaGuardada($input)
		{
			$reglas_eliminacion = 	[
										'id_patologia_historia'	=>	'required|exists:patologias_historia_pediatrica,id_patologia_historia'
									];

			$mensajes_error_eliminacion = 	[
												'required'	=>	'Patologia requerida',
												'exists'	=>	'La patologia que trata de borrar no coincide con los datos del paciente'
											];

			$validador_eliminacion = Validator::make($input, $reglas_eliminacion, $mensajes_error_eliminacion);

			if($validador_eliminacion->fails())
				{
					return [
								'error_mensajes'	=> 	true,
								'mensaje'			=> 	$validador_eliminacion->messages(),
								'clase'				=>	'alert alert-danger',
								'bandera'			=>	1
							];		
				}

			self::destroy($input['id_patologia_historia']);

			return [
						'error_mensajes'	=> 	false,
						'mensaje'			=> 	'Patología eliminada con éxito',					
						'clase'				=>	'alert alert-success',
						'bandera'			=>	2
					];				


		}
	public static function distribucionPacientePatologias()	
		{
				$pacientes_genero_json = [];

				$pacientes_patologias = DB::table('patologias_historia_pediatrica')
				                     ->select(DB::raw('count(patologias.patologia) as cant_patologias, patologias.patologia as pat'))	                     
					                     ->join('historia_paciente_pediatrico','patologias_historia_pediatrica.id_historia_medica','=', 'historia_paciente_pediatrico.id_historia_medica')
						                     ->join('patologias','patologias_historia_pediatrica.id_patologia','=','patologias.id_patologia')	
						                     	->groupBy('patologias.patologia')
						                     		->get();

				foreach($pacientes_patologias as $d):

		 			$fila[0] = $d->pat;
		 			$fila[1] = $d->cant_patologias;
		 			array_push($pacientes_genero_json, $fila);
					 		

				endforeach;
				return json_encode($pacientes_genero_json, JSON_NUMERIC_CHECK);


		}



}


