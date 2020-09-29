<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package egywebschool
 * @since egywebschool 1.0
 */

get_header(); ?>


</div><!-- close .width-container -->
<div id="highlight-container">
	<div class="width-container">
		<h1 class="page-title"><?php _e( 'خطأ !!', 'egywebschool' ); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">



<div class="content-container">
	<div class="container-spacing">	



	<p class="page-not-found"><?php _e( 'لم يتم العثور فى موقع أكتب.كوم على هذه الصفحة الرجاء التاكد من العنوان والمحاوله مجددا', 'egywebschool' ); ?></p>



	<div class="clearfix"></div>
	</div><!-- close .content-container-spacing -->
</div><!-- close .content-container -->


<?php get_footer(); ?>