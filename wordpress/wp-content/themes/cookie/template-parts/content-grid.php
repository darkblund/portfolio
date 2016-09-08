<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */

?>
<?php ob_start(); if( has_post_thumbnail() ){ 
		the_post_thumbnail( 'cookie-grid-thumbnail' ); 
	}elseif( get_post_format() == 'link' ){ 
		agni_post_link($post->ID);        
	}elseif( get_post_format() == 'gallery' ){ 
		agni_post_gallery($post->ID);        
	} elseif( get_post_format() == 'quote' ){ 
		agni_post_quote($post->ID);        
	} elseif( get_post_format() == 'audio' ){ 
		agni_post_audio($post->ID);        
	} elseif( get_post_format() == 'video' ){ 
		agni_post_video($post->ID);        
	} 

	$post_thumbnail = ob_get_contents(); 
	ob_end_clean();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item' ); ?>>
	
	<?php if( !empty($post_thumbnail) ){ ?> 
	<div class="entry-thumbnail">
		<?php echo $post_thumbnail; ?>
	</div>
	<?php } ?>

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php agni_framework_post_cat(); ?>
			<?php agni_framework_post_date(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>

	<div class="entry-content">
		<?php
			agni_excerpt_length(150);
		?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cookie' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

