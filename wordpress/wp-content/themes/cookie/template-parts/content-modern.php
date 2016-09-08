<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item modern' ); ?>>
	
	
	<div class="entry-thumbnail">
		<?php if( has_post_thumbnail() ){ 
			the_post_thumbnail( 'cookie-grid-thumbnail' ); 
			?><div class="overlay"></div><?php
		} ?>
	</div>
	<div class="entry-content">
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php agni_framework_post_cat(); ?>
				<?php agni_framework_post_date(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
