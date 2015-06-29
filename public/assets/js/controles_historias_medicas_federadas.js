$(document).ready( function () {
      $('#consultas_historico').DataTable(
        {
              'searching':  false,
              'ordering':   true
        });

      //fecha de nacimiento del paciente limitado hasta el dia de hoy
      function rangoFechaConsultas(id_control)
        {
          var fecha_maxima = new Date();
            fecha_maxima = new Date(fecha_maxima.getFullYear(), fecha_maxima.getMonth(), fecha_maxima.getDate()+15);          
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

      rangoFechaConsultas('fecha_consulta_paciente');

      function verificarColaConsultas()
        {   
            $.ajax({
              url: "http://localhost/hmiv/public/historias_medicas_pediatricas/cola_consultas",
              type: "POST",
              data: { 'fecha_consulta': $('#fecha_consulta').val(), 'especialidad_consulta': $('#especialidad_consulta').val(), 'turno_consulta': $('#turno_consulta').val() },
              contentType: 'application/x-www-form-urlencoded',
              dataType: 'json',
              success: function(respuesta) 
                {                 
                  //alert(respuesta['cola']);
                  $('#cola').html(respuesta['cola']);
                  $('#mensajes').html(respuesta['mensaje']);
                },
              error: function(respuesta)
                {
                  $('#mensajes').html(respuesta['especialidad_consulta']);
                  $('#mensajes').html(respuesta['turno_consulta']);
                  //console.log(respuesta);
                }

            });




        }
  $('#carga_consulta').on('click', function () {    
    var $btn = $(this).button('loading');
    verificarColaConsultas();
    
    $btn.button('reset');
  });

      function cargarConsultaEnCola(fecha_consulta,especialidad)
        {

        }


   $("#especialidad_consulta").select2({
        language: "es",        
        ajax: {    
          url: function(params) {  
              return "http://localhost/hmiv/public/medicos/obtener_especialidades_medicas/"+params.term; 
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



/*FIN DOCUMENT READY*/
});    
