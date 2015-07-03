@extends('layouts.master')
@section('formularios')
	@include('formularios.busquedas.busqueda_pacientes_representantes')	
@stop
@section('controles_adicionales')
	@include('includes.controles_adicionales_busquedas')
@stop
