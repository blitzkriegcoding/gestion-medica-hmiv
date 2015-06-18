<?php
#namespace Controllers\Pacientes_pediatricos;
#use Illuminate\Routing\Controllers\Controller;

class ExamenesPediatricosController extends \BaseController 
	{
		public function crear_examenes_paciente_pediatrico()
			{
				$respuesta = PacientePediatrico::crear_examenes_paciente(Input::all());

				if($respuesta['error_mensajes'] == true)
					{	
						return Redirect::to('/pacientes_pediatricos/creacion_examenes_medicos_pediatricos/'.Session::get('id_paciente_pediatrico'))->withErrors($respuesta['mensaje'])->withInput();
					}
				else
					{					
						return Redirect::to('/pacientes_pediatricos/creacion_examenes_medicos_pediatricos/'.Session::get('id_paciente_pediatrico'))->with(['mensaje'=>$respuesta['mensaje']]);
					}
			}
		public function crear_examenes_medicos_pediatricos($id_paciente_pediatrico)
			{	
				#dd(ExamenFisicoPediatrico::existeExamen($id_paciente_pediatrico));
				$paciente = PacientePediatrico::find($id_paciente_pediatrico);
				$paciente_edad = PacientePediatrico::CalculoEdad($id_paciente_pediatrico);				
				Session::put('id_paciente_pediatrico', $id_paciente_pediatrico);
				return View::make('pacientes_pediatricos.crear_examenes_medicos_paciente')
						->with(	[							
									'interrogatorio_items'		=> GrupoInterrogatorio::all(),
									'interrogatorio_item' 		=> CondicionInterrogatorio::all(),
									'examen_funcional_items' 	=> GrupoExamenFuncional::all(),
									'examen_funcional_item'		=> CondicionExamenFuncional::all(),
									'examen_fisico_items'		=> GrupoExamenFisico::all(),
									'examen_fisico_item'		=> CondicionExamenFisico::all(),
									'paciente'					=> $paciente,
									'paciente_edad'				=> $paciente_edad,
									
								]);
			}		
	}