<?php
/**
 * @package cookie
 */
?>

<?php global $cookie_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-single-content' ); ?>>  
    <div class="portfolio-entry-content">
        <?php the_content(); ?>
    </div>	<!-- .entry-content -->
    <?php if( $cookie_options['portfolio-sharing-panel'] == '1' ){?>
        <div class=" portfolio-sharing-buttons text-center">
            <div class="container">
            <ul class="list-inline">
                <?php  if($cookie_options['portfolio-sharing-icons'][1] == '1'){ ?>
                    <li><a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() );?>/&amp;t=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-facebook"></i></a></li>
                <?php  }?>
                <?php  if($cookie_options['portfolio-sharing-icons'][2] == '1'){ ?>
                    <li><a href="https://twitter.com/intent/tweet?text=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>-<?php esc_url( the_permalink() ); ?>"><i class="fa fa-twitter"></i></a></li>
                <?php  }?>
                <?php  if($cookie_options['portfolio-sharing-icons'][3] == '1'){ ?>             
                    <li><a href="https://plus.google.com/share?url=<?php esc_url( the_permalink() );?>"><i class="fa fa-google-plus"></i></a></li>
                <?php  }?>
                <?php  if($cookie_options['portfolio-sharing-icons'][4] == '1'){ ?>             
                    <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url( the_permalink() );?>&title=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-linkedin"></i></a></li>
                <?php  }?>
            </ul>
        </div>
        </div>
    <?php } ?>
</article><!-- #post-## -->

