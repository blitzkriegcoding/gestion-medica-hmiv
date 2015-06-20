<?php

class PacientesPediatricosController extends \BaseController {

	public function nuevo_paciente_pediatrico()
		{
				$medicos = DB::table('medicos')
		                     	->select(DB::raw("id_medico, (primer_nombre || ' ' || segundo_nombre || ' ' || primer_apellido || ' ' || segundo_apellido) as medico"))
		                     		->lists('medico','id_medico');

				$datos_nuevo_paciente =			[	'parentesco'		=> 	array_merge ([ 0 =>'SELECCIONE'], Parentesco::lists('parentesco','id_parentesco')),	
													'estado_civil'		=>	array_merge ([ 0 =>'SELECCIONE'], EstadoCivil::lists('estado_civil','id_estado_civil')),
													'grado_instruccion'	=>	array_merge ([ 0 =>'SELECCIONE'], NivelEstudio::lists('nivel_estudio','id_nivel_estudio')),
													'medicos'			=>	array_merge ([ 0 =>'SELECCIONE'], $medicos),
												];
			return View::make('pacientes_pediatricos.crear_paciente_pediatrico')->with($datos_nuevo_paciente);
		}


	public function crear_paciente_pediatrico()
		{
			//return dd(Input::all());
			$respuesta = PacientePediatrico::cargar_paciente_pediatrico(Input::all());
			
			if($respuesta['error_mensajes'] == true)
				{				
					return Redirect::to('/pacientes_pediatricos/creacion_pacientes_pediatricos')->withErrors($respuesta['mensaje'])->withInput();
				}
			else
				{
					return Redirect::to('/pacientes_pediatricos/creacion_pacientes_pediatricos')->with(['mensaje'=>$respuesta['mensaje'],'estilo'=>$respuesta['estilo'],'bandera'=>$respuesta['bandera']  ]);
				}
		}
}