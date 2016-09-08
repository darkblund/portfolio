<?php 

function cookie_options(){
	global $cookie_options;	
	
	if( $cookie_options['loader'] == '1' ){
		if( $cookie_options['loader-style'] == '1' ){
			echo '<style type="text/css">
				body{
					display: none;
				}
			</style>';
		}
	}
	else{
		echo '<style type="text/css">
			body{
				visibility: hidden;
			}
		</style>';
	}
		
	if( $cookie_options['layout-container'] == '1' ){
		$mega_menu_gutter = preg_replace( '/(px|em|\%)$/', '', $cookie_options['layout-container-padding']['padding-right'] ) + preg_replace( '/(px|em|\%)$/', '', $cookie_options['layout-container-padding']['padding-left'] );
		$megamenu_width_992 = $cookie_options['layout-container-992'] - $mega_menu_gutter;
		$megamenu_width_1200 = $cookie_options['layout-container-1200'] - $mega_menu_gutter;
		$megamenu_width_1500 = $cookie_options['layout-container-1500'] - $mega_menu_gutter;

		echo '<style type="text/css">
		/* Container */
		@media (min-width:768px) {
			.container {
				width: '.$cookie_options['layout-container-768'].'px;
			}
			.boxed{
				width: '.$cookie_options['layout-boxed-768'].'px;
			}
		}
		@media (min-width:992px) {
			.container {
				width: '.$cookie_options['layout-container-992'].'px;
			}
			.boxed{
				width: '.$cookie_options['layout-boxed-992'].'px;
			}
			.container .megamenu .sub-menu{
				width:'.$megamenu_width_992.'px;
			}
		}
		@media (min-width:1200px) {
			.container {
				width: '.$cookie_options['layout-container-1200'].'px;
			}
			.boxed{
				width: '.$cookie_options['layout-boxed-1200'].'px;
			}
			.container .megamenu .sub-menu{
				width:'.$megamenu_width_1200.'px;
			}
		}
		@media (min-width:1500px) {
			.container{
				width: '.$cookie_options['layout-container-1500'].'px;
			}
			.boxed{
				width: '.$cookie_options['layout-boxed-1500'].'px;
			}
			.container .megamenu .sub-menu{
				width:'.$megamenu_width_1500.'px;
			}
		}
		</style>';
	}

	if( $cookie_options['custom-logo-height'] == '1' ){
		$custom_height = $cookie_options['custom-logo-height-value'];
		$nav_menu_line_height = ($custom_height - 50) + 100;
		$header_icon_margin = ($custom_height - 50)/2 + 34;
		$header_toggle_menu_padding = ($custom_height - 50)/2 + 20;

		echo '<style type="text/css">
			.header-icon img{
				max-height:'.$custom_height.'px;
			}
			@media (max-width: 767px) {	
				.header-icon img {
					max-height:32px;
				}
			}
		</style>';
		if( $cookie_options['header-menu-style'] == 'default' || $cookie_options['header-menu-style'] == 'minimal' ){
			echo '<style type="text/css">
				.nav-menu{
					line-height: '.$nav_menu_line_height.'px;
				}
				.header-menu-icons{
					margin: '.$header_icon_margin.'px 0px;
				}
				.toggle-nav-menu{
					padding: '.$header_toggle_menu_padding.'px 0px;
				}
				@media (max-width: 767px) {	
					.header-menu-icons{
						margin:14px 0;
					}
					.toggle-nav-menu{
						padding: 12px 0px;
					}
				}
			</style>';
		}
	}

	echo '<style type="text/css">
		/* cookie.css */
		
		/* Custom colors */
		.additional-nav-menu a:hover, .nav-menu-content li a:hover, .nav-menu-content li a:active, .nav-menu-content li.current-menu-item:not(.current_page_item) > a, .nav-menu-content li ul li.current-menu-item:not(.current_page_item) > a, .nav-menu-content li.current-menu-item:not(.current_page_item) > a:hover, .nav-menu-content li ul li.current-menu-item:not(.current_page_item) > a:hover, .tab-nav-menu a:hover, .header-toggle ul a:hover, .post-author a, .post-sharing-buttons a:hover, .archive .page-title, .search .page-title, .widget_cookie_social_icons a:hover, .filter a:hover, .filter a:focus, .filter a.active, .section-heading-icon, .pricing-recommanded .pricing-cost{
			color: '.$cookie_options['color-1'].';
		}
		.nav-menu-content li.current-menu-item:not(.current_page_item) > a, .nav-menu-content li ul li.current-menu-item:not(.current_page_item) > a, .nav-menu-content li.current-menu-item:not(.current_page_item) > a:hover, .nav-menu-content li ul li.current-menu-item:not(.current_page_item) > a:hover{
			color: '.$cookie_options['header-menu-link-color-1']['hover'].';
		}
		.nav-menu-content .current_page_ancestor .current-menu-item:not(.current_page_item) > a {
		    color:'.$cookie_options['header-menu-link-color-1']['regular'].';
		}
		.nav-menu-content .current_page_ancestor .current-menu-item:not(.current_page_item) > a:hover {
			color:'.$cookie_options['header-menu-link-color-1']['hover'].';
		}
		.sticky:before, .page-numbers li span:not(.dots), .blog-single-post .tags-links a, .portfolio-hover-style-8 .portfolio-meta:before, .divide-line span, #jpreBar{
			background-color: '.$cookie_options['color-1'].';
		}
		.owl-dot.active span, #fp-nav ul li a.active span,
#fp-nav ul li:hover a.active span, #multiscroll-nav li .active span, .slides-pagination a.current, .entry-title:after, .page-numbers li span:not(.dots), .archive .page-header, .search .page-header, .widget_cookie_social_icons a:hover, .portfolio-meta, .member-meta, .milestone-style-1  .mile-count h3:after, .feature-box-title:after{
			border-color: '.$cookie_options['color-1'].';
		}
		.pricing-table-content.pricing-recommanded-style-1 .pricing-title:after{
			border-top-color: '.$cookie_options['color-1'].';
		}

		input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea, a, .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6, .h1 .small, .h1 small, .h2 .small, .h2 small, .h3 .small, .h3 small, .h4 .small, .h4 small, .h5 .small, .h5 small, .h6 .small, .h6 small, h1 .small, h1 small, h2 .small, h2 small, h3 .small, h3 small, h4 .small, h4 small, h5 .small, h5 small, h6 .small, h6 small, .toggle-nav-menu, .slides-navigation a, .portfolio-navigation-container .post-navigation a, .mile-icon i, .footer-bar .textwidget i{
			color: '.$cookie_options['color-2'].';
		}
		.portfolio-hover-style-3 .portfolio-icon span:before, .portfolio-hover-style-3 .portfolio-icon span:after, .nav-tabs-style-3 .nav-tabs li.active, .accordion-style-3 .panel-title:not(.collapsed){
			background-color: '.$cookie_options['color-2'].';
		}
		.portfolio-hover-style-4 .portfolio-post .portfolio-title, .nav-tabs-style-1 .nav-tabs li.active a, .nav-tabs li a:hover, .nav-tabs li a:focus, .nav-tabs-style-2 .nav-tabs li.active, .accordion-style-1 .panel-title, .accordion-style-1 .panel-title.collapsed:hover, .accordion-style-1 .panel-title.collapsed:focus, .accordion-style-3 .panel-title:not(.collapsed){
			border-color: '.$cookie_options['color-2'].';
		}

		body, .post-sharing-buttons a, .widget_cookie_instagram_feed .follow-link, .portfolio-hover-style-6 .portfolio-meta a, .pricing-cost{
			color: '.$cookie_options['color-3'].';
		}
		.widget_cookie_instagram_feed .follow-link, .portfolio-hover-style-6 .portfolio-meta a{
			border-color: '.$cookie_options['color-3'].';
		}

		/* Buttons */
		.btn-default {
			background-color: '.$cookie_options['color-3'].';
			border-color: '.$cookie_options['color-3'].';
		}
		.btn-default:active, .btn-default:focus, .btn-default:hover {
			color: '.$cookie_options['color-3'].';
			background-color: transparent;
		}
		.btn-primary {
			background-color: '.$cookie_options['color-2'].';
			border-color: '.$cookie_options['color-2'].';
		}
		.btn-primary:active, .btn-primary:focus, .btn-primary:hover {
			color: '.$cookie_options['color-2'].';
			background-color: transparent;
		}
		.btn-accent {
			background-color: '.$cookie_options['color-1'].';
			border-color: '.$cookie_options['color-1'].';
		}
		.btn-accent:active, .btn-accent:focus, .btn-accent:hover {
			color: '.$cookie_options['color-1'].';
			background-color: transparent;
		}
		.btn-alt, .btn-alt:focus, .btn-alt:hover {
			background-color: transparent;
		}
		.btn-default.btn-alt {
			color: '.$cookie_options['color-3'].';
		}
		.btn-primary.btn-alt {
			color: '.$cookie_options['color-2'].';
		}
		.btn-accent.btn-alt {
			color: '.$cookie_options['color-1'].';
		}
		.btn-default.btn-alt:focus, .btn-default.btn-alt:hover {
			background-color: '.$cookie_options['color-3'].';
			color: #fff;
		}
		.btn-primary.btn-alt:focus, .btn-primary.btn-alt:hover {
			background-color: '.$cookie_options['color-2'].';
			color: #fff;
		}
		.btn-accent.btn-alt:focus, .btn-accent.btn-alt:hover {
			background-color: '.$cookie_options['color-1'].';
			color: #fff;
		}
		.btn-link {
			color: '.$cookie_options['color-2'].';
			border-color: transparent;
		}
		.btn-link:active, .btn-link:focus, .btn-link:hover {
			border-color: '.$cookie_options['color-2'].';
		}


		.has-padding, .has-padding .top-padding, .has-padding .bottom-padding, .has-padding .header-sticky, .has-padding .header-top-bar, .has-padding .header-navigation-menu{
			border-width: '.$cookie_options['layout-padding-size']['border-top'].';
		}
		@media (min-width:1200px) {
			.has-padding .side-header-menu{
				margin-left: '.$cookie_options['layout-padding-size']['border-top'].';
				margin-top: '.$cookie_options['layout-padding-size']['border-top'].';
				bottom: '.$cookie_options['layout-padding-size']['border-top'].';
			}
		}
		@media (min-width:768px) {
			.has-padding .mfp-main .mfp-container{
				border-width: '.$cookie_options['layout-padding-size']['border-top'].';
			}
		}
		.has-padding, .has-padding .top-padding, .has-padding .bottom-padding, .has-padding .header-top-bar, .has-padding .header-navigation-menu, .has-padding .mfp-main .mfp-container{
			border-color: '.$cookie_options['layout-padding-size']['border-color'].';
		}

		.toggle-circled{
		    border-color: '.$cookie_options['header-icon-link-color-1']['regular'].';
		}
		.header-social a, .header-toggle a, .header-toggle span{
		    color: '.$cookie_options['header-icon-link-color-1']['regular'].';
		}
		.header-toggle ul a:hover{
		    color: '.$cookie_options['header-icon-link-color-1']['hover'].';
		}
		.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .toggle-circled{
		    border-color: '.$cookie_options['header-icon-link-color-2']['regular'].';
		}
		.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-social a, .header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle a, .header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle span{
		    color: '.$cookie_options['header-icon-link-color-2']['regular'].';
		}
		.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle ul a:hover{
		    color: '.$cookie_options['header-icon-link-color-2']['hover'].';
		}
		
		.toggle-nav-menu{
			color: '.$cookie_options['header-menu-link-color-1']['regular'].';
		}
		.header-sticky.top-sticky .toggle-nav-menu.toggle-nav-menu-additional{
			color: '.$cookie_options['header-menu-link-color-2']['regular'].';
		}
		.burg, .burg:before, .burg:after{
			background-color: '.$cookie_options['header-menu-link-color-1']['regular'].';
		}

		.header-sticky.top-sticky .toggle-nav-menu-additional .burg, .header-sticky.top-sticky .toggle-nav-menu-additional .burg:before, .header-sticky.top-sticky .toggle-nav-menu-additional .burg:after{
			background-color: '.$cookie_options['header-menu-link-color-2']['regular'].';
		}
		.activeBurg.burg, .activeBurg.burg:before, .activeBurg.burg:after{
			background-color: '.$cookie_options['header-menu-link-color-1']['regular'].';
		}
		.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg, .header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:before, .header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:after{
			background-color: '.$cookie_options['header-menu-link-color-1']['regular'].';
		}
		.header-navigation-menu .header-menu-content, .side-header-menu .tab-nav-menu, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .reverse_skin.header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu{
			border-left:0;
			border-right:0;
			border-top: '    . $cookie_options['header-menu-border-1']['border-top'].';
			border-bottom: ' . $cookie_options['header-menu-border-1']['border-bottom'].';
			border-style: '  . $cookie_options['header-menu-border-1']['border-style'].';
		}
		.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu, .reverse_skin.header-navigation-menu .header-menu-content, .reverse_skin.side-header-menu .tab-nav-menu{
			border-top: '    . $cookie_options['header-menu-border-2']['border-top'].';
			border-bottom: ' . $cookie_options['header-menu-border-2']['border-bottom'].';
			border-style: '  . $cookie_options['header-menu-border-2']['border-style'].';
		}
		
		
		/* Reverse Skin */
		.reverse_skin .toggle-circled{
		    border-color: '.$cookie_options['header-icon-link-color-2']['regular'].';
		}
		.reverse_skin .reverse_skin .header-social a, .reverse_skin .header-toggle a, .reverse_skin .header-toggle span{
		    color: '.$cookie_options['header-icon-link-color-2']['regular'].';
		}
		.reverse_skin .header-toggle ul a:hover{
		    color: '.$cookie_options['header-icon-link-color-2']['hover'].';
		}
		.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .toggle-circled{
		    border-color: '.$cookie_options['header-icon-link-color-1']['regular'].';
		}
		.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-social a, .reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle a, .reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle span{
		    color: '.$cookie_options['header-icon-link-color-1']['regular'].';
		}
		.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle ul a:hover{
		    color: '.$cookie_options['header-icon-link-color-1']['hover'].';
		}
		
		.reverse_skin .toggle-nav-menu{
			color: '.$cookie_options['header-menu-link-color-2']['regular'].';
		}
		.reverse_skin.header-sticky.top-sticky .toggle-nav-menu.toggle-nav-menu-additional{
			color: '.$cookie_options['header-menu-link-color-1']['regular'].';
		}
		.reverse_skin .burg, .reverse_skin .burg:before, .reverse_skin .burg:after{
			background-color: '.$cookie_options['header-menu-link-color-2']['regular'].';
		}

		.reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .burg, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .burg:before, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .burg:after{
			background-color: '.$cookie_options['header-menu-link-color-1']['regular'].';
		}
		.reverse_skin .activeBurg.burg, .reverse_skin .activeBurg.burg:before, .reverse_skin .activeBurg.burg:after{
			background-color: '.$cookie_options['header-menu-link-color-1']['regular'].';
		}
		.reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:before, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:after{
			background-color: '.$cookie_options['header-menu-link-color-1']['regular'].';
		}

		.footer-social .circled{
			color: '.$cookie_options['footer-social-link-color']['regular'].';
		}
		.footer-social a, .footer-social .circled{
			color: '.$cookie_options['footer-social-link-color']['regular'].';
		}
		.footer-social .circled{
			border-color: '.$cookie_options['footer-social-link-color']['regular'].';
		}
		.footer-social a:hover, .footer-social .circled:hover{
			color: '.$cookie_options['footer-social-link-color']['hover'].';
		}
		.footer-social .circled:hover{
			border-color: '.$cookie_options['footer-social-link-color']['hover'].';
		}
		.footer-bar .widget-title:after, .search-form, .mc4wp-form form, .widget_calendar tbody td{
			border-color: '. $cookie_options['footerbar-color-4']['border-color'].';
		}
		.activeBurg.burg, .header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg, .reverse_skin .activeBurg.burg, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg{
			background-color: transparent;
		}
		.portfolio-navigation-container .post-navigation a {
		    background-color: transparent;
		}
	</style>';

	// Woocommerce
	if( class_exists('WooCommerce') ){
		echo '<style type="text/css">
			.woocommerce .products .product-add-to-cart .product-add-to-cart-button a.add_to_cart_button.product_type_simple.loading, .woocommerce .sidebar .widget_shopping_cart .buttons a:hover, .woocommerce .star-rating:before, .woocommerce .star-rating span:before, .woocommerce #comments .star-rating span:before, .woocommerce p.stars a.star-1:after, .woocommerce p.stars a.star-2:after, .woocommerce p.stars a.star-3:after, .woocommerce p.stars a.star-4:after, .woocommerce p.stars a.star-5:after, .woocommerce-shipping-calculator .shipping-calculator-button{
				color: '.$cookie_options['color-1'].';
			}
			.woocommerce .products .product-add-to-cart .product-add-to-cart-button a.add_to_cart_button.product_type_simple.added, .woocommerce-dropdown-list li.active a, .woocommerce .sidebar .widget_shopping_cart .buttons a, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .page-cart-calculation .cart-collaterals .wc-proceed-to-checkout a:hover, .woocommerce .login input[type="submit"], .woocommerce-checkout-payment .place-order input[type="submit"]:hover, .header-cart-toggle .product-count, .header-cart-toggle .buttons a{
				background-color: '.$cookie_options['color-1'].';
			}
			.woocommerce .products .product-add-to-cart .product-add-to-cart-button a.add_to_cart_button.product_type_simple.loading, .woocommerce .sidebar .widget_shopping_cart .buttons a, .woocommerce .products .product-add-to-cart .product-add-to-cart-button a.add_to_cart_button.product_type_simple.added{
				border-color: '.$cookie_options['color-1'].';
			}
			.woocommerce .price > .amount, .woocommerce .price ins{
				color: '.$cookie_options['color-2'].';
			}
			.woocommerce .products .product .onsale, .woocommerce .widget_price_filter .price_slider_amount .button, .single-product-page .single-product-images .onsale, .single-product-page .single-product-description button, .woocommerce .page-cart-summary .shop_table input[type="submit"], .woocommerce .page-cart-calculation .cart-collaterals .wc-proceed-to-checkout a, .woocommerce-checkout-payment .place-order input[type="submit"], .woocommerce .track_order input[type="submit"]{
				background-color: '.$cookie_options['color-2'].';
				border-color: '.$cookie_options['color-2'].';
			}
			.woocommerce .products .product .onsale:hover, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .single-product-page .single-product-images .onsale:hover, .single-product-page .single-product-description button:hover, .woocommerce .page-cart-summary .shop_table input[type="submit"]:hover, .woocommerce .track_order input[type="submit"]:hover{
				background-color: transparent;
				color: '.$cookie_options['color-2'].';
			}
			.woocommerce .products .product-add-to-cart .product-add-to-cart-button a, .single-product-page .single-product-description button{
				border-color: '.$cookie_options['color-2'].';
				//background-color: transparent;
				color: '.$cookie_options['color-2'].';
			}

			.woocommerce .products .product-add-to-cart .product-add-to-cart-button a:hover{
				background-color: '.$cookie_options['color-2'].';
				color: #fff;
			}
			.single-product-page .single-product-description button{
				border-color: '.$cookie_options['color-2'].';
				color: #fff;
				background-color: '.$cookie_options['color-2'].';
			}
			.single-product-page .single-product-description button:hover{
				background-color: transparent;
				color: '.$cookie_options['color-2'].';
			}
			.woocommerce .price, .woocommerce-dropdown-list, .toggle-woocommerce-dropdown, .woocommerce-dropdown-list li a, .single-product-page .single-product-description table .label{
				color: '.$cookie_options['color-3'].';
			}
			.woocommerce .page-cart-summary .shop_table .coupon input[type="submit"], .woocommerce .cart_totals .shipping-calculator-form button, .woocommerce .checkout_coupon input[type="submit"], .woocommerce .lost_reset_password input[type="submit"]{
				background-color: '.$cookie_options['color-3'].';
				border-color: '.$cookie_options['color-3'].';
			}
			.woocommerce .page-cart-summary .shop_table .coupon input[type="submit"]:hover, .woocommerce .cart_totals .shipping-calculator-form button:hover, .woocommerce .checkout_coupon input[type="submit"]:hover, .woocommerce .lost_reset_password input[type="submit"]:hover{
				background-color: transparent;
				color: '.$cookie_options['color-3'].';
			}
		</style>';
	}
	
	//custom css
	if(!empty($cookie_options["css-code"])){
		echo '<style type="text/css">' . $cookie_options["css-code"] . '</style>';
	}
	
	//custom js
	if(!empty($cookie_options["js-code"])){
		echo '<script>(function($) {' . $cookie_options["js-code"] . ' })(jQuery);</script>';
	}
	//custom php
	/*if(!empty($cookie_options["php-code"])){
		echo $cookie_options["php-code"];
	}*/
	
}
add_action( 'wp_head', 'cookie_options' );

?>