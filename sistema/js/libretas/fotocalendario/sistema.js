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

    var target2 = document.getElementById('foopropio');

    $('#foopropio').css('display','block');
    var spinner = new Spinner(opts).spin(target2);

  $('body').fadeIn('slow', function() {
    // Animation complete
    $(this).css( 'visibility', 'visible');
  });
  
$(document).ready(function() {  

	
//////////////////activar o desactivar 2do bloque de nombre, apellidos, titulo
//////////////////activar o desactivar 2do bloque de nombre, apellidos, titulo
//////////////////activar o desactivar 2do bloque de nombre, apellidos, titulo
	$('input[type="checkbox"][name="coleccion_id_igual"]').click(function() {
	    var $this = $(this);
	    var checando = $(this).attr('id');

	    if ($this.is(':checked')) {
	    	$('#bloque2').css('display','none');
	    	
	    } else {
	    	
	    	$('#bloque2').css('display','');

	    }
	});

//////////////////activar o desactivar 2do bloque de nombre, apellidos, titulo
//////////////////activar o desactivar 2do bloque de nombre, apellidos, titulo
//////////////////activar o desactivar 2do bloque de nombre, apellidos, titulo


	//spinner.stop();
	//$('#foopropio').css('display','none');


    var hash_url =  window.location.protocol+'//'+window.location.hostname+'/sistema/';    
    // ULISES


   //poner el ancla	
 	if (window.location.hash!='#foo') {
 		window.location.href = window.location.href+'#foo';	
 	}

 	


	//OK
	$('body').on('click','.principal_menu', function (e) {   
		var catalogo= hash_url+'libretas';
        window.location.href = catalogo; 
	});	


// busqueda de prod_inven
	var consulta_dato_reutilizar = new Bloodhound({
	   
	   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nombre'),
	   queryTokenizer: Bloodhound.tokenizers.whitespace,
	   remote:hash_url+'libretas/buscador_predictivo?key=%QUERY&nombre='+jQuery('.buscar_dato_reutilizar').attr("name")+'&id_session='+$('#id_session').val(),

	});



	consulta_dato_reutilizar.initialize();


	jQuery('.buscar_dato_reutilizar').typeahead(
		{
			   hint: true,
		  highlight: true,
		  minLength: 1,
	  

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

			var reutilizando =datum.titulo;

	
		 	 var target2 = document.getElementById('foopropio');
    		var spinner = new Spinner(opts).spin(target2);

		     var elemento =datum.key; //$(this).attr('value');
			
			var identificador = datum.key; //$(this).attr('value');
			
			var id_session = $('#id_session').val();
		    var id_diseno  = $('#id_diseno').val();
		    var variation_id  = $('#variation_id').val();
		    var consecutivo  = $('#consecutivo').val();

			
			var	old_id_diseno   = datum.diseno; //$('option:selected',this).attr('diseno');
			var	old_variation_id   = datum.variacion; 
			var	old_consecutivo = datum.consecutivo; //$('option:selected',this).attr('consecutivo');		    			
			var	old_modulo = datum.modulo; //$('option:selected',this).attr('modulo');
			var	old_ubicacion = datum.ubicacion; //$('option:selected',this).attr('ubicacion');



			
			if ( (elemento!=-1) && !( (id_diseno==old_id_diseno) && (variation_id==old_variation_id) && (consecutivo==old_consecutivo) )) {
			
			     url =hash_url+"libretas/cargar_informacion";
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

					    		var $catalogo= hash_url+'libretas/fotocalendario/'+$.base64.encode(id_session);
					    			
					            hrefPost('POST', $catalogo, {
					                  id_edicion_variacion   : variation_id,
					                  id_edicion_diseno      : id_diseno,
					                  id_edicion_consecutivo : consecutivo,
					                  reutilizando:reutilizando,

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
			     url =hash_url+"libretas/eliminar_logo_formulario";
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
	
	if( $(this).val() === 'personalizado') {   
	   $('#otro').show();    
	}  else   {   
	   $('#otro').hide();      
	}   
});

$('#titulo_interior').change(function(e){   
	
	if( $(this).val() === 'personalizado') {   
	   $('#otro_interior').show();    
	}  else   {   
	   $('#otro_interior').hide();      
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
			
			     url =hash_url+"libretas/cargar_informacion";
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
					    			
					    		
					    		var $catalogo= hash_url+'libretas/fotocalendario/'+$.base64.encode(id_session);
					    		
					    			
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


	//OK Activar todos los slider que ya se han llenado (es)
		
		var id_session = $('#id_session').val();
	    var variation_id  = $('#variation_id').val();
	    var id_diseno  = $('#id_diseno').val();
	    var consecutivo  = $('#consecutivo').val();
    

	    var url = hash_url+'libretas/calenda_activos'; 
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
					  	$('.previo_slider[value="'+valor.variation_id+'"][consecutivo="'+valor.consecutivo+'"][diseno="'+valor.id_diseno+'"]').prop('disabled', false);	

				  });
			} 
		});
		 
		  


	//OK marcar el elemento activo (slider activo)
	$('.editar_slider[value="'+variation_id+'"][consecutivo="'+consecutivo+'"][diseno="'+id_diseno+'"]').parent().parent().addClass('bordeado');
	

	//OK Desactivar "Eliminar" del elemento activo
	$('.eliminar_slider[value="'+variation_id+'"][consecutivo="'+consecutivo+'"][diseno="'+id_diseno+'"]').prop('disabled', true);	
	$('.eliminar_slider[value="'+variation_id+'"][consecutivo="'+consecutivo+'"][diseno="'+id_diseno+'"]').css('display','none');


		
	//OK "editar un slider". Cuando hay un cambio de diseño
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
	//////////////////OK//////COMIENZO DE LA ELIMINACION DE UN TAMAÑO ESPECIFICO//////
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
		    var url = hash_url+'libretas/eliminar_diseno_completo'; 
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
								  	//console.log(valor);
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



							//SI ELIMINA TAMBIEN Q CHEQUE SI SE PUEDE ACTIVAR EL BOTON DE COMPRA Y VENTA

						    var url = hash_url+'libretas/disenos_completos'; 

								$.ajax({
								    url: url,
								    method: "POST",
							        dataType: 'json',
							          data: {
							              id_session:id_session,
							          },

									success: function(datos_completos){

											var pos_real = $('.bordeado').attr('posicion');
											var posicion = $('.bordeado').attr('posicion');

											$('.cuadro_slider:hidden').each(function(idx, el) {

												if ($(el).attr('posicion')<pos_real) {
													posicion--;
												}
											});										  
										  $('#registros').html("Registros"+'  <b>'+posicion+'</b> de <b>'+datos_completos['total']+'</b>');	

																				

										  if (datos_completos['total_disenos'] == datos_completos['total']) {
										  		 $('#cont_session3').val('Revisa y compra');	 
										  		 //$('#cont_session3').val('si');	 
										  		 $('.compra_menu').prop('disabled', false);	
										  } else {
										  		 $('#cont_session3').val('Continuar');	 
										  		 //$('#cont_session3').val('no');	 
										  		 $('.compra_menu').prop('disabled', true);	
										  }

										  //console.log(consecutivo);
										  //console.log( (datos_completos['ultimo_elemento'].consecutivo  ) );

										  if ( 
										  		(consecutivo==(datos_completos['ultimo_elemento'].consecutivo  ) ) &&
										  		(id_diseno==(datos_completos['ultimo_elemento'].id_diseno) ) &&
										  		(variation_id==(datos_completos['ultimo_elemento'].variation_id) ) &&
										  		(id_session==(datos_completos['ultimo_elemento'].id_session) ) 

										  )	{

												 if (datos_completos['total_disenos'] == datos_completos['total']-1) {
												  		 $('#cont_session3').val('Revisa y compra');	 
												  		 //$('#cont_session3').val('si');	 
												  		 $('.compra_menu').prop('disabled', false);	
												  }				  	

										  }


									} 
								});





					} 
				});



	    	
	    });	



////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////final de la eliminacion/////////////////////
////////////////////////////////////////////////////////////////////////////////////////


	 



	//--> OK visualizar "revisa y compra"	
	$('body').on('click','.previo_slider', function (e) {   

	   var id_session = $('#id_session').val();
	   //var ano = $("#almanaque").attr('anomostrado');

        var catalogo= hash_url+'libretas/fotorevise/'+$.base64.encode(id_session);
        

        hrefPost('POST', catalogo, {
         
				variation_id   : $(this).attr('value'),
				id_diseno   : $(this).attr('diseno'),
				consecutivo : $(this).attr('consecutivo'),
	                   //ano  : ano,

        }, ''); 

        
	});	



	// OK a travez de "menu_compra" "revisa y compra"	
	$('body').on('click','.compra_menu', function (e) {   
	   var id_session = $('#id_session').val();
       var catalogo= hash_url+'libretas/fotorevise/'+$.base64.encode(id_session);
       

        hrefPost('POST', catalogo, {
				variation_id   : $("#variation_id").val(),
				id_diseno   : $("#id_diseno").val(),
				consecutivo : $("#consecutivo").val(),
	                   //ano  : $("#almanaque").attr('anomostrado'),

        }, ''); 

        
	});	





///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Boton continuar para validar el formulario///////////////////
///////////////////////////////////////////////Modales con Lista y sin Lista///////////////////
///////////////////////////////////////////////////////////////////////////////////////////////			





	    //OK form_validar_fotocalendario

		$('body').on('submit','#form_validar_fotocalendario', function (e) {

			

			//asignar el mes activo, para que entre en el array
			
		    $('#foopropio').css('display','block');
		    var spinner = new Spinner(opts).spin(target2);


			$(this).ajaxSubmit({

	      		
				success: function(data){
					if(data != true){
						
						//spinner.stop();
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
									
									//$("#modalsinLista").modal("show"); //guardar sin lista								
									$('#form_guardar_lista').trigger('submit');
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
		var guardar = 'noguardar';
	    $('body').on('click','#deleteUserSubmit', function (e) {
	    	guardar= e.target.name;
	    	guardar = 'noguardar';
	    });	




	    //OK
		$('body').on('submit','#form_guardar_lista1', function (e) {
			e.preventDefault();
			alert('ok');
			e.stoppropagation();
			
		});

		$('body').on('submit','#form_guardar_lista', function (e) {

			//evitar q se ejecute el submit
		 	event.preventDefault();

			  $('#foopropio').css('display','block');
    		  var spinner = new Spinner(opts).spin(target2);

			//asignar el mes activo, para que entre en el array
			

			//para tomar la lista de checkBox
			var listCheck = [];
			$("input[name='coleccion_id_logo[]']:checked").each(function() {
			     listCheck.push($(this).val());
			});		

					
				//este es el formulario de la session 3
				var datoFormulario = new FormData(document.getElementById("form_validar_fotocalendario"));

				datoFormulario.append('id_session', $('#id_session').val());
				datoFormulario.append('variation_id',$('#variation_id').val());
				datoFormulario.append('id_diseno',$('#id_diseno').val());
				datoFormulario.append('consecutivo',$('#consecutivo').val());
				datoFormulario.append('texto_pagina',$('#texto_pagina').val());

				//alert($('#texto_pagina').val());
				//estatus para guardar o no guardar lista
				datoFormulario.append('guardar', guardar);
				
				datoFormulario.append('coleccion_id_logo', listCheck);

				//este es el email activo	
				email_lista = $('#correo_activo').val();
				
				url=hash_url+'libretas/noguardar_lista';



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



									//ok
		  						
									spinner.stop();
									$('#foopropio').css('display','none');

									//1- toca editar de un tamaño especifico	
									if (cambio=='si') {		

											  cambio='no';
											  var id_session = $('#id_session').val();
								              
								              var $catalogo= hash_url+'libretas/fotocalendario/'+$.base64.encode(id_session);
								              

									            hrefPost('POST', $catalogo, {
									                  id_edicion_variacion      : cambio_variation_id,
									                  id_edicion_diseno      : cambio_id_diseno,
									                  id_edicion_consecutivo : cambio_consecutivo,

									            }, ''); 

									   //2- toca menu de agregar fotos          
									} else if (cambio=='a_menu') { 
										cambio='no';
											

									  //3- toca "CONTINUAR"
									} else {
										 //si fue una presion real del boton continuar
    									///if (!(e.isTrigger)) 
    									
    									{ 
	
												var id_session = $('#id_session').val();
												var id_diseno = $('#id_diseno').val();
												var variation_id = $('#variation_id').val();
												var consecutivo = $('#consecutivo').val();

												if  ($('#cont_session3').attr('value')=='Continuar') {
													var catalogo= hash_url+'libretas/fotocalendario/'+$.base64.encode(id_session);
													
											
													hrefPost('POST', catalogo, {
													    id_diseno  : id_diseno,
													    variation_id  : variation_id,
													    consecutivo  : consecutivo,
													}, '');

												} else { //Revisa y compra

												   var ano = $("#almanaque").attr('anomostrado');
											       var catalogo= hash_url+'libretas/fotorevise/'+$.base64.encode(id_session);
											       

											        hrefPost('POST', catalogo, {
											         
															variation_id   : variation_id,
															id_diseno   : id_session,
															consecutivo : consecutivo,
												                   ano  : ano,

											        }, ''); 


												}


										}
		
									}

						}
					} 

				  });
				 
				  return false;
				});
						



 //OK Activar "carrito de compra" que ya se han llenado (es decir q ya tiene todos los formularios llenos)

	    var url = hash_url+'libretas/disenos_completos'; 

		$.ajax({
		    url: url,
		    method: "POST",
	        dataType: 'json',
	          data: {
	              id_session:id_session,
	          },

			success: function(datos_completos){
				
				  $('#registros').html("Registros"+'  <b>'+$('.bordeado').attr('posicion')+'</b> de <b>'+datos_completos['total']+'</b>');

				  if (datos_completos['total_disenos'] == datos_completos['total']) {
				  		 $('#cont_session3').val('Revisa y compra');	 
				  		 //$('#cont_session3').val('si');	 
				  		 $('.compra_menu').prop('disabled', false);	
				  } else {
				  		 $('#cont_session3').val('Continuar');	 
				  		 //$('#cont_session3').val('no');	 
				  		 $('.compra_menu').prop('disabled', true);	
				  }

				  //console.log(consecutivo);
				  //console.log( (datos_completos['ultimo_elemento'].consecutivo  ) );

				  if ( 
				  		(consecutivo==(datos_completos['ultimo_elemento'].consecutivo  ) ) &&
				  		(id_diseno==(datos_completos['ultimo_elemento'].id_diseno) ) &&
				  		(variation_id==(datos_completos['ultimo_elemento'].variation_id) ) &&
				  		(id_session==(datos_completos['ultimo_elemento'].id_session) ) 

				  )	{

						 if (datos_completos['total_disenos'] == datos_completos['total']-1) {
						  		 $('#cont_session3').val('Revisa y compra');	 
						  		 //$('#cont_session3').val('si');	 
						  		 $('.compra_menu').prop('disabled', false);	
						  }				  	

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