<?php

class RepresentanteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /representantes
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /representante/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /representantes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /representante/{id}
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
	 * GET /representante/{id}/edit
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
	 * PUT /representante/{id}
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
	 * DELETE /representante/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function mostrarDireccion($dir)
		{
			$direcciones=DB::table('parroquia')
            ->join('municipio', 'parroquia.id_municipio', '=', 'municipio.id_municipio')
            ->join('estado', 'municipio.id_estado', '=', 'estado.id_estado')            
            ->select(DB::raw("parroquia.id_parroquia as id, (estado.estado || ', ' || municipio.municipio || ', ' || parroquia.parroquia) as text"))
            ->where('parroquia.parroquia','LIKE',strtoupper('%'.$dir.'%'))
            ->get();
			return Response::json($direcciones);
		}

	/*
		Funcion que permite enviar a la vista a traves de ajax,
		la(s) ocupacion(es) de acuerdo a la primera letra escrita y asi
	*/	
	public function mostrarOcupacionOficio($ocupacion)	
		{
			$ocp = DB::table('ocupacion_oficio')
			->select("id_ocupacion_oficio as id",'ocupacion_oficio as text')
			->where('ocupacion_oficio','LIKE',strtoupper($ocupacion).'%')
			->get();
			return Response::json($ocp);	
		}


}