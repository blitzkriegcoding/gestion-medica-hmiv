<?php

class HistoriaMedicaFederadaController extends \BaseController 
	{
		public function nueva_historia_medica_federada($id_paciente_pediatrico)
			{
				
				Session::put('id_paciente_pediatrico',$id_paciente_pediatrico);
				return View::make('historias_medicas_pediatricas.crear_historia_medica_federada');
			}
		public static function verificar_cola_consultas()
			{
				
				$respuesta = ConsultasPacientePediatrico::verificarColaConsultas(Input::all());
				return $respuesta;
			}
		public function cargar_nueva_consulta_medica()
			{

			}
		public function anular_nueva_consulta_medica()
			{

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