<?php

class PaisesController extends \BaseController {


	public static function mostrarPaises($pais)
		{
			return Paises::mostrarPaises($pais);
		}	

}