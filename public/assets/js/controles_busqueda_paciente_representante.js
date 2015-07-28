$(document).ready( function () 
  {

        var tabla = '';
        $('#busqueda_fecha_nacimiento')
          .datepicker
            ({
        	    language: 'es',
        	    format: 'dd/mm/yyyy',
        	    autoclose: true,      	    
              endDate: new Date(),
              todayBtn: true,
              todayHighlight: true,
              startView: 2
            });

         $('#buscar_info').on('click', function () {
            var $btn = $(this).button('cargando');
            

            $("#capa_resultados").show(300);
            
            if(tabla == '')
               {
                  tabla = $('#tabla_resultados').DataTable(
                  // var tabla
                        {
                              'searching':  true,
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
                                              "search"          :   "Buscar: ",
                                          },
                                        
                              'ordering'      : true,
                              "pageLength"    : 10,
                              "lengthChange"  : true,
                              ajax: 
                                      {
                                          "type"    : "POST",
                                          "url"     : "http://localhost/hmiv/public/busquedas/generar_busqueda",
                                          "dataSrc" : "",
                                          "data"    : function (d)
                                                          {
                                                            return $.extend({}, d, {
                                                                'busqueda_fecha_nacimiento_campo' : $("#busqueda_fecha_nacimiento_campo").val(), 
                                                                'nombres_paciente'                : $("#nombres_paciente").val(), 
                                                                'apellidos_paciente'              : $("#apellidos_paciente").val(), 
                                                                'codigo_historia_medica'          : $("#codigo_historia_medica").val(), 
                                                                'tipo_documento_paciente'         : $("#tipo_documento_paciente").val(), 
                                                                'documento_paciente'              : $("#documento_paciente").val(),
                                                                'tipo_documento_representante'    : $("#tipo_documento_representante").val(),
                                                                'documento_representante'         : $("#documento_representante").val(),
                                                                'nombres_representante'           : $("#nombres_representante").val(),
                                                                'apellidos_representante'         : $("#apellidos_representante").val(),
                                                                'busqueda_exacta'                 : $("#busqueda_exacta").val()

                                                            });
                                                          },
                                      },
                              'columns' : [
                                            { "data" : "registro"   },
                                            { "data" : "nom_ape"    },
                                            { "data" : "documento"  },
                                            { "data" : "fecha_nac"  },
                                            { "data" : "cod_histo"  },
                                            { "data" : "represent"  },
                                            { "data" : "opciones"   },
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