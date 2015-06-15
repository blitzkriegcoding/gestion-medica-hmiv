<?php
#namespace Controllers\Pacientes_pediatricos;
#use Illuminate\Routing\Controllers\Controller;

class ExamenesPediatricosController extends \BaseController 
{

	public function crear_examenes_paciente_pediatrico()
		{
			$respuesta = PacientePediatrico::crear_examenes_paciente(Input::all());

			if($respuesta['error_mensajes'] == true)
				{	
					return Redirect::to('/pacientes_pediatricos/creacion_examenes_medicos_pediatricos/'.Session::get('id_paciente_pediatrico'))->withErrors($respuesta['mensaje'])->withInput();
				}
			else
				{					
					return Redirect::to('/pacientes_pediatricos/creacion_examenes_medicos_pediatricos/'.Session::get('id_paciente_pediatrico'))->with(['mensaje'=>$respuesta['mensaje']]);
				}
		}




	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /pacientes_pediatricos/examenespediatricos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /pacientes_pediatricos/examenespediatricos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /pacientes_pediatricos/examenespediatricos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /pacientes_pediatricos/examenespediatricos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}