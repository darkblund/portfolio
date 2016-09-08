<?php 
/**
 * The template used for displaying clients in your desired page...
 *
 * @package cookie
 */
?>

                  
<?php 
	global $no_posts, $client_cat, $extra_class, $clients_autoplay, $clients_autoplay_timeout, $clients_autoplay_hover, $clients_loop, $clients_pagination, $style, $type, $column, $order, $orderby;
    $args = array(
		'post_type' => 'clients',
		'posts_per_page'	=> $no_posts,
		'tax_query' => $client_cat,
		'orderby' => $orderby,
		'order'   => $order,
	);
	// The Query
	$clients_query = new WP_Query( $args ); ?>
    
    <div class="<?php if( $type == '1' ){ echo 'carousel-clients'; }else{ echo 'row clients'; } ?>" data-clients-autoplay='<?php echo $clients_autoplay; ?>' data-clients-autoplay-timeout='<?php echo $clients_autoplay_timeout; ?>' data-clients-autoplay-hover='<?php echo $clients_autoplay_hover; ?>' data-clients-loop='<?php echo $clients_loop; ?>' data-clients-pagination='<?php echo $clients_pagination; ?>' <?php if( $type == '1' ){ echo $column; } ?>>
    <?php
	// Check if the Query returns any posts
	if ( $clients_query->have_posts() ) {
		while( $clients_query->have_posts() ) : $clients_query->the_post(); ?> 
		
			<?php $clients_image = esc_attr( get_post_meta( $post->ID , 'clients_image_id' , true ) );
			$clients_image_link = esc_attr( get_post_meta( $post->ID  , 'clients_image_link' , true ) ); ?>
			
			<?php if( $type == '2' ){ echo '<div class="'.$column.'">'; }?>
				<div id="post-<?php the_ID(); ?>" class="client client-style-<?php echo $style; ?>">
					<?php if( $clients_image_link != '' ){       ?>         
	                	<a href="<?php echo $clients_image_link; ?>"><?php echo wp_get_attachment_image( $clients_image, 'full' ); ?></a>
	                <?php }
	                else{ ?>
	                	<?php echo wp_get_attachment_image( $clients_image, 'full' ); ?>
	                <?php } ?>
				</div>
			<?php if( $type == '2' ){ echo '</div>'; }?>
		
	<?php endwhile; } ?>
	
	</div>
	<?php wp_reset_postdata(); ?>   
