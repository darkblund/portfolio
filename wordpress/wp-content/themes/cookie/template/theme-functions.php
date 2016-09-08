<?php 
/**
 * Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Agni Framework
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
function agni_framework_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'agni_framework_content_width', 740 );
}
add_action( 'after_setup_theme', 'agni_framework_content_width', 0 );

/**
 * Loading Custom theme functions.
 */
function cookie_setup() {
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'cookie-standard-thumbnail', 1080, 0, true );
	add_image_size( 'cookie-grid-thumbnail', 640, 0, true );
	add_image_size( 'cookie-carousel-thumbnail', 640, 640, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'cookie' ),
		'secondary' => esc_html__( 'Top Bar Menu', 'cookie' ),
		'ternary' => esc_html__( 'Footer Menu', 'cookie' ),
	) );

}
add_action( 'after_setup_theme', 'cookie_setup', 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cookie_sidebar_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cookie' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	global $cookie_options;
	$footer_col = '<div class="col-md-4">';
	if( !empty($cookie_options['footer-col']) ){
		$footer_col = '<div class="col-md-'.$cookie_options['footer-col'].'">';
	}
	register_sidebar( array(
		'name'          => esc_html__( 'Footer bar', 'cookie' ),
		'id'            => 'footerbar-1',
	) );
}
add_action( 'widgets_init', 'cookie_sidebar_widgets_init' );

function cookie_footer_widgets_init() {
	unregister_sidebar('footerbar-1');
	global $cookie_options;
	$footer_col = '<div class="col-md-4">';
	if( !empty($cookie_options['footer-col']) ){
		$footer_col = '<div class="col-md-'.$cookie_options['footer-col'].'">';
	}
	register_sidebar( array(
		'name'          => esc_html__( 'Footer bar', 'cookie' ),
		'id'            => 'footerbar-1',
		'description'   => '',
		'before_widget' => $footer_col.'<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'redux/loaded', 'cookie_footer_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cookie_scripts() {
	global $cookie_options;

	$gmap_api = $cookie_options['gmap-api'];
	if( !empty($gmap_api) ){
		$gmap_api = '&key='.$gmap_api;
	}

	/* Enqueue CSS */
	wp_enqueue_style( 'cookie-bootstrap', AGNI_FRAMEWORK_CSS_URL . '/cookie.css' );
	wp_enqueue_style( 'cookie-ionicons', AGNI_FRAMEWORK_CSS_URL . '/ionicons.min.css', array(), '2.0.0' );
	wp_enqueue_style( 'cookie-font-awesome', AGNI_FRAMEWORK_CSS_URL . '/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'cookie-pe-stroke', AGNI_FRAMEWORK_CSS_URL . '/Pe-icon-7-stroke.min.css', array(), '1.2.0' );
	wp_enqueue_style( 'cookie-pe-filled', AGNI_FRAMEWORK_CSS_URL . '/Pe-icon-7-filled.min.css', array(), '1.2.0' );
	wp_enqueue_style( 'cookie-animate', AGNI_FRAMEWORK_CSS_URL . '/animate.min.css' );
	wp_enqueue_style( 'cookie-cookie-plugins', AGNI_FRAMEWORK_CSS_URL . '/cookie-plugins.css' );
	wp_enqueue_style( 'cookie-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );
	wp_enqueue_style( 'cookie-responsive', AGNI_FRAMEWORK_CSS_URL . '/responsive.css', array(), wp_get_theme()->get('Version')  );

	/* Enqueue google web fonts */
	wp_enqueue_style( 'cookie-fonts', '//fonts.googleapis.com/css?family=Lato:400,300italic,300,700|Poppins:600' );

 	/* Enqueue JS */
 	wp_enqueue_script( 'jquery' );
 	
 	wp_enqueue_script( 'cookie-plugins', AGNI_FRAMEWORK_JS_URL . '/cookie-plugins.js', array(), wp_get_theme()->get('Version'), true );
 	wp_enqueue_script( 'cookie-script', AGNI_FRAMEWORK_JS_URL . '/script.js', array(), wp_get_theme()->get('Version'), true );
	wp_enqueue_script( 'cookie-googleapi', '//maps.google.com/maps/api/js?sensor=false'.$gmap_api );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cookie_scripts' );

function cookie_admin_scripts() {

	wp_deregister_Style( 'font-awesome' );
	/* vc_style */
	wp_enqueue_style( 'cookie-ionicons-admin', AGNI_FRAMEWORK_CSS_URL . '/ionicons.min.css', array(), '2.0.0' );
	wp_enqueue_style( 'cookie-font-awesome-admin', AGNI_FRAMEWORK_CSS_URL . '/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'cookie-pe-stroke-admin', AGNI_FRAMEWORK_CSS_URL . '/Pe-icon-7-stroke.min.css', array(), '1.2.0' );
	wp_enqueue_style( 'cookie-pe-filled-admin', AGNI_FRAMEWORK_CSS_URL . '/Pe-icon-7-filled.min.css', array(), '1.2.0' );
	wp_enqueue_style( 'cookie-vc-admin', AGNI_THEME_FILES_URL . '/assets/css/vc_admin.css' );

 	wp_enqueue_script( 'cookie-admin-script', AGNI_FRAMEWORK_JS_URL . '/cookie-admin.js', array(), wp_get_theme()->get('Version'), true );
}
add_action( 'admin_enqueue_scripts', 'cookie_admin_scripts' );

/**
 * Include custom widget for posts
 */
require AGNI_FRAMEWORK_DIR . '/template/widgets/agni_widget_latest_posts.php';
/**
 * Include custom widget for works
 */
require AGNI_FRAMEWORK_DIR . '/template/widgets/agni_widget_latest_works.php';
/**
 * Include custom widget for social icons
 */
require AGNI_FRAMEWORK_DIR . '/template/widgets/agni_widget_social_icons.php';
/**
 * Include custom widget for Instagram
 */
require AGNI_FRAMEWORK_DIR . '/template/widgets/agni_widget_instagram_feed.php';
/**
 * Include custom widget for Instagram
 */
require AGNI_FRAMEWORK_DIR . '/template/widgets/agni_widget_about_text.php';

/**
 * Setting Revolution Slider for theme
 */
if(function_exists( 'set_revslider_as_theme' )){
	function agni_framework_revslider_as_theme() {
		set_revslider_as_theme();
	}
	add_action( 'init', 'agni_framework_revslider_as_theme' );
}

/**
 * Search form
 */
if( !function_exists('agni_search_form') ){
	function agni_search_form( $form ) {
		$form = '<form role="search" method="get" id="searchform" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
			<label> <span class="screen-reader-text">' . esc_html__( 'Search for:', 'cookie' ) . '</span>
			<input type="search"  title="Search for:" value="" placeholder="'.esc_attr__( 'Search', 'cookie' ).'" name="s" id="s" class="search-field" /></label>
			<input type="submit" id="searchsubmit" class="search-submit" value="" />
		</form>';
		return $form;
	}
	add_filter( 'get_search_form', 'agni_search_form' );
}

/**
 * Post Excerpt
 */
if( !function_exists('agni_excerpt_length') ){
	function agni_excerpt_length($charlength) {
		$excerpt = get_the_excerpt();
		$charlength++;

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo mb_substr( $subex, 0, $excut );
			} else {
				echo $subex;
			}
			echo '<p><a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . esc_html__( 'Continue reading', 'cookie') . '</a></p>';
		} else {
			echo $excerpt;
		}
	}
}

/**
 * Page Navigation
 */
if( !function_exists('agni_page_navigation') ){
	function agni_page_navigation( $query, $nav_type ) {
		global $wp_query;
		if( $query == '' ){
			$query = $wp_query;
		}
		if( get_query_var('paged') != '' ){
			$paged = get_query_var('paged');
		}
		elseif( get_query_var('page') != '' ){
			$paged = get_query_var('page');
		}
		else{
			$paged = 1;
		}
		$pages = paginate_links( array(
            'base'         => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ), 
            'format'       => '',
			'add_args'     => '',
            'current'      => max( 1, $paged ),
            'total'        => $query->max_num_pages,
            'prev_next'    => true,
            'prev_text'    => esc_html__('Previous', 'cookie'),
            'next_text'    => esc_html__('Next', 'cookie'),
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
        ) );
		$output =  '<div class="'.$nav_type.' page-number-navigation navigation text-center">'.$pages.'</div>';
		echo $output;
	}
}

/**
 * Portfolio filter
 */
if( !function_exists('agni_portfolio_filter') ){
	function agni_portfolio_filter( $term_order, $term_orderby ){
		global $cookie_options, $category;
		$categories = explode( ',', $category );
		$terms = get_terms( 'types', array( 'orderby' => $term_orderby, 'order' => $term_order ) );
		$count = count($terms);
		echo '<span class="filter-button" ><i class="pe-7f-filter"></i></span><ul id="filters" class="filter list-inline">';
		echo '<li><a class="active" href="#all" data-filter=".all" title="">'.$cookie_options['portfolio-filter-all-text'].'</a></li>';
		if ( $count > 0 ){	 
			foreach ( $terms as $term ) {	
				foreach ($categories as $cat) {
					if(empty($cat)){ 
						$termslug = strtolower($term->slug);
						echo '<li><a href="#'.$termslug.'" data-filter=".'.$termslug.'" title="">'.$term->name.'</a></li>';
					}
					else if( $cat == $term->slug ){
						$termslug = strtolower($term->slug);
						echo '<li><a href="#'.$termslug.'" data-filter=".'.$termslug.'" title="">'.$term->name.'</a></li>';
					}
				}
			}
		}
		echo '</ul>';	
	}
}

/*
 * Breadcrumbs
 */
if( !function_exists('agni_breadcrumb_navigation') ){
	function agni_breadcrumb_navigation() {
		$delimiter = ' / ';
		$home = esc_html( get_bloginfo('name') );
		$before = '<span>';
		$after = '</span>';
		
		echo '<p class="breadcrumb">';
		
		global $post;
		
		$homeLink = esc_url( home_url( '/' ) );

		echo '<a href="' . $homeLink . '">'.esc_html__( 'Home', 'cookie' ).'</a> ' . $delimiter .' ';

		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo $before . single_cat_title('', false)  . $after;
		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before  . get_the_time('d')  . $after;
		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before  . get_the_time('F')  . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y')  . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				echo ' ' . get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') . ' ';
				echo $before  . get_the_title()  . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
			$parent_id    = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title()  . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			echo $before  . get_the_title()  . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
			$parent_id    = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title()  . $after;
		} elseif ( is_search() ) {
			echo $before . get_search_query()  . $after;
		} elseif ( is_tag() ) {
			echo $before. single_tag_title('', false)  . $after;
		} elseif ( is_author() ) {
		global $author;
			$userdata = get_userdata($author);
			echo $before . $userdata->display_name  . $after;
		} elseif ( is_404() ) {
			echo $before . ' 404 ' . $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo ('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
		echo '</p>';
	}
}

/**
 * Post Carousel
 */
if( !function_exists('agni_posts_carousel') ){
	function agni_posts_carousel( $blog_cat, $blog_post_per_page, $blog_thumbnail_overlay, $blog_carousel_nav, $blog_carousel_pag, $blog_carousel_loop, $blog_carousel_auto, $blog_carousel_margin ) {
		// 6, 1, 0.4, 'true', 'true', 'true', 'true', 0
		$sticky = get_option( 'sticky_posts' );		
		$args = array(
			'post_type'			  => 'post',
			'posts_per_page'	  => $blog_post_per_page,
			'cat'                 => $blog_cat,
			'ignore_sticky_posts' => 1,
			'post__not_in'        => $sticky,
		);
		$slider_query = new WP_Query( $args );
		?>    
		<div class="agni-posts-carousel" data-carousel-navigation = "<?php echo $blog_carousel_nav; ?>" data-carousel-pagination = "<?php echo $blog_carousel_pag; ?>" data-carousel-loop = "<?php echo $blog_carousel_loop; ?>" data-carousel-autoplay = "<?php echo $blog_carousel_auto; ?>" data-carousel-margin = "<?php echo $blog_carousel_margin; ?>" style="padding:0 <?php echo $blog_carousel_margin; ?>px">
			<?php if ( $slider_query->have_posts() ) : ?>    
				<?php /* Start the Loop */ ?>
				<?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>
					<?php if( has_post_thumbnail() ){ ?>
						<article id="post-slide-<?php the_ID(); ?>" <?php post_class( 'agni-post-slide' ); ?>>
							<div class="entry-thumbnail"><?php the_post_thumbnail( 'cookie-carousel-thumbnail' ); ?><div class="overlay" style="opacity:<?php echo $blog_thumbnail_overlay; ?>;" ></div></div>									
							<div  class="entry-content">
								<?php if ( 'post' == get_post_type() ) : ?>
								<div class="entry-meta">
									<?php agni_framework_post_cat(); ?>
									<?php agni_framework_post_date(); ?>
								</div><!-- .entry-meta -->
								<?php endif; ?>
								<?php the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ) ?>			
							</div>
						</article>
					 <?php } ?>
				<?php endwhile; ?>        
			<?php endif; ?>
		</div>
	<?php }
}

/**
 * Post Format functions
 */

// Video post
if( !function_exists('agni_post_video') ){
	function agni_post_video( $post ){
		$post_video_url = esc_url( get_post_meta($post, 'post_format_video_url' , true) );
		$post_video_poster = esc_url( get_post_meta($post, 'post_format_video_poster' , true) );
		$post_video_embed_url = get_post_meta($post, 'post_format_video_embed_url' , true);
		$output = null;
		
		
		if(!empty($post_video_url)){
			$output = '<div class="post-video">'.do_shortcode('[video width="740" mp4="'.$post_video_url.'" webm="'.$post_video_url.'" ogv="'.$post_video_url.'" mov="'.$post_video_url.'" poster="'.$post_video_poster.'"][/video]').'</div>';
		}
		elseif(!empty($post_video_embed_url)){
			$output = '<div class="custom-video embed-responsive embed-responsive-16by9">'.$post_video_embed_url.'</div>';
		}
			
		echo $output; 
	}
}

// Audio post
if( !function_exists('agni_post_audio') ){
	function agni_post_audio( $post){	
		$post_audio_url = esc_url( get_post_meta($post, 'post_format_audio_url' , true) );
		if(!empty($post_audio_url)){
			$output = do_shortcode('[audio mp3="'.$post_audio_url.'" ogg="'.$post_audio_url.'" wmv="'.$post_audio_url.'" ][/audio]');	
		
		
		echo '<div class="post-format-indent">'.$output.'</div>';
		}
	}
}

// Gallery post
if( !function_exists('agni_post_gallery') ){
	function agni_post_gallery($post){
		
		$post_gallery_image = get_post_meta( $post, 'post_format_gallery_image', true );
		$post_gallery_disable_autoplay = esc_attr( get_post_meta( $post, 'post_format_gallery_autoplay', true ) );
		$post_gallery_disable_autoplay_hover = esc_attr( get_post_meta( $post, 'post_format_gallery_autoplay_hover', true ) );
		$post_gallery_autoplay_speed = esc_attr( get_post_meta( $post, 'post_format_gallery_autoplay_speed', true ) );
		$post_gallery_autoplay_timeout = esc_attr( get_post_meta( $post, 'post_format_gallery_autoplay_timeout', true ) );
		$post_gallery_disable_loop = esc_attr( get_post_meta( $post, 'post_format_gallery_loop', true ) );
		$post_gallery_disable_pagination = esc_attr( get_post_meta( $post, 'post_format_gallery_pagination', true ) );
		$gallery = '';
	    // Loop through them and output an image
	    foreach ( (array) $post_gallery_image as $attachment_id => $attachment_url ) {
			$gallery .= '<div>'.wp_get_attachment_image( esc_attr( $attachment_id ), 'full' ).'</div>';
	    }
		$custom_slider_autoplay = ( $post_gallery_disable_autoplay != 'on' )?'true':'false';
		$custom_slider_autoplay_timeout = $post_gallery_autoplay_timeout;
		$custom_slider_autoplay_speed = $post_gallery_autoplay_speed;
		$custom_slider_autoplay_hover = ( $post_gallery_disable_autoplay_hover != 'on' )?'true':'false';
		$custom_slider_loop = ( $post_gallery_disable_loop != 'on' )?'true':'false';
		$custom_slider_pagination = ( $post_gallery_disable_pagination != 'on' )?'true':'false';

		$output = '<div id="gallery-slider-'.$post.'" class="slider custom-slider gallery-slider-container" data-custom-slider-autoplay="'.$custom_slider_autoplay.'" data-custom-slider-autoplay-timeout="'.$custom_slider_autoplay_timeout.'" data-custom-slider-autoplay-hover="'.$custom_slider_autoplay_hover.'" data-custom-slider-autoplay-speed="'.$custom_slider_autoplay_speed.'" data-custom-slider-pagination="'.$custom_slider_pagination.'" data-custom-slider-loop="'.$custom_slider_loop.'" >
					'.$gallery.'
					</div>';
		echo $output;
	}
}

// Link post
if( !function_exists('agni_post_link') ){
	function agni_post_link( $post ){
		
		$post_link_text = esc_url( get_post_meta($post, 'post_format_link_url' , true) );	
		if( !empty($post_link_text) ){
			echo '<div class="post-format-indent"><a class="post-format-link additional-heading" href="'.$post_link_text.'">'.$post_link_text.'</a></div>';
		}
	}
}

// Quote post
if( !function_exists('agni_post_quote') ){
	function agni_post_quote( $post ){
		$post_quote_text = esc_attr( get_post_meta($post, 'post_format_quote_text' , true) );
		$post_quote_cite = esc_attr( get_post_meta($post, 'post_format_quote_cite' ,true) );
		
		$cite = null;
		if(!empty($post_quote_cite)){
			$cite = '<h6 class="quote-cite ">&nbsp;&mdash;&nbsp;'.$post_quote_cite.'</h6>';
		}
		if( !empty( $post_quote_text ) ){
			echo '
				<div class="post-format-indent">
					<p class="post-format-quote additional-heading">' . $post_quote_text .'</p>'. $cite . '
				</div>
			';
		}
	}
}

if( !function_exists('agni_page_header') ){
	function agni_page_header( $post ){
		global $post; 
		$page_header_type = esc_attr( get_post_meta( $post->ID, 'page_header_type', true ) );
		$page_header_height = esc_attr( get_post_meta( $post->ID, 'page_header_height', true ) );
		$page_header_fullwidth = esc_attr( get_post_meta( $post->ID, 'page_header_fullwidth', true ) );
		$page_header_bg_choice = esc_attr( get_post_meta( $post->ID, 'page_header_bg_choice', true ) );
		$page_header_bg_color = esc_attr( get_post_meta( $post->ID, 'page_header_bg_color', true ) );
		$page_header_bg_image = esc_attr( get_post_meta( $post->ID, 'page_header_bg_image_id', true ) );
		$page_header_overlay = esc_attr( get_post_meta( $post->ID, 'page_header_overlay', true ) );
		$page_header_opacity = esc_attr( get_post_meta( $post->ID, 'page_header_opacity', true ) );
		$page_header_parallax_start = esc_attr( get_post_meta( $post->ID, 'page_header_parallax_start', true ) );
		$page_header_parallax_end = esc_attr( get_post_meta( $post->ID, 'page_header_parallax_end', true ) );
		$page_header_title_rotator = esc_attr( get_post_meta( $post->ID, 'page_header_title_rotator', true ) );
		$page_header_title_rotator_speed = esc_attr( get_post_meta( $post->ID, 'page_header_title_rotator_speed', true ) );
		$page_header_title_size = esc_attr( get_post_meta( $post->ID, 'page_header_title_size', true ) );
		$page_header_title = esc_attr( get_post_meta( $post->ID, 'page_header_title', true ) );
		$page_header_title_color = esc_attr( get_post_meta( $post->ID, 'page_header_color_title', true ) );
		$page_header_description = esc_attr( get_post_meta( $post->ID, 'page_header_description', true ) );
		$page_header_description_color = esc_attr( get_post_meta( $post->ID, 'page_header_color_description', true ) );	
		$page_header_button1 = esc_attr( get_post_meta( $post->ID, 'page_header_button1', true ) );	
		$page_header_button1_url = esc_url( get_post_meta( $post->ID, 'page_header_button1_url', true ) );	
		$page_header_button1_type = esc_attr( get_post_meta( $post->ID, 'page_header_button1_type', true ) );	
		$page_header_button1_style = esc_attr( get_post_meta( $post->ID, 'page_header_button1_style', true ) );	
		$page_header_button1_target = esc_attr( get_post_meta( $post->ID, 'page_header_button1_target', true ) );	
		$page_header_button2 = esc_attr( get_post_meta( $post->ID, 'page_header_button2', true ) );	
		$page_header_button2_url = esc_url( get_post_meta( $post->ID, 'page_header_button2_url', true ) );	
		$page_header_button2_type = esc_attr( get_post_meta( $post->ID, 'page_header_button2_type', true ) );	
		$page_header_button2_style = esc_attr( get_post_meta( $post->ID, 'page_header_button2_style', true ) );	
		$page_header_button2_target = esc_attr( get_post_meta( $post->ID, 'page_header_button2_target', true ) );	
		$page_header_alignment = esc_attr( get_post_meta( $post->ID, 'page_header_alignment', true ) );
		$page_header_vertical_alignment = esc_attr( get_post_meta( $post->ID, 'page_header_vertical_alignment', true ) );
		$page_header_padding_top = esc_attr( get_post_meta( $post->ID, 'page_header_padding_top', true ) );
		$page_header_padding_bottom = esc_attr( get_post_meta( $post->ID, 'page_header_padding_bottom', true ) );
		$page_header_nav = esc_attr( get_post_meta( $post->ID, 'page_header_nav', true ) );
		
			
		$bread_nav = $page_description = $content_style = $vertical_style = $padding_style = $button1 = $button2 = $height = $bg = $fullwidth = $output = '';
		if( $page_header_bg_color != '' || $page_header_bg_image != '' ){
		if( $page_header_type == '2' ){
			$height = 'style="height:'.$page_header_height.'px;"  data-inherited-height = \'.agni-page-header\'';
		}
		else{
			$height = 'data-fullscreen-height = "1"';
		}
		if( $page_header_bg_choice == '1' ){
			$bg = wp_get_attachment_image( $page_header_bg_image, 'full' ).'
				<div class="overlay" style="background-color:'.$page_header_overlay.'; opacity:'.$page_header_opacity.'"></div>';
		}
		else{
			$bg = '<div class="agni-page-header-bg-solid" style="background-color:'.$page_header_bg_color.'" ></div>';
		}
		if( $page_header_fullwidth == 'on' ){
			$fullwidth = '-fluid';
		}

		if( $page_header_nav == 'on' ){
			ob_start();
			agni_breadcrumb_navigation();
			$bread_nav =ob_get_clean();
		}
		
		if( !empty($page_header_title) && $page_header_title_rotator == 'on'){
			$page_header_title = '<div class="text-rotator" data-text-animation="dissolve" data-text-animation-speed="'.$page_header_title_rotator_speed.'"><h2 class="rotate agni-page-header-title" style="color:'.$page_header_title_color.'; font-size:'.$page_header_title_size.'px;">'.htmlspecialchars_decode($page_header_title).'</h2></div>';
		}elseif( !empty($page_header_title) ){				
			$page_header_title = '<h2 class="agni-page-header-title" style="color:'.$page_header_title_color.'; font-size:'.$page_header_title_size.'px;">'.htmlspecialchars_decode($page_header_title).'</h2>';
		}

		if( !empty($page_header_description) ){
			$page_header_description = '<p class="agni-page-header-additional-text" style="color:'.$page_header_description_color.'">'.htmlspecialchars_decode($page_header_description).'</p>';			
		}		
		
		if( !empty($page_header_button1) ){
			$button1 = '<a class="btn btn-'.$page_header_button1_style.' '.$page_header_button1_type.' agni-page-header-btn agni-page-header-btn-1" href="'.$page_header_button1_url.'" target="'.$page_header_button1_target.'">'.$page_header_button1.'</a> ';
		}
		if( !empty($page_header_button2) ){
			$button2 = '<a class="btn btn-'.$page_header_button2_style.' '.$page_header_button2_type.' agni-page-header-btn agni-page-header-btn-2" href="'.$page_header_button2_url.'" target="'.$page_header_button2_target.'">'.$page_header_button2.'</a> ';
		}
		
		$vertical_style = ( $page_header_vertical_alignment != '' )?'vertical-align:'.$page_header_vertical_alignment.'; ':'';
		$padding_top_style = ( $page_header_padding_top != '' )?'padding-top:'.$page_header_padding_top.'px; ':'';
		$padding_bottom_style = ( $page_header_padding_bottom != '' )?'padding-bottom:'.$page_header_padding_bottom.'px; ':'';
		
		 $bg_parallax = '';
		 if( !empty($page_header_parallax_start) && !empty($page_header_parallax_end) ){$bg_parallax ='data-0="'.$page_header_parallax_start.'" data-1500="'.$page_header_parallax_end.'"';
		 }
		 
		if( $vertical_style != '' || $padding_style != '' )
			$content_style = 'style="'.$vertical_style.$padding_top_style.$padding_bottom_style.'"';
		
		$output = '<div id="agni-page-header-'.$post->ID.'" class="agni-page-header" '.$height.' >
			<div class="slides-container" '.$bg_parallax.'>
				<div>
					<div class="slide-bg">
						'.$bg.'
					</div>
					<div class="slide-container container'.$fullwidth.' text-'.$page_header_alignment.'">
						<div class="slide-content page-scroll" '.$content_style.'>
							'.$page_header_title.$page_header_description.'
							<div style="color:'.$page_header_title_color.'">'.$bread_nav.'</div>'.$button1.$button2.'
						</div>
					</div>
				</div>
			</div>
			<nav class="slides-navigation">
				<a href="#" class="next"><i class="ion-ios-arrow-right"></i></a>
				<a href="#" class="prev"><i class="ion-ios-arrow-left"></i></a>
			</nav>
		</div>';
	}
		return $output;

	}
}

if( !function_exists('agni_slider') ){
	function agni_slider( $post ){
		global $cookie_options;
		
		$agni_slider_choice = get_post_meta( $post, 'agni_slides_choice', true );
		switch( $agni_slider_choice ){
		
			case 'slideshow' :

				$slideshow = $button = $slideshow_title_animation = $slideshow_additional_title_animation = $slideshow_divide_line_animation = $slideshow_button_animation = $slideshow_title_border = $height = $mousewheel = '';
				
				$slideshow_title_color = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_color_title', true ) );
				$slideshow_description_color = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_color_desc', true ) );
				$slideshow_overlay = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_color_overlay', true ) );
				$slideshow_overlay_opacity = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_opacity', true ) );			
				$slideshow_repeatable = get_post_meta( $post, 'agni_slides_slideshow_repeatable', true );
				
				$slideshow_type = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_type', true ) );
				$slideshow_height = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_height', true ) );
				$slideshow_title_animation = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_title_animation', true ) );
				$slideshow_additional_title_animation = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_additional_title_animation', true ) );
				$slideshow_divide_line_animation = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_divide_line_animation', true ) );
				$slideshow_button_animation = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_button_animation', true ) );
				$slideshow_title_border = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_border_title', true ) );
				//$slideshow_title_rotator = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_title_rotator', true ) );
				$slideshow_parallax_start = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_parallax_start', true ) );
				$slideshow_parallax_end = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_parallax_end', true ) );
				$slideshow_arrowlink = esc_url(get_post_meta($post, 'agni_slides_slideshow_arrowlink', true));
				$slideshow_arrowlink_color = esc_attr(get_post_meta($post, 'agni_slides_slideshow_arrowlink_color', true));
			
			
				if( $slideshow_title_animation == 'on' ){
					$slideshow_title_animation = 'animation';
				}
				if( $slideshow_additional_title_animation == 'on' ){
					$slideshow_additional_title_animation = 'animation animation-delay-1s';
				}
				if( $slideshow_divide_line_animation == 'on' ){
					$slideshow_divide_line_animation = 'animation';
				}
				if( $slideshow_button_animation == 'on' ){
					$slideshow_button_animation = 'animation animation-delay-1s';
				}

				if( $slideshow_title_border == 'on' ){
					$slideshow_title_border = 'slide-bordered-title';
				}

				if( $slideshow_type == '1' ){
					$height = 'data-fullscreen-height = 1';
				}
				else{
					$height = 'style="height:'.$slideshow_height.'px;" data-inherited-height = \'.agni-slides\'';
				}

				$content_parallax = '';
				if( !empty($slideshow_parallax_start) && !empty($slideshow_parallax_end) ){
					$content_parallax = 'data-0="'.$slideshow_parallax_start.'" data-1500="'.$slideshow_parallax_end.'"';
				}
				if( !empty( $slideshow_arrowlink ) ){
					$mousewheel = '<div class="mouse-wheel page-scroll" '.$content_parallax.'><a href="'.$slideshow_arrowlink.'" style="color:'.$slideshow_arrowlink_color.'"><i class="pe-7s-angle-down-circle" style="color:'.$slideshow_arrowlink_color.'"></i></a> </div>';
				}
				
				foreach( (array) $slideshow_repeatable as $key => $slide ){
					$slideshow_vertical_alignment = $slideshow_alignment = $slideshow_image = $slideshow_size = $slideshow_title = $slideshow_description = $slideshow_button1 = $slideshow_button1_style = $slideshow_button1_target = $slideshow_button2 = $slideshow_button2_style = $slideshow_button2_target = $button = $slideshow_title_rotator = '';
					if ( isset( $slide['slideshow_vertical_alignment'] ) )
						$slideshow_vertical_alignment = esc_attr( $slide['slideshow_vertical_alignment'] );
										
					if ( isset( $slide['slideshow_alignment'] ) )
						$slideshow_alignment = esc_attr( $slide['slideshow_alignment'] );
						
					if ( isset( $slide['slideshow_image_id'] ) )
						$slideshow_image = esc_attr( $slide['slideshow_image_id'] );					
					
					if ( isset( $slide['slideshow_title_rotator'] ) )
						$slideshow_title_rotator =  esc_attr( $slide['slideshow_title_rotator'] );

					if ( isset( $slide['slideshow_title_rotator_speed'] ) )
						$slideshow_title_rotator_speed =  esc_attr( $slide['slideshow_title_rotator_speed'] );

					if ( isset( $slide['slideshow_title'] ) ){
						if ( $slideshow_title_rotator == 'on' ){
							$slideshow_title = '<div class="text-rotator" data-text-animation="dissolve" data-text-animation-speed="'.$slideshow_title_rotator_speed.'"><h2 class="rotate slide-title '.$slideshow_title_border.' text-'.$slideshow_alignment.' '.$slideshow_title_animation.'" style="color:'.$slideshow_title_color.' ">'.htmlspecialchars_decode( esc_attr( $slide['slideshow_title'] ) ).'</h2></div>
								<div class="slide-divide-line divide-line text-'.$slideshow_alignment.' '.$slideshow_divide_line_animation.'"><span style="background-color:'.$slideshow_title_color.'"></span></div>';
						}
						else{
							$slideshow_title = '<h2 class="slide-title '.$slideshow_title_border.' text-'.$slideshow_alignment.' '.$slideshow_title_animation.'" style="color:'.$slideshow_title_color.'">'.htmlspecialchars_decode( esc_attr( $slide['slideshow_title'] ) ).'</h2>
								<div class="slide-divide-line divide-line text-'.$slideshow_alignment.' '.$slideshow_divide_line_animation.'"><span style="background-color:'.$slideshow_title_color.'"></span></div>';
						}
					}
						
					if ( isset( $slide['slideshow_desc'] ) )
						$slideshow_description = '<p class="slide-additional-title '.$slideshow_additional_title_animation.'" style="color:'.$slideshow_description_color.'">'.esc_attr( $slide['slideshow_desc'] ).'</p>';
						
					if ( isset( $slide['slideshow_button1'] ) )
						$slideshow_button1 = esc_attr( $slide['slideshow_button1'] );
						
					if ( isset( $slide['slideshow_button1_url'] ) )
						$slideshow_button1_url = esc_url( $slide['slideshow_button1_url'] );
						
					if ( isset( $slide['slideshow_button1_style'] ) )
						$slideshow_button1_style = esc_attr( $slide['slideshow_button1_style'] );

					if ( isset( $slide['slideshow_button1_target'] ) )
						$slideshow_button1_target = esc_attr( $slide['slideshow_button1_target'] );

					if ( isset( $slide['slideshow_button2'] ) )
						$slideshow_button2 = esc_attr( $slide['slideshow_button2'] );
						
					if ( isset( $slide['slideshow_button2_url'] ) )
						$slideshow_button2_url = esc_url( $slide['slideshow_button2_url'] );
						
					if ( isset( $slide['slideshow_button2_style'] ) )
						$slideshow_button2_style = esc_attr( $slide['slideshow_button2_style'] );

					if ( isset( $slide['slideshow_button2_target'] ) )
						$slideshow_button2_target = esc_attr( $slide['slideshow_button2_target'] );
						
						
					if( !empty($slideshow_button1) ){
						$button .= '<a class="btn btn-'.$slideshow_button1_style.' btn-alt slide-button slide-button-1 '.$slideshow_button_animation.'" href="'.$slideshow_button1_url.'" target="'.$slideshow_button1_target.'">'.$slideshow_button1.' </a> ';
					}
					if( !empty($slideshow_button2) ){
						$button .= '<a class="btn btn-'.$slideshow_button2_style.' btn-alt slide-button slide-button-2 '.$slideshow_button_animation.'" href="'.$slideshow_button2_url.'" target="'.$slideshow_button2_target.'">'.$slideshow_button2.' </a> ';
					}
																
					$slideshow .= '<li>
						<div class="slide-image">
							'.wp_get_attachment_image( $slideshow_image, 'full' ).'
							<div class="overlay" style="background-color:'.$slideshow_overlay.'; opacity:'.$slideshow_overlay_opacity.'"></div>
						</div>
						<div class="slide-container container text-'.$slideshow_alignment.'">
							<div class="slide-content page-scroll" style="vertical-align:'.$slideshow_vertical_alignment.';">
								'.$slideshow_description.$slideshow_title.$button.'							
							</div>
						</div>
					</li>';
				}
				
				$output = '<div id="agni-slides-'.$post.'" class="agni-slider agni-slides white" '.$height.' data-slide-animation="'.$cookie_options['slideshow-slider-animation'].'" data-slide-animation-speed="'.$cookie_options['slideshow-slider-duration'].'" data-slide-transition-speed="'.$cookie_options['slideshow-slider-transition-duration'].'" data-slide-pagination="'.$cookie_options['slideshow-slider-pagination'].'">
					<ul class="slides-container" '.$content_parallax.'><!-- data-top="transform:translateY(0px);" data-top-bottom="transform:translateY(400px);" -->
						'.$slideshow.' 					       
					</ul>
					'.$mousewheel.'
					<nav class="slides-navigation">
						<a href="#" class="next"><i class="pe-7s-angle-right-circle"></i></a>
						<a href="#" class="prev"><i class="pe-7s-angle-left-circle"></i></a>
					</nav>
				</div>';
				
				return $output;
				
				break;
			
			case 'videobg':
			
				$loop =	$autoplay = $muted = '';
				if( $cookie_options['video-bg-controls'] == '1'){
					$cookie_options['video-bg-controls'] = 'true';
				}
				else{
					$cookie_options['video-bg-controls'] = 'false';
				}
				
				if( $cookie_options['video-bg-loop'] == '1'){
					$cookie_options['video-bg-loop'] = 'true';
					$loop = 'loop ';
				}
				else{
					$cookie_options['video-bg-loop'] = 'false';
				}
				
				if( $cookie_options['video-bg-autoplay'] == '1'){
					$cookie_options['video-bg-autoplay'] = 'true';
					$autoplay = 'autoplay ';
				}
				else{
					$cookie_options['video-bg-autoplay'] = 'false';
					$autoplay = 'autoplay ';
				}
				
				if( $cookie_options['video-bg-mute'] == '1'){
					$cookie_options['video-bg-mute'] = 'true';
					$muted = 'muted ';
				}
				else{
					$cookie_options['video-bg-mute'] = 'false';
				}
				
				$videobg_type = esc_attr( get_post_meta( $post, 'agni_slides_videobg_type', true ) );
				$videobg_height = esc_attr( get_post_meta( $post, 'agni_slides_videobg_height', true ) );
				$videobg_title_animation = esc_attr( get_post_meta( $post, 'agni_slides_videobg_title_animation', true ) );
				$videobg_additional_title_animation = esc_attr( get_post_meta( $post, 'agni_slides_videobg_additional_title_animation', true ) );
				$videobg_divide_line_animation = esc_attr( get_post_meta( $post, 'agni_slides_videobg_divide_line_animation', true ) );
				$videobg_button_animation = esc_attr( get_post_meta( $post, 'agni_slides_videobg_button_animation', true ) );
				$videobg_title_border = esc_attr( get_post_meta( $post, 'agni_slides_videobg_border_title', true ) );

				$videobg_src = esc_attr( get_post_meta( $post, 'agni_slides_videobg_src', true ) );
				$videobg_url = esc_url( get_post_meta( $post, 'agni_slides_videobg_url', true ) );
				$videobg_fallback = esc_url( get_post_meta( $post, 'agni_slides_videobg_fallback', true ) );
				$videobg_selfhosted_url = esc_url( get_post_meta( $post, 'agni_slides_videobg_selfhosted_url', true ) );
				$videobg_selfhosted_poster = esc_url( get_post_meta( $post, 'agni_slides_videobg_selfhosted_poster', true ) );
				$videobg_title_color = esc_attr( get_post_meta( $post, 'agni_slides_videobg_color_title', true ) );
				$videobg_description_color = esc_attr( get_post_meta( $post, 'agni_slides_videobg_color_desc', true ) );
				$videobg_overlay = esc_attr( get_post_meta( $post, 'agni_slides_videobg_overlay', true ) );
				$videobg_opacity = esc_attr( get_post_meta( $post, 'agni_slides_videobg_opacity', true ) );
				$videobg_arrowlink = esc_url(get_post_meta($post, 'agni_slides_videobg_arrowlink', true));
				$videobg_arrowlink_color = esc_attr(get_post_meta($post, 'agni_slides_videobg_arrowlink_color', true));
				$videobg_repeatable = get_post_meta( $post, 'agni_slides_videobg_repeatable', true );
				
				$videobg_container = $videobg_background = '';

				if( $videobg_title_animation == 'on' ){
					$videobg_title_animation = 'animation';
				}
				if( $videobg_additional_title_animation == 'on' ){
					$videobg_additional_title_animation = 'animation animation-delay-1s';
				}
				if( $videobg_divide_line_animation == 'on' ){
					$videobg_divide_line_animation = 'animation';
				}
				if( $videobg_button_animation == 'on' ){
					$videobg_button_animation = 'animation animation-delay-1s';
				}

				if( $videobg_title_border == 'on' ){
					$videobg_title_border = 'slide-bordered-title';
				}

				if( $videobg_type == '1' ){
					$height = 'data-fullscreen-height = 1';
				}
				else{
					$height = 'style="height:'.$videobg_height.'px;" data-inherited-height = \'.agni-video\'';
				}

				if( !empty( $videobg_arrowlink ) ){
					$mousewheel = '<div class="mouse-wheel page-scroll"><a href="'.$videobg_arrowlink.'" style="color:'.$videobg_arrowlink_color.'"><i class="pe-7s-angle-down-circle" style="color:'.$videobg_arrowlink_color.'"></i></a> </div>';
				}


				foreach( (array) $videobg_repeatable as $key => $slide ){
					$videobg_vertical_alignment = $videobg_alignment = $videobg_title = $videobg_description = $videobg_button1 = $videobg_button1_style = $videobg_button1_target = $button1 =  $videobg_title_rotator = '';
					
					if ( isset( $slide['videobg_title_rotator'] ) )
						$videobg_title_rotator =  esc_attr( $slide['videobg_title_rotator'] );

					if ( isset( $slide['videobg_title_rotator_speed'] ) )
						$videobg_title_rotator_speed =  esc_attr( $slide['videobg_title_rotator_speed'] );

					if ( isset( $slide['videobg_vertical_alignment'] ) )
						$videobg_vertical_alignment = esc_attr( $slide['videobg_vertical_alignment'] );
										
					if ( isset( $slide['videobg_alignment'] ) )
						$videobg_alignment = esc_attr( $slide['videobg_alignment'] );	
						
					if ( isset( $slide['videobg_title'] ) ){
						if ( $videobg_title_rotator == 'on' ){
							$videobg_title = '<div class="text-rotator" data-text-animation="dissolve" data-text-animation-speed="'.$videobg_title_rotator_speed.'"><h2 class="rotate slide-title '.$videobg_title_border.' text-'.$videobg_alignment.' '.$videobg_title_animation.'" style="color:'.$videobg_title_color.' ">'.htmlspecialchars_decode( esc_attr( $slide['videobg_title'] ) ).'</h2></div>
								<div class="slide-divide-line divide-line text-'.$videobg_alignment.' '.$videobg_divide_line_animation.'"><span style="background-color:'.$videobg_title_color.'"></span></div>';
						}
						else{
							$videobg_title = '<h2 class="slide-title '.$videobg_title_border.' text-'.$videobg_alignment.' '.$videobg_title_animation.'" style="color:'.$videobg_title_color.'">'.htmlspecialchars_decode( esc_attr( $slide['videobg_title'] ) ).'</h2>
								<div class="slide-divide-line divide-line text-'.$videobg_alignment.' '.$videobg_divide_line_animation.'"><span style="background-color:'.$videobg_title_color.'"></span></div>';
						}
					}
						
					if ( isset( $slide['videobg_desc'] ) )
						$videobg_description = '<p class="slide-additional-title '.$videobg_additional_title_animation.'" style="color:'.$videobg_description_color.'">'.esc_attr( $slide['videobg_desc'] ).'</p>';
					
					if ( isset( $slide['videobg_button1'] ) )
						$videobg_button1 = esc_attr( $slide['videobg_button1'] );
						
					if ( isset( $slide['videobg_button1_url'] ) )
						$videobg_button1_url = esc_url( $slide['videobg_button1_url'] );
						
					if ( isset( $slide['videobg_button1_style'] ) )
						$videobg_button1_style = esc_attr( $slide['videobg_button1_style'] );

					if ( isset( $slide['videobg_button1_target'] ) )
						$videobg_button1_target = esc_attr( $slide['videobg_button1_target'] );
						
						
					if( !empty($videobg_button1) ){
						$button1 = '<a class="btn btn-'.$videobg_button1_style.' btn-alt" href="'.$videobg_button1_url.'" target="'.$videobg_button1_target.'">'.$videobg_button1.'</a> ';
					}
														
					$videobg_container .= '<li>
						<div class="slide-container container text-'.$videobg_alignment.'">
							<div class="slide-content page-scroll" style="vertical-align:'.$videobg_vertical_alignment.';">
								'.$videobg_description.$videobg_title.$button1.'						
							</div>
						</div>
					</li>';
				
				}			

				if( $videobg_src == '1' ){
					$videobg_background = '<a id="bgndVideo-'.$post.'" class="player" style="background-image:url('.$videobg_fallback.');" data-property="{videoURL:\''.$videobg_url.'\',containment:\'.video-container\', showControls:'.$cookie_options['video-bg-controls'].', autoPlay:'.$cookie_options['video-bg-autoplay'].', loop:'.$cookie_options['video-bg-loop'].', vol:'.$cookie_options['video-bg-volume'].', mute:'.$cookie_options['video-bg-mute'].', startAt:'.$cookie_options['video-bg-start'].', stopAt:'.$cookie_options['video-bg-stop'].', opacity:1, addRaster:false, quality:\''.$cookie_options['video-bg-quality'].'\',}"></a>
						<div class="section-video-controls">
							<a class="command command-play" href="#"></a>
							<a class="command command-pause" href="#"></a>
						</div>';
				}
				else{
					$videobg_background = '<div id="agni-selfhosted-video-'.$post.'" class="custom-video self-hosted embed-responsive embed-responsive-16by9">
							<video '. $autoplay . $loop . $muted . ' class="custom-self-hosted-video" poster="'.$videobg_selfhosted_poster.'">
								<source src="'.$videobg_selfhosted_url.'" type="video/mp4">
							</video>
						</div>';
				}
				$output = '<div id="agni-video-'.$post.'" class="agni-slider agni-video white" '.$height.' data-slide-animation="'.$cookie_options['video-slider-animation'].'" data-slide-animation-speed="'.$cookie_options['video-slider-duration'].'" data-slide-transition-speed="'.$cookie_options['video-slider-transition-duration'].'" data-slide-pagination="'.$cookie_options['video-slider-pagination'].'">
					<div id="video-container-'.$post.'" class="video-container">
						'.$videobg_background.'
						<div class="overlay" style="background-color:'.$videobg_overlay.'; opacity:'.$videobg_opacity.'"></div>
					</div>
					<ul class="slides-container"><!-- data-top="transform:translateY(0px);" data-top-bottom="transform:translateY(400px);" -->
						'.$videobg_container.'
					</ul>
					'.$mousewheel.'
					<nav class="slides-navigation">
						<a href="#" class="next"><i class="pe-7s-angle-right-circle"></i></a>
						<a href="#" class="prev"><i class="pe-7s-angle-left-circle"></i></a>
					</nav>
				</div>	';

				return $output;
				break;
			
			case 'textslider':
				
				$textslider = $button = $textslider_title_animation = $textslider_additional_title_animation = $textslider_divide_line_animation = $textslider_button_animation = $textslider_title_border = $height = $textslider_image = '';
				
				$textslider_title_color = esc_attr( get_post_meta( $post, 'agni_slides_textslider_color_title', true ) );
				$textslider_description_color = esc_attr( get_post_meta( $post, 'agni_slides_textslider_color_desc', true ) );
				$textslider_overlay = esc_attr( get_post_meta( $post, 'agni_slides_textslider_color_overlay', true ) );
				$textslider_overlay_opacity = esc_attr( get_post_meta( $post, 'agni_slides_textslider_opacity', true ) );			
				$textslider_repeatable = get_post_meta( $post, 'agni_slides_textslider_repeatable', true );
				
				$textslider_type = esc_attr( get_post_meta( $post, 'agni_slides_textslider_type', true ) );
				$textslider_height = esc_attr( get_post_meta( $post, 'agni_slides_textslider_height', true ) );
				$textslider_image = esc_attr(get_post_meta($post, 'agni_slides_textslider_image_id', true));
				$textslider_title_animation = esc_attr( get_post_meta( $post, 'agni_slides_textslider_title_animation', true ) );
				$textslider_additional_title_animation = esc_attr( get_post_meta( $post, 'agni_slides_textslider_additional_title_animation', true ) );
				$textslider_divide_line_animation = esc_attr( get_post_meta( $post, 'agni_slides_textslider_divide_line_animation', true ) );
				$textslider_button_animation = esc_attr( get_post_meta( $post, 'agni_slides_textslider_button_animation', true ) );
				$textslider_title_border = esc_attr( get_post_meta( $post, 'agni_slides_textslider_border_title', true ) );
				//$textslider_title_rotator = esc_attr( get_post_meta( $post, 'agni_slides_textslider_title_rotator', true ) );
				$textslider_parallax_start = esc_attr( get_post_meta( $post, 'agni_slides_textslider_parallax_start', true ) );
				$textslider_parallax_end = esc_attr( get_post_meta( $post, 'agni_slides_textslider_parallax_end', true ) );
				$textslider_arrowlink = esc_url(get_post_meta($post, 'agni_slides_textslider_arrowlink', true));
				$textslider_arrowlink_color = esc_attr(get_post_meta($post, 'agni_slides_textslider_arrowlink_color', true));
			
			
				if( $textslider_title_animation == 'on' ){
					$textslider_title_animation = 'animation';
				}
				if( $textslider_additional_title_animation == 'on' ){
					$textslider_additional_title_animation = 'animation animation-delay-1s';
				}
				if( $textslider_divide_line_animation == 'on' ){
					$textslider_divide_line_animation = 'animation';
				}
				if( $textslider_button_animation == 'on' ){
					$textslider_button_animation = 'animation animation-delay-1s';
				}

				if( $textslider_title_border == 'on' ){
					$textslider_title_border = 'slide-bordered-title';
				}

				if( $textslider_type == '1' ){
					$height = 'data-fullscreen-height = 1';
				}
				else{
					$height = 'style="height:'.$textslider_height.'px;" data-inherited-height = \'.agni-slides\'';
				}

				$content_parallax = '';
				if( !empty($textslider_parallax_start) && !empty($textslider_parallax_end) ){
					$content_parallax = 'data-0="'.$textslider_parallax_start.'" data-1500="'.$textslider_parallax_end.'"';
				}
				if( !empty( $textslider_arrowlink ) ){
					$mousewheel = '<div class="mouse-wheel page-scroll" '.$content_parallax.'><a href="'.$textslider_arrowlink.'" style="color:'.$textslider_arrowlink_color.'"><i class="pe-7s-angle-down-circle" style="color:'.$textslider_arrowlink_color.'"></i></a> </div>';
				}
				
				foreach( (array) $textslider_repeatable as $key => $slide ){
					$textslider_vertical_alignment = $textslider_alignment = $textslider_size = $textslider_title = $textslider_description = $textslider_button1 = $textslider_button1_style = $textslider_button1_url = $textslider_button1_target = $textslider_button2 = $textslider_button2_style = $textslider_button2_target = $button = $textslider_title_rotator = '';
					if ( isset( $slide['textslider_vertical_alignment'] ) )
						$textslider_vertical_alignment = esc_attr( $slide['textslider_vertical_alignment'] );
										
					if ( isset( $slide['textslider_alignment'] ) )
						$textslider_alignment = esc_attr( $slide['textslider_alignment'] );
									
					
					if ( isset( $slide['textslider_title_rotator'] ) )
						$textslider_title_rotator =  esc_attr( $slide['textslider_title_rotator'] );

					if ( isset( $slide['textslider_rotator_speed'] ) )
						$textslider_title_rotator_speed =  esc_attr( $slide['textslider_title_rotator_speed'] );

					if ( isset( $slide['textslider_title'] ) ){
						if ( $textslider_title_rotator == 'on' ){
							$textslider_title = '<div class="text-rotator" data-text-animation="dissolve" data-text-animation-speed="'.$textslider_title_rotator_speed.'"><h2 class="rotate slide-title '.$textslider_title_border.' text-'.$textslider_alignment.' '.$textslider_title_animation.'" style="color:'.$textslider_title_color.' ">'.htmlspecialchars_decode( esc_attr( $slide['textslider_title'] ) ).'</h2></div>
								<div class="slide-divide-line divide-line text-'.$textslider_alignment.' '.$textslider_divide_line_animation.'"><span style="background-color:'.$textslider_title_color.'"></span></div>';
						}
						else{
							$textslider_title = '<h2 class="slide-title '.$textslider_title_border.' text-'.$textslider_alignment.' '.$textslider_title_animation.'" style="color:'.$textslider_title_color.'">'.htmlspecialchars_decode( esc_attr( $slide['textslider_title'] ) ).'</h2>
								<div class="slide-divide-line divide-line text-'.$textslider_alignment.' '.$textslider_divide_line_animation.'"><span style="background-color:'.$textslider_title_color.'"></span></div>';
						}
					}
						
					if ( isset( $slide['textslider_desc'] ) )
						$textslider_description = '<p class="slide-additional-title '.$textslider_additional_title_animation.'" style="color:'.$textslider_description_color.'">'.esc_attr( $slide['textslider_desc'] ).'</p>';
						
					if ( isset( $slide['textslider_button1'] ) )
						$textslider_button1 = esc_attr( $slide['textslider_button1'] );
						
					if ( isset( $slide['textslider_button1_url'] ) )
						$textslider_button1_url = esc_url( $slide['textslider_button1_url'] );
						
					if ( isset( $slide['textslider_button1_style'] ) )
						$textslider_button1_style = esc_attr( $slide['textslider_button1_style'] );

					if ( isset( $slide['textslider_button1_target'] ) )
						$textslider_button1_target = esc_attr( $slide['textslider_button1_target'] );

					if ( isset( $slide['textslider_button2'] ) )
						$textslider_button2 = esc_attr( $slide['textslider_button2'] );
						
					if ( isset( $slide['textslider_button2_url'] ) )
						$textslider_button2_url = esc_url( $slide['textslider_button2_url'] );
						
					if ( isset( $slide['textslider_button2_style'] ) )
						$textslider_button2_style = esc_attr( $slide['textslider_button2_style'] );
						
					if ( isset( $slide['textslider_button2_target'] ) )
						$textslider_button2_target = esc_attr( $slide['textslider_button2_target'] );

						
					if( !empty($textslider_button1) ){
						$button .= '<a class="btn btn-'.$textslider_button1_style.' btn-alt slide-button slide-button-1 '.$textslider_button_animation.'" href="'.$textslider_button1_url.'">'.$textslider_button1.' </a> ';
					}
					if( !empty($textslider_button2) ){
						$button .= '<a class="btn btn-'.$textslider_button2_style.' btn-alt slide-button slide-button-2 '.$textslider_button_animation.'" href="'.$textslider_button2_url.'">'.$textslider_button2.' </a> ';
					}
																
					$textslider .= '<li>
						<div class="slide-container container text-'.$textslider_alignment.'">
							<div class="slide-content page-scroll" style="vertical-align:'.$textslider_vertical_alignment.';">
								'.$textslider_description.$textslider_title.$button.'							
							</div>
						</div>
					</li>';
				}
				/*$textslider_image*/
				$output = '<div id="agni-text-slides-'.$post.'" class="agni-slider agni-slides agni-text-slides white" '.$height.' data-slide-animation="'.$cookie_options['textslider-slider-animation'].'" data-slide-animation-speed="'.$cookie_options['textslider-slider-duration'].'" data-slide-transition-speed="'.$cookie_options['textslider-slider-transition-duration'].'" data-slide-pagination="'.$cookie_options['textslider-slider-pagination'].'">
					<div id="textslider-container-'.$post.'" class="textslider-container">
						<div class="textslider-container-image" '.$content_parallax.'>'.wp_get_attachment_image( $textslider_image, 'full' ).'</div>
						<div class="overlay" style="background-color:'.$textslider_overlay.'; opacity:'.$textslider_overlay_opacity.'"></div>
					</div>
					<ul class="slides-container" '.$content_parallax.'><!-- data-top="transform:translateY(0px);" data-top-bottom="transform:translateY(400px);" -->
						'.$textslider.'
					</ul>
					'.$mousewheel.'
					<nav class="slides-navigation">
						<a href="#" class="next"><i class="pe-7s-angle-right-circle"></i></a>
						<a href="#" class="prev"><i class="pe-7s-angle-left-circle"></i></a>
					</nav>
				</div>';
				
				return $output;
				break;

		case 'imageslider':
				
			$imageslider = $button = $imageslider_title_animation = $imageslider_additional_title_animation = $imageslider_divide_line_animation = $imageslider_button_animation = $imageslider_title_border = $height = $imageslider_image = $imageslider_vertical_alignment = $imageslider_alignment = $imageslider_size = $imageslider_title = $imageslider_description = $imageslider_button1 = $imageslider_button1_style = $imageslider_button2 = $imageslider_button2_style = $button = $imageslider_title_rotator =  $mousewheel = '';
			
			$imageslider_title_color = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_color_title', true ) );
			$imageslider_description_color = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_color_desc', true ) );
			$imageslider_overlay = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_color_overlay', true ) );
			$imageslider_overlay_opacity = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_opacity', true ) );			
			$imageslider_repeatable = get_post_meta( $post, 'agni_slides_imageslider_repeatable', true );
			
			$imageslider_type = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_type', true ) );
			$imageslider_height = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_height', true ) );
			$imageslider_image = esc_attr(get_post_meta($post, 'agni_slides_imageslider_image_id', true));
			$imageslider_title_border = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_border_title', true ) );
			//$imageslider_title_rotator = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_rotator', true ) );
			$imageslider_parallax_start = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_parallax_start', true ) );
			$imageslider_parallax_end = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_parallax_end', true ) );
			$imageslider_arrowlink = esc_url(get_post_meta($post, 'agni_slides_imageslider_arrowlink', true));
			$imageslider_arrowlink_color = esc_attr(get_post_meta($post, 'agni_slides_imageslider_arrowlink_color', true));
		
			$imageslider_vertical_alignment = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_vertical_alignment', true ) );
			$imageslider_alignment = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_alignment', true ) );
			$imageslider_title_rotator =  esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_rotator', true ) );
			$imageslider_title_rotator_speed = esc_attr( get_post_meta( $post->ID, 'agni_slides_imageslider_title_rotator_speed', true ) );
			$imageslider_title =  esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title', true ) );
			$imageslider_description =  esc_attr( get_post_meta( $post, 'agni_slides_imageslider_desc', true ) );
			$imageslider_button1 =  esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1', true ) );
			$imageslider_button1_url =  esc_url( get_post_meta( $post, 'agni_slides_imageslider_button1_url', true ) );
			$imageslider_button1_style =  esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_style', true ) );
			$imageslider_button1_target =  esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_target', true ) );
			$imageslider_button2 =  esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2', true ) );
			$imageslider_button2_url =  esc_url( get_post_meta( $post, 'agni_slides_imageslider_button2_url', true ) );
			$imageslider_button2_style =  esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_style', true ) );
			$imageslider_button2_target =  esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_target', true ) );
		

			if( $imageslider_title_border == 'on' ){
				$imageslider_title_border = 'slide-bordered-title';
			}

			if( $imageslider_type == '1' ){
				$height = 'data-fullscreen-height = 1';
			}
			else{
				$height = 'style="height:'.$imageslider_height.'px;" data-inherited-height = \'.agni-slides\'';
			}

			if ( $imageslider_title_rotator == 'on' ){
				if( !empty($imageslider_title) ){
					$imageslider_title = '<div class="text-rotator" data-text-animation="dissolve" data-text-animation-speed="'.$imageslider_title_rotator_speed.'"><h2 class="rotate slide-title '.$imageslider_title_border.' text-'.$imageslider_alignment.' '.$imageslider_title_animation.'" style="color:'.$imageslider_title_color.' ">'.htmlspecialchars_decode( esc_attr( $imageslider_title ) ).'</h2></div>
					<div class="slide-divide-line divide-line text-'.$imageslider_alignment.' '.$imageslider_divide_line_animation.'"><span style="background-color:'.$imageslider_title_color.'"></span></div>';
				}
			}
			else{
				if( !empty($imageslider_title) ){
					$imageslider_title = '<h2 class="slide-title '.$imageslider_title_border.' text-'.$imageslider_alignment.' '.$imageslider_title_animation.'" style="color:'.$imageslider_title_color.'">'.htmlspecialchars_decode( esc_attr( $imageslider_title ) ).'</h2>
					<div class="slide-divide-line divide-line text-'.$imageslider_alignment.' '.$imageslider_divide_line_animation.'"><span style="background-color:'.$imageslider_title_color.'"></span></div>';
				}
			}
			
			if( !empty($imageslider_description) ){		
				$imageslider_description = '<p class="slide-additional-title '.$imageslider_additional_title_animation.'" style="color:'.$imageslider_description_color.'">'.esc_attr( $imageslider_description ).'</p>';
			}
				
				
				
			if( !empty($imageslider_button1) ){
				$button .= '<a class="btn btn-'.$imageslider_button1_style.' btn-alt slide-button slide-button-1 '.$imageslider_button_animation.'" href="'.$imageslider_button1_url.'" target="'.$imageslider_button1_target.'">'.$imageslider_button1.' </a> ';
			}
			if( !empty($imageslider_button2) ){
				$button .= '<a class="btn btn-'.$imageslider_button2_style.' btn-alt slide-button slide-button-2 '.$imageslider_button_animation.'" href="'.$imageslider_button2_url.'" target="'.$imageslider_button2_target.'">'.$imageslider_button2.' </a> ';
			}

			$content_parallax = '';
			
			if( !empty($imageslider_parallax_start) && !empty($imageslider_parallax_end) ){
				$content_parallax = 'data-0="'.$imageslider_parallax_start.'" data-1500="'.$imageslider_parallax_end.'"';
			}
			if( !empty( $imageslider_arrowlink ) ){
				$mousewheel = '<div class="mouse-wheel page-scroll" '.$content_parallax.'><a href="'.$imageslider_arrowlink.'" style="color:'.$imageslider_arrowlink_color.'"><i class="pe-7s-angle-down-circle" style="color:'.$imageslider_arrowlink_color.'"></i></a> </div>';
			}
			
			foreach( (array) $imageslider_repeatable as $key => $slide ){
				$imageslider_image = '';
				
				if ( isset( $slide['imageslider_image_id'] ) )
					$imageslider_image = esc_attr( $slide['imageslider_image_id'] );	
															
				$imageslider .= '<li>
					<div class="imageslider-container-image">'.wp_get_attachment_image( $imageslider_image, 'full' ).'</div>
					<div class="overlay" style="background-color:'.$imageslider_overlay.'; opacity:'.$imageslider_overlay_opacity.'"></div>
				</li>';
			}

			$output = '<div id="agni-image-slides-'.$post.'" class="agni-slider agni-slides agni-image-slides white" '.$height.' data-slide-animation="'.$cookie_options['imageslider-slider-animation'].'" data-slide-animation-speed="'.$cookie_options['imageslider-slider-duration'].'" data-slide-transition-speed="'.$cookie_options['imageslider-slider-transition-duration'].'" data-slide-pagination="'.$cookie_options['imageslider-slider-pagination'].'">
				<ul id="imageslider-container-'.$post.'" class="slides-container imageslider-container" '.$content_parallax.'><!-- data-top="transform:translateY(0px);" data-top-bottom="transform:translateY(400px);" -->
					'.$imageslider.'
				</ul>
				<div class="slide-container container text-'.$imageslider_alignment.'">
					<div class="slide-content page-scroll" style="vertical-align:'.$imageslider_vertical_alignment.';" '.$content_parallax.'>
						'.$imageslider_description.$imageslider_title.$button.'					
					</div>
				</div>
				'.$mousewheel.'
				<nav class="slides-navigation">
					<a href="#" class="next"><i class="pe-7s-angle-right-circle"></i></a>
					<a href="#" class="prev"><i class="pe-7s-angle-left-circle"></i></a>
				</nav>
			</div>';
			
			return $output;
		}
	}
}

/**
 * TGM Plugin activation function
 */
function cookie_register_required_plugins() {

	$plugins = array(
		
		array(
			'name'     				=> 'Agni Framework', 
			'slug'     				=> 'agni-framework-plugin', 
			'source'   				=> get_template_directory() . '/plugins/agni-framework-plugin.zip', 
			'required' 				=> true,
			'version' 				=> '1.0.0', 
			'force_activation'		=> false,
            'force_deactivation'	=> true,
            'external_url'		=> '',
		),
		
		array(
			'name'     				=> 'WPBakery Visual Composer', 
			'slug'     				=> 'js_composer', 
			'source'   				=> get_template_directory() . '/plugins/js_composer.zip', 
			'required' 				=> true,
			'version' 				=> '4.12', 
			'force_activation'		=> false,
            'force_deactivation'	=> false,
            'external_url'		=> '',
		),
		
		array(
			'name'     				=> 'Contact Form 7', 
			'slug'     				=> 'contact-form-7', 
			'source'   				=> get_template_directory() . '/plugins/contact-form-7.4.3.1.zip', 
			'required' 				=> true,
			'version' 				=> '4.3.1', 
			'force_activation'		=> false,
            'force_deactivation'	=> false, 
			'external_url' 			=> 'http://contactform7.com/',
		),

		array(
			'name'     				=> 'Revolution Slider', 
			'slug'     				=> 'revslider', 
			'source'   				=> get_template_directory() . '/plugins/revslider.zip', 
			'required' 				=> true,
			'version' 				=> '5.2.6', 
			'force_activation'		=> false,
            'force_deactivation'	=> false,
            'external_url'			=> 'http://revolution.themepunch.com/',
		),
		
		array(
			'name'     				=> 'MailChimp for WordPress Lite', 
			'slug'     				=> 'mailchimp-for-wp', 
			'source'   				=> get_template_directory() . '/plugins/mailchimp-for-wp.3.1.zip', 
			'required' 				=> false,
			'version' 				=> '3.1', 
			'force_activation'		=> false,
            'force_deactivation'	=> false, 
			'external_url' 			=> '',
		),

		array(
			'name'     				=> 'WooCommerce', 
			'slug'     				=> 'woocommerce', 
			'source'   				=> get_template_directory() . '/plugins/woocommerce.2.6.2.zip', 
			'required' 				=> false,
			'version' 				=> '2.6.2', 
			'force_activation'		=> false,
            'force_deactivation'	=> false, 
			'external_url' 			=> 'http://www.woothemes.com/woocommerce/',
		),

		array(
			'name'     				=> 'Envato WordPress Toolkit', 
			'slug'     				=> 'envato-wordpress-toolkit', 
			'source'   				=> get_template_directory() . '/plugins/envato-wordpress-toolkit 1.7.3.zip', 
			'required' 				=> false,
			'version' 				=> '1.7.3', 
			'force_activation'		=> false,
            'force_deactivation'	=> false, 
			'external_url' 			=> 'https://github.com/envato/envato-wordpress-toolkit',
		),
		
	);

	$config = array(  
		'id'           => 'cookie',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'install-required-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',      					
		'strings'      		=> array(
			'page_title'                       			=> esc_html__( 'Install Required Plugins', 'cookie' ),
			'menu_title'                       			=> esc_html__( 'Install Plugins', 'cookie' ),
			'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'cookie' ), // %1$s = plugin name
			'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'cookie' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'cookie' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'cookie' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'cookie' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'cookie' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'cookie' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'cookie' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'cookie' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'cookie' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'cookie' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'cookie' ),
			'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'cookie' ),
			'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'cookie' ),
			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'cookie' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'cookie_register_required_plugins' );
