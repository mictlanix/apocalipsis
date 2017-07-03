<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
get_header('sistema'); 
$this->load->view( 'sitio/libreta_corporativa/principal/header' ); 
$this->load->view( 'sitio/libreta_corporativa/principal/menu' );

$parent_cat_NAME="Libreta Corporativa";
$IDbyNAME = get_term_by('name', $parent_cat_NAME, 'product_cat');
$id_categ = $IDbyNAME->slug;
$product_cat_ID = $IDbyNAME->term_id;
//print_r($IDbyNAME); //WP_Term Object ( [term_id] => 153 [name] => Libreta Corporativa [slug] => libreta_corporativa [term_group] => 0 [term_taxonomy_id] => 153 [taxonomy] => product_cat [description] => [parent] => 0 [count] => 2 [filter] => raw )
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
  }
  $arreglo_subcategoria[$IDbyNAME->slug] =$IDbyNAME->name;
  
?>

 <div class="container">
      <div class="row">
          <div class="col-md-2 col-sm-2 col-xs-4">
             <span class="help-block">Categorías</span>  
              <?php 
                echo '<select name="id_cat_seleccion" id="id_cat_seleccion" class="form-control">';
                  echo '<option selected value="libreta_corporativa">Todos</option>';
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

                


 <?php

        $paged = ($pagina) ? $pagina : 1;
        $args = array(
          'post_type' => 'product',
          'posts_per_page' => 12, // -1 cuanto muestra por pagina -1 para mostrar todos
          'product_cat' =>$id_categ, // 'libretas',  //'product_cat' => 'cat2,cat1',
          'post_status'=> 'publish',  //cuando esta publicado
          //'offset'=> $pagina+(get_query_var('paged')),  //cuando esta publicado
            //'p' => 441,  //id del post
            //'name'=> 'nuevas',  //nombre del post
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
                                <div class="img-container-libretas">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                
                              </div>                            
                      </button>
                      <h4> <?php the_title(); ?></h4>
                  </div>
                      <?php
                        $this->load->view( 'sitio/libreta_corporativa/principal/modal'); 
                    } //fin de  if ( has_post_thumbnail() ) {
            endwhile;
        } else {
        echo __( 'No hay productos' );
        }
        
        
         
?>
    <div class="col-md-12 text-center" style="margin-bottom:50px; clear:both">
              <?php
              wp_pagenavi(array( 'query' => $loop ));
              ?>
    </div>         
<?php
        wp_reset_postdata();
        ?>
</div>
<?php 

  

  $this->load->view( 'sitio/libreta_corporativa/principal/footer' );
  get_footer('sistema');
  
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('.navbar-nav li:nth-child(5)').addClass('current-menu-item')
  });
</script>