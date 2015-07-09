<?php

class PatologiasController extends \BaseController 
	{
		public function mostrarPatologia($patologia)
			{
				return Patologias::mostrarPatologia($patologia);
			}

		public function PatologiasPaciente()
			{
				return PatologiasPaciente::obtenerPatologiasPaciente();
			}
	}