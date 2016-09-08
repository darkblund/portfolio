<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Agni Framework
 */

get_header(); ?>

<?php echo agni_page_header($post);?>
<div id="primary" class="single-page-portfolio content-area ">
    <main id="main" class="site-main single-page-portfolio-container" role="main">        
    
		<?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'template-parts/content', 'single-portfolio' ); ?>
            	
            <div class="portfolio-navigation-container">
            	<div class="container">
            		<?php agni_framework_portfolio_nav(); //the_post_navigation(); ?>
            	</div>
            </div>  
        <?php endwhile; // end of the loop. ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>