<?php

class PaisesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /paises
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /paises/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /paises
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /paises/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
		{
			
		}
	public function mostrarPaises($pais)
		{
			$paises = Paises::where('pais','LIKE',strtoupper($pais).'%')->get();
			return Response::json($paises);			
		}
		
	/**
	 * Show the form for editing the specified resource.
	 * GET /paises/{id}/edit
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
	 * PUT /paises/{id}
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
	 * DELETE /paises/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}