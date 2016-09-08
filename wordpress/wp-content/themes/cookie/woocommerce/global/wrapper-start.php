<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $cookie_options; ?>

<?php if(is_singular('product')){?>
<section class="shop page-single-shop <?php echo $cookie_options['shop-single-sidebar']; ?>">
	<div class="page-single-shop-container container<?php if( $cookie_options['shop-single-fullwidth'] == '1' ){ echo '-fluid '; } ?>">
		<div class="row<?php if( $cookie_options['shop-single-fullwidth'] == '1' ){ echo ' shop-fullwidth'; } ?>">
			<div class="col-sm-12 col-md-<?php if( $cookie_options['shop-single-sidebar'] != 'no-sidebar' ){ echo '8'; }else { echo '12'; } ?> page-single-shop-content">
				<div id="primary" class="content-area">
					<main id="main" class="site-main clearfix" role="main">
<?php } else{?>
<section class="shop page-shop <?php echo $cookie_options['shop-layout']; ?>column-layout-post <?php echo $cookie_options['shop-sidebar']; ?>">
	<div class="page-shop-container container<?php if( $cookie_options['shop-fullwidth'] == '1' ){ echo '-fluid '; } ?><?php if( $cookie_options['shop-navigation'] != '1'){ echo ' has-infinite-scroll '; }?><?php if( $cookie_options['shop-navigation'] == '3'){ echo ' has-load-more'; }?>" data-dir="<?php echo AGNI_FRAMEWORK_URL; ?>">
		<div class="row<?php if( $cookie_options['shop-fullwidth'] == '1' ){ echo ' shop-fullwidth'; } ?><?php if( $cookie_options['shop-gutter'] != '1' ){ echo ' shop-no-gutter'; } ?>">
			<div class="col-sm-12 col-md-<?php if( $cookie_options['shop-sidebar'] != 'no-sidebar' ){ echo '8'; }else { echo '12'; } ?> page-shop-content">
				<div id="primary" class="content-area">
					<main id="main" class="site-main clearfix" role="main">
<?php } ?>
