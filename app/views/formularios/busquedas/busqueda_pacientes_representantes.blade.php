<h3>
	Módulo de búsqueda de Pacientes, Historias Médicas y Representantes
</h3>
<br>
<div class="container" >
	<div class="col-xs-12" >
		<div class="panel panel-primary" >
		  <div class="panel-heading" ><strong>Panel del búsqueda para pacientes, historias medicas y representantes</strong></div>
		  <div class="panel-body">
			  	<div class="row">
				    <div class="col-xs-4">
				    	<label for="busqueda_fecha_nacimiento">
				    		Por fecha de nacimiento del paciente:				    			
		                      <div class="input-group date" id="busqueda_fecha_nacimiento">
		                        {{Form::text('busqueda_fecha_nacimiento_campo','',array('class'=>'form-control ','style'=>'width: 100%', 'id'=>'busqueda_fecha_nacimiento_campo' ))}}<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
		                      </div>				    			
				    		
				    	</label>		    	
				    </div>
				    <div class="col-xs-4">
				    	<label for="nombres_paciente">
				    		Por nombres del paciente:                      		
				    	</label>
				    	{{Form::text('nombres_paciente',NULL ,array('class'=>'form-control ','style'=>'width: 80%','id'=>'nombres_paciente'))}}

				    </div>
				    <div class="col-xs-4">
				    	<label for="apellidos_paciente">
				    		Por apellidos del paciente:				    		
				    	</label>				    
				    	{{Form::text('apellidos_paciente',NULL ,array('class'=>'form-control ','style'=>'width: 80%','id'=>'apellidos_paciente'))}}
				    	
				    </div>
				</div>
				<br>
			  	<div class="row">
				    <div class="col-xs-4">
				    	<label for="codigo_historia_medica">
				    		Por código de historia médica:
				    	</label>
				    	{{Form::text('codigo_historia_medica',NULL ,array('class'=>'form-control ','style'=>'width: 80%','id'=>'codigo_historia_medica'))}}		    	
				    </div>				    
				    <div class="col-xs-4" >
				    	<label for="documentos_paciente">
				    		Por nacionalidad y cédula del paciente:
				    	</label>
				    	<table >
				    		<tr >
				    			<td width="30%" style="padding: 2px">{{Form::select('tipo_documento_paciente',array(''=>'--','V'=>'V-','E'=>'E-','P'=>'P-'),'',array('class'=>'form-control','style'=>'width: 100%')) }}</td>
				    			<td width="70%" style="padding: 2px">{{Form::text('documento_paciente',NULL ,array('class'=>'form-control ','placeholder'=>'Escriba cédula','style'=>'width: 100%'))}}</td>
				    		</tr>
				    	</table>
				    </div>
				    <div class="col-xs-4" >
				    	<label for="documentos_paciente">
				    		Por nacionalidad y cédula del representante:
				    	</label>
				    	<table  >
				    		<tr width="100%">
				    			<td width="30%" style="padding: 2px">
				    				{{Form::select('tipo_documento_representante',array(''=>'--','V'=>'V-','E'=>'E-','P'=>'P-'),'',array('class'=>'form-control','style'=>'width: 100%')) }}
				    			</td>
				    			<td width="70%" style="padding: 2px">
				    				{{Form::text('documento_representante',NULL ,array('class'=>'form-control ','placeholder'=>'Escriba cédula', 'style'=>'width: 100%'))}}
				    			</td>
				    		</tr>
				    	</table>
				    </div>
				</div>
				<br>
			  	<div class="row">
				    <div class="col-xs-4">
				    	<label for="nombres_paciente">
				    		Por nombres del representante:                      		
				    	</label>
				    	{{Form::text('nombres_paciente',NULL ,array('class'=>'form-control ','style'=>'width: 80%','id'=>'nombres_paciente'))}}

				    </div>
				    <div class="col-xs-4">
				    	<label for="apellidos_paciente">
				    		Por apellidos del representante:				    		
				    	</label>				    
				    	{{Form::text('apellidos_paciente',NULL ,array('class'=>'form-control ','style'=>'width: 80%','id'=>'apellidos_paciente'))}}
				    	
				    </div>
				</div>
				<br>				
				<div class="row">
					<div style=" width: 20%;margin: 0 auto" >
						<button type="button" id="myButton" data-loading-text="Cargando..." class="btn btn-success" autocomplete="off" style="width:100%">
						  Buscar información!
						</button>														
					</div>
				</div>				
		  </div>
		</div>
	</div>
	<br>
	<div id="tabla_resultados" style="display: none">
		
	</div>
</div>