@extends('layouts.master')
@section('formularios')
	@include('reportes.reportes_estadisticas_pacientes')	
@stop
@section('controles_adicionales')
	{{-- @include('includes.validaciones_examenes_medicos') --}}
@stop
