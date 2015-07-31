<img src="{{ asset('img/cintillo_final.png')}}" alt="cintillo" class="center-block">
<div class="col-md-12">	
		<h3 class="text-center">
			<strong>HISTORIA MÉDICA PEDIÁTRICA</strong>
		</h3>
	
	<br>
	<table class="table table-bordered table-hover table-striped">
		<th colspan="4">
			<h4 class="text-center">Datos primarios del paciente</h4>
		</th>
		<tbody>
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
		</tbody>
	</table>


	<!--  -->
	<br>
	<table class="table table-bordered table-hover table-striped">
		<th colspan="5">
			<h4 class="text-center">Historial de consultas médicas</h4>
		</th>
		<tbody>
		<?php 
			if(!empty($datos_consultas))	
				{
					$filas = 0;
		?>
					<th class="text-center">
						N°
					</th>
					<th class="text-center">
						Fecha Consulta
					</th>
					<th class="text-center">
						Especialidad
					</th>
					<th class="text-center">
						Status
					</th>
					<th class="text-center">
						Diagnostico
					</th>
		<?php
					foreach($datos_consultas as $d):
					$filas++;
					$nueva_fecha = new DateTime($d->fecha_consulta);					
		?>
						<tr>		
							<td class="text-center" >
								<strong>{{ $filas; }} </strong>				
							</td>
							<td class="text-center">
								{{ $nueva_fecha->format('d/m/Y') }}
							</td>
							<td class="text-center">			
								{{ $d->especialidad }}
							</td>
							<td class="text-center">			
								{{ $d->asistio_consulta }}
							</td>							
							<td>
								{{ $d->diagnostico_consulta }}
							</td>			
						</tr>
			<?php
					endforeach;
				 }
			?>
		</tbody>		
	</table>
	<br>
	<table class="table table-bordered table-hover table-striped">
		<th colspan="5">
			<h4 class="text-center">Historial de Vacunas</h4>
		</th>
		<tbody>
		<?php 
			if(!empty($datos_vacunacion))	
				{
					$filas = 0;
		?>
					<th class="text-center">
						N°
					</th>
					<th class="text-center ">
						Fecha Vacunación
					</th>
					<th class="text-center">
						Tipo vacuna
					</th>
					<th class="text-center">
						Edad vacunación
					</th>
					<th class="text-center">
						Refuerzo
					</th>					

		<?php
					foreach($datos_vacunacion as $d):
					$filas++;
					$nueva_fecha = new DateTime($d->fecha_vacunacion);					
		?>
						<tr>		
							<td class="text-center" >
								<strong>{{ $filas; }} </strong>				
							</td>
							<td class="text-center">
								{{ $nueva_fecha->format('d/m/Y') }}
							</td>
							<td class="text-center">			
								{{ $d->tipo_vacuna }}
							</td>
							<td class="text-center">			
								{{ $d->edad }}
							</td>							
							<td class="text-center">
								{{ $d->refuerzo }}
							</td>
						</tr>
			<?php
					endforeach;
				 }
			?>
		</tbody>		
	</table>
	<br>
	<table class="table table-bordered table-hover table-striped">
		<th colspan="2">
			<h4 class="text-center">Historial de Alérgias</h4>
		</th>
		<tbody>
		<?php 
			if(!empty($datos_alergias))	
				{
					$filas = 0;
		?>
					<th class="text-center">
						N°
					</th>
					<th class="text-center ">
						Alérgia
					</th>
		<?php
					foreach($datos_alergias as $d):
					$filas++;
					#$nueva_fecha = new DateTime($d->fecha_vacunacion);					
		?>
						<tr>		
							<td class="text-center" style="width:10%" >
								<strong>{{ $filas }} </strong>				
							</td>
							<td class="text-center">
								{{ $d->alergia }}
							</td>

						</tr>
			<?php
					endforeach;
				 }
			?>
		</tbody>			
	</table>
	<br>
	<table class="table table-bordered table-hover table-striped">
		<th colspan="2">
			<h4 class="text-center">Historial de Intolerancias</h4>
		</th>
		<tbody>
		<?php 
			if(!empty($datos_alergias))	
				{
					$filas = 0;
		?>
					<th class="text-center">
						N°
					</th>
					<th class="text-center ">
						Alérgia
					</th>
		<?php
					foreach($datos_alergias as $d):
					$filas++;
					#$nueva_fecha = new DateTime($d->fecha_vacunacion);					
		?>
						<tr>		
							<td class="text-center" style="width:10%" >
								<strong>{{ $filas }} </strong>				
							</td>
							<td class="text-center">
								{{ $d->alergia }}
							</td>

						</tr>
			<?php
					endforeach;
				 }
			?>
		</tbody>			
	</table>


	<br>
	<table class="table table-bordered table-hover table-striped">
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
	<table class="table table-bordered table-hover table-striped">
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
	<table class="table table-bordered table-hover table-striped">
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
	<table class="table table-bordered table-hover table-striped">
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
