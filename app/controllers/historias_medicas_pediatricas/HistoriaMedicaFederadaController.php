<?php

class HistoriaMedicaFederadaController extends \BaseController 
	{
		public function nueva_historia_medica_federada($id_paciente_pediatrico)
			{				
				Session::put('id_paciente_pediatrico',$id_paciente_pediatrico);
				$consultas_historico 		= ConsultasPacientePediatrico::listarConsultasHistoricoInicial();				
				$vacunas_historico			= VacunasPaciente::obtenerHistoricoVacunas();
				$datos_paciente_historia	= HistoriaMedicaPediatrica::datosPacienteHistoria();

				
				
				return View::make('historias_medicas_pediatricas.crear_historia_medica_federada')->with(['consultas_historico' => $consultas_historico,'vacunas_historico' => $vacunas_historico,'datos_paciente_historia' => $datos_paciente_historia]);

				#$patologias_paciente		= PatologiasPacientePediatrico::obtenerPatologiasPaciente();
				
				return View::make('historias_medicas_pediatricas.crear_historia_medica_federada')->with(
					[
					'consultas_historico' 		=> $consultas_historico,
					'vacunas_historico' 		=> $vacunas_historico,
					'datos_paciente_historia' 	=> $datos_paciente_historia,
					/*'patologias_paciente'		=> $patologias_paciente*/
					]);

			}
		public function verificar_cola_consultas()
			{				
				$respuesta = ConsultasPacientePediatrico::verificarColaConsultas(Input::all());				
				return $respuesta;
			}
		public function cargar_consulta_nueva()
			{
				return ConsultasPacientePediatrico::programarConsulta(Input::all());
			}
		public function cargar_vacuna_nueva()
			{
				return VacunasPaciente::cargarVacuna(Input::all());
			}
		public function recargar_historico_consultas()
			{
				return ConsultasPacientePediatrico::listarConsultasHistoricoJSON();				
			}

		public function anular_consulta_medica()
			{
				return ConsultasPacientePediatrico::anularConsultaMedica(Input::all());
			}

		public function obtener_vacuna($vacuna)	
			{				
				return VacunasPaciente::obtenerVacuna($vacuna);	
			}

		public function obtener_historico_vacunas()
			{
				return VacunasPaciente::obtenerHistoricoVacunasJSON();
			}
		public function borrar_vacuna_aplicada()	
			{
				return VacunasPaciente::borrarVacunaAplicada(Input::all());
			}
		public function obtener_patologias_paciente()
			{
				return PatologiasPacientePediatrico::obtenerPatologiasPacienteJSON();
			}
		public function cargar_patologia_nueva()
			{
				return PatologiasPacientePediatrico::cargarPatologiaNueva(Input::all());

			}

		public function borrar_patologia_guardada()
			{
				return PatologiasPacientePediatrico::borrarPatologiaGuardada(Input::all());
			}

	/*		
		public function anular_nuevo_examen_medico()
			{
				
			}
		public function cargar_nuevo_tratamiento_medico()
			{

			}
		public function cargar_nueva_alergia()
			{

			}
		public function quitar_nueva_alergia()
			{

			}
	*/
		
	}