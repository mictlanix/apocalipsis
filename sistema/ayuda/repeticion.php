 


var id_session = $('#id_session').val();
var id_diseno = $('#id_diseno').val();
var id_tamano = $('#id_tamano').val();
var consecutivo = $('#consecutivo').val();




id_edicion_tamano      : e.target.value,
id_edicion_diseno      : jQuery(this).attr('diseno'),
id_edicion_consecutivo : jQuery(this).attr('consecutivo'),



formData.append('id_diseno', id_diseno);
formData.append('id_tamano', id_tamano);
formData.append('consecutivo', consecutivo);

<?php  

controller

$data['id_session']     = ($_POST['id_session']);
$data['id_diseno']      = ($_POST['id_diseno']);
$data['id_tamano']      = ($_POST['id_tamano']);
$data['consecutivo']      = ($_POST['consecutivo']);


models

$this->db->set('id_diseno', $data['id_diseno']);  
$this->db->set('id_tamano', $data['id_tamano']);  
$this->db->set('consecutivo', $data['consecutivo']);  











//OK cuando editamos un diseño en las fotoImagen. Hay q evaluar si existe imagen
jQuery('body').on('click','.editar_slider', function (e) {   
      //Este trigger fue invocado a la fuerza "para cambiar de mes"
        var id_session = $('#id_session').val();
        var existe = ($('#image').attr('nombre'));  

         id_edicion_tamano      = e.target.value;
         id_edicion_diseno      = jQuery(this).attr('diseno');
         id_edicion_consecutivo = jQuery(this).attr('consecutivo');


        if ( existe != undefined) { //si hay imagen para guardar
                  guardar4(id_edicion_tamano, id_edicion_diseno, id_edicion_consecutivo);
        } else { //no hay imagen para guardar
                    var catalogo= 'http://localhost/tinbox/sistema/fotocalendario/'+$.base64.encode(id_session);
                    hrefPost('POST', catalogo, {
                         id_edicion_tamano      : id_edicion_tamano,
                         id_edicion_diseno      : id_edicion_diseno,
                         id_edicion_consecutivo : id_edicion_consecutivo,

                    }, ''); 


        }


});
