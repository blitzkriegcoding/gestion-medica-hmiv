@extends('layouts.master')
@section('formularios')	
<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
			<h2 class="text-center">
				Bienvenid@ al Sistema de Gestión Médica del<br>
				Hospital Materno Infantil de El Valle
			</h2>
			@if(Session::has('error_message'))
                <br><br>
                <div class="col-xs-3"></div>                
                <div class="col-xs-6 text-center alert alert-danger">
                    <h4>
                    	{{ Session::get('error_message') }}
                    </h4>
                </div>                
                <div class="col-xs-3"></div>
            @endif			
		
	
@stop
