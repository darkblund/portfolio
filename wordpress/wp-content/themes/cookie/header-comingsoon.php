<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agni Framework
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo esc_html( get_bloginfo( 'charset' ) ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php function agni_header_comingsoon(){ 
	global $cookie_options; ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php echo esc_html( get_bloginfo( 'pingback_url' ) ); ?>">

<?php wp_head(); ?>
</head>
<?php $has_padding = ''; if( $cookie_options['layout-padding'] == '1' ){ $has_padding = 'has-padding'; } ?>
<body <?php body_class( $has_padding ); ?>>
	<div class="top-padding"></div>
	<div class="bottom-padding"></div>
<?php if( $cookie_options['backtotop'] == '1' ){ ?>
	<div id="back-to-top" class="back-to-top"><a href="#back-to-top"><i class="<?php echo esc_attr($cookie_options['backtotop-icon']); ?>"></i></a></div>
<?php } ?>


<?php 
/* Getting variables from page */
$header_transparent = $cookie_options['header-bg-transparent'];
$page_id = get_the_ID();
//if(is_front_page()){ $page = new stdClass(); $page_id = get_option( 'page_for_posts' ); }
if( esc_attr( get_post_meta( $page_id, 'page_transparent', true ) ) == '' ){
	$header_transparent = '0';
}

/* Compling & Storing HTML Elements */

/* WPML Lang bar */
if ( function_exists('icl_object_id') ) {
	function agni_wpml_languages_bar(){
		$languages = icl_get_languages('skip_missing=0');
		if(1 < count($languages)){
			echo '<div class="header-toggle header-lang-toggle toggle-circled">';
			foreach($languages as $l){
				if($l['active']) echo '<span>'.$l['translated_name'].'</span>';
			}
			echo '<ul>';
			foreach($languages as $l){
				if(!$l['active']) echo '<li><a href="'.$l['url'].'">'.$l['translated_name'].'</a></li>';
			}
			echo '</ul></div>';
		}
	}
}

/* Header Icon */
ob_start(); ?>	
	<div class="header-icon">
		 <?php if(!empty($cookie_options['logo-1']['url'])){  ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-icon"><img src="<?php echo esc_html($cookie_options['logo-1']['url']); ?>" alt="<?php bloginfo( 'name' ); ?>"></a><?php 
		} else{ ?>
			<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-text"><?php bloginfo( 'name' ); ?></a></div>
			<!--<div class="site-description"><?php bloginfo( 'description' ); ?></div>	-->
		<?php }  ?>
	</div>
<?php $header_logo = ob_get_contents();
ob_end_clean(); ?>
<?php 
/* Header Social media items */
ob_start(); ?>	
	<?php if( $cookie_options['social-media-header-style'] == 'minimal' ){?>
		<div class="header-toggle header-social-toggle toggle-circled text-center">
			<span><i class="fa fa-share-alt"></i></span> 
	<?php } else{ ?>
		<div class="header-social">
	<?php } ?>
			<ul class="social-icons list-inline">
				<?php foreach( $cookie_options['social-media-icons-header'] as $social_checkbox => $social_icons ){
					if( $social_icons == '1' ){ ?>
						<li><a target="<?php echo esc_attr($cookie_options['header-link-target']);?>" href="<?php echo esc_html($cookie_options[ $social_checkbox .'-link' ]);?>"> <i class="fa fa-<?php echo esc_attr($social_checkbox); ?>"></i></a></li>
					<?php }
				} ?>   
			</ul>
		</div>
		<div class="header-toggle tab-header-social-toggle header-social-toggle toggle-circled tab-social-header text-center">
			<span><i class="fa fa-share-alt"></i></span> 
			<ul class="social-icons list-inline">
				<?php foreach( $cookie_options['social-media-icons-header'] as $social_checkbox => $social_icons ){
					if( $social_icons == '1' ){ ?>
						<li><a target="<?php echo esc_attr($cookie_options['header-link-target']);?>" href="<?php echo esc_html($cookie_options[ $social_checkbox .'-link' ]);?>"> <i class="fa fa-<?php echo esc_attr($social_checkbox); ?>"></i></a></li>
					<?php }
				}?>   
			</ul>
		</div>
<?php $header_social = ob_get_contents();
ob_end_clean(); ?>
<?php 
/* Header Additional items(including social icons) */
ob_start(); ?>	
	<div class="header-menu-icons">
		<?php if( $cookie_options['social-media-header'] == '1' && $cookie_options['social-media-header-location'] == '1' ){ echo $header_social ; }?>
		<?php if( $cookie_options['header-search-box'] == '1' ){ ?>
			<div class="header-toggle header-search-toggle toggle-circled">
				<span><i class="ion-ios-search-strong"></i></span>
				<div class="header-search">
					<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="search"><input name="s" type="text" size="40" placeholder="<?php echo esc_attr($cookie_options['header-search-box-text']); ?>" /></form>
				</div>
			</div>
		<?php } ?>
		<?php if( $cookie_options['header-lang-box'] == '1' ){ ?>
			<div class="header-toggle header-lang-toggle toggle-circled">
				<span><?php echo htmlspecialchars_decode( esc_html($cookie_options['header-lang-name']) ); ?></span>
				<?php echo htmlspecialchars_decode( esc_html($cookie_options['header-lang-list']) ); ?>
			</div>
		<?php } ?>
		<?php if( $cookie_options['header-wpml-box'] == '1' && function_exists('agni_wpml_languages_bar') ){
			echo agni_wpml_languages_bar(); 
		} ?>
		<?php if( $cookie_options['header-cart-box'] == '1' ){ 
			if(is_plugin_active( 'woocommerce/woocommerce.php')){?> 
				<div class="header-cart-toggle header-toggle">
					<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'cookie' ); ?>"><?php if($cookie_options['header-cart-amount'] == '1'){ echo WC()->cart->get_cart_total(); } ?><span class="header-toggle toggle-circled"><span class="header-cart-icon"><i class="pe-7s-cart"></i></span><span class="product-count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'cookie' ), WC()->cart->cart_contents_count ); ?></span></span></a>
					<?php the_widget( 'WC_Widget_Cart' ); ?>
				</div>
			<?php } 
		}?>
	</div>
<?php $header_menu_icons = ob_get_contents();
ob_end_clean(); ?>

<?php ob_start(); ?>	
	<nav class="footer-nav-menu additional-nav-menu" >
		<?php  wp_nav_menu(array( 'menu_class' => 'footer-nav-menu-content list-inline', 'menu_id' => 'footer-navigation', 'container' => false, 'theme_location' => 'ternary', 'fallback_cb'     => 'wp_page_menu' ) ); ?> 
	</nav>
<?php $footer_nav = ob_get_contents();
ob_end_clean(); ?>
<?php ob_start(); ?>	
	<div class="footer-social">
		<ul class="social-icons list-inline">
			<?php foreach( $cookie_options['social-media-icons-footer'] as $social_checkbox => $social_icons ){
				if( $social_icons == '1' ){ ?>
					<li><a class="<?php echo esc_attr($cookie_options['social-media-style']); ?>" target="<?php echo esc_attr($cookie_options['footer-link-target']);?>" href="<?php echo esc_html($cookie_options[ $social_checkbox .'-link' ]);?>"> <i class="fa fa-<?php echo esc_attr($social_checkbox); ?>"></i></a></li>
				<?php }
			}?>   
		</ul>
	</div>
<?php $footer_social = ob_get_contents();
ob_end_clean(); ?>
<?php ob_start(); ?>	
	<div class="footer-text"><?php echo esc_html($cookie_options['footer-text']);?></div>
<?php $footer_text = ob_get_contents();
ob_end_clean(); ?>

<div id="page" class="hfeed site wrapper <?php if( $cookie_options['layout-boxed'] == '1' ){ echo 'boxed'; } ?> ">
	<header id="masthead" class="site-header" role="banner">            
		<!-- Header -->  
		<div class="header-navigation-menu <?php if( $cookie_options['fullwidth-header-menu'] == '1'){ echo 'fullwidth-header-menu '; } ?><?php if( $header_transparent == '1' ){ echo 'transparent-nav-menu transparent-native '; } ?><?php if( $cookie_options['header-menu-style'] == 'minimal' ){ echo 'minimal-nav-menu ';} ?><?php if( $cookie_options['shrink-header-menu'] == '1' ){ echo 'shrink-header-menu shrink-native '; } ?><?php if( $cookie_options['header-menu-style'] == 'centered-menu' || $cookie_options['header-menu-style'] == 'centered-logo' ){ echo 'center-header '; }?><?php if( $cookie_options['header-sticky'] == '1' ){ echo 'header-sticky '; } ?> clearfix">
			<?php if( $cookie_options['header-menu-style'] == 'centered-logo' ){ echo $header_logo; }?>
			<div class="header-menu-content">
				<div class="container<?php if( $cookie_options['fullwidth-header-menu'] == '1'){ echo '-fluid'; } ?>">
					<?php if( $cookie_options['header-menu-style'] == 'default' || $cookie_options['header-menu-style'] == 'minimal' || $cookie_options['header-menu-style'] == 'side-header-menu' ){ echo $header_logo; }?>
					<?php //echo $header_logo; ?>
					<div class="header-menu clearfix">
						<?php //if( $cookie_options['header-menu-style'] != 'side-header-menu' ){ echo $header_menu_icons; } ?>
						<?php echo $header_menu_icons;  ?>
					</div>
				</div>
			</div>
			<?php if( $cookie_options['header-menu-style'] == 'centered-menu' ){ echo $header_logo; }?>
		</div>
	</header><!-- #masthead -->
	<div class="spacer"></div>
	
	<div id="content" class="site-content content ">
<?php } 
agni_header_comingsoon(); ?>
