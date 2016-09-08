<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'cookie' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h4>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size'	=> 60,
					'max_depth'		=> 5,
					'style'			=> 'ul',
					'short_ping'	=> true,
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'cookie' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'cookie' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'cookie' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'cookie' ); ?></p>
	<?php endif; ?>

	<?php 
		global $required_text;
		comment_form($args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'title_reply'       => esc_html__( 'Leave a Reply','cookie' ),
			'title_reply_to'    => esc_html__( 'Leave a Reply to %s','cookie' ),
			'cancel_reply_link' => esc_html__( 'Cancel Reply','cookie' ),
			'label_submit'      => esc_html__( 'Submit' ,'cookie' ),
		
	  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'cookie' ), array( 'a' => array( 'href' => array() ) ) ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',
	  
	  'comment_notes_before' => '<p class="comment-notes">' .
		esc_html__( 'Your email address will not be published. Required fields are marked *','cookie' ) .
		'</p>',
	
	  'comment_notes_after' => '' , 
	  'fields' => apply_filters( 'comment_form_default_fields', array(
	
		'author' =>
		  		'<div class="comment-field">
					<div class="comment-form-author form-group">
						<input class="form-control" id="author" name="author" type="text" placeholder="'.esc_html__( 'Name *', 'cookie').'" />
					</div>
				',
	
		'email' =>
				'
					<div class="comment-form-email form-group">
						<input class="form-control" id="email" name="email" type="text" placeholder="'.esc_html__( 'Email *', 'cookie').'" />
					</div>
				',

		'url' =>
				'
					<div class="comment-form-url form-group">
						<input class="form-control" id="url" name="url" type="text" placeholder="'.esc_html__( 'Website', 'cookie').'"/>
					</div>
				</div>',
		)
	  ),
	  'comment_field' => 
		  	'
				<div class="form-group comment-form-comment comment-field">
					<textarea rows="8"  name="comment" class="form-control" placeholder="'.esc_html__( 'Message *', 'cookie').'" id="message" aria-required="true"></textarea>
				</div>
			'
	),''); ?>
	
</div><!-- #comments -->
