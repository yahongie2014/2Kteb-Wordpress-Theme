<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 *
 * @package egywebschool
 * @since egywebschool 1.0
 */
?>


</div><!-- close .width-container -->
<div id="highlight-container">
	<div class="width-container">
		<h1 class="page-title"><?php _e( 'لم يتم العثور على شئ', 'egywebschool' ); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">


<?php if(of_get_option('blog_sidebar', '1')): ?><div id="container-sidebar"><!-- sidebar content container --><?php endif; ?>
<?php if ( is_home() ) : ?>
	
	<p><?php printf( __( 'جاهز لنشر اول مقالة ؟ <a href="%1$s">ابدأ من هنا</a>.', 'egywebschool' ), admin_url( 'post-new.php' ) ); ?></p>


<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'آسف، لكن لم نعثر على ما تبحث عنه فى موقع أكتب.كوم. يرجى المحاولة مرة أخرى مع كلمات مختلفة.', 'egywebschool' ); ?></p>
		<?php get_search_form(); ?>

<?php else : ?>

	<p><?php _e( 'انه من المواضح ان&rsquo;t ايجاد ما&rsquo;re تبحث عنه. ربنا يمكننا نساعدك فى البحث.', 'egywebschool' ); ?></p>
	<?php get_search_form(); ?>

<?php endif; ?>

