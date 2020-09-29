<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package egywebschool
 * @since egywebschool 1.0
 */
?>
<div class="clearfix"></div>
</div><!-- close .width-container -->
</div><!-- close #main -->

<footer>
	
	<?php if(of_get_option('footer_widgets', '1')): ?>
	<div id="footer-widgets">
		<div class="width-container footer-<?php echo of_get_option('footer_widgets_column', '3'); ?>-column">
			<?php if ( ! dynamic_sidebar( 'قوائم الفوتر' ) ) : ?>
			<?php endif; // end sidebar widget area ?>
			<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #footer-widgets -->
	<?php endif; ?>

	<div class="width-container">

                        <p align="center">
                        <span class='copyright'>Designed by	<a href='http://www.TDesignEgypt.com'><img src='http://www.2kteb.com/Logo-TDesign.png' style="vertical-align: top; "/></a>| Sponsored by <a href='http://www.The-Alliance.Marketing'><img src='http://www.2kteb.com/the-alliance.png' style="vertical-align: middle; "/> </a> The Alliance Corporation | © All rights Reserved</span></p>
						

	
		</div><!-- close .social-icons -->

	<div class="clearfix"></div>
	</div><!-- close .width-container -->
</footer>
<?php wp_footer(); ?>

<?php if(of_get_option('custom_js')): ?>
	<?php echo '<script type="text/javascript">'; ?>
	<?php echo of_get_option('custom_js'); ?>
	<?php echo '</script>'; ?>
<?php endif; ?>
<?php if(of_get_option('tracking_code')): ?>
	<?php echo '<script type="text/javascript">'; ?>
	<?php echo of_get_option('tracking_code'); ?>
	<?php echo '</script>'; ?>
<?php endif; ?>

</body>
</html>