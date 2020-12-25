<?php

class Captura extends WP_Widget {
    /** constructor */
    function Captura() {
        parent::WP_Widget(false, $name = 'Centurio Widget Captura');  
    }

function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);		
	} else {
		$title = '';		
	} ?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Texto de Chamada'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	
<?php }

function update($new_instance, $old_instance) {
	$instance = $old_instance;
	// Fields
	$instance['title'] = strip_tags($new_instance['title']);
	
	return $instance;
}

function widget($args, $instance) {
	extract( $args );

	// these are the widget options
	$title = apply_filters('widget_title', $instance['title']);
	
	echo "<div id='capture-widget'>";
	echo "<h3 align='center'>$title</h3>";
	include('formulario.php');
}

}
add_action('widgets_init', create_function('', 'return register_widget("Captura");'));