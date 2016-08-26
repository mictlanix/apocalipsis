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


//$(document).ready(function() {

   //document.location.href='/next.php'


	var hash_url =  window.location.protocol+'//'+window.location.hostname+'/sistema/';  
 	
   //poner el ancla	
 	if (window.location.hash!='#foo') {
 		window.location.href = window.location.href+'#foo';	
 	}
 	


	//ok
	$('body').on('click','.principal_menu', function (e) {   

		var catalogo= hash_url+'fotocalendario/fcalendario';
        window.location.href = catalogo;       
	});	


 //////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////


	    //OK  Activar los slider que ya se han llenado (es)
		 var id_session = $('#id_session').val();
	     var id_tamano  = $('#id_tamano').val();
	     var id_diseno  = $('#id_diseno').val();
	     var consecutivo  = $('#consecutivo').val();

   		 var ano = $('#ano').val();
   		 var elimina_diseno =0;

	    




///////////////////////////////////////////////cargador de Imagenes/////////////////////////////////////////
///////////////////////////////////////////////cargador de Imagenes/////////////////////////////////////////
///////////////////////////////////////////////cargador de Imagenes/////////////////////////////////////////

//var uploader = new plupload.Uploader({
	$("#uploader").plupload({
		// General settings
		runtimes : 'html5,flash,silverlight,html4',
		url : '../upload.php',

		container: 'uploader',
		drop_element: 'uploader',		

		// User can upload no more then 20 files in one go (sets multiple_queues to false)
		max_file_count: 12,
		
		chunk_size: '1mb',

		// Resize images on clientside if we can
		resize : {
			width : 620, 
			height : 640, 
			quality : 90,
			crop: true // crop to exact dimensions
		},
		
		filters : {
			// Maximum file size
			max_file_size : '1000mb',
			// Specify what files to browse for
			mime_types: [
				{title : "Image files", extensions : "jpg,jpeg,gif,png"},
				{title : "Zip files", extensions : "zip"}
			]
		},

		// Rename files by clicking on their titles
		rename: true,
		
		// Sort files
		sortable: true,
		scroll: false,

		// Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
		dragdrop: true,

		// Views to activate
		views: {
			list: true,
			thumbs: true, // Show thumbs
			active: 'thumbs'
		},

		// Flash settings
		flash_swf_url : '../../js/Moxie.swf',

		// Silverlight settings
		silverlight_xap_url : '../../js/Moxie.xap',


	    init: {
	        PostInit: function() {
	            document.getElementById('listaimagenes').innerHTML = '';
	           /* 				
		        document.getElementById('uploadfiles').onclick = function() {
		                uploader.start();
		                return false;
		         };*/

		     //    var self = this;

var self = this
			, queue = []
			, filesAdded = []
			, ruid
			;
						$.ajax({
                              url: hash_url+'fotocalendario/leer_todasimagenes',
                              method: "POST",
                              dataType: 'json',
                              data: {
                                  id_session  : id_session,
                                  id_diseno   : id_diseno,
                                  id_tamano   : id_tamano,
                                  consecutivo : consecutivo,
                                  ano:ano
                              },
                              success: function(listado) { 
                                if (listado==false) {
                                  
                                  $('#messages').css('display','block');
                                  $('#messages').addClass('alert-danger');
                                  $('#messages').html('NO HAY IMAGENES, ESTA VACIO, problemas con libreria de imagenes');
                                  $('html,body').animate({
                                    'scrollTop': $('#messages').offset().top
                                  }, 1000);
                                }else{
									  var y=[];
									
									  $.each(listado, function (i, valor) { 

												var d = new Date();
												var fechaSegundos = d.getTime();
												var strNoCache = '?nocache='+fechaSegundos.toString(); 

												var url = hash_url+'uploads/'+id_session+'/'+valor.recorte+strNoCache;
												//http://bitexperts.com/Question/Detail/3316/determine-file-size-in-javascript-without-downloading-a-file
										        var req = new XMLHttpRequest();
										        req.open('HEAD', url, false);
										        req.send(null);
												 if (req.status === 200) {
												        var fileSize = parseInt(req.getResponseHeader('content-length'));
												        var type = req.getResponseHeader('Content-Type');
												        var nombre =valor.recorte;
												 }

													var x = new plupload.File(url, nombre, fileSize);


													x.name= nombre;
													x.type = type;
													
													x.size= fileSize;
													x.origSize= fileSize;

													x.lastModifiedDate= d;
													//x.id = x.id.substr(0, x.id.length - 2)+"1" ;
													//x.id = x.id; //.substr(0, x.id.length - 1)+"1" ;

													x.status= plupload.DONE; //1;
													x.percent= 0;
													x.loaded = 0;
													
													
													x.target_name = nombre; 
													x.mes = valor.mes;
													x.identificador = valor.id;
													x.uid_imagen = valor.uid_imagen;
													
													x.destroy = $.noop;  //http://www.plupload.com/punbb/viewtopic.php?id=14346

													
													//console.log(valor)
													y.push(x);




									  });

										self.addFile(y);

                                }


                              },
                          error: function () {
                              console.log('Upload error');
                            }
                        }); 




},

	
	 		//se llama cuando se agregan archivos a la cola
	 		//https://github.com/moxiecode/plupload/blob/master/src/plupload.js#L1827
	        FilesAdded: function(up, files) {
	        	//console.log('aaaa ', jQuery("#"+uploader.id+"_html5").get(0));
				 //var files = jQuery("#"+uploader.id+"_html5").get(0).files;

				 	/*
				    jQuery.each(files, function(i, file) {
				        var reader = new FileReader();
				        reader.onload = (function(e) { 
				            var image = new Image();
				            image.src = e.target.result;
				            image.onload = function() {

				                if (this.width < 8000 && this.height < 8000) {
				                    uploader.start();
				                } else {
				                    var message_max_picture = "<?php echo __('Vous avez dépassé les dimensions autorisées pour l\'image '); ?>";
				                    display_error_serv('Erreur', message_max_picture, '');
				                    uploader.removeFile(myfile);
				                }

				            }
				        });
				    });*/
				//http://www.javascripture.com/FileReader
				//http://www.itwenku.net/web/20151202/469.html
				//http://stackoverflow.com/questions/24366312/plupload-get-uploader-object-v2-1-2-for-file-reader
				 var reader = new FileReader();
				    reader.onload = function(){
				      /*
				      var dataURL = reader.result;
				      var output = document.getElementById('output');
				      output.src = dataURL;
				      */
				    };
				/* plupload.each(files, function(file) {   
				    
				 });   

				 var file = files[0].Source();

				 	reader.readAsDataURL(file);*/

//http://www.itwenku.net/web/20151202/469.html
//http://bbs.csdn.net/topics/391545509 respuiesta del chino


 function previewImage(file, callback) {//file为plupload事件监听函数参数中的file对象,callback为预览图片准备完成的回调函数
            if (!file || !/image\//.test(file.type)) return; //确保文件是图片
            if (file.type == 'image/gif') {//gif使用FileReader进行预览,因为mOxie.Image只支持jpg和png
                var fr = new mOxie.FileReader();
                fr.onload = function () {
                    callback(fr.result);
                    fr.destroy();
                    fr = null;
                }
                fr.readAsDataURL(file.getSource());
            } else {
                var preloader = new mOxie.Image();
                preloader.onload = function () {
                    preloader.downsize(300, 300);//先压缩一下要预览的图片,宽300，高300
                    var imgsrc = preloader.type == 'image/jpeg' ? preloader.getAsDataURL('image/jpeg', 80) : preloader.getAsDataURL(); //得到图片src,实质为一个base64编码的数据
                    callback && callback(imgsrc); //callback传入的参数为预览图片的url
                    preloader.destroy();
                    preloader = null;
                };
                preloader.load(file.getSource());
            }
        }

			for (var i = 0, len = files.length; i < len; i++) {
                var file_name = files[i].name; //文件名
                
                var html = '<li id="file-' + files[i].id + '"><p class="file-name">' + file_name + '</p><p class="progress"></p></li>';
                $(html).appendTo('#file-list');
                !function (i) {
                    
                    
                    previewImage(files[i], function (imgsrc) {
                    	console.log(imgsrc);
                        $('#file-' + files[i].id).append('<img src="' + imgsrc + '" />');
                    })


                }(i);
            }

	        },	
	 
   			FilesRemoved: function(up, files) {
               // Se llama cuando se eliminan archivos de la cola
                //console.log('[FilesRemoved]');

       	        var meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

       	        var self = this;
       	        var identificador = -1;	
       	        var uid_imagen = '';	

				var mifich = {};
				var listCheck = []; 


				plupload.each(files, function(file) {
				               
									
					var incremento = 0;
					$('#uploader_filelist li').each(function( index, element ) {
						//console.log(element);
						//$(element).css('backgroundimage');
						//console.log(file.mes);

							if ($(element).css('background-image') =='none')  {
								//console.log($(element).css('background-image'));
								incremento = -1;
							}		
									//console.log($(element).attr('id'));
									//console.log(self.getFile($(element).attr('id')));
										
									var mifich = self.getFile($(element).attr('id'));
									if ( mifich != undefined) {	
										//console.log(mifich);
										//console.log(mifich.identificador);

										mifich.mes_ultimo = (index+incremento);

						 				var objeto = {  
						 				  identificador : mifich.identificador,
    	        							uid_imagen  : mifich.uid_imagen,
						                     mes_ultimo : mifich.mes_ultimo,
						                     		mes : mifich.mes_ultimo,
						                     	 fichero: mifich.name,		
						                  };			                 		
						                 mifich.mes = mifich.mes_ultimo;
				                 		 listCheck.push(objeto);	

									}
									

							document.getElementById('ia_'+$(element).attr('id')).innerHTML = meses[(index+incremento).toString()];

					});	

				  	
					identificador = file.identificador;
					uid_imagen = file.uid_imagen;						 				  


				});			



						$.ajax({
                              url: hash_url+'fotocalendario/eliminar_unaimagen',
                              method: "POST",
                              dataType: 'json',
                              data: {
                                  datos:listCheck,
                                  identificador : identificador,
                                  uid_imagen  : uid_imagen,
                              },
                              success: function(elim_imagen) { 
                              	console.log(elim_imagen);

								var catalogo = hash_url+'fotocalendario/fotoimagen/'+$.base64.encode(id_session);
  								
			                    hrefPost('POST', catalogo, {
			                          id_session  :id_session,
			                          id_diseno  : id_diseno,
			                          id_tamano  : id_tamano,
			                          consecutivo  : consecutivo,
			                          ano : ano,
			                          mes : $('#mes').val(),
			                          imagen:'si',
			                    }, ''); 


                              	/*
  								var catalogo = hash_url+'fotocalendario/fotoimagen/'+$.base64.encode(id_session);
  								
			                    hrefPost('POST', catalogo, {
			                          id_session  :id_session,
			                          id_diseno  : id_diseno,
			                          id_tamano  : id_tamano,
			                          consecutivo  : consecutivo,
			                          ano : ano,
			                          mes : $('#mes').val(),
			                          imagen:'si',
			                    }, ''); 

									uid_imagen  : uid_imagen,

									uid_imagen = file.uid_imagen;						 				  
									var uid_imagen = '';	
									uid_imagen  : mifich.uid_imagen,
									x.uid_imagen = valor.uid_imagen;						 				  

			                    
			                    */



                              }

                            });   

  								


            },

	 
	        UploadProgress: function(up, file) {
	        		//porciento de completamiento de cada fichero
	            document.getElementById('i_'+file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
	        },
	 


            QueueChanged: function(up) {
                // Called when queue is changed by adding or removing files
                // Se llama cuando la cola se cambia mediante la adición o eliminación de archivos
                console.log('cambio','[QueueChanged]');
                
            },



            Refresh: function(up) {
                // Called when the position or dimensions of the picker change
                // Se llama cuando la posición o las dimensiones del cambio de selector
                console.log('[Refresh]');
            },


 
            OptionChanged: function(up, name, value, oldValue) {
                // Called when one of the configuration options is changed
                // se Llama cuando se cambia una de las opciones de configuración
                console.log('[OptionChanged]', 'Option Name: ', name, 'Value: ', value, 'Old Value: ', oldValue);
            },

 			FileUploaded: function(up, file, info) {
                // Llamado cuando el subir archivo haya terminado
                console.log('[FileUploaded] File:', file, "Info:", info);
            },
  
            ChunkUploaded: function(up, file, info) {
                // Called when file chunk has finished uploading
                // Llamado cuando la carga de trozo haya terminado
                console.log('[ChunkUploaded] File:', file, "Info:", info);
            },
 
            UploadComplete: function(up, files) {
                //  Se llama cuando todos los archivos se cargan o bien fracasaron
                console.log('[UploadComplete]');
            },            
 
			StateChanged: function(up) {
                // Called when the state of the queue is changed
                // Se llama cuando se cambia el estado de la cola. 
                   //Iniciar carga "STARTED" , finalizar carga "STOPPED"
                
					//console.log(up);	
                   if (up.state == plupload.STOPPED) {
                		//console.log(up.files);   	

                		plupload.each(up.files, function( file,i) {


	                  document.getElementById('imagenes').innerHTML += '<div id="i_' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';

	                  			//borrar las imagenes	
	                  			/*
	            				$('#' + file.id).toggle("highlight", function() {
									$(this).remove();
								});
								*/
	            	 
	            	 
	            	 
	                  

                		});	
                   }
                


                //console.log('[StateChanged]', up.state == plupload.STARTED ? "STARTED" : "STOPPED");
            },

	        Error: function(up, err) {
	            document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
	        }




	    }


	});


	// Handle the case when form was submitted before uploading has finished
	$('#form').submit(function(e) {
		// Files in queue upload them first
		if ($('#uploader').plupload('getFiles').length > 0) {

			// When all files are uploaded submit form
			$('#uploader').on('complete', function() {
				$('#form')[0].submit();
			});

			$('#uploader').plupload('start');
		} else {
			alert("You must have at least one file in the queue.");
		}
		return false; // Keep the form from submitting
	});







/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////fin del cargador de Imagenes/////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






	    //var cambio ='no';
	    //var cambio_diseno =0;

	    var url = hash_url+'fotocalendario/calenda_activos';  //EN ESTE CASO APROVECHO EL CONTROLLER DE FOTOCALENDARIO
		$.ajax({
		    url: url,
		    method: "POST",
	        dataType: 'json',
	          data: {
	              id_tamano:id_tamano,
	              id_diseno:id_diseno,
	              consecutivo:consecutivo,
	              id_session:id_session,
	              ano:ano
	          },

			success: function(datos_llenos){
				  $.each(datos_llenos, function (i, valor) { 
					  	  	$('.editar_slider[value="'+valor.id_tamano+'"][consecutivo="'+valor.consecutivo+'"][diseno="'+valor.id_diseno+'"]').prop('disabled', false);	
				  });
			} 
		});


	//OK marcar el elemento activo (slider activo)
	$('.editar_slider[value="'+id_tamano+'"][consecutivo="'+consecutivo+'"][diseno="'+id_diseno+'"]').parent().parent().addClass('bordeado');




	//OK editar un slider se encuentra en "Main.js"
	//$('body').on('click','.editar_slider', function (e) {   



	//OK Desactivar "Eliminar" del elemento activo
	$('.eliminar_slider[value="'+id_tamano+'"][consecutivo="'+consecutivo+'"][diseno="'+id_diseno+'"]').prop('disabled', true);	
	$('.eliminar_slider[value="'+id_tamano+'"][consecutivo="'+consecutivo+'"][diseno="'+id_diseno+'"]').css('display','none');




	////////////////////////////////////////////////////////////////////////////////
	///OK /////////////////////COMIENZO DE LA ELIMINACION DE UN TAMAÑO ESPECIFICO//////
	////////////////////////////////////////////////////////////////////////////////

	

	//eliminar un id_tamaño especifico

	var elimina_id_tamano =0;	
	var elimina_id_diseno =0;	
	var elimina_consecutivo =0;	

	//eliminar un id_tamaño especifico
	$('body').on('click','.eliminar_slider', function (e) {   
		elimina_id_tamano   = $(this).attr('value');
		elimina_id_diseno   = $(this).attr('diseno');
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


		    var url = hash_url+'fotocalendario/eliminar_diseno_completo'; 
				$.ajax({
				    url: url,
				    method: "POST",
			        dataType: 'json',
			          data: {
			              id_session:id_session,
			              id_tamano:elimina_id_tamano,
			              id_diseno:elimina_id_diseno,
			              consecutivo:elimina_consecutivo,
			          },

					success: function(datos_eliminados){
							  spinner.stop();
  							  $('#foopropio').css('display','none');

							  $.each(datos_eliminados, function (i, valor) { 
								  	//console.log(valor);
							  });

							/*  
								$('.editar_slider[value="'+elimina_id_tamano+'"][diseno="'+elimina_id_diseno+'"][consecutivo="'+elimina_consecutivo+'"]').parent().parent().css({	
				             								"display":"none"});
								$("#modaleliminar_tamano").modal("hide"); 
							*/

							var cant_elem_quedan = $('.editar_slider[value="'+elimina_id_tamano+'"][diseno="'+elimina_id_diseno+'"][consecutivo="'+elimina_consecutivo+'"]').parent().parent().siblings(":visible" ).length;
							  

							if (cant_elem_quedan ==1) { //si es el ultimo elemento q queda eliminar todo 
								$('.editar_slider[value="'+elimina_id_tamano+'"][diseno="'+elimina_id_diseno+'"][consecutivo="'+elimina_consecutivo+'"]').parent().parent().parent().css({	
				             								"display":"none"});
								$("#modaleliminar_tamano").modal("hide"); 

							}  else {
								$('.editar_slider[value="'+elimina_id_tamano+'"][diseno="'+elimina_id_diseno+'"][consecutivo="'+elimina_consecutivo+'"]').parent().parent().css({	
				             								"display":"none"});
								$('.editar_slider[value="'+elimina_id_tamano+'"][diseno="'+elimina_id_diseno+'"][consecutivo="'+elimina_consecutivo+'"]').parent().parent().parent().add('');
								$("#modaleliminar_tamano").modal("hide"); 

							}
							






									  //OK "revisey compre", cuando se elimina un elemento checar nuevamente
										
									    var target2 = document.getElementById('foopropio');
									    var spinner = new Spinner(opts).spin(target2);


									    var url = hash_url+'fotocalendario/disenos_completos'; 
										$.ajax({
										    url: url,
										    method: "POST",
									        dataType: 'json',
									          data: {
									              id_session:id_session,
										     	   id_tamano:$('#id_tamano').val(),
									     		   id_diseno:$('#id_diseno').val(),
									     	     consecutivo:$('#consecutivo').val(),
									     	     	     mes:$('#mes').val(),

									          },

											success: function(datos_completos){
																			  
													spinner.stop();
  													$('#foopropio').css('display','none');								  
												   var existe = ($('#image').attr('nombre'));  

												   var resultad = (existe != undefined) ? 1 : 0;

												   resultad = ( resultad * parseInt(datos_completos['elemento']));				  

												  // alert(resultad);
											  $.each(datos_completos['cale_activo'], function (i, valor) { 

											  		//alert((parseInt(valor.cantidad)+resultad));
												  	if ( (parseInt(valor.cantidad)+resultad) >=12) {
													  	$('.previo_slider[value="'+valor.id_tamano+'"][consecutivo="'+valor.consecutivo+'"][diseno="'+valor.id_diseno+'"]').prop('disabled', false);	
													}  

															//el elemento actual

															if ( (valor.consecutivo==$('#consecutivo').val())
																	&& (valor.id_diseno==$('#id_diseno').val())
																	&& (valor.id_tamano==$('#id_tamano').val())
															 ) {									  
																	if ( (parseInt(valor.cantidad)+resultad) >=12) {
																		//$('#guardar').prop('disabled', false);
																		$('#guardar').css('display', '');		
																	} else {
																		//$('#guardar').prop('disabled', true);	
																		$('#guardar').css('display', 'none');
																	}
															}							

												  	
											  });

											  if (datos_completos['cale_activo'].length == datos_completos['total']) {
											  		 $('#guardar').text('Revisa y compra');	 
											  		 $('#guardar').val('si');	 
											  		 $('.compra_menu').prop('disabled', false);	
											  } else {
											  		 $('#guardar').text('Continuar');	 
											  		 $('#guardar').val('no');	 
											  		 $('.compra_menu').prop('disabled', true);	
											  }

										} 
										});

					} 
				});
	    	
	    });		    


////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////final de la eliminacion/////////////////////
////////////////////////////////////////////////////////////////////////////////////////



	  //OK Activar las visualizaciones que ya se han llenado (es decir q ya tienen las 12imagenes por diseños)
		

	    var url = hash_url+'fotocalendario/disenos_completos'; 
		$.ajax({
		    url: url,
		    method: "POST",
	        dataType: 'json',
	          data: {
	              id_session:id_session,
		     	   id_tamano:$('#id_tamano').val(),
	     		   id_diseno:$('#id_diseno').val(),
	     	     consecutivo:$('#consecutivo').val(),
	     	     	     mes:$('#mes').val(),

	          },

			success: function(datos_completos){
				  
					   var existe = ($('#image').attr('nombre'));  

					   var resultad = (existe != undefined) ? 1 : 0;

					   resultad = ( resultad * parseInt(datos_completos['elemento']));				  

				  $.each(datos_completos['cale_activo'], function (i, valor) { 

					  	if ( (parseInt(valor.cantidad)+resultad) >=12) {
						  	$('.previo_slider[value="'+valor.id_tamano+'"][consecutivo="'+valor.consecutivo+'"][diseno="'+valor.id_diseno+'"]').prop('disabled', false);	
						}  

								//el elemento actual

								if ( (valor.consecutivo==$('#consecutivo').val())
										&& (valor.id_diseno==$('#id_diseno').val())
										&& (valor.id_tamano==$('#id_tamano').val())
								 ) {									  
										if ( (parseInt(valor.cantidad)+resultad) >=12) {
											//$('#guardar').prop('disabled', false);
											$('#guardar').css('display', '');		
										} else {
											//$('#guardar').prop('disabled', true);	
											$('#guardar').css('display', 'none');
										}
								}							

					  	
				  });

				  if (datos_completos['cale_activo'].length == datos_completos['total']) {
				  		 $('#guardar').text('Revisa y compra');	 
				  		 $('#guardar').val('si');	 
				  		 $('.compra_menu').prop('disabled', false);	
				  } else {
				  		 $('#guardar').text('Continuar');	 
				  		 $('#guardar').val('no');	 
				  		 $('.compra_menu').prop('disabled', true);	
				  }

			} 
		});
		 









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



	$("#drop-area").on('dragenter', function (e){
		e.preventDefault();
		$(this).css('background', '#BBD5B8');
	});

	$("#drop-area").on('dragover', function (e){
		e.preventDefault();
	});

	$("#drop-area").on('drop', function (e){
		$(this).css('background', '#D8F9D3');
		e.preventDefault();
		var image = e.recorteEvent.dataTransfer.files;
		//console.log(image);
		createFormData(image);
	});

	//1- cuando carga la pagina checar si hay imagenes
	
	buscarImagen();



  
  
  spinner.stop();
  $('#foopropio').css('display','none');

  $('#foopropio').fadeOut('slow', function() {
    // Animation complete
    //$(this).css('display','block');
  });


});


//ok
function createFormData(image) {
  
  var target2 = document.getElementById('foopropio');
  var spinner = new Spinner(opts).spin(target2);


  var id_session = $('#id_session').val();
  var id_diseno = $('#id_diseno').val();
  var id_tamano = $('#id_tamano').val();
  var consecutivo = $('#consecutivo').val();

  var ano = $('#ano').val();
  var mes = $('#mes').val();

  var uid_recorte = id_diseno+'_'+id_tamano+'_'+consecutivo+'_'+ano+'_'+mes;

  var formImage = new FormData();

	//LIMPIAR PRIMERO EL COMPONENTE
	    $('#cont_img').remove();

		 formImage.append('userImage', image[0]);
		formImage.append('id_session', id_session);
		 formImage.append('id_diseno', id_diseno);
		 formImage.append('id_tamano', id_tamano);
	   formImage.append('consecutivo', consecutivo);
	   	formImage.append('mes', mes);

		formImage.append('uid_recorte', uid_recorte);
	uploadFormData(formImage);
  
  spinner.stop();
  $('#foopropio').css('display','none');

}

//OK 2 ARRASTRA IMAGEN
function uploadFormData(formData) {
	var target2 = document.getElementById('foopropio');
    var spinner = new Spinner(opts).spin(target2);

	var hash_url1 =  window.location.protocol+'//'+window.location.hostname+'/sistema/';  
	$.ajax({
		url: hash_url1+'fotocalendario/upload',
		type: "POST",
		data: formData,
		contentType:false,
		cache: false,
		processData: false,
		success: function(data){
			$('#drop-area').append(data);
			  spinner.stop();
  			  $('#foopropio').css('display','none');
		}
	});
}

//poner el mes activo
var mes = $('#mes').val();
$('.mes[nmes="'+mes+'"]').addClass('mes-activo');	

//$(this).find('a').toggleClass('acti');


$('body').on('click','#mes_siguiente', function (e) {
    		if ( parseFloat($('#mes').val()) ==11) {
    			var mes = 0;
    		} else {
    			var mes = parseFloat($('#mes').val())+1;	
    		}
   		
				$('#mesclick').val(mes);	    			
		   		$('#guardar').trigger('click');
});	


$('body').on('click','#mes_anterior', function (e) {
    		if ( parseFloat($('#mes').val()) ==0) {
    			var mes = 11;
    		} else {
    			var mes = parseFloat($('#mes').val())-1;	
    		}
   		
				$('#mesclick').val(mes);	    			
		   		$('#guardar').trigger('click');
});	


  //ok
$('body').on('click','.mes', function (e) {
	//alert('aa');
	//que no vuelva a cargar el mismo
    if ( ($('#mes').val())!=($(this).attr('nmes')) ) {

    		var mes = $(this).attr('nmes');
				$('#mesclick').val(mes);	    			
		   		$('#guardar').trigger('click');

    }
});	


//ok
function buscarImagen() {

    var target2 = document.getElementById('foopropio');
    var spinner = new Spinner(opts).spin(target2);

	  
	 var id_session = $('#id_session').val();
	  var id_diseno = $('#id_diseno').val();
	  var id_tamano = $('#id_tamano').val();
	var consecutivo = $('#consecutivo').val();
	  		var ano = $('#ano').val();
	  		var mes = $('#mes').val();

	var hash_url1 =  window.location.protocol+'//'+window.location.hostname+'/sistema/';  

	  //alert(hash_url+'buscarimagen');
	$.ajax({
		url: hash_url1+'fotocalendario/buscarimagen',
		type: "POST",
		data: {
			id_session: id_session,
			 id_diseno: id_diseno,
			 id_tamano: id_tamano,
		   consecutivo: consecutivo,
			 	   ano: ano,
			 	   mes: mes
		},
		dataType: 'json',
		success: function(data){
			//mostrar la imagen
			    //console.log(data);
				if (data.datos != []) {
					$.each((data.datos), function (i, valor) { //$.parseJSON
						//console.log(i+':'+valor);
						//$('#drop-area').append(i+':'+valor);
					});
					
				}
			//$('#drop-area').append(data.datos.recorte);	

			$('#drop-area').append(data.imagen);
			  spinner.stop();
			  $('#foopropio').css('display','none');			
			
		}
	});
}
