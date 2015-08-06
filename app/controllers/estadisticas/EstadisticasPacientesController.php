<?php

class EstadisticasPacientesController extends \BaseController 
	{		
		public function reportes_graficos()
			{
				return View::make('estadisticas.principal_estadisticas_pacientes');
			}
	}