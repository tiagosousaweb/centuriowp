<?php

	// $geral   = get_option( 'geral' ); 
	// $dom_reg = $geral['key'];

	// $dom_atual = sha1(md5(home_url()));

	// if ($dom_atual != $dom_reg){
	// 	echo "<br><br><hr/><h1 align='center'>Tema não licenciado!</h1><hr/>";
	// }else{ não esquecer de remover o comentario do fechamento dessa aspa
	
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>
<?php $posicao = get_option( 'geral' ); ?>

	<div id="primary" class="<?php echo odin_classes_page_sidebar(); ?> <?php echo $posicao['posicao_barra']; ?>">
		<main id="main" class="site-main" role="main">			
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
		</main><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

// }