<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
  get_header('sistema');
  $this->load->view( 'sitio/fotoagendas/principal/header' ); 
  $this->load->view( 'sitio/fotoagendas/principal/menu' );
?>

     
 <div class="container">

 <?php
        //https://codex.wordpress.org/es:Etiquetas_de_plantilla/get_posts
        //https://codex.wordpress.org/Class_Reference/WP_Query
        $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1, //cuanto muestra por pagina -1 para mostrar todos
        'product_cat' => 'fotoagendas',
        'post_status'=> 'publish',  //cuando esta publicado
        //'p' => 441,  //id del post
        //'name'=> 'mi-libreta-2',  //nombre del post

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
                                <?php the_post_thumbnail(); ?>
                                
                              </div>                            
                      </button>
                      <h4> <?php the_title(); ?></h4>
                  </div>


                      <?php
                        $this->load->view( 'sitio/fotoagendas/principal/modal'); 


                    } //fin de  if ( has_post_thumbnail() ) {
            endwhile;
        } else {
        echo __( 'No hay productos' );
        }
        wp_reset_postdata();
        ?>
</div>
<?php 

  

  $this->load->view( 'sitio/fotoagendas/principal/footer' );
  get_footer('sistema');
  
?>