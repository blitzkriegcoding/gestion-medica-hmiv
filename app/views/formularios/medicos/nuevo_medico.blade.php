
<div class="container-fluid">
  <div class="container">
    <h3>
      Creación de médicos en el Sistema de Gestión Médica.
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
    {{Form::open(['action'=>'MedicosController@crear_nuevo_medico','method'=>'post','class'=>'clearfix','id'=>'formulario_principal'])}}
    <div class="step-content">
      <div class="step-pane active sample-pane alert" data-step="1">
          <h4>Identificación del/la Médico(a)</h4>
          <p>En esta sección sera identificado el/la médico(a) con los datos primarios ejercicio en el Hospital.</p>
          <br><br>
          <div class="form-inline" >
                  {{-- Bloque nacionalidad y cedula --}}
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('tipo_documento_medico','Nacionalidad: ')}}
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('tipo_documento_medico',array(''=>'SELECCIONE','V'=>'VENEZOLANA','E'=>'EXTRANJERA','P'=>'PASAPORTE'),'',array('class'=>'form-control input-sm','style'=>'width:75%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('fecha_nacimiento_medico_campo','Fecha de nacimiento: ')}}
                    </div>
                    <div class="col-md-3 pad-controles"> 
                      <div class="input-group date" id="fecha_nacimiento_medico_campo">
                        {{Form::text('fecha_nacimiento_medico_campo',NULL,array('class'=>'form-control input-sm','size'=>'16', 'id'=>'fecha_nacimiento_medico_campo' ))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                    </div>                    

                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('documento_medico','Cédula: ')}}
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('documento_medico',NULL ,array('class'=>'form-control input-sm','placeholder'=>'Cédula','size'=>'25'))}}
                    </div>
                   <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('sexo_medico','Género: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::select('sexo_medico',array(''=>'SELECCIONE','F'=>'FEMENINO','M'=>'MASCULINO'),'',array('class'=>'form-control input-sm','style'=>'width:75%')) }}
                    </div>                    
                  </div>
                  {{-- Fin bloque nacionalidad y cedula --}}

                  {{--BLOQUE NOMBRES Y APELLIDOS --}}
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('primer_nombre_medico','Primer nombre: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('primer_nombre_medico',NULL ,array('class'=>'form-control input-sm','size'=>'30'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('segundo_nombre_medico','Segundo nombre: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('segundo_nombre_medico',NULL ,array('class'=>'form-control input-sm','size'=>'30'))}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('primer_apellido_medico','Primer apellido: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('primer_apellido_medico',NULL ,array('class'=>'form-control input-sm','size'=>'30'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('segundo_apellido_medico','Segundo apellido: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('segundo_apellido_medico',NULL ,array('class'=>'form-control input-sm','size'=>'30'))}}
                    </div>
                  </div>
                  {{--FIN BLOQUE NOMBRES Y APELLIDOS --}}

                  {{--BLOQUE FECHA/NACIMIENTO, PAIS ORIGEN --}}
                  <div class="row">                    
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('pais_origen_medico','País de origen: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">                      
                      {{Form::select('pais_origen_medico',array(''=>'SELECCIONE'),'',array('class'=>'form-control input-sm','id'=>'medico_pais_origen','style'=>'width:90%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('lugar_nacimiento_medico','Lugar de nacimiento: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('lugar_nacimiento_medico',NULL ,array('class'=>'form-control input-sm','size'=>'30'))}}
                    </div>                    
                  </div>
                  {{--FIN BLOQUE FECHA/NACIMIENTO, PAIS ORIGEN --}}
                  
                  {{--BLOQUE ESTADO CIVIL, DIRECCION TELEFONO Y CORREO --}}
                  <div class="row">                    
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('estado_civil_medico','Estado civil: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">                      
                      {{Form::select('estado_civil_medico',array(''=>'SELECCIONE'),'',array('class'=>'form-control input-sm','id'=>'estado_civil_medico','style'=>'width:90%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('parroquia_medico','Estado/Mun/Parroquia: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('parroquia_medico',array(''=>'SELECCIONE'),'',array('class'=>'form-control input-sm','id'=>'parroquia_medico','style'=>'width:90%')) }}
                    </div>                    
                  </div>
                  <div class="row">                    
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('calle_avenida_medico','Avenida/Calle: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">                      
                      {{Form::text('calle_avenida_medico',NULL ,array('class'=>'form-control input-sm','size'=>'30'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('casa_edificio','Casa/Edificio: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('casa_edificio',NULL ,array('class'=>'form-control input-sm','size'=>'30'))}}
                    </div>                    
                  </div>
                  <div class="row">                    
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('telefono1:','Teléfono 1: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">                      
                      {{Form::text('telefono1',NULL ,array('class'=>'form-control input-sm','size'=>'30'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('telefono2','Teléfono 2: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('telefono2',NULL ,array('class'=>'form-control input-sm','size'=>'30'))}}
                    </div>                    
                  </div>  
                  <div class="row">                    
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('correo:','Correo electrónico: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">                      
                      {{Form::text('correo',NULL ,array('class'=>'form-control input-sm','size'=>'30'))}}
                    </div>                 
                  </div>  
                  {{--FIN BLOQUE ESTADO CIVIL, DIRECCION TELEFONO Y CORREO--}}

          </div>
      </div>
      <div class="step-pane active sample-pane alert" data-step="2">
        <h4>Resumen de conocimientos</h4>
        <p>En esta sección se ingresaran de forma suscinta los datos de profesionalización y adquisición de conocimientos del/(a) médico(a). </p>
      </div>
      <div class="step-pane active sample-pane alert" data-step="3">
        <h4>Especialidades</h4>
        <p>En esta seccíon seran seleccionadas las especialidades médicas que puede ejercer el galeno en el Hospital, <strong>en un límite de cinco (5) especialidades.</strong> </p>
      </div>
      <div class="step-pane active sample-pane alert" data-step="4">
        <h4>Contacto cercano</h4>
        <p>Se incluye una persona contacto que tenga relación cercana al medico, en caso de presentarse una eventualidad. </p>
      </div> 
      <div class="step-pane active sample-pane alert" data-step="5">
        <h4>Design Template</h4>
        <p>Nori grape silver beet broccoli kombu beet greens fava bean potato quandong celery. Bunya nuts black-eyed pea prairie turnip leek lentil turnip greens parsnip. Sea lettuce lettuce water chestnut eggplant winter purslane fennel azuki bean earthnut pea sierra leone bologi leek soko chicory celtuce parsley jÃ­cama salsify. </p>
      </div>            
    </div>
    {{Form::close()}}
  </div>
</div>