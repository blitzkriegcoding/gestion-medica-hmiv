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
    {{ Form::open()}}
    <div class="step-content">
      <div class="step-pane active sample-pane alert" data-step="1">
        <h4>Interrogatorio</h4>
        <p>Apartado para cargar los datos suministrados por el representante del paciente pediátrico.</p>
        <br>
        <br>
        <div class="container-fluid">
                 @foreach ($interrogatorio_items as $item) 

                 <div class="panel panel-primary">
                   <div class="panel-heading">{{$item->grupo}}</div>
                   
                   <?php 
                        $divisor_linea = 0;
                        $contador_items = 0; 
                    ?>
                    <table width="100%" class=" table table-condensed table-hover">                          
                      <tr>
                         @foreach($item->condicion as $l)
                           <?php $divisor_linea++;
                                $contador_items++;
                           ?>
                                    
                                        <td width='10%'>
                                         <strong>{{ $item->id_grupo."-".$contador_items }} {{ $l->condicion_grupo }}</strong>
                                        </td>
                                        <td width='2%'>
                                          {{ Form::checkbox('interrogatorio_'.$l->id_condicion_grupo,$l->id_condicion_grupo,false, array('class'=>'form-control')) }}
                                        </td> 
                                        <td width='15%'>
                                           {{Form::text('detalle_'.$l->id_condicion_grupo,NULL ,array('class'=>'form-control input-sm','size'=>'12'))}}
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
                   <div class="panel-heading">{{$item->grupo_examen}}</div>
                   
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
                                         <strong>{{ $item->id_grupo_examen."-".$contador_items }} {{ $l->condicion }}</strong>
                                        </td>
                                        <td width='5%' class="text-left">
                                          {{ Form::checkbox('funcional_'.$l->id_condicion_examen,$l->id_condicion_examen,false, array('class'=>'form-control')) }}
                                        </td> 
                                        <td width='15%'>
                                           {{Form::text('detalle_funcional_'.$l->id_condicion_examen,NULL ,array('class'=>'form-control input-sm','size'=>'12'))}}
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
          @foreach ($examen_fisico_items as $item) 
                 <div class="panel panel-primary">
                   <div class="panel-heading">{{$item->examen_fisico}}</div>
                   
                   <?php 
                        $divisor_linea = 0;
                        $contador_items = 0; 
                    ?>
                    <table width="100%" class=" table table-condensed table-hover">                          
                      <tr>
                         @foreach($item->CondicionFisico as $l)
                           <?php $divisor_linea++;
                                $contador_items++;
                           ?>
                                    
                                        <td width='10%'>
                                         <strong>{{ $item->id_grupo_examen_fisico."-".$contador_items }} {{ $l->examen_fisico_condicion }}</strong>
                                        </td>
                                        <td width='5%' class="text-left">
                                          {{ Form::checkbox('fisico_'.$l->id_grupo_examen_fisico_condicion,$l->id_grupo_examen_fisico_condicion,false, array('class'=>'form-control')) }}
                                        </td> 
                                        <td width='15%'>
                                           {{Form::text('detalle_fisico_'.$l->id_grupo_examen_fisico_condicion,NULL ,array('class'=>'form-control input-sm','size'=>'12'))}}
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