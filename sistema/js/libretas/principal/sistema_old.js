

/*
//$(".tm-extra-product-options input.miradio").each(function() {
$(".tm-extra-product-options").each(function() {
        var id = $(this).attr('id').toString();
        console.log(id );
        var this = $(this);
        this.find('input.miradio').prop('checked', false);
        //quitar las variaciones marcadas
        //$(".variations-table .select-option.swatch-wrapper.selected").removeClass("selected");
        //quitar los adicionales marcados
        //$(this).prop('checked', false);
        console.log( this.find('input.miradio').prop('checked') );

});

*/

$(".tm-extra-product-options").each(function() {
    //radio_checked   = element.find("input.tm-epo-field.tmcp-radio:checked");
    var elemento = $(this);
    elemento.find('input.tm-epo-field.tmcp-radio').removeAttr("checked").prop("checked",false);
    //elemento.find('input.tm-epo-field.tmcp-radio').attr("checked",true).prop("checked",true);
    /*
    elemento.find('input.tm-epo-field.tmcp-radio').each(function(e) {  //:checked
         //$(e).find('input.miradio').prop('checked','false'); 
         $(e).removeAttr("checked").prop("checked",false);
       //console.log($(this));
    });*/
  
});

  $('.modal').on('shown.bs.modal', function(e) {
        var id = $(this).find(".modal-content").attr('valor').toString();
        console.log($(this).find(".tm-extra-product-options input.miradio:first-child").attr('data-imagep'));
        
        console.log('-----');
        console.log($(this).find("ul li:first-child > input.miradio").attr('data-imagep'));
        $(this).find("ul li:first-child > input.miradio").attr("checked",true).prop("checked",true);
        
        $(this).find('img.img-diseno').attr('src', $(this).find("ul li:first-child > input.miradio").attr('data-imagep'));

        
        //$(this).find(".tm-extra-product-options input.miradio:first-child ~ label img.checkbox_imag").css('border', 'solid 5px #75cacf');  
        
        /*
        console.log($(this).find(".tm-extra-product-options input.miradio[checked='checked']").attr('data-imagep'));

        $(this).find('img.img-diseno').attr('src',  $(this).find(".tm-extra-product-options input.miradio[checked='checked']").attr('data-imagep') );

        $(this).find(".tm-extra-product-options input.miradio[checked='checked'] ~ label img.checkbox_imag").css('border', 'solid 5px #75cacf');  
        $(this).find(".tm-extra-product-options input.miradio[checked='checked'] ~ label img").addClass('checkbox_imag');  
        $(this).find(".tm-extra-product-options input.miradio[checked='checked'] ~ label img").addClass('checkbox_imag');  
        */

        //var elemento = $(this);
        //elemento.find('input.tm-epo-field.tmcp-radio').removeAttr("checked").prop("checked",false);
        //elemento.find('input.tm-epo-field.tmcp-radio').attr("checked",true).prop("checked",true);


        //console.log($(this).find(".tm-extra-product-options input.miradio:checked").attr('data-imagep'));
        //$("#tm-extra-product-options[data-product-id='"+id+"']").clone().appendTo(".adicional"+id); 
        //$(this).find(".modal-content .adicional"+id+" #tm-epo-field-1").remove();

  });







$(document).ready(function() {    
    
    var hash_url =  window.location.protocol+'//'+window.location.hostname+'/sistema/';  
    var arreglo = {};
    var arreglo_adicional = [];
    var arreglo_producto = {};

//aqui la session

  /*
      var listCheck = []; 
*/

      var session = readCookie('tinbox_session'); //session activa
      var dats = unserialize(decodeURIComponent(session));
      var session_id = dats.session_id;








  $('.diseno button').hover(function() {
      $(this).find('.ojo').css({'opacity':'1'});
    }, function() {
      $(this).find('.ojo').css({'opacity':'0'});
    });




///////////////////////////////////fin de construccion de adicionales/////////////////////////////

/*
<div data-epo-id="1" data-cart-id="main" data-product-id="1248" class="tc-extra-product-options tm-extra-product-options tm-custom-prices tm-product-id-1248 tm-cart-main tc-show" id="tm-extra-product-options" style="opacity: 1;">

    <div class="tm-extra-product-options-inner">
      <ul id="tm-extra-product-options-fields" class="tm-extra-product-options-fields">                            

      </ul>

    </div>  

</div>  
*/


  $('.colores #tm-epo-field-0').remove();
  $('.blanco-der #tm-epo-field-1').remove();



//$(".modal-content[valor='"+id+"'] p.nombre").text();
/*
each(function() {
               arreglo_producto[$(this).parent().attr('id')] = $(this).attr('data-name');
               arreglo_producto['img_'+$(this).parent().attr('id')] = $(this).find('a img').attr('src');
           });    
*/
/*
$(".modal-content").each(function() {
           var id = $(this).attr('valor').toString();
           console.log(id);
           console.log('--------');

           $("#tm-extra-product-options[data-product-id='"+id+"']").clone().appendTo(".adicional"+id); 

           //<div valor="1248" class="modal-content">

           //arreglo_producto['modelo'] = $(".modal-content[valor='"+id+"'] p.nombre").text();
});    
*/



$(".tm-extra-product-options").each(function() {
           var id = $(this).attr('id').toString();
           var prod_id = $(this).attr('data-product-id').toString();

           var prod_id = $(this).attr('data-product-id')
           
           //$(this).attr('id',id)
  /*
           console.log(id);
           console.log('--------');
           console.log(prod_id);
           console.log('--------');
*/
  /*

           $(this).attr('id', id+prod_id);
           $(this).attr('data-epo-id', prod_id);

           //$(this).find('ul').attr('id');
           console.log($(this).find('ul').attr('id'));
           console.log('--------');

           $(this).find('ul').attr('id',$(this).find('ul').attr('id')+prod_id);

           $(this).find('ul li[id="tm-epo-field-0"]').attr('id',$(this).find('ul li[id="tm-epo-field-0"]').attr('id')+prod_id);
           $(this).find('ul li[id="tm-epo-field-1"]').attr('id',$(this).find('ul li[id="tm-epo-field-1"]').attr('id')+prod_id);

*/
           //$(this).find('ul li input').attr('id',$(this).find('ul li input').attr('id')+prod_id);
           



});    



  $('.modal').on('shown.bs.modal', function(e) {
        var id = $(this).find(".modal-content").attr('valor').toString();
        console.log($(this).find(".tm-extra-product-options input.miradio[checked='checked']").attr('data-imagep')    );

        //$(this).find(".tm-extra-product-options input.miradio[checked='checked'] ~ label img").css('border', 'solid 5px #75cacf');  

        $(this).find('img.img-diseno').attr('src',  $(this).find(".tm-extra-product-options input.miradio[checked='checked']").attr('data-imagep') );

        //console.log($(this).find(".tm-extra-product-options input.miradio:checked").attr('data-imagep'));
        //$("#tm-extra-product-options[data-product-id='"+id+"']").clone().appendTo(".adicional"+id); 
        //$(this).find(".modal-content .adicional"+id+" #tm-epo-field-1").remove();

  });






//$(".tm-extra-product-options input.miradio:checked")

//$(".tm-extra-product-options input.adicionales_image:checked")

   /*
    x=$("#tm-extra-product-options");
    console.log(x);
    x.remove();
    console.log(x);
    */

  

///////////////////////////////////fin de construccion de adicionales/////////////////////////////

















    $(".continuar").click(function(e) {

           //Nombre del producto o Modelo, id y cantidad
           
           var id = $(this).attr('value').toString();
           arreglo_producto['modelo'] = $(".modal-content[valor='"+id+"'] p.nombre").text();
           arreglo_producto['imagen_diseno'] = $(".modal-content[valor='"+id+"'] img.img-diseno").attr('src');

           
           arreglo_producto['product_id'] = $(".modal-content[valor='"+id+"'] input[name='tc-add-to-cart']").val();
           arreglo_producto['cantidad'] = $(".modal-content[valor='"+id+"'] input[name='tm-epo-counter']").val();

           //numero de la variacion
           arreglo_producto['variation_id'] = $(".modal-content[valor='"+id+"'] input[name='variation_id']").val();
          
           //variaciones
           $(".variations-table .select-option.swatch-wrapper.selected").each(function() {
               arreglo_producto[$(this).parent().attr('id')] = $(this).attr('data-name');
               arreglo_producto['img_'+$(this).parent().attr('id')] = $(this).find('a img').attr('src');
           });    

           arreglo_producto['descripcion_adicionales'] = '';
          //ADICIONALES(separadores)
          $(".tm-extra-product-options input.adicionales_image:checked").each(function(e) {

            
                                      var arreglo = {};
                                  arreglo["mode"] = "builder";
                              arreglo["cssclass"] = "adicionales_image";
                              //ver cual es el name
                                  arreglo["name"] = $(this).parent().parent().parent().parent().find('label.tm-epo-field-label').text();
                                 arreglo["value"] = $(".tm-extra-product-options input.use_images:checked[value="+$(this).val()+"] + label .checkbox_image_label").text();
                                   arreglo["key"] = $(this).val();
                                arreglo["images"] = $(".tm-extra-product-options input.use_images:checked[value="+$(this).val()+"] + label .checkbox_image").attr('src');
                               arreglo["section"] = $(this).parent().parent().parent().parent().attr('data-uniqid');
                                 arreglo["price"] = ($(this).attr('data-rules')).replace(/[\[\]\\\"]/g,'');
                         arreglo["section_label"] = $(this).parent().parent().parent().parent().find('label.tm-epo-field-label').text();
                              arreglo["quantity"] = 1;
                              arreglo["multiple"] = 1;
                    arreglo["price_per_currency"] = {"MXN":($(this).attr('data-rules')).replace(/[\[\]\\\"]/g,'')}; // arreglo["precio"];
                   arreglo["percentcurrenttotal"] = 0;
                            arreglo["currencies"] = "[]";
                            arreglo["use_images"] = "images";
                 arreglo["changes_product_image"] = "custom";
                               arreglo["imagesp"] = "";
                             //arreglo_adicional[e] = arreglo;
                             arreglo_adicional.push( arreglo);

                             //solo para tomar la descripcion de los adicionales
                             arreglo_producto['descripcion_adicionales'] += arreglo["value"]+' ';



          }); 


          //colores
          $(".tm-extra-product-options input.miradio:checked").each(function() {
                                      var arreglo = {};
                                  arreglo["mode"] = "builder";
                              arreglo["cssclass"] = "miradio";
                              //ver cual es el name
                                  arreglo["name"] = 'Colores '+$(this).parent().parent().parent().parent().find('label.tm-epo-field-label').text();
                                 arreglo["value"] = $(".tm-extra-product-options input.use_images:checked[value="+$(this).val()+"] + label .radio_image_label").text();
                                   arreglo["key"] = $(this).val();
                                arreglo["images"] = $(".tm-extra-product-options input.use_images:checked[value="+$(this).val()+"] + label .radio_image").attr('src');
                               arreglo["section"] = $(this).parent().parent().parent().parent().attr('data-uniqid');
                                 arreglo["price"] = ($(this).attr('data-rules')).replace(/[\[\]\\\"]/g,'');
                         arreglo["section_label"] = 'Colores '+$(this).parent().parent().parent().parent().find('label.tm-epo-field-label').text();
                              arreglo["quantity"] = 1;
                              arreglo["multiple"] = 1;
                    arreglo["price_per_currency"] = {"MXN":($(this).attr('data-rules')).replace(/[\[\]\\\"]/g,'')}; // arreglo["precio"];
                   arreglo["percentcurrenttotal"] = 0;
                            arreglo["currencies"] = "[]";
                            arreglo["use_images"] = "images";
                 arreglo["changes_product_image"] = "custom";
                               arreglo["imagesp"] = "";
                             
                             arreglo_adicional.push( arreglo);

                             //solo para tomar la descripcion del color y guardarlo como un campo separado
                             arreglo_producto['descripcion_color'] = arreglo["value"];

                             

          });    

          //este es para guardar todos los parametros
  
          var url = hash_url+'libretas/guardar_info'; 
          $.ajax({
                  url: url,
                 type: 'POST',
             dataType: 'json',
                 data: {
                     datos : arreglo_adicional,
                      prod : arreglo_producto,
                 },
            success: function(todos){
                console.log(todos);
                
                arreglo_adicional = [];
                arreglo_producto = {};     

                 if (todos.resultado) {
                      var catalogo= hash_url+'libretas/fotocalendario/'+$.base64.encode(session_id);
                      //var catalogo= hash_url+'libretas/fotocalendario/'+session_id;
                      window.location.href = catalogo; 
                  }                   


            }

          }); 

           arreglo_adicional = [];
           arreglo_producto = {};




    });  //fin el $(".continuar").click






//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////para mostrar la notificacion/////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 


   //$(".continuar").click(function(e) {
   $('body').on('click','.agregar_cancelar', function (e) {        
           //Nombre del producto o Modelo, id y cantidad
    
           var id = $(this).attr('value').toString();
           arreglo_producto['modelo'] = $(".modal-content[valor='"+id+"'] p.nombre").text();
           arreglo_producto['imagen_diseno'] = $(".modal-content[valor='"+id+"'] img.img-diseno").attr('src');

           
           arreglo_producto['product_id'] = $(".modal-content[valor='"+id+"'] input[name='tc-add-to-cart']").val();
           arreglo_producto['cantidad'] = $(".modal-content[valor='"+id+"'] input[name='tm-epo-counter']").val();

           //numero de la variacion
           arreglo_producto['variation_id'] = $(".modal-content[valor='"+id+"'] input[name='variation_id']").val();
       

           //variaciones
           $(".variations-table .select-option.swatch-wrapper.selected").each(function() {
               arreglo_producto[$(this).parent().attr('id')] = $(this).attr('data-name');
               arreglo_producto['img_'+$(this).parent().attr('id')] = $(this).find('a img').attr('src');
           });    

           arreglo_producto['descripcion_adicionales'] = '';
          //ADICIONALES(separadores)
          $(".tm-extra-product-options input.adicionales_image:checked").each(function(e) {

            
                                      var arreglo = {};
                                  arreglo["mode"] = "builder";
                              arreglo["cssclass"] = "adicionales_image";
                              //ver cual es el name
                                  arreglo["name"] = $(this).parent().parent().parent().parent().find('label.tm-epo-field-label').text();
                                 arreglo["value"] = $(".tm-extra-product-options input.use_images:checked[value="+$(this).val()+"] + label .checkbox_image_label").text();
                                   arreglo["key"] = $(this).val();
                                arreglo["images"] = $(".tm-extra-product-options input.use_images:checked[value="+$(this).val()+"] + label .checkbox_image").attr('src');
                               arreglo["section"] = $(this).parent().parent().parent().parent().attr('data-uniqid');
                                 arreglo["price"] = ($(this).attr('data-rules')).replace(/[\[\]\\\"]/g,'');
                         arreglo["section_label"] = $(this).parent().parent().parent().parent().find('label.tm-epo-field-label').text();
                              arreglo["quantity"] = 1;
                              arreglo["multiple"] = 1;
                    arreglo["price_per_currency"] = {"MXN":($(this).attr('data-rules')).replace(/[\[\]\\\"]/g,'')}; // arreglo["precio"];
                   arreglo["percentcurrenttotal"] = 0;
                            arreglo["currencies"] = "[]";
                            arreglo["use_images"] = "images";
                 arreglo["changes_product_image"] = "custom";
                               arreglo["imagesp"] = "";
                             //arreglo_adicional[e] = arreglo;
                             arreglo_adicional.push( arreglo);

                             //solo para tomar la descripcion de los adicionales
                             arreglo_producto['descripcion_adicionales'] += arreglo["value"]+' ';



          }); 


          //colores
          $(".tm-extra-product-options input.miradio:checked").each(function() {
                                      var arreglo = {};
                                  arreglo["mode"] = "builder";
                              arreglo["cssclass"] = "miradio";
                              //ver cual es el name
                                  arreglo["name"] = 'Colores '+$(this).parent().parent().parent().parent().find('label.tm-epo-field-label').text();
                                 arreglo["value"] = $(".tm-extra-product-options input.use_images:checked[value="+$(this).val()+"] + label .radio_image_label").text();
                                   arreglo["key"] = $(this).val();
                                arreglo["images"] = $(".tm-extra-product-options input.use_images:checked[value="+$(this).val()+"] + label .checkbox_image").attr('src');
                               arreglo["section"] = $(this).parent().parent().parent().parent().attr('data-uniqid');
                                 arreglo["price"] = ($(this).attr('data-rules')).replace(/[\[\]\\\"]/g,'');
                         arreglo["section_label"] = 'Colores '+$(this).parent().parent().parent().parent().find('label.tm-epo-field-label').text();
                              arreglo["quantity"] = 1;
                              arreglo["multiple"] = 1;
                    arreglo["price_per_currency"] = {"MXN":($(this).attr('data-rules')).replace(/[\[\]\\\"]/g,'')}; // arreglo["precio"];
                   arreglo["percentcurrenttotal"] = 0;
                            arreglo["currencies"] = "[]";
                            arreglo["use_images"] = "images";
                 arreglo["changes_product_image"] = "custom";
                               arreglo["imagesp"] = "";
                             
                             arreglo_adicional.push( arreglo);

                             //solo para tomar la descripcion del color y guardarlo como un campo separado
                             arreglo_producto['descripcion_color'] = arreglo["value"];

                             

          });    

          //este es para guardar todos los parametros
  
          var url = hash_url+'libretas/guardar_info'; 
          $.ajax({
                  url: url,
                 type: 'POST',
             dataType: 'json',
                 data: {
                     datos : arreglo_adicional,
                      prod : arreglo_producto,
                 },
            success: function(todos){
                console.log(todos);
                
                arreglo_adicional = [];
                arreglo_producto = {};     

                 if (todos.resultado) {
                    var catalogo= hash_url+'libretas/fotocalendario/'+$.base64.encode(session_id);
                    //provocar evento de cerrar ventana
                    $('.modal_prod').modal("hide"); 
                  }   


            }

          }); 

           arreglo_adicional = [];
           arreglo_producto = {};




    });  //fin el $(".continuar").click


    $('.modal_prod').on('hide.bs.modal', function(e) {


        //quitar las variaciones marcadas
        $(".variations-table .select-option.swatch-wrapper.selected").removeClass("selected");
        //quitar los adicionales marcados
        $(".tm-extra-product-options input.adicionales_image:checked").prop('checked', false);

        $('.continuar').prop('disabled', true);            
        $('.agregar_cancelar').prop('disabled', true);            

                    var existencia_fijo = 'no';
                    var url = hash_url+'libretas/leer_marcados'; 
                        $.ajax({
                            url: url,
                            method: "POST",
                              dataType: 'json',
                                data: {
                                    datos:[],
                                },

                          success: function(todos){

                              $('.notificacion').html(todos.total_disenos);

                              $.each(todos.valores, function (i, valor) { 
                                    $('input[name="coleccion_id_tamano[]"][id_diseno='+valor.id_diseno+'][id_tamano='+valor.id_tamano+']').prop('checked', 'checked');  

                                     //poner la clase .act a la imagen activa cuando refresque 
                                    $('input[name="coleccion_id_tamano[]"][id_diseno='+valor.id_diseno+'][id_tamano='+valor.id_tamano+']').siblings('.sel img').addClass('act');

                              });

                              
                              if (todos.existencia) {
                                  $('.continuar').prop('disabled', false); 
                                  $('.personaliza_menu').prop('disabled', false); 
                                  $('.agregar_cancelar').prop('disabled', false); 

                                             
                              } else {
                                $('.continuar').prop('disabled', true);
                                $('.personaliza_menu').prop('disabled', true); 
                                $('.agregar_cancelar').prop('disabled', true); 
                              }

                              if (todos.existencia_fijo) {
                                  existencia_fijo = 'si';
                              }


                          } 
                        });






        $(this).removeData('show');
    }); 


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////para mostrar la notificacion/////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

 //para cuando refresque muestre las notificaciones

    var existencia_fijo = 'no';
    var url = hash_url+'libretas/leer_marcados'; 
        $.ajax({
            url: url,
            method: "POST",
              dataType: 'json',
                data: {
                    datos:[],
                },

          success: function(todos){

              
              $('.notificacion').html(todos.total_disenos);

              $.each(todos.valores, function (i, valor) { 
                    $('input[name="coleccion_id_tamano[]"][id_diseno='+valor.id_diseno+'][id_tamano='+valor.id_tamano+']').prop('checked', 'checked');  

                     //poner la clase .act a la imagen activa cuando refresque 
                    $('input[name="coleccion_id_tamano[]"][id_diseno='+valor.id_diseno+'][id_tamano='+valor.id_tamano+']').siblings('.sel img').addClass('act');

              });

              
              if (todos.existencia) {
                  $('.continuar').prop('disabled', false); 
                  $('.personaliza_menu').prop('disabled', false); 
                  $('.agregar_cancelar').prop('disabled', false); 

                             
              } else {
                $('.continuar').prop('disabled', true);
                $('.personaliza_menu').prop('disabled', true); 
                $('.agregar_cancelar').prop('disabled', true); 
              }

              if (todos.existencia_fijo) {
                  existencia_fijo = 'si';
              }


          } 
        });




//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////para ir al formulario/////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 




//menu "2-Personaliza"
 $('body').on('click','.personaliza_menu', function (e) {   
                      var catalogo= hash_url+'libretas/fotocalendario/'+$.base64.encode(session_id);
                      window.location.href = catalogo; 
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




});

