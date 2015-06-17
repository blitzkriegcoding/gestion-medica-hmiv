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

	public function crear_historia_medica_pediatrica($id_paciente_pediatrico)
		{
			#$paciente_pediatrico = PacientePediatrico::find($id_paciente_pediatrico);
			$datos_vista = 	[	'parentesco'		=> 	array_merge ([ 0 =>'SELECCIONE'], Parentesco::lists('parentesco','id_parentesco')),	
								'estado_civil'		=>	array_merge ([ 0 =>'SELECCIONE'], EstadoCivil::lists('estado_civil','id_estado_civil')),
								'grado_instruccion'	=>	array_merge ([ 0 =>'SELECCIONE'], NivelEstudio::lists('nivel_estudio','id_nivel_estudio')),
								'ocupacion_oficio'	=>	array_merge ([ 0 =>'SELECCIONE'], OcupacionOficio::lists('ocupacion_oficio','id_ocupacion_oficio'))
							];
			return View::make('historias_medicas_pediatricas.crear_historia_medica_pediatrica')->with($datos_vista);	
		}

}