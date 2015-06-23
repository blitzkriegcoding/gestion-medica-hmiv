<?php
class EspecialidadesMedicasController extends \BaseController 
	{
		public function mostrarEspecialidades($especialidad_medica)
			{
				return EspecialidadesMedicas::mostrarEspecialidades($especialidad_medica);
			}
	}