@extends('layouts.master')
@section('formularios')
	{{--FORMULARIO DE CARGA DE DATOS--}}
	@include('formularios.medicos.nuevo_medico')	
@stop
@section('controles_adicionales')
	{{--VALIDACIONES EN JAVASCRIPT PARA LA VISTA ACTUAL --}}
@stop