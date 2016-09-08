<?php 
/**
 * The template used for displaying slider in your desired page...
 *
 * @package cookie
 */
?>


<?php 
	
	global $no_posts, $style, $team_cat, $extra_class, $team_autoplay, $team_autoplay_timeout, $team_autoplay_hover, $team_loop, $team_pagination, $type, $column, $order, $orderby ;
	$args = array(
		'post_type' => 'team',
		'posts_per_page'	=> $no_posts,
		'tax_query' => $team_cat,
		'orderby' => $orderby,
		'order'   => $order,
	);
	// The Query
	$team_query = new WP_Query( $args ); ?>
	<div class="<?php if( $type == '1' ){ echo 'carousel-team'; }else{ echo 'grid-team'; } ?> <?php echo $extra_class; ?>" data-team-autoplay='<?php echo $team_autoplay; ?>' data-team-autoplay-timeout='<?php echo $team_autoplay_timeout; ?>' data-team-autoplay-hover='<?php echo $team_autoplay_hover; ?>' data-team-loop='<?php echo $team_loop; ?>' data-team-pagination='<?php echo $team_pagination; ?>' <?php if( $type == '1' ){ echo $column; } ?>>
		<?php if( $type == '2' ){ echo '<div class="row">'; } ?>
    <?php 
	// Check if the Query returns any posts
	if ( $team_query->have_posts() ) {
		while( $team_query->have_posts() ) : $team_query->the_post();  
		
			$member_image_url = esc_attr( get_post_meta( $post->ID , 'member_image_url_id' , true ) );
			$member_name = esc_attr( get_post_meta( $post->ID , 'member_name' , true ) );
			$member_name_link = esc_url( get_post_meta( $post->ID , 'member_name_link' , true ) );
			$member_designation = esc_attr( get_post_meta( $post->ID , 'member_designation' , true ) );
			$member_description = esc_attr( get_post_meta( $post->ID , 'member_description' , true ) );
					
			$member_facebook_link = esc_url( get_post_meta( $post->ID , 'member_facebooklink' , true ) );
			$member_twitter_link = esc_url( get_post_meta( $post->ID , 'member_twitterlink' , true ) );
			$member_googleplus_link = esc_url( get_post_meta( $post->ID , 'member_googlepluslink' , true ) );
			$member_vk_link = esc_url( get_post_meta( $post->ID , 'member_vklink' , true ) );
			$member_behance_link = esc_url( get_post_meta( $post->ID , 'member_behancelink' , true ) );
			$member_pinterest_link = esc_url( get_post_meta( $post->ID , 'member_pinterestlink' , true ) );
			$member_dribbble_link = esc_url( get_post_meta( $post->ID , 'member_dribbblelink' , true ) );
			$member_skype_link = esc_attr( get_post_meta( $post->ID , 'member_skypelink' , true ) );
			$member_linkedin_link = esc_url( get_post_meta( $post->ID , 'member_linkedinlink' , true ) );
			$member_instagram_link = esc_url( get_post_meta( $post->ID , 'member_instagramlink' , true ) );

			$member_email_id = esc_attr( get_post_meta( $post->ID , 'member_emailid' , true ) );
			$member_number = esc_attr( get_post_meta( $post->ID , 'member_number' , true ) );
			
			$member_links = null;
			if( !empty($member_facebook_link) ){
				$member_links .= '<li><a href="'.$member_facebook_link.'"><i class=" fa fa-facebook" ></i></a></li>';
			}
			if( !empty($member_twitter_link) ){
				$member_links .= '<li><a href="'.$member_twitter_link.'"><i class=" fa fa-twitter" ></i></a></li>';
			}
			if( !empty($member_googleplus_link) ){
				$member_links .= '<li><a href="'.$member_googleplus_link.'"><i class=" fa fa-google-plus" ></i></a></li>';
			}
			if( !empty($member_vk_link) ){
				$member_links .= '<li><a href="'.$member_vk_link.'"><i class=" fa fa-vk" ></i></a></li>';
			}
			if( !empty($member_behance_link) ){
				$member_links .= '<li><a href="'.$member_behance_link.'"><i class=" fa fa-behance" ></i></a></li>';
			}
			if( !empty($member_pinterest_link) ){
				$member_links .= '<li><a href="'.$member_pinterest_link.'"><i class=" fa fa-pinterest" ></i></a></li>';
			}
			if( !empty($member_dribbble_link) ){
				$member_links .= '<li><a href="'.$member_dribbble_link.'"><i class=" fa fa-dribbble" ></i></a></li>';
			}
			if( !empty($member_skype_link) ){
				$member_links .= '<li><a href="'.$member_skype_link.'"><i class=" fa fa-skype" ></i></a></li>';
			}
			if( !empty($member_linkedin_link) ){
				$member_links .= '<li><a href="'.$member_linkedin_link.'"><i class=" fa fa-linkedin" ></i></a></li>';
			}	
			if( !empty($member_instagram_link) ){
				$member_links .= '<li><a href="'.$member_instagram_link.'"><i class=" fa fa-instagram" ></i></a></li>';
			}	
			if( !empty($member_email_id) ){
				$member_links .= '<li><a href="mailto:'.$member_email_id.'"><i class=" fa fa-envelope" ></i></a></li>';
			}	
			
            if( !empty($member_name_link) ){
				$member_name = '<a href="'.$member_name_link.'">'.$member_name.'</a>';
			}         	
			
			if( !empty($member_designation) ){
				$member_designation = '<p class="member-designation-text">'.$member_designation.'</p>';	
			}
			
			?>
			
			<?php if( $type == '2' ){ echo '<div class="'.$column.'">'; } ?>
			<?php $has_bottom_caption = ''; if( $style == '2' ){ $has_bottom_caption = 'has-bottom-caption'; } ?>
			<div id="member-post-<?php the_ID(); ?>" <?php post_class( 'member-content member-post '.$has_bottom_caption ); ?>>
			    <div class="member-thumbnail">
			        <?php echo wp_get_attachment_image( $member_image_url, 'cookie-grid-thumbnail' ); ?>
			    </div>
			    <div class="member-caption-content">
			        <div class="member-content">
			            <div class="member-content-details">
			                <?php if( $style != '2' ){?>
			                    <h5 class="member-title"><?php echo  $member_name; ?></h5>
			                    <?php echo  $member_designation ?>
			                <?php } ?>
			                <div class="member-meta">
			                	<ul class="list-inline">
				                    <?php echo $member_links ?>
				                </ul>
				                <span class="member-contact"><?php echo $member_number; ?></span>
				            </div>
			            </div>
			        </div>
			    </div>
			    <?php if( $style == '2' ){?>
			        <div class="member-bottom-caption">
			             <h5 class="member-bottom-caption-title"><?php echo  $member_name; ?></h5>
			            <?php echo  $member_designation ?>
			        </div>
			    <?php } ?>
			</div>
            <?php if( $type == '2' ){ echo '</div>'; } ?>
	<?php endwhile; } ?>
	<?php if( $type == '2' ){ echo '</div>'; } ?>
	</div>
	<?php wp_reset_postdata(); ?> 