@if(Session::get('historia_medica_existe') == true):
	<div class="alert alert-info alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Disculpe, usted fue direccionado hasta aquí...</strong>&nbsp;Ya el paciente tiene un código de historia médica creado.
	</div>
@endif
<div class="container-fluid">
	<h3>
		Creación de historia médica pediátrica federada
	</h3>
</div>
<div class="container">
<br>
<div class="panel panel-primary">
  <div class="panel-body">
    Basic panel example
  </div>
</div>
<br>	
</div>
<div class="container" >
<div class="panel panel-primary">
  <div class="panel-body">
    <div >
	  <!-- Nav tabs -->	  
	  {{-- <ul class="nav nav-tabs" role="tablist"> --}}
	  <ul class="nav nav-pills" role="tablist" style="font-size:13px">
	    <li role="presentation" class="active text-center" ><a href="#consultas_medicas" aria-controls="consultas_medicas" role="tab" data-toggle="pill"><span class="badge">1</span><br>Consultas<br>Médicas</a></li>
	    <li role="presentation" class="text-center"><a href="#examenes_medicos" aria-controls="examenes_medicos" role="tab" data-toggle="pill" style="text-center"><span class="badge">2</span><br>Exámenes<br>Médicos</a></li>
	    <li role="presentation" class="text-center"><a href="#tratamientos_medicos" aria-controls="tratamientos_medicos" role="tab" data-toggle="pill" style="text-center"><span class="badge">3</span><br>Tratamientos<br>Médicos</a></li>
	    <li role="presentation" class="text-center" style="height:100%"><a href="#patologias_conocidas" aria-controls="patologias_conocidas" role="tab" data-toggle="pill"><span class="badge">4</span><br>Patologías<br>detectadas</a></li>
	    <li role="presentation" class="text-center"><a href="#alergias_conocidas" aria-controls="alergias_conocidas" role="tab" data-toggle="pill"><span class="badge">5</span><br>Alérgias e<br>Intolernacias</a></li>
	    <li role="presentation" class="text-center"><a href="#vacunas_aplicadas" aria-controls="vacunas_aplicadas" role="tab" data-toggle="pill"><span class="badge">6</span><br>Vacunas<br>recibidas</a></li>
	    <li role="presentation" class="text-center"><a href="#intervenciones_quirurgicas" aria-controls="intervenciones_quirurgicas" role="tab" data-toggle="pill"><span class="badge">7</span><br>Intervenciones<br>quirúrgicas</a></li>
	    <li role="presentation" class="text-center"><a href="#ingresos_hospitalizacion" aria-controls="ingresos_hospitalizacion" role="tab" data-toggle="pill"><span class="badge">8</span><br>Ingreso por<br>Hospitalizacion</a></li>
	    <li role="presentation" class="text-center"><a href="#altas_medicas" aria-controls="altas_medicas" role="tab" data-toggle="pill"><span class="badge">9</span><br>Altas<br>medicas</a></li>
	    <li role="presentation" class="text-center"><a href="#ordenes_medicas" aria-controls="ordenes_medicas" role="tab" data-toggle="pill"><span class="badge">10</span><br>Ordenes<br>medicas</a></li>
	    <li role="presentation" class="text-center"><a href="#ordenes_enfermeria" aria-controls="ordenes_enfermeria" role="tab" data-toggle="pill"><span class="badge">11</span><br>Ordenes por<br>enfermería</a></li>
	  </ul>
	  <!-- Tab panes -->
	  <div class="tab-content" >
	    <div role="tabpanel" class="tab-pane fade in active" id="consultas_medicas" >
	    	<div class="container col-xs-12">
	    	<h4>
	    		Programación y anulación de consultas
	    	</h4>
	    	<br>
				<div class="col-xs-12">
	    			<div class="row">

		    			<div class="col-xs-6">		    				
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
	                        			<div style="display:none" id="fecha_consulta_error" role="alert"></div>

								    	<br>
								    	<label for="especialidad_consulta">
								    		Especialidad de la consulta:
								    	</label>
											{{Form::select('especialidad_consulta',array(''=>'SELECCIONE'),'',array('class'=>'form-control','id'=>'especialidad_consulta','style'=>'width: 100%')) }}
											<div style="display:none" id="especialidad_consulta_error" role="alert"></div>
								    	<br><br>
								    	<label for="turno_consulta">
								    		Turno de la consulta:
								    	</label>
								    	 {{Form::select('turno_consulta',[''=>'SELECCIONE','M'=>'MAÑANA','T'=>'TARDE'],'',array('class'=>'form-control', 'id'=>'turno_consulta', 'style'=>'width: 100%')) }}								    	 
								    	 <div style="display:none" id="turno_consulta_error" role="alert"></div>
								    	 <br><br>
								    	 <div class="col-xs-12">
								    	 	<div class="col-xs-6">
										    	<button type="button" id="visualiza_cola" data-loading-text="Cargando..." class="btn btn-success" style="width:100%" autocomplete="off">
												  Ver cola de pacientes
												</button>								    	 		
								    	 	</div>
								    	 	<div class="col-xs-6">
										    	<button type="button" id="carga_consulta" data-loading-text="Cargando..." class="btn btn-primary" style="width:100%" autocomplete="off">
												  Cargar consulta
												</button>								    	 		
								    	 	</div>								    	 	
								    	 </div>
								    	 <br><br>
								    </div>
								  </div>
								</div>							
		    			</div>

		    			<div class="col-xs-6">
		    			{{-- COLAS Y MENSAJES --}}	
						{{--FIN COLAS Y MENSAJES --}}
							<div class="panel panel-primary">
								<div class="panel-heading">
							  		Histórico de consultas médicas del paciente
								</div>
								<div class="panel-body">
							    	<table id="consultas_historico" class="display compact">
									    <thead>
									        <tr>
									            <th class="text-center">Fecha</th>
									            <th class="text-center">Especialidad</th>
									            <th class="text-center">¿Asistió?</th>
									        </tr>
									    </thead>
									    @if(!empty($consultas_historico))
										    <tbody class="text-center">
											    @foreach($consultas_historico as $llave)
											        <tr>
											            <td>
											            	<?php
											            		$fecha = new DateTime($llave->fecha_consulta);
											            	?>
											            	{{ $fecha->format('d/m/Y') }} </td>
											            <td>{{ $llave->especialidad }}</td>
											            <td>
											            	<?php
											            		if(empty($llave->asistio_consulta))
												            		{
												            			echo "EN PROCESO";
												            		}
											            	?>																
											            </td>
											        </tr>
											    @endforeach										        
										    </tbody>
									   	@endif
									</table>
								</div>
							</div>
							<div style="display:hide" id="cola_consulta" ></div>
							<br>
							<div style="display:hide" id="mensajes_consulta" ></div>

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
	    	{{-- INICIO TAB PANEL --}}
			<div class="col-xs-12">
		    	<h4>
		    		Carga de exámenes médicos
		    	</h4>
		    	<br>
		    	<br>

		    	<div class="col-xs-6">
					<div class="panel panel-primary ">
					  <div class="panel-heading">
					  	Examenes medicos realizados
					  	</div>
					  <div class="panel-body">
					  	<div class="form-group">
							<label for="fecha_examen">
						  		Fecha de realización del examen:
						  	</label>
					    	<div class="input-group date" id='fecha_examen_paciente' style="width:75%">
	              				{{Form::text('fecha_examen',NULL ,array('class'=>'form-control','style'=>'width: 100%', 'id'=>'fecha_examen',  'readonly'=>'' ))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	            			</div>
	            			<label for="medico_ordenante">
	            				Médico ordenante:
	            			</label>
	            				{{Form::select('medico_ordenante',array(''=>'SELECCIONE'),'',array('class'=>'form-control','id'=>'medico_ordenante','style'=>'width: 75%')) }}
	            			<label for="descripcion_examen">
	            				Detalles del exámen:
	            			</label>
	            				{{Form::textarea('descripcion_examen','',array('class'=>'form-control ', 'id'=>'descripcion_examen', 'size'=>'30x4', 'style'=>'resize:none'))}}

					  	</div>
					  </div>
					</div>
		    	</div>
		    	<div class="col-xs-6">
		    		<div class="panel panel-primary ">
					  <div class="panel-heading">
					  	Archivos adjuntos
					  </div>
					  <div class="panel-body">
					  	<div class="form-group">



			              <div class="alert alert-info col-xs-12 column">
			                <div class="col-xs-2 column">
			                  <span class="glyphicon glyphicon-exclamation-sign" style='font-size: 35px;' aria-hidden="true"></span>  
			                </div>
			                <div class="col-xs-10 column">
			                    Apartado para cargar archivos de exámenes<br>
			                      <strong>Instrucciones: </strong>Seleccione uno o más archivos de imagenes (jpg y/o png) o archivos pdf si posee de los examenes realizados.
			                </div>
			              </div>
			              <br>							
	            			<label for="archivos">
	            				Archivos:
	            			</label>

	            				{{-- {{Form::textarea('descripcion_examen','',array('class'=>'form-control ', 'id'=>'descripcion_examen', 'size'=>'30x4', 'style'=>'resize:none'))}} --}}
					  	</div>
					  </div>
					</div>	    		
		    	</div>


			</div>
			{{-- FIN TAB PANEL --}}
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="tratamientos_medicos">
	    	<div class="col-xs-12">
		    	<h4>
		    		Seccion de tratamientos medicos
		    	</h4>    		
	    		
	    	</div>
	    	
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="patologias_conocidas">
	    	Seccion de patologias conocidas
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="alergias_conocidas">
	    	{{-- INICIO PANEL --}}	    	
	    	<div class="col-xs-12">
		    	<h4>
		    		Carga de alérgias
		    	</h4>
		    	<br>
	    		
	    	</div>
	    	{{-- FIN PANEL --}}
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="vacunas_aplicadas">
	    	{{-- INICIO PANEL --}}	    	
	    	<div class="col-xs-12">
		    	<h4>
		    		Carga de vacunas
		    	</h4>
				<br>
		    	<div class="col-xs-5">
					<div class="panel panel-primary ">
					  <div class="panel-heading">
					  	Aplicación de vacunas
					  </div>
					  <div class="panel-body">
					  	<div class="form-group">
							<label for="fecha_examen">
						  		Fecha de aplicación de la vacuna:
						  	</label>
					    	<div class="input-group date" id='fecha_aplicacion_vacuna' style="width:100%">
	              				{{Form::text('fecha_vacuna',NULL ,array('class'=>'form-control','style'=>'width: 100%', 'id'=>'fecha_vacuna',  'readonly'=>'' ))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>	            				
	            			</div>
	            			<div style="display:none" id="fecha_vacuna_error" role="alert"></div>
	            			<br>
	            			<label for="vacuna_aplicada">
	            				Vacuna aplicada:
	            			</label>
	            				{{Form::select('vacuna_aplicada',array(''=>'SELECCIONE'),'',array('class'=>'form-control','id'=>'vacuna_aplicada','style'=>'width: 100%')) }}
	            				<div style="display:none" id="vacuna_aplicada_error" role="alert">
	            					
	            				</div>
	            			<br><br>
	            			<label for="refuerzo_vacuna">
	            				¿Es refuerzo?:
	            			</label>
	            				{{Form::select('refuerzo_vacuna',[''=>'SELECCIONE','S'=>'SI ES REFUERZO','N'=>'NO ES REFUERZO'],'',array('class'=>'form-control','id'=>'refuerzo_vacuna','style'=>'width: 100%')) }}
	            				<div style="display:none" id="refuerzo_vacuna_error" role="alert">
	            					
	            				</div>
					    	 <br><br>
					    	 <div class="col-xs-12">
							    	<button type="button" id="cargar_vacuna" data-loading-text="Cargando..." class="btn btn-success" style="width:100%" autocomplete="off">
									  Aplicar vacuna
									</button>
					    	 </div>
					    	 <br><br>	            			
					  	</div>
					  </div>
					</div>
		    	</div>
		    	<div class="col-xs-7">
					<div class="panel panel-primary ">
					  <div class="panel-heading">
					  	Historico de vacunas
					  </div>
					  <div class="panel-body">
				    	<table id="vacunas_historico" class="display compact">
						    <thead>
						        <tr>
						            <th class="text-center">Fecha vacunación</th>
						            <th class="text-center">Tipo vacuna</th>
						            <th class="text-center">Edad</th>
						            <th class="text-center">Refuerzo</th>
						            <th class="text-center">¿Borrar?</th>
						        </tr>
						    </thead>
						    @if(!empty($vacunas_historico))
							    <tbody class="text-center">
								    @foreach($vacunas_historico as $llave)
								        <tr>
								            <td>
								            	<?php
								            		$fecha = new DateTime($llave->fecha_vacunacion);
								            		echo $fecha->format('d/m/Y');
								            	?>								            	
								            </td>
								            <td>{{ $llave->tipo_vacuna }}</td>
								            <td>
								            	{{ $llave->edad }}																	
								            </td>
								            <td>
								            	<?php
								            		switch($llave->refuerzo)
									            		{
									            			case 'S':
									            				echo 'SI';
									            			break;

									            			case 'N':
									            				echo 'NO';
									            			break;
									            		}
								            	?>
								            </td>
								            <td>
								            	&nbsp;
								            </td>

								        </tr>
								    @endforeach										        
							    </tbody>
						   	@endif
						</table>					  	
					  </div>
					</div>
					<br>
					<div role="alert" id='mensaje_vacuna' style="display:none" >						
					</div>
		    	</div>

	    	</div>
	    	{{-- FIN PANEL --}}
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
</div>


</div>
