@extends('layouts.master')
@section('formularios')
	@include('formularios.pacientes_pediatricos.nuevo_examenes_medicos_paciente')	
@stop
@section('controles_adicionales')
	@include('includes.validaciones_examenes_medicos')
@stop
