 
$(document).ready( function () {
      //fecha de nacimiento del paciente limitado hasta el dia de hoy
      $('#fecha_nacimiento_paciente')
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
            $('#formulario_principal').formValidation('revalidateField', 'fecha_nacimiento_paciente_campo');
          });      
      //fecha de nacimiento del representante limitado hasta el dia de hoy
      
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
      //datepicker_fecha_ingreso
      $('#datepicker_fecha_ingreso').datepicker(
      {
          language: 'es',
          format: 'dd/mm/yyyy',
          autoclose: true,
          endDate: new Date(),
          todayBtn: true,
          todayHighlight: true
      });


      $("#paciente_pais_origen").select2({  
        language: "es",
        theme: "classic",
        ajax: {
          url: function (params) {
            return "http://localhost/hmiv/public/obtener_paises/"+params.term;
          },
          dataType: 'json',
          delay: 50,
          data: function (params) {

            // return {
            //   q: params.term, // search term
            //   page: params.page
            // };
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

      $("#representante_pais_origen").select2({
        language: "es",
        theme: "classic",  
        ajax: {
          url: function (params) {
            return "http://localhost/hmiv/public/obtener_paises/"+params.term;
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
                  //alert(resultados);
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
        theme: "classic",

        ajax: {    
          url: function(params) {  return "http://localhost/hmiv/public/obtener_direccion/"+params.term; },
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
        theme: "classic",
        ajax: {    
          url: function(params) {  return "http://localhost/hmiv/public/obtener_ocupacion/"+params.term; },
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
      /*FIN OCUPACION U OFICIO DEL REPRESENTANTE DEL PACIENTE*/

 $('#formulario_principal')
    // IMPORTANT: on('init.field.fv') must be declared
    // before calling .formValidation(...)
    .on('init.field.fv', function(e, data) {
        var $field    = data.element,               // Field element
            $icon     = $field.data('fv.icon'),     // Icon element
            $messages = $field.data('fv.messages'); // Message container

        $icon.appendTo($messages);
    }).formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: 
            {
              /*VALIDACIONES PRIMER PANEL*/
                tipo_documento: {
                      validators: {
                          notEmpty: { message: 'Seleccione nacionalidad'}
                                  }
                                },                              
                documento_paciente: {
                              validators: {
                                  notEmpty: { message: 'Campo cédula es obligatorio'},
                                    regexp: { regexp: /^[0-9]+$/, message: 'Este campo solo acepta números'}
                                  }
                },
                primer_nombre_paciente: {
                              validators: {
                                  notEmpty: { message: 'Campo primer nombre es obligatorio'},
                                    regexp: { regexp: /^[a-zA-Z\s]+$/, message: 'Este campo solo acepta letras'}
                                  }
                },
                segundo_nombre_paciente: {
                                excluded: true,
                                validators: { regexp: { regexp: /^[a-zA-Z\s]+$/, message: 'Este campo solo acepta letras'} }
                },                
              primer_apellido_paciente: {
                              validators: {
                                  notEmpty: { message: 'Campo primer apellido es obligatorio' },
                                  regexp: { regexp: /^[a-zA-Z\s]+$/, message: 'Este campo solo acepta letras' } }
                },
              segundo_apellido_paciente: {
                              excluded: true,
                                validators: {                                  
                                      regexp: { regexp: /^[a-zA-Z\s]+$/, message: 'Este campo solo acepta letras' } }
                },
              fecha_nacimiento_paciente_campo: {
                                validators: {
                                    notEmpty: { message: 'Campo fecha de nacimiento es obligatoria[vacia]'},
                                        date: { format: 'DD/MM/YYYY', message: 'La fecha de nacimiento esta en formato incorrecto'}
                                
                    }
                },
              pais_origen: {
                  validators: {
                      notEmpty: { message: 'Seleccione país de origen'}
                              }
                        },
              lugar_nacimiento_paciente: {
                              validators: {
                                  notEmpty: { message: 'Campo lugar de nacimiento es obligatorio' },
                                    regexp: { regexp: /^[a-zA-Z\s]+$/, message: 'Este campo solo debe contener letras' }
                    }
                },
                  sexo: {
              validators: {
                  notEmpty: { message: 'Seleccione genero'}
                          }
                        },
                /*FIN VALIDACIONES PRIMER PANEL*/

                /*VALIDACIONES DEL SEGUNDO PANEL */        
                tipo_documento_representante: {
                                    validators: {
                                        notEmpty: { message: 'Seleccione nacionalidad'}
                          }
                        },
                documento_representante: {
                              validators: {
                                  notEmpty: { message: 'La cédula es obligatoria'},
                                    regexp: { regexp: /^[0-9]+$/, message: 'Este campo solo acepta números'}
                                  }
                },
            primer_nombre_representante: {
                                validators: {
                                    notEmpty: { message: 'Campo primer nombre es obligatorio'},
                                      regexp: { regexp: /^[a-zA-Z\s]+$/, message: 'Este campo solo acepta letras'}
                                  }
                },
            segundo_nombre_representante: {
                                validators: { regexp: { regexp: /^[a-zA-Z\s]+$/, message: 'Este campo solo acepta letras'} }
                },                
          primer_apellido_representante: {
                              validators: {
                                  notEmpty: { message: 'Campo primer apellido es obligatorio' },
                                  regexp: { regexp: /^[a-zA-Z\s]+$/, message: 'Este campo solo acepta letras' } }
                },
        segundo_apellido_representante: {
                              validators: {                                  
                                  regexp: { regexp: /^[a-zA-Z\s]+$/, message: 'Este campo solo acepta letras' } }
                },
        fecha_nacimiento_representante: {
                                validators: {
                                    notEmpty: { message: 'Campo fecha de nacimiento es obligatoria[vacia]'},
                                        date: { format: 'DD/MM/YYYY', message: 'La fecha de nacimiento esta en formato incorrecto'}
                                
                    }
                },
                parentesco_representante: {
                                    validators: {
                                        notEmpty: { message: 'Campo Parentesco/Relación es obligatorio'}
                          }
                        },
      direccion_est_mun_par_representante: {
                                  validators: {
                                      notEmpty: { message: 'Campo Estado/Municipio/Parroquia obligatorio'}
                                              }
                                        },
                casa_edificio_representante: {
                                  validators: {
                                      notEmpty: { message: 'Campo Casa/Edificio es obligatorio'}
                                              }
                                        },
            ocupacion_oficio_representante: {
                                  validators: {
                                      notEmpty: { message: 'Campo ocupación u oficio es obligatorio'}
                                              }
                                        },
                        sexo_representante: {
                                  validators: {
                                      notEmpty: { message: 'Campo género es obligatorio'}
                                              }
                                        },
              pais_origen_representante: {
                                validators: {
                                    notEmpty: { message: 'Seleccione país de origen'}
                                            }
                                      },
              estado_civil_representante: {
                                validators: {
                                    notEmpty: { message: 'Seleccione estado civil'}
                                            }
                                      },                                      
            avenida_calle_representante: {
                                validators: {
                                        notEmpty: { message: 'Campo Avenida/Calle es obligatorio'}
                                              }
                                        },
                            telefono_1: {
                              validators: {
                                        phone: {
                                        country: 'VE',
                                        message: 'Número telefónico no válido'
                                        },
                        notEmpty: { message: 'Campo teléfono  es obligatorio'}

                    }
                },
                  correo_representante: {
                              validators: {
                                  emailAddress: {
                                      message: 'Correo electrónico inválido'
                                  }
                              }
                          },
        grado_instruccion_representante: {
                                validators: {
                                        notEmpty: { message: 'Seleccion grado de instrucción'}
                                              }
                                        },                          

          /*FIN VALIDACIONES SEGUNDO PANEL*/
          /*VALIDACIONES TERCER PANEL*/
              tipo_ingreso_paciente: {
                                validators: {
                                        notEmpty: { message: 'Seleccion tipo de ingreso al hospital'}
                                              }
                                        },
                    medico_tratante: {
                                validators: {
                                        notEmpty: { message: 'Seleccion medico tratante al ingreso'}
                                              }
                                        },
              fecha_ingreso_paciente: {
                                validators: {
                                    notEmpty: { message: 'Campo fecha de ingreso es obligatoria[vacia]'},
                                        date: { format: 'DD/MM/YYYY', message: 'La fecha de ingreso esta en formato incorrecto'}
                                
                    }
                },

              ubicacion_hospital_paciente: {
                                validators: {
                                        notEmpty: { message: 'Campo ubicación/sala es obligatorio'}
                                              }
                                        },
                resumen_ingreso_paciente: {
                                validators: {
                                        notEmpty: { message: 'Campo resumen de ingreso es obligatorio'}
                                              }
                                        },
          /*FIN VALIDACIONES TERCER PANEL*/          
          //cierre campos, no tocar
            },
   
      });
    $('#wizard_ingreso')
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
                step       = $('#wizard_ingreso').wizard('selectedItem').step,
                $container = $('#formulario_principal').find('.step-pane[data-step="' + step +'"]');

            // Validate the last step container
            fv.validateContainer($container);

            var isValidStep = fv.isValidContainer($container);
            if (isValidStep === true) {
                // Uncomment the following line to submit the form using the defaultSubmit() method
                // fv.defaultSubmit();

                // For testing purpose
                //$('#thankModal').modal();
            }
          });
       
        
});

