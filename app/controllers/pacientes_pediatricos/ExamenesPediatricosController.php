<?php
#namespace Controllers\Pacientes_pediatricos;
#use Illuminate\Routing\Controllers\Controller;

class ExamenesPediatricosController extends \BaseController 
{

	public function crear_examenes_paciente_pediatrico()
		{
			//print_r(array_count_values(Input::all()));
			#echo Input::get('interrogatorio_1')." ".Input::get('detalle_interrogatorio_1');
			#print_r(Input::get('interrogatorio'));
			//$cuenta = 1;

			foreach(Input::get('interrogatorio') as $d=>$f):
				print_r($d."\t");
			endforeach;

			#$respuesta = PacientePediatrico



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