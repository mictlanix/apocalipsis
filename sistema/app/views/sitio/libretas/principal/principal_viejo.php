<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
   get_header('sistema'); 
  $this->load->view( 'sitio/libretas/principal/header' ); 
  $this->load->view( 'sitio/libretas/principal/menu' );
/*
$current_user = wp_get_current_user();
print_r($current_user);
print_r($this->session->userdata('session_id'));
die;
*/
?>



     
 <div class="container">
                                                                                                          


 <?php

 //print_r( get_query_var('paged'));
 //die;
        //https://codex.wordpress.org/es:Etiquetas_de_plantilla/get_posts
        //https://codex.wordpress.org/Class_Reference/WP_Query
        //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        //$paged =2;
        $paged = ($pagina) ? $pagina : 1;
        //$paged = $pagina;
        $args = array(
          'post_type' => 'product',
          'posts_per_page' => 12, // -1 cuanto muestra por pagina -1 para mostrar todos
          'product_cat' => 'libretas',  //'product_cat' => 'cat2,cat1',
          'post_status'=> 'publish',  //cuando esta publicado
          //'offset'=> $pagina+(get_query_var('paged')),  //cuando esta publicado

            //'p' => 441,  //id del post
            //'name'=> 'nuevas',  //nombre del post
           'paged' =>$paged, // (get_query_var('paged')) ? get_query_var('paged') : 1,
        );

        $loop = new WP_Query( $args );



/*

$loop = new WP_Query( array(
'cat' => get_cat_ID( single_cat_title('',false)), 
//'posts_per_page' => 1, //AGARRA EL NUMERO DE POST DEFINIDO EN Ajustes > lectura (en administrador)  
'paged' => $paged
));        
*/

        if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) : $loop->the_post();
                   if ( has_post_thumbnail() ) {
                    ?>
                   <div class="col-md-4 col-sm-4 col-xs-6 diseno">
                      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalMessage<?php echo get_the_ID(); ?>">
                              <!-- Imagen del producto -->
                              <div class="thumb">
                                <div class="ojo"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-elige-sis.png"></div>
                                <!-- <img src="<?php echo $valor2->featured_src; ?>" class="img-responsive"> -->
                                <?php the_post_thumbnail(); ?>
                                
                              </div>                            
                      </button>
                      <h4> <?php the_title(); ?></h4>
                  </div>


                      <?php
                        $this->load->view( 'sitio/libretas/principal/modal'); 


                    } //fin de  if ( has_post_thumbnail() ) {
            endwhile;
          
          
        } else {
        echo __( 'No hay productos' );
        }
        
        
         
?>
    <div class="col-md-12 text-center" style="margin-bottom:50px; clear:both">
              <?php
              wp_pagenavi(array( 'query' => $loop ));
              wp_reset_query();
              ?>
    </div>         
<?php
        // wp_reset_query();
        wp_reset_postdata();
        ?>
</div>
<?php 

  

  $this->load->view( 'sitio/libretas/principal/footer' );
  get_footer('sistema');
  
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.navbar-nav li:nth-child(4)').addClass('current-menu-item')
	});
</script>
