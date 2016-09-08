<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "cookie_options";
    
    /*
     * Adding redux admin css
     */
    function agni_redux_admin_scripts(){
        wp_dequeue_style( 'redux-admin-css' );
        wp_enqueue_style( 'agni-redux-css', AGNI_THEME_FILES_URL . '/assets/css/redux-admin.css' );
    }
    add_action( "redux/page/{$opt_name}/enqueue", 'agni_redux_admin_scripts' );

    /* 
     * Remove redux menu under the tools 
     */
    function remove_redux_menu() {
        remove_submenu_page('tools.php','redux-about');
    }
    add_action( 'admin_menu', 'remove_redux_menu', 12 );

    /*
     * Adding extension added additionally for demo import
     */

    if(!function_exists('redux_register_custom_extension_loader')) :
        function redux_register_custom_extension_loader($ReduxFramework) {
            //$path = get_template_directory() . '/agni/extensions/';
            $path = ABSPATH . 'wp-content/plugins/agni-framework-plugin/inc/extensions/';
            $folders = scandir( $path, 1 );        
            foreach($folders as $folder) {
                if ($folder === '.' or $folder === '..' or !is_dir($path . $folder) ) {
                    continue;   
                } 
                $extension_class = 'ReduxFramework_Extension_' . $folder;
                if( !class_exists( $extension_class ) ) {
                    // In case you wanted override your override, hah.
                    $class_file = $path . $folder . '/extension_' . $folder . '.php';
                    $class_file = apply_filters( 'redux/extension/'.$ReduxFramework->args['opt_name'].'/'.$folder, $class_file );
                    if( $class_file ) {
                        require_once( $class_file );
                        $extension = new $extension_class( $ReduxFramework );
                    }
                }
            }
        }
        // Modify {$redux_opt_name} to match your opt_name
        add_action("redux/extensions/{$opt_name}/before", 'redux_register_custom_extension_loader', 0);
    endif;

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( get_template_directory() . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( get_template_directory() . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }


    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    
    $args = array(
        'opt_name' => 'cookie_options',
        'use_cdn' => FALSE,
        'display_name' => $theme->get('Name'),
        'display_version' => $theme->get('Version'),
        'page_slug' => 'cookie',
        'page_title' => 'Cookie',
        'update_notice' => TRUE,
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'Cookie',
        'menu_icon' => get_template_directory_uri() . '/img/cookie_options.png',
        'allow_sub_menu' => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'page_priority' => '59',
        'customizer' => FALSE,
        'default_mark' => '*',
        'footer_credit'     => '',
        'hints' => array(
            'icon' => 'el el-bulb',
            'icon_position' => 'right',
            'icon_color' => '#000000',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'transient_time' => '3600',
        'network_sites' => TRUE,
        'dev_mode' => FALSE,
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => esc_html__( 'Documentation', 'cookie' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => esc_html__( 'Support', 'cookie' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => esc_html__( 'Extensions', 'cookie' ),
    );

    // Panel Intro text -> before the form
   
    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'cookie' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'cookie' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'cookie' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'cookie' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( 'This is the sidebar content, HTML is allowed.', 'cookie' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
    
    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Home Settings', 'cookie' ),
        'id'    => 'home-settings',
        'icon'  => 'el el-home'
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'cookie' ),
        'id'         => 'home-general-options',
        'subsection' => true,
        'desc'       => esc_html__( 'The following options will allow you to set body background, logo, etc.', 'cookie' ),
        'fields' => array(
            
            array(
                'id' => 'body-background',
                'type' => 'background',
                'output' => array('body'),
                'title' => esc_html__('Body Background', 'cookie'),
                'subtitle' => esc_html__('Body background with image, color, etc.', 'cookie'),
                //'default' => array( 'background-color' => '#fbfbfb', ),
            ),
            array(
                'id' => 'font-1',
                'type' => 'typography',
                'title' => esc_html__('Font 1', 'cookie'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-size'=>false,
                'line-height'=>false,
                'letter-spacing'=>true, // Defaults to false
                'color'=>false,
                'text-align' => false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('h1, h2, h3, h4, h5, h6,.h1,.h2,.h3,.h4,.h5,.h6, .primary-typo, .vc_tta-title-text'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em', // Defaults to px
                'subtitle' => esc_html__('This options applies to H tags(Heading)', 'cookie'),
                'default' => array(
                    'font-family' => '',
                    'font-backup' => '',
                    'google' => true,),
            ),
            array(
                'id' => 'font-2',
                'type' => 'typography',
                'title' => esc_html__('Font 2', 'cookie'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-size'=>false,
                'line-height'=>false,
                'letter-spacing'=>true, // Defaults to false
                'color'=>false,
                'text-align' => false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('.additional-heading, .additional-type'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em', // Defaults to px
                'subtitle' => esc_html__('This is for all additional heading content.', 'cookie'),
                'default' => array(
                    'font-family' => '',
                    'font-backup' => '',
                    'google' => true,),
            ),
            array(
                'id' => 'font-3',
                'type' => 'typography',
                'title' => esc_html__('Font 3', 'cookie'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-size'=>true,
                'line-height'=>false,
                'letter-spacing'=>true, // Defaults to false
                'color'=>false,
                'text-align' => false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('body, .default-typo'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em', // Defaults to px
                'subtitle' => esc_html__('This is a base font for all body content.', 'cookie'),
                'default' => array(
                    'font-family' => '',
                    'font-backup' => '',
                    'font-size' => '',
                    'google' => true,),
            ),
            array(
                'id' => 'color-1',
                'type' => 'color',
                'transparent' => false,
                'output' => array(  ), 
                'title' => esc_html__('Accent color', 'cookie'),
                'default' => '',
                'validate' => 'color',
                'hint'     => array(
                    'title'   => 'Highlighting Lines',
                    'content' => esc_html__('It applies the color to element borders/lines, heading underlines.', 'cookie'),
                )
            ),
            
            array(
                'id' => 'color-2',
                'type' => 'color',
                'transparent' => false,
                'output' => array(  ),
                'title' => esc_html__('Primary color', 'cookie'),
                'default' => '',
                'validate' => 'color',
                'hint'     => array(
                    'title'   => 'Main color',
                    'content' => esc_html__('It applies the color to H tags & buttons', 'cookie'),
                )
            ),
            array(
                'id' => 'color-3',
                'type' => 'color',
                'transparent' => false,
                'output' => array(  ),
                'title' => esc_html__('Default color', 'cookie'),
                'default' => '',
                'validate' => 'color',
                'hint'     => array(
                    'title'   => 'Body color',
                    'content' => esc_html__('It applies the color to body content & button this is a basic color for all text.', 'cookie'),
                )
            ),

        )

    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Layout', 'cookie' ),
        'id'         => 'home-layout-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can setup site layout options.', 'cookie' ),
        'fields' => array(

            array(
                'id' => 'layout-padding',
                'type' => 'switch',
                'title' => esc_html__('Content Padding/Border', 'cookie'),
                'subtitle' => esc_html__('Enable this to display border/padding around the content/layout of the site.', 'cookie'),
                'default' => '0'
            ),
            array(
                'id'       => 'layout-padding-size',
                'type'     => 'border',
                'required' => array('layout-padding', '=', '1'),
                'title'    => esc_html__( 'Amount of pixels', 'cookie' ),
                'subtitle' => esc_html__( 'It will display the border above & below to the menu items.', 'cookie' ),
                'all'      => true,
                'style' => false,
                // An array of CSS selectors to apply this font style to
                'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'cookie' ),
                'default'  => array(
                    'border-color'  => '#fff',
                    'border-top'    => '30px', 
                    'border-width' => '30px',
                )
            ),

            array(
                'id' => 'layout-container',
                'type' => 'switch',
                'title' => esc_html__('Container Settings', 'cookie'),
                'subtitle' => esc_html__('By Enabling this you can controls the container width on each break point.', 'cookie'),
                'default' => '0'
            ),
            array(
                'id' => 'layout-container-768',
                'type' => 'slider',
                'required' => array('layout-container', '=', '1'),
                'title' => esc_html__('Container Width >768', 'cookie'),
                'desc' => esc_html__('this container width apply when viewport width is more than 768px.', 'cookie'),
                "default" => "750",
                "min" => "500",
                "step" => "5",
                "max" => "750",
            ),
            array(
                'id' => 'layout-container-992',
                'type' => 'slider',
                'required' => array('layout-container', '=', '1'),
                'title' => esc_html__('Container Width >992', 'cookie'),
                "default" => "970",
                "min" => "650",
                "step" => "5",
                "max" => "970",
            ),
            array(
                'id' => 'layout-container-1200',
                'type' => 'slider',
                'required' => array('layout-container', '=', '1'),
                'title' => esc_html__('Container Width >1200', 'cookie'),
                "default" => "1170",
                "min" => "800",
                "step" => "5",
                "max" => "1170",
            ),
            array(
                'id' => 'layout-container-1500',
                'type' => 'slider',
                'required' => array('layout-container', '=', '1'),
                'title' => esc_html__('Container Width >1500', 'cookie'),
                "default" => "1170",
                "min" => "1000",
                "step" => "5",
                "max" => "1470",
            ),
            array(
                'id'             => 'layout-container-padding',
                'type'           => 'spacing',
                'required' => array('layout-container', '=', '1'),
                // An array of CSS selectors to apply this font style to
                'mode'           => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'            => false,
                // Have one field that applies to all
                'top'           => false,     // Disable the top
                'bottom'        => false,     // Disable the bottom
                'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',    // Allow users to select any type of unit
                'title'          => esc_html__( 'Container inner Padding', 'cookie' ),
                'subtitle'       => esc_html__( 'Here, you can set padding to the container.', 'cookie' ),
                'default'        => array(
                    'padding-left'    => '15px',
                    'padding-right' => '15px',
                ),
                'output'         => array( '.container' )
            ),

            array(
                'id' => 'layout-boxed',
                'type' => 'switch',
                'title' => esc_html__('Boxed Layout', 'cookie'),
                'subtitle' => esc_html__('Enable this to display all the content inside the box', 'cookie'),
                'default' => '0'
            ),
            array(
                'id' => 'layout-boxed-768',
                'type' => 'slider',
                'required' => array('layout-boxed', '=', '1'),
                'title' => esc_html__('Box Width >768', 'cookie'),
                'desc' => esc_html__('this container width apply when viewport width is more than 768px.', 'cookie'),
                "default" => "750",
                "min" => "500",
                "step" => "5",
                "max" => "750",
            ),
            array(
                'id' => 'layout-boxed-992',
                'type' => 'slider',
                'required' => array('layout-boxed', '=', '1'),
                'title' => esc_html__('Box Width >992', 'cookie'),
                "default" => "970",
                "min" => "650",
                "step" => "5",
                "max" => "970",
            ),
            array(
                'id' => 'layout-boxed-1200',
                'type' => 'slider',
                'required' => array('layout-boxed', '=', '1'),
                'title' => esc_html__('Box Width >1200', 'cookie'),
                "default" => "1170",
                "min" => "800",
                "step" => "5",
                "max" => "1170",
            ),
            array(
                'id' => 'layout-boxed-1500',
                'type' => 'slider',
                'required' => array('layout-boxed', '=', '1'),
                'title' => esc_html__('Box Width >1500', 'cookie'),
                "default" => "1170",
                "min" => "1000",
                "step" => "5",
                "max" => "1470",
            ),
            array(
                'id' => 'boxed-background-color',
                'type' => 'color',
                'required' => array('layout-boxed', '=', '1'),
                'transparent' => false,
                'mode' => 'background',
                'output' => array( '.boxed' ), 
                'title' => esc_html__('Boxed background color', 'cookie'),
                'default' => '',
                'validate' => 'color',
            ),

        )

    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Additional', 'cookie' ),
        'id'         => 'home-additional-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Some additional options to control preloader, back to top.', 'cookie' ),
        'fields' => array(
            array(
                'id' => 'loader',
                'type' => 'switch',
                'title' => esc_html__('PreLoader', 'cookie'),
                'subtitle' => esc_html__('Just enable this to show the preloader', 'cookie'),
                'default' => '1'
            ),
            array(
                'id' => 'loader-style',
                'type' => 'image_select',
                'required' => array('loader', '=', '1'),
                'title' => esc_html__('PreLoader Style', 'cookie'),
                'options' => array(                            
                    '1' => array('alt' => 'Loader With Percentage', 'img' => get_template_directory_uri(). '/agni/assets/img/preloader-1.png'),
                    '2' => array('alt' => 'Static Loader 1', 'img' => get_template_directory_uri(). '/agni/assets/img/preloader-2.png'),
                    '3' => array('alt' => 'Static Loader 2', 'img' => get_template_directory_uri(). '/agni/assets/img/preloader-3.png'),
                    '4' => array('alt' => 'Static Loader 3', 'img' => get_template_directory_uri(). '/agni/assets/img/preloader-4.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => '1'
            ),
            array(
                'id' => 'loader-color',
                'type' => 'color',
                'required' => array('loader', '=', '1'),
                'transparent' => false,
                'output' => array( '#jpreBar, .cssload-loading, .cssload-loading:after, .cssload-loading:before, .cssload-square-green, .cssload-loader' ), 
                'mode' => 'background',
                'title' => esc_html__('Loader color ', 'cookie'),
                'subtitle' => esc_html__('Pick the title font color..', 'cookie'),
                'default' => '#22e3e5',
                'validate' => 'color',
            ),
            array(
                'id'       => 'loader-close',
                'type'     => 'checkbox',
                'required' => array('loader-style', '=', '1'),
                'title'    => esc_html__( 'Loader Close Button', 'cookie' ),
                'subtitle' => esc_html__( 'Once everything is loaded, It will wait for your command.', 'cookie' ),
                'default'  => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'loader-close-button-text',
                'type' => 'text',
                'required' => array('loader-close', '=', '1'),
                'title' => esc_html__('Loader Close Button', 'cookie'),
                'default' => 'Proceed!',
                'class' => 'text'
            ),
            
            array(
                'id' => 'backtotop',
                'type' => 'switch',
                'title' => esc_html__('Back to top', 'cookie'),
                'subtitle' => esc_html__('Just enable this to show the preloader', 'cookie'),
                'default' => '1'
            ),
            array(
                'id' => 'backtotop-icon',
                'type' => 'text',
                'required' => array('backtotop', '=', '1'),
                'title' => esc_html__('Back to top icon', 'cookie'),
                'subtitle' => esc_html__('type the icon class for eg. ion-ios-arrow-up For more. refer ionicons, fontawesome', 'cookie'),
                'default' => 'ion-ios-arrow-up',
                'class' => 'text'
            ),
            array(
                'id' => 'animation-mobile',
                'type' => 'switch',
                'title' => esc_html__('Animation for mobile devices', 'cookie'),
                'subtitle' => esc_html__('Just enable this to show the animation effects of each sections at mobile', 'cookie'),
                'default' => '0'
            ),
            array(
                'id' => 'parallax-mobile',
                'type' => 'switch',
                'title' => esc_html__('Parallax for mobile devices', 'cookie'),
                'subtitle' => esc_html__('Just enable this to show the parallax effects at mobile', 'cookie'),
                'default' => '0'
            ),
            array(
                'id' => 'gmap-api',
                'type' => 'text',
                'title' => esc_html__('Google Map API key', 'cookie'),
                'subtitle' => esc_html__('you can get the API key from https://developers.google.com/maps/documentation/javascript/get-api-key', 'cookie'),
                'default' => '',
            ),
        )

    ) );


    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Header Settings', 'cookie' ),
        'id'    => 'header-settings',
        'icon'  => 'el el-star'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Basic & Logo', 'cookie' ),
        'id'         => 'header-basic-logo-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Upload your logo/Customize your site title here.', 'cookie' ),
        'fields' => array(
            array(
                'id' => 'header-site-title',
                'type' => 'switch',
                'title' => esc_html__('Site Title', 'cookie'),
                'subtitle' => esc_html__('if you want to display the site title as a logo, just enable this.', 'cookie'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id' => 'logo-1',
                'type' => 'media',
                'required' => array('header-site-title', '=', '0'),
                'title' => esc_html__('Logo 1', 'cookie'),
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'url' => true,
                'subtitle' => esc_html__('This is main logo and will be displayed when you are at the top.', 'cookie'),
                'default'  => array(
                    'url' => get_template_directory_uri() . '/img/cookie_logo_1.png',
                ),
            ),
            array(
                'id' => 'logo-2',
                'type' => 'media',
                'required' => array('header-site-title', '=', '0'),
                'title' => esc_html__('Logo 2(Optional)', 'cookie'),
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'subtitle' => esc_html__('This is additional logo and will override the Logo 1 except at the top. ', 'cookie'),
                'hint'     => array(
                    'title'   => 'Additional Logo',
                    'content' => 'This logo will be useful when you want to use lite logo at top and dark at rest of the place or vice-versa.',
                )
            ),
            array(
                'id' => 'custom-logo-height',
                'type' => 'switch',
                'required' => array('header-site-title', '=', '0'),
                'title' => esc_html__('Custom logo height', 'cookie'),
                'subtitle' => esc_html__('it will help you to increase the logo size.', 'cookie'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Yes',
                'off' => 'No',
            ),
            array(
                'id'            => 'custom-logo-height-value',
                'type'          => 'slider',
                'required' => array('custom-logo-height', '=', '1'),
                'title'         => esc_html__( 'Choose the logo height', 'cookie' ),
                'default'       => 50,
                'min'           => 50,
                'step'          => 2,
                'max'           => 120,
            ),
            array(
                'id'             => 'header-logo-padding',
                'required' => array('header-site-title', '=', '0'),
                'type'           => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'           => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'            => false,
                // Have one field that applies to all
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left
                'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',    // Allow users to select any type of unit
                'title'          => esc_html__( 'Logo Top/Bottom Padding(inner)', 'cookie' ),
                'subtitle'       => esc_html__( 'Here, you can set padding to the logo image. it will add space inside the logo.', 'cookie' ),
                'desc'           => esc_html__( 'Note: it won\'t affect the height of the header', 'cookie' ),
                'default'        => array(
                    'padding-top'    => '0px',
                    'padding-bottom' => '0px',
                ),
                'output'         => array( '.header-icon img' )
            ),
            /*array(
                'id'             => 'header-logo-padding-outer',
                'required' => array('header-site-title', '=', '0'),
                'type'           => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'           => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'            => false,
                // Have one field that applies to all
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left
                'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',    // Allow users to select any type of unit
                'title'          => esc_html__( 'Logo Top/Bottom Padding(Outer)', 'cookie' ),
                'subtitle'       => esc_html__( 'Here, you can set padding to the logo image. it will add space inside the logo.', 'cookie' ),
                'desc'           => esc_html__( 'Note: it won\'t affect the height of the header', 'cookie' ),
                'default'        => array(
                    'padding-top'    => '0px',
                    'padding-bottom' => '0px',
                ),
                'output'         => array( '.header-icon img' )
            ),*/
            array(
                'id' => 'logo-1-font',
                'type' => 'typography',
                'required' => array('header-site-title', '=', '1'),
                'title' => esc_html__('Site Title 1 Font options', 'cookie'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                'font-size'=>false,
                'line-height'=>false,
                'letter-spacing'=>true, // Defaults to false
                'text-align' => false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('.header-icon .logo-text.logo-main'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em',  // Defaults to px
                'subtitle' => esc_html__('if you use the text logo, it will be helpful', 'cookie'),
                'default' => array(
                    'font-style' => '400',
                    'font-family' => 'Lato',
                    'letter-spacing' => '0.02em',
                    'color' => '#000',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'logo-2-font',
                'type' => 'typography',
                'required' => array('header-site-title', '=', '1'),
                'title' => esc_html__('Site Title 2 Font options(optional)', 'cookie'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                'font-size'=>false,
                'line-height'=>false,
                'letter-spacing'=>true, // Defaults to false
                'text-align' => false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('.header-sticky.top-sticky .header-icon .logo-text.logo-additional'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em',  // Defaults to px
                'subtitle' => esc_html__('This is an optional and helpful when you\'re using sticky header.' , 'cookie'),
                'default' => array(
                    'font-style' => '400',
                    'font-family' => 'Lato',
                    'letter-spacing' => '0.02em',
                    'color' => '#000',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'header-menu-style',
                'type' => 'image_select',
                'title' => esc_html__('Header Style', 'cookie'),
                'subtitle' => esc_html__('Choose the header display style.', 'cookie'),
                'options' => array(                            
                    'default' => array('alt' => 'Default', 'img' => get_template_directory_uri(). '/agni/assets/img/header-style-1.png'),
                    'minimal' => array('alt' => 'Minimal', 'img' => get_template_directory_uri(). '/agni/assets/img/header-style-2.png'),
                    'centered-menu' => array('alt' => 'Centered Logo 1(Menu first)', 'img' => get_template_directory_uri(). '/agni/assets/img/header-style-3.png'),
                    'centered-logo' => array('alt' => 'Centered Logo 2(Logo first)', 'img' => get_template_directory_uri(). '/agni/assets/img/header-style-4.png'),
                    'side-header-menu' => array('alt' => 'Sidebar Header Menu', 'img' => get_template_directory_uri(). '/agni/assets/img/header-style-5.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => 'default'
            ),
            array(
                'id'             => 'header-logo-padding-2',
                'type'           => 'spacing',
                'required' => array('header-menu-style', 'contains', 'centered'),
                // An array of CSS selectors to apply this font style to
                'mode'           => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'            => false,
                // Have one field that applies to all
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left
                'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',    // Allow users to select any type of unit
                'title'          => esc_html__( 'Logo Top/Bottom Padding(Outer)', 'cookie' ),
                'subtitle'       => esc_html__( 'Here, you can set padding to the logo image. it will add space outside the logo.', 'cookie' ),
                'output'         => array( '.header-navigation-menu.center-header .header-icon' )
            ),
            array(
                'id'       => 'header-menu-name',
                'type'     => 'text',
                'required' => array('header-menu-style', 'equals', 'minimal'),
                'title'    => esc_html__( 'Minimal Menu Name', 'cookie' ),
                'subtitle' => esc_html__( 'Name/Text to display left to the hamburger icon.', 'cookie' ),
                'default'  => 'Menu',
            ),

            array(
                'id'       => 'header-logo-bg-color-1',
                'type'     => 'color_rgba',
                'required' => array('header-menu-style', 'contains', 'centered'),
                'title'    => esc_html__( 'Header Logo Background color', 'cookie' ),
                'subtitle' => esc_html__( 'Main Logo background color. You can even set the Transparency to the background color at the top.', 'cookie' ),
                'default'  => array(
                    'color' => '#f6f7f8',
                    'alpha' => '1'
                ),
                'output'   => array( '.center-header .header-icon, .reverse_skin.header-sticky.top-sticky.center-header .header-icon.header-logo-additional-bg-color' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id'       => 'header-logo-bg-color-2',
                'type'     => 'color_rgba',
                'required' => array('header-menu-style', 'contains', 'centered'),
                'title'    => esc_html__( 'Header Logo Background color 2(Optional)', 'cookie' ),
                'subtitle' => esc_html__( 'background color except at the top.', 'cookie' ),
                'output'   => array( '.header-sticky.top-sticky.center-header .header-icon.header-logo-additional-bg-color, .reverse_skin.center-header .header-icon' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'cookie' ),
        'id'         => 'header-general-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can customize header style, size, icons etc.', 'cookie' ),
        'fields' => array(
            
            array(
                'id' => 'header-sticky',
                'type' => 'switch',
                'required' => array('layout-boxed', '!=', '1'),
                'title' => esc_html__('Sticky Header', 'cookie'),
                'subtitle' => esc_html__('Disable sticky header by turning off', 'cookie'),
                "default" => 1,
            ),

            array(
                'id' => 'header-bg-transparent',
                'type' => 'checkbox',
                'title' => esc_html__('Transparent Header', 'cookie'),
                'subtitle' => esc_html__( 'This option make whole header background transparent completely. And this will not affect the sticky header(if enabled).', 'cookie' ),
                'desc' => esc_html__( 'This option can be overwritten by each page\'s Page option.', 'cookie' ),
                'default' => 0, // 1 = on | 0 = off
            ),
            array(
                'id' => 'shrink-header-menu',
                'type' => 'checkbox',
                'required' => array( 'header-menu-style', '!=', 'side-header-menu' ),
                'title' => esc_html__('Shrink Header', 'cookie'),
                'subtitle' => esc_html__( 'This option is used to reduce the height of the menu to 60px.', 'cookie' ),
                'default' => 0, // 1 = on | 0 = off
            ),
            array(
                'id' => 'fullwidth-header-menu',
                'type' => 'checkbox',
                'required' => array( 'header-menu-style', '!=', 'side-header-menu' ),
                'title' => esc_html__('Fullwidth Header', 'cookie'),
                'default' => 0, // 1 = on | 0 = off
            ),
            array(
                'id' => 'header-search-box',
                'type' => 'switch',
                'title' => esc_html__('Search Box', 'cookie'),
                'default' => 1, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'header-search-box-text',
                'type'     => 'text',
                'required' => array('header-search-box', '=', '1'),
                'title'    => esc_html__( 'Search Box Placeholder Text', 'cookie' ),
                'subtitle' => esc_html__( 'This text will be displayed inside the search input.', 'cookie' ),
                'default'  => 'Type & Hit Enter',
            ),
            array(
                'id' => 'header-lang-box',
                'type' => 'switch',
                'title' => esc_html__('Language Boxes', 'cookie'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'header-lang-name',
                'type'     => 'text',
                'required' => array('header-lang-box', '=', '1'),
                'title'    => esc_html__( 'Language Menu Name', 'cookie' ),
                'subtitle' => esc_html__( 'Name to display inside the language menu in the header. You also can display the icon by placing the html tag.', 'cookie' ),
                'desc' => esc_html__( ' for icon ref. http://fortawesome.github.io/Font-Awesome/icons/', 'cookie' ),
                'default'  => '<i class="fa fa-language"></i>',
            ),
            array(
                'id'       => 'header-lang-list',
                'type'     => 'editor',
                'required' => array('header-lang-box', '=', '1'),
                'title'    => esc_html__('Language List', 'cookie'),
                'subtitle' => esc_html__('To give your own langauage link, just go to text mode and replace \'#\' with your link.', 'cookie'),
                'default'  => '<ul><li><a href="#">EN</a></li><li><a href="#">TA</a></li><li><a href="#">ES</a></li></ul>',
                'args'   => array(
                    'wpautop'   => false,
                    'media_buttons'=> false,
                )
            ),
            array(
                'id' => 'header-wpml-box',
                'type' => 'switch',
                //'required' => array('header-lang-box', '=', '1'),
                'title' => esc_html__('WPML Language Switch', 'cookie'),
                'subtitle' => esc_html__( 'It will work only when you have WPML plugin activated', 'cookie' ),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'ON',
                'off' => 'OFF',
            ),
            array(
                'id' => 'header-cart-box',
                'type' => 'switch',
                'title' => esc_html__('Shopping Cart Box', 'cookie'),
                'subtitle' => esc_html__('It will work only when Woocommerce is activated.', 'cookie'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id' => 'header-cart-amount',
                'type' => 'checkbox',
                'required' => array( 'header-cart-box', '=', '1' ),
                'title' => esc_html__('Cart Amount', 'cookie'),
                'default' => 1, // 1 = on | 0 = off
            ),
            array(
                'id'       => 'header-icon-link-color-1',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Header Icons Color 1', 'cookie' ),
                'subtitle' => esc_html__( 'This is main color for regular & hover icons links.', 'cookie' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#555555',
                    'hover'   => '#22e3e5',
                ),
            ),
            array(
                'id'       => 'header-icon-link-color-2',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Header Icons Color 2(Optional)', 'cookie' ),
                'subtitle' => esc_html__( 'It will override the Header Icons Color 1 except at the top.', 'cookie' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '',
                    'hover'   => '',
                ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Top Bar', 'cookie' ),
        'id'         => 'header-top-bar-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can customize header topbar and topbar\'s menu.', 'cookie' ),
        'fields' => array(
            array(
                'id' => 'header-top-bar',
                'type' => 'switch',
                'required' => array( 'header-menu-style', '!=', 'side-header-menu' ),
                'title' => esc_html__('Top Bar', 'cookie'),
                'subtitle' => esc_html__('This is top bar which is shown above to the header menu.', 'cookie'),
                'desc' => esc_html__('Note: This bar will be hidden on mobile devices.', 'cookie'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'id'       => 'header-top-email',
                'type'     => 'text',
                'required' => array('header-top-bar', '=', '1'),
                'title'    => esc_html__( 'Email Address', 'cookie' ),
                'default'  => 'yourmail@mail.com',
            ),array(
                'id'       => 'header-top-number',
                'type'     => 'text',
                'required' => array('header-top-bar', '=', '1'),
                'title'    => esc_html__( 'Contact number', 'cookie' ),
                'default'  => '(000) 000-0000',
            ),
            array(
                'id'       => 'header-top-color',
                'type'     => 'color',
                'required' => array('header-top-bar', '=', '1'),
                'title'    => esc_html__( 'Top bar Color', 'cookie' ),
                'default'  => '#555',
                'output'   => array( '.header-top-bar' ),
            ),
            array(
                'id' => 'top-bar-nav',
                'type' => 'checkbox',
                'required' => array('header-top-bar', '=', '1'),
                'title' => esc_html__('Top Bar Menu', 'cookie'),
                'default' => 0, // 1 = on | 0 = off
            ),
            array(
                'id'       => 'header-top-menu-color',
                'type'     => 'link_color',
                'required' => array('top-bar-nav', '=', '1'),
                'title'    => esc_html__( 'Top Bar Menu Links Color', 'cookie' ),
                'subtitle' => esc_html__( 'Just choose you color for regular & hover links. its applicable only on menu items.', 'cookie' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#999',
                    'hover'   => '#22e3e5',
                ),
                'output'   => array( '.top-nav-menu a' ),
            ),
            
            array(
                'id'       => 'header-top-bg-color',
                'type'     => 'color_rgba',
                'required' => array('header-top-bar', '=', '1'),
                'title'    => esc_html__( 'Header Top Bar Background color', 'cookie' ),
                'subtitle' => esc_html__( 'You can even set the Transparency to the background color.', 'cookie' ),
                'default'  => array(
                    'color' => '#f6f7f8',
                    'alpha' => '1'
                ),
                'output'   => array( '.header-top-bar' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Menu', 'cookie' ),
        'id'         => 'header-menu-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can change menu items color, font, etc.', 'cookie' ),
        'fields' => array(
            array(
                'id'       => 'header-menu-bg-color-1',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Menu Background color', 'cookie' ),
                'subtitle' => esc_html__( 'Main Menu background color. You can even set the Transparency to the background color at the top.', 'cookie' ),
                'default'  => array(
                    'color' => '#f6f7f8',
                    'alpha' => '1'
                ),
                'output'   => array( '.header-navigation-menu, .nav-menu-content .sub-menu, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-additional-bg-color:not(.side-header-menu), .tab-nav-menu' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id'       => 'header-menu-bg-color-2',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Menu Background color 2(Optional)', 'cookie' ),
                'subtitle' => esc_html__( 'background color except at the top.', 'cookie' ),
                'output'   => array( '.header-sticky.top-sticky.header-navigation-menu.header-additional-bg-color:not(.side-header-menu), .reverse_skin.header-navigation-menu' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id' => 'header-font',
                'type' => 'typography',
                'title' => esc_html__('Header Menu font options', 'cookie'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                'font-size'=>false,
                'line-height'=>false,
                'letter-spacing'=>true, // Defaults to false
                'text-align' => false,
                'color'=>false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('.nav-menu a, .tab-nav-menu a'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em',  // Defaults to px
                'subtitle' => esc_html__('if you use the text logo, it will be helpful', 'cookie'),
                'default' => array(
                    'font-style' => '400',
                    'font-family' => 'Lato',
                    'letter-spacing' => '0.02em',
                    'google' => true,
                ),
            ),
            array(
                'id'       => 'header-menu-link-color-1',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Header Menu Links Color', 'cookie' ),
                'subtitle' => esc_html__( 'Main menu color for regular & hover links. it will be applied at the top.', 'cookie' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#22e3e5',
                ),
                'output'   => array( '.nav-menu a', '.nav-menu-content li a', '.tab-nav-menu a', '.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .nav-menu.nav-menu-additional-color .nav-menu-content > li > a' ),
            ),
            array(
                'id'       => 'header-menu-link-color-2',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Header Menu Links Color 2(Optional)', 'cookie' ),
                'subtitle' => esc_html__( 'Menu link color except at the top.', 'cookie' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '',
                    'hover'   => '',
                ),
                'output'   => array( '.header-sticky.top-sticky:not(.side-header-menu) .nav-menu.nav-menu-additional-color .nav-menu-content > li > a', '.reverse_skin .nav-menu-content > li > a' ),
            ),
            array(
                'id'       => 'header-menu-border-1',
                'type'     => 'border',
                'title'    => esc_html__( 'Header Menu Border', 'cookie' ),
                'subtitle' => esc_html__( 'Main border above & below to the menu items at the top.', 'cookie' ),
                'all'      => false,
                'left'      => false,
                'right'      => false,
                'color'     => false,
                // An array of CSS selectors to apply this font style to
                'default'  => array(
                    'border-style'  => 'solid',
                    'border-top'    => '0px',
                    'border-bottom' => '0px'
                )
            ), 
            array(
                'id'       => 'header-menu-border-color-1',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Menu Border Color', 'cookie' ),
                'subtitle' => esc_html__( 'Main border color above & below to the menu items at the top.', 'cookie' ),
                'output'   => array( '.header-navigation-menu .header-menu-content, .side-header-menu .tab-nav-menu, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .reverse_skin.header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu' ),
                'mode'  => 'border-color',
                'validate' => 'colorrgba',
            ), 
            array(
                'id'       => 'header-menu-border-2',
                'type'     => 'border',
                'title'    => esc_html__( 'Header Menu Border 2(Optional)', 'cookie' ),
                'subtitle' => esc_html__( 'Optional border above & below to the menu items except at the top.', 'cookie' ),
                'all'      => false,
                'left'      => false,
                'right'      => false,
                'color'     => false,
                'default'  => array(
                    'border-style'  => '',
                    'border-top'    => '',
                    'border-bottom' => ''
                )
            ),  
            array(
                'id'       => 'header-menu-border-color-2',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Menu Border Color 2(Optional)', 'cookie' ),
                'subtitle' => esc_html__( 'Main border color above & below to the menu items except at the top.', 'cookie' ),
                'output'   => array( '.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu, .reverse_skin.header-navigation-menu .header-menu-content, .reverse_skin.side-header-menu .tab-nav-menu' ),
                'mode'  => 'border-color',
                'validate' => 'colorrgba',
            ),    
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Media', 'cookie' ),
        'id'         => 'header-social-media-icons',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can enable/disable, sort the social media icons for header.', 'cookie' ),
        'fields' => array(
            array(
                'id' => 'social-media-header',
                'type' => 'switch',
                'title' => esc_html__('Social Media Icons', 'cookie'),
                'subtitle' => esc_html__('enable this to show the list of social media icons', 'cookie'),
                "default" => 1,
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id' => 'social-media-header-style',
                'required' => array('social-media-header', '=', '1'),
                'type' => 'select',
                'title' => esc_html__('Social Icons Style', 'cookie'),
                'subtitle' => esc_html__('You can display the social icons in two way. One is default(sequence of icons) another one is dropdown style.', 'cookie'),
                'options' => array(
                    'default' => 'Default', 
                    'minimal' => 'Dropdown(minimal)',
                ), //Must provide key => value pairs for select options
                'default' => 'default'
            ),
            array(
                'id' => 'social-media-header-location',
                'required' => array('social-media-header', '=', '1'),
                'type'     => 'radio',
                'title'    => esc_html__( 'Location', 'cookie' ),
                'subtitle' => esc_html__( 'Here, You can set the place where you want to display the social media icons', 'cookie' ),
                'desc'     => esc_html__( 'Note : Top Menu option only work when you enabled Top Bar.', 'cookie' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Default(Header menu)',
                    '2' => 'at Top Bar',
                ),
                'default'  => '1'
            ),
            array(
                'id' => 'header-link-target',
                'required' => array('social-media-header', '=', '1'),
                'type' => 'select',
                'title' => esc_html__('Link target', 'cookie'),
                'subtitle' => esc_html__('Choose the target of the link on click.', 'cookie'),
                'options' => array(
                    '_self' => 'Same window', 
                    '_blank' => 'New window',
                ), //Must provide key => value pairs for select options
                'default' => '_self'
            ),
            array(
                'id'       => 'social-media-icons-header',
                'type'     => 'sortable',
                'required' => array('social-media-header', '=', '1'),
                'mode'     => 'checkbox', // checkbox or text
                'title'    => esc_html__( 'Choose your icons', 'cookie' ),
                'subtitle' => esc_html__( 'Enable the Social icon which you want to display in header', 'cookie' ),
                'options'  => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'google-plus' => 'Google Plus',
                    'bitbucket' => 'BitBucket',
                    'behance' => 'Behance',
                    'dribbble' => 'Dribbble',
                    'flickr' => 'Flickr',
                    'github' => 'GitHub',
                    'instagram' => 'instagram',
                    'linkedin' => 'Linkedin',
                    'pinterest' => 'Pinterest',
                    'reddit' => 'Reddit',
                    'soundcloud' => 'SoundCloud',
                    'skype' => 'Skype',
                    'stack-overflow' => 'StackOverflow',
                    'tumblr' => 'Tumblr',
                    'vimeo' => 'Vimeo',
                    'vk' => 'VK',
                    'weibo' => 'Weibo',
                    'whatsapp' => 'WhatsApp',
                    'youtube' => 'YouTube',
                ),
                'default'  => array(
                    'facebook' => true,
                    'twitter' => true,
                    'google-plus' => false,
                    'bitbucket' => false,
                    'behance' => false,
                    'dribbble' => true,
                    'flickr' => false,
                    'github' => false,
                    'instagram' => false,
                    'linkedin' => false,
                    'pinterest' => false,
                    'reddit' => false,
                    'soundcloud' => false,
                    'skype' => false,
                    'stack-overflow' => false,
                    'tumblr' => false,
                    'vimeo' => false,
                    'vk' => false,
                    'weibo' => false,
                    'whatsapp' => false,
                    'youtube' => false,
                )
            ),       
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Footer Settings', 'cookie' ),
        'id'    => 'footer-settings',
        'icon'  => 'el el-tint'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General & Colophon', 'cookie' ),
        'id'         => 'footer-general-options',
        'subsection' => true,
        'desc'       => esc_html__( 'This option allows you to change footer colophon text, color, etc.', 'cookie' ),
        'fields' => array(

            array(
                'id' => 'footer-style',
                'type' => 'select',
                'title' => esc_html__('Footer Style', 'cookie'),
                'subtitle' => esc_html__('Choose the any of the one footer style.', 'cookie'),
                'options' => array(
                    'style-1' => 'Style 1', 
                    'style-2' => 'Style 2',
                ), //Must provide key => value pairs for select options
                'default' => 'style-1'
            ),
            array(
                'id'       => 'footer-colophon-bg-color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Footer Colophon Background color', 'cookie' ),
                'subtitle' => esc_html__( 'You can even set the Transparency to the background color.', 'cookie' ),
                'default'  => array(
                    'color' => '#f6f7f8',
                    'alpha' => '1'
                ),
                'output'   => array( '.site-footer' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id' => 'footer-logo',
                'type' => 'media',
                'title' => esc_html__('Footer Logo', 'cookie'),
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                //'desc' => esc_html__('Basic media uploader with disabled URL input field.', 'cookie'),
                'url' => true,
                'subtitle' => esc_html__('Here, you can upload logo to display in the footer.', 'cookie'),
            ),
            array(
                'id'             => 'footer-logo-padding',
                'type'           => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'           => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'            => false,
                // Have one field that applies to all
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left
                'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',    // Allow users to select any type of unit
                'title'          => esc_html__( 'Logo Top/Bottom inner Padding', 'cookie' ),
                'subtitle'       => esc_html__( 'Here, you can set padding to the logo image. it will add space inside the logo.', 'cookie' ),
                'desc'           => esc_html__( 'Note: it won\'t affect the height of the footer', 'cookie' ),
                'default'        => array(
                    'padding-top'    => '0px',
                    'padding-bottom' => '0px',
                ),
                'output'         => array( '.footer-logo img' )
            ),
            array(
                'id' => 'footer-text',
                'type' => 'editor',
                'title' => esc_html__('Footer Text', 'cookie'),
                'subtitle' => esc_html__('you can type your footer text/content here..', 'cookie'),
                'default' => 'Copyright &copy; 2015 All Rights Reserved. ',
                'args'   => array(
                    'media_buttons'    => false,
                    'textarea_rows'    => 3,
                    'teeny'     => false
                )

            ),
            array(
                'id' => 'footer-nav',
                'type' => 'checkbox',
                'title' => esc_html__('Footer Menu', 'cookie'),
                'default' => 1, // 1 = on | 0 = off
            ),
            array(
                'id'       => 'footer-menu-link-color',
                'type'     => 'link_color',
                'required' => array('footer-nav', '=', '1'),
                'title'    => esc_html__( 'Footer Menu Links Color', 'cookie' ),
                'subtitle' => esc_html__( 'Just choose you color for regular & hover links. its applicable only on menu items.', 'cookie' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#555',
                    'hover'   => '#22e3e5',
                ),
                'output'   => array( '.footer-nav-menu a' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Widget bar', 'cookie' ),
        'id'         => 'footer-widget-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can control the widget bar inside the footer.', 'cookie' ),
        'fields' => array(
            array(
                'id' => 'footer-widget',
                'type' => 'switch',
                'title' => esc_html__('Footer Widget bar', 'cookie'),
                'subtitle' => esc_html__('Disable footer widget by turning off', 'cookie'),
                "default" => 0,
            ),
            array(
                'id' => 'footer-col',
                'type' => 'select',
                'required' => array('footer-widget', '=', '1'),
                'title' => esc_html__('Footer Widget Columns', 'cookie'),
                'options' => array(
                    '4' => '3 Columns', 
                    '3' => '4 Columns',
                ), //Must provide key => value pairs for select options
                'default' => '4'
            ),
            array(
                'id' => 'footer-background',
                'type' => 'background',
                'required' => array('footer-widget', '=', '1'),
                'output' => array('.footer-bar-bg'),
                'title' => esc_html__('Footer Bar background', 'cookie'),
                'subtitle' => esc_html__('Pick the background color/image for header ', 'cookie'),
                'default' => array( 'background-color' => '#f6f7f8', ),
            ), 
            
            array(
                'id' => 'footerbar-color-1',
                'type' => 'color',
                'required' => array('footer-widget', '=', '1'),
                'transparent' => false,
                'output' => array( '.footer-bar .widget-title' ), 
                'title' => esc_html__('Title color ', 'cookie'),
                'subtitle' => esc_html__('Pick the title font color..', 'cookie'),
                'default' => '#000000',
                'validate' => 'color',
            ),
            array(
                'id' => 'footerbar-color-2',
                'type' => 'color',
                'required' => array('footer-widget', '=', '1'),
                'transparent' => false,
                'output' => array( '.footer-bar .widget, .footer-bar .widget i' ), 
                'title' => esc_html__('Text color ', 'cookie'),
                'subtitle' => esc_html__('Pick the text font color..', 'cookie'),
                'default' => '#555555',
                'validate' => 'color',
            ),
            array(
                'id'       => 'footerbar-color-3',
                'type'     => 'link_color',
                'required' => array('footer-widget', '=', '1'),
                'title'    => esc_html__( 'Links Color', 'cookie' ),
                'subtitle' => esc_html__( 'Just choose you color for regular & hover links.', 'cookie' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#000000',
                ),
                'output'   => array( '.footer-bar .widget a' ),
            ),
            array(
                'id' => 'footerbar-color-4',
                'type' => 'border',
                'required' => array('footer-widget', '=', '1'),
                'all' => false,
                'left' => false,
                'right' => false,
                'top' => false,
                'bottom' => false,
                'color' => true,
                'style' => false,
                'title' => esc_html__('Title Underline color ', 'cookie'),
                'subtitle' => esc_html__('Pick the title underline font color..', 'cookie'),
                'output' => array( '.footer-bar .widget-title:after' ), 
                'default' => array(
                    'border-color'  => '#d5d5d5', 
                ),
                'validate' => 'color',
            ),
        )
    ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Media', 'cookie' ),
        'id'         => 'footer-social-media-icons',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can enable/disable, sort the social media icons in footer.', 'cookie' ),
        'fields' => array(
            array(
                'id' => 'social-media-footer',
                'type' => 'switch',
                'title' => esc_html__('Social Media Icons', 'cookie'),
                'subtitle' => esc_html__('enable this to show the list of social media icons to display in the footer', 'cookie'),
                "default" => 1,
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id' => 'social-media-style',
                'type' => 'select',
                'required' => array('social-media-footer', '=', '1'),
                'title' => esc_html__('Social Media Icons Style', 'cookie'),
                'options' => array(
                    'no-circled' => 'Default', 
                    'circled' => 'Circled',
                ), //Must provide key => value pairs for select options
                'default' => 'no-circled'
            ),
            array(
                'id'       => 'footer-social-link-color',
                'type'     => 'link_color',
                'required' => array('social-media-footer', '=', '1'),
                'title'    => esc_html__( 'Footer Social Links Color', 'cookie' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#000',
                    'hover'   => '#22e3e5',
                ),
            ),
            array(
                'id' => 'footer-link-target',
                'required' => array('social-media-footer', '=', '1'),
                'type' => 'select',
                'title' => esc_html__('Link target', 'cookie'),
                'subtitle' => esc_html__('Choose the target of the icon when clicked.', 'cookie'),
                'options' => array(
                    '_self' => 'Same window', 
                    '_blank' => 'New window',
                ), //Must provide key => value pairs for select options
                'default' => '_self'
            ),
            array(
                'id'       => 'social-media-icons-footer',
                'type'     => 'sortable',
                'required' => array('social-media-footer', '=', '1'),
                'mode'     => 'checkbox', // checkbox or text
                'title'    => esc_html__( 'Choose your icons', 'cookie' ),
                'subtitle' => esc_html__( 'Enable the Social icon which you want to display in footer', 'cookie' ),
                'options'  => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'google-plus' => 'Google Plus',
                    'bitbucket' => 'BitBucket',
                    'behance' => 'Behance',
                    'dribbble' => 'Dribbble',
                    'flickr' => 'Flickr',
                    'github' => 'GitHub',
                    'instagram' => 'instagram',
                    'linkedin' => 'Linkedin',
                    'pinterest' => 'Pinterest',
                    'reddit' => 'Reddit',
                    'soundcloud' => 'SoundCloud',
                    'skype' => 'Skype',
                    'stack-overflow' => 'StackOverflow',
                    'tumblr' => 'Tumblr',
                    'vimeo' => 'Vimeo',
                    'vk' => 'VK',
                    'weibo' => 'Weibo',
                    'whatsapp' => 'WhatsApp',
                    'youtube' => 'YouTube',
                ),
                'default'  => array(
                    'facebook' => true,
                    'twitter' => true,
                    'google-plus' => false,
                    'bitbucket' => false,
                    'behance' => false,
                    'dribbble' => true,
                    'flickr' => false,
                    'github' => false,
                    'instagram' => false,
                    'linkedin' => false,
                    'pinterest' => false,
                    'reddit' => false,
                    'soundcloud' => false,
                    'skype' => false,
                    'stack-overflow' => false,
                    'tumblr' => false,
                    'vimeo' => false,
                    'vk' => false,
                    'weibo' => false,
                    'whatsapp' => false,
                    'youtube' => false,
                )
            ),       
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Blog Settings', 'cookie' ),
        'id'    => 'blog-settings',
        'icon'  => 'el el-bookmark'
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'cookie' ),
        'id'         => 'blog-general-options',
        'subsection' => true,
        'desc'       => esc_html__( 'This allows you setup the blog layout, sidebar, etc.', 'cookie' ),
        'fields' => array(
            
            array(
                'id' => 'blog-layout',
                'type' => 'select',
                'title' => esc_html__('Blog Layout', 'cookie'),
                'options' => array(
                    'standard' => 'Standard', 
                    'grid' => 'Grid',
                    'standard-grid' => 'First Standard rest Grid',
                    'modern' => 'Modern',
                ), //Must provide key => value pairs for select options
                'default' => 'standard'
            ),

            array(
                'id'       => 'blog-grid-layout',
                'type'     => 'radio',
                'required' => array('blog-layout', '!=', 'standard'),
                'title'    => esc_html__( 'Blog Grid Style', 'cookie' ),
                'subtitle' => esc_html__( 'Choose any of one grid style. fitRows is default.', 'cookie' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'fitRows' => 'FitRows(Default Grid)',
                    'masonry' => 'Masonry',
                ),
                'default'  => 'fitRows'
            ),
            array(
                'id' => 'blog-sidebar',
                'type'     => 'radio',
                'title' => esc_html__('Blog Sidebar', 'cookie'),
                'options' => array(
                    'no-sidebar' => 'No Sidebar', 
                    'has-sidebar' => 'Right Sidebar',
                    'has-sidebar left' => 'Left Sidebar',
                ), //Must provide key => value pairs for select options
                'default' => 'has-sidebar'
            ),

            array(
                'id' => 'archive-layout',
                'type' => 'select',
                'title' => esc_html__('Archive Layout', 'cookie'),
                'options' => array(
                    'standard' => 'Standard', 
                    'grid' => 'Grid',
                    'standard-grid' => 'First Starndard rest Grid',
                    'modern' => 'Modern',
                ), //Must provide key => value pairs for select options
                'default' => 'standard'
            ),
            array(
                'id' => 'archive-sidebar',
                'type'     => 'radio',
                'title' => esc_html__('Archive Sidebar', 'cookie'),
                'options' => array(
                    'no-sidebar' => 'No Sidebar', 
                    'has-sidebar' => 'Right Sidebar',
                    'has-sidebar left' => 'Left Sidebar',
                ), //Must provide key => value pairs for select options
                'default' => 'has-sidebar'
            ),
            array(
                'id'       => 'blog-navigation',
                'type'     => 'radio',
                'title'    => esc_html__( 'Blog Navigation Style', 'cookie' ),
                'subtitle' => esc_html__( 'Choose any of one navigation style to display on the blog page.', 'cookie' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Classic',
                    '2' => 'Number',
                    '3' => 'Infinite',
                    '4' => 'Infinite with Load More',
                ),
                'default'  => '1'
            ),
            array(
                'id' => 'author-biography',
                'type' => 'switch',
                'title' => esc_html__('Author Biography', 'cookie'),
                'subtitle' => esc_html__('It enables the author biography on each post.', 'cookie'),
                "default" => 0,
                'on' => 'Enable',
                'off' => 'Disable',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Carousel', 'cookie' ),
        'id'         => 'blog-carousel-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can customize the carousel of the blog page', 'cookie' ),
        'fields' => array(
            array(
                'id' => 'blog-posts-carousel',
                'type' => 'switch',
                'title' => esc_html__('Blog Posts Carousel', 'cookie'),
                'subtitle' => esc_html__('This option enable the carousel at the top of the latest posts page.', 'cookie'),
                'default' => 1, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'blog-posts-carousel-categories',
                'type'     => 'select',
                'multi'    => true,
                'required' => array('blog-posts-carousel', '=', '1'),
                'data'     => 'categories',
                'title'    => esc_html__( 'Choose the categories to display', 'cookie' ),
                'subtitle' => esc_html__( 'You can select multiple categories.', 'cookie' ),
            ),
            array(
                'id'       => 'blog-posts-per-carousel',
                'type'     => 'text',
                'required' => array('blog-posts-carousel', '=', '1'),
                'title'    => esc_html__( 'Number of Posts to display', 'cookie' ),
                'subtitle' => esc_html__( 'Note: Posts which are doesn\'t have the thumbnail will be ignored.', 'cookie' ),
                'validate' => 'numeric',
                'default'  => '6',
            ),
            array(
                'id'            => 'blog-posts-thumbnail-opacity',
                'type'          => 'slider',
                'required' => array('blog-posts-carousel', '=', '1'),
                'title'         => esc_html__( 'Carousel Posts Overlay Opacity', 'cookie' ),
                'subtitle'      => esc_html__( 'Set the overlay opacity values for each post.', 'cookie' ),
                'default'       => .2,
                'min'           => 0,
                'step'          => .1,
                'max'           => 1,
                'resolution'    => 0.1,
                'display_value' => 'text'
            ),
            array(
                'id'       => 'blog-posts-carousel-nav',
                'type'     => 'checkbox',
                'required' => array('blog-posts-carousel', '=', '1'),
                'title'    => esc_html__( 'Carousel Naviagtion', 'cookie' ),
                'subtitle' => esc_html__( 'It bring arrows to the carousel to move prev/next posts.', 'cookie' ),
                'default'  => '0'// 1 = on | 0 = off
            ),
            array(
                'id'       => 'blog-posts-carousel-pag',
                'type'     => 'checkbox',
                'required' => array('blog-posts-carousel', '=', '1'),
                'title'    => esc_html__( 'Carousel Pagination', 'cookie' ),
                'subtitle' => esc_html__( 'It bring dots to the carousel to move prev/next posts.', 'cookie' ),
                'default'  => '1'// 1 = on | 0 = off
            ),
            array(
                'id'       => 'blog-posts-carousel-loop',
                'type'     => 'checkbox',
                'required' => array('blog-posts-carousel', '=', '1'),
                'title'    => esc_html__( 'Carousel Posts Loop', 'cookie' ),
                'default'  => '1'// 1 = on | 0 = off
            ),
            array(
                'id'       => 'blog-posts-carousel-auto',
                'type'     => 'checkbox',
                'required' => array('blog-posts-carousel', '=', '1'),
                'title'    => esc_html__( 'Carousel Posts Autoplay', 'cookie' ),
                'default'  => '1'// 1 = on | 0 = off
            ),
            array(
                'id'            => 'blog-posts-carousel-margin',
                'type'          => 'slider',
                'required' => array('blog-posts-carousel', '=', '1'),
                'title'         => esc_html__( 'Carousel Posts Gutter', 'cookie' ),
                'subtitle'      => esc_html__( 'Set the values, if you need margin(space) between each post.', 'cookie' ),
                'default'       => 0,
                'min'           => 0,
                'step'          => 1,
                'max'           => 60,
                'display_value' => 'text'
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Share icons', 'cookie' ),
        'id'         => 'blog-sharing-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can enable/disable some of the necessary share icons.', 'cookie' ),
        'fields' => array(
            array(
                'id' => 'blog-sharing-panel',
                'type' => 'switch',
                'title' => esc_html__('Blog Sharing icons', 'cookie'),
                'subtitle' => esc_html__('This option enable the sharing panel at the bottom of every post.', 'cookie'),
                'default' => 1, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'blog-sharing-icons',
                'type'     => 'checkbox',
                'required' => array('blog-sharing-panel', '=', '1'),
                'title'    => esc_html__( 'Share Icons', 'cookie' ),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    '1' => 'Facebook',
                    '2' => 'Twitter',
                    '3' => 'Google Plus',
                    '4' => 'Linkedin'
                ),
                //See how std has changed? you also don't need to specify opts that are 0.
                'default'  => array(
                    '1' => '1',
                    '2' => '1',
                    '3' => '1',
                    '4' => '1'
                )
            ),
        )

    ) );

    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-eye-open',
        'title' => esc_html__('Portfolio Settings', 'cookie'),
        'id' => 'portfolio-settings',
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'cookie' ),
        'id'         => 'portfolio-general-options',
        'subsection' => true,
        'desc'       => esc_html__( 'This option allows you to setup the portfolio grid, layout style. Note: Most of these portfolio settings apply only when you choose portfolio at template attributes', 'cookie' ),
        'fields' => array(
            array(
                'id' => 'portfolio-layout',
                'type' => 'image_select',
                'title' => esc_html__('Portfolio Layout(Columns)', 'cookie'),
                'subtitle' => esc_html__('Layout for your portfolio page ', 'cookie'),
                'desc' => esc_html__('Choose an image to your portfolio page', 'cookie'),
                'options' => array(                            
                    '1' => array('alt' => '1 Column', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-1c.png'),
                    '2' => array('alt' => '2 Column', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-2c.png'),
                    '3' => array('alt' => '3 Column', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-3c.png'),
                    '4' => array('alt' => '4 Column', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-4c.png'),
                    '5' => array('alt' => '5 Column', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-5c.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => '3'
            ),
            array(
                'id' => 'portfolio-fullwidth',
                'type' => 'checkbox',
                'title' => esc_html__('Fullwidth', 'cookie'),
                'subtitle' => esc_html__('If you need fullwidth portfolio section.. just enable it!', 'cookie'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-gutter',
                'type' => 'checkbox',
                'title' => esc_html__('Gutter', 'cookie'),
                'subtitle' => esc_html__('It will bring some space in between the items horizontally.', 'cookie'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id'       => 'portfolio-grid',
                'type'     => 'radio',
                'title'    => esc_html__( 'Portfolio Masonry Style', 'cookie' ),
                'subtitle' => esc_html__( 'You can choose your isotope layout style.', 'cookie' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'fitRows' => 'Grid',
                    'masonry' => 'Masonry',
                ),
                'default'  => 'fitRows'
            ),

            array(
                'id' => 'portfolio-hover-style',
                'type' => 'image_select',
                'title' => esc_html__('Portfolio Hover style', 'cookie'),
                'options' => array(                            
                    '1' => array('alt' => 'Style 1', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-1.png'),
                    '2' => array('alt' => 'Style 2', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-2.png'),
                    '3' => array('alt' => 'Style 3', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-3.png'),
                    '4' => array('alt' => 'Style 4', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-4.png'),
                    '5' => array('alt' => 'Style 5', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-5.png'),
                    '6' => array('alt' => 'Style 6', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-6.png'),
                    '7' => array('alt' => 'Style 7', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-7.png'),
                    '8' => array('alt' => 'Style 8', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-8.png'),
                    '9' => array('alt' => 'Style 9', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-9.png'),
                    '10' => array('alt' => 'Style 10', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-10.png'),
                    '11' => array('alt' => 'Style 11', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-11.png'),
                    '12' => array('alt' => 'Style 12', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-12.png'),
                    //'13' => array('alt' => 'Style 13(Ajax)', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-13.png'),
                    //'14' => array('alt' => 'Style 14(Ajax)', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-14.png'),
                    '15' => array('alt' => 'Style 15', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-15.png'),
                    '16' => array('alt' => 'Style 16', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-hover-16.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => '1'
            ),
            
            array(
                'id' => 'portfolio-bottom-caption',
                'type' => 'checkbox',
                //'required' => array('portfolio-hover-style', 'less_equal', '10' ),
                'title' => esc_html__('Portfolio Bottom Caption', 'cookie'),
                'subtitle' => esc_html__('If you need caption(title/category) at the bottom. just enable it!.', 'cookie'),
                'default' => '0'// 1 = on | 0 = off
            ),
            
            array(
                'id' => 'portfolio-filter',
                'type' => 'checkbox',
                'title' => esc_html__('Filter', 'cookie'),
                'subtitle' => esc_html__('If you don\'t want to show the filter disabe it!. ', 'cookie'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-filter-order',
                'type' => 'select',
                'required' => array('portfolio-filter', '=', '1'),
                'title' => esc_html__('Portfolio Filter Order', 'cookie'),
                'options' => array(
                    'DESC' => esc_html__('Descending', 'cookie'),
                    'ASC' => esc_html__('Ascending', 'cookie'), 
                ), //Must provide key => value pairs for select options
                'default' => 'ASC'
            ),
            array(
                'id' => 'portfolio-filter-orderby',
                'type' => 'select',
                'required' => array('portfolio-filter', '=', '1'),
                'title' => esc_html__('Portfolio Filter Orderby', 'cookie'),
                'options' => array(
                    'none' => esc_html__('None', 'cookie'),
                    'name' => esc_html__( 'Name', 'cookie'),
                    'slug' => esc_html__( 'Slug', 'cookie'),
                    'term_group' => esc_html__( 'Term Group', 'cookie'),
                    'term_id' => esc_html__( 'Term ID', 'cookie'),
                    'id' => esc_html__( 'ID', 'cookie'),
                    'description' => esc_html__( 'Description', 'cookie'),
                ), 
                'default' => 'name'
            ),
            array(
                'id' => 'portfolio-filter-align',
                'type' => 'radio',
                'required' => array('portfolio-filter', '=', '1'),
                'title' => esc_html__('Portfolio Filter Align', 'cookie'),
                'options' => array(
                    'left' => esc_html__('Left', 'cookie'),
                    'center' => esc_html__('Center', 'cookie'), 
                    'right' => esc_html__('Right', 'cookie'), 
                ), 
                'default' => 'left'
            ),
            array(
                'id' => 'portfolio-filter-all-text',
                'type' => 'text',
                'required' => array('portfolio-filter', '=', '1'),
                'title' => esc_html__('Text alternative for "All"', 'cookie'),
                'subtitle' => esc_html__('type the alternative text for the portfolio filter\'s All text', 'cookie'),
                'default' => 'All',
            ),
            array(
                'id' => 'portfolio-animation',
                'type' => 'switch',
                'title' => esc_html__('Portfolio Animation', 'cookie'),
                'subtitle' => esc_html__('If you don\'t want the animation on each portfolio item disable it.', 'cookie'),
                'desc' => esc_html__('This animation will show the items one by one only when it reaches the viewport.', 'cookie'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-animation-style',
                'type' => 'select',
                'required' => array('portfolio-animation', '=', '1'),
                'title' => esc_html__('Animation Style', 'cookie'),
                'options' => array(
                    'fadeIn' => esc_html__('fadeIn', 'cookie'),
                    'fadeInDown' => esc_html__('fadeInDown', 'cookie'),
                    'fadeInUp' => esc_html__('fadeInUp', 'cookie'),
                    'fadeInRight' => esc_html__('fadeInRight', 'cookie'),
                    'fadeInLeft' => esc_html__('fadeInLeft', 'cookie'),
                    'flipInX' => esc_html__('flipInX', 'cookie'),
                    'flipInY' => esc_html__('flipInY', 'cookie'),
                    'zoomIn' => esc_html__('zoomIn', 'cookie'),
                ), //Must provide key => value pairs for select options
                'default' => 'fadeInUp'
            ),
            array(
                'id' => 'portfolio-animation-offset',
                'type' => 'slider',
                'required' => array('portfolio-animation', '=', '1'),
                'title' => esc_html__('Animation Offset ', 'cookie'),
                'desc' => esc_html__('animation will be triggered only when portfolio reaches particular percentage on viewport', 'cookie'),
                "default" => "90",
                "min" => "20",
                "step" => "5",
                "max" => "100",
            ),
            )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Posttype Settings', 'cookie' ),
        'id'         => 'porfolio-posttype-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can setup the post count, order, etc. Note: Most of these portfolio settings apply only when you choose portfolio at template attributes', 'cookie' ),
        'fields' => array(
            array(
                'id' => 'portfolio-per-page',
                'type' => 'text',
                'title' => esc_html__('Number of Portfolio items per page', 'cookie'),
                'subtitle' => esc_html__('type the number of post to show in a portfolio page', 'cookie'),
                'validate' => 'numeric',
                'default' => '6',
                'class' => 'text'
            ),
            array(
                'id' => 'portfolio-post-order',
                'type' => 'select',
                'title' => esc_html__('Portfolio items Order', 'cookie'),
                'desc' => esc_html__('Portfolio posts sorting order.', 'cookie'),
                'options' => array(
                    'DESC' => esc_html__('Descending', 'cookie'),
                    'ASC' => esc_html__('Ascending', 'cookie'), 
                ), //Must provide key => value pairs for select options
                'default' => 'DESC'
            ),
            array(
                'id' => 'portfolio-post-orderby',
                'type' => 'select',
                'title' => esc_html__('Portfolio Items Orderby', 'cookie'),
                'desc' => esc_html__('Portfolio posts sorting orderby.', 'cookie'),
                'options' => array(
                    'none' => esc_html__('None', 'cookie'),
                    'id' => esc_html__('Post ID', 'cookie'),
                    'author' => esc_html__('Post Author', 'cookie'),
                    'title' => esc_html__('Post Title', 'cookie'),
                    'name' => esc_html__('Post Slug', 'cookie'),
                    'date' => esc_html__('Date', 'cookie'),
                    'modified' => esc_html__('Last Modified Date', 'cookie'),
                    'rand' => esc_html__('Random', 'cookie'),
                    'comment_count' => esc_html__('comment-count', 'cookie'),
                    'menu_order' => esc_html__('menu_order', 'cookie'),
                ), //Must provide key => value pairs for select options
                'default' => 'date'
            ),
            
            array(
                'id' => 'portfolio-post-exclude',
                'type' => 'text',
                'title' => esc_html__('Portfolio Items exclude', 'cookie'),
                'subtitle' => esc_html__('you can exclude the posts by typing post ids for ex. 70, 45', 'cookie'),
                'default' => '',
                'class' => 'text'
            ),
            array(
                'id' => 'portfolio-post-link-target',
                'type' => 'select',
                'title' => esc_html__('Portfolio Link target', 'cookie'),
                'subtitle' => esc_html__('Choose the target of the portfolio items link.', 'cookie'),
                'options' => array(
                    '_self' => 'Same window', 
                    '_blank' => 'New window',
                ), //Must provide key => value pairs for select options
                'default' => '_self'
            ),
            array(
                'id'       => 'portfolio-navigation',
                'type'     => 'radio',
                'title'    => esc_html__( 'Portfolio Navigation Style', 'cookie' ),
                'subtitle' => esc_html__( 'Choose any of one navigation style to display on the portfolio page.', 'cookie' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Number',
                    '2' => 'Infinite',
                    '3' => 'Infinite with Load More',
                ),
                'default'  => '1'
            ),
            array(
                'id' => 'portfolio-single-prev',
                'type' => 'text',
                'title' => esc_html__('Portfolio single Previous Text ', 'cookie'),
                'subtitle' => esc_html__('you can use the Word Previous or Older', 'cookie'),
                'default' => 'Previous',
                'class' => 'text'
            ),
            
            array(
                'id' => 'portfolio-single-next',
                'type' => 'text',
                'title' => esc_html__('Portfolio single Next Text ', 'cookie'),
                'subtitle' => esc_html__('you can use the Word Next or Newer', 'cookie'),
                'default' => 'Next',
                'class' => 'text'
            ),
            array(
                'id' => 'portfolio-single-back',
                'type' => 'text',
                'title' => esc_html__('Portfolio Single Back Link', 'cookie'),
                'subtitle' => esc_html__('it will help you to go back/home when your are in portfolio\'s single page', 'cookie'),
                'validate' => 'url',
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Share icons', 'cookie' ),
        'id'         => 'porfolio-sharing-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can enable/disable some of the necessary share icons.', 'cookie' ),
        'fields' => array(
            array(
                'id' => 'portfolio-sharing-panel',
                'type' => 'switch',
                'title' => esc_html__('Portfolio Sharing icons', 'cookie'),
                'subtitle' => esc_html__('This option enable the sharing panel at the bottom of every portfolio item.', 'cookie'),
                'default' => 1, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'portfolio-sharing-icons',
                'type'     => 'checkbox',
                'required' => array('portfolio-sharing-panel', '=', '1'),
                'title'    => esc_html__( 'Share Icons', 'cookie' ),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    '1' => 'Facebook',
                    '2' => 'Twitter',
                    '3' => 'Google Plus',
                    '4' => 'Linkedin'
                ),
                //See how std has changed? you also don't need to specify opts that are 0.
                'default'  => array(
                    '1' => '1',
                    '2' => '1',
                    '3' => '1',
                    '4' => '1'
                )
            ),
        )
            
    ) );

    if( class_exists( 'WooCommerce' ) ){
        Redux::setSection( $opt_name, array(
            'title' => esc_html__( 'Shop Settings', 'cookie' ),
            'id'    => 'shop-settings',
            'icon'  => 'el el-shopping-cart'
        ) );
        
        Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'General', 'cookie' ),
            'id'         => 'shop-general-options',
            'subsection' => true,
            'desc'       => esc_html__( 'Here, you can enable/disable basic shop options.', 'cookie' ),
            'fields' => array(
                
                array(
                    'id' => 'shop-layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Shop Layout(Columns)', 'cookie'),
                    'subtitle' => esc_html__('Layout for your Shop page ', 'cookie'),
                    'desc' => esc_html__('Choose an image to your shop page', 'cookie'),
                    'options' => array(                            
                        '2' => array('alt' => '2 Column', 'img' => get_template_directory_uri(). '/agni/assets/img//portfolio-2c.png'),
                        '3' => array('alt' => '3 Column', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-3c.png'),
                        '4' => array('alt' => '4 Column', 'img' => get_template_directory_uri(). '/agni/assets/img/portfolio-4c.png'),
                    ), //Must provide key => value(array:title|img) pairs for radio options
                    'default' => '3'
                ),
                array(
                    'id' => 'shop-fullwidth',
                    'type' => 'checkbox',
                    'title' => esc_html__('Fullwidth', 'cookie'),
                    'subtitle' => esc_html__('If you need fullwidth Shop section. just enable it.', 'cookie'),
                    'default' => '0'// 1 = on | 0 = off
                ),
                array(
                    'id' => 'shop-gutter',
                    'type' => 'checkbox',
                    'title' => esc_html__('Gutter', 'cookie'),
                    'subtitle' => esc_html__('It will bring some space in between the items horizontally.', 'cookie'),
                    'default' => '1'// 1 = on | 0 = off
                ),

                array(
                    'id'       => 'shop-grid-layout',
                    'type'     => 'radio',
                    'title'    => esc_html__( 'Shop Grid Style', 'cookie' ),
                    'subtitle' => esc_html__( 'Choose any of one grid style. fitRows is default and ', 'cookie' ),
                    //Must provide key => value pairs for radio options
                    'options'  => array(
                        'fitRows' => 'FitRows(Default Grid)',
                        'masonry' => 'Masonry',
                    ),
                    'default'  => 'fitRows'
                ),
                array(
                    'id' => 'shop-sidebar',
                    'type'     => 'radio',
                    'title' => esc_html__('Shop Sidebar', 'cookie'),
                    'options' => array(
                        'no-sidebar' => 'No Sidebar', 
                        'has-sidebar' => 'Right Sidebar',
                        'has-sidebar left' => 'Left Sidebar',
                    ), //Must provide key => value pairs for select options
                    'default' => 'has-sidebar'
                ),
                array(
                    'id'       => 'shop-navigation',
                    'type'     => 'radio',
                    'title'    => esc_html__( 'Shop Navigation Style', 'cookie' ),
                    'subtitle' => esc_html__( 'Choose any of one navigation style to display on the portfolio page.', 'cookie' ),
                    //Must provide key => value pairs for radio options
                    'options'  => array(
                        '1' => 'Number',
                        '2' => 'Infinite',
                        '3' => 'Infinite with Load More',
                    ),
                    'default'  => '1'
                ),

                array(
                    'id' => 'shop-single-fullwidth',
                    'type' => 'checkbox',
                    'title' => esc_html__('Single Fullwidth', 'cookie'),
                    'subtitle' => esc_html__('If you need fullwidth Single shop page. just enable it.', 'cookie'),
                    'default' => '0'// 1 = on | 0 = off
                ),
                array(
                    'id' => 'shop-single-thumbnail-style',
                    'type' => 'select',
                    'title' => esc_html__('Single Thumbnails style', 'cookie'),
                    'options' => array(
                        'single-product-hover-style-1' => esc_html__('Style 1(Lightbox)', 'cookie'),
                        'single-product-hover-style-2' => esc_html__('Style 2(Zoom)', 'cookie'),
                    ), //Must provide key => value pairs for select options
                    'default' => 'single-product-hover-style-1'
                ),
                array(
                    'id' => 'shop-single-sidebar',
                    'type'     => 'radio',
                    'title' => esc_html__('Single Shop Sidebar', 'cookie'),
                    'options' => array(
                        'no-sidebar' => 'No Sidebar', 
                        'has-sidebar' => 'Right Sidebar',
                        'has-sidebar left' => 'Left Sidebar',
                    ), //Must provide key => value pairs for select options
                    'default' => 'no-sidebar'
                ),
                )
        ) );
        Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Share icons', 'cookie' ),
            'id'         => 'shop-sharing-options',
            'subsection' => true,
            'desc'       => esc_html__( 'Here, you can enable/disable some of the necessary share icons.', 'cookie' ),
            'fields' => array(
                array(
                    'id' => 'shop-sharing-panel',
                    'type' => 'switch',
                    'title' => esc_html__('Shop Single Page Sharing icons', 'cookie'),
                    'subtitle' => esc_html__('This option enable the sharing panel at the bottom of every product.', 'cookie'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),
                array(
                    'id'       => 'shop-sharing-icons',
                    'type'     => 'checkbox',
                    'required' => array('shop-sharing-panel', '=', '1'),
                    'title'    => esc_html__( 'Share Icons', 'cookie' ),
                    //Must provide key => value pairs for multi checkbox options
                    'options'  => array(
                        '1' => 'Facebook',
                        '2' => 'Twitter',
                        '3' => 'Google Plus',
                        '4' => 'Linkedin'
                    ),
                    //See how std has changed? you also don't need to specify opts that are 0.
                    'default'  => array(
                        '1' => '1',
                        '2' => '1',
                        '3' => '1',
                        '4' => '1'
                    )
                ),
            )

        ) );
    }

    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Sliders settings', 'cookie' ),
        'id'    => 'slider-settings',
        'icon'  => 'el el-picture'
    ) );
    Redux::setSection( $opt_name, array(
        'id'  => 'slider-slideshow-options',
        'subsection' => true,
        'title' => esc_html__('Slideshow Slider', 'cookie'),
        'fields' => array(
            
            // Agni Slider  
            
            array(
                'id' => 'slideshow-slider-duration',
                'type' => 'slider',
                'title' => esc_html__('Slider Duration ', 'cookie'),
                'desc' => esc_html__('Visible period of your slider in ms', 'cookie'),
                "default" => "6000",
                "min" => "2000",
                "step" => "500",
                "max" => "10000",
            ),
            array(
                'id' => 'slideshow-slider-transition-duration',
                'type' => 'slider',
                'title' => esc_html__('Transition Speed ', 'cookie'),
                'desc' => esc_html__('Visible period of your slider in ms', 'cookie'),
                "default" => "700",
                "min" => "200",
                "step" => "100",
                "max" => "1000",
            ),
            array(
                'id' => 'slideshow-slider-animation',
                'type' => 'radio',
                'title' => esc_html__('Slideshow animation type', 'cookie'),
                'subtitle' => esc_html__('select your Slideshow animation type to display on the slideshow slider', 'cookie'),
                'options' => array('fade' => esc_html__('Fade', 'cookie'), 'slide' => esc_html__('Slide', 'cookie') ), //Must provide key => value pairs for radio options
                'default' => 'slide'
            ),
            
            array(
                'id' => 'slideshow-slider-pagination',
                'type' => 'checkbox',
                'title' => esc_html__('Pagination', 'cookie'),
                'default' => '1'// 1 = on | 0 = off
            ),                  
            
            
        ) 
    ) );
    
    Redux::setSection( $opt_name, array(
        'id'  => 'slider-text-slider-options',
        'subsection' => true,
        'title' => esc_html__('Text Slider', 'cookie'),
        'fields' => array(      
            
            array(
                'id' => 'textslider-slider-duration',
                'type' => 'slider',
                'title' => esc_html__('Slider Duration ', 'cookie'),
                'desc' => esc_html__('Visible period of your slider in ms', 'cookie'),
                "default" => "6000",
                "min" => "2000",
                "step" => "500",
                "max" => "10000",
            ),
            array(
                'id' => 'textslider-slider-transition-duration',
                'type' => 'slider',
                'title' => esc_html__('Transition Speed ', 'cookie'),
                'desc' => esc_html__('Visible period of your slider in ms', 'cookie'),
                "default" => "700",
                "min" => "200",
                "step" => "100",
                "max" => "1000",
            ),
            array(
                'id' => 'textslider-slider-animation',
                'type' => 'radio',
                'title' => esc_html__('Textslider animation type', 'cookie'),
                'subtitle' => esc_html__('select your Textslider animation type to display on the textslider slider', 'cookie'),
                'options' => array('fade' => esc_html__('Fade', 'cookie'), 'slide' => esc_html__('Slide', 'cookie') ), //Must provide key => value pairs for radio options
                'default' => 'slide'
            ),
            
            array(
                'id' => 'textslider-slider-pagination',
                'type' => 'checkbox',
                'title' => esc_html__('Pagination', 'cookie'),
                'default' => '1'// 1 = on | 0 = off
            ),      
            
                 
        ) 
    ) );    
    
    Redux::setSection( $opt_name, array(
        'id'  => 'slider-image-slider-options',
        'subsection' => true,
        'title' => esc_html__('Image Slider', 'cookie'),
        'fields' => array(      
            
            array(
                'id' => 'imageslider-slider-duration',
                'type' => 'slider',
                'title' => esc_html__('Slider Duration ', 'cookie'),
                'desc' => esc_html__('Visible period of your slider in ms', 'cookie'),
                "default" => "6000",
                "min" => "2000",
                "step" => "500",
                "max" => "10000",
            ),
            array(
                'id' => 'imageslider-slider-transition-duration',
                'type' => 'slider',
                'title' => esc_html__('Transition Speed ', 'cookie'),
                'desc' => esc_html__('Visible period of your slider in ms', 'cookie'),
                "default" => "700",
                "min" => "200",
                "step" => "100",
                "max" => "1000",
            ),
            array(
                'id' => 'imageslider-slider-animation',
                'type' => 'radio',
                'title' => esc_html__('imageslider animation type', 'cookie'),
                'subtitle' => esc_html__('select your imageslider animation type to display on the imageslider slider', 'cookie'),
                'options' => array('fade' => esc_html__('Fade', 'cookie'), 'slide' => esc_html__('Slide', 'cookie') ), //Must provide key => value pairs for radio options
                'default' => 'slide'
            ),
            
            array(
                'id' => 'imageslider-slider-pagination',
                'type' => 'checkbox',
                'title' => esc_html__('Pagination', 'cookie'),
                'default' => '1'// 1 = on | 0 = off
            ),      
            
                 
        ) 
    ) );
    
    Redux::setSection( $opt_name, array(
        'id'  => 'slider-video-bg-options',
        'subsection' => true,
        'title' => esc_html__('Video BG', 'cookie'),
        'fields' => array(  
            
            array(
                'id' => 'video-bg-controls',
                'type' => 'checkbox',
                'title' => esc_html__('Show Controls', 'cookie'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'video-bg-autoplay',
                'type' => 'checkbox',
                'title' => esc_html__('Auto Play', 'cookie'),
                'desc' => esc_html__('It doesn\'t affect selfhosted video' , 'cookie'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'video-bg-loop',
                'type' => 'checkbox',
                'title' => esc_html__('Loop', 'cookie'),
                'default' => '1'// 1 = on | 0 = off
            ),
            
            array(
                'id' => 'video-bg-mute',
                'type' => 'switch',
                'title' => esc_html__('Mute', 'cookie'),                     
                'desc' => esc_html__('Disable this to unmute!!..', 'cookie'),
                'default' => 1,// 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
                                    
            array(
                'id' => 'video-bg-volume',
                'type' => 'slider',
                'required' => array('video-bg-mute', '=', '0'),
                'title' => esc_html__('Volume', 'cookie'),
                'desc' => esc_html__('sound level of the video by default', 'cookie'),
                "default" => "50",
                "min" => "0",
                "step" => "1",
                "max" => "100",
            ),
            
            array(
                'id' => 'video-bg-quality',
                'type' => 'radio',
                'title' => esc_html__('Video Quality', 'cookie'),
                'subtitle' => esc_html__('Choose the quality of the video!!..', 'cookie'),
                'options' => array('default' => esc_html__('Default', 'cookie'), 'medium' => esc_html__('Medium', 'cookie'), 'large' => esc_html__('Large', 'cookie'), 'hd720' => esc_html__('720p', 'cookie'), 'hd1080' => esc_html__('1080p', 'cookie'), 'highres' => esc_html__('Maximum quality', 'cookie'), ), //Must provide key => value pairs for radio options
                'default' => 'default'
            ),
            
            array(
                'id' => 'video-bg-start',
                'type' => 'text',
                'title' => esc_html__('StartAt ', 'cookie'),
                'subtitle' => esc_html__('Set the seconds the video should start at', 'cookie'),
                'validate' => 'numeric',
                'default' => '0',
                'class' => 'text'
            ),
            array(
                'id' => 'video-bg-stop',
                'type' => 'text',
                'title' => esc_html__('StopAt', 'cookie'),
                'subtitle' => esc_html__('Set the seconds the video should stop at.. If 0 is ignored.', 'cookie'),
                'validate' => 'numeric',
                'default' => '0',
                'class' => 'text'
            ),
            
            array(
                'id' => 'section2-videobg-start',
                'type' => 'section',
                'subtitle' => esc_html__('setup your video bg text transition setting.', 'cookie'),
                'indent' => false // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id' => 'video-slider-duration',
                'type' => 'slider',
                'title' => esc_html__('Slider Duration ', 'cookie'),
                'desc' => esc_html__('Visible period of your slider in ms', 'cookie'),
                "default" => "6000",
                "min" => "2000",
                "step" => "500",
                "max" => "10000",
            ),
            array(
                'id' => 'video-slider-transition-duration',
                'type' => 'slider',
                'title' => esc_html__('Transition Speed ', 'cookie'),
                'desc' => esc_html__('Visible period of your slider in ms', 'cookie'),
                "default" => "700",
                "min" => "200",
                "step" => "100",
                "max" => "1000",
            ),
            array(
                'id' => 'video-slider-animation',
                'type' => 'radio',
                'title' => esc_html__('Text animation type', 'cookie'),
                'subtitle' => esc_html__('select your text animation type to display on the video slider', 'cookie'),
                'options' => array('fade' => esc_html__('Fade', 'cookie'), 'slide' => esc_html__('Slide', 'cookie') ), //Must provide key => value pairs for radio options
                'default' => 'slide'
            ),
            
            array(
                'id' => 'video-slider-pagination',
                'type' => 'checkbox',
                'title' => esc_html__('Pagination', 'cookie'),
                'default' => '1'// 1 = on | 0 = off
            ),  
            
        )
    ) );
    
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-road',
        'id'         => '404-error-options',
        'title' => esc_html__('404 Error Page', 'cookie'),
        'desc' => esc_html__('you change your 404 page content here.', 'cookie'),
        'fields' => array(
            
            array(
                'id' => '404-title',
                'type' => 'text',
                'title' => esc_html__('404 Title', 'cookie'),
                'subtitle' => esc_html__('404 Title', 'cookie'),
                'default' => '404'
            ),
            array(
                'id' => '404-description-text',
                'type' => 'editor',
                'title' => esc_html__('404 Description Text', 'cookie'),
                'subtitle' => esc_html__('you can type your 404 description here..', 'cookie'),
                'default' => 'It looks like nothing was found at this location. Maybe try one of the links below or a search?',
                'args'   => array(
                    'media_buttons'    => false,
                    'textarea_rows'    => 3
                )
            ),
            array(
                'id' => '404-searchbox',
                'type' => 'checkbox',
                'title' => esc_html__('Search Box', 'cookie'),
                'default' => '1'// 1 = on | 0 = off
            ),  
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-group',
        'id'         => 'social-links-options',
        'title' => esc_html__('Social Network links', 'cookie'),
        'desc' => esc_html__('Fill your links for social network.', 'cookie'),
        'fields' => array(
        
            array(
                'id' => 'facebook-link',
                'type' => 'text',
                'title' => esc_html__('Facebook Link', 'cookie'),
                'subtitle' => esc_html__('Link your profile page', 'cookie'),
                'validate' => 'url',
                'default' => 'http://facebook.com/profile'
            ),
            array(
                'id' => 'twitter-link',
                'type' => 'text',
                'title' => esc_html__('Twitter Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://twitter.com/'
            ),
            array(
                'id' => 'google-plus-link',
                'type' => 'text',
                'title' => esc_html__('Google + Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://google.com/'
            ),
            array(
                'id' => 'bitbucket-link',
                'type' => 'text',
                'title' => esc_html__('BitBucket Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://bitbucket.org/'
            ),
            array(
                'id' => 'behance-link',
                'type' => 'text',
                'title' => esc_html__('Behance Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://behance.net/'
            ),
            array(
                'id' => 'dribbble-link',
                'type' => 'text',
                'title' => esc_html__('Dribbble Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://dribbble.com/'
            ),
            array(
                'id' => 'flickr-link',
                'type' => 'text',
                'title' => esc_html__('Flickr Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://flickr.com/'
            ),
            array(
                'id' => 'github-link',
                'type' => 'text',
                'title' => esc_html__('GitHub Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://github.com/'
            ),
            array(
                'id' => 'instagram-link',
                'type' => 'text',
                'title' => esc_html__('Instagram Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://instagram.com/'
            ),
            array(
                'id' => 'linkedin-link',
                'type' => 'text',
                'title' => esc_html__('Linkedin Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://linkedin.com/'
            ),
            array(
                'id' => 'pinterest-link',
                'type' => 'text',
                'title' => esc_html__('Pinterest Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://pinterest.com/'
            ),
            array(
                'id' => 'reddit-link',
                'type' => 'text',
                'title' => esc_html__('Reddit Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://reddit.com/'
            ),
            array(
                'id' => 'soundcloud-link',
                'type' => 'text',
                'title' => esc_html__('SoundCloud Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://soundcloud.com/'
            ),
            array(
                'id' => 'skype-link',
                'type' => 'text',
                'title' => esc_html__('Skype Link', 'cookie'),                        
                'default' => 'skype:yourname?call'
            ),
            array(
                'id' => 'stackoverflow-link',
                'type' => 'text',
                'title' => esc_html__('Stack Overflow Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://stackoverflow.com/'
            ),
            array(
                'id' => 'tumblr-link',
                'type' => 'text',
                'title' => esc_html__('Tumblr Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://tumblr.com/'
            ),
            array(
                'id' => 'vimeo-link',
                'type' => 'text',
                'title' => esc_html__('Vimeo Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://vimeo.com/'
            ),
            array(
                'id' => 'vk-link',
                'type' => 'text',
                'title' => esc_html__('VK Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://vk.com/'
            ),
            array(
                'id' => 'weibo-link',
                'type' => 'text',
                'title' => esc_html__('Weibo Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://weibo.com/'
            ),
            array(
                'id' => 'whatsapp-link',
                'type' => 'text',
                'title' => esc_html__('WhatsApp Link', 'cookie'),
                'default' => '(000)000-0000'
            ),
            array(
                'id' => 'youtube-link',
                'type' => 'text',
                'title' => esc_html__('Youtube Link', 'cookie'),
                'validate' => 'url',
                'default' => 'http://youtube.com/'
            ),
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom Coding', 'cookie' ),
        'id'         => 'custom-coding-options',
        'icon'  => 'el el-leaf',
        'desc'       => esc_html__( 'This section used for advance customization, you can add your own codes here.', 'cookie' ),
        'fields'     => array(
            array(
                'id'       => 'css-code',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'CSS Code', 'cookie' ),
                'subtitle' => esc_html__( 'Paste your CSS code here.', 'cookie' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'desc'     => 'You can write your own CSS here.',
                'default'  => "#header{\n   margin: 0 auto;\n}\n/* your styles here & you can delete above reference */"
            ),
            array(
                'id'       => 'js-code',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'JS Code', 'cookie' ),
                'subtitle' => esc_html__( 'Paste your JS code here.', 'cookie' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'desc'     => 'You can write your own jQuery here.',
                'default'  => "jQuery(document).ready(function(){\n\t/* your jquery here */\n});"
            ),

        )
    ) );
    
    //Render Info Display
ob_start(); ?><div><strong>WordPress Environment</strong>
<pre>
Home URL                       :  <?php echo esc_url( home_url( '/' ) ) . "\n"; ?>
Site URL                       :  <?php echo esc_url( home_url( '/' ) ) . "\n"; ?>
WP Version                     :  <?php echo esc_html( get_bloginfo( 'version' ) ) . "\n"; ?>
WP_DEBUG                       :  <?php echo defined( 'WP_DEBUG' ) ? WP_DEBUG ? 'Enabled' . "\n" : 'Disabled' . "\n" : 'Not set' . "\n" ?>
WP Language                    :  <?php echo ( defined( 'WPLANG' ) && WPLANG ? WPLANG : 'en_US' ) . "\n"; ?>
Multisite                      :  <?php echo is_multisite() ? 'Yes' . "\n" : 'No' . "\n" ?>
</pre><br />
<strong>Theme Information</strong>
<pre>
<?php $active_theme = wp_get_theme(); ?>
Theme Name                     :  <?php echo $active_theme->Name . "\n"; ?>
Theme Version                  :  <?php echo $active_theme->Version . "\n"; ?>
Theme Author                   :  <?php echo $active_theme->get('Author') . "\n"; ?>
Theme Author URI               :  <?php echo $active_theme->get('AuthorURI') . "\n"; ?>
Is Child Theme                 :  <?php echo is_child_theme() ? 'Yes' . "\n" : 'No' . "\n"; if( is_child_theme() ) { $parent_theme = wp_get_theme( $active_theme->Template ); ?>
Parent Theme                   :  <?php echo $parent_theme->Name ?>        
Parent Theme Version           :  <?php echo $parent_theme->Version . "\n"; ?>
Parent Theme URI               :  <?php echo $parent_theme->get('ThemeURI') . "\n"; ?>
Parent Theme Author URI        :  <?php echo $parent_theme->{'Author URI'} . "\n"; ?>
<?php } ?></pre><br />
<strong>PHP Configuration</strong>
<pre>
PHP Version                    :  <?php echo PHP_VERSION . "\n"; ?>
PHP Post Max Size              :  <?php echo ini_get( 'post_max_size' ) . " (32M Recommended)\n"; ?>
PHP Execution Time             :  <?php echo ini_get( 'max_execution_time' ) . " (300 Recommended)\n"; ?>
PHP Max Input Vars             :  <?php echo ini_get( 'max_input_vars' ) . " (2000 Recommended)\n"; ?>
PHP Memory Limit               :  <?php echo ini_get( 'memory_limit' ) . " (128M Recommended)\n"; ?>
PHP Upload Max Size            :  <?php echo ini_get( 'upload_max_filesize' ) . " (32M Recommended)\n"; ?>
PHP Safe Mode                  :  <?php echo ini_get( 'safe_mode' ) ? "Yes" : "No\n"; ?></pre><br />
<strong>Active Plugins Information</strong>
<pre>
<?php 
if ( ! function_exists( 'get_plugins' ) ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
$plugins = get_plugins();
$active_plugins = get_option( 'active_plugins', array() );
echo '<table>';
foreach( $plugins as $plugin_path => $plugin ) {
    if( !in_array( $plugin_path, $active_plugins ) )
        continue;

    echo '<tr><td>'.$plugin['Name'] . '  </td><td>:  ' . $plugin['Version'] . '</td><td>    ' .$plugin['Author'] .'</td><td>    ' .$plugin['PluginURI'] ."</td></tr>";
} echo '</table>'; ?></pre><?php
if( is_multisite() ) {
        // WordPress Multisite active plugins
        ?><strong>Network Active Plugins Information</strong><pre><?php
        echo '<table>';
        $plugins = wp_get_active_network_plugins();
        $active_plugins = get_site_option( 'active_sitewide_plugins', array() );

        foreach( $plugins as $plugin_path ) {
            $plugin_base = plugin_basename( $plugin_path );

            if( !array_key_exists( $plugin_base, $active_plugins ) )
                continue;

            $plugin  = get_plugin_data( $plugin_path );
            echo '<tr><td>'.$plugin['Name'] . ':</td><td> ' . $plugin['Version'] . '</td><td>' .$plugin['Author'] .'</td><td>' .$plugin['PluginURI'] ."</td></tr>";
        }
        echo '</table>'; ?></pre><?php
    }
?>
</div><?php $system_info = ob_get_contents();
ob_end_clean();

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'System Information', 'cookie' ),
        'id'         => 'system-info',
        'icon'  => 'el el-screen',
        'desc'       => esc_html__( 'This section used for advance customization, you can add your own codes here.', 'cookie' ),
        'fields'     => array(
            array(
                'id'       => 'system-info-text',
                'type'     => 'raw',
                //'markdown' => true,
                'content'  => $system_info,
            ),

        )
    ) );
    
    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => esc_html__( 'Section via hook', 'cookie' ),
            'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'cookie' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
