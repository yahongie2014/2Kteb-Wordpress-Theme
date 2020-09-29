<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package egywebschool
 * @since egywebschool 1.0
 */

get_header(); ?>


<?php if ( have_posts() ) : ?>
</div><!-- close .width-container -->
<div id="highlight-container">
	<div class="width-container">
		<h1 class="page-title"><?php printf( __( 'نتائج البحث عن: %s', 'egywebschool' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">
	
	

<?php if(of_get_option('blog_sidebar', '1')): ?><div id="container-sidebar"><!-- sidebar content container --><?php endif; ?>
		
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="content-container">

					<?php if(get_post_meta($post->ID, 'videoembed_textarea', true)): ?>
						<?php echo get_post_meta($post->ID, 'videoembed_textarea', true) ?>
					<?php else: ?>
						<?php if(has_post_thumbnail()): ?>
						<a href="<?php the_permalink(); ?>" class="hover-icon">
							<div class="zoom-icon article-icon">zoom</div>
							<?php the_post_thumbnail('egywebschool-blog'); ?>
						</a>
						<?php endif; ?>
					<?php endif; ?>

					<div class="container-spacing">

						<div class="blog-post-details">
							<?php egywebschool_posted_on(); ?>
							<div class="post-comments"><?php comments_popup_link( '<span class="leave-reply">' . __( 'لا يوجد تعليقات', 'egywebschool' ) . '</span>', _x( 'تعليق واحد', 'رقم التعليق', 'egywebschool' ), _x( '% تعليق', 'رقم التعليق', 'egywebschool' ) ); ?></div>	
						</div><!-- close .blog-post-details -->

						<div class="blog-post-excerpt">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php the_content( __( '<p>اكمل القرأه <span class="meta-nav">&rarr;</span></p>', 'egywebschool' ) ); ?>
						</div><!-- close .blog-post-excerpt -->

					<div class="clearfix"></div>
					</div><!-- close .content-container-spacing -->
					
					<?php the_tags('<div class="tag-cloud"><div class="tag-icon"> ', ', ', '</div></div>'); ?>

				</div><!-- close .content-container -->
			</div><!-- #post-<?php the_ID(); ?> -->
			
		<?php endwhile; ?>
		
		
		<div class="clearfix"></div>
		<?php kriesi_pagination($pages = '', $range = 2); ?>
		<!--div><?php posts_nav_link(); // default tag ?></div-->

		<?php else : ?>	
			<?php get_template_part( 'no-results', 'search' ); ?>
		<?php endif; ?>
			
<div class="clearfix"></div>
<?php if(of_get_option('blog_sidebar', '1')): ?></div><!-- close #container-sidebar -->
<?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>