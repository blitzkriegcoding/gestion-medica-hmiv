$(document).ready( function () 
  {

        var tabla = '';

          $('#buscar_historia').on('click', function () {
            var $btn = $(this).button('cargando');
            

          $("#resultados").show(300);
          
          if(tabla == '')
             {
                tabla = $('#tabla_resultados').DataTable(
                // var tabla
                      {
                            'searching':  false,
                            "language": {
                                          "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                          "paginate": {
                                                        "first":      "Primera",
                                                        "last":       "Última",
                                                        "next":       "Siguiente",
                                                        "previous":   "Anterior"
                                              },
                                            "processing"      :   "Procesando...",
                                            "loadingRecords"  :   "Cargando registros...",
                                            "lengthMenu"      :   "Mostrar _MENU_ registros",
                                            "emptyTable"      :   "Sin registros de la solicitud realizada",
                                            "search"          :   "Buscar:",

                                        },
                                      
                            'ordering'      : true,
                            "pageLength"    : 10,
                            "lengthChange"  : false,
                            ajax: 
                                    {
                                        "type"    : "POST",
                                        // "url"     : "http://localhost/hmiv/public/busquedas/generar_busqueda_historia",
                                        "url"     : "../busquedas/generar_busqueda_historia",
                                        "dataSrc" : "",
                                        "data"    : function (d)
                                                        {
                                                          return $.extend({}, d, {
                                                              'codigo_historia_medica'  : $("#codigo_historia_medica").val()
                                                          });
                                                        },
                                        "error" : function (respuesta)
                                                      {   
                                                      }

                                    },
                            'columns' : [
                                          { "data" : "num_his"    },
                                          { "data" : "cod_his"    },
                                          { "data" : "nom_pac"    },
                                          { "data" : "pantalla"   },
                                          { "data" : "pdf"        },                                          
                                        ],
                      })
                  
              }
            else 
              {
                tabla.ajax.reload();
              }
          $btn.button('reset')
        });

      $('#tabla_resultados').delegate("button.btn-success","click", function(event)
              {
                
                var obj = this;                    
                //alert(obj.id);
                // $.ajax({
                //   url: "../../historias_medicas_pediatricas/anular_consulta_medica",
                //   type: "POST",
                //   data: { 'id_consulta_paciente': obj.id },
                //   contentType: 'application/x-www-form-urlencoded',
                //   dataType: 'json',
                //   success: function(respuesta) 
                //     { 
                //       $('#mensajes').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);
                //       tabla.ajax.reload();
                //     },
                //   error: function(respuesta)
                //     {
                //       $('#mensajes').html(respuesta['especialidad_consulta']);
                //       $('#mensajes').html(respuesta['turno_consulta']);
                //       $('#mensajes').html(respuesta['fecha_consulta']);                  
                //     }

                // });

                  var windowSizeArray = [ "width=800,height=800,scrollbars=yes", "width=300,height=400,scrollbars=yes" ];
                  //var url = $(this).attr("../busquedas/reporte_pantalla/"+obj.id);
                  var windowName = "reporte_pantalla";//$(this).attr("name");
                  var windowSize = windowSizeArray[0];
 
                  window.open("../busquedas/reporte_pantalla/"+obj.id, windowName, windowSize);
 
                  event.preventDefault();
                    
              }
          );

      $('#tabla_resultados').delegate("button.btn-primary","click", function(event)

              {
                var obj = this;    
                //alert(obj);
                // $.ajax({
                //   url: "../../historias_medicas_pediatricas/anular_consulta_medica",
                //   type: "POST",
                //   data: { 'id_consulta_paciente': obj.id },
                //   contentType: 'application/x-www-form-urlencoded',
                //   dataType: 'json',
                //   success: function(respuesta) 
                //     { 
                //       $('#mensajes').show().attr('class',respuesta['clase']).html(respuesta['mensaje']);
                //       tabla.ajax.reload();
                //     },
                //   error: function(respuesta)
                //     {
                //       $('#mensajes').html(respuesta['especialidad_consulta']);
                //       $('#mensajes').html(respuesta['turno_consulta']);
                //       $('#mensajes').html(respuesta['fecha_consulta']);                  
                //     }
                // });
                
                    
              }
          );

  /*FIN DOCUMENT READY*/
  });