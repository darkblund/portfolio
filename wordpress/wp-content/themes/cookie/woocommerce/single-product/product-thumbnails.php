<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function agni_product_thumbnail(){
	global $post, $product, $woocommerce, $cookie_options ;

	$attachment_ids = $product->get_gallery_attachment_ids();

	if ( $attachment_ids ) {
		$loop 		= 0;
		$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
		?>

		<?php
			if( $cookie_options['shop-single-thumbnail-style'] == 'single-product-hover-style-2' ){
				if ( has_post_thumbnail() ) {

					$single_image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$single_image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
					$single_image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
					$single_image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'cookie-grid-thumbnail' ), array(
						'title'	=> $single_image_title,
						'alt'	=> $single_image_title
						) );
				}
			} 
		?>

		<div class="thumbnails <?php echo 'columns-' . $columns; ?>"><?php
			if( $cookie_options['shop-single-thumbnail-style'] == 'single-product-hover-style-2' ){
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" data-standard="%s">%s</a>', $single_image_link, $single_image_link, $single_image ), $post->ID );
			}
			
			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array(  );

				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';

				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';

				$image_link = wp_get_attachment_url( $attachment_id );

				if ( ! $image_link )
					continue;

				$image_title 	= esc_attr( get_the_title( $attachment_id ) );
				$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'thumbnail' ), 0, $attr = array(
					'title'	=> $image_title,
					'alt'	=> $image_title
					) );

				$image_class = esc_attr( implode( ' ', $classes ) );

				if( $cookie_options['shop-single-thumbnail-style'] == 'single-product-hover-style-2' ){
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-standard="%s">%s</a>', $image_link, $image_class, $image_caption, $image_link, $image ), $attachment_id, $post->ID, $image_class );
				}
				else{
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s">%s</a>', $image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );
				}
				$loop++;
			}

		?></div>
		<?php
	}
}
agni_product_thumbnail();

