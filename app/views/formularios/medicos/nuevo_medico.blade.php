
<div class="container-fluid">
  <div class="container">
    <h3>
      Creación de médicos en el SGH
    </h3>
  </div>
</div>
<br>
<div class="panel-body col-xs- col-sm- col-md- col-lg- alineacion_paneles" >
  <div class="wizard" data-initialize="wizard" id="nuevo_medico_wizard">
    <ul class="steps">
      <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Datos personales<span class="chevron"></span></li>
      <li data-step="2"><span class="badge">2</span>Especialidades<span class="chevron"></span></li>
      <li data-step="3" data-name="template"><span class="badge">3</span>Guardar datos!<span class="chevron"></span></li>
    </ul>
    <div class="actions">
      <button type="button" class="btn btn-default btn-prev"><span class="glyphicon glyphicon-arrow-left"></span>Anterior</button>
      <button type="button" class="btn btn-default btn-next" data-last="Complete">Siguiente<span class="glyphicon glyphicon-arrow-right"></span></button>
    </div>
    {{Form::open(['action'=>'MedicosController@crear_nuevo_medico','method'=>'post','class'=>'clearfix','id'=>'formulario_principal'])}}
    <div class="step-content">
      <div class="step-pane active sample-pane alert" data-step="1">
        <h4>Setup Campaign</h4>
        <p>Veggies es bonus vobis, proinde vos postulo essum magis kohlrabi welsh onion daikon amaranth tatsoi tomatillo melon azuki bean garlic. Beetroot water spinach okra water chestnut ricebean pea catsear courgette.</p>
      </div>
      <div class="step-pane sample-pane bg-info alert" data-step="2">
        <h4>Choose Recipients</h4>
        <p>Celery quandong swiss chard chicory earthnut pea potato. Salsify taro catsear garlic gram celery bitterleaf wattle seed collard greens nori. Grape wattle seed kombu beetroot horseradish carrot squash brussels sprout chard. </p>
      </div>
      <div class="step-pane sample-pane bg-danger alert" data-step="3">
        <h4>Design Template</h4>
        <p>Nori grape silver beet broccoli kombu beet greens fava bean potato quandong celery. Bunya nuts black-eyed pea prairie turnip leek lentil turnip greens parsnip. Sea lettuce lettuce water chestnut eggplant winter purslane fennel azuki bean earthnut pea sierra leone bologi leek soko chicory celtuce parsley jÃ­cama salsify. </p>
      </div>
    </div>
    {{Form::close()}}
  </div>
</div>
