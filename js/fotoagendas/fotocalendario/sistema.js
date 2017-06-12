var opts = {
      lines: 13, 
      length: 20, 
      width: 10, 
      radius: 30, 
      corners: 1, 
      rotate: 0, 
      direction: 1, 
      color: '#E8192C',
      speed: 1, 
      trail: 60,
      shadow: false,
      hwaccel: false,
      className: 'spinner',
      zIndex: 2e9, 
      top: '50%', // Top position relative to parent
      left: '50%' // Left position relative to parent   
    };

    $(".navigacion").change(function()  {
        document.location.href = $(this).val();
    });


    //var target = document.getElementById('foo');

    var target2 = document.getElementById('foopropio');

    $('#foopropio').css('display','block');
    var spinner = new Spinner(opts).spin(target2);

  $('body').fadeIn('slow', function() {
    // Animation complete
    $(this).css( 'visibility', 'visible');
  });

$(document).ready(function() {  

	//spinner.stop();
	//$('#foopropio').css('display','none');

	//marcar el mes actual
	var mimesactual= (parseFloat($("#almanaque").attr('mesamostrarmenos1'))+1).toString();
	//alert(mimesactual);
	$('#mes'+mimesactual).addClass('acti');

    var hash_url =  window.location.protocol+'//'+window.location.hostname+'/subdomains/beta/sistema/';    
    // ULISES


   //poner el ancla	
 	if (window.location.hash!='#foo') {
 		window.location.href = window.location.href+'#foo';	
 	}


  $('#meses div').click(function() {      
      $('#meses div a').removeClass('acti');
      $(this).find('a').toggleClass('acti');

      setTimeout(function(){
        var altoenv = $('.envolventeDetalleMes').height();
        $('.envolventeDelMes').css({'height':altoenv});                
      }, 100);
      
  });

	//
	$('body').on('click','.principal_menu', function (e) {   
		var catalogo= hash_url+'fotoagendas';
        window.location.href = catalogo; 
	});	


// busqueda de prod_inven
	var consulta_dato_reutilizar = new Bloodhound({
	   
	   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nombre'),
	   queryTokenizer: Bloodhound.tokenizers.whitespace,
	   remote:hash_url+'fotoagendas/buscador_predictivo?key=%QUERY&nombre='+jQuery('.buscar_dato_reutilizar').attr("name")+'&id_session='+$('#id_session').val(),

	});



	consulta_dato_reutilizar.initialize();


	jQuery('.buscar_dato_reutilizar').typeahead(
		{
			   hint: true,
		  highlight: true,
		  minLength: 0,
	      searchOnFocus: true,

		},

		 {
	  
	  name: 'buscar_dato_reutilizar',
	  displayKey: 'titulo', //
	  source: consulta_dato_reutilizar.ttAdapter(),
	   templates: {
			    suggestion: function (data) {  
			    	return '<p><strong>' + data.titulo + '</strong></p>';

		   		}
	  	}
	});

	jQuery('.buscar_dato_reutilizar').on('typeahead:selected', function (e, datum,otro) {

			console.log((datum.key));


	
		 	 var target2 = document.getElementById('foopropio');
    		var spinner = new Spinner(opts).spin(target2);

		     var elemento =datum.key; //$(this).attr('value');
			
			var identificador = datum.key; //$(this).attr('value');
			
			var id_session = $('#id_session').val();
		    var id_diseno  = $('#id_diseno').val();
		    var variation_id  = $('#variation_id').val();
		    var consecutivo  = $('#consecutivo').val();

			
			var	old_id_diseno   = datum.diseno; //$('option:selected',this).attr('diseno');
			var	old_variation_id   = datum.variacion; //$('option:selected',this).attr('variacion');
			var	old_consecutivo = datum.consecutivo; //$('option:selected',this).attr('consecutivo');		    			
				var	old_modulo = datum.modulo; //$('option:selected',this).attr('modulo');
				var	old_ubicacion = datum.ubicacion; //$('option:selected',this).attr('ubicacion');



			
			if ( (elemento!=-1) && !( (id_diseno==old_id_diseno) && (variation_id==old_variation_id) && (consecutivo==old_consecutivo) )) {
			
			     url =hash_url+"fotoagendas/cargar_informacion";
					$.ajax({
					    url: url,
					    type: 'POST',
					    dataType: "json",
					    data:  {
					    	identificador:identificador,
							id_session:id_session,	

							id_diseno:id_diseno,
							variation_id:variation_id,
							consecutivo:consecutivo,

							old_id_diseno:old_id_diseno,
							old_variation_id:old_variation_id,
							old_consecutivo:old_consecutivo,
							     old_modulo:old_modulo,
							     old_ubicacion:old_ubicacion,

					    },
					    success: function(data){
					    		spinner.stop();
  								$('#foopropio').css('display','none');	

					    		var $catalogo= hash_url+'fotoagendas/fotocalendario/'+$.base64.encode(id_session);
					    			
					            hrefPost('POST', $catalogo, {
					                  id_edicion_variacion      : variation_id,
					                  id_edicion_diseno      : id_diseno,
					                  id_edicion_consecutivo : consecutivo,

					            }, ''); 


					            
					    }
				});	    
			}		
		spinner.stop();
		$('#foopropio').css('display','none');	
				

	


	});	

	jQuery('.buscar_dato_reutilizar').on('typeahead:closed', function (e) {
		//jQuery('#tabla_entrada').dataTable().fnDraw();
	});	

//activar la portada cuando se cambie de imagen
$("input[type=file]").on('change',function(e){	
  $("input[name='coleccion_id_logo[]'][value=1]").attr('checked', 'checked');
});

$('body').on('click','.eliminar_imagen', function (e) { 
	var target2 = document.getElementById('foopropio');
    var spinner = new Spinner(opts).spin(target2);

    
	$(this).parent().parent().css('display','none');
	$('#ca_logo').val('');
	$('#logo').val('');
	
	//ajax para eliminar la imagen
		
			var id_session 	 = $('#id_session').val();
		    var id_diseno  	 = $('#id_diseno').val();
		    var variation_id  	 = $('#variation_id').val();
		    var consecutivo  = $('#consecutivo').val();
			     url =hash_url+"fotoagendas/eliminar_logo_formulario";
					$.ajax({
					    url: url,
					    type: 'POST',
					    dataType: "json",
					    data:  {
							id_session:id_session,	
							id_diseno:id_diseno,
							variation_id:variation_id,
							consecutivo:consecutivo,
					    },
					    success: function(data){
					    		spinner.stop();
  								$('#foopropio').css('display','none');
					    							            
					    }
				});	 

		

});	




$('body').on('change','#logo', function (event) { 

	 var target2 = document.getElementById('foopropio');
     var spinner = new Spinner(opts).spin(target2);


    var imag_logo = document.getElementById('imag_logo');
    if (event.target.files[0]) {


	    imag_logo.src = URL.createObjectURL(event.target.files[0]);
	   	$('.img_logo').css('display','block');
   	}
	  spinner.stop();
	  $('#foopropio').css('display','none');
});	  

//activar casilla otro en titulo
$('#titulo').change(function(e){   
	console.log($(this).val());
	if( $(this).val() === 'personalizado') {   
	   $('#otro').show();    
	}  else   {   
	   $('#otro').hide();      
	}   
});



/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////


//leer la lista elegida y actualizar valores
	$("body").on('change','#id_lista_todo',function(e){		
		//console.log($(this).attr('value'));

	

		     var elemento =e.target.value; //$(this).attr('value');
			
			var identificador = e.target.value; //$(this).attr('value');
			
			var id_session = $('#id_session').val();
		    var id_diseno  = $('#id_diseno').val();
		    var variation_id  = $('#variation_id').val();
		    var consecutivo  = $('#consecutivo').val();

			
			var	old_id_diseno   = $('option:selected',this).attr('diseno');
			var	old_variation_id   = $('option:selected',this).attr('variacion');
			var	old_consecutivo = $('option:selected',this).attr('consecutivo');		    			
				var	old_modulo = $('option:selected',this).attr('modulo');
				var	old_ubicacion = $('option:selected',this).attr('ubicacion');
			
			if ( (elemento!=-1) && !( (id_diseno==old_id_diseno) && (variation_id==old_variation_id) && (consecutivo==old_consecutivo) )) {
			
			     url =hash_url+"fotoagendas/cargar_informacion";
					$.ajax({
					    url: url,
					    type: 'POST',
					    dataType: "json",
					    data:  {
					    	identificador:identificador,
							id_session:id_session,	

							id_diseno:id_diseno,
							variation_id:variation_id,
							consecutivo:consecutivo,

							old_id_diseno:old_id_diseno,
							old_variation_id:old_variation_id,
							old_consecutivo:old_consecutivo,
							     old_modulo:old_modulo,
							     old_ubicacion:old_ubicacion,

					    },
					    success: function(data){
					    			
					    		
					    		var $catalogo= hash_url+'fotoagendas/fotocalendario/'+$.base64.encode(id_session);
					    		
					    			
					            hrefPost('POST', $catalogo, {
					                  id_edicion_variacion      : variation_id,
					                  id_edicion_diseno      : id_diseno,
					                  id_edicion_consecutivo : consecutivo,

					            }, ''); 


					            
					    }
				});	    
			}		
					

	});



 //////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////


	// Activar todos los slider que ya se han llenado (es)
		
		var id_session = $('#id_session').val();
	    var variation_id  = $('#variation_id').val();
	    var id_diseno  = $('#id_diseno').val();
	    var consecutivo  = $('#consecutivo').val();
    

	    var url = hash_url+'fotoagendas/calenda_activos'; 
		$.ajax({
		    url: url,
		    method: "POST",
	        dataType: 'json',
	          data: {
	              variation_id:variation_id,
	              id_diseno:id_diseno,
	              consecutivo:consecutivo,
	              id_session:id_session,
	              
	          },

			success: function(datos_llenos){
				  $.each(datos_llenos, function (i, valor) { 
					  	$('.editar_slider[value="'+valor.variation_id+'"][consecutivo="'+valor.consecutivo+'"][diseno="'+valor.id_diseno+'"]').prop('disabled', false);	
					  	//activar previo_slider
					  	//$('.previo_slider[value="'+valor.variation_id+'"][consecutivo="'+valor.consecutivo+'"][diseno="'+valor.id_diseno+'"]').prop('disabled', false);	

				  });
			} 
		});
		 
		  


	// marcar el elemento activo (slider activo)
	$('.editar_slider[value="'+variation_id+'"][consecutivo="'+consecutivo+'"][diseno="'+id_diseno+'"]').parent().parent().addClass('bordeado');
	

	// Desactivar "Eliminar" del elemento activo
	$('.eliminar_slider[value="'+variation_id+'"][consecutivo="'+consecutivo+'"][diseno="'+id_diseno+'"]').prop('disabled', true);	
	$('.eliminar_slider[value="'+variation_id+'"][consecutivo="'+consecutivo+'"][diseno="'+id_diseno+'"]').css('display','none');


	
		
	// "editar un slider". Cuando hay un cambio de diseño
	var cambio ='no';
	var cambio_id_diseno =0;
	var cambio_variation_id =0;
	var cambio_consecutivo =0;



	$('body').on('click','.editar_slider', function (e) {  

		if (!( (variation_id == $(this).attr('value')) &&
 	    	 (id_diseno == ($(this).attr('diseno')) ) &&
	    	 (consecutivo == ($(this).attr('diseno'))) 
	       ))  {

			 	cambio ='si';
			 	
				cambio_variation_id   = $(this).attr('value');
				cambio_id_diseno   = $(this).attr('diseno');
				cambio_consecutivo = $(this).attr('consecutivo');


			 	$("#form_validar_fotocalendario").trigger('submit');  //provocar el evento q valida todo

		}
	});	



	


	////////////////////////////////////////////////////////////////////////////////
	////////////////////////COMIENZO DE LA ELIMINACION DE UN TAMAÑO ESPECIFICO//////
	////////////////////////////////////////////////////////////////////////////////

	var elimina_variation_id =0;	
	var elimina_id_diseno =0;	
	var elimina_consecutivo =0;	

	//eliminar un id_tamaño especifico
	$('body').on('click','.eliminar_slider', function (e) {   
		elimina_variation_id   = $(this).attr('value');
		elimina_id_diseno   = $(this).attr('diseno');
		elimina_consecutivo = $(this).attr('consecutivo');

		$("#modaleliminar_variacion").modal("show"); 
	 	
	});	


       //Cuando cancela la "ELIMINACION DE UN TAMAÑO"
		$('#modaleliminar_variacion').on('hide.bs.modal', function(e) {
			$('#foopropio').css('display','none');
			$('#messages1').css('display','none');
		    $(this).removeData('bs.modal');
		});	




	    
	    $('body').on('click','#eliminar_diseno', function (e) {
		    var url = hash_url+'fotoagendas/eliminar_diseno_completo'; 
				$.ajax({
				    url: url,
				    method: "POST",
			        dataType: 'json',
			          data: {
			              id_session:id_session,
			              variation_id:elimina_variation_id,
			              id_diseno:elimina_id_diseno,
			              consecutivo:elimina_consecutivo,
			          },

					success: function(datos_eliminados){
							  $.each(datos_eliminados, function (i, valor) { 
								  	console.log(valor);
							  });

							var cant_elem_quedan = $('.editar_slider[value="'+elimina_variation_id+'"][diseno="'+elimina_id_diseno+'"][consecutivo="'+elimina_consecutivo+'"]').parent().parent().siblings(":visible" ).length;
							
  

							if (cant_elem_quedan ==1) { //si es el ultimo elemento q queda eliminar todo 
								$('.editar_slider[value="'+elimina_variation_id+'"][diseno="'+elimina_id_diseno+'"][consecutivo="'+elimina_consecutivo+'"]').parent().parent().parent().css({	
				             								"display":"none"});
								$("#modaleliminar_variacion").modal("hide"); 

							}  else {
								$('.editar_slider[value="'+elimina_variation_id+'"][diseno="'+elimina_id_diseno+'"][consecutivo="'+elimina_consecutivo+'"]').parent().parent().css({	
				             								"display":"none"});
								$('.editar_slider[value="'+elimina_variation_id+'"][diseno="'+elimina_id_diseno+'"][consecutivo="'+elimina_consecutivo+'"]').parent().parent().parent().add('');
								$("#modaleliminar_variacion").modal("hide"); 

							}



	
					} 
				});



	    	
	    });	



////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////final de la eliminacion/////////////////////
////////////////////////////////////////////////////////////////////////////////////////


	 



	//-->  visualizar "revisa y compra"	
	$('body').on('click','.previo_slider', function (e) {   

	   var id_session = $('#id_session').val();
	   var ano = $("#almanaque").attr('anomostrado');

        var catalogo= hash_url+'fotoagendas/fotorevise/'+$.base64.encode(id_session);
        

        hrefPost('POST', catalogo, {
         
				variation_id   : $(this).attr('value'),
				id_diseno   : $(this).attr('diseno'),
				consecutivo : $(this).attr('consecutivo'),
	                   ano  : ano,

        }, ''); 

        
	});	



	//  a travez de "menu_compra" "revisa y compra"	
	$('body').on('click','.compra_menu', function (e) {   
	   var id_session = $('#id_session').val();
       var catalogo= hash_url+'fotoagendas/fotorevise/'+$.base64.encode(id_session);
       

        hrefPost('POST', catalogo, {
				variation_id   : $("#variation_id").val(),
				id_diseno   : $("#id_diseno").val(),
				consecutivo : $("#consecutivo").val(),
	                   ano  : $("#almanaque").attr('anomostrado'),

        }, ''); 

        
	});	




//new
		//actualizar los dias de cumpleano, en funcion del año actual señalado
		$("#id_mes").on('change', function(e) {
			anoactual=$("#almanaque").attr('anomostrado');
			mesactual=$(this).val();
		    var cantDiasMesMostrado1 = 32 - new Date(anoactual, mesactual-1, 32).getDate();
		    $("#id_dia").html(''); 
		    for (i = 1; i <= cantDiasMesMostrado1; i++) { 
	 			   $("#id_dia").append('<option value="'+i+'" >'+i+'</option>');
			}
		});		


	//OK Menú "agrega tus fotos"
	$('body').on('click','.agrega_menu', function (e) {   
			 	cambio ='a_menu';
			 	//cambio_diseno=variation_id;
			 	$("#form_validar_fotocalendario").trigger('submit');  //provocar el evento q valida todo
	});	


///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Boton continuar para validar el formulario///////////////////
///////////////////////////////////////////////Modales con Lista y sin Lista///////////////////
///////////////////////////////////////////////////////////////////////////////////////////////			

//new
		function nombreMes() {
				llave =	$("#almanaque").attr('anomostrado')+'_'+$("#almanaque").attr('mesamostrarmenos1');
				ano= $("#almanaque").attr('anomostrado');
				mes= $("#almanaque").attr('mesamostrarmenos1');

				valor = $('#texto_mes').val();
				if ((valor.trim())!='') {
					$.miespacionombre.nombre_mes[llave] = { "valor" : valor, "ano" : ano, "mes":mes }; //valor;
				}	
	    }


//OK form_validar_fotocalendario

		$('body').on('submit','#form_validar_fotocalendario', function (e) {

			//asignar el mes activo, para que entre en el array
			nombreMes();		
		    $('#foopropio').css('display','block');
		    var spinner = new Spinner(opts).spin(target2);


			$(this).ajaxSubmit({

	      		data: {
	      			 listadias:$.miespacionombre.listaDias,
	      			 nombre_mes:$.miespacionombre.nombre_mes
	      		 },
	      		
				success: function(data){
					if(data != true){
						$('#foopropio').css('display','none');
						$('#messages').css('display','block');
						$('#messages').addClass('alert-danger');
						$('#messages').html(data);
						$('html,body').animate({
							'scrollTop': $('#messages').offset().top
						}, 1000);
					
						
					}else{

	  							
								spinner.stop();
								$('#foopropio').css('display','none');
	      			 			if ( (Object.keys($.miespacionombre.listaDias).length===0) && (Object.keys($.miespacionombre.nombre_mes).length===0) ) {
	      			 				//mostrar la ventana sinLista	      			 				
	      			 				$("#modalsinLista").modal("show"); //guardar sin lista

	      			 			} else {
	      			 				//mostrar la ventana conLista
	      			 				$("#modalPregunta").modal("show",{valor:10});	 //guardar con lista
	      			 			}
								
					}
				} 
			});
			return false;
		});	
		
		
		//Cuando cancela en la modal que "Tiene lista"
		$('#modalPregunta').on('hide.bs.modal', function(e) {
			$('#foopropio').css('display','none');
			$('#messages1').css('display','none');
		    $(this).removeData('bs.modal');
		});	


		
		//Cuando cancela en la modal que "NO Tiene lista"
		$('#modalsinLista').on('hide.bs.modal', function(e) {
			$('#foopropio').css('display','none');
			$('#messages1').css('display','none');
		    $(this).removeData('bs.modal');
		});		



		/*
		por defecto dice que cuando comience el formulario se va a guardar la lista
		pero hay 3 estado 
			Guardar
			   1-guardar  :
			   2-noguardar: "No me interesa, deseo continuar"
			SinGuardar
			   3-noguardar: por defecto

		*/
		var guardar = 'guardar';
	    $('body').on('click','#deleteUserSubmit', function (e) {
	    	guardar= e.target.name;
	    });	


	    //
		$('body').on('submit','#form_guardar_lista', function (e) {

			//evitar q se ejecute el submit
		 	event.preventDefault();

			$('#foopropio').css('display','block');
    		var spinner = new Spinner(opts).spin(target2);

			//asignar el mes activo, para que entre en el array
			nombreMes();		

			//para tomar la lista de checkBox
			var listCheck = [];
			$("input[name='coleccion_id_logo[]']:checked").each(function() {
			     listCheck.push($(this).val());
			});		

					
				//este es el formulario de la session 3
				var datoFormulario = new FormData(document.getElementById("form_validar_fotocalendario"));

				//el arreglo de día y meses
				datoFormulario.append('listadias', JSON.stringify($.miespacionombre.listaDias));
				datoFormulario.append('nombre_mes', JSON.stringify($.miespacionombre.nombre_mes));

				//los datos "del formulario modal"
				datoFormulario.append('nombre_lista', $('#nombre_lista').val());
				datoFormulario.append('correo_lista', $('#correo_lista').val());

				datoFormulario.append('id_session', $('#id_session').val());
				datoFormulario.append('variation_id',$('#variation_id').val());
				datoFormulario.append('id_diseno',$('#id_diseno').val());
				datoFormulario.append('consecutivo',$('#consecutivo').val());

				//estatus para guardar o no guardar lista
				datoFormulario.append('guardar', guardar);
				
				datoFormulario.append('coleccion_id_logo', listCheck);

				//este es el email activo	
				email_lista = $('#correo_activo').val();

				if (guardar=="guardar") {
						url=hash_url+'fotoagendas/guardar_lista';
				} else {
						url=hash_url+'fotoagendas/noguardar_lista';
				} 



				$.ajax({
				    url: url,
				    type: 'POST',
				    data:  datoFormulario,
				    		
				    async: false,
				    cache: false,
				    contentType: false,
				    processData: false,

					success: function(datos){
						if(datos != true){
							
							spinner.stop();
							$('#foopropio').css('display','none');
							$('#messages1').css('display','block');
							$('#messages1').addClass('alert-danger');
							$('#messages1').html(datos);
							$('html,body').animate({
								'scrollTop': $('#messages1').offset().top
							}, 1000);
						
							
						}else{				

									//
		  						
									spinner.stop();
									$('#foopropio').css('display','none');

									//1- toca editar de un tamaño especifico	
									if (cambio=='si') {		

											  cambio='no';
											  var id_session = $('#id_session').val();
								              
								              var $catalogo= hash_url+'fotoagendas/fotocalendario/'+$.base64.encode(id_session);

									            hrefPost('POST', $catalogo, {
									                  id_edicion_variacion      : cambio_variation_id,
									                  id_edicion_diseno      : cambio_id_diseno,
									                  id_edicion_consecutivo : cambio_consecutivo,

									            }, ''); 

									   //2- toca menu de agregar fotos          
									} else if (cambio=='a_menu') { 
										cambio='no';

											var $catalogo = hash_url+'fotoagendas/fotoimagen/'+$.base64.encode($('#id_session').val());
														
														hrefPost('POST', $catalogo, {
															      'variation_id':$('#variation_id').val(),
															      'id_diseno':$('#id_diseno').val(),
															      'consecutivo':$('#consecutivo').val(),

												      				   'ano': $("#almanaque").attr('anomostrado'),
																		'mes':'0' //para q comience en el mes de enero


													    }, ''); 	


									  //3- toca "CONTINUAR"
									} else {
											var $catalogo = hash_url+'fotoagendas/fotoimagen/'+$.base64.encode($('#id_session').val());
														
														hrefPost('POST', $catalogo, {
															      'variation_id':$('#variation_id').val(),
															      'id_diseno':$('#id_diseno').val(),
															      'consecutivo':$('#consecutivo').val(),
												      				   'ano': $("#almanaque").attr('anomostrado'),
																		'mes':'0' //para q comience en el mes de enero


													    }, ''); 	

									}									

									

						}
					} 

				  });
				 
				  return false;
				});
						



 // Activar "carrito de compra" que ya se han llenado (es decir q ya tiene todos los formularios llenos)

	    var url = hash_url+'fotoagendas/disenos_completos'; 

		$.ajax({
		    url: url,
		    method: "POST",
	        dataType: 'json',
	          data: {
	              id_session:id_session,

		     	   variation_id:$('#variation_id').val(),
	     		   id_diseno:$('#id_diseno').val(),
	     	     consecutivo:$('#consecutivo').val(),
	     	     	     mes:20, //para q no aparezca 

	          },

			success: function(datos_completos){

				  $.each(datos_completos['cale_activo'], function (i, valor) { 
					  	if (valor.cantidad >=12) {
						  	$('.previo_slider[value="'+valor.variation_id+'"][consecutivo="'+valor.consecutivo+'"][diseno="'+valor.id_diseno+'"]').prop('disabled', false);	
						}  	
				  });

				
				  if (datos_completos['cale_activo'].length == datos_completos['total']) {
				  		 
				  		 $('.compra_menu').prop('disabled', false);	
				  } else {
				  		 
				  		 $('.compra_menu').prop('disabled', true);	
				  }


				  

			} 
		});

///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Fin del Boton continuar para validar el formulario///////////////////
///////////////////////////////////////////////////////////////////////////////////////////////			


	


	    	    	



		function randomString(len, an){
		    an = an&&an.toLowerCase();
		    var str="", i=0, min=an=="a"?10:0, max=an=="n"?10:62;
		    for(;i++<len;){
		      var r = Math.random()*(max-min)+min <<0;
		      str += String.fromCharCode(r+=r>9?r<36?55:61:48);
		    }
		    return str;
		}



						

		hrefPost = function(verb, url, data, target) {
		  var form = document.createElement("form");
		  form.action = url;
		  form.method = verb;
		  form.target = target || "_self";
		  if (data) {
		    for (var key in data) {
		      var input = document.createElement("textarea");
		      input.name = key;
		      input.value = typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
		      form.appendChild(input);
		    }
		  }
		  form.style.display = 'none';
		  document.body.appendChild(form);
		  form.submit();
		};

  
  spinner.stop();
  $('#foopropio').css('display','none');

  $('#foopropio').fadeOut('slow', function() {
    // Animation complete
    //$(this).css('display','block');
  });


});