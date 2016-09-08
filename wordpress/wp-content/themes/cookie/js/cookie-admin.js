// JavaScript Document
(function($) {
  "use strict";
	
	jQuery(document).ready(function($){
		$('#post-formats-select input').change(checkPostFormat);
		
		// Post format choice
		function checkPostFormat(){
			var format = $('#post-formats-select input:checked').attr('value');
			
			$('#normal-sortables >div[id*=_post_options]').hide();
			$('#normal-sortables >div[id=post_format_'+format+'_post_options]').stop(true,true).fadeIn(500);			
		}
		
		$(window).load(function(){
			checkPostFormat();
		});

		// Slider choice
		$('#cmb2-metabox-agni_slides_agni_slider_option input').change(checkagnisliderFormat);
		
		function checkagnisliderFormat(){
			var format = $('#cmb2-metabox-agni_slides_agni_slider_option input:checked').attr('value');

			$('#normal-sortables >div[id*=agni_slides_]').not('#agni_slides_agni_slider_option').hide();
			$('#normal-sortables >div[id=agni_slides_'+format+'_options]').stop(true,true).fadeIn(500);			
		}
		
		$(window).load(function(){
			checkagnisliderFormat();
		});
	});
})(jQuery);