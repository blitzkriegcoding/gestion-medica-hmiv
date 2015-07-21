$(document).ready( function () {
    $ventana_modal_consultas_medicas = $('#ventana_modal_consultas');
    
    $("#imagenes_examenes")
      .fileinput(
                  { 
                    language:               'es',                    
                    maxFileSize:            2048,
                    showUpload:             true, 
                    showPreview:            false,
                    showCaption:            true,
                    allowedFileExtensions:  ["jpg", "png", "bmp"],
                    minFileCount:           1,
                    maxFileCount:           10,
                    uploadUrl:              '../../historias_medicas_pediatricas/guardar_examenes_medicos',
                    uploadAsync:            true,
                    uploadExtraData: function() 
                            {
                              return  {
                                        'fecha_examen':       $('#fecha_examen').val(),
                                        'medico_ordenante':   $('#medico_ordenante').val(),
                                        'nombre_examen':      $('#nombre_examen').val(),
                                        'descripcion_examen': $('#descripcion_examen').val()
                                      };
                            },
                  }
                )
          .on('filebatchuploadsuccess', function(event, data, previewId, index) 
            {               
                var response = data.response;
                $('#mensaje_examenes_medicos').show('slow').attr('class',response.clase).html(response.success);
               
            })
          .on('filebatchuploaderror', function(event, data, previewId, index) {
                var response = data.response;
                $.each(response.error, function (a,b)
                      {                       
                        $('#'+a+"_error").show().attr('class',response.clase).html(b);
                      }
                  );                
            });

     var tabla = $('#consultas_historico').DataTable(
        {
              'searching':  false,
              'ordering':   true,
              "pageLength": 3,
              "lengthChange": false,
              "ajax": 
                      {
                          "type"    : "GET",
                          "url"     : "../../historias_medicas_pediatricas/recargar_historico_consultas",
                          "dataSrc" : ""
                      },
              "language": {
                            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "infoEmpty":      "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "paginate": {
                                          "first":      "Primera",
                                          "last":       "Última",
                                          "next":       "Siguiente",
                                          "previous":   "Anterior"
                                },
                              "processing":     "Procesando...",
                              "loadingRecords": "Cargando registros...",
                              "lengthMenu":     "Mostrar _MENU_ registros",
                              "emptyTable":     "Sin datos cargados aun",
                              "search":         "Buscar: ",
                          },                        
              'columns' : [
                            { "data" : "fecha_consulta"   },
                            { "data" : "especialidad"     },
                            { "data" : "asistio_consulta" },
                            { "data" : "cerrar_consulta" },
                          ],
        });

     var tabla_examenes = $('#examenes_historico').DataTable(
        {
              'searching':  false,
              'ordering':   true,
              "pageLength": 3,
              "lengthChange": false,
              "ajax": 
                      {
                          "type"    : "GET",
                          "url"     : "../../historias_medicas_pediatricas/obtener_historico_examenes",
                          "dataSrc" : ""
                      },
              'columns' : [
                            { "data" : "num_exa"        },
                            { "data" : "fecha_examen"   },
                            { "data" : "nombre_examen"  },
                            { "data" : "detalles"       },
                            { "data" : "borrar"         },
                          ],
        });

     var tabla_tratamientos = $('#tratamientos_historico').DataTable(
        {
              'searching':  false,
              'ordering':   true,
              "pageLength": 3,
              "lengthChange": false,
              "ajax": 
                      {
                          "type"    : "GET",
                          "url"     : "../../historias_medicas_pediatricas/obtener_historico_tratamientos",
                          "dataSrc" : ""
                      },
              "language": {
                            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "infoEmpty":      "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "paginate": {
                                          "first":      "Primera",
                                          "last":       "Última",
                                          "next":       "Siguiente",
                                          "previous":   "Anterior"
                                },
                              "processing":     "Procesando...",
                              "loadingRecords": "Cargando registros...",
                              "lengthMenu":     "Mostrar _MENU_ registros",
                              "emptyTable":     "Sin datos cargados aun",
                              "search":         "Buscar: ",
                          },                      
              'columns' : [
                            { "data" : "num_tra"  },
                            { "data" : "fec_tra"  },                            
                            { "data" : "detalles" },
                            { "data" : "borrar"   },
                          ],
        });     

    var tabla_vacunas = $('#vacunas_historico').DataTable(
        {
              'searching':  false,
              'ordering':   true,
              "pageLength": 3,
              "lengthChange": false,
              "ajax": 
                      {
                          "type"    : "GET",
                          "url"     : "../../historias_medicas_pediatricas/obtener_historico_vacunas",
                          "dataSrc" : ""
                          
                      },
              "language": {
                            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "infoEmpty":      "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "paginate": {
                                          "first":      "Primera",
                                          "last":       "Última",
                                          "next":       "Siguiente",
                                          "previous":   "Anterior"
                                },
                              "processing":     "Procesando...",
                              "loadingRecords": "Cargando registros...",
                              "lengthMenu":     "Mostrar _MENU_ registros",
                              "emptyTable":     "Sin datos cargados aun",
                              "search":         "Buscar: ",
                          },                        
              'columns' : [
                            { "data" : "fecha_vacunacion" },
                            { "data" : "tipo_vacuna"      },
                            { "data" : "edad"             },
                            { "data" : "refuerzo"         },
                            { "data" : "boton_quitar"     },
                          ],
        });

    var tabla_patologias = $('#patologias_historico').DataTable(
        {
              'searching':  false,
              'ordering':   true,
              "pageLength": 4,
              "lengthChange": false,
              "ajax": 
                      {
                          "type"    : "GET",
                          "url"     : "../../historias_medicas_pediatricas/obtener_patologias_paciente",
                          "dataSrc" : ""                          
                      },
              "language": {
                            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "infoEmpty":      "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "paginate": {
                                          "first":      "Primera",
                                          "last":       "Última",
                                          "next":       "Siguiente",
                                          "previous":   "Anterior"
                                },
                              "processing":     "Procesando...",
                              "loadingRecords": "Cargando registros...",
                              "lengthMenu":     "Mostrar _MENU_ registros",
                              "emptyTable":     "Sin datos cargados aun",
                              "search":         "Buscar: ",
                          },                        
              'columns' : [
                            { "data" : "num_pac"    },
                            { "data" : "patologia"  },
                            { "data" : "borrar"  },
                          ],
        });

    var tabla_alergias = $('#alergias_historico').DataTable(
        {
              'searching':  false,
              'ordering':   true,
              "pageLength": 4,
              "lengthChange": false,
              "ajax": 
                      {
                          "type"    : "GET",
                          "url"     : "../../historias_medicas_pediatricas/obtener_alergias_paciente",
                          "dataSrc" : ""                          
                      },
              "language": {
                            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "infoEmpty":      "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "paginate": {
                                          "first":      "Primera",
                                          "last":       "Última",
                                          "next":       "Siguiente",
                                          "previous":   "Anterior"
                                },
                              "processing":     "Procesando...",
                              "loadingRecords": "Cargando registros...",
                              "lengthMenu":     "Mostrar _MENU_ registros",
                              "emptyTable":     "Sin datos cargados aun",
                              "search":         "Buscar: ",
                          },                        
              'columns' : [
                            { "data" : "num_ale"  },
                            { "data" : "alergia"  },
                            { "data" : "borrar"   },
                          ],
        });

    var tabla_intolerancias = $('#intolerancias_historico').DataTable(
        {
              'searching':  false,
              'ordering':   true,
              "pageLength": 4,
              "lengthChange": false,
              "ajax": 
                      {
                          "type"    : "GET",
                          "url"     : "../../historias_medicas_pediatricas/obtener_intolerancias_paciente",
                          "dataSrc" : ""                          
                      },
              "language": {
                            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "infoEmpty":      "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "paginate": {
                                          "first":      "Primera",
                                          "last":       "Última",
                                          "next":       "Siguiente",
                                          "previous":   "Anterior"
                                },
                              "processing":     "Procesando...",
                              "loadingRecords": "Cargando registros...",
                              "lengthMenu":     "Mostrar _MENU_ registros",
                              "emptyTable":     "Sin datos cargados aun",
                              "search":         "Buscar: ",
                          },                        
              'columns' : [
                            { "data" : "num_int"  },
                            { "data" : "intolerancia"  },
                            { "data" : "borrar"   },
                          ],
        });

    var tabla_hospitalizacion = $('#historico_hospitalizacion').DataTable(
        {
              'searching':  false,
              'ordering':   true,
              "pageLength": 4,
              "lengthChange": false,
              "ajax": 
                      {
                          "type"    : "GET",
                          "url"     : "../../historias_medicas_pediatricas/obtener_hospitalizacion_paciente",
                          "dataSrc" : ""                          
                      },
              "language": {
                            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "infoEmpty":      "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "paginate": {
                                          "first":      "Primera",
                                          "last":       "Última",
                                          "next":       "Siguiente",
                                          "previous":   "Anterior"
                                },
                              "processing":     "Procesando...",
                              "loadingRecords": "Cargando registros...",
                              "lengthMenu":     "Mostrar _MENU_ registros",
                              "emptyTable":     "Sin datos cargados aun",
                              "search":         "Buscar: ",
                          },                        
              'columns' : [
                            { "data" : "num_hos"      },
                            { "data" : "fecha"        },
                            { "data" : "piso"         },
                            { "data" : "sala"         },
                            { "data" : "codigo_cama"  },
                            { "data" : "alta"         },
                            { "data" : "detalles"     },
                            { "data" : "borrar"       },
                          ],
        });    


      $('#consultas_historico').delegate("button.btn-danger","click", function(event)

              {
                    var obj = this;                    
                    $.ajax({
                      url: "../../historias_medicas_pediatricas/anular_consulta_medica",
                      type: "POST",
                      data: { 'id_consulta_paciente': obj.id },
                      contentType: 'application/x-www-form-urlencoded',
                      dataType: 'json',
                      success: function(respuesta) 
                        { 
                          $('#mensajes').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);
                          tabla.ajax.reload();
                        },
                      error: function(respuesta)
                        {
                          $('#mensajes').html(respuesta['especialidad_consulta']);
                          $('#mensajes').html(respuesta['turno_consulta']);
                          $('#mensajes').html(respuesta['fecha_consulta']);                  
                        }

                    });
                    
              }
          );

      $('#consultas_historico').delegate("button.btn-success","click", function(event)

              {
/*                
                    var obj = this;                    
                    $.ajax({
                      url: "../../historias_medicas_pediatricas/anular_consulta_medica",
                      type: "POST",
                      data: { 'id_consulta_paciente': obj.id },
                      contentType: 'application/x-www-form-urlencoded',
                      dataType: 'json',
                      success: function(respuesta) 
                        { 
                          $('#mensajes').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);
                          tabla.ajax.reload();
                        },
                      error: function(respuesta)
                        {
                          $('#mensajes').html(respuesta['especialidad_consulta']);
                          $('#mensajes').html(respuesta['turno_consulta']);
                          $('#mensajes').html(respuesta['fecha_consulta']);                  
                        }

                    });
                    */
                    $ventana_modal_consultas_medicas.modal('show');
              }
          );

      $('#vacunas_historico').delegate("button","click", function(event)
              {
                    var obj = this;                    
                    $.ajax({
                      url: "../../historias_medicas_pediatricas/borrar_vacuna_aplicada",
                      type: "POST",
                      data: { 'id_vacuna': obj.id },
                      contentType: 'application/x-www-form-urlencoded',
                      dataType: 'json',
                      success: function(respuesta) 
                        { 
                          switch(respuesta['bandera'])
                            {
                              case 1:
                                var mensaje = "";
                                $.each(respuesta['mensaje'], function (a,b)
                                      {
                                        $('#mensaje_vacuna').show().attr('class',respuesta['clase']).html(b);
                                      }                             
                                  );                                
                              break;
                              case 2:                                
                                $('#mensaje_vacuna').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                              break;
                            }                          
                          tabla_vacunas.ajax.reload();
                        },
                      error: function(respuesta)
                        {

                        }

                    });
              }
          );

      $('#tratamientos_historico').delegate("button.btn-danger","click", function(event)
              {
                    var obj = this;                    
                    $.ajax({
                      url: "../../historias_medicas_pediatricas/borrar_tratamiento_guardado",
                      type: "POST",
                      data: { 'id_tratamiento': obj.id },
                      contentType: 'application/x-www-form-urlencoded',
                      dataType: 'json',
                      success: function(respuesta) 
                        {                 
                          switch(respuesta['bandera'])
                            {
                              case 1:
                                var mensaje = "";
                                $.each(respuesta['mensaje'], function (a,b)
                                      {
                                        $('#mensaje_tratamientos_medicos').show().attr('class',respuesta['clase']).html(b);
                                      }                             
                                  );                                
                              break;
                              case 2:                                
                                $('#mensaje_tratamientos_medicos').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                              break;
                            }                 
                          tabla_tratamientos.ajax.reload();
                        },
                      error: function(respuesta)
                        {

                        }

                    });
              }
          );

//PARA EL BORRADO DE PATOLOGIAS DEL PACIENTE
      $('#patologias_historico').delegate("button","click", function(event)
              {
                    var obj = this;                    
                    $.ajax({
                      url: "../../historias_medicas_pediatricas/borrar_patologia_guardada",
                      type: "POST",
                      data: { 'id_patologia_historia': obj.id },
                      contentType: 'application/x-www-form-urlencoded',
                      dataType: 'json',
                      success: function(respuesta) 
                        {                 
                          //alert(respuesta['cola']);
                          //$('#cola').show().attr('class','label label-success').html(respuesta['cola']);
                          //$('#mensajes').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);
                          switch(respuesta['bandera'])
                            {
                              case 1:
                                var mensaje = "";
                                $.each(respuesta['mensaje'], function (a,b)
                                      {
                                        $('#mensaje_patologia').show().attr('class',respuesta['clase']).html(b);
                                      }                             
                                  );                                
                              break;
                              case 2:                                
                                $('#mensaje_patologia').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                              break;
                            }                          
                          tabla_patologias.ajax.reload();
                        },
                      error: function(respuesta)
                        {

                        }

                    });
              }
          );


//Para el borrado de alergias del paciente
      $('#alergias_historico').delegate("button","click", function(event)
              {
                    var obj = this;                    
                    $.ajax({
                      url: "../../historias_medicas_pediatricas/borrar_alergia_guardada",
                      type: "POST",
                      data: { 'alergia_detectada': obj.id },
                      contentType: 'application/x-www-form-urlencoded',
                      dataType: 'json',
                      success: function(respuesta) 
                        {                 
                          //alert(respuesta['cola']);
                          //$('#cola').show().attr('class','label label-success').html(respuesta['cola']);
                          //$('#mensajes').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);
                          switch(respuesta['bandera'])
                            {
                              case 1:
                                var mensaje = "";
                                $.each(respuesta['mensaje'], function (a,b)
                                      {
                                        $('#mensaje_alergia_intolerancia').show().attr('class',respuesta['clase']).html(b);
                                      }                             
                                  );                                
                              break;
                              case 2:                                
                                $('#mensaje_alergia_intolerancia').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                              break;
                            }                          
                          tabla_alergias.ajax.reload();
                        },
                      error: function(respuesta)
                        {

                        }

                    });
              }
          );
//Para el borrado de intolerancias del paciente
      $('#intolerancias_historico').delegate("button","click", function(event)
              {
                    var obj = this;                    
                    $.ajax({
                      url: "../../historias_medicas_pediatricas/borrar_intolerancia_guardada",
                      type: "POST",
                      data: { 'intolerancia_detectada': obj.id },
                      contentType: 'application/x-www-form-urlencoded',
                      dataType: 'json',
                      success: function(respuesta) 
                        {                 
                          //alert(respuesta['cola']);
                          //$('#cola').show().attr('class','label label-success').html(respuesta['cola']);
                          //$('#mensajes').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);
                          switch(respuesta['bandera'])
                            {
                              case 1:
                                var mensaje = "";
                                $.each(respuesta['mensaje'], function (a,b)
                                      {
                                        $('#mensaje_alergia_intolerancia').show().attr('class',respuesta['clase']).html(b);
                                      }                             
                                  );                                
                              break;
                              case 2:                                
                                $('#mensaje_alergia_intolerancia').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                              break;
                            }                 
                          tabla_intolerancias.ajax.reload();
                        },
                      error: function(respuesta)
                        {
                        }

                    });
              }
          );

//Para el borrado de hospitalizacion del paciente
      $('#historico_hospitalizacion').delegate("button.btn-danger","click", function(event)
              {
                    var obj = this;                    
                    $.ajax({
                      url: "../../historias_medicas_pediatricas/borrar_hospitalizacion_guardada",
                      type: "POST",
                      data: { 'id_hospitalizacion': obj.id },
                      contentType: 'application/x-www-form-urlencoded',
                      dataType: 'json',
                      success: function(respuesta) 
                        {                 
                          switch(respuesta['bandera'])
                            {
                              case 1:
                                var mensaje = "";
                                $.each(respuesta['mensaje'], function (a,b)
                                      {
                                        $('#mensaje_hospitalizacion').show().attr('class',respuesta['clase']).html(b);
                                      }                             
                                  );                                
                              break;
                              case 2:                                
                                $('#mensaje_hospitalizacion').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                              break;
                            }        

                                              
                          tabla_hospitalizacion.ajax.reload();
                        },
                      error: function(respuesta)
                        {

                        }

                    });
              }
          );



      //fecha de consultas de hoy hasta dentro de dos semanas
      function rangoFechaConsultas(id_control,num_dias)
        {
          var fecha_maxima = new Date();
            fecha_maxima = new Date(fecha_maxima.getFullYear(), fecha_maxima.getMonth(), fecha_maxima.getDate() + num_dias);          
            $('#'+id_control)
              .datepicker
                ({
                  language: 'es',
                  format: 'dd/mm/yyyy',
                  autoclose: true,            
                  endDate: new Date(fecha_maxima),
                  todayBtn: true,
                  todayHighlight: true,
                  startView: 0,
                  daysOfWeekDisabled: [0,6]
                })
              .on
                ('changeDate', function(e) {
                  // Revalidate the date field
                  $('#formulario_principal').formValidation('revalidateField', '#'+id_control);
                });
        }
      rangoFechaConsultas('fecha_consulta_paciente',15);
      rangoFechaConsultas('fecha_aplicacion_vacuna',0);
      rangoFechaConsultas('fecha_examen_paciente',0);
      rangoFechaConsultas('fecha_hospitalizacion_paciente',0);
      rangoFechaConsultas('fecha_tratamiento_medico',0);


      function verificarColaConsultas()
        {   
            $('#fecha_consulta_error').hide();
            $('#especialidad_consulta_error').hide();
            $('#turno_consulta_error').hide();

            $.ajax({
              url: "../../historias_medicas_pediatricas/cola_consultas",
              type: "POST",
              data: { 'fecha_consulta': $('#fecha_consulta').val(), 'especialidad_consulta': $('#especialidad_consulta').val(), 'turno_consulta': $('#turno_consulta').val() },
              contentType: 'application/x-www-form-urlencoded',
              dataType: 'json',
              success: function(respuesta) 
                {
                  switch(respuesta['bandera'])
                    {
                      case 1:
                        var mensaje = "";

                        $.each(respuesta['mensaje'], function (a,b)
                              {
                                $('#'+a+"_error").show().attr('class',respuesta['clase']).html(b);
                              }                             
                          );
                        
                      break;

                      case 2:
                        $('#cola_consulta').show().attr('class',respuesta['clase']).html(respuesta['cola']);
                        $('#mensajes_consulta').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                      break;

                      case 3:
                        $('#cola_consulta').show().attr('class',respuesta['clase']).html(respuesta['cola']);
                      break;

                      case 4:
                        $('#cola_consulta').show().attr('class',respuesta['clase']).html(respuesta['cola']);
                        $('#mensajes_consulta').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                    

                      break;
                    }
                    tabla.ajax.reload();    

                },
              error: function(respuesta)
                {
                  $('#mensajes').html(respuesta['especialidad_consulta']);
                  $('#mensajes').html(respuesta['turno_consulta']);
                  $('#mensajes').html(respuesta['fecha_consulta']);                  
                }

            });            
        }
      function cargarConsulta()
        {   
            $.ajax({
              url: "../../historias_medicas_pediatricas/cargar_consulta_nueva",
              type: "POST",
              data: { 'fecha_consulta': $('#fecha_consulta').val(), 'especialidad_consulta': $('#especialidad_consulta').val(), 'turno_consulta': $('#turno_consulta').val() },
              contentType: 'application/x-www-form-urlencoded',
              dataType: 'json',
              success: function(respuesta) 
                {                 
                  switch(respuesta['bandera'])
                    {
                      case 1:
                        var mensaje = "";

                        $.each(respuesta['mensaje'], function (a,b)
                              {
                                $('#'+a+"_error").show().attr('class',respuesta['clase']).html(b);
                              }                             
                          );
                        
                      break;

                      case 2:
                        $('#cola_consulta').show().attr('class',respuesta['clase']).html(respuesta['cola']);
                        $('#mensajes_consulta').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                      break;

                      case 3:
                        $('#cola_consulta').show().attr('class',respuesta['clase']).html(respuesta['cola']);
                        //$('#mensajes_consulta').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      


                      break;

                      case 4:
                        $('#cola_consulta').show().attr('class',respuesta['clase']).html(respuesta['cola']);
                        $('#mensajes_consulta').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                    

                      break;
                    }
                    tabla.ajax.reload(); 


                },
              error: function(respuesta)
                {
                  $('#mensajes').html(respuesta['especialidad_consulta']);
                  $('#mensajes').html(respuesta['turno_consulta']);
                  $('#mensajes').html(respuesta['fecha_consulta']);                  
                }

            });            
        }

       
      function cargarVacuna()
        {   
            $('#fecha_vacuna_error').hide();
            $('#vacuna_aplicada_error').hide();
            $('#refuerzo_vacuna_error').hide();


            $.ajax({
              url: "../../historias_medicas_pediatricas/cargar_vacuna_nueva",
              type: "POST",
              data: { 'fecha_vacuna': $('#fecha_vacuna').val(), 'vacuna_aplicada': $('#vacuna_aplicada').val(), 'refuerzo_vacuna': $('#refuerzo_vacuna').val() },
              contentType: 'application/x-www-form-urlencoded',
              dataType: 'json',
              success: function(respuesta) 
                {
                  switch(respuesta['bandera'])
                    {

                      case 1:
                        var mensaje = "";

                        $.each(respuesta['mensaje'], function (a,b)
                              {
                                //mensaje += a+" corresponde a "+b + "<br>";
                                $('#'+a+"_error").show().attr('class',respuesta['clase']).html(b);
                              }
                          );
                      break;

                      case 2:
                        $('#mensaje_vacuna').show('slow').attr('class',respuesta['clase']).html(respuesta['mensaje']);
                      break;

                      case 3:
                        $('#mensaje_vacuna').show('slow').attr('class',respuesta['clase']).html(respuesta['mensaje']);
                      break;
                    }
                  
                  tabla_vacunas.ajax.reload();


                },
              error: function(respuesta)
                {
                  $('#mensajes').html(respuesta['especialidad_consulta']);
                  $('#mensajes').html(respuesta['turno_consulta']);
                  $('#mensajes').html(respuesta['fecha_consulta']);                  
                }

            });            
        }

 function cargarTratamiento()
        {   
            $('#fecha_tratamiento_error').hide();
            $('#medico_ordenante_tratamiento_error').hide();
            $('#descripcion_tratamiento_error').hide();


            $.ajax({
              url: "../../historias_medicas_pediatricas/cargar_tratamiento_nuevo",
              type: "POST",
              data: { 'fecha_tratamiento': $('#fecha_tratamiento').val(), 'medico_ordenante_tratamiento': $('#medico_ordenante_tratamiento').val(), 'descripcion_tratamiento': $('#descripcion_tratamiento').val() },
              contentType: 'application/x-www-form-urlencoded',
              dataType: 'json',
              success: function(respuesta) 
                {
                  switch(respuesta['bandera'])
                    {
                      case 1:
                        var mensaje = "";
                        $.each(respuesta['mensaje'], function (a,b)
                              {
                                $('#'+a+"_error").show().attr('class',respuesta['clase']).html(b);
                              }
                          );
                      break;
                      case 2:
                        $('#mensaje_tratamientos_medicos').show('slow').attr('class',respuesta['clase']).html(respuesta['mensaje']);
                      break;

                    }
                  
                  tabla_tratamientos.ajax.reload();


                },
              error: function(respuesta)
                {
                  $('#mensajes').html(respuesta['especialidad_consulta']);
                  $('#mensajes').html(respuesta['turno_consulta']);
                  $('#mensajes').html(respuesta['fecha_consulta']);                  
                }

            });            
        }

      function cargarPatologia()
        {   
            $.ajax({
              url: "../../historias_medicas_pediatricas/cargar_patologia_nueva",
              type: "POST",
              data: { 'patologia_detectada': $('#patologia_detectada').val() },
              contentType: 'application/x-www-form-urlencoded',
              dataType: 'json',
              success: function(respuesta) 
                {                 
                  switch(respuesta['bandera'])
                    {
                      case 1:
                        var mensaje = "";

                        $.each(respuesta['mensaje'], function (a,b)
                              {
                                $('#'+a+"_error").show().attr('class',respuesta['clase']).html(b);
                              }                             
                          );
                        
                      break;

                      case 2:                        
                        $('#mensaje_patologia').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                      break;
                    }
                  tabla_patologias.ajax.reload();
                },
              error: function(respuesta)
                {
                 
                }

            });            
        }    

      function cargarAlergia()
        {   
            $.ajax({
              //url: "../../historias_medicas_pediatricas/cargar_alergia_nueva",
              url: "../../historias_medicas_pediatricas/cargar_alergia_nueva",
              type: "POST",
              data: { 'alergia_detectada': $('#alergia_detectada').val() },
              contentType: 'application/x-www-form-urlencoded',
              dataType: 'json',
              success: function(respuesta) 
                {                 
                  switch(respuesta['bandera'])
                    {
                      case 1:
                        var mensaje = "";

                        $.each(respuesta['mensaje'], function (a,b)
                              {

                                $('#'+a+"_error").show().attr('class',respuesta['clase']).html(b);
                              }                             
                          );
                        
                      break;

                      case 2:                        
                        $('#mensaje_alergia_intolerancia').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                      break;
                    }
                  tabla_alergias.ajax.reload();
                },
              error: function(respuesta)
                {
                 
                }

            });            
        }             

      function cargarIntolerancia()
        {   
            $.ajax({
              //url: "../../historias_medicas_pediatricas/cargar_alergia_nueva",
              url: "../../historias_medicas_pediatricas/cargar_intolerancia_nueva",
              type: "POST",
              data: { 'intolerancia_detectada': $('#intolerancia_detectada').val() },
              contentType: 'application/x-www-form-urlencoded',
              dataType: 'json',
              success: function(respuesta) 
                {                 
                  switch(respuesta['bandera'])
                    {
                      case 1:
                        var mensaje = "";                       
                        $.each(respuesta['mensaje'], function (a,b)
                              {                                
                                $('#'+a+"_error").show().attr('class',respuesta['clase']).html(b);
                              }                             
                          );                        
                      break;

                      case 2:                        
                        $('#mensaje_alergia_intolerancia').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                      break;

                      

                    }
                  tabla_intolerancias.ajax.reload();
                },
              error: function(respuesta)
                {
                 
                }

            });            
        }   

      function cargarHospitalizacion()
        {   
            $.ajax({              
              url: "../../historias_medicas_pediatricas/cargar_hospitalizacion_nueva",
              type: "POST",
              data: { 
                        'fecha_hospitalizacion'           : $('#fecha_hospitalizacion').val(),
                        'piso_hospitalizacion'            : $('#piso_hospitalizacion').val(),
                        'sala_hospitalizacion'            : $('#sala_hospitalizacion').val(),
                        'codigo_cama_hospitalizacion'     : $('#codigo_cama_hospitalizacion').val(),
                        'observaciones_hospitalizacion'   : $('#observaciones_hospitalizacion').val(),
                    },
              contentType: 'application/x-www-form-urlencoded',
              dataType: 'json',
              success: function(respuesta) 
                {                 
                  switch(respuesta['bandera'])
                    {
                      case 1:
                        var mensaje = "";
                        $.each(respuesta['mensaje'], function (a,b)
                              {
                                $('#'+a+"_error").show().attr('class',respuesta['clase']).html(b);
                              }                             
                          );                        
                      break;

                      case 2:                        
                        $('#mensaje_hospitalizacion').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);                      
                      break;
                    }
                  tabla_hospitalizacion.ajax.reload();
                },
              error: function(respuesta)
                {
                 
                }

            });            
        }   


  $('#visualiza_cola').on('click', function () {    
    var $btn = $(this).button('loading');
    verificarColaConsultas();

    tabla.ajax.reload();    
    $btn.button('reset');
  });

    $('#carga_consulta').on('click', function () {    
    var $btn = $(this).button('loading');
    cargarConsulta();    
    $btn.button('reset');
  });

  $('#cargar_vacuna').on('click', function () {    
    var $btn = $(this).button('loading');
    cargarVacuna();
    $btn.button('reset');
  });

//cargarTratamiento

  $('#guardar_tratamiento').on('click', function () {    
    var $btn = $(this).button('loading');
    cargarTratamiento();
    $btn.button('reset');
  });

  $('#guardar_patologia').on('click', function () {    
    var $btn = $(this).button('loading');
    cargarPatologia();
    $btn.button('reset');
  });

  $('#guardar_alergia').on('click', function () {    
    var $btn = $(this).button('loading');
    cargarAlergia();
    $btn.button('reset');
  });

  //cargarIntolerancia

    $('#guardar_intolerancia').on('click', function () {    
    var $btn = $(this).button('loading');
    cargarIntolerancia();
    $btn.button('reset');
  });

    $('#carga_hospitalizacion').on('click', function () {    
    var $btn = $(this).button('loading');
    cargarHospitalizacion();
    $btn.button('reset');
  });    



   $("#especialidad_consulta").select2({
        language: "es",        
        ajax: {    
          url: function(params) {  
              return "../../medicos/obtener_especialidades_medicas/"+params.term; 
              //return "hmiv/public/medicos/obtener_especialidades_medicas/"+params.term; 
            },
          dataType: 'json',
          delay: 50,
          data: function (params) {
          },
          processResults: function (data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            //alert(data);
            var resultados = [];
            $.each(data, function (index, item) {
                  resultados.push({
                      'id': item.id_especialidad,
                      'text': item.especialidad
                  });
              });
                  
            return {        
              //results: data
              results: resultados
            };
          },
          cache: true
        },
        
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,  
        //templateResult: formatRepo, // omitted for brevity, see the source of this page
        //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
      });

   $("#medico_ordenante").select2({
        language: "es",        
        ajax: {    
          url: function(params) {  
              return "../../medicos/obtener_medico/"+params.term; 
              //return "hmiv/public/medicos/obtener_especialidades_medicas/"+params.term; 
            },
          dataType: 'json',
          delay: 50,
          data: function (params) {
          },
          processResults: function (data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            //alert(data);
            var resultados = [];
            $.each(data, function (index, item) {
                  resultados.push({
                      'id': item.id_medico,
                      'text': item.medico
                  });
              });
                  
            return {        
              //results: data
              results: resultados
            };
          },
          cache: true
        },
        
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,  
        //templateResult: formatRepo, // omitted for brevity, see the source of this page
        //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
      });

   $("#medico_ordenante_tratamiento").select2({
        language: "es",        
        ajax: {    
          url: function(params) {  
              return "../../medicos/obtener_medico/"+params.term; 
              //return "hmiv/public/medicos/obtener_especialidades_medicas/"+params.term; 
            },
          dataType: 'json',
          delay: 50,
          data: function (params) {
          },
          processResults: function (data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            //alert(data);
            var resultados = [];
            $.each(data, function (index, item) {
                  resultados.push({
                      'id': item.id_medico,
                      'text': item.medico
                  });
              });
                  
            return {        
              //results: data
              results: resultados
            };
          },
          cache: true
        },
        
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,  
        //templateResult: formatRepo, // omitted for brevity, see the source of this page
        //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
      });



   $("#vacuna_aplicada").select2({
        language: "es",        
        ajax: {    
          url: function(params) {  
              return "../../historias_medicas_pediatricas/obtener_vacuna/"+params.term; 
              //return "hmiv/public/medicos/obtener_especialidades_medicas/"+params.term; 
            },
          dataType: 'json',
          delay: 50,
          data: function (params) {
          },
          processResults: function (data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            //alert(data);
            var resultados = [];
            $.each(data, function (index, item) {
                  resultados.push({
                      'id': item.id_tipo_vacuna,
                      'text': item.vacuna
                  });
              });
                  
            return {        
              //results: data
              results: resultados
            };
          },
          cache: true
        },
        
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,  
        //templateResult: formatRepo, // omitted for brevity, see the source of this page
        //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
      });

   $("#patologia_detectada").select2({
        language: "es",        
        ajax: {    
          url: function(params) 
            {  
              return "../../historias_medicas_pediatricas/obtener_patologia/"+params.term;
            },
          dataType: 'json',
          delay: 50,
          data: function (params) {
          },
          processResults: function (data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            //alert(data);
            var resultados = [];
            $.each(data, function (index, item) {
                  resultados.push({
                      'id': item.id_patologia,
                      'text': item.patologia
                  });
              });
                  
            return {        
              //results: data
              results: resultados
            };
          },
          cache: true
        },
        
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,  
        //templateResult: formatRepo, // omitted for brevity, see the source of this page
        //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
      });

   $("#alergia_detectada").select2({
        language: "es",        
        ajax: {    
          url: function(params) 
            {  
              //return "../../historias_medicas_pediatricas/obtener_alergias/"+params.term;
              return "../../historias_medicas_pediatricas/obtener_alergias/"+params.term;
            },
          dataType: 'json',
          delay: 50,
          data: function (params) {
          },
          processResults: function (data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            //alert(data);
            var resultados = [];
            $.each(data, function (index, item) {
                  resultados.push({
                      'id': item.id_alergia,
                      'text': item.alergia
                  });
              });
                  
            return {        
              //results: data
              results: resultados
            };
          },
          cache: true
        },
        
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,  
        //templateResult: formatRepo, // omitted for brevity, see the source of this page
        //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
      });


   $("#intolerancia_detectada").select2({
        language: "es",        
        ajax: {    
          url: function(params) 
            {  
              return "../../historias_medicas_pediatricas/obtener_intolerancias/"+params.term;
            },
          dataType: 'json',
          delay: 50,
          data: function (params) {
          },
          processResults: function (data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            //alert(data);
            var resultados = [];
            $.each(data, function (index, item) {
                  resultados.push({
                      'id': item.id_intolerancia,
                      'text': item.intolerancia
                  });
              });
                  
            return {        
              //results: data
              results: resultados
            };
          },
          cache: true
        },
        
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,  
        //templateResult: formatRepo, // omitted for brevity, see the source of this page
        //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
      });


/*FIN DOCUMENT READY*/
});    
