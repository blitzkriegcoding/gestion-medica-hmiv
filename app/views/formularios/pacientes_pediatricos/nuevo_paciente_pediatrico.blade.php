
@if (Session::get('mensaje'))
  <!-- Si hay un mensaje, entonces lo imprimimos y le damos estilo con bootstrap -->
  <div class="container-fluid" style="width: 430px; margin: 0 auto;">
    <div class="{{Session::get('estilo')}} col-md-12 column" >
      <div class="col-md-2 column text-center" >
          <span class="{{Session::get('bandera')}}" style='font-size: 25px;' aria-hidden="true"></span>
      </div>
      <div class="col-md-10 column">
        {{ Session::get('mensaje')}}

      </div>
    </div>
  </div>
<br><br>
@endif
<div class="container">
  <h3>
    Creación de pacientes pediátricos de nuevo ingreso al HMIV
  </h3>
</div>
<div class="panel-body col-xs- col-sm- col-md- col-lg- alineacion_paneles" >
    <div class="wizard" data-initialize="wizard" id="wizard_ingreso" href="#">
      <ul class="steps">
        <li data-step="1" data-name="campaign" class="active">
          <span class="badge">1</span>Datos Paciente<span class="chevron">            
          </span>
        </li>
        <li data-step="2"><span class="badge">2</span>Datos Representante<span class="chevron"></span></li>
        <li data-step="3" data-name="template"><span class="badge">3</span>Detalles de admisión<span class="chevron"></span></li>
        <li data-step="4" data-name="template"><span class="badge">4</span>Guardar datos!<span class="chevron"></span></li>
      </ul>
      <div class="actions">
        <button type="button" class="btn btn-default btn-prev"><span class="glyphicon glyphicon-arrow-left"></span>Anterior</button>
        <button type="button" class="btn btn-default btn-next" data-last="Guardar">Siguiente<span class="glyphicon glyphicon-arrow-right"></span></button>
      </div>
      {{ Form::open(['action'=>'PacientesPediatricosController@crear_paciente_pediatrico','method'=>'post','class'=>'clearfix','id'=>'formulario_principal'])}}
      <div class="step-content">
        <!--CONTENIDO DEL PRIMER PANEL-->
        <div class="step-pane active sample-pane alert" data-step="1">
          <h4>Identificación del Paciente</h4>
          <p>En esta sección sera identificado el/la paciente con los datos primarios para su ingreso al Hospital.</p>
          <br>
          <div class="form-inline" >
                  {{-- Bloque nacionalidad y cedula --}}
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('tipo_documento_paciente','Nacionalidad: ')}}
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('tipo_documento_paciente',array(''=>'SELECCIONE','V'=>'VENEZOLANA','E'=>'EXTRANJERA','P'=>'PASAPORTE','X'=>'NO APLICA'),'',array('class'=>'form-control select2','style'=>'width:100%')) }}
                    
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('documento_paciente','Cédula: ')}}
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('documento_paciente',NULL ,array('class'=>'form-control ','placeholder'=>'Cédula','style'=>'width: 100%'))}}
                    </div>
                  </div>
                  {{-- Fin bloque nacionalidad y cedula --}}

                  {{--BLOQUE NOMBRES Y APELLIDOS --}}
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('primer_nombre_paciente','Primer nombre: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('primer_nombre_paciente',NULL ,array('class'=>'form-control ','style'=>'width: 100%'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('segundo_nombre_paciente','Segundo nombre: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('segundo_nombre_paciente',NULL ,array('class'=>'form-control ','style'=>'width: 100%'))}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('primer_apellido_paciente','Primer apellido: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('primer_apellido_paciente',NULL ,array('class'=>'form-control ','style'=>'width: 100%'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('segundo_apellido_paciente','Segundo apellido: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('segundo_apellido_paciente',NULL ,array('class'=>'form-control ','style'=>'width: 100%'))}}
                    </div>
                  </div>
                  {{--FIN BLOQUE NOMBRES Y APELLIDOS --}}

                  {{--BLOQUE FECHA/NACIMIENTO, PAIS ORIGEN --}}
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('fecha_nacimiento_paciente_campo','Fecha de nacimiento: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles"> 
                      <div class="input-group date" id="fecha_nacimiento_paciente_campo">
                        {{Form::text('fecha_nacimiento_paciente_campo','',array('class'=>'form-control ','style'=>'width: 100%', 'id'=>'fecha_nacimiento_paciente_campo' ))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('pais_origen_paciente','País de origen: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">                      
                      {{Form::select('pais_origen_paciente',array(''=>'SELECCIONE'),'',array('class'=>'form-control ','id'=>'paciente_pais_origen','style'=>'width:100%')) }}
                    </div>
                  </div>
                  {{--FIN BLOQUE FECHA/NACIMIENTO, PAIS ORIGEN --}}
                  
                  {{--BLOQUE SEXO, LUGAR NACIMIENTO --}}
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('sexo_paciente','Sexo: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::select('sexo_paciente',array(''=>'SELECCIONE','F'=>'FEMENINO','M'=>'MASCULINO'),'',array('class'=>'form-control ','style'=>'width:100%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('lugar_nacimiento_paciente','Lugar de nacimiento: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('lugar_nacimiento_paciente',NULL ,array('class'=>'form-control ','style'=>'width: 100%'))}}
                    </div>
                  </div>
                  {{--FIN BLOQUE SEXO, LUGAR NACIMIENTO --}}

          </div>
        </div>
        <!--FIN CONTENIDO DEL PRIMER PANEL-->

        <!--CONTENIDO DEL SEGUNDO PANEL-->
        <div class="step-pane sample-pane alert" data-step="2">
          <h4>Identificación del Representante</h4>
          <p>En ésta sección serán registrados los datos del representante del/la paciente al momento de ingresar al Hospital. </p>
          <br>
          <div class="form-inline">
                  {{-- BLOQUE NACIONALIDAD Y CEDULA --}}
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('tipo_documento_representante','Nacionalidad: ')}}
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('tipo_documento_representante',array(''=>'SELECCIONE','V'=>'VENEZOLANA','E'=>'EXTRANJERA','P'=>'PASAPORTE'),'',array('class'=>'form-control','style'=>'width: 100%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('representante_legal','Representante legal: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::select('representante_legal',array(''=>'SELECCIONE','1'=>' SI, ES REPRESENTANTE','2'=>'NO, ES ACOMPAÑANTE'),'',array('class'=>'form-control','style'=>'width: 100%')) }}
                    </div>                    

                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('documento_representante','Cédula: ')}}
                    </div>                  
                    <div class="col-md-3 pad-controles">
                      {{Form::text('documento_representante',NULL ,array('class'=>'form-control ','placeholder'=>'Escriba cédula','style'=>'width: 100%'))}}
                    </div>
                    {{-- FIN BLOQUE NACIONALIDAD Y CEDULA --}}

                    {{--BLOQUE SEXO NOMBRES Y APELLIDOS --}}
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('sexo_representante','Sexo: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::select('sexo_representante',array(''=>'SELECCIONE','F'=>'FEMENINO','M'=>'MASCULINO'),'',array('class'=>'form-control','style'=>'width: 100%')) }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('primer_nombre_representante','Primer nombre: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('primer_nombre_representante',NULL ,array('class'=>'form-control ','style'=>'width: 100%'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('segundo_nombre_representante','Segundo nombre: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('segundo_nombre_representante',NULL ,array('class'=>'form-control ','style'=>'width: 100%'))}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('primer_apellido_representante','Primer apellido: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('primer_apellido_representante',NULL ,array('class'=>'form-control ','style'=>'width: 100%'))}}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('segundo_apellido_representante','Segundo apellido: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::text('segundo_apellido_representante',NULL ,array('class'=>'form-control ','style'=>'width: 100%'))}}
                    </div>
                  </div>
                  {{--FIN BLOQUE SEXO NOMBRES Y APELLIDOS --}}
                  
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('fecha_nacimiento_representante','Fecha de nacimiento: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                        <div class="input-group date" id='fecha_nacimiento_representante'>
                          {{Form::text('fecha_nacimiento_representante',NULL ,array('class'=>'form-control ','style'=>'width: 100%', 'readonly'=>''))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>                     
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('pais_origen_representante','País de origen: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">                      
                      {{Form::select('pais_origen_representante',array(''=>'SELECCIONE'),'',array('class'=>'form-control','id'=>'representante_pais_origen','style'=>'width: 100%')) }}
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('parentesco_representante','Parentesco/Relación con el paciente: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('parentesco_representante',$parentesco,'',array('class'=>'form-control ','style'=>'width: 100%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('estado_civil_representante','Estado civil: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('estado_civil_representante', $estado_civil ,'',array('class'=>'form-control','style'=>'width: 100%')) }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('direccion_est_mun_par_representante','Estado/Municipio/Parroquia: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('direccion_est_mun_par_representante',array(''=>'Estado/Mun/Parroquia'),'',array('class'=>'form-control ','style'=>'width: 100%','id'=>'direccion_est_mun_par')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('avenida_calle_representante','Avenida/Calle: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::text('avenida_calle_representante','',array('class'=>'form-control ','placeholder'=>'Indique avenida/calle','style'=>'width: 100%')) }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('casa_edificio_representante','Casa/Edificio: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('casa_edificio_representante','',array('class'=>'form-control ','placeholder'=>'indique casa o edificio','style'=>'width: 100%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('telefono_1','Teléfono: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles ">
                      {{Form::text('telefono_1','',array('class'=>'form-control ','placeholder'=>'Indique teléfono','style'=>'width: 100%')) }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('telefono_2','Teléfono 2: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('telefono_2','',array('class'=>'form-control ','placeholder'=>'Indique telefono adicional','style'=>'width: 100%')) }}
                    </div>
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('correo_representante','Correo electrónico: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::text('correo_representante','',array('class'=>'form-control ','placeholder'=>'Indique correo electrónico','style'=>'width: 100%')) }}
                    </div>    
                  </div>
                  <div class="row">
                    <div class="col-md-3 pad-controles etiquetas">
                      {{Form::label('ocupacion_oficio_representante','Ocupación u oficio: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('ocupacion_oficio_representante', array(''=>'SELECCIONE'),'',array('class'=>'form-control ','style'=>'width: 100%')) }}
                    </div> 
                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('grado_instruccion_representante','Grado o nivel de instrucción: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('grado_instruccion_representante', $grado_instruccion,'',array('class'=>'form-control ','style'=>'width:100%')) }}
                    </div>
                  </div>
          </div>
        </div>
        <!--FIN CONTENIDO DEL SEGUNDO PANEL-->

        <!--CONTENIDO DEL TERCER PANEL-->
        <div class="step-pane sample-pane bg-default alert" data-step="3">
          <h4>Admisión</h4>
          <p>En éste apartado se registra la modalidad de admisión del paciente al Hospital. </p>
          <br>
          <div class="form-inline">
              <div class="row">
                  <div class="col-md-3 pad-controles etiquetas">
                    {{Form::label('tipo_ingreso_paciente','Tipo de ingreso: ')}} 
                  </div>
                  <div class="col-md-3 pad-controles">
                    {{Form::select('tipo_ingreso_paciente', array(''=>'SELECCIONE','1'=>'EMERGENCIA','2'=>'PACIENTE REMITIDO'),'',array('class'=>'form-control ','style'=>'width: 100%'))}}
                  </div>

                    <div class="col-md-2 pad-controles etiquetas">
                      {{Form::label('medico_tratante','Médico Tratante: ')}} 
                    </div>
                    <div class="col-md-3 pad-controles">
                      {{Form::select('medico_tratante', $medicos,'',array('class'=>'form-control ','style'=>'width: 100%'))}}
                    </div> 
              </div>
              <div class="row">
                  <div class="col-md-3 pad-controles etiquetas">
                    {{Form::label('fecha_ingreso_paciente','Fecha de ingreso: ')}} 
                  </div>
                  <div class="col-md-3 pad-controles">  
                    <div class="input-group date" id='datepicker_fecha_ingreso'>
                      {{Form::text('fecha_ingreso_paciente',NULL ,array('class'=>'form-control ','style'=>'width: 100%', 'readonly'=>''))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>                    
                  </div>                  
                  <div class="col-md-2 pad-controles etiquetas">
                    {{Form::label('ubicacion_hospital_paciente','Ubicación/Sala: ')}} 
                  </div>
                  <div class="col-md-3 pad-controles">
                    {{Form::text('ubicacion_hospital_paciente',NULL,array('class'=>'form-control ','style'=>'width: 100%')) }}
                  </div>
              </div> 
              <div class="row">
                  <div class="col-md-3 pad-controles etiquetas">
                    {{Form::label('resumen_ingreso_paciente','Motivo de admisión: ')}} 
                  </div>
                  <div class="col-md-8 pad-controles">
                    {{Form::textarea('resumen_ingreso_paciente','',array('class'=>'form-control ','size'=>'98x4', 'style'=>'resize:none'))}}
                  </div>                 
              </div>
              <div class="row">
                  <div class="col-md-3 pad-controles etiquetas">
                    {{Form::label('enfermedad_actual_paciente','Enfermedad actual del paciente: ')}} 
                  </div>
                  <div class="col-md-8 pad-controles">
                    {{Form::textarea('enfermedad_actual_paciente','',array('class'=>'form-control ','size'=>'98x4', 'style'=>'resize:none'))}}
                  </div>                
              </div>  


              <div class="row">
                  <div class="col-md-3 pad-controles etiquetas">
                    {{Form::label('diagnostico_admision_paciente','Diagnóstico de admisión: ')}} 
                  </div>
                  <div class="col-md-8 pad-controles">
                    {{Form::textarea('diagnostico_admision_paciente','',array('class'=>'form-control ','size'=>'98x4', 'style'=>'resize:none'))}}
                  </div>
                                 
              </div>              
          </div>
        </div>
        <!--FIN CONTENIDO DEL TERCER PANEL-->
        <!--CUARTO PANEL -->
        <div class="step-pane sample-pane bg-default alert" data-step="4">
{{--           <h4>Ingreso</h4>
          <p>En éste apartado se registra la modalidad de ingreso del paciente al Hospital. </p>
 --}}          <br>
          <div class="form-inline">
            <div class="bg-warning"> 
              <h3 class="text-center text-warning">
              <p>Antes de guardar los datos asegúrese de que estén correctos</p>
             </h3></div>
          </div>
        </div>
        <!-- FIN DEL CUARTO PANEL -->
      </div>
      {{ Form::close()}}
  </div>
</div>

