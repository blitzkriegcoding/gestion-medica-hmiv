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
				
				$datos_paciente 			= HistoriaMedicaPediatrica::datosPrimariosHistoria($codigo_historia_medica);
				$datos_consultas_medicas 	= ConsultasPacientePediatrico::historicoConsultas($codigo_historia_medica);
				$datos_vacunacion			= VacunasPaciente::reporteHistoricoVacunas($codigo_historia_medica);
				$datos_alergias				= AlergiasPacientePediatrico::reporteAlergiasHistoria($codigo_historia_medica);
				$datos_intolerancias		= IntoleranciasPacientePediatrico::reporteHistoriaIntolerancia($codigo_historia_medica);
				$datos_patologias			= PatologiasPacientePediatrico::reporteHistoriaPatologia($codigo_historia_medica);
				$datos_hospitalizacion		= Hospitalizacion::reporteHistoriaHospitalizacion($codigo_historia_medica);
				$datos_talla_peso			= HistorialTallaPeso::reporteHistoriaTallaPeso($codigo_historia_medica);

				$datos_vista = $datos_paciente[0]->toArray();
				return View::make('busquedas.ventana_reporte_pantalla')->with(	[
																					'datos_primarios'		=>	$datos_vista,
																					'datos_consultas'		=>	$datos_consultas_medicas,
																					'datos_vacunacion'		=>	$datos_vacunacion,
																					'datos_alergias'		=>	$datos_alergias,
																					'datos_intolerancias'	=>	$datos_intolerancias,
																					'datos_patologias'		=>	$datos_patologias,
																					'datos_hospitalizacion'	=>	$datos_hospitalizacion,
																					'datos_talla_peso'		=>	$datos_talla_peso,
																					'datos_edad_paciente'	=>	PacientePediatrico::CalculoEdad($datos_vista['id_paciente'])
																				]
																			);
			}

		public function reporte_pdf($codigo_historia_medica)
			{
				$datos_paciente 			= HistoriaMedicaPediatrica::datosPrimariosHistoria($codigo_historia_medica);
				$datos_consultas_medicas 	= ConsultasPacientePediatrico::historicoConsultas($codigo_historia_medica);
				$datos_vacunacion			= VacunasPaciente::reporteHistoricoVacunas($codigo_historia_medica);
				$datos_alergias				= AlergiasPacientePediatrico::reporteAlergiasHistoria($codigo_historia_medica);
				$datos_intolerancias		= IntoleranciasPacientePediatrico::reporteHistoriaIntolerancia($codigo_historia_medica);
				$datos_patologias			= PatologiasPacientePediatrico::reporteHistoriaPatologia($codigo_historia_medica);
				$datos_hospitalizacion		= Hospitalizacion::reporteHistoriaHospitalizacion($codigo_historia_medica);
				$datos_talla_peso			= HistorialTallaPeso::reporteHistoriaTallaPeso($codigo_historia_medica);
				#$datos_edad_paciente		= PacientePediatrico::CalculoEdad();
				
				$datos_vista = $datos_paciente[0]->toArray();
				#$datos_primarios = $datos_paciente[0]->toArray();
				
				$historia = [
								'datos_primarios'		=>	$datos_vista,
								'datos_consultas'		=>	$datos_consultas_medicas,
								'datos_vacunacion'		=>	$datos_vacunacion,
								'datos_alergias'		=>	$datos_alergias,
								'datos_intolerancias'	=>	$datos_intolerancias,
								'datos_patologias'		=>	$datos_patologias,
								'datos_hospitalizacion'	=>	$datos_hospitalizacion,
								'datos_talla_peso'		=>	$datos_talla_peso,								
								'datos_edad_paciente'	=>	PacientePediatrico::CalculoEdad($datos_vista['id_paciente'])
							];


			    #File::put(public_path('test'.$i.'.pdf'), $content);
				#return View::make('busquedas.ventana_reporte_pdf')->with($historia);							
				$vista_css = View::make('busquedas.ventana_reporte_pdf')->with($historia);
				$contenido = $vista_css->render();
				#return $contenido;
				return PDF::load($contenido)->show($datos_vista['codigo_historia_medica']);

			}


	}