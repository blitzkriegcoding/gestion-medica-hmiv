<div class="container">
<h3>
	Módulo de búsqueda e impresión de la historia médica pediátrica
</h3><br>
	<div class="col-xs-12">
		<div class="col-xs-4"></div>
		<div class="col-xs-4">			
			<div class="panel panel-primary">
			  <div class="panel-heading"><strong>Búsqueda de historia médica pediátrica</strong></div>
			  <div class="panel-body">
				    <div class="col-xs-12">
				    	<label for="codigo_historia_medica">
				    		Introduzca el código historia médica:
				    	</label>				    	
				    	{{Form::text('codigo_historia_medica',NULL ,array('class'=>'form-control ','style'=>'width: 100%','id'=>'codigo_historia_medica', 'placeholder' => 'Ejemplo: V-12345678-01' ))}}
				    	<div style="display:none" id="codigo_historia_medica_error" role="alert"></div>
				    	<br>
				    	<div class="col-xs-2"></div>
				    	<div class="col-xs-8">
							<button type="button" id="buscar_historia" data-loading-text="Cargando..." class="btn btn-success" autocomplete="off" style="width:100%">
							  Buscar historia
							</button>					    		
				    	</div>
				    	<div class="col-xs-2"></div>
						<div>													
						</div>
						<br>
						<br>						
				    </div>
			  </div>
			</div>
		</div>
		<div class="col-xs-4"></div>
			<br>
	<br>
	<br>
	<br>
	</div>

	<div class="col-xs-12">
		<div class="col-xs-2"></div>
		<div class="col-xs-8 panel-primary" id="resultados" style="display:none">
			<table id="tabla_resultados" class="display compact stripe hover cell-border row-border" style="width: 100%" >
			    <thead>
			        <tr>
			            <th class="text-center">N°</th>
			            <th class="text-center">Historia</th>
			            <th class="text-center">Paciente</th>			            
			            <th class="text-center">Pantalla</th>
			            <th class="text-center">PDF</th>
			        </tr>
			    </thead>
			    <tbody class="text-center">
			    </tbody>
			</table>
		</div>
		<div class="col-xs-2"></div>
	</div>
</div>
