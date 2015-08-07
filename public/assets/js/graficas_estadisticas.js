$(document).ready(function()
	{
		var options_genero = {
				chart: {
	                renderTo: 'distribucion_genero',
	                plotBackgroundColor: null,
	                plotBorderWidth: null,
	                plotShadow: false
	            },
	            title: {
	                text: 'Distribución de pacientes atendidos por género en el año 2015'
	            },
	            tooltip: {
	                formatter: function() {
	                    return '<b>'+ this.point.name +'</b>: '+ this.y +' PACIENTES(S)';
	                }
	            },
	            plotOptions: {
	                pie: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
	                    colors: ['#4183D7','#F64747'],
	                    dataLabels: {
	                        enabled: true,
	                        color: '#000000',
	                        connectorColor: '#000000',
	                        formatter: function() {
	                        	
	                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
	                        }
	                    }
	                }
	            },
	            series: [{
	                type: 'pie',
	                name: 'Browser share',
	                data: []
	            }]
	        }
	        
	        $.getJSON("../estadisticas/distribucion_genero", function(json) {
				options_genero.series[0].data = json;
	        	chart = new Highcharts.Chart(options_genero);
	        });

	var options_patologias = {
				chart: {
	                renderTo: 'distribucion_patologias',
	                plotBackgroundColor: null,
	                plotBorderWidth: null,
	                plotShadow: false
	            },
	            title: {
	                text: 'Distribución patologías en pacientes pediátricos durante el año 2015'
	            },
	            tooltip: {
	                formatter: function() {
	                    return '<b>'+ this.point.name +'</b>: '+ this.total +' PACIENTE(S)';
	                }
	            },
	            plotOptions: {
	                pie: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
	                    size: '75%',
	                    /*colors: ['#4183D7','#F64747'],*/
	                    dataLabels: {
	                        enabled: true,
	                        color: '#000000',
	                        connectorColor: '#000000',
	                        formatter: function() {
	                        	
	                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
	                        }
	                    }
	                }
	            },
	            series: [{
	                type: 'pie',
	                name: 'Browser share',
	                data: []
	            }]
	        }
	        
	        $.getJSON("../estadisticas/distribucion_patologias", function(json) {
				options_patologias.series[0].data = json;
	        	chart = new Highcharts.Chart(options_patologias);
	        });

	var options_pais_nacimiento = {
				chart: {
	                renderTo: 'distribucion_pais_nacimiento',
	                plotBackgroundColor: null,
	                plotBorderWidth: null,
	                plotShadow: false
	            },
	            title: {
	                text: 'Distribución según país de nacimiento de pacientes pediátricos durante el año 2015'
	            },
	            tooltip: {
	                formatter: function() {
	                    return '<b>'+ this.point.name +'</b>: '+ this.y +' PACIENTE(S)';
	                }
	            },
	            plotOptions: {
	                pie: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
	                    size: '75%',
	                    /*colors: ['#4183D7','#F64747'],*/
	                    dataLabels: {
	                        enabled: true,
	                        color: '#000000',
	                        connectorColor: '#000000',
	                        formatter: function() {
	                        	
	                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
	                        }
	                    }
	                }
	            },
	            series: [{
	                type: 'pie',
	                name: 'Browser share',
	                data: []
	            }]
	        }
	        
	        $.getJSON("../estadisticas/distribucion_pais_nacimiento", function(json) {
				options_pais_nacimiento.series[0].data = json;
	        	chart = new Highcharts.Chart(options_pais_nacimiento);
	        });

	var options_alergias = {
				chart: {
	                renderTo: 'distribucion_alergias',
	                plotBackgroundColor: null,
	                plotBorderWidth: null,
	                plotShadow: false
	            },
	            title: {
	                text: 'Distribución según país de nacimiento de pacientes pediátricos durante el año 2015'
	            },
	            tooltip: {
	                formatter: function() {
	                    return '<b>'+ this.point.name +'</b>: '+ this.y +' PACIENTE(S)';
	                }
	            },
	            plotOptions: {
	                pie: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
	                    size: '75%',
	                    /*colors: ['#4183D7','#F64747'],*/
	                    dataLabels: {
	                        enabled: true,
	                        color: '#000000',
	                        connectorColor: '#000000',
	                        formatter: function() {
	                        	
	                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
	                        }
	                    }
	                }
	            },
	            series: [{
	                type: 'pie',
	                name: 'Browser share',
	                data: []
	            }]
	        }
	        
	        $.getJSON("../estadisticas/distribucion_pais_nacimiento", function(json) {
				options_alergias.series[0].data = json;
	        	chart = new Highcharts.Chart(options_alergias);
	        });

		//FIN DOCUMENT READY
	});