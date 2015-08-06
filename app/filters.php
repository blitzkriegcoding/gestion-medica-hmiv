<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
		{
			if (Request::ajax())
				{
					return Response::make('Unauthorized', 401);
				}
			else
				{
					return Redirect::guest('/');
				}
		}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*FILTROS BASADOS EN ENTRUST PARA EL ACCESO A OPCIONES DEL SISTEMA*/

///PACIENTES PEDIATRICOS
Route::filter('nuevo_paciente', function()
	{
	    if (!Entrust::can('nuevo_paciente') )
			{	        
				return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});

Route::filter('busqueda_paciente', function()
	{
	    if (!Entrust::can('busqueda_paciente') )
		    {
		        return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});

Route::filter('modificacion_paciente', function()
	{
	    if (!Entrust::can('modificacion_paciente') )
		    {
		        return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});

Route::filter('baja_paciente', function()
	{
	    if (!Entrust::can('baja_paciente') )
		    {
		        return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});

///FIN PACIENTES PEDIATRICOS

///HISTORIAS MEDICAS
Route::filter('creacion_historia', function()
	{
	    if (!Entrust::can('creacion_historia') )
		    {
		        return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});

Route::filter('busqueda_historia', function()
	{
	    if (!Entrust::can('busqueda_historia') )
		    {
		        return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});

Route::filter('reporte_pantalla', function()
	{
	    if (!Entrust::can('reporte_pantalla') )
		    {
		        return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});

Route::filter('reporte_pdf', function()
	{
	    if (!Entrust::can('reporte_pdf') )
		    {
		        return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});
///FIN HISTORIAS MEDICAS

////MEDICOS
Route::filter('nuevo_medico', function()
	{
	    if (!Entrust::can('nuevo_medico') )
			{	        
				return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});

Route::filter('busqueda_medico', function()
	{
	    if (!Entrust::can('busqueda_medico') )
			{	        
				return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});

Route::filter('modificacion_medico', function()
	{
	    if (!Entrust::can('modificacion_medico') )
			{	        
				return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});

////FIN MEDICOS

//ESTADISTICAS
Route::filter('estadisticas_pacientes', function()
	{
	    if (!Entrust::can('estadisticas_pacientes'))
		    {
		        return Redirect::to('principal')->with('error_message', 'No esta autorizado para acceder a esa opción');
		    }
	});
//FIN ESTADISTICAS
/*

Route::filter('crear_usuarios', function()
	{
	    if (!Entrust::can('crear_roles') )
		    {
		        return Redirect::guest('/');
		    }
	});

Route::filter('editar_usuarios', function()
	{
	    if (!Entrust::can('editar_roles') )
	    {
	        return Redirect::guest('/');
	    }
	});

Route::filter('eliminar_usuarios', function()
	{
	    if (!Entrust::can('eliminar_roles') )
	    {
	        return Redirect::guest('/');
	    }
	});

*/
