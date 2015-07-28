@extends('layouts.master')
@section('formularios')
	@include('formularios.busquedas.busqueda_historias_medicas_pediatricas')	
@stop
@section('controles_adicionales')
	@include('includes.controles_adicionales_busqueda_historia')
@stop