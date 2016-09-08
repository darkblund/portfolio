<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */

get_header(); ?>
<?php 
function agni_archive(){
global $cookie_options; ?>
<section class="blog blog-post <?php echo esc_attr($cookie_options['archive-layout']); ?>-layout-post <?php echo esc_attr($cookie_options['archive-sidebar']);?>">
	<div class="blog-container container">
		<div class="row">
			<div class="col-sm-12 col-md-<?php if( $cookie_options['archive-sidebar'] != 'no-sidebar' ){ echo '8'; }else { echo '12'; } ?> blog-post-content" data-blog-grid="<?php echo esc_attr($cookie_options['blog-grid-layout']); ?>">
				<div id="primary" class="content-area">
					<?php if ( have_posts() ) : ?>
					<header class="page-header">
						<?php
							the_archive_title( '<h5 class="page-title">', '</h5>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->
					<main id="main" class="site-main" role="main">

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php switch( $cookie_options['archive-layout'] ){
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
					<?php if( $cookie_options['blog-navigation'] == '1' ){ agni_page_navigation( '', $number_navigation = 'post-number-navigation' ); }else{ the_posts_navigation(); } ?>
				</div><!-- #primary -->
			</div>
			<?php if( $cookie_options['archive-sidebar'] != 'no-sidebar' ){ ?>
				<div class="col-sm-12 col-md-4 blog-post-sidebar">
					<?php get_sidebar(); ?>
				</div>
			<?php }?>
		</div>
	</div>
</section>
<?php }
agni_archive(); ?>
<?php get_footer(); ?>
