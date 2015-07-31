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
				$datos_paciente = HistoriaMedicaPediatrica::datosPrimariosHistoria($codigo_historia_medica);
									

				$datos_vista = $datos_paciente[0]->toArray();
				return View::make('busquedas.ventana_reporte_pantalla')->with(['datos_primarios'=>$datos_vista]);
			}

	}