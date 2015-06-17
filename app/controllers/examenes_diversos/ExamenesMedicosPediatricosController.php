<?php

class ExamenesMedicosPediatricosController extends \BaseController 
	{
		public function crear_examenes_medicos_pediatricos($id_paciente_pediatrico)
			{
/*				$interrogatorio_items = GrupoInterrogatorio::all();
				$interrogatorio_item = CondicionInterrogatorio::all();

				$examen_funcional_items = GrupoExamenFuncional::all();
				$examen_funcional_item = CondicionExamenFuncional::all();

				$examen_fisico_items = GrupoExamenFisico::all();
				$examen_fisico_item = CondicionExamenFisico::all();*/
				
				$paciente = PacientePediatrico::find($id_paciente_pediatrico);

				Session::put('id_paciente_pediatrico', $id_paciente_pediatrico);

				return View::make('pacientes_pediatricos.crear_examenes_medicos_paciente')
						->with(
									[							
										'interrogatorio_items'		=> GrupoInterrogatorio::all(),
										'interrogatorio_item' 		=> CondicionInterrogatorio::all(),
										'examen_funcional_items' 	=> GrupoExamenFuncional::all(),
										'examen_funcional_item'		=> CondicionExamenFuncional::all(),
										'examen_fisico_items'		=> GrupoExamenFisico::all(),
										'examen_fisico_item'		=> CondicionExamenFisico::all(),
										'paciente'					=> $paciente,
									]);

			}
	}