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
          	</div>