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

  $('body').fadeIn('slow', function() { // Animation complete
    $(this).css( 'visibility', 'visible');
  });

$(document).ready(function() {    
    
    var hash_url =  window.location.protocol+'//'+window.location.hostname+'/sistema/';  
    var arreglo = {};
    var arreglo_adicional = [];
    var arreglo_producto = {};

//aqui la session



      var session = readCookie('tinbox_session'); //session activa
      var dats = unserialize(decodeURIComponent(session));
      var session_id = dats.session_id;



 $('body').on('change','#id_cat_seleccion', function (e) {   
          var cat_sel = $('#id_cat_seleccion').val();
          var catalogo= hash_url+'libreta_corporativa/'+cat_sel;
          window.location.href = catalogo; 
 }); 



  $('.diseno button').hover(function() {
      $(this).find('.ojo').css({'opacity':'1'});
    }, function() {
      $(this).find('.ojo').css({'opacity':'0'});
    });




///////////////////////////////////fin de construccion de adicionales/////////////////////////////



  $('.colores #tm-epo-field-0').remove();
  $('.blanco-der #tm-epo-field-1').remove();

  //limpia todos los radios marcados
  $(".tm-extra-product-options").each(function() {
      var elemento = $(this);
      elemento.find('input.tm-epo-field.tmcp-radio').removeAttr("checked").prop("checked",false);
  });

  //le atribuye al primer elemento radio de la modal que abre el marcado
  $('.modal').on('shown.bs.modal', function(e) {
        var id = $(this).find(".modal-content").attr('valor').toString();
        $(this).find("ul li:first-child > input.miradio").attr("checked",true).prop("checked",true);
        $(this).find('img.img-diseno').attr('src', $(this).find("ul li:first-child > input.miradio").attr('data-imagep'));
  });


///////////////////////////////////fin de construccion de adicionales/////////////////////////////


    //$(".continuar").click(function(e) {
    $('body').on('click','.continuar', function (e) {          

           //Nombre del producto o Modelo, id y cantidad
           
           var id = $(this).attr('value').toString();
           arreglo_producto['modelo'] = $(".modal-content[valor='"+id+"'] p.nombre").text();
           arreglo_producto['imagen_diseno'] = $(".modal-content[valor='"+id+"'] img.img-diseno").attr('src');

           
           arreglo_producto['product_id'] = $(".modal-content[valor='"+id+"'] input[name='tc-add-to-cart']").val();
           arreglo_producto['cantidad'] = $(".modal-content[valor='"+id+"'] input[name='tm-epo-counter']").val();

           //numero de la variacion
           arreglo_producto['variation_id'] = $(".modal-content[valor='"+id+"'] input[name='variation_id']").val();
           arreglo_producto['logos'] = $(".modal-content[valor='"+id+"'] span.logos").text();
           arreglo_producto['longitud_nombre'] = $(".modal-content[valor='"+id+"'] span.longitud_nombre").text();
           arreglo_producto['longitud_texto'] = $(".modal-content[valor='"+id+"'] span.longitud_texto").text();
           
           //arreglo_producto['image_link'] = $(this).siblings(".act" ).attr('image_link');
       
            //para tomar la image_link
            ciclo = JSON.parse( $("form.variations_form.cart.swatches[data-product_id='"+arreglo_producto['product_id']+"']").attr('data-product_variations') );
            $.each(ciclo, function (i, valor) { 
              if (valor.variation_id==arreglo_producto['variation_id']) {
                        
                        if (valor.image_link) {
                              arreglo_producto['image_link'] =valor.image_link;
                        } else {
                              arreglo_producto['image_link'] ='';
                        }
              }
            });
           
          
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
                                 arreglo["value"] = $(".tm-extra-product-options input.use_images:checked[value='"+$(this).val()+"'] + label .checkbox_image_label").text();
                                   arreglo["key"] = $(this).val();
                                arreglo["images"] = $(".tm-extra-product-options input.use_images:checked[value='"+$(this).val()+"'] + label .checkbox_image").attr('src');
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
                                 arreglo["value"] = $(".tm-extra-product-options input.use_images:checked[value='"+$(this).val()+"'] + label .radio_image_label").text();
                                   arreglo["key"] = $(this).val();
                                arreglo["images"] = $(".tm-extra-product-options input.use_images:checked[value='"+$(this).val()+"'] + label .radio_image").attr('src');
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

        if  ( $('.agregar_cancelar').prop('disabled') != false ) {
                      var catalogo= hash_url+'libreta_corporativa/fotocalendario/'+$.base64.encode(session_id);
                      window.location.href = catalogo; 
        } else  {
                var url = hash_url+'libreta_corporativa/guardar_info'; 
                $.ajax({
                        url: url,
                       type: 'POST',
                   dataType: 'json',
                       data: {
                           datos : arreglo_adicional,
                            prod : arreglo_producto,
                       },
                  success: function(todos){
                      //console.log(todos);
                      arreglo_adicional = [];
                      arreglo_producto = {};     

                       if (todos.resultado) {
                            var catalogo= hash_url+'libreta_corporativa/fotocalendario/'+$.base64.encode(session_id);
                            window.location.href = catalogo; 
                        }                   
                  }
                }); 
        }    
        

        

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

           arreglo_producto['logos'] = $(".modal-content[valor='"+id+"'] span.logos").text();
           arreglo_producto['longitud_nombre'] = $(".modal-content[valor='"+id+"'] span.longitud_nombre").text();
           arreglo_producto['longitud_texto'] = $(".modal-content[valor='"+id+"'] span.longitud_texto").text();

           //arreglo_producto['image_link'] = $(this).siblings(".act" ).attr('image_link');
       
            //para tomar la image_link
            ciclo = JSON.parse( $("form.variations_form.cart.swatches[data-product_id='"+arreglo_producto['product_id']+"']").attr('data-product_variations') );
            $.each(ciclo, function (i, valor) { 
              if (valor.variation_id==arreglo_producto['variation_id']) {
                        
                        if (valor.image_link) {
                              arreglo_producto['image_link'] =valor.image_link;
                        } else {
                              arreglo_producto['image_link'] ='';
                        }
              }
            });


          //console.log(arreglo_producto);



           //variaciones
           $(".variations-table .select-option.swatch-wrapper.selected").each(function() {
               arreglo_producto[$(this).parent().attr('id')] = $(this).attr('data-name');
               arreglo_producto['img_'+$(this).parent().attr('id')] = $(this).find('a img').attr('src');
           });    

           //console.log(arreglo_producto);
           arreglo_producto['descripcion_adicionales'] = '';
          //ADICIONALES(separadores)
          $(".tm-extra-product-options input.adicionales_image:checked").each(function(e) {

            
                                      var arreglo = {};
                                  arreglo["mode"] = "builder";
                              arreglo["cssclass"] = "adicionales_image";
                              //ver cual es el name
                                  arreglo["name"] = $(this).parent().parent().parent().parent().find('label.tm-epo-field-label').text();
                                 arreglo["value"] = $(".tm-extra-product-options input.use_images:checked[value='"+$(this).val()+"'] + label .checkbox_image_label").text();
                                   arreglo["key"] = $(this).val();
                                arreglo["images"] = $(".tm-extra-product-options input.use_images:checked[value='"+$(this).val()+"'] + label .checkbox_image").attr('src');
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
                                 arreglo["value"] = $(".tm-extra-product-options input.use_images:checked[value='"+$(this).val()+"'] + label .radio_image_label").text();
                                   arreglo["key"] = $(this).val();
                                arreglo["images"] = $(".tm-extra-product-options input.use_images:checked[value='"+$(this).val()+"'] + label .checkbox_image").attr('src');
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
  
          var url = hash_url+'libreta_corporativa/guardar_info'; 
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
                    var catalogo= hash_url+'libreta_corporativa/fotocalendario/'+$.base64.encode(session_id);
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
                    var url = hash_url+'libreta_corporativa/leer_marcados'; 
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
                                  //$('.agregar_cancelar').prop('disabled', false); 

                                             
                              } else {
                                $('.continuar').prop('disabled', true);
                                $('.personaliza_menu').prop('disabled', true); 
                                //$('.agregar_cancelar').prop('disabled', true); 
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
    var url = hash_url+'libreta_corporativa/leer_marcados'; 
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

              $('.agregar_cancelar').prop('disabled', true);            

              if (todos.existencia) {
                  $('.continuar').prop('disabled', false); 
                  $('.personaliza_menu').prop('disabled', false); 
                  //$('.agregar_cancelar').prop('disabled', false); 

                             
              } else {
                $('.continuar').prop('disabled', true);
                $('.personaliza_menu').prop('disabled', true); 
                //$('.agregar_cancelar').prop('disabled', true); 
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
                      var catalogo= hash_url+'libreta_corporativa/fotocalendario/'+$.base64.encode(session_id);
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



  
  spinner.stop();
  $('#foopropio').css('display','none');

  $('#foopropio').fadeOut('slow', function() {
    // Animation complete
    //$(this).css('display','block');
  });




});

