<?php

class PatologiasController extends \BaseController 
	{
		public function mostrarPatologia($patologia)
		{
			return Patologias::mostrarPatologia($patologia);
		}
	}