<?php
/**
 * The template for displaying Category pages.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

<?php $posicao = get_option( 'geral' ); ?>
	<section id="primary" class="<?php echo odin_classes_page_sidebar(); ?> <?php echo $posicao['posicao_barra']; ?>">
		<main id="main" class="site-main" role="main">

		<h2>Posts da Categoria: <strong><?php single_cat_title(); ?></strong></h2>
			<hr>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
				
				<div class="resumo-artigo">
				
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					
						<div id="data">Por <a href= "<?php echo $author_link; ?>" ><?php the_author(); ?></a> em <?php the_category(', '); ?></a> </div>
						
							<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail(); ?>
							</a>
											
					<p><?php the_excerpt(); ?></p> <!-- Resumo do post -->
											
						<a href="<?php the_permalink(); ?>" class="more-link">Ler mais &raquo</a>
					
				</div>
	 
			<?php endwhile; ?>
	 
				<!-- Aqui vai a paginação -->
				<?php echo odin_pagination(); ?>
				
			<?php else: ?>
	 
				<h2>Nada Encontrado</h2>
				<p>Erro 404</p>
				<p>Lamentamos mas não foram encontrados artigos.</p>
	 
			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
