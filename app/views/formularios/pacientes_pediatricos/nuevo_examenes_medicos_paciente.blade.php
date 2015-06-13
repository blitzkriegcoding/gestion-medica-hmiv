{{-- dd($interrogatorio_items); --}}
<div class="container-fluid">
  <div class="container">
    <h3>
      Examenes de rutina para el ingreso del paciente al HMIV
    </h3>
  </div>
</div>
<br>
@if (Session::get('mensaje') )
  <!-- Si hay un mensaje, entonces lo imprimimos y le damos estilo con bootstrap -->
  <div class="container-fluid text-center">
    <div class="col-xs- col-sm- col-md- col-lg-" style="text-align: center">
      <div class={{ '"alert text-center '.Session::get('estilo').'"' }}  style="width: 400px; margin: 0 auto;">
        <span class="glyphicon glyphicon-ok-sign"></span>{{ " ".Session::get('mensaje')}}
      </div>
    </div>
  </div>
  <br><br>
@endif
<div class="fuelux">
<div class="alert text-center alert-info"style="width: 400px; margin: 0 auto;">
  <span class="glyphicon glyphicon-paperclip"> </span> <strong>PACIENTE:</strong> {{ $paciente['primer_apellido']." ".$paciente['segundo_apellido'].", ".$paciente['primer_nombre']." ".$paciente['segundo_nombre'] }}
</div>
<br>
<div class="panel-body col-xs- col-sm- col-md- col-lg- alineacion_paneles">
  <div class="wizard" data-initialize="wizard" id="examenes_medicos_paciente_pediatrico">
    <ul class="steps">
      <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Parte I<span class="chevron"></span></li>
      <li data-step="2"><span class="badge">2</span>Parte II<span class="chevron"></span></li>
      <li data-step="3" data-name="template"><span class="badge">3</span>Parte III<span class="chevron"></span></li>
    </ul>
    <div class="actions">
      <button type="button" class="btn btn-default btn-prev"><span class="glyphicon glyphicon-arrow-left">
        </span>Anterior</button>
      <button type="button" class="btn btn-default btn-next" data-last="Guardar">Siguiente<span class="glyphicon glyphicon-arrow-right"></span></button>
    </div>
    {{ Form::open(['action'=>'ExamenesPediatricosController@crear_examenes_paciente_pediatrico','method'=>'post','class'=>'clearfix','id'=>'formulario_principal'])}}
    <div class="step-content">
      <div class="step-pane active sample-pane alert" data-step="1">
        <h4>Interrogatorio</h4>
        <p>Apartado para cargar los datos suministrados por el representante del paciente pediátrico.</p>
        <p><strong>Instrucciones: </strong>Seleccione cada item si fue encontrado normal durante el interrogatorio, de no ser asi colocar observación.</p>        
        <br>
        <br>
        <div class="container-fluid">
                 @foreach ($interrogatorio_items as $item) 

                 <div class="panel panel-primary">
                   <div class="panel-heading"><strong>{{$item->item_grupo_interrogatorio}}</strong></div>
                   
                   <?php 
                        $divisor_linea = 0;
                        $contador_items = 0; 
                    ?>
                    <table width="100%" class=" table table-condensed table-hover">                          
                      <tr>
                         @foreach($item->CondicionInterrogatorio as $l)
                           <?php $divisor_linea++;
                                $contador_items++;
                           ?>
                                    
                                        <td width='10%' class="text-left" valign="middle">
                                         <strong>{{ $item->id_grupo_interrogatorio."-".$contador_items }} {{ $l->item_interrogatorio }}</strong>
                                        </td>
                                        <td width='10%'>
                                          {{-- Form::checkbox('interrogatorio[]',$l->id_condicion_interrogatorio,false, array('class'=>'form-control')) --}}
                                           {{Form::select('interrogatorio['.$l->id_condicion_interrogatorio.']'/*.$l->id_condicion_interrogatorio*/,array('0'=>'SELECCIONE','1'=>'NORMAL','2'=>'ANORMAL'),'0',array('class'=>'form-control input-sm',/*'style'=>'width:75%'*/)) }}
                                        </td> 
                                        <td width='10%'>
                                           {{Form::text('detalle_interrogatorio['.$l->id_condicion_interrogatorio.']'/*.$l->id_condicion_interrogatorio.*/,NULL ,array('class'=>'form-control input-sm','size'=>'12'))}}
                                        </td>                                                                                
                                  {{-- $l->condicion_grupo --}}
                            
                           @if($divisor_linea % 2 == 0)     
                              {{'</tr>'}}
                           @endif
                          @endforeach


                    </table>
                 </div>

                @endforeach

        </div>
      </div>
      <div class="step-pane active sample-pane alert" data-step="2">
        <h4>Exámen funcional</h4>
        <p>El paciente será verificado por el médico para identificar indicios de patologías. </p>
        <br>
        <br>
        <div class="container-fluid">
          @foreach ($examen_funcional_items as $item) 
                 <div class="panel panel-primary">
                   <div class="panel-heading"><strong>{{$item->item_grupo_funcional}}</strong></div>
                   
                   <?php 
                        $divisor_linea = 0;
                        $contador_items = 0; 
                    ?>
                    <table width="100%" class=" table table-condensed table-hover">                          
                      <tr>
                         @foreach($item->CondicionFuncional as $l)
                           <?php $divisor_linea++;
                                $contador_items++;
                           ?>                                    
                                        <td width='10%'>
                                         <strong>{{ $item->id_grupo_funcional."-".$contador_items }} {{ $l->item_examen_funcional }}</strong>
                                        </td>
                                        <td width='10%' class="text-left">
                                          {{-- Form::checkbox('funcional[]', $l->id_condicion_examen_funcional,false, array('class'=>'form-control')) --}}
                                          {{Form::select('funcional['.$l->id_condicion_examen_funcional.']'/*.$l->id_condicion_examen_funcional.*/,array('0'=>'SELECCIONE','1'=>'NORMAL','2'=>'ANORMAL'),'0',array('class'=>'form-control input-sm',/*'style'=>'width:75%'*/)) }}
                                        </td> 
                                        <td width='10%'>
                                           {{Form::text('detalle_funcional['.$l->id_condicion_examen_funcional.']'/*.$l->id_condicion_examen_funcional.*/,NULL ,array('class'=>'form-control input-sm','size'=>'12'))}}
                                        </td>                                                                                
                                  {{-- $l->condicion_grupo --}}
                            
                           @if($divisor_linea % 2 == 0)     
                              {{'</tr>'}}
                           @endif
                          @endforeach


                    </table>
                 </div>

                @endforeach
        </div>
      </div>
      <div class="step-pane active sample-pane alert" data-step="3">
        <h4>Exámen físico</h4>
        <p>Verificación rutinaria del médico al paciente. </p>
        <br>
        <br>
        <div class="container-fluid">
          <div class="panel panel-primary">
             <div class="panel-heading">SIGNOS VITALES</div>
              <table width="100%" class="table table-responsive table-hover" >                          
                <tr >                                    
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('frecuencia_respiratoria','Frecuencia respiratoria (rpm): ') }}
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('frecuencia_respiratoria',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px' )) }} 
                  </td> 
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('frecuencia_cardiaca','Frecuencia cardíaca (lpm): ') }}
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('frecuencia_cardiaca',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px')) }}
                  </td>
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('peso','Peso (Kg): ') }} 
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('peso',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px')) }}
                  </td>                          
                </tr>
                <tr>                                    
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('talla','Talla (cm): ') }}
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('talla',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px')) }}
                  </td> 
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('tension_arterial','Tensión arterial (mmHg): ') }}
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('tension_arterial',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px')) }}
                  </td>
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('temperatura','Temperatura (°C): ') }} 
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('temperatura',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px')) }}
                  </td>                          
                </tr>                
              </table>                   
          </div>


          @foreach ($examen_fisico_items as $item) 
                 <div class="panel panel-primary">
                   <div class="panel-heading">{{$item->item_grupo_fisico}}</div>
                   
                   <?php 
                        $divisor_linea = 0;
                        $contador_items = 0; 
                    ?>
                    <table width="100%" class=" table table-responsive table-hover">                          
                      <tr>
                         @foreach($item->CondicionFisico as $l)
                           <?php $divisor_linea++;
                                $contador_items++;
                           ?>
                                    
                                        <td width='10%'>
                                         <strong>{{ $item->id_grupo_fisico."-".$contador_items }} {{ $l->item_examen_fisico }}</strong>
                                        </td>
                                        <td width='10%' class="text-left">
                                          {{-- Form::checkbox('fisico[]',$l->id_condicion_examen_fisico,false, array('class'=>'form-control')) --}}
                                          {{Form::select('fisico['.$l->id_condicion_examen_fisico.']'/*.$l->id_condicion_examen_fisico.*/, array('0'=>'SELECCIONE','1'=>'NORMAL','2'=>'ANORMAL'),'0',array('class'=>'form-control input-sm',/*'style'=>'width:75%'*/)) }}
                                        </td> 
                                        <td width='10%'>
                                           {{Form::text('detalle_fisico['.$l->id_condicion_examen_fisico.']'/*.$l->id_condicion_examen_fisico.*/, NULL ,array('class'=>'form-control input-sm','size'=>'12'))}}
                                        </td>                                                                                
                                  {{-- $l->condicion_grupo --}}
                            
                           @if($divisor_linea % 2 == 0)     
                              {{'</tr>'}}
                           @endif
                          @endforeach


                    </table>
                 </div>

                @endforeach        
          
        </div>
      </div>
    </div>
    {{ Form::close()}}
</div>
</div>
</div>