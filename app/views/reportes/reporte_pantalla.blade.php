<img src="{{ asset('img/cintillo_final.png')}}" alt="cintillo" class="center-block">
<div class="col-md-12">	
		<h3 class="text-center">
			<strong>HISTORIA MÉDICA PEDIÁTRICA</strong>
		</h3>
	
	<br>
	<table class="table table-bordered">
		<th colspan="4">
			<h4 class="text-center">Datos primarios del paciente</h4>
		</th>
		<tr>		
			<td width="25%" >
				<strong>Número de historia:</strong>				
			</td>
			<td width="20%">
				{{ $datos_primarios['codigo_historia_medica'] }}
			</td>
			<td style="padding-left: 10px" width="25%">			
				<strong>Nombres y Apellidos:</strong>			
			</td>
			<td width="25%">
				{{ $datos_primarios['pac_n1'].' '.$datos_primarios['pac_n2'].' '.$datos_primarios['pac_a1'].' '.$datos_primarios['pac_a2'] }}
			</td>			
		</tr>
		<tr>
			<td >
				<strong>Lugar de nacimiento:</strong>				
			</td>
			<td>
				{{ $datos_primarios['lugar_nacimiento'] }}
			</td>
			<td style="padding-left: 10px">			
				<strong>Fecha de nacimiento:</strong>			
			</td>
			<td>
				<?php 
					$nueva_fecha = new DateTime($datos_primarios['fecha_nacimiento']);
					echo $nueva_fecha->format('d/m/Y');
				?>
			</td>			
		</tr>
		<tr>
			<td >
				<strong>Edad:</strong>				
			</td>
			<td>
				XX
			</td>
			<td style="padding-left: 10px">			
				<strong>Sexo:</strong>			
			</td>
			<td>
				<?php
					switch($datos_primarios['sexo'])
					{
						case 'M':
							echo "MASCULINO";
						break;

						case 'F':
							echo 'FEMENINO';
						break;

					}
				?>
			</td>			
		</tr>		
		<tr>
			<td >
				<strong>Direccion actual:</strong>				
			</td>
			<td colspan="3">
				{{ strtoupper($datos_primarios['ave_cal']).', '.strtoupper($datos_primarios['cas_edf']).', '.strtoupper($datos_primarios['parroquia']).', '.strtoupper($datos_primarios['municipio']).', '.strtoupper($datos_primarios['estado']) }}
			</td>		
		</tr>
		<tr>
			<td >
				<strong>Nombres y apellidos del representante:</strong>				
			</td>
			<td>
				{{ $datos_primarios['rep_n1'].' '.$datos_primarios['rep_n2'].' '.$datos_primarios['rep_a1'].' '.$datos_primarios['rep_a2'] }}
				
			</td>
			<td style="padding-left: 10px">			
				<strong>Cédula:</strong>			
			</td>
			<td>
				{{ $datos_primarios['rep_tdoc'].'-'.$datos_primarios['rep_doc'] }}
			</td>			
		</tr>
		<tr>
			<td >
				<strong>País de origen del representante: </strong>				
			</td>
			<td>
				{{ $datos_primarios['pais_origen']}}
			</td>
			<td style="padding-left: 10px">			
				<strong>Teléfono: </strong>			
			</td>
			<td>
				{{ $datos_primarios['rep_tel1']}}
			</td>			
		</tr>
		<tr>
			<td >
				<strong>Parentesco del representante: </strong>				
			</td>
			<td colspan="3">
				{{ $datos_primarios['parentesco_rep']}}
			</td>		
		</tr>
	</table>
	<br>
	<table class="table table-bordered">
		<th colspan="4">
			<h4 class="text-center">Historial de consultas médicas</h4>
		</th>
		<tr>		
			<td >
				<strong>Número de historia:</strong>				
			</td>
			<td>
				V-XXXXXX-XX
			</td>
			<td style="padding-left: 10px">			
				<strong>Nombres y Apellidos:</strong>			
			</td>
			<td>
				XXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXX
			</td>			
		</tr>		
	</table>
	<br>
	<table class="table table-bordered">
		<th colspan="4">
			<h4 class="text-center">Historial de Vacunas</h4>
		</th>
		<tr>		
			<td >
				<strong>Número de historia:</strong>				
			</td>
			<td>
				V-XXXXXX-XX
			</td>
			<td style="padding-left: 10px">			
				<strong>Nombres y Apellidos:</strong>			
			</td>
			<td>
				XXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXX
			</td>			
		</tr>		
	</table>
	<br>
	<table class="table table-bordered">
		<th colspan="4">
			<h4 class="text-center">Historial de Alérgias</h4>
		</th>
		<tr>		
			<td >
				<strong>Número de historia:</strong>				
			</td>
			<td>
				V-XXXXXX-XX
			</td>
			<td style="padding-left: 10px">			
				<strong>Nombres y Apellidos:</strong>			
			</td>
			<td>
				XXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXX
			</td>			
		</tr>		
	</table>
	<br>
	<table class="table table-bordered">
		<th colspan="4">
			<h4 class="text-center">Historial de Patologías</h4>
		</th>
		<tr>		
			<td >
				<strong>Número de historia:</strong>				
			</td>
			<td>
				V-XXXXXX-XX
			</td>
			<td style="padding-left: 10px">			
				<strong>Nombres y Apellidos:</strong>			
			</td>
			<td>
				XXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXX
			</td>			
		</tr>		
	</table>
	<br>
	<table class="table table-bordered">
		<th colspan="4">
			<h4 class="text-center">Historial de Hospitalizacion</h4>
		</th>
		<tr>		
			<td >
				<strong>Número de historia:</strong>				
			</td>
			<td>
				V-XXXXXX-XX
			</td>
			<td style="padding-left: 10px">			
				<strong>Nombres y Apellidos:</strong>			
			</td>
			<td>
				XXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXX
			</td>			
		</tr>		
	</table>

	<br>
	<table class="table table-bordered">
		<th colspan="4">
			<h4 class="text-center">Historial de talla y peso</h4>
		</th>
		<tr>		
			<td >
				<strong>Número de historia:</strong>				
			</td>
			<td>
				V-XXXXXX-XX
			</td>
			<td style="padding-left: 10px">			
				<strong>Nombres y Apellidos:</strong>			
			</td>
			<td>
				XXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXX
			</td>			
		</tr>		
	</table>	
	<br>
	<table class="table table-bordered">
		<th colspan="4">
			<h4 class="text-center">Examenes Médicos</h4>
		</th>
		<tr>		
			<td >
				<strong>Número de historia:</strong>				
			</td>
			<td>
				V-XXXXXX-XX
			</td>
			<td style="padding-left: 10px">			
				<strong>Nombres y Apellidos:</strong>			
			</td>
			<td>
				XXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXX
			</td>			
		</tr>		
	</table>

	
</div>
