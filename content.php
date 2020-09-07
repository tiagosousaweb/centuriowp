<?php
/**
 * The default template for displaying content.
 *
 * Used for both single and index/archive/author/catagory/search/tag.
 *
 * @package Odin
 * @since 2.2.0
 */
?>
<div id="post-aberto">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
				endif;
			?>
			
			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<div id="data">Por: <?php the_author(); ?> em: <?php the_category(', '); ?></div>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<?php if ( is_search() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">			
				<?php
					the_content( __( 'Continue lendo <span class="meta-nav">&raquo;</span>', 'odin' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'odin' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
			</div><!-- .entry-content -->
		<?php endif; ?>
		
		<h5 align="right"><strong><?php edit_post_link(); ?></strong></h5>

		<h4>Compartilhar:</h4>
		<?php include("compartilhar.php"); ?>				
		
	</article><!-- #post-## -->
		<hr/>
	<div class="relacionados">
            <?php 
 
				$categories = get_the_category($post->ID);  
				if ($categories) {  $category_ids = array();  
					foreach($categories as $individual_category)  
						$category_ids[] = $individual_category->term_id; 
 
					$args=array( 
						'category__in' => $category_ids, 
						'post__not_in' => array($post->ID), 
						'showposts'=>3, // Number of related posts that will be shown. 
						'caller_get_posts'=>1 
					); 
					$my_query = new wp_query($args); 
 
 
 
					if( $my_query->have_posts() ) { 
						$count=1;
						echo '<h3>Posts Relacionados</h3><ul>';
						while ($my_query->have_posts()) { 
							$my_query->the_post(); ?>
            <div class="box-relacionado <?php if($count == 4) echo "lest" ?>"> <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink() ?>">
              <?php the_post_thumbnail('relacionados');?>
              </a>
              <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Ir para: <?php the_title_attribute(); ?>">
                <?php the_title(); ?>
                </a></li>
            </div>
            <?php $count ++; ?>
            <?php } 
						echo '</ul>'; 
						wp_reset_query();
					} 
				} 
 
			?>
          </div>
          <hr>
          <!-- end .relacionado-->
</div> <!-- Fecha a div post-aberto -->