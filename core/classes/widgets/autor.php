<?php

class Autor extends WP_Widget {
    /** constructor */
    function Autor() {
        parent::WP_Widget(false, $name = 'Centurio Autor');  
    }

function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$textarea = $instance['textarea'];
		$link = esc_attr($instance['link']);
	} else {
		$title = '';
		$textarea = '';
		$link = '';
	} ?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Nome', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Description:', 'wp_widget_plugin'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>" rows="7" cols="20" ><?php echo $textarea; ?></textarea>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
	</p>	
<?php }

function update($new_instance, $old_instance) {
	$instance = $old_instance;
	// Fields
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['textarea'] = strip_tags($new_instance['textarea']);
	$instance['link'] = strip_tags ($new_instance['link']);
	return $instance;
}

function widget($args, $instance) {
	extract( $args );

	// these are the widget options
	$title = apply_filters('widget_title', $instance['title']);
	$textarea = $instance['textarea'];
	$avatar = get_avatar( get_the_author_meta( 'email' ), $size = '128' );
	$link = $instance ['link'];

	echo "<div class='author-bio'>";
		echo "<div class='author-avatar'> $avatar </div>";
		echo "<div class='author-name'> $title </div>";
		echo "<div class='author-description'> $textarea </div>";
		echo "<div class='author-saiba-mais'> <a href='$link'>Saiba mais</a></div>";
	echo "</div>";
}

}
add_action('widgets_init', create_function('', 'return register_widget("Autor");'));