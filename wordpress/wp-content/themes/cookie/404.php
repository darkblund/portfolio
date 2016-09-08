<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Agni Framework
 */

get_header(); 
function agni_404(){
global $cookie_options;
?>
<section class="page-404">
	<div class="page-container container">
		<div class="row">
			<div class="col-sm-12 col-md-offset-3 col-md-6 page-404-content">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						<div class="error-404 not-found text-center">
							<h1 class="page-title"><?php echo esc_attr($cookie_options['404-title']); ?></h1>
							<p><?php echo $cookie_options['404-description-text']; ?></p>

							<?php if( $cookie_options['404-searchbox'] == '1'){
								echo get_search_form();
							} ?>
						</div><!-- .error-404 -->
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>
	</div>
</section>
<?php } 
agni_404(); ?>
<?php get_footer(); ?>
