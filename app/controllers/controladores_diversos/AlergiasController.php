<?php

class AlergiasController extends \BaseController {

	public function mostrarAlergia($alergia)
		{
			return Alergias::mostrarAlergia($alergia);
		}

}