<?php
/*
Plugin Name: Cookie About Widget
Plugin URI: http://demo.agnidesigns.com/cookie
Description: A Simple widget for displaying various widgets posts.
Version: 1.0
Author: AgniDesigns
Author URI: http://themeforest.net/user/AgniHD
Text Domain: cookie
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

*/

class cookie_about_text extends WP_Widget {

	public function __construct(){
 
		parent::__construct(
			'cookie_about_text',
			esc_html__( 'Cookie: About Text', 'cookie' ),
				array(
					'classname'   => 'widget_cookie_about_text',
					'description' => esc_html__( 'Extented version of text widget which allows you to set image & heading.', 'cookie' )
				)
			);			
		//load_plugin_textdomain( 'cookie', get_template_directory() . '/languages' );
	   
	}
	
	public function widget( $args, $instance ) {
		extract( $args );

		
		$title = apply_filters('widget_title', $instance['title'] );
		$heading = $instance['heading'];
		$image_id = $instance['image_id'];
		$description = $instance['description'];
		
		echo $before_widget;
			
		if ( $title )
			echo $before_title . $title . $after_title;  ?>

		<div class="about-text-details text-center">
			<?php echo wp_get_attachment_image( $image_id, 'cookie-grid-thumbnail' ); ?>
			<?php if( !empty( $heading ) ) {?>
				<h6 class="about-text-title"><?php echo $heading; ?></h6>
				<div class="divide-line"><span></span></div>
			<?php } ?>
			<p class="about-text-description"><?php echo $description; ?></p>
		</div>
		<?php	echo $after_widget;

	}
		
	public function form( $instance ) {
		$defaults = array( 'title' => esc_html__('About Me', 'cookie'), 'heading' => '', 'image_id' => '', 'description' => '');
		
		foreach ($instance as $value) {
			$value = esc_attr($value);
		}
		unset($value );
		$instance = wp_parse_args( (array) $instance , $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'cookie'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
		</p>

		 <p>
            <input type="number" value="<?php echo $instance['image_id']; ?>" class="process_custom_images" id="process_custom_images" name="<?php echo $this->get_field_name( 'image_id' ); ?>" max="" min="1" step="1">
            <button class="set_custom_images button"><?php esc_html_e('Add Image', 'cookie'); ?></button>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'heading' ); ?>"><?php esc_html_e('Heading:', 'cookie'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'heading' ); ?>" name="<?php echo $this->get_field_name( 'heading' ); ?>" value="<?php echo $instance['heading']; ?>"  />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php esc_html_e('Description:', 'cookie'); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $instance['description']; ?></textarea>
		</p>
		
		
	<?php }
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['heading'] = strip_tags( $new_instance['heading'] );
		$instance['image_id'] = strip_tags( $new_instance['image_id'] );
		$instance['description'] = strip_tags( $new_instance['description'] );

		return $instance;
	}
	
}
add_action ( 'admin_enqueue_scripts', function () {
	wp_enqueue_media();
	wp_enqueue_script('agni_about_text', AGNI_FRAMEWORK_URL . '/template/widgets/agni_widget_about_text.js', null, null, true);
});
add_action( 'widgets_init', function() {
	register_widget( 'cookie_about_text' );
});
