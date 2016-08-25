<?php
/*
 * Template Name: Páginas estáticas
 * Description: Plantilla de pagina personalizada.
 */

get_header();
?>

	
<div class="container min-h">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			the_content();

			

		// End the loop.
		endwhile;
		?>

</div>

<?php get_footer(); ?>