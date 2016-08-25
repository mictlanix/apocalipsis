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


    var target = document.getElementById('foo');

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


//$(document).ready(function($) {
	
	var hash_url =  window.location.protocol+'//'+window.location.hostname+'/sistema/';  
	var url_base =  window.location.protocol+'//'+window.location.hostname+'/';  

   //poner el ancla	
 	if (window.location.hash!='#foo') {
 		window.location.href = window.location.href+'#foo';	
 	}

	//retorno al inicio

	$('body').on('click','.principal_menu', function (e) {   
		var catalogo= hash_url+'fotocalendario/fcalendario';
        window.location.href = catalogo; 
        
	});	



//+'[tamano="'+elimina_id_tamano+'"]
    $('body').on('click','#guardar[value="si"]', function (e) {   

    	var target2 = document.getElementById('foopropio');
		var spinner = new Spinner(opts).spin(target2);

    	e.preventDefault(); 

    	    var id_session = $('#id_session').val();

 			var url = hash_url+'fotocalendario/anadir_carrito'; 
				$.ajax({
				    url: url,
				    method: "POST",
			        dataType: 'json',
			          data: {
			              id_session:id_session,
			          },
					success: function(todos){
			              $.each(todos.datos, function (i, valor) { 
			              			//+'&attribute_pa_colores="Red"'

						    	 $.get(url_base+'?add-to-cart='+valor.id_diseno+'&quantity='+valor.cantidad+
									     	'&variation_id='+valor.id_tamano+'&attribute_pa_tamanos='+valor.nombre_tamano

									     	, function(resp) {
       								 console.log(resp);

    							 });
			              });

			            spinner.stop();
  						$('#foopropio').css('display','none');    

	              		var catalogo= url_base+'carro';
							//window.location.href = catalogo;	

					} 
				});


	});	



 //////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////

	//Activar los slider que ya se han llenado (es)
		
	var id_session = $('#id_session').val();
    var id_diseno  = $('#id_diseno').val();
    var id_tamano  = $('#id_tamano').val();
    var consecutivo  = $('#consecutivo').val();

    


    //http://www.forever21.com.mx/shop/mx/es/Mujer-recien-llegados/p/camiseta-fait-de-lamour-2000169189--1003

    	//activar el carrito si ya estan todos los diseños con fotos y todos
    	var hash_url1 =  window.location.protocol+'//'+window.location.hostname+'/sistema/';  
		var url = hash_url1+'activar_carrito'; 
		//alert(url);
				$.ajax({
				    url: url,
				    method: "POST",
			        dataType: 'json',
			          data: {
			               id_session:id_session,
			               id_diseno:elimina_id_diseno,
			               id_tamano:elimina_id_tamano,
			               consecutivo:elimina_consecutivo,
			          },

					success: function(datos_eliminados){
							  $.each(datos_eliminados, function (i, valor) { 
								  	//console.log(valor);
							  });


							
							 if (datos_eliminados['total_disenos'] == datos_eliminados['total']) {
							  		 $('#guardar').text('Ver Carrito');	 
							  		 $('#guardar').val('si');	 
							  		 $("#chequeo_dato").prop('disabled', true);	 
							  } else {
							  		 $('#guardar').text('Continuar');	 
							  		 $('#guardar').val('no');	 
							  		 $("#chequeo_dato").prop('disabled', false);	 
							  }


					} 
				});
	    	
	    








	////////////////////////////////////////////////////////////////////////////////
	////////////////////////COMIENZO DE LA ELIMINACION DE UN TAMAÑO ESPECIFICO//////
	////////////////////////////////////////////////////////////////////////////////

	/*
  ---	OK Eliminar:
		 
		 Parcial:
			 1- Son 3 y elimina 3: "regresa personaliza" y deshabilita "Agrega fotos"
			 2- Son 3 y elimina 2 o 1 : se queda ahi mismo

		 Total:
			 3- Son 3 y elimina 3: "regresa a 1-ELIGE TU DISEÑO Y TAMAÑO" 
			  Son 3 y elimina 2 o 1 : se queda ahi mismo
	
  

  --- Pasar de "Visualizar a " -> revisa y compra			
  --- Pasar de "Agrega tus fotos" -> revisa y compra			

  
  





  ---Queda subir imagen por boton, sin arrastrar

  ---Queda que se guarde la imagen del formulario

	*/


	//var elimina_diseno = 0;

	var elimina_id_tamano =0;	
	var elimina_id_diseno =0;	
	var elimina_consecutivo =0;	



	//eliminar un id_tamaño especifico
	$('body').on('click','.eliminar_slider', function (e) {   
		//elimina_diseno = $(this).attr('value');
		elimina_id_diseno   = $(this).attr('value');
		elimina_id_tamano   = $(this).attr('tamano');
		elimina_consecutivo = $(this).attr('consecutivo');

		$("#modaleliminar_tamano").modal("show"); 
	 	
	});	


       //Cuando cancela la "ELIMINACION DE UN TAMAÑO"
		$('#modaleliminar_tamano').on('hide.bs.modal', function(e) {
			$('#foopropio').css('display','none');
			$('#messages1').css('display','none');
		    $(this).removeData('bs.modal');
		});	


		
	    $('body').on('click','#eliminar_diseno', function (e) {

	        var target2 = document.getElementById('foopropio');
		    var spinner = new Spinner(opts).spin(target2);


		    var url = hash_url+'fotocalendario/eliminar_diseno_revise'; 
				$.ajax({
				    url: url,
				    method: "POST",
			        dataType: 'json',
			          data: {
			               id_session:id_session,
			               id_diseno:elimina_id_diseno,
			               id_tamano:elimina_id_tamano,
			               consecutivo:elimina_consecutivo,
			          },

					success: function(datos_eliminados){
		  			            spinner.stop();
		  						$('#foopropio').css('display','none');    

							  $.each(datos_eliminados, function (i, valor) { 
								  	//console.log(valor);
							  });


							//se eliminaron todos los diseños  
							if (datos_eliminados['total_disenos'] == 0 ) {

								if ( datos_eliminados['total'] == 0) {
									//1- regresa al inicio cuando ya no quedan datos ninguno. "ni siquiera en formulario" 
									var catalogo= hash_url+'fotocalendario/fcalendario';
									window.location.href = catalogo;	
								} else {
									//2- regresa al formulario "cuando en revise no queda ningun datos"
									$(".personaliza_menu").trigger('click');  //provocar el evento q envia a personaliza al 1ro
								}
									
							} else {
								//3- solo elimina pero no se mueve, porq quedan otros datos
								$('#accordion'+elimina_id_diseno+'[tamano="'+elimina_id_tamano+'"][consecutivo="'+elimina_consecutivo+'"]').css({"display":"none"});
							}


							
							 if (datos_eliminados['total_disenos'] == datos_eliminados['total']) {
							  		 $('#guardar').text('Ver Carrito');	 
							  		 $('#guardar').val('si');	 
							  		 $("#chequeo_dato").prop('disabled', true);	 
							  } else {
							  		 $('#guardar').text('Continuar');	 
							  		 $('#guardar').val('no');	 
							  		 $("#chequeo_dato").prop('disabled', false);	 
							  }



							//quitar el formulario modal
							$("#modaleliminar_tamano").modal("hide"); 

					} 
				});
	    	
	    });	



/*

		var agrega_carrito=$(this).attr('value');

        if (agrega_carrito == 'si') { //si ya esta en "revisa y compra"

        }

*/

////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////final de la eliminacion/////////////////////
////////////////////////////////////////////////////////////////////////////////////////

    

	////////////////////////////////////////////////////////////////////////////////
	///////////////////////////Agregar carrito//////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
/*
	$(".checando:checked").each(function() {
	     //listCheck.push($(this).val());
	     alert($(this));
	});		
*/

	$('input[type="checkbox"]').click(function() {
	    var $this = $(this);
	    // $this will contain a reference to the checkbox   
	    var checando = $(this).attr('id');

	    if ($this.is(':checked')) {
	    	$('.agregar_carrito[checando="'+checando+'"]').attr('marcado','si');
	    	$('.agregar_carrito[checando="'+checando+'"]').attr('disabled',false);
	    } else {
	    	$('.agregar_carrito[checando="'+checando+'"]').attr('marcado','no');
	    	$('.agregar_carrito[checando="'+checando+'"]').attr('disabled',true);

	    }
	});



	//OK va al formulario de un diseno, tamaño, consecutivo especifico

	$('body').on('click','.agregar_carrito[marcado="si"]', function (e) {   

		  var id_session = $('#id_session').val();
		  var id_diseno = $(this).attr('value');
		  var id_tamano = $(this).attr('tamano');
		  var consecutivo = $(this).attr('consecutivo');
		  var id_copia = $(this).attr('cantidad');
		  var nombre = $(this).attr('nombre');

		  $('#foopropio').css('display','block');
	   	  var spinner = new Spinner(opts).spin(target2);	

 			$.get(url_base+'?add-to-cart='+id_diseno+'&quantity='+id_copia+
									     	'&variation_id='+id_tamano+'&attribute_pa_tamanos='+nombre, function(resp) {
       								 //console.log(resp);

			 			var url = hash_url+'fotocalendario/guardar_historico_informacion'; 
							$.ajax({
							    url: url,
							    method: "POST",
						        dataType: 'json',
						          data: {
						              id_session:id_session,
						              id_diseno:id_diseno,
						              id_tamano: id_tamano,
						              consecutivo: consecutivo,
						          },
								success: function(datos_eliminados){

										//se eliminaron todos los diseños  
										if (datos_eliminados['total_disenos'] == 0 ) {

											if ( datos_eliminados['total'] == 0) {
												//1- regresa al inicio cuando ya no quedan datos ninguno. "ni siquiera en formulario" 
												//var catalogo= hash_url+'fotocalendario/fcalendario';
												var catalogo=url_base+'carro';
												window.location.href = catalogo;	
											} else {
												//2- regresa al formulario "cuando en revise no queda ningun datos"
												$(".personaliza_menu").trigger('click');  //provocar el evento q envia a personaliza al 1ro
											}
												
										} else {
											//3- solo elimina pero no se mueve, porq quedan otros datos
											$('#accordion'+id_diseno+'[tamano="'+id_tamano+'"][consecutivo="'+consecutivo+'"]').css({"display":"none"});
										}


										
										 if (datos_eliminados['total_disenos'] == datos_eliminados['total']) {
										  		 $('#guardar').text('Ver Carrito');	 
										  		 $('#guardar').val('si');	 
										  		 $("#chequeo_dato").prop('disabled', true);	 
										  } else {
										  		 $('#guardar').text('Continuar');	 
										  		 $('#guardar').val('no');	 
										  		 $("#chequeo_dato").prop('disabled', false);	 
										  }
									
								var spinner = new Spinner(opts).spin(target2);
							    $('#foopropio').css('display','none');		

								} 




						});



    		 });









		  //console.log(id_diseno);
		  //console.log(cantidad);
		  /*
            var catalogo= hash_url+'fotocalendario/'+$.base64.encode(id_session);

            hrefPost('POST', catalogo, {
					  id_edicion_diseno : id_diseno,
					  id_edicion_tamano : id_tamano,
				 id_edicion_consecutivo : consecutivo,
            }, ''); 
		*/


	 	
	});	



	////////////////////////////////////////////////////////////////////////////////
	////////////////////////editar//////
	////////////////////////////////////////////////////////////////////////////////

	//OK va al formulario de un diseno, tamaño, consecutivo especifico
	$('body').on('click','.editar_slider', function (e) {   

		  var id_session = $('#id_session').val();
		  
		  var id_diseno = $(this).attr('value');
		  var id_tamano = $(this).attr('tamano');
		  var consecutivo = $(this).attr('consecutivo');


            var catalogo= hash_url+'fotocalendario/fotocalendario/'+$.base64.encode(id_session);

            hrefPost('POST', catalogo, {
					  id_edicion_diseno : id_diseno,
					  id_edicion_tamano : id_tamano,
				 id_edicion_consecutivo : consecutivo,
            }, ''); 


	 	
	});	


	////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////Menu////////////////////////////////////
	////////////////////////////////regresa a la primera///////////////////////////////
	


	
	//OK para pasar a "personaliza formulario" "caso: en q regresa a formulario a la 1ra"
	$('body').on('click','.personaliza_menu', function (e) {   
 		    var id_session = $('#id_session').val();

	        var catalogo= hash_url+'fotocalendario/fotocalendario/'+$.base64.encode(id_session);

	        hrefPost('POST', catalogo, {
	              //id_edicion_diseno : id_tamano, //no para q comience por el 1ro
	        }, ''); 

	});	


	//OK para pasar a "agrega tus fotos" "caso: en q regresa a fotos a la 1ra"
	$('body').on('click','.agrega_menu', function (e) {   

		var id_session = $('#id_session').val();
		var ano = $('#ano').val();

		var $catalogo = hash_url+'fotocalendario/fotoimagen/'+$.base64.encode(id_session);
		//q comience por el 1ro						
		hrefPost('POST', $catalogo, {
	  				   'ano': ano,
						'mes':'0', 


	    }, ''); 	


	});	


	


/*

	//cuando toca un tab para ocultar el contenido
	$('.miacordion').on('hidden.bs.collapse', function (e) {
	   //alert(e);
	})

	//cuando toca un tab para mostrar el contenido
	$('.miacordion').on('shown.bs.collapse', function (e) {
	   //alert(e);
	})
*/








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