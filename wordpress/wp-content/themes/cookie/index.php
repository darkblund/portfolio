<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */

get_header(); ?>
<?php global $cookie_options; ?>
<?php if(!is_front_page()){ $page = new stdClass(); $page->ID = get_option( 'page_for_posts' ); $agni_slider = ''; $agni_slides_post_id = esc_attr(get_post_meta($page->ID, 'page_agni_sliders', true));	
	foreach ( (array) $agni_slides_post_id as $key => $slider ) {
		$agni_slider .=  agni_slider( $slider );
	}
	echo $agni_slider;
		
	echo agni_page_header( $page );
} ?>
<?php if( $cookie_options['blog-posts-carousel'] ){ 
	$cookie_options['blog-posts-carousel-categories'] = ( !empty($cookie_options['blog-posts-carousel-categories']) )? $cookie_options['blog-posts-carousel-categories'] : '';
	$cookie_options['blog-posts-carousel-nav'] = ( $cookie_options['blog-posts-carousel-nav'] == '1')? 'true':'false';
	$cookie_options['blog-posts-carousel-pag'] = ( $cookie_options['blog-posts-carousel-pag'] == '1')? 'true':'false';
	$cookie_options['blog-posts-carousel-loop'] = ( $cookie_options['blog-posts-carousel-loop'] == '1')? 'true':'false';
	$cookie_options['blog-posts-carousel-auto'] = ( $cookie_options['blog-posts-carousel-auto'] == '1')? 'true':'false';
	
	agni_posts_carousel( $cookie_options['blog-posts-carousel-categories'], $cookie_options['blog-posts-per-carousel'], $cookie_options['blog-posts-thumbnail-opacity'], $cookie_options['blog-posts-carousel-nav'], $cookie_options['blog-posts-carousel-pag'], $cookie_options['blog-posts-carousel-loop'], $cookie_options['blog-posts-carousel-auto'], $cookie_options['blog-posts-carousel-margin'] ); 
} ?>
<section class="blog blog-post <?php echo esc_html($cookie_options['blog-layout']); ?>-layout-post <?php echo esc_attr($cookie_options['blog-sidebar']); ?>">
	<div class="blog-container container <?php if( $cookie_options['blog-navigation'] == '3' || $cookie_options['blog-navigation'] == '4' ){ echo ' has-infinite-scroll '; }?><?php if( $cookie_options['blog-navigation'] == '4'){ echo ' has-load-more'; }?>" data-dir="<?php echo AGNI_FRAMEWORK_URL;?>">
		<div class="row">
			<div class="col-sm-12 col-md-<?php if( $cookie_options['blog-sidebar'] != 'no-sidebar' ){ echo '8'; }else { echo '12'; } ?> blog-post-content" <?php if( $cookie_options['blog-layout'] != 'standard' ){ echo 'data-blog-grid="'.$cookie_options['blog-grid-layout'].'"'; } ?>>
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) : ?>

						<?php if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
						<?php endif; ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php switch( $cookie_options['blog-layout'] ){
								case 'grid':
									get_template_part( 'template-parts/content', 'grid' );
									break;
								case 'standard-grid':
									if( $wp_query->current_post == 0 && !is_paged() ) : 
										get_template_part('template-parts/content');
									else : 
										get_template_part('template-parts/content', 'grid'); 
									endif; 
									break;
								case 'modern':
									get_template_part( 'template-parts/content', 'modern' );
									break;
								default :
									get_template_part( 'template-parts/content' );
									break;
							} ?>

						<?php endwhile; ?>
						<!-- Loop Ends -->
					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>

					</main><!-- #main -->
					<!-- Post Navigation -->
					<?php  if( $cookie_options['blog-navigation'] == '3' || $cookie_options['blog-navigation'] == '4' ){ echo '<div class="load-more text-center"></div>'; } 
					 if( $cookie_options['blog-navigation'] == '4' ){ echo '<div class="load-more-button text-center"><a href="#" class="btn btn-default">Load More</a></div>'; } 
					if( $cookie_options['blog-navigation'] != '1' ){ agni_page_navigation( '', $number_navigation = 'post-number-navigation' ); }else{ the_posts_navigation(); } ?>
				</div><!-- #primary -->
			</div>
			<?php if( $cookie_options['blog-sidebar'] != 'no-sidebar' ){ ?>
				<div class="col-sm-12 col-md-4 blog-post-sidebar">
					<?php get_sidebar(); ?>
				</div>
			<?php }?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
