<?php
/**
 * Single Product title
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
$procuct_subtitle = '';
$product_subtitle = get_post_meta( $post->ID,'product_subtitle', true );

?>
<h3 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h3>
<?php if( !empty( $product_subtitle ) ){ echo '<div class="product-subtitle additional-heading">'.$product_subtitle.'</div>'; } ?>
