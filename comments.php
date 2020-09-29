<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to egywebschool_comment() which is
 * located in the functions.php file.
 *
 * @package egywebschool
 * @since egywebschool 1.0
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h5 class="comments-title">
			<?php
				printf( _n( 'تعليق واحد على &ldquo;%2$s&rdquo;', '%1$s تعليق على &ldquo;%2$s&rdquo;', get_comments_number(), 'egywebschool' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h5>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'تصفح التعليقات', 'egywebschool' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; التعليقات القديمة', 'egywebschool' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'التعليقات الجديدة &rarr;', 'egywebschool' ) ); ?></div>
		</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use egywebschool_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define egywebschool_comment() and that will be used instead.
				 * See egywebschool_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'egywebschool_comment' ) );
			?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'تصفح التعليقات', 'egywebschool' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; التعليقات القديمة', 'egywebschool' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'التعليقات الجديدة &rarr;', 'egywebschool' ) ); ?></div>
		</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'التعليقات مغلقة', 'egywebschool' ); ?></p>
	<?php endif; ?>


<div class="clearfix"></div>
	<?php comment_form(); ?>

<div class="clearfix"></div>
</div><!-- #comments .comments-area -->
