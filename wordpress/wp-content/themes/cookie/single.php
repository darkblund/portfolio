<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Agni Framework
 */

get_header(); ?>
<?php
function agni_single(){
global $cookie_options, $post; 

$post_fullwidth = esc_attr( get_post_meta( $post->ID, 'post_fullwidth', true ) );
$post_sidebar = esc_attr( get_post_meta( $post->ID, 'post_sidebar', true ) );

if( $post_fullwidth == 'on' ){
	$post_fullwidth = '-fluid';
}
?>
<?php echo agni_page_header($post);?>
<section class="blog blog-post blog-single-post <?php echo $post_sidebar; ?>">
	<div class="blog-container container<?php echo $post_fullwidth; ?>">
		<div class="row">
			<div class="col-sm-12 col-md-<?php if( $post_sidebar != 'no-sidebar' ){ echo '8'; }else { echo '12'; } ?> blog-single-post-content">
				
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'single' ); ?>

						<?php  if( $cookie_options['author-biography'] == '1' ){  ?>
	                        <div class="author-bio">
	                            <div class="author-avatar"><?php echo get_avatar( get_the_author_meta('email'), 100 ); ?></div>
	                            <div class="author-details">
	                                <h6 class="author-name"><?php the_author(); ?></h6>                
	                                <p class="author-description"><?php the_author_meta('description'); ?></p>
	                            </div>
	                        </div>
                        
                        <?php  } ?>	

                        <div class="portfolio-navigation-container">
			            	<?php agni_framework_post_nav(); ?>
			            </div>  
						<?php //agni_framework_post_nav(); //the_post_navigation(); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // End of the loop. ?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<?php if( $post_sidebar != 'no-sidebar' ){ ?>
				<div class="col-sm-12 col-md-4 blog-post-sidebar">
					<?php get_sidebar(); ?>
				</div>
			<?php }?>
		</div>
	</div>
</section>
<?php }
agni_single(); ?>

<?php get_footer(); ?>
