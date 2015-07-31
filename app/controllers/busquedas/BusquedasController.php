<?php

class BusquedasController extends \BaseController 
	{
		public function crear_nueva_busqueda()
			{
				return View::make('busquedas.crear_busqueda_pacientes_representantes');
			}
		public function generar_busqueda()
			{
				
				$respuesta = PacientePediatrico::generarBusquedaPaciente(Input::all());

				return $respuesta;

			}
		public function generar_busqueda_historia()
			{
				return HistoriaMedicaPediatrica::buscarHistoriaMedica(Input::all());
			}
		public function busqueda_historia_medica()
			{
				return View::make('busquedas.crear_busqueda_historia_medica_pediatrica');
			}
		public function reporte_pantalla($codigo_historia_medica)
			{
				$datos_paciente = HistoriaMedicaPediatrica::where('historia_paciente_pediatrico.id_historia_medica_pediatrica','=',$codigo_historia_medica)
									->join('pacientes_pediatricos','historia_paciente_pediatrico.id_paciente','=', 'pacientes_pediatricos.id_paciente')
										->select('codigo_historia_medica','pacientes_pediatricos.primer_nombre')
											->get();
				

			}

	}