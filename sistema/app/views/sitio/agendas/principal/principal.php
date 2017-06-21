<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
  get_header('sistema');
  $this->load->view( 'sitio/agendas/principal/header' ); 
  $this->load->view( 'sitio/agendas/principal/menu' );

$parent_cat_NAME="agendas";
$IDbyNAME = get_term_by('name', $parent_cat_NAME, 'product_cat');
$product_cat_ID = $IDbyNAME->term_id;
$args = array(
   'hierarchical' => 1,
   'show_option_none' => '',
   'hide_empty' => 0,
   'parent' => $product_cat_ID,
   'taxonomy' => 'product_cat'
);
$subcats = get_categories($args);
$arreglo_subcategoria=array();
  foreach ($subcats as $sc) {
    $link = get_term_link( $sc->slug, $sc->taxonomy );
    $arreglo_subcategoria[$sc->slug]=$sc->name;
   // print_r($sc);

  }

?>

     
 <div class="container">

 <div class="row">
                  <div class="col-md-2 col-sm-2 col-xs-4">
                               <span class="help-block">Categorías</span>  
                                <?php 
                                  
                                  echo '<select name="id_cat_seleccion" id="id_cat_seleccion" class="form-control">';
                                    echo '<option selected value="agendas">Todos</option>';
                                  foreach ($arreglo_subcategoria as $key => $value) {
                                    if ($key==$id_categ) {
                                      echo '<option selected value="'.$key.'">'.$value.'</option>';
                                    } else {
                                      echo '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                  }
                                  echo '</select>';
                               ?>
                                  
                      </div>
                </div>
                <br/>

       <input type="hidden" id="imagen_deldiseno" name="imagen_deldiseno" value="">                                                                                                   


 <?php
        

        $paged = ($pagina) ? $pagina : 1;
        $args = array(
          'post_type' => 'product',
          'posts_per_page' => 12, // -1 cuanto muestra por pagina -1 para mostrar todos
          'product_cat' =>$id_categ, // 'libretas',  //'product_cat' => 'cat2,cat1',
          'post_status'=> 'publish',  //cuando esta publicado
          'paged' =>$paged, // (get_query_var('paged')) ? get_query_var('paged') : 1,
        );

        


        $loop = new WP_Query( $args );

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
                                <div class="container-image">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                
                              </div>                            
                      </button>
                      <h4> <?php the_title(); ?></h4>
                  </div>


                      <?php
                        $this->load->view( 'sitio/agendas/principal/modal'); 


                    } //fin de  if ( has_post_thumbnail() ) {
            endwhile;
        } else {
        echo __( 'No hay productos' );
        }

        ?>
            <div class="col-md-12 text-center" style="margin-bottom:50px; clear:both">
                      <?php
                      wp_pagenavi(array( 'query' => $loop ));
                     // wp_reset_query();
                      ?>
            </div>         
        <?php

        wp_reset_postdata();
        ?>
</div>
<?php 

  

  $this->load->view( 'sitio/agendas/principal/footer' );
  get_footer('sistema'); 
  
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.navbar-nav li:nth-child(5)').addClass('current-menu-item')
	});
</script>