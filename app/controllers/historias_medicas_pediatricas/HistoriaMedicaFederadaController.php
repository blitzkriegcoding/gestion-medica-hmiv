<?php

class HistoriaMedicaFederadaController extends \BaseController 
	{
		public function nueva_historia_medica_federada($id_paciente_pediatrico)
			{				
				Session::put('id_paciente_pediatrico',$id_paciente_pediatrico);
				$consultas_historico = ConsultasPacientePediatrico::listarConsultasHistoricoInicial();				
				return View::make('historias_medicas_pediatricas.crear_historia_medica_federada')->with(['consultas_historico' => $consultas_historico]);
			}
		public function verificar_cola_consultas()
			{				
				$respuesta = ConsultasPacientePediatrico::verificarColaConsultas(Input::all());				
				return $respuesta;
			}
		public function cargar_consulta_nueva()
			{
				$respuesta = ConsultasPacientePediatrico::programarConsulta(Input::all());
				return $respuesta;

			}
		public function recargar_historico_consultas()
			{
				$tabla = ConsultasPacientePediatrico::listarConsultasHistoricoJSON();
				return $tabla;
			}
		public function anular_consulta_medica()
			{
				return ConsultasPacientePediatrico::anularConsultaMedica(Input::all());
			}
		public function cargar_nuevo_examen_medico()	
			{

			}
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
		
	}