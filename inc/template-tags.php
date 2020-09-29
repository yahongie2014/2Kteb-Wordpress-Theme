<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package egywebschool
 * @since egywebschool 1.0
 */


if ( ! function_exists( 'egywebschool_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since egywebschool 1.0
 */
function egywebschool_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'التنبيهات:', 'egywebschool' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(تعديل)', 'egywebschool' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta">
				<div class="comment-author vcard">
					
					<?php
						$avatar_size = 70;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 60;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s على %2$s <span class="says">يقول:</span>', 'egywebschool' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s فى %2$s', 'egywebschool' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
					<?php edit_comment_link( __( 'تعديل', 'egywebschool' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'هذا التعليق بانتظار الموافقة عليه من ادارة الموقع', 'egywebschool' ); ?></em>
					<br />
				<?php endif; ?>

			</div>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for egywebschool_comment()





if ( ! function_exists( 'egywebschool_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since egywebschool 1.0
 */
function egywebschool_posted_on() {
	printf( __( '<div class="post-date"><a href="%1$s"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a></div><div class="post-author"><a class="url fn n" href="%5$s" title="%6$s" rel="author">بواسطة %7$s</a></div>', 'egywebschool' ),
		esc_url( get_month_link(get_the_time('Y'), get_the_time('m')) ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'رؤية جميع مقالات %s', 'egywebschool' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;




/**
 * Returns true if a blog has more than 1 category
 *
 * @since egywebschool 1.0
 */
function egywebschool_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so egywebschool_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so egywebschool_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in egywebschool_categorized_blog
 *
 * @since egywebschool 1.0
 */
function egywebschool_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'egywebschool_category_transient_flusher' );
add_action( 'save_post', 'egywebschool_category_transient_flusher' );