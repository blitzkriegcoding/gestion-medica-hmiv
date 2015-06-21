<?php

class HistoriaMedicaPediatricaController extends \BaseController {

	public function nueva_historia_medica_pediatrica($id_paciente_pediatrico)
		{	
			Session::put('id_paciente_pediatrico', $id_paciente_pediatrico);		


			$representante_historia = HistoriaMedicaPediatrica::join('parentesco_representantes','parentesco_representantes.id_paciente','=','historia_paciente_pediatrico.id_paciente')
											->where('representante_real','=','1')
											->where('historia_paciente_pediatrico.id_paciente','=', $id_paciente_pediatrico)
											->pluck('codigo_historia_medica');

			/*
				PRIMER CASO: SI TIENE HISTORIA MEDICA BASADA EN LA CONSULTA DE HISTORIAS 
				MEDICAS Y REPRESENTANTES LEGALES
			*/

			if(!is_null($representante_historia) || !empty($representante_historia))
				{
					return "TIENE HISTORIA MEDICA";
				}
			/*
				SEGUNDO CASO: 

			*/
			if(is_null($representante_historia) || empty($representante_historia))
				{
					$representante_legal_actual = ParentescoRepresentantes::where('id_paciente','=',$id_paciente_pediatrico)
													->where('representante_real','=','1')
													->pluck('id_representante');


					if(is_null($representante_legal_actual) || empty($representante_legal_actual))
						{
							$datos_vista = 	[	
												'paciente'			=> 	PacientePediatrico::find($id_paciente_pediatrico),
												'paciente_edad'		=> 	PacientePediatrico::CalculoEdad($id_paciente_pediatrico),
												'examen_fisico'		=> 	ExamenFisicoPediatrico::existeExamen($id_paciente_pediatrico),
												'examen_funcional'	=>	ExamenFuncionalPediatrico::existeExamen($id_paciente_pediatrico), 
												'interrogatorio'	=>	ExamenInterrogatorioPediatrico::existeExamen($id_paciente_pediatrico), 
											];

							$datos_subvista = [	'parentesco'		=> 	array_merge ([ 0 =>'SELECCIONE'], Parentesco::lists('parentesco','id_parentesco')),	
												'estado_civil'		=>	array_merge ([ 0 =>'SELECCIONE'], EstadoCivil::lists('estado_civil','id_estado_civil')),
												'grado_instruccion'	=>	array_merge ([ 0 =>'SELECCIONE'], NivelEstudio::lists('nivel_estudio','id_nivel_estudio')),								
											];

							return View::make('historias_medicas_pediatricas.crear_historia_medica_pediatrica')->with($datos_vista)->nest('formulario_representante_historia','formularios.historias_medicas_pediatricas.vistas_parciales.formulario_representante_historia_pediatrica',$datos_subvista);
						}
					else
						{
							$datos_vista = 	[
												'paciente'			=> 	PacientePediatrico::find($id_paciente_pediatrico),
												'paciente_edad'		=> 	PacientePediatrico::CalculoEdad($id_paciente_pediatrico),
												'examen_fisico'		=> 	ExamenFisicoPediatrico::existeExamen($id_paciente_pediatrico),
												'examen_funcional'	=>	ExamenFuncionalPediatrico::existeExamen($id_paciente_pediatrico), 
												'interrogatorio'	=>	ExamenInterrogatorioPediatrico::existeExamen($id_paciente_pediatrico), 
											];							
							return View::make('historias_medicas_pediatricas.crear_historia_medica_pediatrica')->with($datos_vista)->nest('datos_representante','formularios.historias_medicas_pediatricas.vistas_parciales.aviso_datos_representante_pediatrico');
						}

				}


			
			
		}


	public function crear_historia_medica_pediatrica()	
		{
			$respuesta = HistoriaMedicaPediatrica::cargar_historia_medica(Input::all());
			
			if($respuesta['error_mensajes'] == true)
				{	
					
					return Redirect::to('pacientes_pediatricos/creacion_historia_medica_pediatrica/'.Session::get('id_paciente_pediatrico'))->withErrors($respuesta['mensaje'])->withInput();
				}
			else
				{
					return Redirect::to('pacientes_pediatricos/creacion_historia_medica_pediatrica/'.Session::get('id_paciente_pediatrico'))->with(['mensaje'=>$respuesta['mensaje'],'estilo'=>$respuesta['estilo'],'codigo_historia_medica'=>$respuesta['codigo_historia_medica'],'bandera'=>$respuesta['bandera']]);

				}				
		}



	public function historia_medica_pediatrica_consolidada($id_paciente_pediatrico)
		{
			$codigo_historia_medica = HistoriaMedicaPediatrica::where('id_paciente', '=', $id_paciente_pediatrico)
										->pluck('codigo_historia_medica');
		}


}