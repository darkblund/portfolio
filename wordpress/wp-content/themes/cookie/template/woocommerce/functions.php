<?php
global $cookie_options;
/**
 * Loading Custom theme functions.
 */
function cookie_woocommerce_setup() {

	// Removing Wocommerce CSS
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	//add_image_size( 'shop-thumbnail', 960, 0, true );
}
add_action( 'after_setup_theme', 'cookie_woocommerce_setup', 3 );

function cookie_woocommerce_scripts(){
	wp_enqueue_style( 'cookie-woocommerce-style', AGNI_FRAMEWORK_URL .'/template/woocommerce/css/woocommerce-style.css', array(), wp_get_theme()->get('Version')  );

	wp_enqueue_script( 'cookie-woocommerce-easyzoom', get_template_directory_uri() .'/template/woocommerce/js/easyzoom.min.js', array(), wp_get_theme()->get('Version'), true );
	wp_enqueue_script( 'cookie-woocommerce-script', get_template_directory_uri() .'/template/woocommerce/js/woocommerce-script.js', array(), wp_get_theme()->get('Version'), true );
}
add_action( 'wp_enqueue_scripts', 'cookie_woocommerce_scripts' );

function cookie_woocommerce_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Sidebar', 'cookie' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'cookie_woocommerce_widgets_init' );

// Ensure cart contents update when products are added to the cart via AJAX.
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $cookie_options;
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php esc_html_e( 'View your shopping cart', 'cookie' ); ?>"><?php if($cookie_options['header-cart-amount'] == '1'){ echo WC()->cart->get_cart_total(); } ?><span class="header-toggle toggle-circled"><span class="header-cart-icon"><i class="pe-7s-cart"></i></span><span class="product-count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'cookie' ), WC()->cart->cart_contents_count ); ?></span></span></a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_contents();
	ob_end_clean();
	return $fragments;
}

//Woocommerce product title override
function woocommerce_template_loop_product_title() {
	global $post;
	$procuct_subtitle = '';
	$product_subtitle = get_post_meta( $post->ID,'product_subtitle', true );
	
	if( !empty( $product_subtitle ) ){ 
		$product_subtitle =  '<div class="product-subtitle">'.$product_subtitle.'</div>'; 
	}
	?><div class="product-title-content"><h6 class="product-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6><div class="product-subtitle"><?php echo $product_subtitle; ?></div></div><?php
	
}

// Woocommerce product thumbnail override 
function woocommerce_get_product_thumbnail( $size = 'cookie-grid-thumbnail', $deprecated1 = 0, $deprecated2 = 0 ) {
	global $post;

	if ( has_post_thumbnail() ) {
		return get_the_post_thumbnail( $post->ID, $size );
	} elseif ( wc_placeholder_img_src() ) {
		return wc_placeholder_img( $size );
	}
}

// Removing & Adding the rating
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 11 );

// Removing & Adding the shopping cart
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );

// Removing breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Removing & Showing sidebar as per the option panel value
if( $cookie_options['shop-single-sidebar'] == 'no-sidebar' ){ 
	function cookie_woocommerce_remove_sidebar() {
	    if ( is_singular('product') ) {
	        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
	    }
	}
	add_action('template_redirect', 'cookie_woocommerce_remove_sidebar');
}

// Variable Single Product price override
function woocommerce_single_variation() {
	echo '<h4 class="single_variation"></h4>';
}	

// Removing cross_sell_display (you may know this items) from collaterals
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

// Adding back the cross_sell_display (you may know this items)
add_action( 'agni_woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
?>