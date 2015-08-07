<?php

class EstadisticasPacientesController extends \BaseController 
	{		
		public function reportes_graficos()
			{
				return View::make('estadisticas.principal_estadisticas_pacientes');
			}
		public function distribucion_genero()	
			{
				return PacientePediatrico::distribucionPacientesGenero();
			}

		public function distribucion_patologias()	
			{
				return PatologiasPacientePediatrico::distribucionPacientePatologias();
			}
		public function distribucion_pais_nacimiento()	
			{
				return PacientePediatrico::distribucionPacientesPaisNacimiento();
			}
		public function distribucion_pacientes_vacunados()	
			{
				return VacunasPaciente::distribucionPacientesVacunados();
			}
		public function distribucion_pacientes_alergicos()
			{
				return AlergiasPacientePediatrico::distribucionPacientesAlergicos();
			}
	}