<?php

class IntoleranciasController extends \BaseController {

	public function mostrarIntolerancia($intolerancia)
		{
			return Intolerancias::mostrarIntolerancia($intolerancia);
		}

}