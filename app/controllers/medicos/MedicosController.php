<?php

class MedicosController extends \BaseController 
{
	public function crear_nuevo_medico()
		{
			$datos_vista =	[	
								'tipo_medico'		=>	array_merge ([ 0 => 'SELECCIONE'], TipoMedico::lists('tipo_medico','id_tipo_medico')),
								'estado_civil'		=>	array_merge ([ 0 => 'SELECCIONE'], EstadoCivil::lists('estado_civil','id_estado_civil')),
								'grado_instruccion'	=>	array_merge ([ 0 => 'SELECCIONE'], NivelEstudio::lists('nivel_estudio','id_nivel_estudio')),																
								'relacion_medico'	=>	array_merge ([ 0 => 'SELECCIONE'], RelacionMedicoContacto::lists('relacion_medico','id_relacion_medico'))
							];
			return View::make('medicos.crear_medico')->with($datos_vista);
		}
	public function nuevo_medico()
		{
			
			$respuesta = Medicos::cargarMedico(Input::all());			

			if($respuesta['error_mensajes'] == true)
				{	
					
					return Redirect::to('medicos/creacion_medicos/')->withErrors($respuesta['mensaje'])->withInput();
				}
			else
				{
					return Redirect::to('medicos/creacion_medicos/')->with(['mensaje'=>$respuesta['mensaje'],'estilo'=>$respuesta['estilo'],'bandera'=>$respuesta['bandera']]);

				}			
		}

}