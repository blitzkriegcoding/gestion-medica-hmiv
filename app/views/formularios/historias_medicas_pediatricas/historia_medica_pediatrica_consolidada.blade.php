
@if(Session::get('historia_medica_existe') == true):
	<div class="alert alert-info alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Disculpe, usted fue direccionado hasta aquí...</strong>&nbsp;Ya el paciente tiene un código de historia médica creado.
	</div>
@endif
<div class="container">
<div class="col-xs-12">
	<h3>
		Creación de historia médica pediátrica federada
	</h3>
</div>
	
</div>

<div class="container">
<br>
<div class="panel panel-primary">
  <div class="panel-body">
    <strong>Paciente: </strong>{{ $datos_paciente_historia[0]->p_nombre." ".$datos_paciente_historia[0]->s_nombre." ".$datos_paciente_historia[0]->p_apellido." ".$datos_paciente_historia[0]->s_apellido }}<br><strong>Código historia médica: </strong>{{ $datos_paciente_historia[0]->cod_his }}
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
		    			<div class="col-xs-5">		    				
							<div class="panel panel-primary">
							  <div class="panel-heading">								  	
							  		<strong>Programar consulta médica</strong>
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
											  Ver cola
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

		    			<div class="col-xs-7">
		    			{{-- COLAS Y MENSAJES --}}	
						{{--FIN COLAS Y MENSAJES --}}
							<div class="panel panel-primary">
								<div class="panel-heading">
							  		<strong>Histórico de consultas médicas del paciente</strong>
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
									    <tbody class="text-center">									        
										</tbody>									   	
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
		    	<div class="col-xs-5">
					<div class="panel panel-primary ">
					  <div class="panel-heading">
					  	<strong>Exámenes médicos realizados </strong>
					  	</div>
					  <div class="panel-body">
					  	<div class="form-group">
							<label for="fecha_examen">
						  		Fecha de realización del examen:
						  	</label>
					    	<div class="input-group date" id='fecha_examen_paciente' style="width:75%">
	              				{{Form::text('fecha_examen',NULL ,array('class'=>'form-control','style'=>'width: 100%', 'id'=>'fecha_examen',  'readonly'=>'' ))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	            			</div><br>
	            			<label for="medico_ordenante">
	            				Médico ordenante:
	            			</label>
	            				{{Form::select('medico_ordenante',array(''=>'SELECCIONE'),'',array('class'=>'form-control','id'=>'medico_ordenante','style'=>'width: 100%')) }}
	            			<br>
	            			<label for="descripcion_examen">
	            				Detalles del exámen:
	            			</label>
	            				{{Form::textarea('descripcion_examen','',array('class'=>'form-control ', 'id'=>'descripcion_examen', 'size'=>'30x4', 'style'=>'resize:none'))}}

					  	</div>
					  </div>
					</div>
		    	</div>
		    	<div class="col-xs-7">
		    		<div class="panel panel-primary ">
					  <div class="panel-heading">
					  	<strong>Archivos adjuntos </strong>
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
	    	<div class="col-xs-12">
		    	<h4>
		    		Seccion de patologias conocidas
		    	</h4>
		    	<br>
				<div class="col-xs-12">				
		    	<div class="col-xs-6">
					<div class="panel panel-primary ">
					  <div class="panel-heading">
					  	<strong>Selección de patologías del paciente</strong>
					  </div>
					  <div class="panel-body">
					  	<div class="form-group">
	            			<label for="patologia_detectada">
	            				Patología detectada:
	            			</label>
	            				{{Form::select('patologia_detectada',array(''=>'SELECCIONE'),'',array('class'=>'form-control','id'=>'patologia_detectada','style'=>'width: 100%')) }}
	            				<div style="display:none" id="patologia_detectada_error" role="alert">	            					
	            				</div>
							<br>
							<br>
							<div class="col-xs-12">
							    	<button type="button" id="guardar_patologia" data-loading-text="Cargando..." class="btn btn-success" style="width:100%" autocomplete="off">
									  Guardar
									</button>
							</div>
					    	 <br>
					  	</div>
					  </div>
					</div>
		    	</div>
		    	<div class="col-xs-6">
					<div class="panel panel-primary ">
					  <div class="panel-heading">
					  	<strong>Patologías definidas en la apertura de la historia</strong>
					  </div>
					  <div class="panel-body">
				    	<table id="patologias_historico" class="display compact">
						    <thead>
						        <tr>
						        	<th class="text-center">N°</th>
						            <th class="text-center">Patología conocida</th>
						            <th class="text-center">¿Borrar?</th>
						        </tr>
						    </thead>						    
							<tbody class="text-center">							
							</tbody>
						</table>					  	
					  </div>
					</div>
					<br>
					<div role="alert" id='mensaje_patologia' style="display:none" >						
					</div>
		    	</div>
	    	</div>

	    	</div>	    	
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="alergias_conocidas">
	    	{{-- INICIO PANEL --}}	    	
	    	<div class="col-xs-12">
		    	<h4>
		    		Carga de alérgias
		    	</h4><br>
				<div class="col-xs-12">				
			    	<div class="col-xs-6">
						<div class="panel panel-primary ">
						  <div class="panel-heading">
						  	<strong>Selección de alérgias/intolerancias del paciente</strong>
						  </div>
						  <div class="panel-body">
						  	<div class="form-group">
		            			<label for="alergia_detectada">
		            				Alérgia detectada:
		            			</label>
	            				{{Form::select('alergia_detectada',array(''=>'SELECCIONE'),'',array('class'=>'form-control','id'=>'alergia_detectada','style'=>'width: 100%')) }}
	            				<div style="display:none" id="alergia_detectada_error" role="alert">	            					
	            				</div>																
						  	</div>
								
							<div class="col-xs-12">
						    	<button type="button" id="guardar_alergia" data-loading-text="Cargando..." class="btn btn-success" style="width:100%" autocomplete="off">
								  Guardar
								</button>
							</div>
								<br><br><br>
						  	<div class="form-group">
		            			<label for="intolerancia_detectada">
		            				Intolerancia detectada:
		            			</label>
		            				{{Form::select('intolerancia_detectada',array(''=>'SELECCIONE'),'',array('class'=>'form-control','id'=>'intolerancia_detectada','style'=>'width: 100%')) }}
		            				<div style="display:none" id="intolerancia_detectada_error" role="alert">	            					
		            				</div>
								<br><br>
									<div class="col-xs-12">
									    	<button type="button" id="guardar_intolerancia" data-loading-text="Cargando..." class="btn btn-success" style="width:100%" autocomplete="off">
											  Guardar
											</button>
									</div>
								<br>
									
						  	</div>						  	
						  </div>
						</div>
						<br>
						<div role="alert" id='mensaje_alergia_intolerancia' style="display:none">
						</div>							
			    	</div>
			    	<div class="col-xs-6">
						<div class="panel panel-primary">
						  <div class="panel-heading">
						  	<strong>Alérgias definidas en la apertura de la historia</strong>
						  </div>
						  <div class="panel-body">
					    	<table id="alergias_historico" class="display compact">
							    <thead>
							        <tr>
							        	<th class="text-center">N°</th>
							            <th class="text-center">Alergia</th>
							            <th class="text-center">¿Borrar?</th>
							        </tr>
							    </thead>
								<tbody class="text-center">							
								</tbody>
							</table>
						  </div>
						</div>						

						<br>
						<div class="panel panel-primary">
						  <div class="panel-heading">
						  	<strong>Intolerancias definidas en la apertura de la historia</strong>
						  </div>
						  <div class="panel-body">
					    	<table id="intolerancias_historico" class="display compact">
							    <thead>
							        <tr>
							        	<th class="text-center">N°</th>
							            <th class="text-center">Intolerancia</th>
							            <th class="text-center">¿Borrar?</th>
							        </tr>
							    </thead>
								<tbody class="text-center">							
								</tbody>
							</table>
						  </div>
						</div>							

			    	</div>
	    	</div>			    	
		    	
	    		
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
					  	<strong>Aplicación de vacunas</strong>
					  </div>
					  <div class="panel-body">
					  	<div class="form-group">
							<label for="fecha_aplicacion_vacuna">
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
					  	<strong>Historico de vacunas</strong>
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
	    	<div class="col-xs-12">
		    	<h4>
		    		Seccion de Intervenciones quirúrgicas
		    	</h4>
		    	<br>	    		
	    	</div>		    	
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="ingresos_hospitalizacion">
	    	<div class="col-xs-12">
	    		<h4>Sección de ingresos por hospitalización</h4>
	    		<br>
		    	<div class="col-xs-4">
					<div class="panel panel-primary ">
					  <div class="panel-heading">
					  	<strong>Datos de ingreso por hospitalización</strong>
					  	</div>
					  <div class="panel-body">
					  	<div class="form-group">
							<label for="fecha_hospitalizacion">
						  		Fecha de hospitalización:
						  	</label>
					    	<div class="input-group date" id='fecha_hospitalizacion_paciente' style="width:75%">
	              				{{Form::text('fecha_hospitalizacion',NULL ,array('class'=>'form-control','style'=>'width: 100%', 'id'=>'fecha_hospitalizacion',  'readonly'=>'' )) }} <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	            			</div>
	            			<div style="display:none" id="fecha_hospitalizacion_error" role="alert"></div>
	            			<br>
	            			<label for="piso">
	            				Piso:
	            			</label>
	            				{{Form::select('piso_hospitalizacion',array(''=>'SELECCIONE','1' => 'PISO 1','2' => 'PISO 2', '3' => 'PISO 3', '4' => 'PISO 4'  ),'',array('class'=>'form-control','id'=>'piso_hospitalizacion','style'=>'width: 75%')) }}
	            				<div style="display:none" id="piso_hospitalizacion_error" role="alert"></div>
	            			<br>
	            			<label for="sala">
	            				Sala:
	            			</label>
	            				{{Form::text('sala_hospitalizacion',NULL ,array('class'=>'form-control','style'=>'width: 75%', 'id'=>'sala_hospitalizacion'))}}
								<div style="display:none" id="sala_hospitalizacion_error" role="alert"></div>
							<br>	            			
	            			<label for="codigo_cama">
	            				Código cama:
	            			</label>	            				
	            				{{Form::text('codigo_cama_hospitalizacion',NULL ,array('class'=>'form-control','style'=>'width: 75%', 'id'=>'codigo_cama_hospitalizacion'))}}
	            				<div style="display:none" id="codigo_cama_hospitalizacion_error" role="alert"></div>
							<br>
	            			<label for="observaciones_hospitalizacion">
	            				Observaciones de hospitalización
	            			</label>
	            				{{Form::textarea('observaciones_hospitalizacion','',array('class'=>'form-control ', 'id'=>'observaciones_hospitalizacion', 'size'=>'20x6', 'style'=>'resize:none'))}}
	            				<div style="display:none" id="observaciones_hospitalizacion_error" role="alert"></div>
					    	<br>
					    	<div class="col-xs-12">
							   	<button type="button" id="carga_hospitalizacion" data-loading-text="Cargando..." class="btn btn-success" style="width:100%" autocomplete="off">
										Guardar hospitalización
								</button>
					    	</div>
					  	</div>
					  </div>
					</div>
		    	</div>
		    	<div class="col-xs-8">
					<div class="panel panel-primary ">
					  <div class="panel-heading">
					  	<strong>Historico de hospitalización</strong>
					  </div>
					  <div class="panel-body">
				    	<table id="historico_hospitalizacion" class="display compact">
						    <thead>
						        <tr>
						            <th class="text-center" style="width:5%">N°</th>
						            <th class="text-center">Fecha</th>
						            <th class="text-center">Piso</th>
						            <th class="text-center">Sala</th>
						            <th class="text-center">Cama</th>
						            <th class="text-center">¿Alta?</th>
						            <th class="text-center">¿Borrar?</th>						            
						            <th class="text-center">Detalles</th>
						        </tr>
						    </thead>						    
							<tbody class="text-center">									        
							</tbody>
						</table>					  	
					  </div>
					</div>
					<br>

				<div class="alert alert-info alert-dismissible text-center" role="alert" id='mensaje_hospitalizacion' style="display:none">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>				  
				</div>					
		    	</div>
	    	</div>
	    </div>	
	    <div role="tabpanel" class="tab-pane fade" id="altas_medicas">
	    	<div class="col-xs-12">
	    		<h4>Seccion de Altas medicas</h4>
	    	</div> 
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
{{-- VENTANA MODAL PARA CERRAR LAS CONSULTAS MEDICAS --}}

<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Cierre de consulta medica</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">.col-md-4</div>
            <div class="col-md-4 col-md-offset-4">.col-md-4 .col-md-offset-4</div>
          </div>
          <div class="row">
            <div class="col-md-3 col-md-offset-3">.col-md-3 .col-md-offset-3</div>
            <div class="col-md-2 col-md-offset-4">.col-md-2 .col-md-offset-4</div>
          </div>
          <div class="row">
            <div class="col-md-6 col-md-offset-3">.col-md-6 .col-md-offset-3</div>
          </div>
          <div class="row">
            <div class="col-sm-9">
              Level 1: .col-sm-9
              <div class="row">
                <div class="col-xs-8 col-sm-6">
                  Level 2: .col-xs-8 .col-sm-6
                </div>
                <div class="col-xs-4 col-sm-6">
                  Level 2: .col-xs-4 .col-sm-6
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar ventana</button>
        <button type="button" class="btn btn-primary">Cerrar consulta</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
