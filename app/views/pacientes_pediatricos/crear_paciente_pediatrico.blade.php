@extends('layouts.master')
@section('formularios')
	@include('formularios.pacientes_pediatricos.nuevo_paciente_pediatrico')	
@stop
@section('controles_adicionales')
	@include('includes.controles_adicionales_nuevo_paciente')
@stop
