<?php
/*
Plugin Name: Cookie Social Icon Widget
Plugin URI: http://demo.agnidesigns.com/cookie
Description: A Simple widget for displaying various social icons links.
Version: 1.0
Author: AgniDesigns
Author URI: http://themeforest.net/user/AgniHD
Text Domain: cookie
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

*/

class cookie_social_icons extends WP_Widget {

	public function __construct(){
 
		parent::__construct(
			'cookie_social_icons',
			esc_html__( 'Cookie: Social Icons', 'cookie' ),
				array(
					'classname'   => 'widget_cookie_social_icons',
					'description' => esc_html__( 'A set of social icons to display social media links. This is designed only for cookie.', 'cookie' )
				)
			);			
		//load_plugin_textdomain( 'cookie', get_template_directory() . '/languages' );
	   
	}

	public function widget( $args, $instance ) {

		global $cookie_options;
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$googleplus = $instance['googleplus'];
		$dribbble = $instance['dribbble'];
		$instagram = $instance['instagram'];
		$behance = $instance['behance'];
		$tumblr = $instance['tumblr'];
		$flickr = $instance['flickr'];
		$pinterest = $instance['pinterest'];
		$youtube = $instance['youtube'];
				
		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;

		?>		
        <ul class="list-inline text-center">
            <?php if($facebook) { ?><li><a href="<?php echo $cookie_options[ 'facebook-link' ];?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
            <?php if($twitter) { ?><li><a href="<?php echo $cookie_options[ 'twitter-link' ]; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
            <?php if($googleplus) { ?><li><a href="<?php echo $cookie_options[ 'googleplus-link' ]; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
            <?php if($dribbble) { ?><li><a href="<?php echo $cookie_options[ 'dribbble-link' ]; ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li><?php } ?>
            <?php if($instagram) { ?><li><a href="<?php echo $cookie_options[ 'instagram-link' ]; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php } ?>
            <?php if($behance) { ?><li><a href="<?php echo $cookie_options[ 'behance-link' ]; ?>" target="_blank"><i class="fa fa-behance"></i></a></li><?php } ?>
            <?php if($pinterest) { ?><li><a href="<?php echo $cookie_options[ 'pinterest-link' ]; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li><?php } ?>
            <?php if($flickr) { ?><li><a href="<?php echo $cookie_options[ 'flickr-link' ]; ?>" target="_blank"><i class="fa fa-flickr"></i></a></li><?php } ?>
            <?php if($tumblr) { ?><li><a href="<?php echo $cookie_options[ 'tumblr-link' ]; ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li><?php } ?>
            <?php if($youtube) { ?><li><a href="<?php echo $cookie_options[ 'youtube-link' ]; ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li><?php } ?>
        </ul>
		<?php
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['dribbble'] = strip_tags( $new_instance['dribbble'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );
		$instance['behance'] = strip_tags( $new_instance['behance'] );
		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
		$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
		$instance['flickr'] = strip_tags( $new_instance['flickr'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );

		return $instance;
	}


	public function form( $instance ) {
		
		$defaults = array( 'title' => 'Social Icons', 'facebook' => 'on', 'twitter' => 'on', 'googleplus' => 'on', 'dribbble' => 'on', 'instagram' => 'on', 'behance' => '', 'tumblr' => '', 'flickr' => '', 'pinterest' => '', 'youtube' => '' );
		
		foreach ($instance as $value) {
			$value = esc_attr($value);
		}
		unset($value );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
       
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'cookie'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
		</p>
        
        <hr />
        
        <p> You can configure your links at Cookie/Social Links </p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Facebook:', 'cookie'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" <?php checked( (bool) $instance['facebook'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Twitter:', 'cookie'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" <?php checked( (bool) $instance['twitter'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'googleplus' ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Google Plus:', 'cookie'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" <?php checked( (bool) $instance['googleplus'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Dribbble:', 'cookie'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" <?php checked( (bool) $instance['dribbble'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Instagram:', 'cookie'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" <?php checked( (bool) $instance['instagram'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'behance' ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Behance:', 'cookie'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" <?php checked( (bool) $instance['behance'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Pinterest:', 'cookie'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" <?php checked( (bool) $instance['pinterest'], true ); ?> />
		</p>        
		
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Flickr:', 'cookie'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" <?php checked( (bool) $instance['flickr'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Tumblr:', 'cookie'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" <?php checked( (bool) $instance['tumblr'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>" style="width:30%; display:inline-block;"><?php esc_html_e('Youtube:', 'cookie'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" <?php checked( (bool) $instance['youtube'], true ); ?> />
		</p>


	<?php
	}	
}

add_action( 'widgets_init', function() {
     register_widget( 'cookie_social_icons' );
});
