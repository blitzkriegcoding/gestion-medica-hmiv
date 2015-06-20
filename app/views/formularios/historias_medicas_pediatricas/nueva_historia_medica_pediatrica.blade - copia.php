
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
                #dd($formulario_representante_historia);
                  if(View::exists('formularios.historias_medicas_pediatricas'))
                    {
                        
                        if(isset($formulario_representante_historia))
                            {
                              echo $formulario_representante_historia;
                            }
                        else
                          {
                              echo $datos_representante;
                          }
                    }
                ?>
		      <!-- <h4>Datos del representante legal actual</h4>
                     <p>
                        <div class="alert alert-warning col-md-12 column">
                          <div class="col-md-1 column">
                            <span class="glyphicon glyphicon-exclamation-sign" style='font-size: 50px;' aria-hidden="true"></span>  
                          </div>
                          <div class="col-md-11 column">
                             Previamente cuando el/la paciente fue ingresada(o) al Hospital fue registrado un representante, o mas bien un acompañante, sin embargo es necesario identificar quien posee la tutela actual del/la paciente. 
                          </div>
                        </div>  
                     </p>
                     <div class="form-inline">
                            {{-- BLOQUE NACIONALIDAD Y CEDULA --}}
                            <div class="row">
                              <div class="col-md-3 pad-controles etiquetas">
                                {{Form::label('tipo_documento_representante','Nacionalidad: ')}}
                                
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::select('tipo_documento_representante',array(''=>'SELECCIONE','V'=>'VENEZOLANA','E'=>'EXTRANJERA','P'=>'PASAPORTE'),'',array('class'=>"form-control",'style'=>'width:100%' )) }}
                                 @if($errors->has('tipo_documento_representante'))
                                        <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                          @foreach($errors->get('tipo_documento_representante') as $error )
                                              {{ $error }}<br>
                                          @endforeach
                                        </div>
                                  @endif                      
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3 pad-controles etiquetas">
                                {{Form::label('documento_representante','Cédula: ')}}                      
                              </div>                  
                              <div class="col-md-3 pad-controles ">
                                {{Form::text('documento_representante',NULL ,array('class'=>"form-control",'placeholder'=>'Escriba cédula','style'=>'width:100%' ))}}
                                  @if($errors->has('documento_representante'))
                                        <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                          @foreach($errors->get('documento_representante') as $error )
                                              {{ $error }}<br>
                                          @endforeach
                                        </div>
                                  @endif                        
          
                              </div>
                              {{-- FIN BLOQUE NACIONALIDAD Y CEDULA --}}
          
                              {{--BLOQUE SEXO NOMBRES Y APELLIDOS --}}
                              <div class="col-md-2 pad-controles etiquetas">
                                {{Form::label('sexo_representante','Sexo: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::select('sexo_representante',array(''=>'SELECCIONE','F'=>'FEMENINO','M'=>'MASCULINO'),'',array('class'=>'form-control','style'=>'width:100%')) }}
                                  @if($errors->has('sexo_representante'))
                                        <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                          @foreach($errors->get('sexo_representante') as $error )
                                              {{ $error }}<br>
                                          @endforeach
                                        </div>
                                  @endif                      
                              </div>
                            
                            </div>
                            <div class="row">
                              <div class="col-md-3 pad-controles etiquetas">
                                {{Form::label('primer_nombre_representante','Primer nombre: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::text('primer_nombre_representante',NULL ,array('class'=>"form-control",'style'=>'width:100%','placeholder'=>'Escriba primer nombre'))}}
                                  @if($errors->has('primer_nombre_representante'))
                                        <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                          @foreach($errors->get('primer_nombre_representante') as $error )
                                              {{ $error }}<br>
                                          @endforeach
                                        </div>
                                  @endif                        
                              </div>
                              <div class="col-md-2 pad-controles etiquetas">
                                {{Form::label('segundo_nombre_representante','Segundo nombre: ')}} 
          
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::text('segundo_nombre_representante',NULL ,array('class'=>"form-control",'style'=>'width:100%','placeholder'=>'Escriba segundo nombre'))}}
                                  @if($errors->has('segundo_nombre_representante'))
                                        <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                          @foreach($errors->get('segundo_nombre_representante') as $error )
                                              {{ $error }}<br>
                                          @endforeach
                                        </div>
                                  @endif                         
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3 pad-controles etiquetas">
                                {{Form::label('primer_apellido_representante','Primer apellido: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::text('primer_apellido_representante',NULL ,array('class'=>"form-control",'style'=>'width:100%','placeholder'=>'Escriba primer apellido'))}}
                                  @if($errors->has('primer_apellido_representante'))
                                        <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                          @foreach($errors->get('primer_apellido_representante') as $error )
                                              {{ $error }}<br>
                                          @endforeach
                                        </div>
                                  @endif                       
                              </div>
                              <div class="col-md-2 pad-controles etiquetas">
                                {{Form::label('segundo_apellido_representante','Segundo apellido: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles ">
                                {{Form::text('segundo_apellido_representante',NULL ,array('class'=>"form-control",'style'=>'width:100%', 'placeholder'=>'Escriba segundo apellido'))}}
                                  @if($errors->has('segundo_apellido_representante'))
                                        <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                          @foreach($errors->get('segundo_apellido_representante') as $error )
                                              {{ $error }}<br>
                                          @endforeach
                                        </div>
                                  @endif                        
                              </div>
                            </div>
                            {{--FIN BLOQUE SEXO NOMBRES Y APELLIDOS --}}
                            
                            <div class="row">
                              <div class="col-md-3 pad-controles etiquetas">
                                {{Form::label('fecha_nacimiento_representante','Fecha de nacimiento: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">
                                  <div class="input-group date" id='fecha_nacimiento_representante'>
                                    {{Form::text('fecha_nacimiento_representante',NULL ,array('class'=>"form-control",'style'=>'width:100%', 'readonly'=>''))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                  </div>                          
                                  @if($errors->has('fecha_nacimiento_representante'))
                                          <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                            @foreach($errors->get('fecha_nacimiento_representante') as $error )
                                                {{ $error }}<br>
                                            @endforeach
                                          </div>
                                    @endif                                            
                              </div>
                              <div class="col-md-2 pad-controles etiquetas">
                                {{Form::label('pais_origen_representante','País de origen: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">                      
                                {{Form::select('pais_origen_representante',array(''=>'SELECCIONE'),'',array('class'=>"form-control",'id'=>'representante_pais_origen','style'=>'width:100%')) }}
                                @if($errors->has('pais_origen_representante'))
                                      <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                        @foreach($errors->get('pais_origen_representante') as $error )
                                            {{ $error }}<br>
                                        @endforeach
                                      </div>
                                @endif                     
                              </div>
          
                            </div>
                            <div class="row">
                              <div class="col-md-3 pad-controles etiquetas">
                                {{Form::label('parentesco_representante','Parentesco con el/la paciente: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::select('parentesco_representante',$parentesco ,'',array('class'=>'form-control','id'=>'parentesco_representante', 'style'=>'width:100%')) }}
                                @if($errors->has('parentesco_representante'))
                                      <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                        @foreach($errors->get('parentesco_representante') as $error )
                                            {{ $error }}<br>
                                        @endforeach
                                      </div>
                                @endif                    
                              </div>
                              <div class="col-md-2 pad-controles etiquetas">
                                {{Form::label('estado_civil_representante','Estado civil: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">                   
                                {{Form::select('estado_civil_representante', $estado_civil,'0',array('class'=>"form-control  ",'style'=>'width:100%')) }}
                                @if($errors->has('estado_civil_representante'))
                                      <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                        @foreach($errors->get('estado_civil_representante') as $error )
                                            {{ $error }}<br>
                                        @endforeach
                                      </div>
                                @endif                     
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3 pad-controles etiquetas">
                                {{Form::label('direccion_est_mun_par_representante','Estado/Municipio/Parroquia: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::select('direccion_est_mun_par_representante',array(''=>'Estado/Mun/Parroquia'),'' ,array('class'=>"form-control ",'style'=>'width:100%','id'=>'direccion_est_mun_par')) }}
                                @if($errors->has('direccion_est_mun_par_representante'))
                                      <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                        @foreach($errors->get('direccion_est_mun_par_representante') as $error )
                                            {{ $error }}<br>
                                        @endforeach
                                      </div>
                                @endif                      
                              </div>
                              <div class="col-md-2 pad-controles etiquetas">
                                {{Form::label('avenida_calle_representante','Avenida/Calle: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles ">
                                {{Form::text('avenida_calle_representante','',array('class'=>"form-control ",'placeholder'=>'Indique avenida/calle','style'=>'width:100%')) }}
                                @if($errors->has('avenida_calle_representante'))
                                      <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                        @foreach($errors->get('avenida_calle_representante') as $error )
                                            {{ $error }}<br>
                                        @endforeach
                                      </div>
                                @endif                     
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3 pad-controles etiquetas">
                                {{Form::label('casa_edificio_representante','Casa/Edificio: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::text('casa_edificio_representante','',array('class'=>"form-control",'placeholder'=>'Indique casa o edificio','style'=>'width:100%')) }}
                                @if($errors->has('casa_edificio_representante'))
                                      <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                        @foreach($errors->get('casa_edificio_representante') as $error )
                                            {{ $error }}<br>
                                        @endforeach
                                      </div>
                                @endif                     
                              </div>
                              <div class="col-md-2 pad-controles etiquetas">
                                {{Form::label('telefono_1','Teléfono: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles ">
                                {{Form::text('telefono_1','',array('class'=>"form-control",'placeholder'=>'Indique teléfono','style'=>'width:100%')) }}
          
                                @if($errors->has('telefono_1'))
                                      <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                        @foreach($errors->get('telefono_1') as $error )
                                            {{ $error }}<br>
                                        @endforeach
                                      </div>
                                @endif                      
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3 pad-controles etiquetas">
                                {{Form::label('telefono_2','Teléfono 2: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::text('telefono_2','',array('class'=>"form-control",'placeholder'=>'Indique telefono adicional','style'=>'width:100%')) }}
                                @if($errors->has('telefono_2'))
                                      <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                        @foreach($errors->get('telefono_2') as $error )
                                            {{ $error }}<br>
                                        @endforeach
                                      </div>
                                @endif                      
                              </div>
                              <div class="col-md-2 pad-controles etiquetas">
                                {{Form::label('correo_representante','Correo electrónico: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::text('correo_representante','',array('class'=>"form-control",'placeholder'=>'Indique correo electrónico','style'=>'width:100%')) }}
                                @if($errors->has('correo_representante'))
                                      <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                        @foreach($errors->get('correo_representante') as $error )
                                            {{ $error }}<br>
                                        @endforeach
                                      </div>
                                @endif                     
                              </div>    
                            </div>
                            <div class="row">
                              <div class="col-md-3 pad-controles etiquetas">
                                {{Form::label('ocupacion_oficio_representante','Ocupación u oficio: ')}} 
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::select('ocupacion_oficio_representante', array(''=>'SELECCIONE'),'',array('class'=>"form-control",'style'=>'width:100%')) }}
                                @if($errors->has('ocupacion_oficio_representante'))
                                      <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                        @foreach($errors->get('ocupacion_oficio_representante') as $error )
                                            {{ $error }}<br>
                                        @endforeach
                                      </div>
                                @endif                     
                              </div> 
                              <div class="col-md-2 pad-controles etiquetas">
                                {{Form::label('grado_instruccion_representante',"Grado o nivel de instrucción: ")}} 
                              </div>
                              <div class="col-md-3 pad-controles">
                                {{Form::select('grado_instruccion_representante', $grado_instruccion,'0',array('class'=>"form-control",'style'=>'width:100%')) }}
                                @if($errors->has('grado_instruccion_representante'))
                                      <div class="alert alert-danger col-xs text-left" style="padding: 2px">
                                        @foreach($errors->get('grado_instruccion_representante') as $error )
                                            {{ $error }}<br>
                                        @endforeach
                                      </div>
                                @endif                      
                              </div>
                            </div>
                      </div> -->
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
	              {{Form::label('tratamientos_paciente_pediatrico','Tratamientos sostenidos hasta la fecha: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{-- {{Form::select('tratamientos_paciente_pediatrico',array(''=>'SELECCIONE'),'',array('class'=>'form-control','style'=>'width:100%')) }} --}}
              {{Form::select('tratamientos_paciente_pediatrico',[],json_encode(Input::old('alergias_paciente_pediatrico')),['name'=>'tratamientos_paciente_pediatrico[]', 'class'=>'form-control select2','style'=>'width:100%','multiple'=>'multiple']) }}
						</div>						
			     	</div>
			     	<div class="row">
						<div class="col-md-3 pad-controles etiquetas">
	             {{Form::label('patologias_paciente_pediatrico','Patologías crónicas/congénitas hasta la fecha: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{Form::select('patologias_paciente_pediatrico',[],'',['name'=>'patologias_paciente_pediatrico[]', 'class'=>'form-control select2', 'style'=>'width:100%','multiple'=>'multiple'] )}}
						</div>
						<div class="col-md-2 pad-controles etiquetas">
	                    	{{Form::label('intolerancias_paciente_pediatrico','Intolerancias conocidas hasta la fecha: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{Form::select('intolerancias_paciente_pediatrico', [],'' ,['name'=>'intolerancias_paciente_pediatrico[]','class'=>'form-control select2','style'=>'width:100%','multiple'=>'multiple']) }}
						</div>
			     	</div>
			     	<div class="row">
						<div class="col-md-3 pad-controles etiquetas">
	                    	{{Form::label('observaciones_apertura_historia_pediatrica','Observaciones de apertura de historia médica: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{Form::textarea('observaciones_apertura_historia_pediatrica','',array('class'=>'form-control ','size'=>'30x7','style'=>'resize:none'))}}
						</div>						
			     	</div>			     				     	
			     </div>		    
		    </div>
		  </div>
		</div>
		{{Form::close()}}
	</div>
</div>