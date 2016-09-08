<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function agni_product_image(){
global $post, $woocommerce, $product, $cookie_options;

?>
<div class="images <?php if( $cookie_options['shop-single-thumbnail-style'] == 'single-product-hover-style-1' ){ echo 'custom-gallery'; }?>">

	<?php
		if ( has_post_thumbnail() ) {

			$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'cookie-grid-thumbnail' ), array(
				'title'	=> $image_title,
				'alt'	=> $image_title
				) );

			if( $cookie_options['shop-single-thumbnail-style'] == 'single-product-hover-style-2' ){
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails"><a href="%s">%s</a></div>', $image_link, $image ), $post->ID );
			}
			else{
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image" title="%s">%s</a>', $image_link, $image_caption, $image ), $post->ID );

			}

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'cookie' ) ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
<?php }
agni_product_image(); ?>
