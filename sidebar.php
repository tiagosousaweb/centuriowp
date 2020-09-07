<?php
/**
 * The sidebar containing the secondary widget area, displays on homepage, archives and posts.
 *
 * If no active widgets in this sidebar, it will shows Recent Posts, Archives and Tag Cloud widgets.
 *
 * @package Odin
 * @since 2.2.0
 */
?>
			
		
	<div id="secondary" class="<?php echo odin_classes_page_sidebar_aside(); ?>" role="complementary">
		<?php
			if ( ! dynamic_sidebar( 'main-sidebar' ) ) {
				the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ) );
				the_widget( 'WP_Widget_Archives', array( 'count' => 0, 'dropdown' => 1 ) );
				the_widget( 'WP_Widget_Tag_Cloud' );
			}
		?>
		
		<?php $aba_lateral = get_option( 'social' ); ?>
		<?php $exibir_lateral = $aba_lateral['exibir_social']; ?>
				
		<?php if ($exibir_lateral == 'sim') {
			include ("social.php");
		}?>	
		
	</div><!-- #secondary -->