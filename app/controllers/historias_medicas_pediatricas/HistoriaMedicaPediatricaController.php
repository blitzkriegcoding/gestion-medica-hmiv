<?php

class HistoriaMedicaPediatricaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /historias_medicas_pediatricas/historiamedicapediatrica
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function nueva_historia_medica_pediatrica($id_paciente_pediatrico)
		{
			#$paciente_pediatrico = PacientePediatrico::find($id_paciente_pediatrico);
			$datos_vista = 	[	'parentesco'		=> 	array_merge ([ 0 =>'SELECCIONE'], Parentesco::lists('parentesco','id_parentesco')),	
								'estado_civil'		=>	array_merge ([ 0 =>'SELECCIONE'], EstadoCivil::lists('estado_civil','id_estado_civil')),
								'grado_instruccion'	=>	array_merge ([ 0 =>'SELECCIONE'], NivelEstudio::lists('nivel_estudio','id_nivel_estudio')),
								'ocupacion_oficio'	=>	array_merge ([ 0 =>'SELECCIONE'], OcupacionOficio::lists('ocupacion_oficio','id_ocupacion_oficio')),
								'paciente'			=> PacientePediatrico::find($id_paciente_pediatrico),
								'paciente_edad'		=> PacientePediatrico::CalculoEdad($id_paciente_pediatrico),
							];



			Session::put('id_paciente_pediatrico', $id_paciente_pediatrico);
			return View::make('historias_medicas_pediatricas.crear_historia_medica_pediatrica')->with($datos_vista);	
		}
	public function crear_historia_medica_pediatrica()	
		{
			$respuesta = HistoriaMediaPediatrica::cargar_paciente_pediatrico(Input::all());
			
			if($respuesta['error_mensajes'] == true)
				{				
					return Redirect::to('/pacientes_pediatricos/creacion_pacientes_pediatricos')->withErrors($respuesta['mensaje'])->withInput();
				}
			else
				{
					return Redirect::to('/pacientes_pediatricos/creacion_pacientes_pediatricos')->with(['mensaje'=>$respuesta['mensaje'],'estilo'=>$respuesta['estilo'] ]);
				}				
		}

}