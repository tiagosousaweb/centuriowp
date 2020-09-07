<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

<?php $posicao = get_option( 'geral' ); ?>

	<div id="primary" class="pagina-aberta <?php echo $posicao['posicao_barra']; ?> col-md-8">
		<main id="main" class="site-main" role="main">

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php
get_footer();
