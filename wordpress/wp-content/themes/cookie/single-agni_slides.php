<?php
/**
 * The Template for displaying all single posts.
 *
 * @package cookie
 */

get_header(); ?>

<div id="primary" class="content-area page-slider">
    <main id="main" class="site-main" role="main">        
        
            <?php while ( have_posts() ) : the_post(); ?>
    
                <?php get_template_part( 'content', 'single-agni_slides' ); ?>
    
            <?php endwhile; // end of the loop. ?>
            
    </main><!-- #main -->
</div><!-- #primary -->

	

<?php get_footer(); ?>