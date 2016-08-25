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

function previewImage(file, callback) {//file为plupload事件监听函数参数中的file对象,callback为预览图片准备完成的回调函数
            if (!file || !/image\//.test(file.type)) return; 
            
            if (file.type == 'image/gif') {
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
                    //preloader.downsize(300, 300);
                    preloader.downsize();
                    //console.log('preloader',preloader.width);
                    //var imgsrc = preloader.type == 'image/jpeg' ? preloader.getAsDataURL('image/jpeg', 80) : preloader.getAsDataURL(); 
                    callback && callback(preloader); 
                    preloader.destroy();
                    preloader = null;
                };
                preloader.load(file.getSource());
            }
 }

  //  Seleccione las imagenes para el fotocalendario
 //   Agregue hasta 12 imagenes, puede eliminar y reordenar según el mes.

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
			]
		},

		// Rename files by clicking on their titles
		//rename: true,
		
		// Sort files
		sortable: true,
		scroll: false,

		// Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
		dragdrop: true,

		// Views to activate
		views: {
			list: false,
			thumbs: true, // Show imagenes
			active: 'thumbs'
		},

		// Flash settings
		flash_swf_url : '../../js/Moxie.swf',

		// Silverlight settings
		silverlight_xap_url : '../../js/Moxie.xap',


	    init: {
	        PostInit: function() {
	            //document.getElementById('listaimagenes').innerHTML = '';
		           /* 				
		        document.getElementById('uploadfiles').onclick = function() {
		                uploader.start();
		                return false;
		         };*/

		     //    var self = this;

		     var meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

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
                                  $('#messages').html('Es necesario subir una imagen para cada mes');
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

												 	$('#mes'+valor.mes).html('<span class="mes_imagen">*</span>'+meses[valor.mes]);

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
	        	
	        	//mostrar ficheros	
        		var afectado1 =-1;
        		var afectado2 =-1;
        		var self =this;	
        	    var meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

                var cantidad = files.length;
                var total = $('#uploader').plupload('getFiles').length;

                var inicio = (total-cantidad);

               

	            plupload.each(files, function( file,i) {
	            	 

		                //Para las imagen que se suben
		                if  (!file.identificador) {
		                  	
		                  	file.ext = file.name.split('.').pop();
		                  	file.name = 'rec_'+id_diseno+'_'+id_tamano+'_'+consecutivo+'_'+ano+'_'+(inicio+i).toString()+'.'+file.ext;
		                  	file.recorte = 'rec_'+id_diseno+'_'+id_tamano+'_'+consecutivo+'_'+ano+'_'+(inicio+i).toString()+'.'+file.ext;
		                  	file.original = 'orig_'+id_diseno+'_'+id_tamano+'_'+consecutivo+'_'+ano+'_'+(inicio+i).toString()+'.'+file.ext;
		                  	file.mes_ultimo = (inicio+i);
		                  	
							var file_name = file.name; 
				                
				                var html = '<li id="file-' + file.id + '"><p class="file-name">' + file_name + '</p><p class="progress"></p></li>';
				                $(html).appendTo('#file-list');
				                    previewImage(file, function (preloader) {
				        				var imgsrc = preloader.type == 'image/jpeg' ? preloader.getAsDataURL('image/jpeg', 80) : preloader.getAsDataURL(); 
				                        $('#file-' + file.id).append('<img src="' + imgsrc + '" />');
										
										

										
												var objeto = {  
									 					  alto : preloader.width,
									 					 ancho : preloader.height,
									 			   tipo_archivo : preloader.type,
									 			         tamano : preloader.size,
									 			         //tipo : tipo,

									                     nombre : file.name,
									                     recorte : file.recorte,
									                     original : file.original,

									                     	ext : file.ext,
	 									              id_tamano:id_tamano,
	 									              id_diseno:id_diseno,
										              consecutivo:consecutivo,
										              id_session:id_session,
												             ano:ano,
												             croppedImage:imgsrc,
													  //identificador : file.identificador,
									 				  //	uid_imagen  : file.uid_imagen,
									                     mes_ultimo : file.mes_ultimo,
									                     		mes : file.mes_ultimo,
									                };			                 		
									             	
									             	//console.log(objeto);
									             	
									             	
												    var url = hash_url+'fotocalendario/guardar_imagenes';  //EN ESTE CASO APROVECHO EL CONTROLLER DE FOTOCALENDARIO
													$.ajax({
													    url: url,
													    method: "POST",
												        dataType: 'json',
												          data: {
												          	datos: objeto,
												          },

														success: function(datos_llenos){
															//console.log(datos_llenos);
															  $.each(datos_llenos, function (i, valor) { 

																  	  	//$('.editar_slider[value="'+valor.id_tamano+'"][consecutivo="'+valor.consecutivo+'"][diseno="'+valor.id_diseno+'"]').prop('disabled', false);	
															  });


																var catalogo = hash_url+'fotocalendario/fotoimagen/'+$.base64.encode(id_session);
								  								
											                    hrefPost('POST', catalogo, {
											                          id_session  :id_session,
											                          id_diseno  : id_diseno,
											                          id_tamano  : id_tamano,
											                          consecutivo  : consecutivo,
											                          ano : ano,
											                          mes : file.mes_ultimo,
											                          imagen:'si',
											                    }, ''); 


														} 
													});


				                    }); //fin del callback
				                    
        
							   

		                } //fin de las imagenes que se suben
		                  
 						  //document.getElementById('listaimagenes').innerHTML += '<div id="i_' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
		                  var mes = meses[(inicio+i).toString()];
		                  document.getElementById(file.id).innerHTML += '<div id="ia_' + file.id + '"> <b>'+mes+'</b> </div>';

 	

/*
consecutivo, id_diseno, id_tamano,  ano, 
modulo, uid_imagen , id_session,

 //aspectRatio`, `height`, `left`, `naturalHeight`, `naturalWidth`, `rotate`, `scaleX`, `scaleY`, `top`, 
aspectRatio =1;  
left =0;
naturalHeight =ancho; //300 alto
naturalWidth =alto;  //300 ancho
rotate =0;
scaleX =0;
scaleY =0;
top =0;

//`width`, `cleft`, `ctop`, `cheight`, `cwidth`, `cnaturalWidth`, `cnaturalHeight`,
//300, 300, 0, 300, 300, 300, 300,
width= ancho;
cleft =ancho;
ctop =0;
cheight =alto;
cwidth =ancho;
cnaturalWidth =ancho;
cnaturalHeight =alto;

//dx`, `dy`, `dwidth`, `dheight`, `drotate`, `dscaleX`, `dscaleY`, `bleft`, `btop`, `bwidth`, `bheight`, 
//0, 0, 300, 300, 0, 1, 1, 0.5, 0, 300, 300, 
dx =0; 
dy=0; 
dwidth =ancho; 
dheight=alto;
drotate = 0;
dscaleX=1;
dscaleY=1;
bleft = 0.5 
btop =0;
bwidth=ancho; 
bheight=alto;


//`id_usuario`, `fecha_mac`, `variation_id`, `id_user`
//'', '2016-05-06 13:36:39', 314, 0);
variation_id =  id_tamano
id_user =  modelo;

*/

/*
INSERT INTO `tinbox_fotocalendario_imagenes_recorte` (`id`, `id_session`, `modulo`, `consecutivo`, 
`id_diseno`, `id_tamano`, `uid_imagen`, `nombre`,
(86, 'b9a2e49717b5adb9157a274cfc093aeb', 'f', 1,
260, 314, 'uid_06052016_Pfbj759', 'rec_260_314_1_2016_4.jpg',

 `aspectRatio`, `height`, `left`, `naturalHeight`, `naturalWidth`, `rotate`, `scaleX`, `scaleY`, `top`, 
`width`, `cleft`, `ctop`, `cheight`, `cwidth`, `cnaturalWidth`, `cnaturalHeight`,
 `dx`, `dy`, `dwidth`, `dheight`, `drotate`, `dscaleX`, `dscaleY`, `bleft`, `btop`, `bwidth`, `bheight`, 
 `id_usuario`, `fecha_mac`, `variation_id`, `id_user`) VALUES

1, 300, 0, 300, 300, 0, 0, 0, 0,
300, 300, 0, 300, 300, 300, 300,
0, 0, 300, 300, 0, 1, 1, 0.5, 0, 300, 300, 
'', '2016-05-06 13:36:39', 314, 0);


INSERT INTO `tinbox_fotocalendario_imagenes_original` (`id`, `id_session`, `modulo`, `consecutivo`, `id_diseno`, `id_tamano`, `uid_imagen`, `nombre`, `tipo_archivo`, `tipo`, `ext`, `tamano`, `ancho`, `alto`, `id_usuario`, `fecha_mac`, `variation_id`, `id_user`) VALUES
(86, 'b9a2e49717b5adb9157a274cfc093aeb', 'f', 1, 260, 314, 'uid_06052016_Pfbj759', 'orig_260_314_1_2016_4.jpg', 'image/jpeg', 'jpeg', '.jpg', '18.32', '300', '300', '', '2016-05-06 13:27:08', 314, 0);


INSERT INTO `tinbox_fotocalendario_imagenes` (`id`, `id_session`, `modulo`, `consecutivo`, `uid_imagen`, `id_diseno`, `id_tamano`, `ano`, `mes`, `dia`, `original`, `recorte`, `original_old`, `recorte_old`, `id_usuario`, `fecha_mac`, `variation_id`, `id_user`) VALUES
(86, 'b9a2e49717b5adb9157a274cfc093aeb', 'f', 1, 'uid_06052016_Pfbj759', 260, 314, '2016', '4', NULL, 'orig_260_314_1_2016_4.jpg', 'rec_260_314_1_2016_4.jpg', '', '', '', '2016-05-06 13:27:08', 314, 0);
*/


			            $('#'+file.id).on('mouseup', function(e) {
							
				                 var incremento = 0;
				                 var absolute = '';
				                 var visible = -1;
				                 var mov = '';
				                 var invisible = false;


				                 $('#uploader_filelist li').each(function( index, element ) {
				                 	 if ($(element).css('visibility') =='hidden')  {
				                 	 	invisible=true;
				                 	 } 

				                 });	
					               

					               var mifich = {};
					               var listCheck = []; 

							        if (invisible) {        
						                 $('#uploader_filelist li').each(function( index, element ) {
						                 	 mifich = self.getFile($(element).attr('id'));
						                 
						                 	
						                 	//console.log(element);
						                 	//console.log(index);
						                 	
						                 	if ($(element).css('visibility') =='hidden') { //oculto
						                 		visible= index;
						                 		afectado2 =visible-1;
						                 		//alert(visible-1);
						                 		incremento = -1;
						                 		if (mov=='') {
						                 				mov='absoluto';
						                 				incremento = 0;
						                 		};

						                 		//console.log('index_visible',index);
						                 		//console.log($(element).css('visibility'));
						                 	} else if  ( (file.id) == $(element).attr('id') ) { 
						                 		absolute = $(element).attr('id');
						                 		//alert(index);
						                 		afectado1 =index;
						                 		incremento = -1;
						                 		if (mov=='') {
						                 			mov='relativo';
						                 			incremento = -1;
						                 		};
						                 		
						                 		
						                 	} else {
						                 		document.getElementById('ia_'+$(element).attr('id')).innerHTML = meses[(index+incremento).toString()];
						                 		    mifich.mes_ultimo = (index+incremento);

									 				var objeto = {  
									 				  identificador : mifich.identificador,
									 				  	uid_imagen  : mifich.uid_imagen,
									                     mes_ultimo : mifich.mes_ultimo,
									                     		mes : mifich.mes_ultimo,
									                     fichero     : mifich.name,		
									                  };			                 		
									                 mifich.mes = mifich.mes_ultimo;
							                 		 listCheck.push(objeto);	

						                 	}

						                 	
						                 });
						                    
			                    
					                    if (mov=='relativo') {
											document.getElementById('ia_'+file.id).innerHTML = meses[(visible-1).toString()]; //+'relativo';			                 
											mifich = self.getFile(file.id);
											mifich.mes_ultimo = (visible-1);


					                    } else {
					                    	document.getElementById('ia_'+file.id).innerHTML = meses[(visible).toString()]; //+'absoluto';			                 	
					                    	mifich = self.getFile(file.id);
					                    	mifich.mes_ultimo = (visible);
					                    }

						 				var objeto = {  
							 				  identificador : mifich.identificador,
												uid_imagen  : mifich.uid_imagen,
							                     mes_ultimo : mifich.mes_ultimo,
							                     		mes : mifich.mes_ultimo,
							                     		fichero     : mifich.name,
							                  };			                 		
							                 mifich.mes = mifich.mes_ultimo;


					                 		 listCheck.push(objeto);	


											$.ajax({
					                              url: hash_url+'fotocalendario/actualizar_todasimagenes',
					                              method: "POST",
					                              dataType: 'json',
					                              data: {
					                                  datos:listCheck,
					                              },
					                              success: function(actualizados) { 
					                              	//console.log(actualizados);



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
								                    



					                              }

					                            });   
			                    
									    } //fin de if invisible		
							        });  //fin del mouseup

	            }); //fin de    plupload.each(files, function( file,i) {

	            	
			 //this.refresh();
			 //this.start();
			 		

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
                              	//console.log(elim_imagen);

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




                              }

                            });  


				});			



						 

  								


            },

	 
	        UploadProgress: function(up, file) {
	        		//porciento de completamiento de cada fichero
	            //document.getElementById('i_'+file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
	        },
	 


            QueueChanged: function(up) {
                // Called when queue is changed by adding or removing files
                // Se llama cuando la cola se cambia mediante la adición o eliminación de archivos
                //console.log('cambio','[QueueChanged]');
                
            },



            Refresh: function(up) {
                // Called when the position or dimensions of the picker change
                // Se llama cuando la posición o las dimensiones del cambio de selector
                //console.log('[Refresh]');
            },


 
            OptionChanged: function(up, name, value, oldValue) {
                // Called when one of the configuration options is changed
                // se Llama cuando se cambia una de las opciones de configuración
                //console.log('[OptionChanged]', 'Option Name: ', name, 'Value: ', value, 'Old Value: ', oldValue);
            },

 			FileUploaded: function(up, file, info) {
                // Llamado cuando el subir archivo haya terminado
                //console.log('[FileUploaded] File:', file, "Info:", info);
            },
  
            ChunkUploaded: function(up, file, info) {
                // Called when file chunk has finished uploading
                // Llamado cuando la carga de trozo haya terminado
                //console.log('[ChunkUploaded] File:', file, "Info:", info);
            },
 
            UploadComplete: function(up, files) {
                //  Se llama cuando todos los archivos se cargan o bien fracasaron
                //console.log('[UploadComplete]');
            },            
 
			StateChanged: function(up) {
                // Called when the state of the queue is changed
                // Se llama cuando se cambia el estado de la cola. 
                   //Iniciar carga "STARTED" , finalizar carga "STOPPED"
                
					//console.log(up);	
                   if (up.state == plupload.STOPPED) {
                		//console.log(up.files);   	

                		plupload.each(up.files, function( file,i) {


	                  //document.getElementById('imagenes').innerHTML += '<div id="i_' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';

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
