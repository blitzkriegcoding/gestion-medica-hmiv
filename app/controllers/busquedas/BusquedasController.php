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

	}