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
                                        "url"     : "http://localhost/hmiv/public/busquedas/generar_busqueda_historia",
                                        "dataSrc" : "",
                                        "data"    : function (d)
                                                        {
                                                          return $.extend({}, d, {
                                                              'codigo_historia_medica'                 : $("#codigo_historia_medica").val()

                                                          });
                                                        },
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

  /*FIN DOCUMENT READY*/
  });