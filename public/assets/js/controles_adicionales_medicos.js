$(document).ready( function () {

    /*VALIDADORES DE LOS CONOCIMIENTOS DEL MEDICO*/
    var institucionValidators = {
            row: '.col-xs-3',   // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {
                    message: 'Indique la Institución donde obtuvo el título'
                }
            }
        },
      tituloObtenidoValidators = {
            row: '.col-xs-3',
            validators: {
                notEmpty: {
                    message: 'Indique el título otorgado por la Institución'
                },
            }
        },
      anioGraduacionValidator = {
            row: '.col-xs-2',
            validators: {
                notEmpty: {
                    message: 'Indique año de graduación'
                },
                integer: {
                    message: 'El año de gradución debe ser numérico'
                }
            }
        },
      paisGraduacionValidator = {
            row: '.col-xs-2',
            validators: {
                notEmpty: {
                    message: 'Indique país de graduación'
                },
                integer: {
                    message: 'El país de gradución debe ser numérico'
                }
            }
        },

        /*
          VARIABLE GLOBAL PARA EL CONTEO DEL INDICE DE CAMPOS
          NO CAMBIÉ EL IDENTIFICADOR DADO QUE SE ME COMPLICARIA
          AL CAMBIARLO EN EL RESTO DE LA FUNCIÓN LO QUE ESTABA
          MAS PROPENSO A FALLOS
        */
        bookIndex = 0;

/**********************************************************/

      $('#fecha_nacimiento_medico_campo')
      .datepicker
        ({
            language: 'es',
            format: 'dd/mm/yyyy',
            autoclose: true,
            endDate: new Date(),
            todayBtn: true,
            todayHighlight: true,
            startView: 2
        })
      .on
        ('changeDate', function(e) {
          // Revalidate the date field
          $('#formulario_principal').formValidation('revalidateField', 'fecha_nacimiento_medico_campo');
        }); 


      $("#pais_origen_medico").select2({
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

      $('#pais_graduacion').select2({
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


      $("#parroquia_medico").select2({
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
   $("#tratamientos_paciente_pediatrico").select2({
        language: "es",        
        tags: true,
        tokenSeparators: [',','.','-'],
      });

    FormValidation.Validator.val_num_ced_med = {
        validate: function(validator, $field, selector_nac ,options) 
        {
            var value = $field.val();
            var valor_nacionalidad = $("#tipo_documento_medico").val();

                if ((value > 31000000) && (valor_nacionalidad == 'V')) 
                  {
                      return {
                                valid: false,
                                message: 'El numero de cedula no corresponde con la nacionalidad venezolana'
                                //message: 'El numero de cedula no corresponde con la nacionalidad venezolana'
                            }
                  };

                //if ((value < 80000000) && (valor_nacionalidad == 'E')) 
                if ((value < 80000000) && (valor_nacionalidad == 'E')) 
                  {
                      return {
                                valid: false,
                                message: 'El numero de cedula no corresponde con la nacionalidad extranjera'
                                //message: 'El numero de cedula no corresponde con la nacionalidad venezolana'
                            }
                  };
                return true;
        }
    };

    FormValidation.Validator.val_num_ced_con = {
        validate: function(validator, $field, selector_nac ,options) 
        {
            var value = $field.val();

            var valor_nacionalidad = $("#tipo_documento_contacto").val();

                if ((value > 31000000) && (valor_nacionalidad == 'V')) 
                  {
                      return {
                                valid: false,
                                message: 'El numero de cedula no corresponde con la nacionalidad venezolana'                                
                            }
                  };

                //if ((value < 80000000) && (valor_nacionalidad == 'E')) 
                if ((value < 80000000) && (valor_nacionalidad == 'E')) 
                  {
                      return {
                                valid: false,
                                message: 'El numero de cedula no corresponde con la nacionalidad extranjera'                                
                            }
                  };
                if((valor_nacionalidad != "") && (value != ""))
                  {
                      alert(value);
                      return {
                                valid: false,
                                message: "Si introdujo una cedula, seleccione una nacionalidad"
                              }
                  };
                return true;


        }
    };

 $('#formulario_principal')
    // IMPORTANT: on('init.field.fv') must be declared
    // before calling .formValidation(...)
    .find('#especialidades_medicas')
        .select2()
        // Revalidate the color when it is changed
        .change(function(e) {
            $('#formulario_principal').formValidation('revalidateField', 'especialidades_medicas');
        })
        .end()    

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
            addOns: {
                mandatoryIcon: {
                    icon: 'glyphicon glyphicon-pencil'
                }
            },      
            fields: 
            {
              'institucion[0]'    : institucionValidators,
              'titulo_obtenido[0]': tituloObtenidoValidators,
              'anio_graduacion[0]': anioGraduacionValidator,
              'pais_graduacion[0]': paisGraduacionValidator,
                /*VALIDACIONES DEL SEGUNDO PANEL */        
              tipo_documento_medico: {
                                    validators: { 
                                            notEmpty: { message: 'Seleccione nacionalidad'},
                                                },
                        },
                   documento_medico: {
                              validators: {
                                  notEmpty: { message: 'La cédula es obligatoria'},
                                    regexp: { regexp: /^[0-9]+$/, message: 'Este campo solo acepta números'},
                                    val_num_ced_med: { message: 'Nacionalidad invalida' }
                                  }
                        },
               primer_nombre_medico: {
                                    validators: {
                                        notEmpty: { message: 'Campo primer nombre es obligatorio'},
                                          regexp: { regexp: /^[a-zA-ZñÑ\s]+$/, message: 'Este campo solo acepta letras'}
                                      }
                        },
              segundo_nombre_medico: {
                                validators: { 
                                        callback: {
                                          message: 'Este campo solo acepta letras',
                                          callback:function(value, validator, $field)
                                                 {
                                                    if(value!=""){
                                                      return /^[a-zA-ZñÑ\s]+$/.test(value);
                                                    }else { return null;}

                                                 }
                                              }
                                    }
                        },                
             primer_apellido_medico: {
                              validators: {
                                  notEmpty: { message: 'Campo primer apellido es obligatorio' },
                                  regexp: { regexp: /^[a-zA-ZñÑ\s]+$/, message: 'Este campo solo acepta letras' } }
                        },
            segundo_apellido_medico: {
                              validators: {                                  
                                        callback: {
                                          message: 'Este campo solo acepta letras',
                                          callback:function(value, validator, $field)
                                                 {
                                                    if(value!=""){
                                                      return /^[a-zA-ZñÑ\s]+$/.test(value);
                                                    }else { return null;}

                                                 }
                                              }
                                          }
                                        },
      fecha_nacimiento_medico_campo: {
                                validators: {
                                    notEmpty: { message: 'Campo fecha de nacimiento es obligatoria[vacia]'},
                                        date: { format: 'DD/MM/YYYY', message: 'La fecha de nacimiento esta en formato incorrecto'}
                                
                    }
                },
                   parroquia_medico: {
                                  validators: {
                                      notEmpty: { message: 'Campo Estado/Municipio/Parroquia obligatorio'}
                                              }
                                        },
               casa_edificio_medico: {
                                  validators: {
                                      notEmpty: { message: 'Campo Casa/Edificio es obligatorio'}
                                              }
                                        },
                        sexo_medico: {
                                  validators: {
                                      notEmpty: { message: 'Debe seleccionar sexo'}
                                              }
                                        },
                 pais_origen_medico: {
                                validators: {
                                    notEmpty: { message: 'Seleccione país de origen'}
                                            }
                                      },
                estado_civil_medico: {
                                validators: {
                                    notEmpty: { message: 'Seleccione estado civil'},                                    
                                    greaterThan: { value: 1, message: 'Seleccione estado civil' }

                                            }
                                      },                                      
               calle_avenida_medico: {
                                validators: {
                                        notEmpty: { message: 'Campo Avenida/Calle es obligatorio'}
                                              }
                                        },
                          telefono1: {
                              validators: {
                                        phone: {
                                        country: 'VE',
                                        message: 'Número telefónico no válido'
                                        },
                              notEmpty: { 
                                    message: 'Telefono 1 es obligatorio'
                                        }
                                   }
                              },
                          telefono2: {
                              validators: {                                        
                              callback: {
                                          message: 'Telefono 2 no es válido',
                                          callback: function(value, validator, $field)
                                            {
                                              if(value!="") {
                                                return /^([0-9]{11})+$/.test(value);
                                              }
                                              else{
                                                return null;
                                              }
                                            }
                                        }                      

                                      }
                                  },                
                  correo_medico: {
                              validators: {

                                  notEmpty: { message: 'Correo electrónico es obligatorio'},
                                  callback: {
                                          message: 'Correo eléctronico inválido',
                                          callback:function(value, validator, $field)
                                                 {
                                                    if(value!="")
                                                      {
                                                        return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
                                                      }
                                                    else 
                                                      { 
                                                        return null; 
                                                      }
                                                 }
                                  }
                              }
                          },
              lugar_nacimiento_medico: {
                              validators: {
                                  notEmpty: { message: 'Campo lugar de nacimiento es obligatorio' },
                                    regexp: { regexp: /^[a-zA-ZñÑ\s]+$/, message: 'Este campo solo debe contener letras' }
                                        }
                                    },
          
        grado_instruccion_representante: {
                                validators: {
                                        notEmpty: { message: 'Seleccion grado de instrucción'},
                                        greaterThan: {value:1, message: 'Seleccion grado de instrucción' }
                                              },
                                        },
          /*FIN VALIDACIONES SEGUNDO PANEL*/
          


          /*VALIDACIONES ESPECIALIDADES*/
            'especialidades_medicas[]': {
                    validators: {
                        callback: {
                            message: 'Seleccione entre 1 y 5 especialidades',
                            callback: function(value, validator, $field) {
                                // Get the selected options
                                var options = validator.getFieldElements('especialidades_medicas[]').val();

                                return (options != null && options.length >= 1 && options.length <= 5);
                            }
                        }
                    }
                },   
          /*FIN VALIDACIONES ESPECIALIDADES*/



          /* VALIDACIONES CONTACTO DEL MEDICO */
                   documento_contacto: {
                              validators: {                                        
                                  callback: {
                                              message: 'Cédula solo acepta numeros',
                                              callback: function(value, validator, $field)
                                                {
                                                  if(value!="") 
                                                    {
                                                      return /^([0-9])+$/.test(value);
                                                    }
                                                  else
                                                    {
                                                      return null;
                                                    }
                                                }
                                            }
                                            /*val_num_ced_con: {  message: 'Si introdujo una cedula, seleccione nacionalidad'}*/
                                          }
                                        },                                                   
               primer_nombre_contacto: {
                                    validators: {
                                        notEmpty: { message: 'El primer nombre es obligatorio'},
                                          regexp: { regexp: /^[a-zA-ZñÑ\s]+$/, message: 'Este campo solo acepta letras'}
                                                }
                                      },
              segundo_nombre_contacto: {
                                validators: { 
                                        callback: {
                                          message: 'Este campo solo acepta letras',
                                          callback:function(value, validator, $field)
                                                 {
                                                    if(value!=""){
                                                      return /^[a-zA-ZñÑ\s]+$/.test(value);
                                                    }else { return null;}

                                                 }
                                              }
                                            }
                                      },
             primer_apellido_contacto: {
                              validators: {
                                  notEmpty: { message: 'Campo primer apellido es obligatorio' },
                                  regexp: { regexp: /^[a-zA-ZñÑ\s]+$/, message: 'Este campo solo acepta letras' } }
                                      },
              segundo_nombre_contacto: {
                                validators: { 
                                        callback: {
                                          message: 'Este campo solo acepta letras',
                                          callback:function(value, validator, $field)
                                                     {
                                                        if(value!=""){
                                                          return /^[a-zA-ZñÑ\s]+$/.test(value);
                                                        }else { return null;}

                                                     }
                                                  }
                                            }
                                        },
                   telefono1_contacto: {
                                validators: {
                                          phone: {
                                          country: 'VE',
                                          message: 'Número telefónico no válido'
                                          },
                                notEmpty: { 
                                      message: 'Telefono 1 es obligatorio'
                                          }
                                     }
                                },                        
                   telefono2_contacto: {
                              validators: {                                        
                              callback: {
                                          message: 'Telefono 2 no es válido',
                                          callback: function(value, validator, $field)
                                            {
                                              if(value!="") {
                                                return /^([0-9]{11})+$/.test(value);
                                              }
                                              else{
                                                return null;
                                              }
                                            }
                                        }                      

                                      }
                                  },  
                   direccion_contacto: {
                                  validators: {
                                      notEmpty: { message: 'La dirección del contacto es obligatorio'}
                                              }
                                        },
        /*FIN VALIDACIONES CONTACTO DEL MEDICO */





          //cierre campos, no tocar
            

            },

      })

        // Add button click handler
        .on('click', '.addButton', function() {
            bookIndex++;
            var $template = $('#plantilla_experiencia'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .attr('data-book-index', bookIndex)
                                .insertBefore($template);

            // Update the name attributes


            $clone
                .find('[name="institucion[]"]').attr('name', 'institucion[' + bookIndex + ']').end()
                .find('[name="titulo_obtenido[]"]').attr('name', 'titulo_obtenido[' + bookIndex + ']').end()
                .find('[name="anio_graduacion[]"]').attr('name', 'anio_graduacion[' + bookIndex + ']').end()
                .find('[name="pais_graduacion"]').attr('name', 'pais_graduacion[' + bookIndex + ']')
                  .select2({
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
                    })
                .end();
                

            // Add new fields
            // Note that we also pass the validator rules for new field as the third parameter
            $('#formulario_principal')
                .formValidation('addField', 'institucion[' + bookIndex + ']', institucionValidators)
                .formValidation('addField', 'titulo_obtenido[' + bookIndex + ']', tituloObtenidoValidators)
                .formValidation('addField', 'anio_graduacion[' + bookIndex + ']', anioGraduacionValidator)
                .formValidation('addField', 'pais_graduacion[' + bookIndex + ']', paisGraduacionValidator);
        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row  = $(this).parents('.form-group'),
                index = $row.attr('data-book-index');

            // Remove fields
            $('#formulario_principal')
                .formValidation('removeField', $row.find('[name="institucion[' + index + ']"]'))
                .formValidation('removeField', $row.find('[name="titulo_obtenido[' + index + ']"]'))
                .formValidation('removeField', $row.find('[name="anio_graduacion[' + index + ']"]'))
                .formValidation('removeField', $row.find('[name="pais_graduacion[' + index + ']"]'));

            // Remove element containing the fields
            $row.remove();
        });



    $('#nuevo_medico_wizard')
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

   $("#especialidades_medicas").select2({
        language: "es",        
        //tags: true,
        //tokenSeparators: [',', ' ', '.','-'],
        maximumSelectionLength: 5,
        ajax: {    
          url: function(params) {  
              //return "http://localhost/hmiv/public/medicos/obtener_especialidades_medicas/"+params.term; 
              return "obtener_especialidades_medicas/"+params.term; 
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





/*PENDIENTE FIN DE $(document).ready(funct....*/        
});
