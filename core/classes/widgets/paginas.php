<?php

class Paginas extends WP_Widget {
    /** constructor */
    function Paginas() {
        parent::WP_Widget(false, $name = 'Centurio Páginas');  
    }

function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$link = esc_attr($instance['link']);
		$fundo = esc_attr($instance['fundo']);
	} else {
		$title = '';
		$link = '';
		$fundo = '';
	} ?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Título'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('fundo'); ?>"><?php _e('Cor do Fundo'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('fundo'); ?>" name="<?php echo $this->get_field_name('fundo'); ?>" type="color" value="<?php echo $fundo; ?>" />
	</p>
<?php }

function update($new_instance, $old_instance) {
	$instance = $old_instance;
	// Fields
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['link'] = strip_tags ($new_instance['link']);
	$instance['fundo'] = strip_tags ($new_instance['fundo']);
	return $instance;
}

function widget($args, $instance) {
	extract( $args );

	// these are the widget options
	$title = apply_filters('widget_title', $instance['title']);
	$link = $instance ['link'];
	$fundo = $instance ['fundo'];
			
	echo "<div class='widget-pagina' style='background: $fundo'>";
		echo "<a href='$link'> $title</a>";
	echo "</div>";
}

}
add_action('widgets_init', create_function('', 'return register_widget("Paginas");'));