<?php
/*
   Template Name: Portfolio
 *
 * The template for displaying all portfolio.
 *
 *
 * @package cookie
 */

get_header();  
function agni_page_portfolio(){
global $cookie_options, $post; ?>
<?php echo agni_page_header( $post ); ?>

<?php 
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(			
		'post_type' => array( 'portfolio' ),			
		'posts_per_page' => $cookie_options['portfolio-per-page'],
		'order' => $cookie_options['portfolio-post-order'],
		'orderby' => $cookie_options['portfolio-post-orderby'],
		'post__not_in'   => explode( ',', $cookie_options['portfolio-post-exclude'] ),	
		'paged'=> $paged		
	); 
	
	$query = new WP_Query( $args );
	
    switch($cookie_options['portfolio-layout']){
        case '1':
            $col = 'col-xs-12 col-sm-12 col-md-12';
            break;
        case '2':
            $col = 'col-xs-12 col-sm-12 col-md-6';
            break;
        case '3':
            $col = 'col-xs-12 col-sm-6 col-md-4';
            break;
        case '4':
            $col = 'col-xs-12 col-sm-6 col-md-3';
            break;
        case '5':
            $col = 'col-xs-12 col-sm-4 col-md-3 col-lg-2_5';
            break;
    }

?>
    <div id="primary" class="page-portfolio content-area">
        <main id="main" class="page-portfolio-container container<?php if( $cookie_options['portfolio-fullwidth'] == '1' ){ echo '-fluid '; } ?><?php if( $cookie_options['portfolio-navigation'] != '1'){ echo ' has-infinite-scroll '; }?><?php if( $cookie_options['portfolio-navigation'] == '3'){ echo ' has-load-more'; }?> site-main" role="main" data-dir="<?php echo AGNI_FRAMEWORK_URL; ?>">
            <?php if( $cookie_options['portfolio-filter'] == '1' ){ ?><div class="portfolio-filter <?php if( $cookie_options['portfolio-fullwidth'] == '1' ){ echo 'container-fluid '; } ?> text-<?php echo esc_attr($cookie_options['portfolio-filter-align']); ?>"><?php echo agni_portfolio_filter( $cookie_options['portfolio-filter-order'], $cookie_options['portfolio-filter-orderby'] ); ?></div><?php } ?>
            <div class="row portfolio-container <?php if( $cookie_options['portfolio-fullwidth'] == '1' ){ echo 'portfolio-fullwidth '; } ?><?php if( $cookie_options['portfolio-gutter'] != '1' ){ echo 'portfolio-no-gutter'; } ?><?php if( $cookie_options['portfolio-navigation'] != '1'){ echo ' has-infinite-scroll '; }?>" data-grid="<?php echo esc_attr($cookie_options['portfolio-grid']); ?>">
                <?php $i = $ad = 0; if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) : $query->the_post(); 

                        $portfolio_thumbnail_width = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_width', true ) );
                        $portfolio_custom_link = esc_url( get_post_meta( $post->ID, 'portfolio_custom_link', true ) );
                        
                        $portfolio_category_list = $portfolio_category = '';
                        $terms = get_the_terms( $post->ID, 'types' );
                        if ( $terms && ! is_wp_error( $terms ) ) :
                            foreach ( $terms as $term )
                            {
                                $portfolio_category .= strtolower($term->slug).' ';//strtolower($term->name).' ';
                                $portfolio_category_list .= '<li>'.$term->name.'</li>';
                            }
                        endif;
                            
                        if( $portfolio_thumbnail_width == 'width2x' ){
                            $i += 1;
                        }
                        if( $i >= $cookie_options['portfolio-layout'] ){
                            $ad = $i = 0;
                        }
                        $ad += 0.2;
                        $i += 1;

                        ?><div class="<?php echo $col; ?> portfolio-column <?php echo $portfolio_thumbnail_width; ?> <?php echo $portfolio_category; ?>all portfolio-hover-style-<?php echo esc_attr($cookie_options['portfolio-hover-style']); ?> <?php if( $cookie_options['portfolio-bottom-caption'] == '1' ){ echo 'has-bottom-caption'; } ?>">
                            <?php if( $cookie_options['portfolio-animation'] == '1' ){?>
                                <div class="animate" data-animation="<?php echo esc_attr($cookie_options['portfolio-animation-style']); ?>" data-animation-offset="<?php echo esc_attr($cookie_options['portfolio-animation-offset']); ?>%" style="animation-duration: 0.4s;     animation-delay: <?php echo $ad; ?>s;     -moz-animation-duration: 0.4s;  -moz-animation-delay: <?php echo $ad; ?>s;    -webkit-animation-duration: 0.4s;   -webkit-animation-delay: <?php echo $ad; ?>s; ">
                            <?php } ?>
                            <div id="portfolio-post-<?php the_ID(); ?>" class="portfolio-post">
                                <div class="portfolio-thumbnail">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <?php if( $cookie_options['portfolio-hover-style'] <= '10' ){?>
                                    <div class="portfolio-caption-content">
                                        <div class="portfolio-content">
                                            <div class="portfolio-content-details">
                                                <div class="portfolio-icon hide"><a href="<?php if( !empty($portfolio_custom_link) ){ echo $portfolio_custom_link; }else{ the_permalink(); } ?>" target="<?php echo $cookie_options['portfolio-post-link-target']; ?>"><span></span></a></div>
                                                <h5 class="portfolio-title"><a href="<?php if( !empty($portfolio_custom_link) ){ echo $portfolio_custom_link; }else{ the_permalink(); } ?>" target="<?php echo $cookie_options['portfolio-post-link-target']; ?>"><?php the_title(); ?></a></h5>
                                                <ul class="portfolio-category list-inline">
                                                    <?php echo $portfolio_category_list; ?>
                                                </ul>
                                                <div class="portfolio-meta">
                                                    <a href="<?php if( !empty($portfolio_custom_link) ){ echo $portfolio_custom_link; }else{ the_permalink(); } ?>" target="<?php echo $cookie_options['portfolio-post-link-target']; ?>"><i class="fa fa-link"></i></a>
                                                    <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" class="portfolio-attachment"><i class="fa fa-image"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                else{ ?>
                                    <div class="portfolio-caption-content">
                                        <div class="portfolio-content">
                                            <div class="portfolio-content-details">
                                                <h5 class="portfolio-title"><a class="portfolio-single-link" href="<?php if( !empty($portfolio_custom_link) ){ echo $portfolio_custom_link; }else{ the_permalink(); } ?>" target="<?php echo $cookie_options['portfolio-post-link-target']; ?>"><?php the_title(); ?></a></h5>
                                                <ul class="portfolio-category list-inline">
                                                    <?php echo $portfolio_category_list; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if( $cookie_options['portfolio-bottom-caption'] == '1' ){?>
                                    <div class="portfolio-bottom-caption">
                                        <h5 class="portfolio-bottom-caption-title"><a href="<?php if( !empty($portfolio_custom_link) ){ echo $portfolio_custom_link; }else{ the_permalink(); } ?>" target="<?php echo $cookie_options['portfolio-post-link-target']; ?>"><?php the_title(); ?></a></h5>
                                        <ul class="portfolio-bottom-caption-category list-inline">
                                            <?php echo $portfolio_category_list; ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php if( $cookie_options['portfolio-animation'] == '1' ){?>
                                </div>
                            <?php } ?>
                        </div><?php 
                    endwhile;
                endif; 
                // Reset Post Data
                wp_reset_postdata(); ?>
            </div>
            <?php if( $cookie_options['portfolio-navigation'] != '1' ){ echo '<div class="load-more text-center"></div>'; } if( $cookie_options['portfolio-navigation'] == '3' ){ echo '<div class="load-more-button text-center"><a href="#" class="btn btn-default">Load More</a></div>'; } if( $cookie_options['portfolio-navigation'] ){ agni_page_navigation( $query, $number_navigation = 'portfolio-number-navigation' ); } ?>
        </main><!-- #main -->
    </div><!-- #primary --> 
<?php }
agni_page_portfolio(); ?>

<?php get_footer(); ?>
