<?php

class AuthController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function iniciar_sesion()
		{
			$usuario	= Input::get('usuario');
			$password 	= Input::get('password');
			if (Auth::attempt(['username' => strtolower($usuario), 'password' => $password]))
		        {
		            return Redirect::to('principal');
		        }
	        
			return Redirect::back()->with('error_message', 'Datos de inicio de sesión inválidos')->withInput();
		}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function cerrar_sesion()
		{
	        Session::flush();
			Auth::logout();
	        return Redirect::to('/');
		}


}
