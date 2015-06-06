<?php

class PacientesPedriatricosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /pacientes
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /pacientes/create
	 *
	 * @return Response
	 */
	public function /*create()*/crear_paciente_pedi()
		{
			//return dd(Input::all());
			$respuesta = PacientePedriatrico::cargar_paciente_pediatrico(Input::all());
			
			if($respuesta['error_mensajes'] == true)
				{				
					return Redirect::to('creacion_pacientes_pediatricos')->withErrors($respuesta['mensaje'])->withInput();
				}
			else
				{
					return Redirect::to('creacion_pacientes_pediatricos')->with(['mensaje'=>$respuesta['mensaje'],'estilo'=>$respuesta['estilo'] ]);
				}
		}
	/**
	 * Store a newly created resource in storage.
	 * POST /pacientes
	 *
	 * @return Response
	 */
	public function store()
		{
			
		}

	/**
	 * Display the specified resource.
	 * GET /pacientes/{id}
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
	 * GET /pacientes/{id}/edit
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
	 * PUT /pacientes/{id}
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
	 * DELETE /pacientes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}