<?php
if ( post_password_required() )
	return;
?>
<?php 	
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$args = array(
  'comment_notes_after' => ' ',	
  'comment_field' =>  '<div class="form-group"><textarea id="comment" class="form-control" placeholder="Escribe algo..." name="comment" cols="45" rows="8" aria-required="true">' .
  '</textarea></div>',		
  'fields' => apply_filters( 'comment_form_default_fields', array(
  	'author' =>
	      '<div class="form-group inputna firstinputna"><input id="author" name="author" placeholder="Nombre" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
	      '" size="30"' . $aria_req . ' /></div>',
  	'email' =>
	      '<div class="form-group inputna"><input id="email" name="email"  placeholder="E-Mail" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
	      '" size="30"' . $aria_req . ' /></div>',
	)
   ),
);
comment_form($args); ?>
<div id="comments" class="comments-area">
<?php if ( have_comments() ) : ?>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'masthemes' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'masthemes' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'masthemes' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php wp_list_comments( array( 'callback' => 'masthemes_comment' ) ); ?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'masthemes' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'masthemes' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'masthemes' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'masthemes' ); ?></p>
	<?php endif; ?>
	
	
	
	
</div>