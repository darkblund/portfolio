<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function agni_woocommerce_pagination(){
global $wp_query, $cookie_options;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
?>
		
<?php if( $cookie_options['shop-navigation'] != '1' ){ echo '<div class="load-more text-center"></div>'; } if( $cookie_options['shop-navigation'] == '3' ){ echo '<div class="load-more-button text-center"><a href="#" class="btn btn-default">Load More</a></div>'; } ?>
<div class="woocommerce-pagination page-number-navigation navigation">
	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => '',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
            'prev_text'    => esc_html__('Previous', 'cookie'),
            'next_text'    => esc_html__('Next', 'cookie'),
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );
	?>
</div>
<?php }
agni_woocommerce_pagination(); ?>
