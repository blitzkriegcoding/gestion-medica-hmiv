@extends('layouts.master')
@section('formularios')
	@include('formularios.pacientes_pediatricos.nuevo_ingreso_paciente_pediatrico_existente')	
@stop
@section('controles_adicionales')
	{{-- @include('includes.validaciones_examenes_medicos') --}}
@stop
