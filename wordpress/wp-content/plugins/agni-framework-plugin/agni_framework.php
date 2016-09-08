<?php
/*
Plugin Name: Agni Framework
Plugin URI: http://themeforest.net/user/AgniHD
Description: This is a plugin for Agni Themes.. it includes Custom posttypes, Custom taxonomies, custom shortcodes, 
Version: 1.0.0
Author: AgniDesigns
Author URI: http://themeforest.net/user/AgniHD
Text Domain: agni-framework-plugin
License: GNU General Public License v2 or later
*/

/*
This is custom plugin specifically made for this theme by theme author(AgniDesigns).. its strictly an offense to use this with third party author's theme!.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



if ( ! class_exists( 'AgniFrameworkPlugin' ) && wp_get_theme()->get('Author') == 'AgniDesigns' ) {

    /**
     * Main AgniFrameworkPlugin class
     *
     * @since       1.0.0
     */
    class AgniFrameworkPlugin {

        /**
         * @const       string VERSION The plugin version, used for cache-busting and script file references
         * @since       1.0.0
         */

        const VERSION = '1.0.0';

        /**
         * @access      protected
         * @var         array $options Array of config options, used to check for demo mode
         * @since       1.0.0
         */
        protected $options = array();

        /**
         * Use this value as the text domain when translating strings from this plugin. It should match
         * the Text Domain field set in the plugin header, as well as the directory name of the plugin.
         * Additionally, text domains should only contain letters, number and hypens, not underscores
         * or spaces.
         *
         * @access      protected
         * @var         string $plugin_slug The unique ID (slug) of this plugin
         * @since       1.0.0
         */
        protected $plugin_slug = 'agni-framework-plugin';
		function __construct() {

            // load language files
            load_plugin_textdomain( dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

            // We safely integrate with theme with this hook
			add_action( 'init', array( $this, 'AgniFrameworkCustomFunction' ), 1 );
	 
		}
		
		public function AgniFrameworkCustomFunction() {			
			/* Custom Post Types */
			require_once( 'inc/custom-posttype-taxonomies.php' );

            /* Custom Shortcodes */
            require_once( 'inc/custom-vc-shortcodes.php' );

            /* Custom Redux Framework */
            require_once( 'inc/redux-framework/ReduxCore/framework.php' );

            /* Custom Redux Framework Option panel */
            require_once get_template_directory() . '/template/custom-redux-options.php';

		}
			
		
	}
	// Finally initialize code
	new AgniFrameworkPlugin();
}
