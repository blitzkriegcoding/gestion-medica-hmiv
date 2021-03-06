    <p class="lead">
      Examenes de rutina para el ingreso del paciente al HMIV
    </p>

<br>
@if (Session::get('mensaje') )
  <!-- Si hay un mensaje, entonces lo imprimimos y le damos estilo con bootstrap -->
  <div class="container-fluid text-center">
    <div class="col-xs- col-sm- col-md- col-lg-" style="width: 400px; margin: 0 auto; text-align: center">
      <div class={{ '"alert alert-success text-center ' }} >
         <span class="glyphicon glyphicon-ok-sign"></span>{{ " ".Session::get('mensaje')}}
      </div>
    </div>
  </div>  
@endif
<?php 
  $abanico_abierto_signos_vitales ="";
  if(isset($errors))
    {
        #dd($errors);
    }
?>
<div class="fuelux">

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
        <h4>INTERROGATORIO MÉDICO</h4>
        <p>
          <strong>PACIENTE: </strong>{{ $paciente['primer_nombre']." ".$paciente['segundo_nombre']." ".$paciente['primer_apellido']." ".$paciente['segundo_apellido']}}, <strong>EDAD: </strong> {{ $paciente_edad[0]->edad }} <strong>SEXO: </strong>{{ $paciente['sexo'] }}          
        </p>
        
              <div class="alert alert-info col-md-12 column">
                <div class="col-md-1 column">
                  <span class="glyphicon glyphicon-exclamation-sign" style='font-size: 50px;' aria-hidden="true"></span>  
                </div>
                <div class="col-md-11 column">
                    Apartado para cargar los datos suministrados por el representante del paciente pediátrico.<br>
                      <strong>Instrucciones: </strong>Seleccione cada item si fue encontrado NORMAL, ANORMAL o NO/NO APLICA durante el interrogatorio, de no ser asi colocar observación. <strong>Se le recomienda verificar su seleccion antes de ser cargada en el sistema</strong>
                </div>

              </div> 
<div>&nbsp;</div>
        <div class="container-fluid panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
                 <?php $tabs = 0; ?>
                 @foreach ($interrogatorio_items as $item) 
                 <?php 
                    $tabs++; 
                 ?>
                {{-- {{ $aria_expanded }} --}}

                 <div class="panel panel-primary">
                   <div class="panel-heading"  role="tab" id="headingOne{{$tabs}}">
                    <h4 class="panel-title">
                        <a  class="collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne{{$tabs}}" aria-expanded="false"  aria-controls="collapseOne{{$tabs}}">                        
                        {{$item->item_grupo_interrogatorio}}
                        </a>
                      </h4>
                    </div>
                   <?php 
                        $divisor_linea = 0;
                        $contador_items = 0;

/*                        
                        $acordeon_interrogatorio = "";
                        foreach($item->CondicionInterrogatorio as $condicion):
                            if($errors->has('interrogatorio['.$condicion->id_condicion_interrogatorio.']')):
                                $acordeon_interrogatorio = "in";
                            endif;
                        endforeach;
                        {{ $acordeon_interrogatorio }}
                        */
                    ?>
                    <div id="collapseOne{{$tabs}}" class="panel-collapse collapse  " role="tabpanel" aria-labelledby="headingOne{{$tabs}}">
                      <table width="95%" class=" table table-condensed table-hover">
                        <tr>
                           @foreach($item->CondicionInterrogatorio as $l)
                             <?php $divisor_linea++;
                                  $contador_items++;
                             ?>                                      
                                          <td width='10%' class="text-left" valign="middle">
                                           <strong>{{ $item->id_grupo_interrogatorio."-".$contador_items }} {{ $l->item_interrogatorio }}</strong>
                                          </td>
                                          <td width='10%'>                                            
                                             {{Form::select('interrogatorio['.$l->id_condicion_interrogatorio.']',array('0'=>'SELECCIONE','1'=>'NORMAL','2'=>'ANORMAL','3'=>'NO/NO APLICA'),'0',array('class'=>'form-control input-sm',/*'style'=>'width:75%'*/)) }}
                                             {{--VALIDACION ERRORES EN LOS COMBOS --}}
                                              @if($errors->has('interrogatorio.'.$l->id_condicion_interrogatorio))
                                                    <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                                                      @foreach($errors->get('interrogatorio.'.$l->id_condicion_interrogatorio) as $error )
                                                          {{ $error }}
                                                      @endforeach
                                                    </div>
                                              @endif                                           
                                          </td> 
                                          <td width='10%'>
                                            {{-- VALIDACION DEL TEXTO SI LA CONDICION ES ANORMAL --}}
                                             {{Form::text('detalle_interrogatorio['.$l->id_condicion_interrogatorio.']',NULL ,array('class'=>'form-control input-sm','size'=>'12'))}}
                                              @if($errors->has('detalle_interrogatorio.'.$l->id_condicion_interrogatorio))
                                                    <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                                                      @foreach($errors->get('detalle_interrogatorio.'.$l->id_condicion_interrogatorio) as $error )
                                                          {{ $error }}
                                                      @endforeach
                                                    </div>
                                              @endif
                                          </td>
                             @if($divisor_linea % 2 == 0)     
                                {{'</tr>'}}
                             @endif
                            @endforeach
                      </table>
                    </div>
                 </div>
                @endforeach
        </div>
      </div>
      <div class="step-pane active sample-pane alert" data-step="2">
        <h4>EXÁMEN FUNCIONAL</h4>
        <p>
        <strong>PACIENTE: </strong>{{ $paciente['primer_nombre']." ".$paciente['segundo_nombre']." ".$paciente['primer_apellido']." ".$paciente['segundo_apellido']}}, <strong>EDAD: </strong> {{ $paciente_edad[0]->edad }} <strong>SEXO: </strong>{{ $paciente['sexo'] }}          
          
        </p>
              <div class="alert alert-info col-md-12 column">
                <div class="col-md-1 column">
                  <span class="glyphicon glyphicon-exclamation-sign" style='font-size: 50px;' aria-hidden="true"></span>  
                </div>
                <div class="col-md-11 column">
                    El paciente será examinado por el médico para identificar indicios de patologías en el funcionamiento del cuerpo del paciente.<br>
                      <strong>Instrucciones: </strong>Seleccione cada item si fue encontrado NORMAL, ANORMAL o NO/NO APLICA durante el interrogatorio, de no ser asi colocar observación. <strong>Se le recomienda verificar su seleccion antes de ser cargada en el sistema</strong>
                </div>
              </div>         
        <div>&nbsp;</div>
        <div class="container-fluid panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
          <?php $tabs = 0; ?>

          @foreach ($examen_funcional_items as $item)
            <?php $tabs++; ?> 
                 <div class="panel panel-primary">
                    <div class="panel-heading"  role="tab" id="headingTwo{{$tabs}}">
                      <h4 class="panel-title">
                        <a  class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo{{$tabs}}" aria-expanded="false"  aria-controls="collapseTwo{{$tabs}}">                        
                          {{$item->item_grupo_funcional}}
                        </a>
                      </h4>
                    </div>
                   <?php 
                        $divisor_linea = 0;
                        $contador_items = 0; 
                    ?>
                    <div id="collapseTwo{{$tabs}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo{{$tabs}}">
                        <table width="95%" class=" table table-condensed table-hover">                          
                          <tr>
                             @foreach($item->CondicionFuncional as $l)
                               <?php $divisor_linea++;
                                    $contador_items++;
                               ?>                                    
                                            <td width='10%'>
                                             <strong>{{ $item->id_grupo_funcional."-".$contador_items }} {{ $l->item_examen_funcional }}</strong>
                                            </td>
                                            <td width='10%' class="text-left">                                              
                                              {{Form::select('funcional['.$l->id_condicion_examen_funcional.']', array('0'=>'SELECCIONE','1'=>'NORMAL','2'=>'ANORMAL'),'0',array('class'=>'form-control input-sm')) }}
                                              @if($errors->has('funcional.'.$l->id_condicion_examen_funcional))
                                                    <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                                                      @foreach($errors->get('funcional.'.$l->id_condicion_examen_funcional) as $error )
                                                          {{ $error }}
                                                      @endforeach
                                                    </div>
                                              @endif
                                            </td> 
                                            <td width='10%'>
                                               {{Form::text('detalle_funcional['.$l->id_condicion_examen_funcional.']',NULL ,array('class'=>'form-control input-sm','size'=>'12'))}}
                                                @if($errors->has('detalle_funcional.'.$l->id_condicion_examen_funcional))
                                                      <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                                                        @foreach($errors->get('detalle_funcional.'.$l->id_condicion_examen_funcional) as $error )
                                                            {{ $error }}
                                                        @endforeach
                                                      </div>
                                                @endif                                           
                                            </td>
                               @if($divisor_linea % 2 == 0)     
                                  {{'</tr>'}}
                               @endif
                              @endforeach
                        </table>
                    </div>
                 </div>
            @endforeach
        </div>
      </div>
      <div class="step-pane active sample-pane alert" data-step="3">
        <h4>EXÁMEN FÍSICO</h4>
        <p>
          <strong>PACIENTE: </strong>{{ $paciente['primer_nombre']." ".$paciente['segundo_nombre']." ".$paciente['primer_apellido']." ".$paciente['segundo_apellido']}}, <strong>EDAD: </strong> {{ $paciente_edad[0]->edad }} <strong>SEXO: </strong>{{ $paciente['sexo'] }}          
        </p>

        <div class="alert alert-info col-md-12 column">
          <div class="col-md-1 column">
            <span class="glyphicon glyphicon-exclamation-sign" style='font-size: 50px;' aria-hidden="true"></span>  
          </div>
          <div class="col-md-11 column">
              El paciente será examinado por el médico para identificar indicios de patologías en extremidades u órganos externos   del cuerpo del paciente.<br>
                <strong>Instrucciones: </strong>Seleccione cada item si fue encontrado NORMAL, ANORMAL o NO/NO APLICA durante el interrogatorio, de no ser asi colocar observación. <strong>Se le recomienda verificar su seleccion antes de ser cargada en el sistema</strong>
          </div>
        </div>         
        <div>&nbsp;</div>
        
        <div class="container-fluid panel-group" id="accordion3" role="tablist" aria-multiselectable="true">
          <?php $tabs = 0; ?>
          <div class="panel panel-primary">
              <div class="panel-heading"  role="tab" id="headingFour">
                <h4 class="panel-title">
                  <a  class="collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapseFour" aria-expanded="false"  aria-controls="collapseFour">                        
                    SIGNOS VITALES
                  </a>
                </h4>
              </div>                   
           <?php 
                $divisor_linea = 0;
                $contador_items = 0; 
            ?>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">                           
              <table width="95%" class="table table-responsive table-hover" >                          
                <tr >                                    
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('frecuencia_respiratoria','Frecuencia respiratoria (rpm): ') }}
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('frecuencia_respiratoria',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px' )) }} 
                      @if($errors->has('frecuencia_respiratoria'))
                            <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                              @foreach($errors->get('frecuencia_respiratoria') as $error )
                                  {{ $error }}
                              @endforeach
                            </div>
                      @endif                      
                  </td> 
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('frecuencia_cardiaca','Frecuencia cardíaca (lpm): ') }}
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('frecuencia_cardiaca',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px')) }}
                      @if($errors->has('frecuencia_cardiaca'))
                            <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                              @foreach($errors->get('frecuencia_cardiaca') as $error )
                                  {{ $error }}
                              @endforeach
                            </div>
                      @endif                      
                  </td>
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('peso','Peso (Kg): ') }} 
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('peso',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px')) }}
                      @if($errors->has('peso'))
                            <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                              @foreach($errors->get('peso') as $error )
                                  {{ $error }}
                              @endforeach
                            </div>
                      @endif                   
                  </td>                          
                </tr>
                <tr>                                    
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('talla','Talla (cm): ') }}
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('talla',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px')) }}
                      @if($errors->has('talla'))
                            <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                              @foreach($errors->get('talla') as $error )
                                  {{ $error }}
                              @endforeach
                            </div>
                      @endif                   
                  </td> 
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('tension_arterial','Tensión arterial (mmHg): ') }}
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('tension_arterial',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px')) }}
                      @if($errors->has('tension_arterial'))
                            <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                              @foreach($errors->get('tension_arterial') as $error )
                                  {{ $error }}
                              @endforeach
                            </div>
                      @endif                    
                  </td>
                  <td width='150px' class="text-right" style="vertical-align:middle">
                      {{ Form::label('temperatura','Temperatura (°C): ') }} 
                  </td>
                  <td width='60px' class="text-left" style="vertical-align:middle">
                    {{ Form::text('temperatura',NULL,array('class'=>'form-control','size'=>'4','maxlength'=>'4','style'=>'width: 60px')) }}
                      @if($errors->has('temperatura'))
                            <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                              @foreach($errors->get('temperatura') as $error )
                                  {{ $error }}
                              @endforeach
                            </div>
                      @endif                   
                  </td>                          
                </tr>                
              </table>
              </div>                   
          </div>

          @foreach ($examen_fisico_items as $item)
          <?php $tabs++; ?> 
                   <div class="panel panel-primary">
                      <div class="panel-heading"  role="tab" id="headingThree{{$tabs}}">
                        <h4 class="panel-title">
                          <a  class="collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree{{$tabs}}" aria-expanded="false"  aria-controls="collapseThree{{$tabs}}">                        
                            {{$item->item_grupo_fisico}}
                          </a>
                        </h4>
                      </div>                   
                   <?php 
                        $divisor_linea = 0;
                        $contador_items = 0; 
                    ?>
                    <div id="collapseThree{{$tabs}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree{{$tabs}}">
                    <table width="95%" class=" table table-responsive table-hover">                          
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
                                          {{Form::select('fisico['.$l->id_condicion_examen_fisico.']', array('0'=>'SELECCIONE','1'=>'NORMAL','2'=>'ANORMAL'),'0',array('class'=>'form-control input-sm',/*'style'=>'width:75%'*/)) }}
                                          @if($errors->has('fisico.'.$l->id_condicion_examen_fisico))
                                                <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                                                  @foreach($errors->get('fisico.'.$l->id_condicion_examen_fisico) as $error )
                                                      {{ $error }}
                                                  @endforeach
                                                </div>
                                          @endif                                        
                                        </td> 
                                        <td width='10%'>
                                           {{Form::text('detalle_fisico['.$l->id_condicion_examen_fisico.']'/*.$l->id_condicion_examen_fisico.*/, NULL ,array('class'=>'form-control input-sm','size'=>'12'))}}
                                            @if($errors->has('detalle_fisico.'.$l->id_condicion_examen_fisico))
                                                  <div class="alert alert-danger col-xs text-center" style="padding: 2px">
                                                    @foreach($errors->get('detalle_fisico.'.$l->id_condicion_examen_fisico) as $error )
                                                        {{ $error }}
                                                    @endforeach
                                                  </div>
                                            @endif 
                                        </td>                                                                                
                                  {{-- $l->condicion_grupo --}}
                            
                           @if($divisor_linea % 2 == 0)     
                              {{'</tr>'}}
                           @endif
                          @endforeach


                    </table>
                 </div>
                </div>

                @endforeach        
          
        </div>
      </div>
    </div>
    {{ Form::close()}}
</div>
</div>
</div>