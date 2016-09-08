<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */

?>
<?php global $cookie_options; ?>
<?php ob_start(); 
	
	if( get_post_format() == 'link' ){ 
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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-meta">
		<?php agni_framework_post_cat(); ?>
		<?php agni_framework_post_date(); ?>
	</div><!-- .entry-meta -->

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<?php if( !empty($post_thumbnail) ){ ?> 
	<div class="entry-thumbnail">
		<?php echo $post_thumbnail; ?>
	</div>
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cookie' ),
				'after'  => '</div>',
			) );
		?>
		<?php agni_framework_post_tag(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if( $cookie_options['blog-sharing-panel'] == '1' ){?>
	        <div class=" portfolio-sharing-buttons text-center">
		        <ul class="list-inline">
		            <?php  if($cookie_options['blog-sharing-icons'][1] == '1'){ ?>
		                <li><a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() );?>/&amp;t=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-facebook"></i></a></li>
		            <?php  }?>
		            <?php  if($cookie_options['blog-sharing-icons'][2] == '1'){ ?>
		                <li><a href="https://twitter.com/intent/tweet?text=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>-<?php esc_url( the_permalink() ); ?>"><i class="fa fa-twitter"></i></a></li>
		            <?php  }?>
		        	<?php  if($cookie_options['blog-sharing-icons'][3] == '1'){ ?>             
		                <li><a href="https://plus.google.com/share?url=<?php esc_url( the_permalink() );?>"><i class="fa fa-google-plus"></i></a></li>
		            <?php  }?>
		            <?php  if($cookie_options['blog-sharing-icons'][4] == '1'){ ?>             
		                <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url( the_permalink() );?>&title=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-linkedin"></i></a></li>
		            <?php  }?>
		        </ul>
		    </div>
	    <?php } ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

