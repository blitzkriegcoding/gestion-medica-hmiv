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
		public function obtener_alergias_paciente()	
			{
				return AlergiasPacientePediatrico::obtenerAlergiasPacienteJSON(Input::all());
			}
		public function obtener_intolerancias_paciente()	
			{
				return IntoleranciasPacientePediatrico::obtenerIntoleranciasPacienteJSON(Input::all());
			}

		public function obtener_intolerancias($intolerancia)	
			{
				return Intolerancias::mostrarIntolerancia($intolerancia);
			}
			//obtener_alergias	
		public function obtener_alergias($alergia)	
			{
				return Alergias::mostrarAlergia($alergia);
			}

		public function cargar_alergia_nueva()
			{
				return AlergiasPacientePediatrico::guardarAlergiaPaciente(Input::all());
			}
		public function cargar_intolerancia_nueva()
			{
				return IntoleranciasPacientePediatrico::guardarIntoleranciaPaciente(Input::all());
			}

		public function borrar_alergia_guardada()
			{
				return AlergiasPacientePediatrico::borrarAlergiaPaciente(Input::all());
			}

		public function borrar_intolerancia_guardada()
			{
				return IntoleranciasPacientePediatrico::borrarIntoleranciaPaciente(Input::all());	
			}
		public function obtener_hospitalizacion_paciente()
			{
				return Hospitalizacion::obtenerHistoricoHospitalizacionJSON();
			}
		public function cargar_hospitalizacion_nueva()
			{
				return Hospitalizacion::cargarHospitalizacionNueva(Input::all());
			}
		public function borrar_hospitalizacion_guardada()
			{
				return Hospitalizacion::borrarHospitalizacionGuardada(Input::all());
			}

		public function obtener_historico_examenes()
			{
				return ExamenesPediatricos::obtenerHistoricoExamenes();
			}
		

	}