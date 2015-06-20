
@if (Session::get('mensaje'))
  <!-- Si hay un mensaje, entonces lo imprimimos y le damos estilo con bootstrap -->
  <div class="container-fluid" style="width: 430px; margin: 0 auto;">
    <div class="{{Session::get('estilo')}} col-md-12 column" >
      <div class="col-md-2 column text-center" >
        <span class="{{Session::get('bandera')}}" style='font-size: 25px;' aria-hidden="true"></span>  
      </div>
      <div class="col-md-10 column">
        {{ Session::get('mensaje')."<br>"}}
        @if(Session::get('codigo_historia_medica'))
          <strong>{{Session::get('codigo_historia_medica') }}</strong>
        @endif
      </div>
    </div>
  </div>
<br><br>
@endif
<h4 class="panel-body alineacion_paneles"><strong>Creación de historias médicas pediátricas</strong></h4>
<div class="panel-body col-xs- col-sm- col-md- col-lg- alineacion_paneles" >
	<div class="fuelux">
		<div class="wizard" data-initialize="wizard" id="historia_medica_pediatrica">		  
		    <ul class="steps">
		      <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Identificación del Paciente<span class="chevron"></span></li>
		      <li data-step="2"><span class="badge">2</span>Representante legal actual<span class="chevron"></span></li>
		      <li data-step="3" data-name="template"><span class="badge">3</span>Alérgias, afecciones y tratamientos<span class="chevron"></span></li>
		    </ul>		  
		  <div class="actions">
		    <button type="button" class="btn btn-default btn-prev"><span class="glyphicon glyphicon-arrow-left"></span>Anterior</button>
		    <button type="button" class="btn btn-default btn-next" data-last="Guardar">Siguiente<span class="glyphicon glyphicon-arrow-right"></span></button>
		  </div>
		  {{ Form::open(['action'=>'HistoriaMedicaPediatricaController@crear_historia_medica_pediatrica','method'=>'post','class'=>'clearfix','id'=>'formulario_principal'])}}
		  <div class="step-content">
		    <div class="step-pane active sample-pane alert" data-step="1">
		      {{-- <h4>Resumen sobre el/la paciente</h4> --}}
				<div class="panel panel-primary" style="width: 75%; margin: 0 auto">
				  <!-- Default panel contents -->
				  <div class="panel-heading">
            <h4>
              <strong> RESUMEN DE DATOS BÁSICOS DEL PACIENTE</strong>
            </h4>
          </div>
				  <div class="panel-body " >	
						<div class="row clearfix">
							<div class="col-md-12 column">
								<div class="row clearfix">
									<div class="col-md-1 column">
									</div>
									<div class="col-md-10 column">										
                    <table style="width: 100%">
                      <tr>
                          <td style="width: 35%">
                          <h4 class="list-group-item-heading">
                            <strong>Nombres:</strong>
                          </h4>
                          <p class="list-group-item-text">
                            <h4>{{ $paciente['primer_nombre']." ".$paciente['segundo_nombre'] }}</h4>
                          </p>                         
                        </td>
                        <td style="width: 35%">
                          <h4 class="list-group-item-heading">
                            <strong>Apellidos: </strong>
                          </h4>
                          <p class="list-group-item-text">
                            <h4>{{ $paciente['primer_apellido']." ".$paciente['segundo_apellido'] }}</h4>
                          </p>                          
                        </td>
                        <td rowspan="2">                          
                          <div style="align: center" class="thumbnail">
                            <img src="{{ $paciente['fotografia'] }}"  style="width:50%; margin: 0 auto"  alt="imagen_paciente" >                         
                            <div class="caption">
                              <p class="text-center"><strong>Fotografía del paciente</strong></p>
                            </div>
                          </div>
                        </div>
                        </td>
                      </tr>
                      <tr>
                          <td>
                          <h4 class="list-group-item-heading">
                            <strong>Fecha de nacimiento:</strong>
                          </h4>
                          <p class="list-group-item-text">
                            <h4>{{ date('d/m/Y', strtotime($paciente['fecha_nacimiento'])) }}</h4>
                          </p>                         
                        </td>
                        <td>
                          <h4 class="list-group-item-heading">
                            <strong>Edad: </strong>
                          </h4>
                          <p class="list-group-item-text">
                            <h4>{{ $paciente_edad[0]->edad }}</h4>
                          </p>                          
                        </td>
                        <td >
                          &nbsp;                          
                        </td>
                      </tr>
                      <tr >
                        <td colspan="3" >
                          &nbsp;
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3">
                          <h4 class="list-group-item-heading">
                            <strong>Datos adicionales: </strong>
                          </h4>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3">
                        <table style="width:100%">                            
                              <tr>
                                <td class="list-group-item-text" style="width:50%">
                                 <h4>Interrogatorio médico:</h4>
                                </td>
                                <td style="width:50%">
                                  <h4><span class="{{ $interrogatorio['clase'] }} " >{{ $interrogatorio['interrogatorio_medico'] }}</span></h4>
                                </td>
                              </tr>
                              <tr>
                                <td class="list-group-item-text">
                                  <h4>Examen físico:</h4>
                                </td>
                                <td>
                                  <h4><span class="{{ $examen_fisico['clase'] }} " >{{ $examen_fisico['examen_fisico'] }}</span></h4>
                                </td>
                              </tr>
                              <tr>
                                <td class="list-group-item-text">
                                  <h4>Examen Funcional:</h4>
                                </td>
                                <td>
                                  <h4><span class="{{ $examen_funcional['clase'] }} " >{{ $examen_funcional['examen_funcional'] }}</h3>
                                </td>
                              </tr>                            
                          </table>
                          
                        </td>
                      </tr>

                    </table>										
										</div>
									</div>

							</div>
				  </div>
				</div></div>
		    </div>
        {{--INICIO PANEL 2 REPRESENTANTE --}}
		    <div class="step-pane active sample-pane alert" data-step="2">
        <?php           
            if(isset($formulario_representante_historia))
              {
                echo $formulario_representante_historia;
              }
            else
              {
                echo $datos_representante;
              }
        ?>		      
		    </div>
        {{--FIN PANEL 2 REPRESENTANTE --}}
		    <div class="step-pane active sample-pane alert" data-step="3">
		      <h4>Patologías Crónicas, alergias y tratamientos previos activos</h4>		
			      	<div class="alert alert-info col-md-12 column">
			      		<div class="col-md-1 column">
			      			<span class="glyphicon glyphicon-pencil" style='font-size: 50px;' aria-hidden="true"></span>	
			      		</div>
			      		<div class="col-md-11 column">
			      		 	En esta sección seran definidos elementos iniciales de la historia médica pediátrica, tales elementos consisten en los tratamientos que ya posee el paciente (p.e nebulización), alguna patología crónica (asma por ejemplo) y alérgias a algun medicamento (p.e yodo/penicilina), comida (p.e mariscos), intolerancias (p.e gluten).
			      		</div>
			      	</div>  			      	 
			
			     <div class="form-inline">
			     	<div class="row">
						<div class="col-md-3 pad-controles etiquetas">
	                    	{{Form::label('alergias_paciente_pediatrico','Alérgias: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{Form::select('alergias_paciente_pediatrico',[],'',['name'=>'alergias_paciente_pediatrico[]', 'class'=>'form-control select2','style'=>'width:100%','multiple'=>'multiple']) }}

						</div>
						<div class="col-md-2 pad-controles etiquetas">
	              {{Form::label('tratamientos_paciente_pediatrico','Tratamientos sostenidos: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
              {{Form::select('tratamientos_paciente_pediatrico',[],json_encode(Input::old('alergias_paciente_pediatrico')),['name'=>'tratamientos_paciente_pediatrico[]', 'class'=>'form-control select2','style'=>'width:100%','multiple'=>'multiple']) }}
						</div>						
			     	</div>
			     	<div class="row">
						<div class="col-md-3 pad-controles etiquetas">
	             {{Form::label('patologias_paciente_pediatrico','Patologías crónicas/congénitas: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{Form::select('patologias_paciente_pediatrico',[],'',['name'=>'patologias_paciente_pediatrico[]', 'class'=>'form-control select2', 'style'=>'width:100%','multiple'=>'multiple'] )}}
						</div>
						<div class="col-md-2 pad-controles etiquetas">
	                    	{{Form::label('intolerancias_paciente_pediatrico','Intolerancias conocidas: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{Form::select('intolerancias_paciente_pediatrico', [],'' ,['name'=>'intolerancias_paciente_pediatrico[]','class'=>'form-control select2','style'=>'width:100%','multiple'=>'multiple']) }}
						</div>
			     	</div>
			     	<div class="row">
						<div class="col-md-3 pad-controles etiquetas">
	                    	{{Form::label('observaciones_apertura_historia_pediatrica','Observaciones de apertura de historia médica: ')}} 
						</div>
						<div class="col-md-9 pad-controles">
							{{Form::textarea('observaciones_apertura_historia_pediatrica','',array('class'=>'form-control ','size'=>'105x4','style'=>'resize:none'))}}
						</div>						
			     	</div>			     				     	
			     </div>		    
		    </div>
		  </div>
		</div>
		{{Form::close()}}
	</div>
</div>