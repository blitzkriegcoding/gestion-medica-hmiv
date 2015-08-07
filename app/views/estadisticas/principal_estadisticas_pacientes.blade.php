@extends('layouts.master_estadisticas')
@section('formularios')
	@include('reportes.reportes_estadisticas_pacientes')	
@stop
@section('controles_adicionales')
	@include('includes.implementacion_highcharts')
@stop
