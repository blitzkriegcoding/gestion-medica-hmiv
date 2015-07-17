<?php

class PatologiasController extends \BaseController 
	{
		public function mostrar_patologia($patologia)
			{
				return Patologias::mostrarPatologia($patologia);
			}



	}