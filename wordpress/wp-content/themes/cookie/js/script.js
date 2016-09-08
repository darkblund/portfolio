// JavaScript Document
(function($) {
  "use strict";
	// makes sure the whole site is loaded	
	$(window).on('load', function() {
		// will first fade out the loading animation
		$(".preloader").fadeOut();
		$("body").css({'visibility':'visible'});
		// will fade out the whole DIV that covers the website.
		$(".preloader").delay(500).slideUp('slow');
		if(!(/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera)){
			// youtube video
			$(".player").each(function(){
				$(this).YTPlayer();
			});
		}
		else{
			// youtube video fallback
			$(".player").each(function(){
				$(this).addClass('player-background');
			});
			$('.section-video-controls').css({'display':'none'});
		}
		if(!(/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera) ){
			// skrollr
			skrollr.init({
				smoothScrolling: false,
				mobileDeceleration: 0.004,
				forceHeight: false
			});	
		}
		else{
			// skrollr fallback
			$('html').addClass('no-Skrollr');	
		}
		
	})
	
	jQuery(document).on('ready', function(){
		$('.preloader').each(function(){
			if( $(this).data('preloader-style') == '1' ){
				$('body').jpreLoader({
					splashID: "#preloader-1",
					loaderVPos: '50%',
					autoClose: $(this).data('close-button'),
					closeBtnText: $(this).data('close-button-text'),
				});
			}
		})			
		$("body").css({'visibility':'visible'}); 

		if((/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera) && !$('body').hasClass('has-animation-mobile') ){
			$("div").removeClass('animate');
		}
		// browser check
		var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
		var is_explorer = navigator.userAgent.indexOf('MSIE') > -1 || navigator.appVersion.indexOf('Trident/') > 0 ;
		var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
		var is_safari = navigator.userAgent.indexOf("Safari") > -1;
		var is_opera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;//navigator.userAgent.indexOf("Presto") > -1;
		if ((is_chrome)&&(is_safari)) {is_safari=false;}
		
		if( is_safari ){
			$('html').addClass('safari');	
		}
		else if( is_explorer ){
			$('html').addClass('ie');
		}
		else if( is_firefox ){
			$('html').addClass('firefox');	
		}
		else if( is_opera ){
			$('html').addClass('opera');	
		}
		else {
			$('html').addClass('chrome');
		}

		// spacer
		//var $headerMenuHeight = $('.header-navigation-menu:not(.transparent-nav-menu, .side-header-menu)').height();
		if( !$('.header-navigation-menu').hasClass('transparent-native') ){
			var $headerMenuHeight = ( $(window).width() < 1200 )?$('.header-navigation-menu:not(.transparent-nav-menu)').height():$('.header-navigation-menu:not(.transparent-nav-menu, .side-header-menu)').height();
			var $headerTopHeight = ( $('.header-top-bar:not(.transparent-nav-menu)').is(":visible") )?$('.header-top-bar:not(.transparent-nav-menu)').height(): 0;
			var $spacerHeight = $headerTopHeight + $headerMenuHeight;
			$('.spacer').css({"height":$spacerHeight+"px"});
			$(window).on('resize', function(){
				var $headerMenuHeight = ( $(window).width() < 1200 )?$('.header-navigation-menu:not(.transparent-nav-menu)').height():$('.header-navigation-menu:not(.transparent-nav-menu, .side-header-menu)').height();
				var $headerTopHeight = ( $('.header-top-bar:not(.transparent-nav-menu)').is(":visible") )?$('.header-top-bar:not(.transparent-nav-menu)').height(): 0;
				var $spacerHeight = $headerTopHeight + $headerMenuHeight;
				$('.spacer').css({"height":$spacerHeight+"px"});
			})
		}
		
		// back to top			
		$('#back-to-top').fadeOut(duration);
		var offset = 220;
		var duration = 1000;
		$(window).on('scroll', function() {
			if ($(this).scrollTop() > offset) {
				$('.back-to-top').fadeIn(duration);
			} else {
				$('.back-to-top').fadeOut(duration);
			}
		});
		
		$('#back-to-top').on('click', function(event) {
			event.preventDefault();
			$('html, body').animate({scrollTop: 0}, duration);
			return false;
		})
				
		// one page scroll
		$('.page-scroll a').on('click', function(event) {
			$('html, body').stop().animate({
				scrollTop: $('.header-sticky').height()?$(this.hash).offset().top - 60:$(this.hash).offset().top,
			}, 1500, 'easeInOutExpo');
			event.preventDefault();
			return false;
		});

		// Header shrink
		$.fn.agni_shrink = function($offset) {
			($(window).scrollTop() < offset)?$(this).removeClass('shrink-header-menu'):$(this).addClass('shrink-header-menu');
			return this;
		};
		$('.header-navigation-menu.header-sticky:not(.shrink-native)').agni_shrink(400);
		$(window).on('scroll', function(){
			$('.header-navigation-menu.header-sticky:not(.shrink-native)').agni_shrink(400);
		});

		$.fn.agni_transparent = function($offset) {
			($(window).scrollTop() < offset)?$(this).addClass('transparent-nav-menu'):$(this).removeClass('transparent-nav-menu');
			return this;
		};
		$('.header-navigation-menu.transparent-native').agni_transparent(400);
		$(window).on('scroll', function(){
			$('.header-navigation-menu.transparent-native').agni_transparent(400);
		});
		$.fn.agni_sticky = function($offset) {
			($(window).scrollTop() < offset)?$(this).removeClass('top-sticky'):$(this).addClass('top-sticky');
			return this;
		};
		$('.header-navigation-menu.header-sticky').agni_sticky(400);
		$(window).on('scroll', function(){
			$('.header-navigation-menu.header-sticky').agni_sticky(400);
		});

		$('.header-cart-toggle .cart-contents').on('click', function(c){
			c.preventDefault();
		})

		// nav menu indicator
		//$('.nav-menu-content >li.menu-item-has-children >a').append("<i class=\"nav-menu-indicator ion-ios-plus-empty\"></i>");
		$('.nav-menu-content .sub-menu .menu-item-has-children:not(.megamenu, .col-md-2, .col-md-3, .col-md-4, .col-md-6) >a').append("<i class=\"nav-submenu-indicator ion-ios-plus-empty\"></i>");

		// tab-nav-menu
		//$(".header-navigation-menu:not('.side-header-menu') .tab-nav-menu-content").parent('.tab-nav-menu').slideUp(400);
		if( $(window).width() < 1200 ){
			$(".header-navigation-menu").find('.tab-nav-menu').slideUp(400);
		}
		else{
			$(".header-navigation-menu:not('.side-header-menu')").find('.tab-nav-menu').slideUp(400);
		}
		$(window).on('resize', function(){
			if( $(window).width() < 1200 ){
				$(".header-navigation-menu").find('.tab-nav-menu').slideUp(400);
			}
			else{
				$(".header-navigation-menu:not('.side-header-menu')").find('.tab-nav-menu').slideUp(400);
				$(".side-header-menu").find('.tab-nav-menu').slideDown(100);
			}
		})
		$(".tab-nav-menu-content li:not('.menu-item-has-children') a, .toggle-nav-menu").on('click', function(m){
			m.preventDefault();			
			$('.toggle-nav-menu').find('.burg').toggleClass('activeBurg');		
		});

		$('.toggle-nav-menu').on('click', function(m){
			m.preventDefault();
			
			if ( $(this).parents('.header-navigation-menu').find('.tab-nav-menu-content').is(':hidden') ) {		
				$(this).parents('.header-navigation-menu').find('.tab-nav-menu-content').slideDown(400);
				if( $(window).width() < 1200 ){
					$(this).parents(".header-navigation-menu").find('.tab-nav-menu-content').parent('.tab-nav-menu').slideDown(400).fadeIn('slow');
				}
				else{
					$(this).parents(".header-navigation-menu:not('.side-header-menu')").find('.tab-nav-menu-content').parent('.tab-nav-menu').slideDown(400).fadeIn('slow');
				}
			}
			else{
				$(this).parents('.header-navigation-menu').find('.tab-nav-menu-content').slideUp(400);
				if( $(window).width() < 1200 ){
					$(this).parents(".header-navigation-menu").find('.tab-nav-menu-content').parent('.tab-nav-menu').slideUp(400).fadeOut('fast');
				}
				else{
					$(this).parents(".header-navigation-menu:not('.side-header-menu')").find('.tab-nav-menu-content').parent('.tab-nav-menu').slideUp(400).fadeOut('fast');
				}
			}
					
		});
		if( $(window).width() < 1200 || $(".header-navigation-menu").hasClass("minimal-nav-menu") ){
			$(".tab-nav-menu-content li:not('.menu-item-has-children') a").on('click', function(m){
				
				if ( $('.tab-nav-menu-content').is(':hidden') ) {		
					$('.tab-nav-menu-content').slideDown(400);
					$(".header-navigation-menu .tab-nav-menu-content").parent('.tab-nav-menu').slideDown(400).fadeIn('slow');

				}
				else{
					$('.tab-nav-menu-content').slideUp(400);
					$(".header-navigation-menu .tab-nav-menu-content").parent('.tab-nav-menu').slideUp(400).fadeOut('fast');			
				}
						
			});
		}
		$(window).on('resize', function(){
			if( $(window).width() < 1200 || $(".header-navigation-menu").hasClass("minimal-nav-menu") ){
				$(".tab-nav-menu-content li:not('.menu-item-has-children') a").on('click', function(m){
					
					if ( $('.tab-nav-menu-content').is(':hidden') ) {		
						$('.tab-nav-menu-content').slideDown(400);
						$(".header-navigation-menu .tab-nav-menu-content").parent('.tab-nav-menu').slideDown(400).fadeIn('slow');

					}
					else{
						$('.tab-nav-menu-content').slideUp(400);
						$(".header-navigation-menu .tab-nav-menu-content").parent('.tab-nav-menu').slideUp(400).fadeOut('fast');			
					}
							
				});
			}
		});
		
		// mobile menu		
		$('.tab-nav-menu-content .menu-item-has-children >a').append("<a class=indicator href=#><i class=\"ion-ios-plus-empty\"></i></a>");
		$('.tab-nav-menu-content .menu-item-has-children a.indicator').click(function(m){
			m.preventDefault();
			m.stopImmediatePropagation();
			if ( $(this).parent(' a ').parent(' li ').children('.sub-menu').is(':hidden')  ) {		
				$(this).parent(' a ').parent(' li ').children('.sub-menu').slideDown(400);
			}
			else
			{
				$(this).parent(' a ').parent(' li ').children('.sub-menu').slideUp(400);
			}		
			
		});		
		
		// Removing mega menu for mobile
		$('.tab-nav-menu-content li').each(function(){
			$(this).removeClass("megamenu col-md-2 col-md-3 col-md-4 col-md-6");
		});

		// Post Carousel
		$('.agni-posts-carousel').each(function() {
			$(this).owlCarousel({
				autoplay : $(this).data('carousel-autoplay'),
				autoplayTimeout:4000,
				loop: $(this).data('carousel-loop'),
				margin: $(this).data('carousel-margin'),
				nav: $(this).data('carousel-navigation'),
				pagination: $(this).data('carousel-navigation'),
				navText: ['<i class="fa fa-angle-left">','<i class="fa fa-angle-right">'],
				responsive:{
					0:{
						items:1
					},
					768:{
						items:2
					},
					992:{
						items:3
					}
				}			
			})
		});

		// Page Header
		$('.agni-page-header').each(function(){
			var $inherited_height = window; 
			if( $(this).data('inherited-height') ){
				$inherited_height = $(this).data('inherited-height')
			}
			$(this).superslides({
				inherit_width_from: '.agni-page-header',
        		inherit_height_from: $inherited_height //$(this).data('inherited-height')
			});
			
		});

		// Agni Slider
		$('.agni-slides').each(function(){
			
			// super slider	
			//if(!(/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera)){
			if(!(/Android/i).test(navigator.userAgent || navigator.vendor || window.opera)){
				Hammer($(this)[0]).on("swipeleft", function(e) {
					$(this).data('superslides').animate('next');
				});
				Hammer($(this)[0]).on("swiperight", function(e) {
					$(this).data('superslides').animate('prev');
				});	
			}
			var $inherited_height = window; 
			if( $(this).data('inherited-height') ){
				$inherited_height = $(this).data('inherited-height')
			}
			$(this).superslides({
				inherit_width_from: '.agni-slides',
        		inherit_height_from: $inherited_height,
				animation_easing: 'easeOutQuad',
				animation_speed: $(this).data('slide-transition-speed'),
				animation:  $(this).data('slide-animation'),
				pagination: $(this).data('slide-pagination'),
				play: $(this).data('slide-animation-speed')
			});	
							
			$.fn.slideAnimation = function ( element, animation, speed ) {
				var $element = $(element);
				$(document).on('animating.slides', function() {
					$element.addClass('animate');   
					window.setTimeout( function(){
						$element.removeClass('animate');
					}, speed);       
				});
				$(document).on('animated.slides', function() {
					$element.addClass('animated ' + animation);  
					window.setTimeout( function(){
						$element.removeClass('animated');
					}, speed);       
				});		
			};
								
			$(this).find('.slide-title.animation').each(function(){
				$.fn.slideAnimation(this, 'fadeIn', 1000);
			})
			$(this).find('.slide-divide-line.animation').each(function(){
				$.fn.slideAnimation(this, 'fadeIn', 1000);
			})
			$(this).find('.slide-additional-title.animation').each(function(){
				$.fn.slideAnimation(this, 'fadeInUp', 1500);
			})
			$(this).find('.slide-button.animation').each(function(){
				$.fn.slideAnimation(this, 'fadeInDown', 1500);
			})
			
		});
		$('.agni-video').each(function(){		
			if(!(/Android/i).test(navigator.userAgent || navigator.vendor || window.opera)){
				Hammer($(this)[0]).on("swipeleft", function(e) {
					$(this).data('superslides').animate('next');
				});
				Hammer($(this)[0]).on("swiperight", function(e) {
					$(this).data('superslides').animate('prev');
				});	
			}
			var $inherited_height = window; 
			if( $(this).data('inherited-height') ){
				$inherited_height = $(this).data('inherited-height')
			}
			$(this).superslides({
				inherit_width_from: '.agni-video',
				inherit_height_from: $inherited_height,
				animation_speed: $('.agni-video').data('slide-transition-speed'),
				animation:  $('.agni-video').data('slide-animation'),
				pagination: $('.agni-video').data('slide-pagination'),
				play:  $('.agni-video').data('slide-animation-speed')
				
			});
		});
		
		// text rotator
		$('.text-rotator').each(function() {
			$(this).find('.rotate').textrotator({
				animation: $(this).data('text-animation'),//animation: "spin",
				separator: "|",
				speed: $(this).data('text-animation-speed')
			});
		});

		// mbYTPlayer controls 
		$('.player').each(function() {
			$(this).on("YTPStart",function(e){
				$(this).siblings('div').children('.command-play').css({'display':'none'});	
				$(this).siblings('div').children('.command-pause').css({'display':'inline-block'});
			});
			$(this).on("YTPPause",function(e){
				$(this).siblings('div').children('.command-pause').css({'display':'none'});	
				$(this).siblings('div').children('.command-play').css({'display':'inline-block'});
			});

			$(this).siblings('div').find('.command-play').click(function(event) {
				event.preventDefault();
				$(this).parent('div').parent('div').find(".player").playYTP();	
			})
			$(this).siblings('div').find('.command-pause').click(function(event) {
				event.preventDefault();
				$(this).parent('div').parent('div').find(".player").pauseYTP();	
			})			
			
		});

		// Self hosted controls
		$('.custom-self-hosted-video').click(function() {
	        $(this).get(0).paused ? $(this).get(0).play() : $(this).get(0).pause();
	    });
		
		$.fn.countUp = function( options ) {
			$('.mile-count .count').each( function() {
				if( $(this).data('count-animation') == '1' ){
					var defaults = {
						startVal: 0,
						endVal: $(this).attr( "data-count" ),
						duration: 1.5,
						options: {
							useEasing: true,
							useGrouping: true ,
							/*decimals: '',
							separator : '', 
							prefix : '', 
							suffix : '' */
							decimals:'',
							separator : $(this).attr( "data-sep" ),
							prefix : $(this).attr( "data-pre" ), 
							suffix : $(this).attr( "data-suf" )
						}
					},
					options = $.extend({}, defaults, options);
					var mile_count = new countUp( this, options.startVal, options.endVal, options.decimals, options.duration, options.options );
					
					var $element = $(this);
					$element.waypoint(function() {
						mile_count.start();
						this.destroy();
					}, {
						offset: $element.data('animation-offset')
					})		
				}						
			})		
		};	
		$('.mile-count .count').each( function() {
			if( $(this).data('count-animation') == '1' ){
				$(this).countUp();
			}
		});

		// Custom Slider function
		$.fn.custom_slider = function() {
			$(this).owlCarousel({
				autoplay : $(this).data('custom-slider-autoplay'),
				autoplayTimeout: $(this).data('custom-slider-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('custom-slider-autoplay-hover'),
				smartSpeed: $(this).data('custom-slider-autoplay-speed'),
				dots : $(this).data('custom-slider-pagination'),
				nav:true,
				navText: ['<i class="ion-ios-arrow-left">','<i class="ion-ios-arrow-right">'],
				loop: $(this).data('custom-slider-loop'),
				items:1,
			})
			return this;
		};
		
		// Carousel Gallery function
		$.fn.carousel_gallery = function() {
			$(this).owlCarousel({
				autoplay : $(this).data('gallery-autoplay'),
				autoplayTimeout: $(this).data('gallery-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('gallery-autoplay-hover'),
				dots : $(this).data('gallery-pagination'),
				loop: $(this).data('gallery-loop'),
				margin: $(this).data('gallery-margin'),
				responsive:{
					0:{
						items:$(this).data('gallery-0')
					},
					768:{
						items:$(this).data('gallery-768')
					},
					992:{
						items:$(this).data('gallery-992')
					},
					1200:{
						items:$(this).data('gallery-1200')
					}
				}			
			})
		};

		// Carousel Posts function	
		$.fn.carousel_post = function() {
			$(this).owlCarousel({
				autoplay : $(this).data('posttype-autoplay'),
				autoplayTimeout: $(this).data('posttype-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('posttype-autoplay-hover'),
				smartSpeed: $(this).data('posttype-autoplay-speed'),
				dots : $(this).data('posttype-pagination'),
				loop: $(this).data('posttype-loop'),
				responsive:{
					0:{
						items:$(this).data('post-0')
					},
					768:{
						items:$(this).data('post-768')
					},
					992:{
						items:$(this).data('post-992')
					},
					1200:{
						items:$(this).data('post-1200')
					}
				}
			
			});
		};

		// Carousel Portfolio function
		$.fn.carousel_portfolio = function() {
			$(this).owlCarousel({
				margin: $(this).data('posttype-margin'),
				autoplay : $(this).data('posttype-autoplay'),
				autoplayTimeout: $(this).data('posttype-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('posttype-autoplay-hover'),
				smartSpeed: $(this).data('posttype-autoplay-speed'),
				dots : $(this).data('posttype-pagination'),
				loop: $(this).data('posttype-loop'),
				responsive:{
					0:{
						items:$(this).data('post-0')
					},
					768:{
						items:$(this).data('post-768')
					},
					992:{
						items:$(this).data('post-992')
					},
					1200:{
						items:$(this).data('post-1200')
					}
				}
			});
		};
		
		// carousel clients	function	
		$.fn.carousel_clients = function() {
			$(this).owlCarousel({
				autoplay : $(this).data('clients-autoplay'),
				autoplayTimeout: $(this).data('clients-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('clients-autoplay-hover'),
				dots : $(this).data('clients-pagination'),
				loop: $(this).data('clients-loop'),
				margin:30,
				responsive:{
					0:{
						items:$(this).data('client-0')
					},
					768:{
						items:$(this).data('client-768')
					},
					992:{
						items:$(this).data('client-992')
					},
					1200:{
						items:$(this).data('client-1200')
					}
				}			
			})
		};
		
		// carousel team function
		$.fn.carousel_team = function() {
			$(this).owlCarousel({
				autoplay : $(this).data('team-autoplay'),
				autoplayTimeout: $(this).data('team-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('team-autoplay-hover'),
				dots : $(this).data('team-pagination'),
				loop: $(this).data('team-loop'),
				margin:30,
				responsive:{
					0:{
						items:$(this).data('team-0')
					},
					768:{
						items:$(this).data('team-768')
					},
					992:{
						items:$(this).data('team-992')
					},
					1200:{
						items:$(this).data('team-1200')
					}
				}			
			})
		};		
		
		// carousel testimonials function
		$.fn.carousel_testimonials = function() {
			$(this).owlCarousel({
				autoplay : $(this).data('testimonial-autoplay'),
				autoplayTimeout: $(this).data('testimonial-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('testimonial-autoplay-hover'),
				smartSpeed: $(this).data('testimonial-autoplay-speed'),
				dots : $(this).data('testimonial-pagination'),
				loop: $(this).data('testimonial-loop'),
				responsive:{
					0:{
						items:$(this).data('test-0')
					},
					768:{
						items:$(this).data('test-768')
					},
					992:{
						items:$(this).data('test-992')
					},
					1200:{
						items:$(this).data('test-1200')
					}
				}
			
			})
		};	

		// carousel Service box function
		$.fn.carousel_service_box = function(){
			$(this).owlCarousel({
				autoplay : $(this).data('service-autoplay'),
				autoplayTimeout: $(this).data('service-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('service-autoplay-hover'),
				dots : $(this).data('service-pagination'),
				loop: $(this).data('service-loop'),
				margin:30,
				responsive:{
					0:{
						items:$(this).data('service-0')
					},
					768:{
						items:$(this).data('service-768')
					},
					992:{
						items:$(this).data('service-992')
					},
					1200:{
						items:$(this).data('service-1200')
					}
				}
			
			})
		};

		// sharing popup function
		$.fn.post_sharing_buttons = function(){
			$(this).find('a').on('click', function(s){
				s.preventDefault();
				window.open( $(this).attr('href'), 'popUpWindow',  'height=700, width=800, left=10, top=10, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');
			})		
		};

		// sharing popup
		$('.post-sharing-buttons, .portfolio-sharing-buttons').each(function(){
			$(this).post_sharing_buttons();		
		});

		// magnific popup portfolio thumbnail
		$.fn.portfolio_attachment_magnific_popup = function(){
			$(this).magnificPopup({
				delegate: '.portfolio-column:not(.filterhide) a.portfolio-attachment', // the selector for gallery item
				type: 'image',
				mainClass: 'mfp-img-mobile mfp-portfolio-attachment-popup mfp-image-popup',
				image: {
					verticalFit: true
				},
				gallery:{
					enabled:true,
					navigateByImgClick: false
				},
			})
		}

		$('.page-portfolio').each(function(){
			// Magnific popup portfolio attachment
			$(this).portfolio_attachment_magnific_popup();
			
		});
		
		// Maginfic popup image
		$('.custom-image').magnificPopup({
			type: 'image',
			mainClass: 'mfp-img-mobile',
			showCloseBtn:false,
			image: {
				titleSrc: function(item) {
					return item.el.children('img').attr('title');
				},
				verticalFit: true
			},
			zoom: {
				enabled: true, // By default it's false, so don't forget to enable it
				duration: 300, // duration of the effect, in milliseconds
				easing: 'ease-in-out' // CSS transition easing function 
			}
		});

		// Maginfic popup gallery
		$('.custom-gallery').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
				delegate: 'a', // the selector for gallery item
				type: 'image',
				mainClass: 'mfp-img-mobile mfp-image-popup',
				image: {
					verticalFit: true
				},
				gallery:{
					enabled:true,
					navigateByImgClick: false
				},
				zoom: {
					enabled: true, // By default it's false, so don't forget to enable it
					duration: 300, // duration of the effect, in milliseconds
					easing: 'ease-in-out' // CSS transition easing function 
				}
			})
		});

		// Maginfic popup video
		$('.custom-video-link a').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
				type: 'iframe',
				mainClass: 'mfp-iframe-mobile mfp-iframe-popup',
				iframe: {
				  markup: '<div class="mfp-iframe-scaler">'+
				            '<div class="mfp-close"></div>'+
				            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
				          '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button

				  patterns: {
				    youtube: {
				      index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

				      id: 'v=', // String that splits URL in a two parts, second part should be %id%
				      // Or null - full URL will be returned
				      // Or a function that should return %id%, for example:
				      // id: function(url) { return 'parsed id'; }

				      src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
				    },
				    vimeo: {
				      index: 'vimeo.com/',
				      id: '/',
				      src: '//player.vimeo.com/video/%id%?autoplay=1'
				    },

				    // you may add here more sources

				  },

				  srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
				}
			})
		});
		
		// bottom caption height detection
		$('.has-bottom-caption').each(function(){
			$(this).find(".portfolio-caption-content").css("bottom", $(this).find('.portfolio-bottom-caption').innerHeight() );
		}) 
		// portfolio isotope & filter 	
		$(".filter a").on('click', function(e){
			e.preventDefault();
			$(this).addClass('active');
			$(this).parent().siblings().find('a').removeClass('active');
			return false;
		});  
		
		$('.portfolio-container').each(function(){
			var $portfolio_element = $(this);
			if( $(this).data('grid') == 'fitRows' ){
				var $container = $(this).imagesLoaded( function() {
					$container.isotope({
						itemSelector: '.portfolio-column',
						layoutMode: 'fitRows',
						fitRows: {
							columnWidth: '.portfolio-column',
						}
					})
				})	
				$('.filter a').on('click', function(){
					var selector = $(this).attr('data-filter');
					//var $colwidth = $('.portfolio-column:not(.width2x)' )[0].getBoundingClientRect().width;
					$container.isotope({ filter: selector })
					$('.portfolio-column').each(function(){
		                if( !$(this).hasClass(selector.replace(".", ""))){
		                    $(this).addClass('filterhide');
		                }
		                else{
		                    $(this).removeClass('filterhide');
		                }

		            });
				});	
				$(window).on('resize', function(){
					$portfolio_element.each(function(){
						var $container = $(this).imagesLoaded( function() {
							$container.isotope({
								itemSelector: '.portfolio-column',
								layoutMode: 'fitRows',
								fitRows: {
									columnWidth: '.portfolio-column',
								}
							})
						})
					});
				});
			}
			else if( $(this).data('grid') == 'masonry' ){
				//var $colwidth = $('.portfolio-column:not(.width2x)' ).innerWidth();
				var $colwidth = ($('.portfolio-column:not(.width2x)' )[0])?$('.portfolio-column:not(.width2x)' )[0].getBoundingClientRect().width:'';
				var $container = $(this).imagesLoaded( function() {
					$container.isotope({
						itemSelector: '.portfolio-column',
						layoutMode: 'masonry',
						masonry: {
							columnWidth: $colwidth,
						}
					})
				})	
				$('.filter a').on('click', function(){
					var selector = $(this).attr('data-filter');
					$container.isotope({ filter: selector })
					$('.portfolio-column').each(function(){
		                if( !$(this).hasClass(selector.replace(".", ""))){
		                    $(this).addClass('filterhide');
		                }
		                else{
		                    $(this).removeClass('filterhide');
		                }

		            });
				});	

				$(window).on('resize', function(){
					$portfolio_element.each(function(){
						var $colwidth = ($('.portfolio-column:not(.width2x)' )[0])?$('.portfolio-column:not(.width2x)' )[0].getBoundingClientRect().width:'';
						var $container = $(this).imagesLoaded( function() {
							$container.isotope({
								itemSelector: '.portfolio-column',
								layoutMode: 'masonry',
								masonry: {
									columnWidth: $colwidth,
								}
							})
						})
					});
				});
			}
			if( $(this).data('grid')){
				if( $(this).hasClass('has-infinite-scroll') == true){
					var $template_url = $('.page-portfolio-container').data('dir');
					$container.infinitescroll({
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
					    navSelector  : "div.portfolio-number-navigation",      // selector for the paged navigation (it will be hidden) 
					    nextSelector : "div.portfolio-number-navigation a:first",    // selector for the NEXT link (to page 2)
					    itemSelector : ".portfolio-container div.portfolio-column",   // selector for all items you'll retrieve
					},
					function(newElements){
						var $newElems = $(newElements);
						$container.imagesLoaded(function(){
						    $container.isotope('appended', $newElems);
						});
		            });
		            if( $('.page-portfolio-container').hasClass('has-load-more') == true ){
				        $(window).unbind('.infscr');
						$('.load-more-button a').on('click', function(i){
							$('.portfolio-container').infinitescroll('retrieve');
							return false;
						})
					}
				}
			}
		});

		//Circle bar
		$('.chart').each(function() {
			var $element = $(this);

			$element.waypoint(function() {
				$element.easyPieChart({
					barColor : $element.data('barcolor'),
					trackColor : $element.data('trackcolor'),
					scaleColor : $element.data('scalecolor'),
					easing: $element.data('animation'),
					scaleLength: $element.data('scalelength') ,
					lineCap: $element.data('linecap'),
					lineWidth: $element.data('linewidth'),
					size: $element.data('size'),
					onStep: function(from, to, percent) {
						$(this.el).find('.percent').text(Math.round(percent));
					}
				}); 
				this.destroy();
			}, {
				offset: $element.data('animation-offset')
			});
		});


		$('.progress-bar-animate').each(function() {
			var $element = $(this);

			$element.waypoint(function() {
				if( $element.attr('role') == 'progressbar' ){
					$element.css({'width':$element.attr( 'aria-valuenow' )+'%'});
				}
				this.destroy();
			}, {
				offset: $element.data('animation-offset')
			});
		});

		// Custom Slider	
		$('.custom-slider').each(function() {
			$(this).custom_slider();
		});

		// Carousel Gallery	
		$('.carousel-gallery').each(function() {
			$(this).carousel_gallery();
		});

		// Carousel Posts	
		$('.carousel-post').each(function() {
			$(this).carousel_post();
		});

		// Carousel Portfolio	
		$('.carousel-portfolio').each(function() {
			$(this).carousel_portfolio();
		});
		
		// carousel clients		
		$('.carousel-clients').each(function() {
			$(this).carousel_clients();
		});
		
		// bottom caption height detection
		$('.has-bottom-caption').each(function(){
			$(this).find(".member-caption-content").css("bottom", $(this).find('.member-bottom-caption').innerHeight() );
		}) 
		// carousel team	
		$('.carousel-team').each(function() {
			$(this).carousel_team();
		});		
		
		// carousel testimonials	
		$('.carousel-testimonials').each(function() {
			$(this).carousel_testimonials();
		});	

		// carousel Service box
		$('.carousel-service-box').each(function() {
			$(this).carousel_service_box();
		});
		
		// Blog Masonry
		$('.blog-post-content').each(function(){
			if($(this).data('blog-grid') == 'masonry'){
				var $colwidth = ($('article.grid-item')[0])?$('article.grid-item')[0].getBoundingClientRect().width:'';
				var $container = $(this).find('.site-main').imagesLoaded( function() {
					$container.isotope({
						itemSelector: 'article',
						layoutMode: 'masonry',
						masonry: {
							columnWidth: $colwidth,
						}
					})
				})	
				$(window).on('resize', function(){
					$(this).each(function(){
						var $colwidth = ($('article.grid-item')[0])?$('article.grid-item')[0].getBoundingClientRect().width:'';
						var $container = $(this).find('.site-main').imagesLoaded( function() {
							$container.isotope({
								itemSelector: 'article',
								layoutMode: 'masonry',
								masonry: {
									columnWidth: $colwidth,
								}
							})
						})	
					});
				});
					
			}
			else if( $(this).data('blog-grid') == 'fitRows' ){
				var $colwidth = ($('article.grid-item')[0])?$('article.grid-item')[0].getBoundingClientRect().width:'';
				var $container = $(this).find('.site-main').imagesLoaded( function() {
					$container.isotope({
						itemSelector: 'article',
						layoutMode: 'fitRows',
						fitRows: {
							columnWidth: $colwidth,
						}
					})
				})	
				$(window).on('resize', function(){
					$(this).each(function(){
						var $colwidth = ($('article.grid-item')[0])?$('article.grid-item')[0].getBoundingClientRect().width:'';
						var $container = $(this).find('.site-main').imagesLoaded( function() {
							$container.isotope({
								itemSelector: 'article',
								layoutMode: 'fitRows',
								fitRows: {
									columnWidth: $colwidth,
								}
							})
						})	
					});
				});	
			}
			else{
				var $container = $(this).find('.site-main');
			}
			$('.blog-container').each(function(){
				if( $(this).hasClass('has-infinite-scroll') == true ){
					var $template_url = $(this).data('dir');
					$container.infinitescroll({
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
					    navSelector  : "div.post-number-navigation",      // selector for the paged navigation (it will be hidden) 
					    nextSelector : "div.post-number-navigation a:first",    // selector for the NEXT link (to page 2)
					    itemSelector : ".blog-container .site-main article",   // selector for all items you'll retrieve
					},
					function(newElements){
						var $newElems = $(newElements);
						if( $('.blog-post-content').data('blog-grid') ){
							$container.imagesLoaded(function(){
							    $container.isotope('appended', $newElems);
							});

						}
		            });
		            if( $(this).hasClass('has-load-more') ){
				        $(window).unbind('.infscr');
						$('.load-more-button a').on('click', function(i){
							$('.blog-container .site-main').infinitescroll('retrieve');
							return false;
						})
					}
				}

			})
			
		});
		
		// Icon 
		$('.icon-has-border.hover-icon-has-background').hover(function(){
			$(this).parent('.agni-icon').removeClass('icon-background-transparent');
		},function(){
			$(this).parent('.agni-icon').addClass('icon-background-transparent');
		})
		

		// coming soon countdown
		$('.countdown').each(function () { 
			// Coming Soon
			var $date = $(this).data( 'counter' );		
			var $label = $(this).data( 'label' );	
			$(this).countdown({
				date: $date, // add the countdown's end date (i.e. 3 november 2012 12:00:00)
				format: "on", // on (03:07:52) | off (3:7:52) - two_digits set to ON maintains layout consistency
				label: $label // add the countdown's label (i.e Day|Days|Hour|Hours|Minute|Minutes|Second|Seconds)
			});
		}); 

		// Waypoint Animation
		$('.animate').each(function() {
			var $element = $(this);

			$element.waypoint(function() {
				$element.addClass('animated').addClass($element.data('animation')).css('visibility', 'visible');
				this.destroy();
			}, {
				offset: $element.data('animation-offset')
			});
		});
		
		$.fn.initializeMap = function(lat, lang, desc, lat_2, lang_2, desc_2, showImage, imageTitle, divId, mapstyle, mapcolor, mapdrag, mapzoom) {
			switch( mapstyle ){
				case '2' :
					var styles = [{"stylers":[{"hue":"#ff1a00"},{"invert_lightness":true},{"saturation":-100},{"lightness":33},{"gamma":0.5}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2D333C"}]}];
					break;
				case '3' :
					var styles = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":mapcolor},{"visibility":"on"}]}];
					break;
				case '4' :
					var styles = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]; 
					break;
				default :
					var styles = [{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#00aaff"},{"saturation":-100},{"gamma":2.15},{"lightness":12}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":24}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57}]}];
			}
			
			var locations = [
				[desc, lat,lang],
				[desc_2, lat_2, lang_2],
		    ];

		    var map = new google.maps.Map(document.getElementById(divId), {
			    zoom: mapzoom,
			    center: new google.maps.LatLng(lat,lang),
			    mapTypeControl: false,
				scrollwheel: false,
				draggable: mapdrag,
				mapTypeControlOptions: {  
					mapTypeIds: ['Styled']  
				},    
				navigationControl: true,
				navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
				mapTypeId: 'Styled', 
		    });
		    var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });  
			map.mapTypes.set('Styled', styledMapType);

		    var infowindow = new google.maps.InfoWindow();

			var markerIcon = new google.maps.MarkerImage(showImage,
				new google.maps.Size(48,48),
				new google.maps.Point(0,0)
			);
		    var marker, i;

		    for (i = 0; i < locations.length; i++) {  
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map,
					icon: markerIcon,
					title:imageTitle,
					zIndex: 3
				});

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						infowindow.setContent(locations[i][0]);
						infowindow.open(map, marker);
					}
				})(marker, i));
		    }
		}

		// google map
		$('.map-canvas').each(function(){
			var $element = $(this);
			var mapstyle = $element.attr( 'data-map-style' );
			var mapcolor = $element.attr( 'data-map-accent-color' );
			var mapdrag = ((/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera) && $element.attr( 'data-map-drag' ) == '1')?false:true;
			var mapzoom = $element.data( 'map-zoom' );
			var template_url = $element.attr( 'data-dir' );
			var map_icon = $element.attr( 'data-map' );
			var get_id = $element.attr( 'id' );

			var get_lat = $element.attr( 'data-lat' );
			var get_lng = $element.attr( 'data-lng' );
			var get_add1 = $element.attr( 'data-add1' );
			var get_add2 = $element.attr( 'data-add2' );
			var get_add3 = $element.attr( 'data-add3' );		
			var lat=get_lat;   // Latitude of location
			var lang=get_lng;  // Longitude  of location
			var desc='<div>'+
						  '<h6>'+get_add1+'</h6>'+
						  '<p>'+get_add2+'</p>'+
						  '<p>'+get_add3+'</p>'+
					 '</div>';

			var get_lat_2 = $element.attr( 'data-lat-2' );
			var get_lng_2 = $element.attr( 'data-lng-2' );
			var get_add1_2 = $element.attr( 'data-add1-2' );
			var get_add2_2 = $element.attr( 'data-add2-2' );
			var get_add3_2 = $element.attr( 'data-add3-2' );
			var lat_2=get_lat_2;   // Latitude of location
			var lang_2=get_lng_2;  // Longitude  of location
			var desc_2='<div>'+
						  '<h6>'+get_add1_2+'</h6>'+
						  '<p>'+get_add2_2+'</p>'+
						  '<p>'+get_add3_2+'</p>'+
					 '</div>';
			var showImage= map_icon; //template_url+'/img/marker.png';
			var imageTitle=get_add1;
			var divId=get_id;			
			$element.initializeMap(lat, lang, desc, lat_2, lang_2, desc_2, showImage, imageTitle, divId, mapstyle, mapcolor, mapdrag, mapzoom);
		})
		
	});

})(jQuery);
