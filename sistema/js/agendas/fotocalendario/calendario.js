$(document).ready(function() {

	var hash_url =  window.location.protocol+'//'+window.location.hostname+'/sistema/';  

				$.miespacionombre = { 
				         listaDias:{}, 
				        nombre_mes:{},
				}; 

	
				$("body").on('show.bs.modal','#myModal',function(e){			
						
						$(".infoTitulo").text('Día: '+$("#almanaque").attr('diaseleccionado')+' (Sólo 18 caracteres)');	

						llave =	$("#almanaque").attr('anomostrado')
							+'_'+$("#almanaque").attr('mesamostrarmenos1')+'_'+$("#almanaque").attr('diaseleccionado');

							if ($.miespacionombre.listaDias[llave]) {
											obj =	$.miespacionombre.listaDias[llave].valor;
											$("textarea.contenido").val(obj);	
							}
				});


				 $("body").on('click','.guardar_modal',function(e){	
					
									valor = $('.contenido').val();  //contenido
									diaseleccionado = $("#almanaque").attr('diaseleccionado'); //dia seleccionado

									if (valor!='') 	{
										$('li#listaDia_'+diaseleccionado+' > a').addClass('lleno');
									} else {
										$('li#listaDia_'+diaseleccionado+' > a').removeClass('lleno');
										
									} 
									
									
									llave =	$("#almanaque").attr('anomostrado')
									+'_'+$("#almanaque").attr('mesamostrarmenos1')+'_'+$("#almanaque").attr('diaseleccionado');

									ano= $("#almanaque").attr('anomostrado');
									mes= $("#almanaque").attr('mesamostrarmenos1');
									dia= $("#almanaque").attr('diaseleccionado');

									$.miespacionombre.listaDias[llave] = { "valor" : valor, "ano" : ano, "mes":mes, "dia":dia }; 
									if (valor=="") {
										delete ($.miespacionombre.listaDias[llave]);
									}
									


									 $('#myModal').modal('hide');
				});

				$("body").on('hide.bs.modal','#myModal',function(e){	
					$('.contenido').val("");
				    $(this).removeData('bs.modal');	
				});	

					$('body').on('click','a.remover', function (e) {  

								//console.log( $(this).attr("dia") );
								
								valor = '';  //contenido
								diaseleccionado = $(this).attr("dia"); //dia seleccionado

								$('li#listaDia_'+diaseleccionado+' > a').removeClass('lleno');
								
								
								llave =	$("#almanaque").attr('anomostrado')
								+'_'+$("#almanaque").attr('mesamostrarmenos1')+'_'+$("#almanaque").attr('diaseleccionado');

								ano= $("#almanaque").attr('anomostrado');
								mes= $("#almanaque").attr('mesamostrarmenos1');
								dia= $("#almanaque").attr('diaseleccionado');
								$.miespacionombre.listaDias[llave] = { "valor" : valor, "ano" : ano, "mes":mes, "dia":dia }; 		
								delete ($.miespacionombre.listaDias[llave]);

								
								
						});
				


				$("body #almanaque").on('click','.claseDia a',function(e){
					atrib_padre= $(this).parent().attr("rel") ;
					$("#almanaque").attr('diaseleccionado',atrib_padre);
				});

				$("#almanaque").calendarioEventos({
					mostrarDiaSemana:true,
					mostrarNombreDiaCalendario:true,
					semanaComienzaLunes:true, //false: comienza Domingo
					eventsjson: hash_url+'json/events.json.php',
					  showDescription: false, 
					  dateFormat: 'dddd MM-D-YYYY',
					  eventsLimit: 0,
					
					locales: {
						locale: "es",
						monthNamonth: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
							"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
						dayNamonth: [ 'Domingo','Lunes','Martes','Miércoles',
							'Jueves','Viernes','Sabado' ],
						dayNamonthShort: [ 'Dom','Lun','Mar','Mie', 'Jue','Vie','Sab' ],
						txt_noEvents: "No hay eventos para este periodo",
						txt_SpecificEvents_prev: "",
						txt_SpecificEvents_after: "eventos:",
						txt_next: "siguiente",
						txt_prev: "anterior",
						txt_NextEvents: "Próximos eventos:",
						txt_GoToEventUrl: "Ir al evento",
						"moment": {
					        "months" : [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
					                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
					        "monthsShort" : [ "Ene", "Feb", "Mar", "Abr", "May", "Jun",
					                "Julio", "Ago", "Sep", "Oct", "Nov", "Dic" ],
					        "weekdays" : [ "Domingo","Lunes","Martes","Miércoles",
					                "Jueves","Viernes","Sabado" ],
					        "weekdaysShort" : [ "Dom","Lun","Mar","Mie",
					                "Jue","Vie","Sab" ],
					        "weekdaysMin" : [ "Do","Lu","Ma","Mi","Ju","Vi","Sa" ],
					        "longDateFormat" : {
					            "LT" : "H:mm",
					            "LTS" : "LT:ss",
					            "L" : "DD/MM/YYYY",
					            "LL" : "D [de] MMMM [de] YYYY",
					            "LLL" : "D [de] MMMM [de] YYYY LT",
					            "LLLL" : "dddd, D [de] MMMM [de] YYYY LT"
					        },
					        "week" : {
					            "dow" : 1,
					            "doy" : 4
					        }
					    }
					}
					
				});
});