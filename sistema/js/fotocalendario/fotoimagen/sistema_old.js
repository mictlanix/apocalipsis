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
			width : 320, 
			height : 240, 
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
	            //http://www.plupload.com/punbb/viewtopic.php?id=3654

	            //document.getElementById('uploader').addEventListener('drop', alert(), true);
	           /* 				
		        document.getElementById('uploadfiles').onclick = function() {
		                uploader.start();
		                return false;
		         };*/
		         //document.getElementById('uploadfiles').addFile('');


//$('#uploader').plupload('addFile')
//http://www.plupload.com/punbb/viewtopic.php?id=14346
/*
				var array = new Object();
				//var uploaderr = $("#uploader").plupload({});
				$('#uploader').plupload.addFile(fichero);
				 //$(this).addFile($fichero);
*/

				//var fichero= 'http://tinbox.dev.com/sistema/uploads/b9a2e49717b5adb9157a274cfc093aeb/orig_260_314_1_2016_0.jpg';

/*
var image = document.createElement('image');
image.src="data:image/gif;base64,R0lGODlhDwAPAKECAAAAzMzM/////wAAACwAAAAADwAPAAACIISPeQHsrZ5ModrLlN48CXF8m2iQ3YmmKqVlRtW4MLwWACH+H09wdGltaXplZCBieSBVbGVhZCBTbWFydFNhdmVyIQAAOw==";
image.width=100;
image.height=100;
image.alt="here should be some image";
image.name ='prueba';
*/
/*
data:image/png;base…
image.src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAQMAAAAlPW0iAAAAA3NCS…Jld29ya3MgQ1M26LyyjAAAABFJREFUCJlj+M/AgBVhF/0PAH6/D/HkDxOGAAAAAElFTkSuQmCC";
file.name = f.FileName;
file.id = f.FileCode;
file.size = f.FileSize;
file.loaded = f.FileSize;
file.target_name = f.FileName;
file.percent = 100;
file.status = plupload.DONE;
*/
/*
var du = new Image(100, 200);
    du.src ="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAQMAAAAlPW0iAAAAA3NCS…Jld29ya3MgQ1M26LyyjAAAABFJREFUCJlj+M/AgBVhF/0PAH6/D/HkDxOGAAAAAElFTkSuQmCC";
*/
/*
var fi = new Array();
    var x = document.createElement("IMG");
    x.setAttribute("src", "http://tinbox.dev.com/wp-content/uploads/2016/02/thumb-1.jpg");
    x.setAttribute("width", "304");
    x.setAttribute("width", "228");
    x.setAttribute("alt", "The Pulpit Rock");
    x.setAttribute("id", "2222222");

    x.setAttribute("FileName", "thumb-1.jpg");

 

console.log(x.FileSize);
fi.push(x);




		         var self = this;
		         //this.init();
		         this.addFile(fi);
		         //	
*/		         
  //var x = document.createElement("IMG");
//   x.setAttribute("src", "http://tinbox.dev.com/sistema/uploads/b9a2e49717b5adb9157a274cfc093aeb/orig_260_314_1_2016_0.jpg");


function getDataUri(url, callback) {
    var image = new Image();

    image.onload = function () {
        var canvas = document.createElement('canvas');
        canvas.width = this.naturalWidth; // or 'width' if you want a special/scaled size
        canvas.height = this.naturalHeight; // or 'height' if you want a special/scaled size

        canvas.getContext('2d').drawImage(this, 0, 0);

        // Get raw image data
        callback(canvas.toDataURL('image/png').replace(/^data:image\/(png|jpg);base64,/, ''));

        // ... or get as Data URI
        callback(canvas.toDataURL('image/png'));
    };

    image.src = url;
}

// Usage
//var aaa = "data:image/gif;base64,R0lGODlhDwAPAKECAAAAzMzM/////wAAACwAAAAADwAPAAACIISPeQHsrZ5ModrLlN48CXF8m2iQ3YmmKqVlRtW4MLwWACH+H09wdGltaXplZCBieSBVbGVhZCBTbWFydFNhdmVyIQAAOw==";
var url = "http://tinbox.dev.com/sistema/uploads/b9a2e49717b5adb9157a274cfc093aeb/orig_260_314_1_2016_0.jpg";

/*
getDataUri('http://tinbox.dev.com/sistema/uploads/b9a2e49717b5adb9157a274cfc093aeb/orig_260_314_1_2016_0.jpg', function(dataUri) {
    aaa = (dataUri.src);
});
*/

//var aaa = "data:image/jpeg;base64,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";


        var req = new XMLHttpRequest();
        req.open('HEAD', url, false);
        req.send(null);
		 if (req.status === 200) {
		        var fileSize = parseInt(req.getResponseHeader('content-length'));
		        var type = req.getResponseHeader('Content-Type');
		        
		        console.log('fileSize = ' + fileSize);
		 }

        //$estatus= req.status==200;
        console.log(fileSize);

var x = new plupload.File(url, "osmel.jpg", fileSize);
//console.log('x',x);
//console.log('x',x.id);

/*
x.src ='http://tinbox.dev.com/sistema/uploads/b9a2e49717b5adb9157a274cfc093aeb/orig_260_314_1_2016_0.jpg';

*/

x.name= "osmel.jpg";
x.type = type;

x.origSize= fileSize;
x.size= fileSize;
x.status= 1;
x.percent= 0;
x.loaded = 0;
x.target_name = x.name; //"osmel.jpg";
// x.id= 'o_1ahucfpg0v0412js1kej1rvu1gdgc'; no 
/*



*/
this.addFile(x);
//this.addFile(x);
//this.addFile(x);

/*		         																																																																																																																			this.start();
file.name = f.FileName;
file.id = f.FileCode;
file.size = f.FileSize;
file.loaded = f.FileSize;
file.target_name = f.FileName;
file.percent = 100;
file.status = plupload.DONE;
*/

},

	
	 		//se llama cuando se agregan archivos a la cola
	 		//https://github.com/moxiecode/plupload/blob/master/src/plupload.js#L1827
	        FilesAdded: function(up, files) {
	        	
	        	//mostrar ficheros	

	        	      var meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

	            	  var cantidad = files.length;
	            	  var total = $('#uploader').plupload('getFiles').length;

	            	 var inicio = (total-cantidad);
	            	 plupload.each(files, function( file,i) {
	            	 console.log('  File:', file);

				       /*     	  
	            	 console.log(file);	
	            	 console.log( (file.id) );	
	            	 console.log( $(file.id).find('div > div > canvas').id );	
	            	 */
	                  document.getElementById('listaimagenes').innerHTML += '<div id="i_' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
	                  var mes = meses[(inicio+i).toString()];
	                  document.getElementById(file.id).innerHTML += '<div id="ia_' + file.id + '"> <b>'+mes+'</b> </div>';

			            $('#'+file.id).on('mouseup', function(e) {
							
			            	//$('#uploader').plupload('getFiles').
			                 // document.getElementById(file.id).innerHTML += '<div id="ia_' + file.id + '"> <b>aaa</b> </div>';
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
				                 console.log(invisible);

				         if (invisible) {        
			                 $('#uploader_filelist li').each(function( index, element ) {
			                 //plupload.each(files, function(  element, index) {
			                 	
			                 	console.log(element);
			                 	console.log(index);
			                 	
			                 	if ($(element).css('visibility') =='hidden') { //oculto
			                 		visible= index;
			                 		incremento = -1;
			                 		if (mov=='') {
			                 				mov='absoluto';
			                 				incremento = 0;
			                 		};

			                 		console.log('index_visible',index);
			                 		console.log($(element).css('visibility'));
			                 	} else if  ( (file.id) == $(element).attr('id') ) { 
			                 		absolute = $(element).attr('id');
			                 		
			                 		incremento = -1;
			                 		if (mov=='') {
			                 			mov='relativo';
			                 			incremento = -1;
			                 		};
			                 		
			                 		
			                 	} else {
			                 		document.getElementById('ia_'+$(element).attr('id')).innerHTML = meses[(index+incremento).toString()];
			                 	}

			                 	
			                 });
			                    console.log('file_id', file.id);
	                    
			                    if (mov=='relativo') {
									document.getElementById('ia_'+file.id).innerHTML = meses[(visible-1).toString()]; //+'relativo';			                 
			                    } else {
			                    	document.getElementById('ia_'+file.id).innerHTML = meses[(visible).toString()]; //+'absoluto';			                 	
			                    }
			                    
						}		

						});
			            /*
						$('#uploader').bind('drop', function(e) {
							alert('aaa');
						});*/

							


	                  
	            });

	        },
	        
     
   			FilesRemoved: function(up, files) {
               // Se llama cuando se eliminan archivos de la cola
                //console.log('[FilesRemoved]');
  
                plupload.each(files, function(file) {
                    //console.log('  File:', file);
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
 
			StateChanged: function(up) {
                // Called when the state of the queue is changed
                // Se llama cuando se cambia el estado de la cola. 
                   //Iniciar carga "STARTED" , finalizar carga "STOPPED"
                
					console.log(up);	
                   if (up.state == plupload.STOPPED) {
                		console.log(up.files);   	

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
                


                console.log('[StateChanged]', up.state == plupload.STARTED ? "STARTED" : "STOPPED");
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
								  	console.log(valor);
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
		var image = e.originalEvent.dataTransfer.files;
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

  var uid_original = id_diseno+'_'+id_tamano+'_'+consecutivo+'_'+ano+'_'+mes;

  var formImage = new FormData();

	//LIMPIAR PRIMERO EL COMPONENTE
	    $('#cont_img').remove();

		 formImage.append('userImage', image[0]);
		formImage.append('id_session', id_session);
		 formImage.append('id_diseno', id_diseno);
		 formImage.append('id_tamano', id_tamano);
	   formImage.append('consecutivo', consecutivo);
	   	formImage.append('mes', mes);

		formImage.append('uid_original', uid_original);
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
