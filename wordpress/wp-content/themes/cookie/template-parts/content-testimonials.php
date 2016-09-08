<?php 
/**
 * The template used for displaying slider in your desired page...
 *
 * @package cookie
 */
?>


<?php 

global $no_posts, $style, $extra_class, $quote_cat, $testimonial_autoplay, $testimonial_autoplay_timeout, $testimonial_autoplay_speed, $testimonial_autoplay_hover, $testimonial_loop, $testimonial_pagination, $type, $column, $order, $orderby, $circle_avatar, $alignment; ?>

<div class="<?php echo $extra_class; ?> <?php if( $type == '1' ){ echo 'carousel-testimonials'; }else{ echo 'row grid-testimonials'; } ?> " data-testimonial-autoplay='<?php echo $testimonial_autoplay; ?>' data-testimonial-autoplay-timeout='<?php echo $testimonial_autoplay_timeout; ?>' data-testimonial-autoplay-speed='<?php echo $testimonial_autoplay_speed; ?>' data-testimonial-autoplay-hover='<?php echo $testimonial_autoplay_hover; ?>' data-testimonial-loop='<?php echo $testimonial_loop; ?>' data-testimonial-pagination='<?php echo $testimonial_pagination; ?>' <?php if( $type == '1' ){ echo $column; } ?>>

<?php  

$args = array(
	'post_type' => 'testimonials',
	'posts_per_page'	=> $no_posts,
	'tax_query' => $quote_cat,
    'orderby' => $orderby,
    'order'   => $order,
);
// The Query

$testimonials_query = new WP_Query( $args ); ?>

	<?php // Check if the Query returns any posts
  	if ( $testimonials_query->have_posts() ) {
        while( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); 			
        
            $testimonial_image = esc_attr( get_post_meta( $post->ID , 'testimonial_image_id' , true ) );
            $testimonial_quote = esc_attr( get_post_meta( $post->ID , 'testimonial_quote' , true ) );
            $testimonial_author = esc_attr( get_post_meta( $post->ID , 'testimonial_author' , true ) ); 
            $testimonial_author_designation = esc_attr( get_post_meta( $post->ID , 'testimonial_author_designation' , true ) );   

            if( !empty( $testimonial_author_designation ) ){
                $testimonial_author_designation = '<p class="testimonial-quote-designation">'.$testimonial_author_designation.'</p>';
            }

            ?>    
            
            <?php if( $type == '2' ){ echo '<div class="'.$column.'">'; }?>
                <div id="post-<?php the_ID(); ?>" class="testimonial-content <?php echo 'text-'.$alignment; ?> ">		
                    <div class="testimonial-avatar">
                        <?php
    						$test_args = array( 'class'	=> $circle_avatar.' attachment-thumbnail', );					
    						echo wp_get_attachment_image( $testimonial_image, 'thumbnail', '', $test_args ); 
    					?>                    
                    </div>
                    <p class="testimonial-quote-text additional-heading"><?php echo $testimonial_quote; ?></p>
                    <h6 class="testimonial-quote-cite"><?php echo $testimonial_author; ?></h6>
                    <?php echo $testimonial_author_designation; ?>
                </div>
            <?php if( $type == '2' ){ echo '</div>'; }?>
     <?php  endwhile; }  wp_reset_postdata(); ?> 
</div>
