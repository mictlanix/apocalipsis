<?php
<div class="row grid-posts">
<?php


         query_posts( array(
           'category_name' => $atts['categoria'],
           'posts_per_page' => 9,
           'paged' => get_query_var('paged'),
         ));
         
         while ( have_posts() ) : the_post();
       ?>

         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 articulo">
              <div>
                 <?php

if ( has_post_thumbnail() ) {
   the_post_thumbnail();
}
else {
   echo '<img src="http://placehold.it/445x334?text=IFIE">';
}
 ?>
 <span class="fecha">
  <span>
  <?php the_time( get_option( 'date_format' ) ); ?>
  </span>
 </span>               
 
                 <h4><?php the_title(); ?></h4>
                 <p><?php echo word_count(get_the_excerpt(), '20'); ?></p>

                 <div class="text-center">
                   <a href="<?php echo get_permalink(); ?>" target="_self" class="btn btn-default vermas">VER MÁS</a>
                 </div>

                 <div class="estadisticas">
                  <span class="likes"><?php echo do_shortcode('[rating-system-posts]') ?></span>
                  <span class="com"><i class="fa fa-comments" aria-hidden="true"></i><?php echo get_comments_number($post_id); ?></span>
                  <span class="vistas"><i class="fa fa-eye" aria-hidden="true"></i><?php echo do_shortcode('[views id="'.$post_id.'"]') ?></span>
                 </div>

               </div>
         </div>

         <?php           
         endwhile; // End of the loop.          
         ?>
         <div class="col-md-12 text-center">
<?php
wp_pagenavi();
wp_reset_query();
?>
 </div>
</div> 
<div class="row grid-posts">
<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$loop = new WP_Query( array(
'cat' => get_cat_ID( single_cat_title('',false)), 
//'posts_per_page' => 1, //AGARRA EL NUMERO DE POST DEFINIDO EN Ajustes > lectura (en administrador)  
'paged' => $paged
));
         
        while ( $loop->have_posts() ) : $loop->the_post();
       ?>

         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 articulo">
              <div>
                 <?php

if ( has_post_thumbnail() ) {
   the_post_thumbnail('thumbnail');
}
else {
   echo '<img src="http://placehold.it/445x334?text=IFIE">';
}
 ?>
 <span class="fecha">
  <span>
  <?php the_time( get_option( 'date_format' ) ); ?>
  </span>
 </span>               
 
                 <h4><?php the_title(); ?></h4>
                 <!-- <p><?php echo word_count(get_the_excerpt(), '20'); ?></p> -->

                 <div class="text-center" style="margin-bottom:15px;">
                   <a href="<?php echo get_permalink(); ?>" target="_self" class="btn btn-default vermas">VER MÁS</a>
                 </div>

                 <div class="estadisticas">
                  <span class="likes"><?php echo do_shortcode('[rating-system-posts]') ?></span>
                  <span class="com"><i class="fa fa-comments" aria-hidden="true"></i><?php echo get_comments_number($post_id); ?></span>
                  <span class="vistas"><i class="fa fa-eye" aria-hidden="true"></i><?php echo do_shortcode('[views id="'.$post_id.'"]') ?></span>
                 </div>

               </div>
         </div>

         <?php           
         endwhile; // End of the loop.          
         ?>
         <div class="col-md-12 text-center" style="margin-bottom:50px; clear:both">
<?php
wp_pagenavi(array( 'query' => $loop ));
wp_reset_query();
?>
 </div>
</div>