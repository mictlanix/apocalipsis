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

		$(".navigacion").change(function()	{
		    document.location.href = $(this).val();
		});


		//var target = document.getElementById('foo');

		var target2 = document.getElementById('foopropio');

$('#foopropio').css('display','block');
var spinner = new Spinner(opts).spin(target2);

$(document).ready(function() {	
	spinner.stop();
	$('#foopropio').css('display','none');

 

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//marcar el mes actual
var mimesactual= (parseFloat($("#almanaque").attr('mesamostrarmenos1'))+1).toString();
//alert(mimesactual);
$('#mes'+mimesactual).addClass('acti');


var hash_url =  window.location.protocol+'//'+window.location.hostname+'/subdomains/beta/sistema/'; 

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


///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Boton continuar para validar el formulario///////////////////
///////////////////////////////////////////////Modales con Lista y sin Lista///////////////////
///////////////////////////////////////////////////////////////////////////////////////////////			




		function nombreMes() {
				llave =	$("#almanaque").attr('anomostrado')+'_'+$("#almanaque").attr('mesamostrarmenos1');
				ano= $("#almanaque").attr('anomostrado');
				mes= $("#almanaque").attr('mesamostrarmenos1');

				valor = $('#texto_mes').val();
				if ((valor.trim())!='') {
					$.miespacionombre.nombre_mes[llave] = { "valor" : valor, "ano" : ano, "mes":mes }; //valor;
				}	
	    }


	    //OK validar para ver si esta lleno

		$('body').on('submit','#form_validar_fotocalendario', function (e) {

			  var target2 = document.getElementById('foopropio');
		      var spinner = new Spinner(opts).spin(target2);


			//asignar el mes activo, para que entre en el array
			nombreMes();		


			$(this).ajaxSubmit({

	      		data: {
	      			 listadias:$.miespacionombre.listaDias,
	      			 nombre_mes:$.miespacionombre.nombre_mes
	      		 },
	      		
				success: function(data){
					//alert('aa');
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
								//console.log(data);
								//alert('bb');
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




	    //OK
		$('body').on('submit','#form_guardar_lista', function (e) {

				//evitar q se ejecute el submit
			 	event.preventDefault();

				var target2 = document.getElementById('foopropio');
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

				//estatus para guardar o no guardar lista
				datoFormulario.append('guardar', guardar);

				//este es el email activo	
				email_lista = $('#correo_activo').val();

				if (guardar=="guardar") {
						url=hash_url+'micuenta/guardar_lista';
				} else {
						url=hash_url+'micuenta/noguardar_lista';
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

									//ok
		  						
									  spinner.stop();
  									  $('#foopropio').css('display','none');

								  			if (guardar=="guardar") {
													location.reload();
											} else {
													$("#modalsinLista").modal("hide");
											} 


						}
					} 

				  });
				 
				  return false;
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


});