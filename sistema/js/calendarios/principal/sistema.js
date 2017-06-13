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

  	
	var hash_url =  window.location.protocol+'//'+window.location.hostname+'/sistema/';  

  
    var arreglo = {};
    var arreglo_adicional = [];
    var arreglo_producto = {};

    var session = readCookie('tinbox_session'); //session activa
    var dats = unserialize(decodeURIComponent(session));
    var session_id = dats.session_id;

  //poner el ancla  
  /*
  if (window.location.hash!='#foo') {
    window.location.href = window.location.href+'#foo'; 
  }
  */
    // Ulises

    $('.diseno button').hover(function() {
      $(this).find('.ojo').css({'opacity':'1'});
    }, function() {
      $(this).find('.ojo').css({'opacity':'0'});
    });

 //new
 $('.blanco-der #tm-extra-product-options-fields').remove();

  //new OJO ESTE CREO Q NO HACE FALTA AQUI PORQUE NO HAY COLOR
  //limpia todos los radios marcados
  $(".tm-extra-product-options").each(function() {
      var elemento = $(this);
      elemento.find('input.tm-epo-field.tmcp-radio').removeAttr("checked").prop("checked",false);
  });

//new (CREO Q ESTO SOLO ERA PARA MARCAR POR DEFECTO LOS COLORES)
  //le atribuye al primer elemento radio de la modal que abre el marcado
  $('.modal').on('shown.bs.modal', function(e) {
        var id = $(this).find(".modal-content").attr('valor').toString();
        $(this).find("ul li:first-child > input.miradio").attr("checked",true).prop("checked",true);
        $(this).find('img.img-diseno').attr('src', $(this).find("ul li:first-child > input.miradio").attr('data-imagep'));

        $('#imagen_deldiseno').val($(this).find("ul li:first-child > input.miradio").attr('data-imagep'));

        //$('#imagen_deldiseno').val(field.attr('data-imagep'));        
  });
    
    //new
    //ponerle el border a lo seleccionado  
    $('body').on('click','.sel img', function (e) {              
      $(this).toggleClass('act');
          if ($(this).hasClass('act')){
              $('.notificacion').html( parseInt($('.notificacion').html())+1 );
          }else{
              $('.notificacion').html( parseInt($('.notificacion').html())-1 );
          }
    });   





//new
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////dibujar los tamaños////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////  

      $.extend({
          miobjeto:    function(obj, tipo){
              var a = '';
              $.each(obj, function(k,valor){ 
                 if (tipo=='key') {
                    a=k;
                 } else {
                    a=valor;
                 }
              });
              return a;
          }
      })



    
    //var url = hash_url+'calendarios/taxonomia_tamano'; 
        

      //dibujar los tamaños de calendario cuando presenta la modal, cuando damos click encima del producto
      $('.modal').on('shown.bs.modal', function(e) {

           var la_modal = $(this);
            var datos = $(this).find('form.variations_form').attr('data-product_variations')  ;
            
            var arreglo_variacion = [];
            //aqui se toman todos los tamaños y se guardan en un arreglo_variacion

              //se guardan todas las taxonomias en un arreglo taxonomia_tamano
             
              $.ajax({
                  url: hash_url+'calendarios/taxonomia_tamano',
                  method: "POST",
                    dataType: 'json',
                success: function(taxonomia_tamano){
                        var arreglo_taxonomia_tamano = {};
                          $.each(taxonomia_tamano, function (i, valor) {
                            $.each( valor, function( key, value ) {
                              arreglo_taxonomia_tamano[value.slug] = value;
                             }); 

                          });

                          jQuery.each(jQuery.parseJSON(datos), function (i, valor) {
                                  var variacion = {};
                                  atributos = valor.attributes; //{"attribute_pa_tipo_agenda":"tip_agenda2"}
                                  variacion['image_link'] = valor.image_link;  //supestamente era la url de la imagen, pero no se va a usar
                                  variacion['product_id'] = $(la_modal).find('.modal-content').attr('valor'); //id del producto
                                  variacion['product_nombre'] = $(la_modal).find('.modal-content').attr('nombre'); // nombre del producto "World travel"
                                  variacion['id'] = valor.variation_id;  //id del tamaño de variacion
                                  variacion['llave'] = $.miobjeto(atributos,'key'); //"attribute_pa_tamanos"
                                  variacion['valor'] = $.miobjeto(atributos,'value'); //valor del tamaño de variacion(creo q es el slug)

                                  //variacion['imagen_tamano'] =window.location.protocol+'//'+window.location.hostname+'/wp-content/uploads/'+arreglo_taxonomia_tamano[variacion['valor']].meta_value;
                                  variacion['imagen_tamano'] =arreglo_taxonomia_tamano[variacion['valor']].guid;
                                  variacion['descripcion_tamano'] =arreglo_taxonomia_tamano[variacion['valor']].name;

                                  arreglo_variacion.push( variacion);
                          });
                          //console.log(arreglo_variacion);


                          //este es quien se encarga de dibujar los tamaños
                         
                         $(la_modal).find(".variations-table .select-option.swatch-wrapper").each(function(i) {
                                //console.log(i);
                                    //var imag_prod = $(this).find('a img').attr('src').replace('-32x32', ''); 
                                    //var imag_diseno =$(this).find('a img').attr('src'); 

                                    var imag_prod = arreglo_variacion[i].imagen_tamano;
                                    var imag_diseno =arreglo_variacion[i].imagen_tamano; 
                                    
                                    var nombre_diseno =arreglo_variacion[i].product_nombre;
                                    var campo_variacion = arreglo_variacion[i].llave; //'escritorio_mini';
                                    var name_variacion = arreglo_variacion[i].valor; //'escritorio_mini';
                                    var id_diseno = arreglo_variacion[i].product_id;
                                    var variation_id = arreglo_variacion[i].id;
                                    
                                    //var descripcion_variacion=$(this).attr('data-name'); //"Escritorio mini";
                                    var descripcion_variacion = arreglo_variacion[i].descripcion_tamano;

                                    var producto_variable =''; 
                                     
                                       producto_variable = '<div class="col-md-6 col-sm-6 col-xs-6 tam">';
                                       producto_variable += '<label class="sel">';
                                       producto_variable += '<img src="'+imag_prod+'" height="100" width="100" imagen_diseno="'+imag_diseno+'"  image_link="'+arreglo_variacion[i].image_link+'" >'; 
                                       producto_variable += '<input type="checkbox" name="coleccion_variation_id[]" value="'+name_variacion+'" campo_variacion="'+campo_variacion+'" nombre_diseno="'+nombre_diseno+'" id_diseno="'+id_diseno+'" variation_id="'+variation_id+'" descripcion_variacion="'+descripcion_variacion+'"/>';
                                       producto_variable += '</label>';
                                       producto_variable += '</div>';   

                                    //le agrega a la modal todos los tamaños, es decir los dibuja                         
                                    $(la_modal).find('.variacion_producto').append( producto_variable );
                                    $(this).remove();
                          });  












                } //fin del success
              }); //fin del $.ajax




           
        


      });


/*
 esto es nuevo pero no sirve, porq este era para ocultar y mostrar nuevo en lado izquierdo
$('body').on( "mouseenter",'.variacion_producto > div > label > img',  function (e) {       
   $('img.img-interior').attr('src',$(this).attr('image_link') );  
   $('img.img-interior').parent().parent().css('display','');
   $('img.img-diseno').parent().parent().css('display','none');
});  


$('body').on( "mouseleave",'.variacion_producto > div > label > img',  function (e) {       
   $('img.img-interior').parent().parent().css('display','none');
   $('img.img-diseno').parent().parent().css('display','');
});  
*/



///////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////Actualizar "continuar, personaliza_menu y notificaciones"///////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////  


 //para cuando refresque los BOTONES "continuar, personaliza_menu y notificaciones esten actualizadas"
   
    var existencia_fijo = 'no';
    var url = hash_url+'calendarios/leer_marcados'; 
        $.ajax({
            url: url,
            method: "POST",
              dataType: 'json',
                data: {
                    datos:[],
                },

          success: function(todos){
            
            $('.notificacion').html(todos.total_disenos);
              
              $('.agregar_cancelar').prop('disabled', true);     

              if (todos.existencia) { //si hay guardados
                  $('.continuar').prop('disabled', false); 
                  $('.personaliza_menu').prop('disabled', false); 
                  existencia_fijo = 'si';            
              } else {
                $('.continuar').prop('disabled', true);
                $('.personaliza_menu').prop('disabled', true); 
              }

          } 
        });

    //Cuando cancela la "ELIMINACION DE UN TAMAÑO" 
    $('body').on('click','input[name="coleccion_variation_id[]"]', function (e) {     

            if (existencia_fijo !='si') {  //sino hay existencias 
                 
                 var marcado = 'no';
                 
                 $("input[name='coleccion_variation_id[]']:checked").each(function() { 
                    marcado = 'si';  //si hay elementos seleccionados
                 }); 

                 if (marcado=='si') {
                    $('.agregar_cancelar').prop('disabled', false); 
                    $('.continuar').prop('disabled', false);            
                    $('.personaliza_menu').prop('disabled', false); 
                 } else {
                    $('.agregar_cancelar').prop('disabled', true); 
                    $('.continuar').prop('disabled', true);            
                    $('.personaliza_menu').prop('disabled', true); 

                 }
            } else {

                 var marcado = 'no';
                 
                 $("input[name='coleccion_variation_id[]']:checked").each(function() { 
                    marcado = 'si';  //si hay elementos seleccionados
                 }); 

                    $('.continuar').prop('disabled', false);            
                    $('.personaliza_menu').prop('disabled', false); 

                if (marcado=='si') {
                    $('.agregar_cancelar').prop('disabled', false); 
                 } else {
                     $('.agregar_cancelar').prop('disabled', true); 
                } 
            }
              

    }  );



       







//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////Agregar a otro diseño de fotocalendario///////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

   $('body').on('click','.agregar_cancelar', function (e) {        
           //Nombre del producto o Modelo, id y cantidad
           var id = $(this).attr('value').toString();
           arreglo_producto['modelo'] = $(".modal-content[valor='"+id+"'] p.nombre").text();
           arreglo_producto['imagen_diseno'] = $(".modal-content[valor='"+id+"'] img.img-diseno").attr('src');
           arreglo_producto['product_id'] = $(".modal-content[valor='"+id+"'] input[name='tc-add-to-cart']").val();
           arreglo_producto['id_session'] = session_id;

            //todos los tamaños seleccionados
            var listCheck = []; 
            $("input[name='coleccion_variation_id[]']:checked").each(function() { 
               var objeto = {  
                          
                           //id_diseno: $(this).attr('id_diseno'),
                       nombre_diseno: $(this).attr('nombre_diseno'),
                       nombre_variacion: $(this).val(),
                       campo_variacion : $(this).attr('campo_variacion'),                   

                  descripcion_variacion: $(this).attr('descripcion_variacion'),                   
                           variation_id: $(this).attr('variation_id'),
                       imagen_variacion: $(this).siblings(".act" ).attr('src'), 
                       //imagen_diseno: $(this).siblings(".act" ).attr('imagen_diseno'),                        

                      };
               listCheck.push(objeto);
              });   

            arreglo_producto['variaciones_producto'] =listCheck;

  

          //este es para guardar todos los parametros
          var url = hash_url+'calendarios/guardar_tamanos'; //guardar_info'; 
          $.ajax({
                  url: url,
                 type: 'POST',
             dataType: 'json',
                 data: {
                      prod : arreglo_producto,
                 },
            success: function(todos){
                arreglo_producto = {};     
                 
                 if (todos.resultado) {
                        var catalogo= hash_url+'calendarios/fotocalendario/'+$.base64.encode(session_id);
                    //provocar evento de cerrar ventana
                    $('.modal_prod').modal("hide"); 
                  }
                 
            }
          }); 

         
         arreglo_producto = {};
    });  



    $('.modal_prod').on('hide.bs.modal', function(e) {

         $('input[name="coleccion_variation_id[]"]').prop('checked', false);
         $('.sel img').removeClass('act');

        $('.continuar').prop('disabled', true);            
        $('.agregar_cancelar').prop('disabled', true);            

          var existencia_fijo = 'no';
          var url = hash_url+'calendarios/leer_marcados'; 
              $.ajax({
                  url: url,
                  method: "POST",
                    dataType: 'json',
                      data: {
                          datos:[],
                      },

                success: function(todos){
                  
                  $('.notificacion').html(todos.total_disenos);
                    

                    if (todos.existencia) { //si hay guardados
                        $('.continuar').prop('disabled', false); 
                        $('.personaliza_menu').prop('disabled', false); 
                        //$('.agregar_cancelar').prop('disabled', false);            
                        existencia_fijo = 'si';            
                    } else {
                      $('.continuar').prop('disabled', true);
                      $('.personaliza_menu').prop('disabled', true); 
                      //$('.agregar_cancelar').prop('disabled', true);            
                    }

                } 
              });

              $(this).removeData('show');
    }); 






      












    // fin de Ulises

   

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////para ir al formulario/////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 




//menu "2-Personaliza"
 $('body').on('click','.personaliza_menu', function (e) {   
                      var catalogo= hash_url+'calendarios/fotocalendario/'+$.base64.encode(session_id);
                      window.location.href = catalogo; 
 }); 




///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////Continuar////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////  

 $('body').on('click','.continuar', function (e) {        
           //Nombre del producto o Modelo, id y cantidad
           var id = $(this).attr('value').toString();
           arreglo_producto['modelo'] = $(".modal-content[valor='"+id+"'] p.nombre").text();
           arreglo_producto['imagen_diseno'] = $(".modal-content[valor='"+id+"'] img.img-diseno").attr('src');
           arreglo_producto['product_id'] = $(".modal-content[valor='"+id+"'] input[name='tc-add-to-cart']").val();
           arreglo_producto['id_session'] = session_id;

            //todos los tamaños seleccionados
            var listCheck = []; 
            $("input[name='coleccion_variation_id[]']:checked").each(function() { 
               var objeto = {  
                          
                           //id_diseno: $(this).attr('id_diseno'),
                       nombre_diseno: $(this).attr('nombre_diseno'),
                       nombre_variacion: $(this).val(),
                       campo_variacion : $(this).attr('campo_variacion'),                   
                  descripcion_variacion: $(this).attr('descripcion_variacion'),                   
                           variation_id: $(this).attr('variation_id'),
                       imagen_variacion: $(this).siblings(".act" ).attr('src'), 
                       //imagen_diseno: $(this).siblings(".act" ).attr('imagen_diseno'),                        

                      };
               listCheck.push(objeto);
              });   

            arreglo_producto['variaciones_producto'] =listCheck;

        if  ( $('.agregar_cancelar').prop('disabled') != false ) {

                      var catalogo= hash_url+'calendarios/fotocalendario/'+$.base64.encode(session_id);
                      //var catalogo= hash_url+'libretas/fotocalendario/'+session_id;
                      window.location.href = catalogo; 
        } else  {


              //este es para guardar todos los parametros y continuar al formulario
              var url = hash_url+'calendarios/guardar_tamanos'; 
              $.ajax({
                      url: url,
                     type: 'POST',
                 dataType: 'json',
                     data: {
                          prod : arreglo_producto,
                     },
                success: function(todos){
                    arreglo_producto = {};     
                    if (todos.resultado) {
                          var catalogo= hash_url+'calendarios/fotocalendario/'+$.base64.encode(session_id);
                          window.location.href = catalogo; 
                    }                         
                }
              }); 


        }  
        
         arreglo_producto = {};
    });  



 function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  }


  function unserialize(data) {
  
  var that = this,
    utf8Overhead = function(chr) {
      // http://phpjs.org/functions/unserialize:571#comment_95906
      var code = chr.charCodeAt(0);
      if (  code < 0x0080 
            || 0x00A0 <= code && code <= 0x00FF 
            || [338,339,352,353,376,402,8211,8212,8216,8217,8218,8220,8221,8222,8224,8225,8226,8230,8240,8364,8482].indexOf(code)!=-1) 
      {
        return 0;
      }
      if (code < 0x0800) {
        return 1;
      }
      return 2;
    };
  error = function(type, msg, filename, line) {
    throw new that.window[type](msg, filename, line);
  };
  read_until = function(data, offset, stopchr) {
    var i = 2,
      buf = [],
      chr = data.slice(offset, offset + 1);

    while (chr != stopchr) {
      if ((i + offset) > data.length) {
        error('Error', 'Invalid');
      }
      buf.push(chr);
      chr = data.slice(offset + (i - 1), offset + i);
      i += 1;
    }
    return [buf.length, buf.join('')];
  };
  read_chrs = function(data, offset, length) {
    var i, chr, buf;

    buf = [];
    for (i = 0; i < length; i++) {
      chr = data.slice(offset + (i - 1), offset + i);
      buf.push(chr);
      length -= utf8Overhead(chr);
    }
    return [buf.length, buf.join('')];
  };
  _unserialize = function(data, offset) {
    var dtype, dataoffset, keyandchrs, keys, contig,
      length, array, readdata, readData, ccount,
      stringlength, i, key, kprops, kchrs, vprops,
      vchrs, value, chrs = 0,
      typeconvert = function(x) {
        return x;
      };

    if (!offset) {
      offset = 0;
    }
    dtype = (data.slice(offset, offset + 1))
      .toLowerCase();

    dataoffset = offset + 2;

    switch (dtype) {
    case 'i':
      typeconvert = function(x) {
        return parseInt(x, 10);
      };
      readData = read_until(data, dataoffset, ';');
      chrs = readData[0];
      readdata = readData[1];
      dataoffset += chrs + 1;
      break;
    case 'b':
      typeconvert = function(x) {
        return parseInt(x, 10) !== 0;
      };
      readData = read_until(data, dataoffset, ';');
      chrs = readData[0];
      readdata = readData[1];
      dataoffset += chrs + 1;
      break;
    case 'd':
      typeconvert = function(x) {
        return parseFloat(x);
      };
      readData = read_until(data, dataoffset, ';');
      chrs = readData[0];
      readdata = readData[1];
      dataoffset += chrs + 1;
      break;
    case 'n':
      readdata = null;
      break;
    case 's':
      ccount = read_until(data, dataoffset, ':');
      chrs = ccount[0];
      stringlength = ccount[1];
      dataoffset += chrs + 2;

      readData = read_chrs(data, dataoffset + 1, parseInt(stringlength, 10));
      chrs = readData[0];
      readdata = readData[1];
      dataoffset += chrs + 2;
      if (chrs != parseInt(stringlength, 10) && chrs != readdata.length) {
        error('SyntaxError', 'String length mismatch');
      }
      break;
    case 'a':
      readdata = {};

      keyandchrs = read_until(data, dataoffset, ':');
      chrs = keyandchrs[0];
      keys = keyandchrs[1];
      dataoffset += chrs + 2;

      length = parseInt(keys, 10);
      contig = true;

      for (i = 0; i < length; i++) {
        kprops = _unserialize(data, dataoffset);
        kchrs = kprops[1];
        key = kprops[2];
        dataoffset += kchrs;

        vprops = _unserialize(data, dataoffset);
        vchrs = vprops[1];
        value = vprops[2];
        dataoffset += vchrs;

        if (key !== i)
          contig = false;

        readdata[key] = value;
      }

      if (contig) {
        array = new Array(length);
        for (i = 0; i < length; i++)
          array[i] = readdata[i];
        readdata = array;
      }

      dataoffset += 1;
      break;
    default:
      error('SyntaxError', 'Unknown / Unhandled data type(s): ' + dtype);
      break;
    }
    return [dtype, dataoffset - offset, typeconvert(readdata)];
  };

  return _unserialize((data + ''), 0)[2];
}


  
  
  spinner.stop();
  $('#foopropio').css('display','none');

  $('#foopropio').fadeOut('slow', function() {
    // Animation complete
    //$(this).css('display','block');
  });


});
