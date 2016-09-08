<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agni Framework
 */

?>
<?php function agni_footer(){ 
	global $cookie_options; ?>
<?php ob_start(); ?>	
	<nav class="footer-nav-menu additional-nav-menu" >
		<?php  wp_nav_menu(array( 'menu_class' => 'footer-nav-menu-content list-inline', 'menu_id' => 'footer-navigation', 'container' => false, 'theme_location' => 'ternary', 'fallback_cb'     => '' ) ); ?> 
	</nav>
<?php $footer_nav = ob_get_contents();
ob_end_clean(); ?>
<?php ob_start(); ?>	
	<div class="footer-social">
		<ul class="social-icons list-inline">
			<?php if( $cookie_options['social-media-footer'] == '1' ){ 
				foreach( $cookie_options['social-media-icons-footer'] as $social_checkbox => $social_icons ){
					if( $social_icons == '1' ){ ?>
						<li><a class="<?php echo esc_attr($cookie_options['social-media-style']); ?>" target="<?php echo esc_attr($cookie_options['footer-link-target']);?>" href="<?php echo esc_url( $cookie_options[ $social_checkbox .'-link' ] );?>"> <i class="fa fa-<?php echo esc_attr($social_checkbox);?>"></i></a></li>
					<?php }
				}
			}?>   
		</ul>
	</div>
<?php $footer_social = ob_get_contents();
ob_end_clean(); ?>
<?php ob_start(); ?>	
	<div class="footer-text"><?php echo $cookie_options['footer-text'];?></div>
<?php $footer_text = ob_get_contents();
ob_end_clean(); ?>
	</div><!-- #content -->
	
	<?php if( $cookie_options['footer-widget'] == '1' ){ ?>
		<div id="footer-area" class="footer-bar-bg ">
	        <div class="footer-bar container">           
				<div class="row">
					<?php if ( is_active_sidebar( 'footerbar-1' )  ){ 
						dynamic_sidebar( 'footerbar-1' ); 
					} ?>
               	</div>
	        </div>
	    </div>
    <?php } ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<?php if(!empty($cookie_options['footer-logo']['url'])){  ?>
				<div class="footer-logo <?php echo esc_attr($cookie_options['footer-style']);?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><img src="<?php echo esc_url($cookie_options['footer-logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a></div>
			<?php }  ?>
			<div class="footer-content <?php echo esc_attr($cookie_options['footer-style']);?>">
				<?php if($cookie_options['footer-style'] == 'style-1' ){ ?>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-4 footer-text-container"><?php if( !empty($cookie_options['footer-text']) ){ echo $footer_text; }?></div>
						<div class="col-xs-12 col-sm-6 col-md-4 footer-social-container"><?php if( $cookie_options['social-media-footer'] == '1'){ echo $footer_social; }?></div>
						<div class="col-xs-12 col-sm-6 col-md-4 footer-menu-container"><?php if( $cookie_options['footer-nav'] == '1' ){ echo $footer_nav; } ?></div>
					</div>
				<?php }
				else{ ?>
					<?php if( $cookie_options['footer-nav'] == '1' ){ echo $footer_nav; } ?>
					<?php if( $cookie_options['social-media-footer'] == '1'){ echo $footer_social; }?>
					<?php if( !empty($cookie_options['footer-text']) ){ echo $footer_text; }?>
				<?php } ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if( $cookie_options['loader'] == '1' ){ 
	if( $cookie_options['loader-close'] == '1' ){
		$loader_close = 'false';
	}else{
		$loader_close = 'true';
	} 
	?>
	<section id="preloader-<?php echo esc_attr($cookie_options['loader-style']); ?>" class="preloader" data-preloader="<?php echo esc_attr($cookie_options['loader']); ?>" data-preloader-style="<?php echo esc_attr($cookie_options['loader-style']); ?>" <?php if( $cookie_options['loader-style'] == '1' ){ echo 'data-close-button="'.$loader_close.'" data-close-button-text="'.$cookie_options['loader-close-button-text'].'"'; } ?>>
		<?php if( $cookie_options['loader-style'] == '2' ){ ?>
			<div class="cssload-container">
				<ul class="cssload-flex-container">
					<li>
						<span class="cssload-loading"></span>
					</li>
				</div>
			</div>
		<?php  }
		else if( $cookie_options['loader-style'] == '3' ){ ?>
			<div class="cssload-square-container">
				<div class="cssload-square-content">
					<div class="cssload-square">
						<div class="cssload-square-part cssload-square-green"></div>
						<div class="cssload-square-part cssload-square-pink"></div>
						<div class="cssload-square-blend"></div>
					</div>
				</div>
			</div>
		<?php }
		else if( $cookie_options['loader-style'] == '4' ){ ?>
			<div class="cssload-square-container">
				<div class="cssload-wrapper">
					<div class="cssload-loader"></div>
				</div>
			</div>

		<?php } ?>
	</section>
<?php } 
}
agni_footer(); ?>


<?php wp_footer(); ?>

</body>
</html>
