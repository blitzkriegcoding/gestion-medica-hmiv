
<div class="container-fluid">
  <div class="container">
    <h3>
      Creación de médicos en el Sistema.
    </h3>
  </div>
</div>
<br>
<div class="panel-body col-xs- col-sm- col-md- col-lg- alineacion_paneles" >
  <div class="wizard" data-initialize="wizard" id="nuevo_medico_wizard">
    <ul class="steps">
      <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Datos Personales<span class="chevron"></span></li>
      <li data-step="2"><span class="badge">2</span>Datos Profesionales<span class="chevron"></span></li>
      <li data-step="3" data-name="template"><span class="badge">3</span>Especialidades<span class="chevron"></span></li>
      <li data-step="4" data-name="template"><span class="badge">4</span>Persona Contacto<span class="chevron"></span></li>
      <li data-step="5" data-name="template"><span class="badge">5</span>Guardar Datos<span class="chevron"></span></li>            
    </ul>
    <div class="actions">
      <button type="button" class="btn btn-default btn-prev"><span class="glyphicon glyphicon-arrow-left"></span>Anterior</button>
      <button type="button" class="btn btn-default btn-next" data-last="Guardar Datos">Siguiente<span class="glyphicon glyphicon-arrow-right"></span></button>
    </div>
    {{Form::open(['action'=>'MedicosController@crear_nuevo_medico','method'=>'post','class'=>'clearfix form-horizontal','id'=>'formulario_principal'])}}
    <div class="step-content">
      <div class="step-pane active sample-pane alert" data-step="1">
          <h4>Identificación del/la Médico(a)</h4>          
              <div class="alert alert-info col-md-12 column">
                <div class="col-md-1 column">
                  <span class="glyphicon glyphicon-pencil" style='font-size: 50px;' aria-hidden="true"></span>  
                </div>
                <div class="col-md-11 column">
                  En esta sección sera identificado el/la médico(a) con los datos primarios ejercicio en el Hospital. <br>
                  <strong>Rellene los campos necesarios para incluir los datos personales del/la médico.</strong>
                </div>
              </div>          

          <br><br>
          <div class="form-inline" >
                  {{-- Bloque nacionalidad y cedula --}}
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('tipo_documento_medico','Nacionalidad: ')}}
                    </div>
                    <div class="col-md-3 pad-controles" id='fecha_nacimiento_medico'>
                      {{Form::select('tipo_documento_medico',array(''=>'SELECCIONE','V'=>'VENEZOLANA','E'=>'EXTRANJERA','P'=>'PASAPORTE'),'',array('class'=>'form-control ','style'=>'width:100%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('fecha_nacimiento_medico_campo','Fecha de nacimiento: ')}}
                    </div>
                    <div class="col-md-3 pad-controles"> 
                      <div class="input-group date" id="fecha_nacimiento_medico_campo">
                        {{Form::text('fecha_nacimiento_medico_campo',NULL,array('class'=>'form-control','style'=>'width:100%', 'id'=>'fecha_nacimiento_medico_campo' ))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                    </div>                    

                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('documento_medico','Cédula: ')}}
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('documento_medico',NULL ,array('class'=>'form-control ','placeholder'=>'Indique cédula','style'=>'width:100%'))}}
                    </div>
                   <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('sexo_medico','Sexo: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::select('sexo_medico',array(''=>'SELECCIONE','F'=>'FEMENINO','M'=>'MASCULINO'),'',array('class'=>'form-control ','style'=>'width:100%')) }}
                    </div>                    
                  </div>
                  {{-- Fin bloque nacionalidad y cedula --}}

                  {{--BLOQUE NOMBRES Y APELLIDOS --}}
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('primer_nombre_medico','Primer nombre: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('primer_nombre_medico',NULL ,array('class'=>'form-control ','placeholder'=>'Indique primer nombre', 'style'=>'width:100%'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('segundo_nombre_medico','Segundo nombre: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('segundo_nombre_medico',NULL ,array('class'=>'form-control ','placeholder'=>'Indique segundo nombre','style'=>'width:100%'))}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('primer_apellido_medico','Primer apellido: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('primer_apellido_medico',NULL ,array('class'=>'form-control ','placeholder'=>'Indique primer apellido','style'=>'width:100%'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('segundo_apellido_medico','Segundo apellido: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('segundo_apellido_medico',NULL ,array('class'=>'form-control ','placeholder'=>'Indique segundo apellido','style'=>'width:100%'))}}
                    </div>
                  </div>
                  {{--FIN BLOQUE NOMBRES Y APELLIDOS --}}

                  {{--BLOQUE FECHA/NACIMIENTO, PAIS ORIGEN --}}
                  <div class="row">                    
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('pais_origen_medico','País de origen: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">                      
                      {{Form::select('pais_origen_medico',array(''=>'SELECCIONE'),'',array('class'=>'form-control ','id'=>'pais_origen_medico','style'=>'width:100%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('lugar_nacimiento_medico','Lugar de nacimiento: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('lugar_nacimiento_medico',NULL ,array('class'=>'form-control ','style'=>'width:100%'))}}
                    </div>                    
                  </div>
                  {{--FIN BLOQUE FECHA/NACIMIENTO, PAIS ORIGEN --}}
                  
                  {{--BLOQUE ESTADO CIVIL, DIRECCION TELEFONO Y CORREO --}}
                  <div class="row">                    
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('estado_civil_medico','Estado civil: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">                      
                      {{Form::select('estado_civil_medico',$estado_civil,'',array('class'=>'form-control ','id'=>'estado_civil_medico','style'=>'width:100%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('parroquia_medico','Estado/Municipio/Parroquia: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('parroquia_medico',array(''=>'SELECCIONE'),'',array('class'=>'form-control ','id'=>'parroquia_medico','style'=>'width:100%')) }}
                    </div>                    
                  </div>
                  <div class="row">                    
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('calle_avenida_medico','Avenida/Calle: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">                      
                      {{Form::text('calle_avenida_medico',NULL ,array('class'=>'form-control ','id'=>'calle_avenida_medico', 'style'=>'width:100%'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('casa_edificio_medico','Casa/Edificio: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('casa_edificio_medico',NULL ,array('class'=>'form-control ','id'=>'casa_edificio_medico' ,'style'=>'width:100%'))}}
                    </div>                    
                  </div>
                  <div class="row">                    
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('telefono1:','Teléfono 1: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">                      
                      {{Form::text('telefono1',NULL ,array('class'=>'form-control ','style'=>'width:100%'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('telefono2','Teléfono 2: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('telefono2',NULL ,array('class'=>'form-control ','style'=>'width:100%'))}}
                    </div>                    
                  </div>  
                  <div class="row">                    
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('correo_medico:','Correo electrónico: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">                      
                      {{Form::text('correo_medico',NULL ,array('class'=>'form-control ', 'id' => 'correo_medico', 'style'=>'width:100%'))}}
                    </div>                 
                  </div>  
                  {{--FIN BLOQUE ESTADO CIVIL, DIRECCION TELEFONO Y CORREO--}}

          </div>
      </div>
      <div class="step-pane active sample-pane alert" data-step="2">
        <h4>Resumen de conocimientos</h4>
              <div class="alert alert-info col-md-12 column">
                <div class="col-md-1 column">
                  <span class="glyphicon glyphicon-pencil" style='font-size: 50px;' aria-hidden="true"></span>  
                </div>
                <div class="col-md-11 column">
                  En esta sección se ingresaran de forma suscinta los datos de profesionalización y adquisición de conocimientos del/(a) médico(a). <br>
                  <strong>Rellene los campos necesarios para incluir los estudios de formación-actualización del/la médico.</strong>
                </div>
              </div>

        <br>
        {{-- <div class="row"> --}}
          <div class="form-group">
              <label class="col-xs-1 control-label ">Estudios: </label>
              <div class="col-xs-3 ">
                  <input type="text" class="form-control" style="width: 100%" name="experiencia[0].institucion" placeholder="Institución" />
              </div>
              <div class="col-xs-3 ">
                  <input type="text" class="form-control" style="width: 100%" name="experiencia[0].titulo_obtenido" placeholder="Título obtenido" />
              </div>
              <div class="col-xs-2 ">
                  <input type="text" class="form-control" style="width: 100%" name="experiencia[0].anio_graduacion" placeholder="Año de graduación" />
              </div>
              <div class="col-xs-2 ">
                  <input type="text" class="form-control" style="width: 100%" name="experiencia[0].pais_graduacion" placeholder="País" />
              </div>
              <div class="col-xs-1">
                  <button type="button" class="btn btn-default addButton"><i class="glyphicon glyphicon-plus"></i></button>
              </div>
          </div>
        {{-- </div> --}}

        {{-- <div class="row" > --}}
          <div class="form-group hide" id="plantilla_experiencia">          
              <div class="col-xs-1">
                &nbsp;
              </div>
              <div class="col-xs-3 ">
                  <input type="text" class="form-control" style="width: 100%" name="institucion" placeholder="Institución" />
              </div>
              <div class="col-xs-3 ">
                  <input type="text" class="form-control" style="width: 100%" name="titulo_obtenido" placeholder="Título obtenido" />
              </div>
              <div class="col-xs-2 ">
                  <input type="text" class="form-control" style="width: 100%" name="anio_graduacion" placeholder="Año de graduación" />
              </div>
              <div class="col-xs-2 ">
                  <input type="text" class="form-control" style="width: 100%" name="pais_graduacion" placeholder="País" />
              </div>
              <div class="col-xs-1 ">
                  <button type="button" class="btn btn-default removeButton"><i class="glyphicon glyphicon-minus"></i></button>
              </div>
          </div>
        {{-- </div> --}}
      </div>
      <div class="step-pane active sample-pane alert" data-step="3">
        <h4>Especialidades</h4>        
          <div class="alert alert-info col-md-12 column">
            <div class="col-md-1 column">
              <span class="glyphicon glyphicon-pencil" style='font-size: 50px;' aria-hidden="true"></span>  
            </div>
            <div class="col-md-11 column">
              En esta seccíon seran seleccionadas las especialidades médicas que puede ejercer el galeno en el Hospital, <strong>en un límite de cinco (5) especialidades.</strong>
              <strong>Rellene los campos necesarios para incluir los estudios de formación-actualización del/la médico.</strong>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 pad-controles etiquetas">
              {{Form::label('especialidades_medicas','Especialidades médicas: ')}}
            </div>
            <div class="col-md-4 pad-controles">
              {{-- {{Form::text('especialidades_medicas','' ,array('class'=>'form-control ','placeholder'=>'Seleccione especialidades','style'=>'width:100%'))}} --}}
              {{Form::select('especialidades_medicas',[],'',['name'=>'especialidades_medicas[]', 'id'=>'especialidades_medicas', 'class'=>'form-control select2','style'=>'width:100%','multiple'=>'multiple']) }}              
            </div>                
          </div>      
      </div>
      <div class="step-pane active sample-pane alert" data-step="4">
        <h4>Contacto cercano</h4>
        <p> </p>
          <div class="alert alert-info col-md-12 column">
            <div class="col-md-1 column">
              <span class="glyphicon glyphicon-pencil" style='font-size: 50px;' aria-hidden="true"></span>  
            </div>
            <div class="col-md-11 column">
              Se incluye una persona contacto que tenga relación cercana al medico, en caso de presentarse una eventualidad.
              <strong>Rellene los campos necesarios para incluir la persona contacto.</strong>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-3 pad-controles etiquetas">
              {{Form::label('tipo_documento_contacto','Nacionalidad: ')}}
            </div>
            <div class="col-md-3 pad-controles">
              {{Form::select('tipo_documento_contacto',array(''=>'SELECCIONE','V'=>'VENEZOLANA','E'=>'EXTRANJERA','P'=>'PASAPORTE'),'',array('class'=>'form-control ', 'id'=>'tipo_documento_contacto', 'style'=>'width:100%')) }}
            </div>            
          </div>
          <div class="row">
            <div class="col-md-3 pad-controles etiquetas">
              {{Form::label('documento_contacto','Cédula: ')}}
            </div>
            <div class="col-md-3 pad-controles">
              {{Form::text('documento_contacto',NULL ,array('class'=>'form-control ','placeholder'=>'Indique cédula', 'id'=>'documento_contacto', 'style'=>'width:100%'))}}
            </div>                   
          </div>
          <div class="row">
            <div class="col-md-3 pad-controles etiquetas">
              {{Form::label('primer_nombre_contacto','Primer nombre: ')}} 
            </div>
            <div class="col-md-3 pad-controles">
              {{Form::text('primer_nombre_contacto',NULL ,array('class'=>'form-control ','placeholder'=>'Indique primer nombre', 'style'=>'width:100%'))}}
            </div>
            <div class="col-md-2 pad-controles etiquetas">
              {{Form::label('segundo_nombre_contacto','Segundo nombre: ')}} 
            </div>
            <div class="col-md-3 pad-controles">
              {{Form::text('segundo_nombre_contacto',NULL ,array('class'=>'form-control ','placeholder'=>'Indique segundo nombre','style'=>'width:100%'))}}
          </div>
          </div>
          <div class="row">
            <div class="col-md-3 pad-controles etiquetas">
              {{Form::label('primer_apellido_contacto','Primer apellido: ')}} 
            </div>
            <div class="col-md-3 pad-controles">
              {{Form::text('primer_apellido_contacto',NULL ,array('class'=>'form-control ','placeholder'=>'Indique primer apellido','style'=>'width:100%'))}}
            </div>
            <div class="col-md-2 pad-controles etiquetas">
              {{Form::label('segundo_apellido_contacto','Segundo apellido: ')}} 
            </div>
            <div class="col-md-3 pad-controles">
              {{Form::text('segundo_apellido_contacto',NULL ,array('class'=>'form-control ','placeholder'=>'Indique segundo apellido','style'=>'width:100%'))}}
            </div>
          </div>
          <div class="row">                    
            <div class="col-md-3 pad-controles etiquetas">
              {{Form::label('telefono1_contacto:','Teléfono 1: ')}} 
            </div>
            <div class="col-md-3 pad-controles ">                      
              {{Form::text('telefono1_contacto',NULL ,array('class'=>'form-control ','style'=>'width:100%'))}}
            </div>
            <div class="col-md-2 pad-controles etiquetas">
              {{Form::label('telefono2_contacto','Teléfono 2: ')}} 
            </div>
            <div class="col-md-3 pad-controles">
              {{Form::text('telefono2_contacto',NULL ,array('class'=>'form-control ','style'=>'width:100%'))}}
            </div>                    
          </div>
          <div class="row">
              <div class="col-md-3 pad-controles etiquetas">
                {{Form::label('direccion_contacto','Dirección del contacto: ')}} 
              </div>
              <div class="col-md-8 pad-controles">
                {{Form::textarea('direccion_contacto','',array('class'=>'form-control ','size'=>'98x3', 'style'=>'resize:none'))}}
              </div>                 
          </div>

      </div> 
      <div class="step-pane active sample-pane alert" data-step="5">
        <h4>Design Template</h4>
            <h2 class="">
              GUARDAR DATOS
            </h2>
      </div>            
    </div>
    {{Form::close()}}
  </div>
</div>
