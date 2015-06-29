<div class="container-fluid">
	<h3>
		Creación de historia médica pediátrica federada
	</h3>
</div><br>
<div class="container">
	<div>
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active text-center" ><a href="#consultas_medicas" aria-controls="consultas_medicas" role="tab" data-toggle="tab" >Consultas<br>Médicas</a></li>
	    <li role="presentation" class="text-center"><a href="#examenes_medicos" aria-controls="examenes_medicos" role="tab" data-toggle="tab" style="text-center">Exámenes<br>Médicos</a></li>
	    <li role="presentation" class="text-center"><a href="#tratamientos_medicos" aria-controls="tratamientos_medicos" role="tab" data-toggle="tab" style="text-center">Tratamientos<br>Médicos</a></li>
	    <li role="presentation" class="text-center"><a href="#patologias_conocidas" aria-controls="patologias_conocidas" role="tab" data-toggle="tab">Patologías</a></li>
	    <li role="presentation" class="text-center"><a href="#alergias_conocidas" aria-controls="alergias_conocidas" role="tab" data-toggle="tab">Alérgias</a></li>
	    <li role="presentation" class="text-center"><a href="#vacunas_aplicadas" aria-controls="vacunas_aplicadas" role="tab" data-toggle="tab">Vacunas</a></li>
	    <li role="presentation" class="text-center"><a href="#intervenciones_quirurgicas" aria-controls="intervenciones_quirurgicas" role="tab" data-toggle="tab">Intervenciones<br>quirúrgicas</a></li>
	    <li role="presentation" class="text-center"><a href="#ingresos_hospitalizacion" aria-controls="ingresos_hospitalizacion" role="tab" data-toggle="tab">Hospitalizacion</a></li>
	    <li role="presentation" class="text-center"><a href="#altas_medicas" aria-controls="altas_medicas" role="tab" data-toggle="tab">Altas<br>medicas</a></li>
	    <li role="presentation" class="text-center"><a href="#ordenes_medicas" aria-controls="ordenes_medicas" role="tab" data-toggle="tab">Ordenes<br>medicas</a></li>
	    <li role="presentation" class="text-center"><a href="#ordenes_enfermeria" aria-controls="ordenes_enfermeria" role="tab" data-toggle="tab">Ordenes por<br>enfermería</a></li>
	  </ul>
	  <!-- Tab panes -->
	  <div class="tab-content">
	    <div role="tabpanel" class="tab-pane fade in active" id="consultas_medicas">
	    	<div class="container col-xs-12">
	    	<h4>
	    		Programación y anulación de consultas
	    	</h4>
	    	<br>
				<div class="col-xs-12">
	    			<div class="row">

		    			<div class="col-xs-5">		    				
								<div class="panel panel-primary">
								  <div class="panel-heading">								  	
								  		Programar consulta médica
								 </div>
								  <div class="panel-body">
								    <div class="form-group">
								    	<label for="fecha_consulta">
								    		Fecha de la consulta:
								    	</label>
								    	 <div class="input-group date" id='fecha_consulta_paciente'>
	                          				{{Form::text('fecha_consulta',NULL ,array('class'=>'form-control','style'=>'width: 100%', 'id'=>'fecha_consulta',  'readonly'=>'' ))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	                        			</div>  
								    	<br>
								    	<label for="especialidad_consulta">
								    		Especialidad de la consulta:
								    	</label>
											{{Form::select('especialidad_consulta',array(''=>'SELECCIONE'),'',array('class'=>'form-control','id'=>'especialidad_consulta','style'=>'width: 100%')) }}
								    	<br><br>
								    	<label for="turno_consulta">
								    		Turno de la consulta:
								    	</label>
								    	 {{Form::select('turno_consulta',[''=>'SELECCIONE','M'=>'MAÑANA','T'=>'TARDE'],'',array('class'=>'form-control', 'id'=>'turno_consulta', 'style'=>'width: 100%')) }}
								    	 <br>								    	 
							    	 	<button type="button" id="carga_consulta" data-loading-text="Cargando..." class="btn btn-primary" autocomplete="off">
										  Cargar consulta
										</button>								    	
								    </div>
								  </div>
								</div>    				
							
		    			</div>
		    			<div class="col-xs-1">
		    				{{-- ESPACIO DE SEPARACION --}}
		    			</div>
		    			<div class="col-xs-5">
		    			{{-- COLAS Y MENSAJES --}}
							<div class="panel panel-primary ">
							  <div class="panel-heading">
							  	Cola de consultas médicas
							  	</div>
							  <div class="panel-body">
							    <div id='cola'>							    	

							    </div>
							    <div id='mensajes'>
							    	
							    </div>

							  </div>
							</div>
						{{--FIN COLAS Y MENSAJES --}}
							<div class="panel panel-primary">
								<div class="panel-heading">
							  		Histórico de consultas médicas del paciente
								</div>
								<div class="panel-body">
							    	<table id="consultas_historico" class="display stripe row-border compact">
									    <thead>
									        <tr>
									            <th>Fecha</th>
									            <th>Especialidad</th>
									            <th>¿Asistió?</th>
									        </tr>
									    </thead>
									    <tbody>
									        <tr>
									            <td>Row 1 Data 1</td>
									            <td>Row 1 Data 2</td>
									            <td>Row 1 Data 3</td>
									        </tr>
									        <tr>
									            <td>Row 2 Data 1</td>
									            <td>Row 2 Data 2</td>
									            <td>Row 2 Data 3</td>
									        </tr>
									    </tbody>
									</table>
								</div>
							</div>

		    			</div>
    			
					</div>
					<div class="row">
						<div class="col-xs-12">
							&nbsp;
						</div>
					</div>
					<div class="row">
    			
					</div>					
						
				</div>	    	


	    	</div>			
	    </div>	    
	    <div role="tabpanel" class="tab-pane fade" id="examenes_medicos">
	    	Seccion de exámenes médicos
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="tratamientos_medicos">
	    	Seccion de tratamientos medicos
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="patologias_conocidas">
	    	Seccion de patologias conocidas
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="alergias_conocidas">
	    	Seccion de alérgias
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="vacunas_aplicadas">
	    	Seccion de Vacunas
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="intervenciones_quirurgicas">
	    	Seccion de Intervenciones quirúrgicas
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="ingresos_hospitalizacion">
	    	Seccion de ingresos por hospitalizacion
	    </div>	
	    <div role="tabpanel" class="tab-pane fade" id="altas_medicas">
	    	Seccion de Altas medicas
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="ordenes_medicas">
	    	Seccion de Altas medicas
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="ordenes_enfermeria">
	    	Seccion de Altas medicas

	    </div>	    
	  </div>
	</div>
</div>
