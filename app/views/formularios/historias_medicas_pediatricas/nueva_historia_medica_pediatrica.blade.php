<h4 class="panel-body alineacion_paneles"><strong>Creación de historias médicas</strong></h4>
<div class="panel-body col-xs- col-sm- col-md- col-lg- alineacion_paneles" >
	<div class="fuelux">
		<div class="wizard" data-initialize="wizard" id="myWizard">		  
		    <ul class="steps">
		      <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Identificación del Paciente<span class="chevron"></span></li>
		      <li data-step="2"><span class="badge">2</span>Representante legal actual<span class="chevron"></span></li>
		      <li data-step="3" data-name="template"><span class="badge">3</span>Alérgias, afecciones y tratamientos<span class="chevron"></span></li>
		    </ul>
		  
		  <div class="actions">
		    <button type="button" class="btn btn-default btn-prev"><span class="glyphicon glyphicon-arrow-left"></span>Anterior</button>
		    <button type="button" class="btn btn-default btn-next" data-last="Guardar">Siguiente<span class="glyphicon glyphicon-arrow-right"></span></button>
		  </div>
		  {{Form::open()}}
		  <div class="step-content">
		    <div class="step-pane active sample-pane alert" data-step="1">
		      <h4>Setup Campaign</h4>
		      <p>Veggies es bonus vobis, proinde vos postulo essum magis kohlrabi welsh onion daikon amaranth tatsoi tomatillo melon azuki bean garlic. Beetroot water spinach okra water chestnut ricebean pea catsear courgette.</p>
		    </div>
		    <div class="step-pane active sample-pane alert" data-step="2">
		      <h4>Datos del representante legal actual</h4>
			     <p>
			      	<div class="alert alert-info">
			      		 <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			      		 Previamente cuando el/la paciente fue ingresada(o) al Hospital fue registrado un representante, o mas bien un acompañante, sin embargo es necesario identificar quien posee la tutela de tal paciente. 
			      	</div>  
			     </p>
			     <div class="form-inline">
                  {{-- BLOQUE NACIONALIDAD Y CEDULA --}}
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('tipo_documento_representante','Nacionalidad: ')}}
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('tipo_documento_representante',array('0'=>'SELECCIONE','V'=>'VENEZOLANA','E'=>'EXTRANJERA','P'=>'PASAPORTE'),'0',array('class'=>'form-control')) }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('documento_representante','Cédula: ')}}
                    </div>                  
                    <div class="col-md-3 pad-controles">
                      {{Form::text('documento_representante',NULL ,array('class'=>'form-control','placeholder'=>'Escriba cédula'))}}
                    </div>
                    {{-- FIN BLOQUE NACIONALIDAD Y CEDULA --}}

                    {{--BLOQUE SEXO NOMBRES Y APELLIDOS --}}
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('sexo_representante','Género: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::select('sexo_representante',array('0'=>'---','F'=>'FEMENINO','M'=>'MASCULINO'),'0',array('class'=>'form-control','style'=>'width:75%')) }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('primer_nombre_representante','Primer nombre: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('primer_nombre_representante',NULL ,array('class'=>'form-control','size'=>'30','placeholder'=>'Escriba primer nombre'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('segundo_nombre_representante','Segundo nombre: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('segundo_nombre_representante',NULL ,array('class'=>'form-control','size'=>'30','placeholder'=>'Escriba segundo nombre'))}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('primer_apellido_representante','Primer apellido: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('primer_apellido_representante',NULL ,array('class'=>'form-control','size'=>'30','placeholder'=>'Escriba primer apellido'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('segundo_apellido_representante','Segundo apellido: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::text('segundo_apellido_representante',NULL ,array('class'=>'form-control','size'=>'30', 'placeholder'=>'Escriba segundo apellido'))}}
                    </div>
                  </div>
                  {{--FIN BLOQUE SEXO NOMBRES Y APELLIDOS --}}
                  
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('fecha_nacimiento_representante','Fecha de nacimiento: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                        <div class="input-group date" id='fecha_nacimiento_representante'>
                          {{Form::text('fecha_nacimiento_representante',NULL ,array('class'=>'form-control','size'=>'16', 'readonly'=>''))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>                     
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('pais_origen_representante','País de origen: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">                      
                      {{Form::select('pais_origen_representante',array(''=>'SELECCIONE'),'',array('class'=>'form-control','id'=>'representante_pais_origen','style'=>'width:100%')) }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('parentesco_representante','Parentesco con el/la paciente: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('parentesco_representante',$parentesco ,'0',array('class'=>'form-control ','style'=>'width:100%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('estado_civil_representante','Estado civil: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{-- {{Form::select('estado_civil_representante', array(''=>'SELECCIONE','1'=>'SOLTERO[A]','2'=>'CASADO[A]', '3'=>'CONCUBINO[A]','4'=>'VIUDO[A]','5'=>'INDEFINIDO'),'',array('class'=>'form-control input-sm')) }} --}}
                      {{Form::select('estado_civil_representante', $estado_civil,'0',array('class'=>'form-control','style'=>'width:100%')) }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('direccion_est_mun_par_representante','Estado/Municipio/Parroquia: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('direccion_est_mun_par_representante',array(''=>'Estado/Mun/Parroquia'),'',array('class'=>'form-control','style'=>'width:100%','id'=>'direccion_est_mun_par')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('avenida_calle_representante','Avenida/Calle: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::text('avenida_calle_representante','',array('class'=>'form-control','placeholder'=>'Indique avenida/calle','size'=>'30')) }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('casa_edificio_representante','Casa/Edificio: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('casa_edificio_representante','',array('class'=>'form-control','placeholder'=>'Indique casa o edificio','size'=>'30')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('telefono_1','Teléfono: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::text('telefono_1','',array('class'=>'form-control','placeholder'=>'Indique teléfono','size'=>'30')) }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('telefono_2','Teléfono 2: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('telefono_2','',array('class'=>'form-control','placeholder'=>'Indique telefono adicional','size'=>'30')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('correo_representante','Correo electrónico: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('correo_representante','',array('class'=>'form-control','placeholder'=>'Indique correo electrónico','size'=>'30')) }}
                    </div>    
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('ocupacion_oficio_representante','Ocupación u oficio: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('ocupacion_oficio_representante', array(''=>'SELECCIONE'),'',array('class'=>'form-control','style'=>'width:100%')) }}
                    </div> 
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('grado_instruccion_representante','Grado de instrucción: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('grado_instruccion_representante', $grado_instruccion,'0',array('class'=>'form-control','style'=>'width:100%')) }}
                    </div>
                  </div>                  
                 
          </div>
		    </div>
		    <div class="step-pane active sample-pane alert" data-step="3">
		      <h4>Patologías Crónicas, alergias y tratamientos previos activos</h4>
				<p>
			      	<div class="alert alert-info">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			      		 En esta sección seran definidos elementos iniciales de la historia médica pediátrica, tales elementos consisten en los tratamientos que ya posee el paciente (nebulización por ejemplo), alguna patología crónica (asma por ejemplo) y alérgias a algun medicamento (yodo/penicilina por ejemplo), comida (mariscos), intolerancias u otro agente (polen).
			      	</div>  
			     </p>
			     <div class="form-inline">
			     	<div class="row">
						<div class="col-md-3 pad-controles etiquetas">
	                    	{{Form::label('alergias_paciente_pediatrico','Alérgias: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{-- {{Form::text('alergias_paciente_pediatrico','',array('class'=>'form-control','placeholder'=>'Indique alergias','size'=>'30','multiple'=>'multiple')) }} --}}
							{{Form::select('alergias_paciente_pediatrico',[],'',array('class'=>'form-control','style'=>'width:100%' ,'multiple'=>'multiple','aria-hidden'=>'true')) }}
						</div>
						<div class="col-md-2 pad-controles etiquetas">
	                    	{{Form::label('tratamientos_paciente_pediatrico','Tratamientos sostenidos hasta la fecha: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{Form::select('tratamientos_paciente_pediatrico',array(''=>'SELECCIONE'),'',array('class'=>'form-control','style'=>'width:100%')) }}
						</div>						
			     	</div>
			     	<div class="row">
						<div class="col-md-3 pad-controles etiquetas">
	                    	{{Form::label('patologias_paciente_pediatrico','Patologías crónicas/congénitas hasta la fecha: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{Form::select('patologias_paciente_pediatrico',[],'',array('class'=>'form-control', 'style'=>'width:100%','multiple'=>'multiple','aria-hidden'=>'true')) }}
						</div>
						<div class="col-md-2 pad-controles etiquetas">
	                    	{{Form::label('intolerancias_paciente_pediatrico','Intolerancias conocidas hasta la fecha: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{Form::select('intolerancias_paciente_pediatrico',array(''=>'SELECCIONE'),'',array('class'=>'form-control','style'=>'width:100%')) }}
						</div>
			     	</div>
			     	<div class="row">
						<div class="col-md-3 pad-controles etiquetas">
	                    	{{Form::label('observaciones_apertura_historia_pediatrica','Observaciones de apertura de historia médica: ')}} 
						</div>
						<div class="col-md-3 pad-controles">
							{{Form::textarea('observaciones_apertura_historia_pediatrica','',array('class'=>'form-control ','size'=>'25x7','style'=>'resize:none'))}}
						</div>						
			     	</div>			     				     	
			     </div>		    
		    </div>
		  </div>
		</div>
		{{Form::close()}}
	</div>
</div>