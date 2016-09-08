<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( get_template_directory() . '/cmb2/init.php' ) ) {
	require_once get_template_directory() . '/cmb2/init.php';
} elseif ( file_exists( get_template_directory() . '/CMB2/init.php' ) ) {
	require_once get_template_directory() . '/CMB2/init.php';
}

/*
 * Portfolio
 */
add_action( 'cmb2_init', 'agni_post_meta' );

function agni_post_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'post_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$post_option = new_cmb2_box( array(
		'id'            => $prefix . 'post_option',
		'title'         => esc_html__( 'Post Options', 'cookie' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	
	$post_option->add_field( array(
		'name' => esc_html__('Fullwidth', 'cookie' ),
		'desc' => esc_html__('It allows you to use the fullwidth of the screen.', 'cookie' ),
		'id' => $prefix.'fullwidth',
		'type' => 'checkbox',
	) );
	
	$post_option->add_field( array ( 
		'name'	=> esc_html__('Sidebar', 'cookie' ),
		'id'	=> $prefix.'sidebar',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'no-sidebar' => esc_html__('No Sidebar', 'cookie' ), 
			'has-sidebar' => esc_html__('Right Sidebar', 'cookie' ), 
			'has-sidebar left' => esc_html__('Left Sidebar', 'cookie' )
		),
		'default' => 'has-sidebar'
	) );
}

/*
 * Post format
 */
 
add_action( 'cmb2_init', 'agni_post_format_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_post_format_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'post_format_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$quote_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'quote_post_options',
		'title'         => esc_html__( 'Quote Post Options', 'cookie' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$quote_post_option->add_field( array(
			'name' => esc_html__('Quote Text', 'cookie' ),
			'id' => $prefix.'quote_text',
			'type' => 'textarea_small'
	) );
	$quote_post_option->add_field( array(
			'name' => esc_html__('Quote author', 'cookie' ),
			'id' => $prefix.'quote_cite',
			'type' => 'text_small'
	) );
	
	$link_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'link_post_options',
		'title'         => esc_html__( 'Link Post Options', 'cookie' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	$link_post_option->add_field( array( 
		'name'	=> esc_html__('Link', 'cookie' ), 
		'desc'	=> esc_html__('Type URL to display into the post', 'cookie' ), 
		'id'	=> $prefix.'link_url', 
		'type'	=> 'text_url',
	) );
	
	$audio_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'audio_post_options',
		'title'         => esc_html__( 'Audio Post Options', 'cookie' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, 
	) );

	$audio_post_option->add_field( array( 
		'name'	=> esc_html__('Self Hosted Audio Link', 'cookie' ), 
		'id'	=> $prefix.'audio_url', 
		'type'	=> 'file'
	) );
	
	$video_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'video_post_options',
		'title'         => esc_html__( 'Video Post Options', 'cookie' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, 
	) );

	$video_post_option->add_field( array( 
		'name'	=> esc_html__('Self Hosted Video Link', 'cookie' ), 
		'desc'	=> esc_html__('Fill one of any video source info!!..', 'cookie' ), 
		'id'	=> $prefix.'video_url', 
		'type'	=> 'file'
	) );
	$video_post_option->add_field( array( 
		'name'	=> esc_html__('Video Poster', 'cookie' ), 
		'desc'	=> esc_html__('Only applicable for self hosted video', 'cookie' ), 
		'id'	=> $prefix.'video_poster', 
		'type'	=> 'file'
	) );
	$video_post_option->add_field( array( 
		'name'	=> esc_html__('Embed Link', 'cookie' ), 
		'desc'	=> esc_html__('enter the youtube, vimeo or any video embed link ', 'cookie' ), 
		'id'	=> $prefix.'video_embed_url', 
		'type'	=> 'textarea_small',
		'sanitization_cb' => false
	) );
	
	$gallery_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'gallery_post_options',
		'title'         => esc_html__( 'Gallery Post Options', 'cookie' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
		 
	) );

	$gallery_post_option->add_field( array( 
		'name'	=> esc_html__('Choose Images ', 'cookie' ), 
		'id'	=> $prefix . 'gallery_image', 
		'type'	=> 'file_list'			
	) );
	$gallery_post_option->add_field( array(
		'name' => esc_html__('Slider Disable Autoplay', 'cookie' ),
		'desc' => esc_html__('It will disable the gallery slider\'s autoplay functionality.', 'cookie' ),
		'id' => $prefix.'gallery_autoplay',
		'type' => 'checkbox',
	) );
	$gallery_post_option->add_field( array(
		'name' => esc_html__('Slider Autoplay Timeout', 'cookie' ),
		'id' => $prefix.'gallery_autoplay_timeout',
		'type' => 'text_small',
		'default' => '4000'
	) );
	$gallery_post_option->add_field( array(
		'name' => esc_html__('Slider Autoplay Speed', 'cookie' ),
		'id' => $prefix.'gallery_autoplay_speed',
		'type' => 'text_small',
		'default' => '700'
	) );
	$gallery_post_option->add_field( array(
		'name' => esc_html__('Slider Disable Autoplay on Hover', 'cookie' ),
		'id' => $prefix.'gallery_autoplay_hover',
		'type' => 'checkbox',
	) );
	$gallery_post_option->add_field( array(
		'name' => esc_html__('Slider Disable Loop', 'cookie' ),
		'id' => $prefix.'gallery_loop',
		'type' => 'checkbox',
	) );
	$gallery_post_option->add_field( array(
		'name' => esc_html__('Slider Disable Pagination', 'cookie' ),
		'id' => $prefix.'gallery_pagination',
		'type' => 'checkbox',
	) );

}

/*
 * Portfolio
 */
add_action( 'cmb2_init', 'agni_portfolio_meta' );

function agni_portfolio_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'portfolio_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$portfolio_option = new_cmb2_box( array(
		'id'            => $prefix . 'portfolio_options',
		'title'         => esc_html__( 'Portfolio Options', 'cookie' ),
		'object_types'  => array( 'portfolio' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	
	$portfolio_option->add_field( array ( 
		'name'	=> esc_html__('Portfolio thumbnail width', 'cookie' ),
		'id'	=> $prefix.'thumbnail_width',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'width1x' => esc_html__('Default', 'cookie' ), 
			'width2x' => esc_html__('Width 2x', 'cookie' )
		),
		'default' => 'width1x'
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Portfolio custom link', 'cookie' ), 
		'desc'	=> esc_html__('This custom link will replace the actual portfolio single page link.', 'cookie' ), 
		'id'	=> $prefix.'custom_link', 
		'type'	=> 'text_url',
	) );
}

add_action( 'cmb2_init', 'agni_product_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_product_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'product_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$product_option = new_cmb2_box( array(
		'id'            => $prefix . 'product_options',
		'title'         => esc_html__( 'Product Options', 'cookie' ),
		'object_types'  => array( 'product' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );	
	
	$product_option->add_field( array(
		'name' => esc_html__('Sub Title', 'cookie' ),
		'desc' => esc_html__('This subtitle will be shown below to the Title of this product.', 'cookie' ),
		'id' => $prefix.'subtitle',
		'type' => 'text_small',
		'sanitization_cb' => false
	) );
	
}


/*
 * Page Options
 */
add_action( 'cmb2_init', 'agni_page_meta' );

function agni_page_meta() {
	
	function agni_posttype_options( $query_args ) {

		$args = wp_parse_args( $query_args, array(
			'post_type'   => 'post',
			'numberposts' => -1,
		) );
	
		$posts = get_posts( $args );
		$post_options = array("" => "");
		//$post_options = array();
		if ( $posts ) {
			foreach ( $posts as $post ) {
			  $post_options[ $post->ID ] = $post->post_title;
			}
		}
	
		return $post_options;
	}
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = 'page_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$page_option = new_cmb2_box( array(
		'id'            => $prefix . 'page_options',
		'title'         => esc_html__( 'Page Options', 'cookie' ),
		'object_types'  => array( 'page' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Fullwidth', 'cookie' ),
		'desc' => esc_html__('It allows you to use the fullwidth of the screen. Highly recommended if you are using the shortcodes(visual composer elements).', 'cookie' ),
		'id' => $prefix.'fullwidth',
		'type' => 'checkbox',
		
	) );
	$page_option->add_field( array(
		'name' => esc_html__('Remove Margins', 'cookie' ),
		'desc' => esc_html__('It will remove the margin at the top & bottom.', 'cookie' ),
		'id' => $prefix.'remove_margin',
		'type' => 'checkbox',
		
	) );
	$page_option->add_field( array(
		'name' => esc_html__('Remove Title', 'cookie' ),
		'id' => $prefix.'remove_title',
		'type' => 'checkbox',
		
	) );
	$page_option->add_field( array(
		'name' => esc_html__('Transparent Header', 'cookie' ),
		'desc' => esc_html__('It will overwrite the global(option panel) settings.', 'cookie' ),
		'id' => $prefix.'transparent',
		'type' => 'checkbox',
	) );
	$page_option->add_field( array(
		'name' => esc_html__('Reverse Header Skin', 'cookie' ),
		'desc' => esc_html__('It will reverse(interchange) your current header menu bar skin.', 'cookie' ),
		'id' => $prefix.'skin_reverse',
		'type' => 'checkbox',
	) );
	$page_option->add_field( array(
		'name' => esc_html__('Agni Slider List', 'cookie' ),
		'desc' => esc_html__('Here, you can choose the slider which is created under Agni Slider Posttype.', 'cookie' ),
		'id' => $prefix.'agni_sliders',
		'type' => 'select',
		'options' => agni_posttype_options( array( 'post_type' => 'agni_slides') ),
	) );
}

/**
 * Page Header
 */
function cmb_show_on_meta_value( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['meta_key'] ) ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return $display;
    }

    $value = get_post_meta( $post_id, $meta_box['show_on']['meta_key'], true );

    if ( empty( $meta_box['show_on']['meta_value'] ) ) {
        return (bool) $value;
    }

    return $value == $meta_box['show_on']['meta_value'];
}
add_filter( 'cmb2_show_on', 'cmb_show_on_meta_value', 10, 2 );
$page_option['show_on'] = array( 'meta' => 'page_header_height_type', 'meta_value' => '2', );
 
add_action( 'cmb2_init', 'agni_page_header_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_page_header_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'page_header_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$page_header_option = new_cmb2_box( array(
		'id'            => $prefix . 'page_header_options',
		'title'         => esc_html__( 'Header Options', 'cookie' ),
		'object_types'  => array( 'page', 'post', 'portfolio', 'product' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Page header Type', 'cookie' ),
		'id'	=> $prefix.'type',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'1' => esc_html__('Full Height(100%)', 'cookie' ), 
			'2' => esc_html__('Custom Height', 'cookie' ), 
		),
		'default' => '2'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Page Header Height', 'cookie' ), 
		'desc'	=> esc_html__('Enter your height in px', 'cookie' ), 
		'id'	=> $prefix.'height', 
		'type'	=> 'text_small',
		'default' => '360',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'type',
			'data-conditional-value' => '2',
		)
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Fullwidth', 'cookie' ),
		'desc' => esc_html__('if you want to use fullwidth content, check this.', 'cookie' ),
		'id' => $prefix.'fullwidth',
		'type' => 'checkbox',
	) );
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Background Choice', 'cookie' ),
		'id'	=> $prefix.'bg_choice',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'1' => esc_html__('Image', 'cookie' ), 
			'2' => esc_html__('Solid Color', 'cookie' ), 
		),
		'default' => '1'
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Background Color', 'cookie' ),
		'desc'	=> esc_html__('choose the Background color.', 'cookie' ),
		'id' => $prefix.'bg_color',
		'type' => 'colorpicker',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'bg_choice',
			'data-conditional-value' => '2',
		)
	) );
	
	$page_header_option->add_field( array(
		'name' => esc_html__('Background Image', 'cookie' ),
		'id' => $prefix.'bg_image',
		'type' => 'file',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'bg_choice',
			'data-conditional-value' => '1',
		)
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Overlay Color', 'cookie' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider!!', 'cookie' ), 
		'id'	=> $prefix.'overlay', 
		'type'	=> 'colorpicker',
		'default' => '#000000',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'bg_choice',
			'data-conditional-value' => '1',
		)
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Overlay Opacity', 'cookie' ), 
		'desc'	=> esc_html__('type or pick the opacity level of the overlay from 0 to 1..', 'cookie' ), 
		'id'	=> $prefix.'opacity', 
		'type'	=> 'text_small',
		'default' => '0.4',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'bg_choice',
			'data-conditional-value' => '1',
		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Parallax Starting Value', 'cookie' ), 
		'desc'	=> esc_html__('Background position for page header for eg. transform:translateY(0px); leave it empty for no parallax', 'cookie' ), 
		'id'	=> $prefix.'parallax_start', 
		'type'	=> 'text',
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'cookie' ), 
		'desc'	=> esc_html__('Background position for page header for eg. transform:translateY(400px); leave it empty for no parallax', 'cookie' ), 
		'id'	=> $prefix.'parallax_end', 
		'type'	=> 'text',
	) );
	
	$page_header_option->add_field( array(
		'name' => esc_html__('Title rotator', 'cookie' ),
		'desc' => esc_html__('check this for text rotator(ticker)', 'cookie' ),
		'id' => $prefix.'title_rotator',
		'type' => 'checkbox',
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Title rotator Speed', 'cookie' ), 
		'desc'	=> esc_html__('type your title rotator speed in ms.', 'cookie' ), 
		'id'	=> $prefix.'title_rotator_speed', 
		'type'	=> 'text_small',
		'default' => '4000',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'title_rotator',
			'data-conditional-value' => '1',
		)
	) );
	
	$page_header_option->add_field( array(
		'name' => esc_html__('Title', 'cookie' ),
		'desc' => esc_html__('To use it as a text rotator(ticker). use the delimiter \'|\'', 'cookie' ),
		'id' => $prefix.'title',
		'type' => 'text_medium',
		'sanitization_cb' => false
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Title Font Size', 'cookie' ), 
		'desc'	=> esc_html__('font size in px', 'cookie' ), 
		'id'	=> $prefix.'title_size', 
		'type'	=> 'text_small',
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Title Color', 'cookie' ), 
		'desc'	=> esc_html__('Choose the color for the heading/title', 'cookie' ), 
		'id'	=> $prefix.'color_title', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0'
	) );
	
	$page_header_option->add_field( array(
		'name' => esc_html__('Description', 'cookie' ),
		'id' => $prefix.'description',
		'type' => 'textarea_small'
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Description Color ', 'cookie' ), 
		'desc'	=> esc_html__('choose the description color', 'cookie' ), 
		'id'	=> $prefix.'color_description', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0'
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1', 'cookie' ), 
		'desc'	=> esc_html__('button 1 info', 'cookie' ), 
		'id'	=> $prefix.'button1', 
		'type'	=> 'text_small'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1 URL', 'cookie' ), 
		'desc'	=> esc_html__('button href', 'cookie' ), 
		'id'	=> $prefix.'button1_url', 
		'type'	=> 'text_url',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'button1',
		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button type', 'cookie' ),
		'id'	=> $prefix.'button1_type',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'btn-normal' => esc_html__('background', 'cookie' ), 
			'btn-alt' => esc_html__('Bordered', 'cookie' ), 
		),
		'default' => 'btn-alt',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'button1',
		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button Style', 'cookie' ),
		'id'	=> $prefix.'button1_style',
		'type'	=> 'select',
		'options' => array ( 
			'default' => esc_html__('Default', 'cookie' ), 
			'primary' => esc_html__('Primary', 'cookie' ), 
			'accent' => esc_html__('Accent', 'cookie' ), 
			'white' => esc_html__('White', 'cookie' ), 
		),
		'default' => 'default',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'button1',
		)
	) );	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button Target', 'cookie' ),
		'id'	=> $prefix.'button1_target',
		'type'	=> 'select',
		'options' => array ( 
			'_self' => esc_html__('Same Window', 'cookie' ), 
			'_blank' => esc_html__('New Window', 'cookie' ), 
		),
		'default' => '_self',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'button1',
		)
	) );	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2', 'cookie' ), 
		'desc'	=> esc_html__('button 2 info', 'cookie' ), 
		'id'	=> $prefix.'button2', 
		'type'	=> 'text_small'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2 URL', 'cookie' ), 
		'desc'	=> esc_html__('button href', 'cookie' ), 
		'id'	=> $prefix.'button2_url', 
		'type'	=> 'text_url',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'button2',
		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button type', 'cookie' ),
		'id'	=> $prefix.'button2_type',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'btn-normal' => esc_html__('background', 'cookie' ), 
			'btn-alt' => esc_html__('Bordered', 'cookie' ), 
		),
		'default' => 'btn-alt',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'button2',
		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button Style', 'cookie' ),
		'id'	=> $prefix.'button2_style',
		'type'	=> 'select',
		'options' => array ( 
			'default' => esc_html__('Default', 'cookie' ), 
			'primary' => esc_html__('Primary', 'cookie' ), 
			'accent' => esc_html__('Accent', 'cookie' ), 
			'white' => esc_html__('White', 'cookie' ), 
		),
		'default' => 'default',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'button2',
		)
	) );	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button Target', 'cookie' ),
		'id'	=> $prefix.'button2_target',
		'type'	=> 'select',
		'options' => array ( 
			'_self' => esc_html__('Same Window', 'cookie' ), 
			'_blank' => esc_html__('New Window', 'cookie' ), 
		),
		'default' => '_self',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'button2',
		)
	) );	
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Content Vertical Alignment', 'cookie' ),
		'id'	=> $prefix.'vertical_alignment',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'top' => esc_html__('Top', 'cookie' ), 
			'middle' => esc_html__('Middle', 'cookie' ), 
			'bottom' => esc_html__('Bottom', 'cookie' ), 
		),
		'default' => 'middle'
	) );
	
	$page_header_option->add_field( array ( 
		'name'	=> esc_html__('Slider Text Alignment', 'cookie' ),
		'id'	=> $prefix.'alignment',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'left' => esc_html__('Left', 'cookie' ),
			'center' => esc_html__('Center', 'cookie' ),
			'right' => esc_html__('Right', 'cookie' ),
		),
		'default' => 'left'
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Top Padding', 'cookie' ), 
		'desc'	=> esc_html__('padding for page header content. in px', 'cookie' ), 
		'id'	=> $prefix.'padding_top', 
		'type'	=> 'text_small',
		'default' => '0'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Bottom Padding', 'cookie' ), 
		'desc'	=> esc_html__('padding for page header content. in px', 'cookie' ), 
		'id'	=> $prefix.'padding_bottom', 
		'type'	=> 'text_small',
		'default' => '0'
	) );
	
	$page_header_option->add_field( array(
		'name' => esc_html__('Navigation Links', 'cookie' ),
		'desc' => esc_html__('check this to show the navigation link at header', 'cookie' ),
		'id' => $prefix.'nav',
		'type' => 'checkbox',
	) );

}

add_action( 'cmb2_init', 'agni_slider_meta' );
function agni_slider_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'agni_slides_';
	
	$agni_slider_option = new_cmb2_box( array(
		'id'            => $prefix . 'agni_slider_option',
		'title'         => esc_html__( 'Agni Slider Options', 'cookie' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	$agni_slider_option->add_field( array ( 
		'name'	=> esc_html__('Slider Choice', 'cookie' ), 
		'desc'	=> esc_html__('choose your slider, And fill the details below. ', 'cookie' ), 
		'id'	=> $prefix.'choice', 
		'type'	=> 'radio_inline',
		'options' => array ( 
			'slideshow' => esc_html__('Default(Slideshow)', 'cookie' ), 					
			'videobg' => esc_html__('Video BG', 'cookie' ),
			'textslider' => esc_html__('Text slider', 'cookie' ),
			'imageslider' => esc_html__('Image slider', 'cookie' ),
		)
	) );	
	
	$slideshow_slider_options = new_cmb2_box( array(
		'id'            => $prefix . 'slideshow_options',
		'title'         => esc_html__( 'Slideshow', 'cookie' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$slideshow_repeatable = $slideshow_slider_options->add_field( array(
		'id'          => $prefix . 'slideshow_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'cookie' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Slide', 'cookie' ),
			'remove_button' => esc_html__( 'Remove Slide', 'cookie' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Slide Image', 'cookie' ), 
		'id'	=> 'slideshow_image', 
		'type'	=> 'file'
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Title rotator', 'cookie' ),
		'desc' => esc_html__('check this for text rotator(ticker)', 'cookie' ),
		'id' => 'slideshow_title_rotator',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Title rotator Speed', 'cookie' ), 
		'desc'	=> esc_html__('type your title rotator speed in ms.', 'cookie' ), 
		'id'	=> 'slideshow_title_rotator_speed', 
		'type'	=> 'text_small',
		'default' => '4000',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Title', 'cookie' ),
		'desc' => esc_html__('To use it as a text rotator(ticker).. use the delimiter \'|\'', 'cookie' ),
		'id' => 'slideshow_title',
		'type' => 'text',
		'sanitization_cb' => false
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Additional Title', 'cookie' ),
		'id' => 'slideshow_desc',
		'type' => 'text',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1', 'cookie' ), 
		'desc'	=> esc_html__('button 1 info', 'cookie' ), 
		'id'	=> 'slideshow_button1', 
		'type'	=> 'text_small'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1 URL', 'cookie' ), 
		'desc'	=> esc_html__('button href', 'cookie' ), 
		'id'	=> 'slideshow_button1_url', 
		'type'	=> 'text_url',
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 1 Style', 'cookie' ),
		'id'	=> 'slideshow_button1_style',
		'type'	=> 'select',
		'options' => array ( 
			'default' => esc_html__('Default', 'cookie' ), 
			'primary' => esc_html__('Primary', 'cookie' ), 
			'white' => esc_html__('White', 'cookie' ), 
		),
		'default' => 'white'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 1 Target', 'cookie' ),
		'id'	=> 'slideshow_button1_target',
		'type'	=> 'select',
		'options' => array ( 
			'_self' => esc_html__('Same Window', 'cookie' ), 
			'_blank' => esc_html__('New Window', 'cookie' ), 
		),
		'default' => '_self',
	) );	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2', 'cookie' ), 
		'desc'	=> esc_html__('button 2 info', 'cookie' ), 
		'id'	=> 'slideshow_button2', 
		'type'	=> 'text_small'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2 URL', 'cookie' ), 
		'desc'	=> esc_html__('button href', 'cookie' ), 
		'id'	=> 'slideshow_button2_url', 
		'type'	=> 'text_url',
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button Style', 'cookie' ),
		'id'	=> 'slideshow_button2_style',
		'type'	=> 'select',
		'options' => array ( 
			'default' => esc_html__('Default', 'cookie' ), 
			'primary' => esc_html__('Primary', 'cookie' ), 
			'white' => esc_html__('White', 'cookie' ), 
		),
		'default' => 'white'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 2 Target', 'cookie' ),
		'id'	=> 'slideshow_button2_target',
		'type'	=> 'select',
		'options' => array ( 
			'_self' => esc_html__('Same Window', 'cookie' ), 
			'_blank' => esc_html__('New Window', 'cookie' ), 
		),
		'default' => '_self',
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Slider Text Alignment', 'cookie' ),
		'id'	=> 'slideshow_alignment',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'left' => esc_html__('Left', 'cookie' ), 
			'center' => esc_html__('Center', 'cookie' ), 
			'right' => esc_html__('Right', 'cookie' ), 
		),
		'default'  => 'left'
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Slider content Vertical Alignment', 'cookie' ),
		'id'	=> 'slideshow_vertical_alignment',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'top' => esc_html__('Top', 'cookie' ), 
			'middle' => esc_html__('Middle', 'cookie' ), 
			'bottom' => esc_html__('Bottom', 'cookie' ), 
		),
		'default'  => 'middle'
	) );

	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Slider Type', 'cookie' ),
		'id'	=> $prefix.'slideshow_type',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'1' => esc_html__('Full Height(100%)', 'cookie' ), 
			'2' => esc_html__('Custom Height', 'cookie' ), 
		),
		'default' => '1'
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height', 'cookie' ), 
		'desc'	=> esc_html__('Enter your height in px', 'cookie' ), 
		'id'	=> $prefix.'slideshow_height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_type',
			'data-conditional-value' => '2',
		)
	) );
	$slideshow_slider_options->add_field( array(
		'name' => esc_html__('Title Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeIn animation.', 'cookie' ),
		'id' => $prefix.'slideshow_title_animation',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Title Border', 'cookie' ), 
		'desc'	=> esc_html__('Show border around the title', 'cookie' ), 
		'id'	=> $prefix.'slideshow_border_title', 
		'type'	=> 'checkbox'
	) );

	$slideshow_slider_options->add_field( array(
		'name' => esc_html__('Additional Title Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeInUp animation.', 'cookie' ),
		'id' => $prefix.'slideshow_additional_title_animation',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_field( array(
		'name' => esc_html__('Divide Line Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeIn animation.', 'cookie' ),
		'id' => $prefix.'slideshow_divide_line_animation',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_field( array(
		'name' => esc_html__('Buttons Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'cookie' ),
		'id' => $prefix.'slideshow_button_animation',
		'type' => 'checkbox',
	) );

	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax Starting Value', 'cookie' ), 
		'desc'	=> esc_html__('enter the css property for the slider\'s top at the top of the screen... for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'cookie' ), 
		'id'	=> $prefix.'slideshow_parallax_start', 
		'type'	=> 'textarea_small',
	) );
	
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'cookie' ), 
		'desc'	=> esc_html__('enter the css property for the slider\'s bottom when at the top of the screen... for eg.transform:translateY(400px); if don\'t want parallax just leave this empty', 'cookie' ), 
		'id'	=> $prefix.'slideshow_parallax_end', 
		'type'	=> 'textarea_small',
	) );
	
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow link', 'cookie' ), 
		'desc'	=> esc_html__('to hide Bottom Arrow, keep this field empty', 'cookie' ), 
		'id'	=> $prefix.'slideshow_arrowlink', 
		'type'	=> 'text_url',
	) );
	
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow Color', 'cookie' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'cookie' ), 
		'id'	=> $prefix.'slideshow_arrowlink_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_arrowlink',
		)		
	) );
	
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Title Color', 'cookie' ), 
		'desc'	=> esc_html__('Choose the color for the heading/title', 'cookie' ), 
		'id'	=> $prefix.'slideshow_color_title', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0'
	) );
	
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Description Color ', 'cookie' ), 
		'desc'	=> esc_html__('choose the description color', 'cookie' ), 
		'id'	=> $prefix.'slideshow_color_desc', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0'
	) );
	
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Overlay BG Color', 'cookie' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider!!', 'cookie' ), 
		'id'	=> $prefix.'slideshow_color_overlay', 
		'type'	=> 'colorpicker',
		'default' => '#000000'
	) );
	
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Overlay Opacity', 'cookie' ), 
		'desc'	=> esc_html__('type or pick the opacity level of the overlay from 0 to 1..', 'cookie' ), 
		'id'	=> $prefix.'slideshow_opacity', 
		'type'	=> 'text_small',
		'default' => '0.6'
	) );
	
	// Video BG
	$videobg_options = new_cmb2_box( array(
		'id'            => $prefix . 'videobg_options',
		'title'         => esc_html__( 'Video BG', 'cookie' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$videobg_repeatable = $videobg_options->add_field( array(
		'id'          => $prefix . 'videobg_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'cookie' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Slide', 'cookie' ),
			'remove_button' => esc_html__( 'Remove Slide', 'cookie' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	
	$videobg_options->add_group_field( $videobg_repeatable, array(
		'name' => esc_html__('Title rotator', 'cookie' ),
		'desc' => esc_html__('check this for text rotator(ticker)', 'cookie' ),
		'id' => 'videobg_title_rotator',
		'type' => 'checkbox',
	) );
	$videobg_options->add_group_field( $videobg_repeatable, array(
		'name'	=> esc_html__('Title rotator Speed', 'cookie' ), 
		'desc'	=> esc_html__('type your title rotator speed in ms.', 'cookie' ), 
		'id'	=> 'videobg_title_rotator_speed', 
		'type'	=> 'text_small',
		'default' => '4000',
	) );
	$videobg_options->add_group_field( $videobg_repeatable, array(
		'name' => esc_html__('Title', 'cookie' ),
		'id' => 'videobg_title',
		'type' => 'text'
	) );
	$videobg_options->add_group_field( $videobg_repeatable, array(
		'name' => esc_html__('Additional Title', 'cookie' ),
		'id' => 'videobg_desc',
		'type' => 'text',
	) );
	$videobg_options->add_group_field( $videobg_repeatable, array( 
		'name'	=> esc_html__('Button 1', 'cookie' ), 
		'desc'	=> esc_html__('button 1 info', 'cookie' ), 
		'id'	=> 'videobg_button1', 
		'type'	=> 'text_small'
	) );
	$videobg_options->add_group_field( $videobg_repeatable, array( 
		'name'	=> esc_html__('Button 1 URL', 'cookie' ), 
		'desc'	=> esc_html__('button href', 'cookie' ), 
		'id'	=> 'videobg_button1_url', 
		'type'	=> 'text_url',
	) );
	
	$videobg_options->add_group_field( $videobg_repeatable, array(
		'name'	=> esc_html__('Button 1 Style', 'cookie' ),
		'id'	=> 'videobg_button1_style',
		'type'	=> 'select',
		'options' => array ( 
			'default' => esc_html__('Default', 'cookie' ), 
			'primary' => esc_html__('Primary', 'cookie' ), 
			'white' => esc_html__('White', 'cookie' ), 
		),
		'default' => 'white'
	) );
	$videobg_options->add_group_field( $videobg_repeatable, array(
		'name'	=> esc_html__('Button 1 Target', 'cookie' ),
		'id'	=> 'videobg_button1_target',
		'type'	=> 'select',
		'options' => array ( 
			'_self' => esc_html__('Same Window', 'cookie' ), 
			'_blank' => esc_html__('New Window', 'cookie' ), 
		),
		'default' => '_self',
	) );
	
	$videobg_options->add_group_field( $videobg_repeatable, array(
		'name'	=> esc_html__('Content Text Alignment', 'cookie' ),
		'id'	=> 'videobg_alignment',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'left' => esc_html__('Left', 'cookie' ), 
			'center' => esc_html__('Center', 'cookie' ), 
			'right' => esc_html__('Right', 'cookie' ), 
		),
		'default'  => 'left'
	) );
	
	$videobg_options->add_group_field( $videobg_repeatable, array(
		'name'	=> esc_html__('Content Vertical Alignment', 'cookie' ),
		'id'	=> 'videobg_vertical_alignment',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'top' => esc_html__('Top', 'cookie' ), 
			'middle' => esc_html__('Middle', 'cookie' ), 
			'bottom' => esc_html__('Bottom', 'cookie' ), 
		),
		'default'  => 'middle'
	) );
	
	$videobg_options->add_field( array(
		'name'	=> esc_html__('Slider Type', 'cookie' ),
		'id'	=> $prefix.'videobg_type',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'1' => esc_html__('Full Height(100%)', 'cookie' ), 
			'2' => esc_html__('Custom Height', 'cookie' ), 
		),
		'default' => '1'
	) );
	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Slider Height', 'cookie' ), 
		'desc'	=> esc_html__('Enter your height in px', 'cookie' ), 
		'id'	=> $prefix.'videobg_height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'videobg_type',
			'data-conditional-value' => '2',
		)
	) );

	$videobg_options->add_field( array(
		'name'	=> esc_html__('Background Video Src', 'cookie' ),
		'id'	=> $prefix.'videobg_src',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'1' => esc_html__('YouTube', 'cookie' ), 
			'2' => esc_html__('Selfhosted', 'cookie' ), 
		),
		'default' => '1'
	) );

	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Video URL', 'cookie' ), 
		'desc'	=> esc_html__('video url only from youtube!!', 'cookie' ), 
		'id'	=> $prefix.'videobg_url', 
		'type'	=> 'text_url',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'videobg_src',
			'data-conditional-value' => '1',
		)
	) );
	
	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Fallback image for mobile & tablets', 'cookie' ), 
		'id'	=> $prefix.'videobg_fallback', 
		'type'	=> 'file',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'videobg_src',
			'data-conditional-value' => '1',
		)
	) );
	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Video URL', 'cookie' ), 
		'desc'	=> esc_html__('Choose the media from your local server', 'cookie' ), 
		'id'	=> $prefix.'videobg_selfhosted_url', 
		'type'	=> 'file',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'videobg_src',
			'data-conditional-value' => '2',
		)
	) );
	
	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Poster URL', 'cookie' ), 
		'desc'	=> esc_html__('This poster will be displayed before video get started', 'cookie' ),
		'id'	=> $prefix.'videobg_selfhosted_poster', 
		'type'	=> 'file',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'videobg_src',
			'data-conditional-value' => '2',
		)
	) );

	$videobg_options->add_field( array(
		'name' => esc_html__('Title Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeIn animation.', 'cookie' ),
		'id' => $prefix.'videobg_title_animation',
		'type' => 'checkbox',
	) );
	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Title Border', 'cookie' ), 
		'desc'	=> esc_html__('Show border around the title', 'cookie' ), 
		'id'	=> $prefix.'videobg_border_title', 
		'type'	=> 'checkbox'
	) );

	$videobg_options->add_field( array(
		'name' => esc_html__('Additional Title Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeInUp animation.', 'cookie' ),
		'id' => $prefix.'videobg_additional_title_animation',
		'type' => 'checkbox',
	) );
	$videobg_options->add_field( array(
		'name' => esc_html__('Divide Line Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeIn animation.', 'cookie' ),
		'id' => $prefix.'videobg_divide_line_animation',
		'type' => 'checkbox',
	) );
	$videobg_options->add_field( array(
		'name' => esc_html__('Buttons Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'cookie' ),
		'id' => $prefix.'videobg_button_animation',
		'type' => 'checkbox',
	) );

	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Title Color', 'cookie' ), 
		'desc'	=> esc_html__('Choose the color for the heading/title', 'cookie' ), 
		'id'	=> $prefix.'videobg_color_title', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0'	
	) );
	
	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Description Color ', 'cookie' ), 
		'desc'	=> esc_html__('choose the description color', 'cookie' ), 
		'id'	=> $prefix.'videobg_color_desc', 
		'type'	=> 'colorpicker'
	) );
	
	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Overlay BG Color', 'cookie' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider!!', 'cookie' ), 
		'id'	=> $prefix.'videobg_overlay', 
		'type'	=> 'colorpicker'
	) );
	
	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Overlay Opacity', 'cookie' ), 
		'desc'	=> esc_html__('Opacity of the video overlay layer!!..', 'cookie' ), 
		'id'	=> $prefix.'videobg_opacity', 
		'type'	=> 'text_small',
	) );

	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow link', 'cookie' ), 
		'desc'	=> esc_html__('to hide Bottom Arrow, keep this field empty', 'cookie' ), 
		'id'	=> $prefix.'videobg_arrowlink', 
		'type'	=> 'text_url',
	) );
	
	$videobg_options->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow Color', 'cookie' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'cookie' ), 
		'id'	=> $prefix.'videobg_arrowlink_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'videobg_arrowlink',
		)		
	) );
	
	// Text Slider
	$textslider_slider_options = new_cmb2_box( array(
		'id'            => $prefix . 'textslider_options',
		'title'         => esc_html__( 'Text Slider', 'cookie' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$textslider_repeatable = $textslider_slider_options->add_field( array(
		'id'          => $prefix . 'textslider_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'cookie' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Slide', 'cookie' ),
			'remove_button' => esc_html__( 'Remove Slide', 'cookie' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Title rotator', 'cookie' ),
		'desc' => esc_html__('check this for text rotator(ticker)', 'cookie' ),
		'id' => 'textslider_title_rotator',
		'type' => 'checkbox',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Title rotator Speed', 'cookie' ), 
		'desc'	=> esc_html__('type your title rotator speed in ms.', 'cookie' ), 
		'id'	=> 'textslider_title_rotator_speed', 
		'type'	=> 'text_small',
		'default' => '4000',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Title', 'cookie' ),
		'desc' => esc_html__('To use it as a text rotator(ticker).. use the delimiter \'|\'', 'cookie' ),
		'id' => 'textslider_title',
		'type' => 'text',
		'sanitization_cb' => false
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Additional Title', 'cookie' ),
		'id' => 'textslider_desc',
		'type' => 'text',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1', 'cookie' ), 
		'desc'	=> esc_html__('button 1 info', 'cookie' ), 
		'id'	=> 'textslider_button1', 
		'type'	=> 'text_small'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1 URL', 'cookie' ), 
		'desc'	=> esc_html__('button href', 'cookie' ), 
		'id'	=> 'textslider_button1_url', 
		'type'	=> 'text_url',
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 1 Style', 'cookie' ),
		'id'	=> 'textslider_button1_style',
		'type'	=> 'select',
		'options' => array ( 
			'default' => esc_html__('Default', 'cookie' ), 
			'primary' => esc_html__('Primary', 'cookie' ), 
			'white' => esc_html__('White', 'cookie' ), 
		),
		'default' => 'white'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 1 Target', 'cookie' ),
		'id'	=> 'textslider_button1_target',
		'type'	=> 'select',
		'options' => array ( 
			'_self' => esc_html__('Same Window', 'cookie' ), 
			'_blank' => esc_html__('New Window', 'cookie' ), 
		),
		'default' => '_self',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2', 'cookie' ), 
		'desc'	=> esc_html__('button 2 info', 'cookie' ), 
		'id'	=> 'textslider_button2', 
		'type'	=> 'text_small'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2 URL', 'cookie' ), 
		'desc'	=> esc_html__('button href', 'cookie' ), 
		'id'	=> 'textslider_button2_url', 
		'type'	=> 'text_url',
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 2 Style', 'cookie' ),
		'id'	=> 'textslider_button2_style',
		'type'	=> 'select',
		'options' => array ( 
			'default' => esc_html__('Default', 'cookie' ), 
			'primary' => esc_html__('Primary', 'cookie' ), 
			'white' => esc_html__('White', 'cookie' ), 
		),
		'default' => 'white'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 2 Target', 'cookie' ),
		'id'	=> 'textslider_button2_target',
		'type'	=> 'select',
		'options' => array ( 
			'_self' => esc_html__('Same Window', 'cookie' ), 
			'_blank' => esc_html__('New Window', 'cookie' ), 
		),
		'default' => '_self',
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Slider Text Alignment', 'cookie' ),
		'id'	=> 'textslider_alignment',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'left' => esc_html__('Left', 'cookie' ), 
			'center' => esc_html__('Center', 'cookie' ), 
			'right' => esc_html__('Right', 'cookie' ), 
		),
		'default'  => 'left'
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Slider content Vertical Alignment', 'cookie' ),
		'id'	=> 'textslider_vertical_alignment',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'top' => esc_html__('Top', 'cookie' ), 
			'middle' => esc_html__('Middle', 'cookie' ), 
			'bottom' => esc_html__('Bottom', 'cookie' ), 
		),
		'default'  => 'middle'
	) );

	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Slider Type', 'cookie' ),
		'id'	=> $prefix.'textslider_type',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'1' => esc_html__('Full Height(100%)', 'cookie' ), 
			'2' => esc_html__('Custom Height', 'cookie' ), 
		),
		'default' => '1'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height', 'cookie' ), 
		'desc'	=> esc_html__('Enter your height in px', 'cookie' ), 
		'id'	=> $prefix.'textslider_height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_type',
			'data-conditional-value' => '2',
		)
	) );

	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Choose the image from your local server', 'cookie' ), 
		'id'	=> $prefix.'textslider_image', 
		'type'	=> 'file',
	) );
	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Title Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeIn animation.', 'cookie' ),
		'id' => $prefix.'textslider_title_animation',
		'type' => 'checkbox',
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Title Border', 'cookie' ), 
		'desc'	=> esc_html__('Show border around the title', 'cookie' ), 
		'id'	=> $prefix.'textslider_border_title', 
		'type'	=> 'checkbox'
	) );

	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Additional Title Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeInUp animation.', 'cookie' ),
		'id' => $prefix.'textslider_additional_title_animation',
		'type' => 'checkbox',
	) );
	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Divide Line Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeIn animation.', 'cookie' ),
		'id' => $prefix.'textslider_divide_line_animation',
		'type' => 'checkbox',
	) );
	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Buttons Animation', 'cookie' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'cookie' ),
		'id' => $prefix.'textslider_button_animation',
		'type' => 'checkbox',
	) );

	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax Starting Value', 'cookie' ), 
		'desc'	=> esc_html__('enter the css property for the slider\'s top at the top of the screen. for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'cookie' ), 
		'id'	=> $prefix.'textslider_parallax_start', 
		'type'	=> 'textarea_small',
	) );
	
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'cookie' ), 
		'desc'	=> esc_html__('enter the css property for the slider\'s bottom when at the top of the screen. for eg.transform:translateY(400px); if don\'t want parallax just leave this empty', 'cookie' ), 
		'id'	=> $prefix.'textslider_parallax_end', 
		'type'	=> 'textarea_small',
	) );
	
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow link', 'cookie' ), 
		'desc'	=> esc_html__('to hide Bottom Arrow, keep this field empty', 'cookie' ), 
		'id'	=> $prefix.'textslider_arrowlink', 
		'type'	=> 'text_url',
	) );

	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow Color', 'cookie' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'cookie' ), 
		'id'	=> $prefix.'textslider_arrowlink_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_arrowlink',
		)	
	) );
	
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Title Color', 'cookie' ), 
		'desc'	=> esc_html__('Choose the color for the heading/title', 'cookie' ), 
		'id'	=> $prefix.'textslider_color_title', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0'	
	) );
	
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Description Color ', 'cookie' ), 
		'desc'	=> esc_html__('choose the description color', 'cookie' ), 
		'id'	=> $prefix.'textslider_color_desc', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0'
	) );
	
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Overlay BG Color', 'cookie' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider!!', 'cookie' ), 
		'id'	=> $prefix.'textslider_color_overlay', 
		'type'	=> 'colorpicker',
		'default' => '#000000'
	) );
	
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Overlay Opacity', 'cookie' ), 
		'desc'	=> esc_html__('type or pick the opacity level of the overlay from 0 to 1..', 'cookie' ), 
		'id'	=> $prefix.'textslider_opacity', 
		'type'	=> 'text_small',
		'default' => '0.6'
	) );

	// Image Slider
	$imageslider_slider_options = new_cmb2_box( array(
		'id'            => $prefix . 'imageslider_options',
		'title'         => esc_html__( 'Image Slider', 'cookie' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$imageslider_repeatable = $imageslider_slider_options->add_field( array(
		'id'          => $prefix . 'imageslider_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'cookie' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Slide', 'cookie' ),
			'remove_button' => esc_html__( 'Remove Slide', 'cookie' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */

	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array(
		'name'	=> esc_html__('Choose the image from your local server', 'cookie' ), 
		'id'	=> 'imageslider_image', 
		'type'	=> 'file',
	) );

	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Slider Type', 'cookie' ),
		'id'	=> $prefix.'imageslider_type',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'1' => esc_html__('Full Height(100%)', 'cookie' ), 
			'2' => esc_html__('Custom Height', 'cookie' ), 
		),
		'default' => '1'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height', 'cookie' ), 
		'desc'	=> esc_html__('Enter your height in px', 'cookie' ), 
		'id'	=> $prefix.'imageslider_height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_type',
			'data-conditional-value' => '2',
		)
	) );
	
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Title', 'cookie' ),
		'desc' => esc_html__('To use it as a text rotator(ticker).. use the delimiter \'|\'', 'cookie' ),
		'id' => $prefix.'imageslider_title',
		'type' => 'text',
		'sanitization_cb' => false
	) );

	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Title rotator', 'cookie' ),
		'desc' => esc_html__('check this for text rotator(ticker)', 'cookie' ),
		'id' => $prefix.'imageslider_title_rotator',
		'type' => 'checkbox',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_title',
		)
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Title rotator Speed', 'cookie' ), 
		'desc'	=> esc_html__('type your title rotator speed in ms.', 'cookie' ), 
		'id'	=> $prefix.'imageslider_title_rotator_speed', 
		'type'	=> 'text_small',
		'default' => '4000',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_title_rotator',
			'data-conditional-value' => '1',
		)
	) );

	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Title Border', 'cookie' ), 
		'desc'	=> esc_html__('Show border around the title', 'cookie' ), 
		'id'	=> $prefix.'imageslider_border_title', 
		'type'	=> 'checkbox',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_title',
		)
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Additional Title', 'cookie' ),
		'id' => $prefix.'imageslider_desc',
		'type' => 'text',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 1', 'cookie' ), 
		'desc'	=> esc_html__('button 1 info', 'cookie' ), 
		'id'	=> $prefix.'imageslider_button1', 
		'type'	=> 'text_small'
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 1 URL', 'cookie' ), 
		'desc'	=> esc_html__('button href', 'cookie' ), 
		'id'	=> $prefix.'imageslider_button1_url', 
		'type'	=> 'text_url',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_button1',
		),
		'default' => '#'
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 1 Style', 'cookie' ),
		'id'	=> $prefix.'imageslider_button1_style',
		'type'	=> 'select',
		'options' => array ( 
			'default' => esc_html__('Default', 'cookie' ), 
			'primary' => esc_html__('Primary', 'cookie' ), 
			'white' => esc_html__('White', 'cookie' ), 
		),
		'default' => 'white',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_button1',
		)
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 1 Target', 'cookie' ),
		'id'	=> $prefix.'imageslider_button1_target',
		'type'	=> 'select',
		'options' => array ( 
			'_self' => esc_html__('Same Window', 'cookie' ), 
			'_blank' => esc_html__('New Window', 'cookie' ), 
		),
		'default' => '_self',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_button1',
		)
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 2', 'cookie' ), 
		'desc'	=> esc_html__('button 2 info', 'cookie' ), 
		'id'	=> $prefix.'imageslider_button2', 
		'type'	=> 'text_small',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 2 URL', 'cookie' ), 
		'desc'	=> esc_html__('button href', 'cookie' ), 
		'id'	=> $prefix.'imageslider_button2_url', 
		'type'	=> 'text_url',
		'default' => 'white',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_button2',
		),
		'default' => '#'
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 2 Style', 'cookie' ),
		'id'	=> $prefix.'imageslider_button2_style',
		'type'	=> 'select',
		'options' => array ( 
			'default' => esc_html__('Default', 'cookie' ), 
			'primary' => esc_html__('Primary', 'cookie' ), 
			'white' => esc_html__('White', 'cookie' ), 
		),
		'default' => 'white',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_button2',
		)
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 2 Target', 'cookie' ),
		'id'	=> $prefix.'imageslider_button2_target',
		'type'	=> 'select',
		'options' => array ( 
			'_self' => esc_html__('Same Window', 'cookie' ), 
			'_blank' => esc_html__('New Window', 'cookie' ), 
		),
		'default' => '_self',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_button2',
		)
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Slider Text Alignment', 'cookie' ),
		'id'	=> $prefix.'imageslider_alignment',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'left' => esc_html__('Left', 'cookie' ), 
			'center' => esc_html__('Center', 'cookie' ), 
			'right' => esc_html__('Right', 'cookie' ), 
		),
		'default'  => 'left'
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Slider content Vertical Alignment', 'cookie' ),
		'id'	=> $prefix.'imageslider_vertical_alignment',
		'type'	=> 'radio_inline',
		'options' => array ( 
			'top' => esc_html__('Top', 'cookie' ), 
			'middle' => esc_html__('Middle', 'cookie' ), 
			'bottom' => esc_html__('Bottom', 'cookie' ), 
		),
		'default'  => 'middle'
	) );

	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax Starting Value', 'cookie' ), 
		'desc'	=> esc_html__('enter the css property for the slider\'s top at the top of the screen. for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'cookie' ), 
		'id'	=> $prefix.'imageslider_parallax_start', 
		'type'	=> 'textarea_small',
	) );
	
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'cookie' ), 
		'desc'	=> esc_html__('enter the css property for the slider\'s bottom when at the top of the screen. for eg.transform:translateY(400px); if don\'t want parallax just leave this empty', 'cookie' ), 
		'id'	=> $prefix.'imageslider_parallax_end', 
		'type'	=> 'textarea_small',
	) );
	
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow link', 'cookie' ), 
		'desc'	=> esc_html__('to hide Bottom Arrow, keep this field empty', 'cookie' ), 
		'id'	=> $prefix.'imageslider_arrowlink', 
		'type'	=> 'text_url',
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow Color', 'cookie' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'cookie' ), 
		'id'	=> $prefix.'imageslider_arrowlink_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_arrowlink',
		)
	) );
	
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Title Color', 'cookie' ), 
		'desc'	=> esc_html__('Choose the color for the heading/title', 'cookie' ), 
		'id'	=> $prefix.'imageslider_color_title', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0'
	) );
	
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Description Color ', 'cookie' ), 
		'desc'	=> esc_html__('choose the description color', 'cookie' ), 
		'id'	=> $prefix.'imageslider_color_desc', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0'
	) );
	
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Overlay BG Color', 'cookie' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider!', 'cookie' ), 
		'id'	=> $prefix.'imageslider_color_overlay', 
		'type'	=> 'colorpicker',
		'default' => '#000000'
	) );
	
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Overlay Opacity', 'cookie' ), 
		'desc'	=> esc_html__('type or pick the opacity level of the overlay from 0 to 1..', 'cookie' ), 
		'id'	=> $prefix.'imageslider_opacity', 
		'type'	=> 'text_small',
		'default' => '0.6'
	) );
	
}


add_action( 'cmb2_init', 'agni_team_member_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_team_member_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'member_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$team_member_option = new_cmb2_box( array(
		'id'            => $prefix . 'team_member',
		'title'         => esc_html__( 'Team Members', 'cookie' ),
		'object_types'  => array( 'team' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );	
		
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Image/photo', 'cookie' ), 
		'id'	=> $prefix.'image_url', 
		'type'	=> 'file',
	) );
	
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Name', 'cookie' ),  
		'id'	=> $prefix.'name', 
		'type'	=> 'text_small',
	) );
	
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Link for Name', 'cookie' ),  
		'id'	=> $prefix.'name_link', 
		'type'	=> 'text_url',
	) );
	
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Designation', 'cookie' ),  
		'id'	=> $prefix.'designation', 
		'type'	=> 'text_small',
	) );
	
	$team_member_option->add_field( array(
		'name'=> esc_html__('Facebook', 'cookie'),
		'desc'  => esc_html__('Facebook link', 'cookie'),
		'id'    => $prefix.'facebooklink',
		'type'  => 'text_url'
	) );
	
	$team_member_option->add_field( array(
		'name'=> esc_html__('Twitter', 'cookie'),
		'id'    => $prefix.'twitterlink',
		'type'  => 'text_url'
	) );
	
	$team_member_option->add_field( array(
		'name'=> esc_html__('Google Plus', 'cookie'),
		'id'    => $prefix.'googlepluslink',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('VK', 'cookie'),
		'id'    => $prefix.'vklink',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('behance', 'cookie'),
		'id'    => $prefix.'behancelink',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('pinterest', 'cookie'),
		'id'    => $prefix.'pinterestlink',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('dribbble', 'cookie'),
		'id'    => $prefix.'dribbblelink',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Skype', 'cookie'),
		'id'    => $prefix.'skypelink',
		'type'  => 'text_small'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Linkedin', 'cookie'),
		'id'    => $prefix.'linkedinlink',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Instagram', 'cookie'),
		'id'    => $prefix.'instagramlink',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Email', 'cookie'),
		'id'    => $prefix.'emailid',
		'type'  => 'text_email'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Phone/Mobile Number', 'cookie'),
		'id'    => $prefix.'number',
		'type'  => 'text_small'
	) );
	
}

add_action( 'cmb2_init', 'agni_clients_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_clients_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'clients_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$clients_option = new_cmb2_box( array(
		'id'            => $prefix . 'clients',
		'title'         => esc_html__( 'Clients', 'cookie' ),
		'object_types'  => array( 'clients' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );	
		
	$clients_option->add_field( array( 
		'name'	=> esc_html__('Image/photo', 'cookie' ), 
		'id'	=> $prefix.'image', 
		'type'	=> 'file',
	) );
	
	$clients_option->add_field( array( 
		'name'	=> esc_html__('Link for Image', 'cookie' ),  
		'id'	=> $prefix.'image_link', 
		'type'	=> 'text_url',
	) );
}
	
add_action( 'cmb2_init', 'agni_testimonials_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_testimonials_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'testimonial_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$testimonials_option = new_cmb2_box( array(
		'id'            => $prefix . 'testimonials',
		'title'         => esc_html__( 'Testimonials', 'cookie' ),
		'object_types'  => array( 'testimonials' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );	
		
	$testimonials_option->add_field( array( 
		'name'	=> esc_html__('Avatar of author', 'cookie' ), 
		'id'	=> $prefix.'image', 
		'type'	=> 'file',
	) );
	
	$testimonials_option->add_field( array(
		'name'=> esc_html__('Testimonial Text', 'cookie'),
		'desc'  => esc_html__('quote said by the author..', 'cookie'),
		'id'    => $prefix.'quote',
		'type'  => 'textarea_small'
	) );
	
	$testimonials_option->add_field( array(
		'name'=> esc_html__('Author Name', 'cookie'),
		'id'    => $prefix.'author',
		'type'  => 'text_small'
	) );
	$testimonials_option->add_field( array(
		'name'=> esc_html__('Author Designation', 'cookie'),
		'id'    => $prefix.'author_designation',
		'type'  => 'text_small'
	) );
}
