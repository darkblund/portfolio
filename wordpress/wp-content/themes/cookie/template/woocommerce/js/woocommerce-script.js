// JavaScript Document

(function($) {
  "use strict";
	
	$(document).ready(function(){
		
		// Woocommerce ordering
		$('.woocommerce-ordering').each(function() {
			$(this).find('.dropdown-menu a').click(function(w){
				w.preventDefault();

				var $id = $(this).attr('href').replace('#', '');
				$('select[name="orderby"] option').each(function(i, el) {
					$(el).prop('selected', false);
					if($(el).val() == $id) {
						$(el).prop('selected', true);
					}
				});
				$('.woocommerce-ordering').submit();
			});
		});

		// Woocommerce Isotope
		$('.products:not(".related, .upsells")').each(function(){
			if( $(this).data('shop-grid') == 'fitRows' ){
				var $product_container = $(this).imagesLoaded( function() {
					$product_container.isotope({
						itemSelector: '.shop-column',
						layoutMode: 'fitRows',
						fitRows: {
							columnWidth: '.shop-column',
						}
					})
				})	
				$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				  $product_container.isotope();
				});	
				$(window).on('resize', function(){
					$('.products:not(".related, .upsells")').each(function(){
						var $product_container = $(this).imagesLoaded( function() {
							$product_container.isotope({
								itemSelector: '.shop-column',
								layoutMode: 'fitRows',
								fitRows: {
									columnWidth: '.shop-column',
								}
							})
						})
					});
				});
			}
			else{
				var $colwidth = $('.shop-column' )[0].getBoundingClientRect().width;
				var $product_container = $(this).imagesLoaded( function() {
					$product_container.isotope({
						itemSelector: '.shop-column',
						layoutMode: 'masonry',
						masonry: {
							columnWidth: $colwidth,
						}
					})
				})	
				$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				  $product_container.isotope();
				});
				$(window).on('resize', function(){
					$('.products:not(".related, .upsells")').each(function(){
						var $colwidth = $('.shop-column' )[0].getBoundingClientRect().width;
						var $product_container = $(this).imagesLoaded( function() {
							$product_container.isotope({
								itemSelector: '.shop-column',
								layoutMode: 'masonry',
								masonry: {
									columnWidth: $colwidth,
								}
							})
						})
					});
				});
			}
			if( $('.page-shop-container').hasClass('has-infinite-scroll') == true ){
				var $template_url = $('.page-shop-container').data('dir');
				$product_container.infinitescroll({
				    loading: {
					    finished: undefined,
					    finishedMsg: "No more Items <script type='text/javascript'> jQuery('.load-more-button').hide(); </script>",
					                img: $template_url+"/img/load_more.gif",
					    msg: null,
					    msgText: "Loading",
					    selector: '.load-more',
					    speed: 'fast',
					    start: undefined
					},
					extraScrollPx: 70,
				    navSelector  : "div.navigation",      // selector for the paged navigation (it will be hidden) 
				    nextSelector : "div.navigation a:first",    // selector for the NEXT link (to page 2)
				    itemSelector : ".products .shop-column",   // selector for all items you'll retrieve
				},
				function(newElements){
					var $newElems = $(newElements);
					$product_container.imagesLoaded(function(){
					    $product_container.isotope('appended', $newElems);
					});
	            });
	            if( $('.page-shop-container').hasClass('has-load-more') == true ){
			        $(window).unbind('.infscr');
					$('.load-more-button a').on('click', function(i){
						$('.products').infinitescroll('retrieve');
						return false;
					})
				}
			}
		});

		// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});
		
	});


})(jQuery);
