@extends('layouts.master')
@section('formularios')
	@include('formularios.historias_medicas_pediatricas.historia_medica_pediatrica_consolidada')	
@stop
@section('controles_adicionales')
	@include('includes.validaciones_historia_medica_federada')
@stop
