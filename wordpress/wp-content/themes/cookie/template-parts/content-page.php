<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */

?>
<?php 
$remove_title = '';
$remove_title = esc_attr( get_post_meta( $post->ID, 'page_remove_title', true ) );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( empty($remove_title)){ ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php } ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cookie' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

