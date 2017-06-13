$(function () {


  'use strict';

  var console     = window.console || { log: function () {} };
  var $image      = $('#image');
  var $download   = $('#download');
  var $dataX      = $('#dataX');
  var $dataY      = $('#dataY');
  var $dataHeight = $('#dataHeight');
  var $dataWidth  = $('#dataWidth');
  var $dataRotate = $('#dataRotate');
  var $dataScaleX = $('#dataScaleX');
  var $dataScaleY = $('#dataScaleY');

  var hash_url =  window.location.protocol+'//'+window.location.hostname+'/subdomains/beta/sistema/';  

  var options = {
 
        

    strict: false,
  

  //Estableciendo la relación de aspecto
        aspectRatio:  4 / 3, //1 / 1,
        //viewMode: 3,

        //deshabilita para recortar la imagen de forma automática cuando initialize.
        //toma la forma de la imagen y desde 0--1 
        autoCropArea: 0, //entre 0 y 1
        //restore: false,
        
        //Mostrar el modal negro sobre la imagen y en el cuadro de recorte.
        modal: true,
        //Mostrar las líneas de puntos(dashed ) por encima del cuadro de recorte.
        guides: false,

        //Mostrar el modal blanco sobre el cuadro de recorte (resaltando el cuadro de recorte).
        highlight: false,

        preview: '.img-preview',
        dragCrop: false,
        
	//mouseWheelZoom: true,
        zoomOnWheel:false, //deshabilitar el mouse

        resizable: true,

        //comenzar con el estado de mover (manito)
        dragMode: 'move',
        //Deshabilitar el cambio entre el modo "crop" y "move"  al hacer dobleClick
        toggleDragModeOnDblclick:false,

        //Desabilitar las acciones de mover y cambiar tamaño en cuadro de recorte.
        cropBoxMovable:false,
        cropBoxResizable:false,

        //minimo en que se puede poner el contenedor        
        
        minContainerWidth:801,
        minContainerHeight:600.75,
       
        //minimo en que se puede poner el cropper
        minCropBoxWidth: 801,
        minCropBoxHeight: 600.75,
  


        //minimo en que puede achicar la imagen(Canvas)
        
        
        
        minCanvasWidth:801,  //minimo Ancho de la imagen
        minCanvasHeight:600.75, //minimo Alto de la imagen 



      crop: function (e) {
          $dataX.val(Math.round(e.x));
          $dataY.val(Math.round(e.y));
          $dataHeight.val(Math.round(e.height));
          $dataWidth.val(Math.round(e.width));
          $dataRotate.val(e.rotate);
          $dataScaleX.val(e.scaleX);
          $dataScaleY.val(e.scaleY);
      },

      built:function(){
          
            var naturalWidth = parseFloat($('#image').attr('naturalwidth'));
            if (naturalWidth !== NaN) {  //if (naturalWidth !== NaN) {  no se veia la imagen
                              

                  var naturalWidth = parseFloat($('#image').attr('naturalwidth'));               

                 var naturalHeight = parseFloat($('#image').attr('naturalheight'));

                        
                        var rotate = ($('#image').attr('rotate'));

                        //console.log(rotate);

                        var scaleX = parseInt($('#image').attr('scalex'));
                        var scaleY = parseInt($('#image').attr('scaley'));
                         var ratio = parseInt($('#image').attr('ratio'));

                     var   dx      = parseFloat($('#image').attr('dx'));
                     var   dy      = parseFloat($('#image').attr('dy'));
                     var   dwidth  = parseFloat($('#image').attr('dwidth'));
                     var   dheight = parseFloat($('#image').attr('dheight'));
                     var   dscaleX = parseFloat($('#image').attr('dscaleX'));
                     var   dscaleY = parseFloat($('#image').attr('dscaleY'));
                     var   drotate = parseFloat($('#image').attr('drotate'));

                     var     bleft = parseFloat($('#image').attr('bleft'));
                     var      btop = parseFloat($('#image').attr('btop'));
                     var    bwidth = parseFloat($('#image').attr('bwidth'));
                     var   bheight = parseFloat($('#image').attr('bheight'));


                        var cwidth = parseFloat($('#image').attr('cwidth'));
                       var cheight = parseFloat($('#image').attr('cheight'));
                         var cleft = parseFloat($('#image').attr('cleft'));
                          var ctop = parseFloat($('#image').attr('ctop'));

                          /*
                 alert(naturalWidth);
                 alert(naturalHeight);
                 alert(rotate);
                 alert(scaleX);*/


                    
                      $('#image').cropper('setCanvasData',{
                                   width: cwidth,
                                  height: cheight,
                                    left: cleft,
                                     top: ctop,
                            naturalWidth: naturalWidth,
                           naturalHeight: naturalHeight
                      });

                      $('#image').cropper('rotate',rotate);
                      
                      //OJO No se presenta la imagen sino tiene scalax y y
                      //$('#image').cropper('scaleX', scaleX);
                      //$('#image').cropper('scaleY', scaleY);
                      
                     //$('#image').cropper('scale', scaleX,scaleY);
                     //$('#image').cropper('setAspectRatio', ratio);
                     //$('#image').cropper('setAspectRatio', '30 / 9');

                     // Width and Height params are number types instead of string
                    


            $('#image').cropper("setCropBoxData", { width: 801, height: 600.75 });     



              if ( parseFloat($('#image').attr('total_elementos')) >=12 ) {
                  $('#guardar').css('display', '');   
                  $('.previo_slider[value="'+$('#id_tamano').val()+'"][consecutivo="'+$('#consecutivo').val()+'"][diseno="'+$('#id_diseno').val()+'"]').prop('disabled', false);  
              }  

            }

            }

      }; //fin del option




   // Tooltip
  $('[data-toggle="tooltip"]').tooltip();


  // Cropper

  $image.on({
    
    //"build" Es llamada cuando una instancia cropper comienza a cargar una imagen.
    'build.cropper': function (e) {
      console.log(e.type);
    },

    //"built" Es llamada cuando una instancia cropper se ha construido completamente.
    'built.cropper': function (e) {
      console.log(e.type);
    },
    
    
    //"cropstart" Es llamada cuando el "canvas" o el "cuadro de recorte" comienza(start) a cambiar.
    'cropstart.cropper': function (e) {
      console.log(e.type, e.action);
    },

    
    
    //"cropmove" Es llamada cuando el "canvas" o el "cuadro de recorte" esta cambiando
    'cropmove.cropper': function (e) {
      console.log(e.type, e.action);
    },

    //"cropend" Es llamada cuando el "canvas" o el "cuadro de recorte" deja(stop) de cambiar.
    'cropend.cropper': function (e) {
      console.log(e.type, e.action);
    },

    //"crop". Se llama cuando el "canvas" o el "cuadro de recorte" cambiaron.
    'crop.cropper': function (e) { //constantemente mientras se mueva
      console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
    },

    //"zoom" Se llama cuando una instancia cropper comienza a acercar o alejar(zoom) la imagen de su canvas
    'zoom.cropper': function (e) { //zoom + o -
      console.log(e.type, e.ratio);
    }
    
  }).cropper(options);




  // Buttons
  
  if (!$.isFunction(document.createElement('canvas').getContext)) {
    $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
  }

  if (typeof document.createElement('cropper').style.transition === 'undefined') {
    $('button[data-method="rotate"]').prop('disabled', true);
    $('button[data-method="scale"]').prop('disabled', true);
  }
  


//https://developer.mozilla.org/es/docs/Web/API/HTMLCanvasElement/toBlob (PolyfillEDIT)
if (!HTMLCanvasElement.prototype.toBlob) {
 Object.defineProperty(HTMLCanvasElement.prototype, 'toBlob', {
  value: function (callback, type, quality) {

    var binStr = atob( this.toDataURL(type, quality).split(',')[1] ),
        len = binStr.length,
        arr = new Uint8Array(len);

    for (var i=0; i<len; i++ ) {
     arr[i] = binStr.charCodeAt(i);
    }

    callback( new Blob( [arr], {type: type || 'image/png'} ) );
  }
 });
}







  // Methods //click encima de cualquier boton que esta debajo de la imagen
  $('.docs-buttons').on('click', '[data-method]', function () {
    var $this = $(this);
    var data = $this.data();
    var $target;
    var result;


    if ($this.prop('disabled') || $this.hasClass('disabled')) {
      return;
    }

    if ($image.data('cropper') && data.method) {
      data = $.extend({}, data); // Clone a new one

      if (typeof data.target !== 'undefined') {
        $target = $(data.target);

        if (typeof data.option === 'undefined') {
          try {
            data.option = JSON.parse($target.val());
          } catch (e) {
            console.log(e.message);
          }
        }
      }

      result = $image.cropper(data.method, data.option, data.secondOption);



      switch (data.method) {
     
        
        case 'scaleX':
        case 'scaleY':
          $(this).data('option', -data.option);
          break;
        
        case 'getCroppedCanvas':
          if (result) {

            // Bootstrap's Modal
   
            $image.attr('href', result.toDataURL() );

            if (!$download.hasClass('disabled')) {
             
            }
          }

          break;
      }

      if ($.isPlainObject(result) && $target) {
        try {
          $target.val(JSON.stringify(result));
        } catch (e) {
          console.log(e.message);
        }
      }

    }
  });



  // Keyboard   //cuando muevo con las teclas 
  $(document.body).on('keydown', function (e) {
    
    return;

    if (!$image.data('cropper') || this.scrollTop > 300) {
      return;
    }

    switch (e.which) {
      case 37:
        e.preventDefault();
        $image.cropper('move', -1, 0);
        break;

      case 38:
        e.preventDefault();
        $image.cropper('move', 0, -1);
        break;



      case 39:
        e.preventDefault();
        $image.cropper('move', 1, 0);
        break;

      case 40:
        e.preventDefault();
        $image.cropper('move', 0, 1);
        break;
    }

  });


  // Import image
  var $inputImage = $('#inputImage');
  var URL = window.URL || window.webkitURL;
  var blobURL;

  if (URL) {
    $inputImage.change(function () {
      var files = this.files;
      var file;

      if (!$image.data('cropper')) {
        return;
      }

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          blobURL = URL.createObjectURL(file);
          $image.one('built.cropper', function () {
            // Revoke when load complete
            URL.revokeObjectURL(blobURL);

           //var fichero = e.originalEvent.dataTransfer.files;
            createFormData(file);            


          }).cropper('reset').cropper('replace', blobURL);
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });
  } else {
    $inputImage.prop('disabled', true).parent().addClass('disabled');
  }



//ok
function createFormData(image) {

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

     formImage.append('userImage', image);
    formImage.append('id_session', id_session);
     formImage.append('id_diseno', id_diseno);
     formImage.append('id_tamano', id_tamano);
     formImage.append('consecutivo', consecutivo);
    formImage.append('uid_original', uid_original);
       formImage.append('mes', mes);

  uploadFormData(formImage);
}

//OK 2 ARRASTRA IMAGEN
function uploadFormData(formData) {
  var hash_url1 =  window.location.protocol+'//'+window.location.hostname+'/subdomains/beta/sistema/';  
  $.ajax({
    url: hash_url1+'fotocalendario/upload',
    type: "POST",
    data: formData,
    contentType:false,
    cache: false,
    processData: false,
    success: function(data){
      $('#drop-area').append(data);
    }
  });
}




/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////Codigo extra/////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////





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



//ok
function guardar3() {
  var result;
   

       var id_session = $('#id_session').val();
        var id_diseno = $('#id_diseno').val();
        var id_tamano = $('#id_tamano').val();
      var consecutivo = $('#consecutivo').val();

              var ano = $('#ano').val();
              var mes = $('#mes').val();

    var tipo_archivo  = ($('#image').attr('tipo_archivo'));
           var nombre = ($('#image').attr('nombre'));
          
             var tipo = ($('#image').attr('tipo'));
              var ext = ($('#image').attr('ext'));
           var tamano = ($('#image').attr('tamano'));
            var ancho = ($('#image').attr('ancho'));
             var alto = ($('#image').attr('alto'));

        
    if ($image.data('cropper')) {

                    var datoimagen =  $image.cropper('getImageData');
                    var datocanvas =  $image.cropper('getCanvasData');
                        var result =  $image.cropper('getCroppedCanvas'); //
                         var datos =  $image.cropper('getData');
                   var datocropbox =  $image.cropper('getCropBoxData');

           var croppedImageDataURL = result.toDataURL(tipo_archivo); 
                      var formData = new FormData();

            formData.append('datoimagen', JSON.stringify(datoimagen));
            formData.append('datocanvas', JSON.stringify(datocanvas));

            formData.append('croppedImage', croppedImageDataURL);//
            
            formData.append('datos', JSON.stringify(datos));
            formData.append('datocropbox', JSON.stringify(datocropbox));

            formData.append('tipo_archivo', tipo_archivo);
            formData.append('nombre', nombre);
            formData.append('tipo', tipo);
            formData.append('ext', ext);
            formData.append('tamano', tamano);
            formData.append('ancho', ancho);
            formData.append('alto', alto);

            formData.append('ano', ano);
            formData.append('mes', mes);
            
            formData.append('id_session', id_session);
            formData.append('id_diseno', id_diseno);
            formData.append('id_tamano', id_tamano);
            formData.append('consecutivo', consecutivo);

            //guardar imagen      
            $.ajax(hash_url+'fotocalendario/guardar_imagen', {
              method: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function(data) {  

           
                    $('#cont_img').remove();
                    var mes = $('#mesclick').val();
           
                    //$('#id_diseno').val(id_diseno); //dat_diseno //val(dat_diseno); //dat_diseno

                    //cargar nuevamente fotoimagen/index
                    var catalogo = hash_url+'fotocalendario/fotoimagen/'+$.base64.encode(id_session);



                    hrefPost('POST', catalogo, {
                          id_tamano : id_tamano,
                          id_diseno : id_diseno,
                        consecutivo : consecutivo,
                                ano : ano,
                                mes : mes,
                              imagen: 'si',
                    }, '');                             

                    


              },
              error: function () {
                console.log('Upload error');
              }
            }); 
     } 


}



function guardar2() {
  var result;

  var id_session = $('#id_session').val();
  var id_diseno = $('#id_diseno').val();
  var id_tamano = $('#id_tamano').val();
  var consecutivo = $('#consecutivo').val();

  var ano = $('#ano').val();
  var mes = $('#mes').val();
  
  var tipo_archivo= ($('#image').attr('tipo_archivo'));
  var nombre = ($('#image').attr('nombre'));
  
  var tipo = ($('#image').attr('tipo'));
  var ext = ($('#image').attr('ext'));
  var tamano = ($('#image').attr('tamano'));
  var ancho = ($('#image').attr('ancho'));
  var alto = ($('#image').attr('alto'));

  
     if ($image.data('cropper')) {
      /*
        var target2 = document.getElementById('foopropio');
        var spinner = new Spinner(opts).spin(target2);
        */



            var datoimagen = $image.cropper('getImageData');
            var datocanvas = $image.cropper('getCanvasData');
            
            var result =  $image.cropper('getCroppedCanvas'); //
            var datos =  $image.cropper('getData');

            var datocropbox =  $image.cropper('getCropBoxData');

            var croppedImageDataURL = result.toDataURL(tipo_archivo); 
            var formData = new FormData();

            formData.append('datoimagen', JSON.stringify(datoimagen));
            formData.append('datocanvas', JSON.stringify(datocanvas));

            formData.append('croppedImage', croppedImageDataURL);//
            
            formData.append('datos', JSON.stringify(datos));
            formData.append('datocropbox', JSON.stringify(datocropbox));

            formData.append('id_session', id_session);
            formData.append('id_diseno', id_diseno);
            formData.append('id_tamano', id_tamano);
            formData.append('consecutivo', consecutivo);

            formData.append('tipo_archivo', tipo_archivo);
            formData.append('nombre', nombre);
            formData.append('tipo', tipo);
            formData.append('ext', ext);
            formData.append('tamano', tamano);
            formData.append('ancho', ancho);
            formData.append('alto', alto);

            formData.append('ano', ano);
            formData.append('mes', mes);

            $.ajax(hash_url+'fotocalendario/guardar_imagen', {
              method: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function(data) {  
                   /*
                    spinner.stop();
                    $('#foopropio').css('display','none');
                    */

                    
                    var target2 = document.getElementById('foopropio');
                    var spinner = new Spinner(opts).spin(target2);
                    
                    $.ajax({
                          url: hash_url+'fotocalendario/revisar_imagenes',
                          method: "POST",
                          dataType: 'json',
                          data: {
                               id_session:id_session,
                                id_diseno:id_diseno,
                                id_tamano:id_tamano,
                              consecutivo:consecutivo,                            
                              ano:ano
                          },
                          success: function(cant_imagen) { 
                            if (cant_imagen <=1) {
                                  
                                  spinner.stop();
                                  $('#foopropio').css('display','none');
                                  
                                
                                $('#messages').css('display','block');
                                $('#messages').addClass('alert-danger');
                                $('#messages').html(cant_imagen);
                                $('html,body').animate({
                                  'scrollTop': $('#messages').offset().top
                                }, 1000);
                            }else{
                                var catalogo= hash_url+'fotocalendario/fotocalendario/'+$.base64.encode(id_session);
                                        
                                        spinner.stop();
                                        $('#foopropio').css('display','none');
                                        
                                        hrefPost('POST', catalogo, {
                                       id_session:id_session,
                                        id_diseno:id_diseno,
                                        id_tamano:id_tamano,
                                      consecutivo:consecutivo,                            
                                }, ''); 
                            }

                          },
                      error: function () {
                          console.log('Upload error');
                        }
                    }); 


              },
              error: function () {
                console.log('Upload error');
              }
            }); 
         
     }   

}

//ok
$('body').on('click', '#guardar', function (e) {

      

      var id_session = $('#id_session').val();
      var id_diseno = $('#id_diseno').val();
      var id_tamano = $('#id_tamano').val();
      var consecutivo = $('#consecutivo').val();

      var ano = $('#ano').val();
      var mes = $('#mes').val();

      var existe = ($('#image').attr('nombre'));  


    //si fue una presion real del boton continuar
    if (!(e.isTrigger)) { 
        var revisa_compra=$(this).attr('value'); //

        if (revisa_compra == 'si') { //si ya se activo "revisa y compra"-> es decir es el ultimo elemento

                     var id_session = $('#id_session').val();
                      var ano = $("#ano").val();
                      var existe = ($('#image').attr('nombre'));  



                   var id_edicion_tamano      = $(this).attr('value');
                   var id_edicion_diseno      = $(this).attr('diseno');
                   var id_edicion_consecutivo = $(this).attr('consecutivo');


                  if ( existe != undefined) { //si hay imagen para guardar
                            guardar5(id_edicion_tamano, id_edicion_diseno, id_edicion_consecutivo);
                  } else { //no hay imagen para guardar

                       var catalogo= hash_url+'fotocalendario/fotorevise/'+$.base64.encode(id_session);
                        hrefPost('POST', catalogo, {
                              id_diseno  : id_diseno,
                              id_tamano  : id_tamano,
                              consecutivo  : consecutivo,
                                    ano  : ano,
                        }, ''); 
                  }
                  
                       
        } else {  //si todavia esta en "continuar"  --> es decir no ha llegado al ultimo elemento
            if ( existe != undefined) { //si hay imagen para guardar donde estoy posicionado
                guardar2();
            }  else { //sino hay imagenes para guardar donde estoy posicionado
                          /*
                          var target2 = document.getElementById('foopropio');
                          var spinner = new Spinner(opts).spin(target2);
                          */



                        $.ajax({
                              url: hash_url+'fotocalendario/revisar_imagenes',
                              method: "POST",
                              dataType: 'json',
                              data: {
                                  id_session  : id_session,
                                  id_diseno   : id_diseno,
                                  id_tamano   : id_tamano,
                                  consecutivo : consecutivo,
                                  ano:ano
                              },
                              success: function(cant_imagen) { 
                                if (cant_imagen <=1) {
                                    /*
                                    spinner.stop();
                                    $('#foopropio').css('display','none');
                                    */

                                  
                                  $('#messages').css('display','block');
                                  $('#messages').addClass('alert-danger');
                                  $('#messages').html(cant_imagen);
                                  $('html,body').animate({
                                    'scrollTop': $('#messages').offset().top
                                  }, 1000);
                                }else{
                                    var catalogo= hash_url+'fotocalendario/fotocalendario/'+$.base64.encode(id_session);
                                      /*
                                      spinner.stop();
                                      $('#foopropio').css('display','none');
                                      */
                                    hrefPost('POST', catalogo, {
                                        id_diseno  : id_diseno,
                                        id_tamano  : id_tamano,
                                        consecutivo  : consecutivo,
                                    }, ''); 
                                }


                              },
                          error: function () {
                              console.log('Upload error');
                            }
                        }); 


            }  


       }      



    } else {  //si fue invocado a la fuerza el trigger "para cambiar de mes"
      
        if ( existe != undefined) { //si hay imagen para guardar

                  guardar3();

        } else { //no hay imagen para guardar
                    $('#cont_img').remove();
                    var mes = $('#mesclick').val();

                    //cargar nuevamente fotoimagen/index
                    var catalogo = hash_url+'fotocalendario/fotoimagen/'+$.base64.encode(id_session);


                    hrefPost('POST', catalogo, {
                          id_session:id_session,
                          id_diseno  : id_diseno,
                          id_tamano  : id_tamano,
                          consecutivo  : consecutivo,
                          ano : ano,
                          mes : mes,
                          imagen:'si',
                    }, '');                             

        }


    }

});




 //OK para guardar la imagen cuando se regresa a una "edicion de diseño"
function guardar4(id_edicion_tamano, id_edicion_diseno, id_edicion_consecutivo) {
  var result;

  var id_session = $('#id_session').val();
  var id_diseno = $('#id_diseno').val();
  var id_tamano = $('#id_tamano').val();
  var consecutivo = $('#consecutivo').val();

  var ano = $('#ano').val();
  var mes = $('#mes').val();

  
  var tipo_archivo= ($('#image').attr('tipo_archivo'));
  var nombre = ($('#image').attr('nombre'));
  
  var tipo = ($('#image').attr('tipo'));
  var ext = ($('#image').attr('ext'));
  var tamano = ($('#image').attr('tamano'));
  var ancho = ($('#image').attr('ancho'));
  var alto = ($('#image').attr('alto'));

  
     if ($image.data('cropper')) {
            /*
            var target2 = document.getElementById('foopropio');
            var spinner = new Spinner(opts).spin(target2);
            */


            var datoimagen = $image.cropper('getImageData');
            var datocanvas = $image.cropper('getCanvasData');
            
            var result =  $image.cropper('getCroppedCanvas'); //
            var datos =  $image.cropper('getData');

            var datocropbox =  $image.cropper('getCropBoxData');

            var croppedImageDataURL = result.toDataURL(tipo_archivo); 
            var formData = new FormData();

            formData.append('datoimagen', JSON.stringify(datoimagen));
            formData.append('datocanvas', JSON.stringify(datocanvas));

            formData.append('croppedImage', croppedImageDataURL);//
            
            formData.append('datos', JSON.stringify(datos));
            formData.append('datocropbox', JSON.stringify(datocropbox));
           

            formData.append('tipo_archivo', tipo_archivo);
            formData.append('nombre', nombre);
            formData.append('tipo', tipo);
            formData.append('ext', ext);
            formData.append('tamano', tamano);
            formData.append('ancho', ancho);
            formData.append('alto', alto);

            formData.append('ano', ano);
            formData.append('mes', mes);

            formData.append('id_session', id_session);
            formData.append('id_diseno', id_diseno);
            formData.append('id_tamano', id_tamano);
            formData.append('consecutivo', consecutivo);


            $.ajax(hash_url+'fotocalendario/guardar_imagen', {
              method: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function(data) {  

                      /*
                      spinner.stop();
                      $('#foopropio').css('display','none');
                      */

                    var catalogo = hash_url+'fotocalendario/fotocalendario/'+$.base64.encode(id_session);
                               

                                hrefPost('POST', catalogo, {
                                      id_edicion_tamano : id_edicion_tamano,
                                      id_edicion_diseno : id_edicion_diseno,
                                 id_edicion_consecutivo : id_edicion_consecutivo,

                    }, ''); 


              },
              error: function () {
                console.log('Upload error');
              }
            }); 
         
     }   

}


 //OK para guardar la imagen cuando se va a  "revisa y compra"
function guardar5(id_edicion_tamano, id_edicion_diseno, id_edicion_consecutivo) {
  var result;

  var id_session = $('#id_session').val();
  var id_diseno = $('#id_diseno').val();
  var id_tamano = $('#id_tamano').val();
  var consecutivo = $('#consecutivo').val();

  var ano = $('#ano').val();
  var mes = $('#mes').val();

  
  var tipo_archivo= ($('#image').attr('tipo_archivo'));
  var nombre = ($('#image').attr('nombre'));
  
  var tipo = ($('#image').attr('tipo'));
  var ext = ($('#image').attr('ext'));
  var tamano = ($('#image').attr('tamano'));
  var ancho = ($('#image').attr('ancho'));
  var alto = ($('#image').attr('alto'));

  
     if ($image.data('cropper')) {
            /*
            var target2 = document.getElementById('foopropio');
            var spinner = new Spinner(opts).spin(target2);
            */

            var datoimagen = $image.cropper('getImageData');
            var datocanvas = $image.cropper('getCanvasData');
            
            var result =  $image.cropper('getCroppedCanvas'); //
            var datos =  $image.cropper('getData');

            var datocropbox =  $image.cropper('getCropBoxData');

            var croppedImageDataURL = result.toDataURL(tipo_archivo); 
            var formData = new FormData();

            formData.append('datoimagen', JSON.stringify(datoimagen));
            formData.append('datocanvas', JSON.stringify(datocanvas));

            formData.append('croppedImage', croppedImageDataURL);//
            
            formData.append('datos', JSON.stringify(datos));
            formData.append('datocropbox', JSON.stringify(datocropbox));
           

            formData.append('tipo_archivo', tipo_archivo);
            formData.append('nombre', nombre);
            formData.append('tipo', tipo);
            formData.append('ext', ext);
            formData.append('tamano', tamano);
            formData.append('ancho', ancho);
            formData.append('alto', alto);

            formData.append('ano', ano);
            formData.append('mes', mes);

            formData.append('id_session', id_session);
            formData.append('id_diseno', id_diseno);
            formData.append('id_tamano', id_tamano);
            formData.append('consecutivo', consecutivo);


            $.ajax(hash_url+'fotocalendario/guardar_imagen', {
              method: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function(data) {


                /*    
                spinner.stop();
                $('#foopropio').css('display','none');
                */

                var id_session = $('#id_session').val();
                var ano = $("#ano").val();
                var catalogo= hash_url+'fotocalendario/fotorevise/'+$.base64.encode(id_session);


                hrefPost('POST', catalogo, {
                    id_tamano   : id_edicion_tamano,
                    id_diseno   : id_edicion_diseno,
                    consecutivo : id_edicion_consecutivo,
                                 ano  : ano,
                }, ''); 
             },
              error: function () {
                console.log('Upload error');
              }
            }); 
         
     }   

}





  // OK a travez de "menu_compra" "revisa y compra" 
  $('body').on('click','.compra_menu', function (e) {   

      var id_session = $('#id_session').val();
            var ano = $("#ano").val();
            var existe = ($('#image').attr('nombre'));  



         var id_edicion_tamano      = $(this).attr('value');
         var id_edicion_diseno      = $(this).attr('diseno');
         var id_edicion_consecutivo = $(this).attr('consecutivo');


        if ( existe != undefined) { //si hay imagen para guardar
                  guardar5(id_edicion_tamano, id_edicion_diseno, id_edicion_consecutivo);

        } else { //no hay imagen para guardar

            var catalogo= hash_url+'fotocalendario/fotorevise/'+$.base64.encode(id_session);

            hrefPost('POST', catalogo, {
                    id_tamano   : $("#id_tamano").val(),
            id_diseno   : $("#id_diseno").val(),
            consecutivo : $("#consecutivo").val(),
                        ano  : $("#ano").val(),

            }, ''); 
        }
        
  }); 

  //--> OK visualizar "revisa y compra" 
  $('body').on('click','.previo_slider', function (e) {   

     var id_session = $('#id_session').val();
            var ano = $("#ano").val();
            var existe = ($('#image').attr('nombre'));  



         var id_edicion_tamano      = $(this).attr('value');
         var id_edicion_diseno      = $(this).attr('diseno');
         var id_edicion_consecutivo = $(this).attr('consecutivo');


        if ( existe != undefined) { //si hay imagen para guardar
                  guardar5(id_edicion_tamano, id_edicion_diseno, id_edicion_consecutivo);
                  
        } else { //no hay imagen para guardar

            var catalogo= hash_url+'fotocalendario/fotorevise/'+$.base64.encode(id_session);

            hrefPost('POST', catalogo, {
            id_tamano   : $(this).attr('value'),
            id_diseno   : $(this).attr('diseno'),
            consecutivo : $(this).attr('consecutivo'),
                         ano  : ano,

            }, ''); 
        }    
        
  }); 



//OK cuando editamos un diseño en las fotoImagen. Hay q evaluar si existe imagen
$('body').on('click','.editar_slider', function (e) {   
      //Este trigger fue invocado a la fuerza "para cambiar de mes"
        var id_session = $('#id_session').val();
        var existe = ($('#image').attr('nombre'));  

         var id_edicion_tamano      = $(this).attr('value');
         var id_edicion_diseno      = $(this).attr('diseno');
         var id_edicion_consecutivo = $(this).attr('consecutivo');


        if ( existe != undefined) { //si hay imagen para guardar
                  guardar4(id_edicion_tamano, id_edicion_diseno, id_edicion_consecutivo);
        } else { //no hay imagen para guardar
                    var catalogo= hash_url+'fotocalendario/fotocalendario/'+$.base64.encode(id_session);
                    hrefPost('POST', catalogo, {
                         id_edicion_tamano      : id_edicion_tamano,
                         id_edicion_diseno      : id_edicion_diseno,
                         id_edicion_consecutivo : id_edicion_consecutivo,

                    }, ''); 


        }


});


  // OK  Menu pasar a "personaliza"
  $('body').on('click','.personaliza_menu', function (e) {   

         var id_session = $('#id_session').val();
             var existe = ($('#image').attr('nombre'));  
          var id_tamano = $('#id_tamano').val();
          var id_diseno = $('#id_diseno').val();
        var consecutivo = $('#consecutivo').val();

        if ( existe != undefined) { //si hay imagen para guardar
                  guardar4(id_tamano, id_diseno, consecutivo);

        } else { //no hay imagen para guardar

                    var catalogo= hash_url+'fotocalendario/fotocalendario/'+$.base64.encode(id_session);
                    hrefPost('POST', catalogo, {
                          id_edicion_tamano      : id_tamano,
                          id_edicion_diseno      : id_diseno,
                          id_edicion_consecutivo : consecutivo,

                    }, ''); 


        }



  }); 






   var  hrefPost = function(verb, url, data, target) {
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




});  //fin de $(function () {

