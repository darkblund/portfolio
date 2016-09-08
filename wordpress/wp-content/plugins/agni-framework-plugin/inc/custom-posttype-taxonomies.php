<?php

/*
 * Custom post type portfolio
 */
 
 if( !function_exists( 'register_portfolio_posttype' ) ){
	function register_portfolio_posttype() {

		$labels = array(
			'name'                => _x( 'Portfolio', 'Portfolio General Name', 'agni-framework-plugin' ),
			'singular_name'       => _x( 'Portfolio', 'Portfolio Singular Name', 'agni-framework-plugin' ),
			'menu_name'           => __( 'Portfolio', 'agni-framework-plugin' ),
			'parent_item_colon'   => __( 'Parent Item:', 'agni-framework-plugin' ),
			'all_items'           => __( 'All Items', 'agni-framework-plugin' ),
			'view_item'           => __( 'View Item', 'agni-framework-plugin' ),
			'add_new_item'        => __( 'Add New Work', 'agni-framework-plugin' ),
			'add_new'             => __( 'Add New', 'agni-framework-plugin' ),
			'edit_item'           => __( 'Edit Item', 'agni-framework-plugin' ),
			'update_item'         => __( 'Update Item', 'agni-framework-plugin' ),
			'search_items'        => __( 'Search Item', 'agni-framework-plugin' ),
			'not_found'           => __( 'Not found', 'agni-framework-plugin' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'agni-framework-plugin' ),
		);
		$post_type_args = array(
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'page-attributes', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-portfolio',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'portfolio', $post_type_args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'register_portfolio_posttype');

	register_taxonomy('types', array('portfolio'), array('hierarchical' => true, 'label' => 'Portfolio Categories', 'singular_label' => 'Category', 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => true));

}

/**
 * Post Type team
 */	
 if( !function_exists( 'register_team_posttype' ) ){
	function register_team_posttype() {
		$labels = array(
			'name' 				=> _x( 'Team Member', 'post type general name','agni-framework-plugin' ),
			'singular_name'		=> _x( 'Member', 'post type singular name','agni-framework-plugin' ),
			'add_new' 			=> __( 'Add New Member','agni-framework-plugin' ),
			'add_new_item' 		=> __( 'Add New Member','agni-framework-plugin' ),
			'all_items' 		=> __( 'All Members','agni-framework-plugin' ),
			'edit_item' 		=> __( 'Edit Member','agni-framework-plugin' ),
			'new_item' 			=> __( 'New Member','agni-framework-plugin' ),
			'view_item' 		=> __( 'View Member','agni-framework-plugin' ),
			'search_items' 		=> __( 'Search Members','agni-framework-plugin' ),
			'not_found' 		=> __( 'Member','agni-framework-plugin' ),
			'not_found_in_trash'=> __( 'Member','agni-framework-plugin' ),
			'parent_item_colon' => __( 'Member','agni-framework-plugin' ),
			'menu_name'			=> __( 'Team Members','agni-framework-plugin' )
		);
		
		$taxonomies = array();
		
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Member','agni-framework-plugin'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'show_in_nav_menus'	=> false,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'team', 'with_front' => false ),
			'supports' 			=> 'title',
			'menu_position' 	=> 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> 'dashicons-businessman',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('team',$post_type_args);
	}
	add_action('init', 'register_team_posttype');

	register_taxonomy('team_types', array('team'), array('hierarchical' => true, 'label' => 'Team Categories', 'singular_label' => 'Category', 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => true));
}

/**
 * Post Type client
 */	
 if( !function_exists( 'register_clients_posttype' ) ){
	function register_clients_posttype() {
		$labels = array(
			'name' 				=> _x( 'Clients', 'post type general name','agni-framework-plugin' ),
			'singular_name'		=> _x( 'Client', 'post type singular name','agni-framework-plugin' ),
			'add_new' 			=> __( 'Add New Client','agni-framework-plugin' ),
			'add_new_item' 		=> __( 'Add New Client','agni-framework-plugin' ),
			'all_items' 		=> __( 'All Clients','agni-framework-plugin' ),
			'edit_item' 		=> __( 'Edit Client','agni-framework-plugin' ),
			'new_item' 			=> __( 'New Client','agni-framework-plugin' ),
			'view_item' 		=> __( 'View Client','agni-framework-plugin' ),
			'search_items' 		=> __( 'Search Clients','agni-framework-plugin' ),
			'not_found' 		=> __( 'Client','agni-framework-plugin' ),
			'not_found_in_trash'=> __( 'Client','agni-framework-plugin' ),
			'parent_item_colon' => __( 'Client','agni-framework-plugin' ),
			'menu_name'			=> __( 'Clients','agni-framework-plugin' )
		);
		
		$taxonomies = array();
		
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Client','agni-framework-plugin'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'show_in_nav_menus'	=> false,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'clients', 'with_front' => false ),
			'supports' 			=> 'title',
			'menu_position' 	=> 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> 'dashicons-smiley',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('clients',$post_type_args);
	}
	add_action('init', 'register_clients_posttype');

	register_taxonomy('client_types', array('clients'), array('hierarchical' => true, 'label' => 'Clients Categories', 'singular_label' => 'Category', 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => true));
}

/**
 * Post Type testimonials
 */	
 if( !function_exists( 'register_testimonials_posttype' ) ){
	function register_testimonials_posttype() {
		$labels = array(
			'name' 				=> _x( 'Testimonials', 'post type general name','agni-framework-plugin' ),
			'singular_name'		=> _x( 'Testimonial', 'post type singular name','agni-framework-plugin' ),
			'add_new' 			=> __( 'Add New Testimonial','agni-framework-plugin' ),
			'add_new_item' 		=> __( 'Add New Testimonial','agni-framework-plugin' ),
			'all_items' 		=> __( 'All Testimonials','agni-framework-plugin' ),
			'edit_item' 		=> __( 'Edit Testimonial','agni-framework-plugin' ),
			'new_item' 			=> __( 'New Testimonial','agni-framework-plugin' ),
			'view_item' 		=> __( 'View Testimonial','agni-framework-plugin' ),
			'search_items' 		=> __( 'Search Testimonials','agni-framework-plugin' ),
			'not_found' 		=> __( 'Testimonial','agni-framework-plugin' ),
			'not_found_in_trash'=> __( 'Testimonial','agni-framework-plugin' ),
			'parent_item_colon' => __( 'Testimonial','agni-framework-plugin' ),
			'menu_name'			=> __( 'Testimonials','agni-framework-plugin' )
		);
		
		$taxonomies = array();
		
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Testimonial','agni-framework-plugin'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'show_in_nav_menus'	=> false,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'testimonials', 'with_front' => false ),
			'supports' 			=> 'title',
			'menu_position' 	=> 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> 'dashicons-testimonial',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('testimonials',$post_type_args);
	}
	add_action('init', 'register_testimonials_posttype');

	register_taxonomy('quote_types', array('testimonials'), array('hierarchical' => true, 'label' => 'Testimonials Categories', 'singular_label' => 'Category', 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => true));
}

/**
 * Agni Slider Post Type
 */	
 if( !function_exists( 'register_slides_posttype' ) ){
	function register_slides_posttype() {
		$labels = array(
			'name' 				=> _x( 'Slides', 'post type general name','agni-framework-plugin' ),
			'singular_name'		=> _x( 'Slide', 'post type singular name','agni-framework-plugin' ),
			'add_new' 			=> __( 'Add New Slide','agni-framework-plugin' ),
			'add_new_item' 		=> __( 'Add New Slide','agni-framework-plugin' ),
			'all_items' 		=> __( 'All Slides','agni-framework-plugin' ),
			'edit_item' 		=> __( 'Edit Slide','agni-framework-plugin' ),
			'new_item' 			=> __( 'New Slide','agni-framework-plugin' ),
			'view_item' 		=> __( 'View Slide','agni-framework-plugin' ),
			'search_items' 		=> __( 'Search Slides','agni-framework-plugin' ),
			'not_found' 		=> __( 'Slide','agni-framework-plugin' ),
			'not_found_in_trash'=> __( 'Slide','agni-framework-plugin' ),
			'parent_item_colon' => __( 'Slide','agni-framework-plugin' ),
			'menu_name'			=> __( 'Agni Slider','agni-framework-plugin' )
		);
		
		$taxonomies = array();
		
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Slide','agni-framework-plugin'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'show_in_nav_menus'	=> false,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'agni_slides', 'with_front' => false  ),
			'supports' 			=> array('title', 'author',),
			'menu_position' 	=> 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> 'dashicons-images-alt',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('agni_slides',$post_type_args);
	}
	add_action('init', 'register_slides_posttype');
}
