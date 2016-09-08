<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */
 
get_header(); ?>
<?php $agni_slider = ''; $agni_slides_post_id = esc_attr( get_post_meta($post->ID, 'page_agni_sliders', true) );	
	foreach ( (array) $agni_slides_post_id as $key => $slider ) {
		$agni_slider .=  agni_slider( $slider );
	}
	echo $agni_slider; 

?>    
<?php echo agni_page_header( $post ); 

$remove_margin = '';
$remove_margin = esc_attr( get_post_meta( $post->ID, 'page_remove_margin', true ) );
$fullwidth = esc_attr( get_post_meta( $post->ID, 'page_fullwidth', true ) );
?>
	<div id="primary" class="<?php if( $remove_margin == 'on' ){ echo 'page-fullwidth'; }else{ echo 'page-default'; } ?> content-area">
		<main id="main" class="site-main <?php if( $fullwidth != 'on' ){ echo 'container'; }?>" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
