<?php $social = get_option( 'social' ); ?>

<?php 
	$exibir_social = $social['exibir_social'];
	if ($exibir_social == 'sim') { ?>

	<h3 class="widgettitle">
		<?php echo $social ['titulo']; ?>
	</h3>

	<div class="widget-social" style="text-align: center; background: #fff; padding: 20px;">

		<?php $link_facebook = $social['link_facebook']; ?>
		<?php
			if ( $link_facebook != null ) { ?>
				<a href="<?php echo $social['link_facebook'] ?>" target="new">
					<img src="<?php echo get_template_directory_uri(); ?>/icones/facebook.png" width="60px">
				</a>
		<?php }?>

		<?php $link_twitter = $social['link_twitter']; ?>
		<?php
			if ( $link_twitter != null ) { ?>
				<a href="<?php echo $social['link_twitter'] ?>" target="new">
					<img src="<?php echo get_template_directory_uri(); ?>/icones/twitter.png" width="60px">
				</a>
		<?php }?>

		<?php $link_plus = $social['link_plus']; ?>
		<?php
			if ( $link_plus != null ) { ?>
				<a href="<?php echo $social['link_plus'] ?>" target="new">
					<img src="<?php echo get_template_directory_uri(); ?>/icones/google-plus.png" width="60px">
				</a>
		<?php }?>

		<?php $link_youtube = $social['link_youtube']; ?>
		<?php
			if ( $link_youtube != null ) { ?>
				<a href="<?php echo $social['link_youtube'] ?>" target="new">
				<img src="<?php echo get_template_directory_uri(); ?>/icones/youtube.png" width="60px">
				</a>
		<?php }?>

	</div>

<?php }?>