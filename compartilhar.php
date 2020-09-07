<style>
	#compartilhar img:hover{
		box-shadow: 0 0 0 3px lightblue;
		transition: 0.5s;
		border-radius: 3px;
	}
</style>

<div id="compartilhar">

	<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
	<img src="<?php bloginfo('url')?>/wp-content/themes/centurio/icones/facebook-32.png">
	</a>

	<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank">
	<img src="<?php bloginfo('url')?>/wp-content/themes/centurio/icones/twitter-32.png">
	</a>

	<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank">
	<img src="<?php bloginfo('url')?>/wp-content/themes/centurio/icones/google-32.png">
	</a>

	<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>" target="_blank">
	<img src="<?php bloginfo('url')?>/wp-content/themes/centurio/icones/linkedin-32.png">
	</a>

</div>
	
<br/>
<br/>