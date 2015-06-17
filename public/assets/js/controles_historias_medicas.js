$(document).ready( function () {

      $('#fecha_nacimiento_representante')
      .datepicker
        ({
            language: 'es',
            format: 'dd/mm/yyyy',
            autoclose: true,
            endDate: new Date(),
            todayBtn: true,
            todayHighlight: true
        })
      .on
        ('changeDate', function(e) {
          // Revalidate the date field
          $('#formulario_principal').formValidation('revalidateField', 'fecha_nacimiento_representante');
        });	


      $("#representante_pais_origen").select2({
        language: "es",
        
        ajax: {
          url: function (params) {
            return "http://localhost/hmiv/public/pacientes_pediatricos/obtener_paises/"+params.term;
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
                      'id': item.id_pais,
                      'text': item.pais
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
      $("#direccion_est_mun_par").select2({
        language: "es",
        

        ajax: {    
          url: function(params) {  return "http://localhost/hmiv/public/pacientes_pediatricos/obtener_direccion/"+params.term; },
          dataType: 'json',
          delay: 50,
          data: function (params) {
          },
          processResults: function (data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
              results: data
            }
          },
          cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,  
        //templateResult: formatRepo, // omitted for brevity, see the source of this page
        //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
      });
      /*OCUPACION U OFICIO DEL REPRESENTANTE DEL PACIENTE*/
      $("#ocupacion_oficio_representante").select2({
        language: "es",
        
        ajax: {    
          url: function(params) {  return "http://localhost/hmiv/public/pacientes_pediatricos/obtener_ocupacion/"+params.term; },
          dataType: 'json',
          delay: 50,
          data: function (params) {
          },
          processResults: function (data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
              results: data
            }
          },
          cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,  
        //templateResult: formatRepo, // omitted for brevity, see the source of this page
        //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
      });   
      
      $("#ocupacion_oficio_representante").select2({
        language: "es",
        
        ajax: {    
          url: function(params) {  return "http://localhost/hmiv/public/pacientes_pediatricos/obtener_ocupacion/"+params.term; },
          dataType: 'json',
          delay: 50,
          data: function (params) {
          },
          processResults: function (data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
              results: data
            }
          },
          cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,  
        //templateResult: formatRepo, // omitted for brevity, see the source of this page
        //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
      });

     
	 $("#alergias_paciente_pediatrico").select2({
        language: "es",        
        //tags: true,
        //tokenSeparators: [',', ' ', '.','-'],
        ajax: {    
          url: function(params) {  return "http://localhost/hmiv/public/pacientes_pediatricos/obtener_alergia/"+params.term; },
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

   $("#patologias_paciente_pediatrico").select2({
        language: "es",        
        //tags: true,
        //tokenSeparators: [',', ' ', '.','-'],
        ajax: {    
          url: function(params) {  return "http://localhost/hmiv/public/pacientes_pediatricos/obtener_patologia/"+params.term; },
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

   $("#intolerancias_paciente_pediatrico").select2({
        language: "es",        
        //tags: true,
        //tokenSeparators: [',', ' ', '.','-'],
        ajax: {    
          url: function(params) {  return "http://localhost/hmiv/public/pacientes_pediatricos/obtener_intolerancia/"+params.term; },
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

    $('#formulario_principal').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        // This option will not ignore invisible fields which belong to inactive panels
       
    });

    $('#historia_medica_pediatrica')
        // Call the wizard plugin
        .wizard()

        // Triggered when clicking the Next/Prev buttons
        .on('actionclicked.fu.wizard', function(e, data) {
            var fv         = $('#formulario_principal').data('formValidation'), // FormValidation instance
                step       = data.step,                              // Current step
                // The current step container
                $container = $('#formulario_principal').find('.step-pane[data-step="' + step +'"]');

            // Validate the container
            fv.validateContainer($container);

            var isValidStep = fv.isValidContainer($container);
            if (isValidStep === false || isValidStep === null) {
                // Do not jump to the target panel
                e.preventDefault();
            }
        })

        // Triggered when clicking the Complete button
        .on('finished.fu.wizard', function(e) {
            var fv         = $('#formulario_principal').data('formValidation'),
                step       = $('#historia_medica_pediatrica').wizard('selectedItem').step,
                $container = $('#formulario_principal').find('.step-pane[data-step="' + step +'"]');

            // Validate the last step container
            fv.validateContainer($container);

            var isValidStep = fv.isValidContainer($container);
            if (isValidStep === true) {
                // Uncomment the following line to submit the form using the defaultSubmit() method
                 fv.defaultSubmit();

                // For testing purpose
                //$('#thankModal').modal();
            }
        });





});