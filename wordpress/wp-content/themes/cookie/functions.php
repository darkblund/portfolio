<?php
/**
 * Agni Framework functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Agni Framework
 */

/**
 * Defining framwork constants
 */
define('AGNI_FRAMEWORK_DIR', 			get_template_directory() );
define('AGNI_FRAMEWORK_URL', 			get_template_directory_uri() );
define('AGNI_FRAMEWORK_CSS_URL', 		AGNI_FRAMEWORK_URL . '/css');
define('AGNI_FRAMEWORK_JS_URL', 		AGNI_FRAMEWORK_URL . '/js');
define('AGNI_THEME_FILES_DIR', 			AGNI_FRAMEWORK_DIR . '/agni' );
define('AGNI_THEME_FILES_URL', 			AGNI_FRAMEWORK_URL . '/agni' );

if ( ! function_exists( 'agni_framework_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function agni_framework_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Agni Framework, use a find and replace
	 * to change 'agni_framework' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cookie', AGNI_FRAMEWORK_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'audio',
		'gallery',
		'link',
		'quote',
		'video',
	) );

	/*
	 * Enable support for WooCommerce.
	 * See http://docs.woothemes.com/documentation/plugins/woocommerce/
	 */
	add_theme_support( 'woocommerce' );

}
endif; // agni_framework_setup
add_action( 'after_setup_theme', 'agni_framework_setup' );

/**
 * Load Custom metabox file CMB2 Conditionals 1.0.4.
 */
function agni_framework_meta_boxes_init() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require AGNI_THEME_FILES_DIR . '/metaboxes/init.php';
    }

	function cmb2_conditionals_load_actions()
	{
		if(!defined('CMB2_LOADED') || false === CMB2_LOADED) {
			return;
		}

		define('CMB2_CONDITIONALS_PRIORITY', 99999);

		add_action('admin_init', 'cmb2_conditionals_hook_data_to_save_filtering', CMB2_CONDITIONALS_PRIORITY);
	}

	/**
 	 * Hooks the filtering of the data being saved.
	 */
	function cmb2_conditionals_hook_data_to_save_filtering()
	{
		$cmb2_boxes = CMB2_Boxes::get_all();

		foreach($cmb2_boxes as $cmb_id => $cmb2_box) {
			add_action("cmb2_{$cmb2_box->object_type()}_process_fields_{$cmb_id}", 'cmb2_conditional_filter_data_to_save', CMB2_CONDITIONALS_PRIORITY, 2);
		}
	}

	/**
	 * Filters the data to remove those values which are not suppose to be enabled to edit according to the declared conditionals.
	 */
	function cmb2_conditional_filter_data_to_save(CMB2 $cmb2, $object_id)
	{
		foreach ( $cmb2->prop( 'fields' ) as $field_args ) {
			if(!(array_key_exists('attributes', $field_args) && array_key_exists('data-conditional-id', $field_args['attributes']))) {
				continue;
			}

			$field_id = $field_args['id'];
			$conditional_id = $field_args['attributes']['data-conditional-id'];

			if(
				array_key_exists('data-conditional-value', $field_args['attributes'])
			) {
				$conditional_value = $field_args['attributes']['data-conditional-value'];

				$conditional_value = ($decoded_conditional_value = @json_decode($conditional_value)) ? $decoded_conditional_value : $conditional_value;

				if(!isset($cmb2->data_to_save[$conditional_id])) {
					unset($cmb2->data_to_save[$field_id]);
					continue;
				}

				if(is_array($conditional_value) && !in_array($cmb2->data_to_save[$conditional_id], $conditional_value)) {
					unset($cmb2->data_to_save[$field_id]);
					continue;
				}

				if(!is_array($conditional_value) && $cmb2->data_to_save[$conditional_id] != $conditional_value) {
					unset($cmb2->data_to_save[$field_id]);
					continue;
				}
			}

			if(!isset($cmb2->data_to_save[$conditional_id]) || !$cmb2->data_to_save[$conditional_id]) {
				unset($cmb2->data_to_save[$field_id]);
				continue;
			}
		}
	}

}
add_action( 'after_setup_theme', 'agni_framework_meta_boxes_init' );

/**
 * Load TGM Plugin action file.
 */
require AGNI_THEME_FILES_DIR . '/tgm/class-tgm-plugin-activation.php';

/**
 * Enqueue scripts and styles for admin.
 */
function agni_cmb2_admin_scripts(){
	wp_deregister_style( 'cmb2-styles' );
	wp_enqueue_style( 'agni-cmb2-css', AGNI_THEME_FILES_URL . '/assets/css/cmb2.css' );

	wp_enqueue_script('cmb2-conditionals', AGNI_THEME_FILES_URL . '/assets/js/cmb2-conditionals.js', array('jquery'), '1.0.2', true);
}
add_action( 'admin_enqueue_scripts', 'agni_cmb2_admin_scripts' );

/**
 * Modifing functions of visual Composer for theme.
 */
function agni_framework_vc_intialization() {	
	// Setting visual composer for theme.
	vc_set_as_theme( true );	

	// Disable Frontend
	//vc_disable_frontend();
	
	// Including custom functions for visual composer.
	require AGNI_FRAMEWORK_DIR . '/template/composer/agni_vc_addons.php';	
	vc_set_shortcodes_templates_dir( AGNI_FRAMEWORK_DIR . '/template/composer/vc_templates/' );
	
	// Removing default templates from the visual composer.
	function agni_framework_vc_templates_removal($data) {
		return array(); 
	}
	add_filter( 'vc_load_default_templates', 'agni_framework_vc_templates_removal' );
}
add_action( 'vc_before_init', 'agni_framework_vc_intialization' );

/**
 * Loading Custom theme functions.
 */
function agni_framework_theme_custom_functions() {

	/**
	 * Custom template tags for this theme.
	 */
	require AGNI_FRAMEWORK_DIR . '/template/template-tags.php';

	// Unique functions for the particular theme
   	require AGNI_FRAMEWORK_DIR . '/template/theme-functions.php';

	// Theme option panel value customizations
   	require AGNI_FRAMEWORK_DIR . '/template/theme-customization.php';

   	// Theme Metabox functions
   	require AGNI_FRAMEWORK_DIR . '/template/custom-metabox-functions.php';

   	// Theme Redux options
   	//require AGNI_FRAMEWORK_DIR . '/template/custom-redux-options.php';

   	// Demo content import options
   	require AGNI_FRAMEWORK_DIR . '/template/custom-demo-import-functions.php';

   	// Woocommerce function for theme.
   	if( class_exists( 'WooCommerce' ) ){
		require AGNI_FRAMEWORK_DIR . '/template/woocommerce/functions.php';	
	}
}
add_action( 'after_setup_theme', 'agni_framework_theme_custom_functions' );
