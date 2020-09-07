<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

		</div><!-- #main -->
		</div><!-- .container -->
<?php $aparencia = get_option( 'cores' ); ?>
<style>
	#footer{
		background: <?php echo $aparencia['fundo_rodape']; ?>;
	}
</style>
		<footer id="footer" class="span8" role="contentinfo">
			<div class="site-info">
			<p>
				<?php 
					$rodape = get_option( 'rodape' ); 
					if(!$rodape['conteudo_rodape']){ ?>
						<h4>&copy; <?php echo gmdate("Y"); ?> <?php bloginfo("title"); ?> - <?php bloginfo("description"); ?> </h4>
						<h5>Todos os direitos reservados.</h5>
					<?php }else{
						echo $exibe['conteudo_rodape'];
					}
				?>

			</p>	
			</div><!-- .site-info -->
		</footer><!-- #footer -->
	
<?php $meu_script = get_option( 'geral' ); ?>
<?php echo $meu_script['meu_script']; ?>

	<?php wp_footer(); ?>
</body>
</html>
