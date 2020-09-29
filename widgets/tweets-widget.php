<?php
add_action('widgets_init', 'tweets_load_widgets');

function tweets_load_widgets()
{
	register_widget('Tweets_Widget');
}

class Tweets_Widget extends WP_Widget {
	
	function Tweets_Widget()
	{
		$widget_ops = array('classname' => 'tweets', 'description' => 'التطبيق المصغر لتويتر.');

		$control_ops = array('id_base' => 'tweets-widget');

		$this->WP_Widget('tweets-widget', 'أكتب.كوم : تويتر', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$twitter_id = $instance['twitter_id'];
		$number = $instance['number'];

		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		}
		
		if($twitter_id) { ?>
			<script type="text/javascript">
			jQuery(document).ready(function() {
					jQuery('.<?php echo $args['widget_id']; ?>').jtwt({image_size : 20, count : <?php echo $number; ?>, username: '<?php echo $twitter_id; ?>', convert_links : 1, loader_text : 'إدراج المزيد من التويتات...'});   
			});                      
			</script>
			<div id="tweets-sidebar" class="<?php echo $args['widget_id']; ?>"></div>
		<?php }
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'أكتب.كوم تويتر', 'twitter_id' => '', 'number' => 5);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">العنوان:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>">رقم الحساب الخاص أكتب.كوم:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">عدد التويتات التى سوف تظهر:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
		
	<?php
	}
}
?>