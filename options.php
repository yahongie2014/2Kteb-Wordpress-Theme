<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$animations = array(
		'fade' => __('تلاشى', 'egywebschool'),
		'slide' => __('الشرائح', 'egywebschool')
	);
	

	
	$animation_true = array(
		'true' => __('تشغيل', 'egywebschool'),
		'false' => __('إيقاف تشغيل', 'egywebschool')
	);
	

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('مصطفى', 'egywebschool'),
		'two' => __('عبداللطيف', 'egywebschool'),
		'three' => __('احمد جاد', 'egywebschool'),
		'four' => __('ريهام', 'egywebschool'),
		'five' => __('ابراهيم', 'egywebschool')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('2kteb.com', 'egywebschool'),
		'type' => 'heading');
		
	
	$options[] = array(
		'name' => __('الحقوق', 'egywebschool'),
		'desc' => __('حقوق الملكية ', 'egywebschool'),
		'id' => 'copyright_textarea',
		'std' => '&copy; 2015 All Rights Reserved. Developed by <a href="http://tdesgin.cc" target="_blank">Tdesign</a>.',
		'type' => 'textarea');
	
	
	
	$options[] = array(
		'name' => __('القائمة الثابتة', 'egywebschool'),
		'desc' => __('حدد الخانة هذه لتمكين القائمة الثابتة. هذا سوف تبقي القائمة الثابتة إلى أعلى المتصفح.', 'egywebschool'),
		'id' => 'sticky_navigation',
		'std' => '0',
		'type' => 'checkbox');

	
	$options[] = array(
		'name' => __('عرض فوتر التطبيقات المصغرة', 'egywebschool'),
		'desc' => __('حدد هذه الخانه لتمكن التطبيقات المصغره فى الفوتر', 'egywebschool'),
		'id' => 'footer_widgets',
		'std' => '1',
		'type' => 'checkbox');	
	
	
	$options[] = array(
		'name' => __('أعمدة الفوتر', 'egywebschool'),
		'desc' => __('قم باختيار عدد الأعمدة فى الفوتر', 'egywebschool'),
		'id' => 'footer_widgets_column',
		'std' => '3',
		'class' => 'mini',
		'type' => 'text');
	
	
	
	$options[] = array(
		'name' => __('عرض الشريط الجانبي على المقالات، الأرشيف، والبحث', 'egywebschool'),
		'desc' => __('قم بتحديد هذه الخانة لكى تتمكن من اظهار شريط العرض الجانبى فى الموقع', 'egywebschool'),
		'id' => 'blog_sidebar',
		'std' => '1',
		'type' => 'checkbox');
	
	
	

	
	
	$options[] = array(
		'name' => __('عرض الشريط الجانبي على صفحات المقالات', 'egywebschool'),
		'desc' => __('قم باختيار هذه الخانة لكى تتمكن من تفعيل الشريط الجانبى فى صفحة المقالات', 'egywebschool'),
		'id' => 'blog_sidebar_single',
		'std' => '1',
		'type' => 'checkbox');	
	
	
	$options[] = array(
		'name' => __('عرض التعليقات فى الصفحات', 'egywebschool'),
		'desc' => __('قم باختيار هذه الخانة لكى تتمكن من اظهار التعليقات فى الصفحات', 'egywebschool'),
		'id' => 'page_comments_default',
		'std' => '0',
		'type' => 'checkbox');
	
	
	
	
	
	
	
	$options[] = array(
		'name' => __('Media', 'egywebschool'),
		'type' => 'heading');
	
	
	$options[] = array(
		'name' => __('مشاركة مقالات الوسائط لكل صفحة', 'egywebschool'),
		'desc' => __('اختار كم عدد المشاركات التى تبغى انت تضعها فى الصفحة', 'egywebschool'),
		'id' => 'portfolio_page_posts',
		'std' => '6',
		'class' => 'mini',
		'type' => 'text');
	
	
	
	$options[] = array(
		'name' => __('اختار لكى تتمكن من إيقاف التمرير التلقائى', 'egywebschool'),
		'desc' => __('حدد هذه الخانه لكى تقوم باختار لكى تتمكن من إيقاف التمرير التلقائى', 'egywebschool'),
		'id' => 'portfolio_infinite_scroll',
		'std' => '1',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => __('تشغيل التقسيم العادى لمقالات الوسائط', 'egywebschool'),
		'desc' => __('قم بتحدد هذه الخانه لكى يمكنك تشغيل التقسيم العادى لمقالات الوسائط', 'egywebschool'),
		'id' => 'portfolio_normal_pagination',
		'std' => '0',
		'type' => 'checkbox');	
	
	
	
	$options[] = array(
		'name' => __('عرض الشريط الجانبي على صفحات مقالات الوسائط', 'egywebschool'),
		'desc' => __('قم بتحديد هذه الخانه لكى يمكنك عرض الشريط الجانبي على صفحات مقالات الوسائط', 'egywebschool'),
		'id' => 'portfolio_sidebar_single',
		'std' => '0',
		'type' => 'checkbox');
		
	
	$options[] = array(
		'name' => __('قم بقص الصور فى مقالات الوسائط', 'egywebschool'),
		'desc' => __('قم بتحديد هذه الخانه لكى يمكنك قص الصور فى مقالات الوسائط', 'egywebschool'),
		'id' => 'portfolio_single_uncrop',
		'std' => '1',
		'type' => 'checkbox');
		
		
	$options[] = array(
		'name' => __('اظهار التعليقات فى صفحات مقالات الوسائط', 'egywebschool'),
		'desc' => __('قم باختيار هذه الخانه لكى تتمكن من اظهار التعليقات فى صفحات مقالات الواسائط', 'egywebschool'),
		'id' => 'portfolio_comments_default',
		'std' => '0',
		'type' => 'checkbox');	
	
	$options[] = array(
		'name' => __('Home Page', 'egywebschool'),
		'type' => 'heading');
	
	
	$options[] = array(
		'name' => __('مشاركات المقالات فى الصفحة الرئيسية', 'egywebschool'),
		'desc' => __('قم باختيار عدد المشاركات فى الصفحة الرئيسية', 'egywebschool'),
		'id' => 'homepage_page_posts',
		'std' => '6',
		'class' => 'mini',
		'type' => 'text');
	
	
	
	$options[] = array(
		'name' => __('عدد اعمدة المقالات فى الصفحة الرئيسية', 'egywebschool'),
		'desc' => __('قم باختيار عدد اعمدة المقالات فى الصفحة الرئيسية', 'egywebschool'),
		'id' => 'blog_columns_count',
		'std' => '3',
		'class' => 'mini',
		'type' => 'text');	
	
	
	$options[] = array(
		'name' => __('عرض المشاركات فى الصفحة الرئيسية', 'egywebschool'),
		'desc' => __('قم بتحديد هذه الخانه لكى تتمكن من اظهار المشاركات فى الصفحة الرئيسية', 'egywebschool'),
		'id' => 'homepage_display_boxes',
		'std' => '1',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => __('اختار لكى تتمكن من إيقاف التمرير التلقائى', 'egywebschool'),
		'desc' => __('حدد هذه الخانه لكى تقوم باختار لكى تتمكن من إيقاف التمرير التلقائى', 'egywebschool'),
		'id' => 'homepage_infinite_scroll',
		'std' => '1',
		'type' => 'checkbox');
		
	
	
	$options[] = array(
		'name' => __('تشغيل التقسيم العادى للصفحة الرئيسية', 'egywebschool'),
		'desc' => __('قم بتحديدها لكى تتمكن من تشغيل التقسيم العادى للصفحة الرئيسية', 'egywebschool'),
		'id' => 'homepage_normal_pagination',
		'std' => '0',
		'type' => 'checkbox');
	
	
	
	$options[] = array(
		'name' => __('عرض الشريط الجانبى فى الصفحة الرئيسية', 'egywebschool'),
		'desc' => __('قم بتحديد هذه الخانه لعرض الشريط الجانبى فى الصفحة الرئيسية', 'egywebschool'),
		'id' => 'homepage_sidebar',
		'std' => '0',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => __('عرض عنوان المقالة تحت السلايدر', 'egywebschool'),
		'desc' => __('قم باختيار هذه الخانه لكى يمكنك عرض عنوان المقالة تحت السلايدر.', 'egywebschool'),
		'id' => 'featured_text_checkbox',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('عنوان التعريف بشركة أكتب.كوم', 'egywebschool'),
		'desc' => __('قم باختيار عنوان لكى تضعة فى العناوين البارزه فى الصفحة الرئيسية', 'egywebschool'),
		'id' => 'featured_text_headline',
		'std' => 'عن شركة أكتب.كوم',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('وصف شركة أكتب.كوم', 'egywebschool'),
		'desc' => __('قم باختيار وصف لشركة أكتب.كوم', 'egywebschool'),
		'id' => 'featured_text_content',
		'std' => 'وصف شركة أكتب.كوم',
		'type' => 'textarea');
		
	
	$options[] = array(
		'name' => __('الصور المميزة فى الصفحة الرئيسية', 'egywebschool'),
		'desc' => __('قم برفع الصورة البارزه لاظهارها فى الصفحة الرئيسية', 'egywebschool'),
		'id' => 'featured_text_image',
		"std" => get_template_directory_uri() . "/images/bibasata/profile-pic.png",
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('عرض الصوره البارزه فى الصفحة الرئيسية', 'egywebschool'),
		'desc' => __('عرض الصوره', 'egywebschool'),
		'id' => 'featured_text_image_width',
		'std' => '95',
		'class' => 'mini',
		'type' => 'text');	
	
	
	$options[] = array(
		'name' => __('طول الصورة البارزه فى الصفحة الرئيسية', 'egywebschool'),
		'desc' => __('طول الصورة', 'egywebschool'),
		'id' => 'featured_text_image_height',
		'std' => '106',
		'class' => 'mini',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Social Icons', 'egywebschool'),
		'type' => 'heading');
		
	
	$options[] = array(
		'name' => __('الترويسة / الفوتر', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر فقط فى التروسية والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'type' => 'info');
	
	$options[] = array(
		'name' => __('RSS', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر تلقائيا فى الترويسة والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'rss_link',
		'std' => '',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Facebook', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر تلقائيا فى الترويسة والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'facebook_link',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Twitter', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر تلقائيا فى الترويسة والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'twitter_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Skype', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر تلقائيا فى الترويسة والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'skype_link',
		'std' => '',
		'type' => 'text');
		
		
	$options[] = array(
		'name' => __('Vimeo', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر تلقائيا فى الترويسة والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'vimeo_link',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('LinkedIn', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر تلقائيا فى الترويسة والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'linkedin_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Dribbble', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر تلقائيا فى الترويسة والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'dribbble_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Forrst', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر تلقائيا فى الترويسة والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'forrst_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Flickr', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر تلقائيا فى الترويسة والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'flickr_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Google', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر تلقائيا فى الترويسة والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'google_link',
		'std' => '',
		'type' => 'text');	

	
	$options[] = array(
		'name' => __('Youtube', 'egywebschool'),
		'desc' => __('هذه الايقونات سوف تظهر تلقائيا فى الترويسة والفوتر لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'youtube_link',
		'std' => '',
		'type' => 'text');	
	
	
	
	$options[] = array(
		'name' => __('الايقونات الاجتماعية فى التطبيقات المصغرة', 'egywebschool'),
		'desc' => __('هذه الايقوانات سوف تظهر فى التطبيقات المصغره فقط', 'egywebschool'),
		'type' => 'info');
		
	
	$options[] = array(
		'name' => __('RSS', 'egywebschool'),
		'desc' => __('هذه الايقوانات الاجتماعية سوف تظهر فقط فى التطبيقات المصغره', 'egywebschool'),
		'id' => 'rss_link_widget',
		'std' => '',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Facebook', 'egywebschool'),
		'desc' => __('هذه الايقوانات الاجتماعية سوف تظهر فقط فى التطبيقات المصغره', 'egywebschool'),
		'id' => 'facebook_link_widget',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Twitter', 'egywebschool'),
		'desc' => __('هذه الايقوانات الاجتماعية سوف تظهر فقط فى التطبيقات المصغره', 'egywebschool'),
		'id' => 'twitter_link_widget',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Skype', 'egywebschool'),
		'desc' => __('هذه الايقوانات الاجتماعية سوف تظهر فقط فى التطبيقات المصغره', 'egywebschool'),
		'id' => 'skype_link_widget',
		'std' => '',
		'type' => 'text');
		
		
	$options[] = array(
		'name' => __('Vimeo', 'egywebschool'),
		'desc' => __('هذه الايقوانات الاجتماعية سوف تظهر فقط فى التطبيقات المصغره', 'egywebschool'),
		'id' => 'vimeo_link_widget',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('LinkedIn', 'egywebschool'),
		'desc' => __('هذه الايقوانات الاجتماعية سوف تظهر فقط فى التطبيقات المصغره', 'egywebschool'),
		'id' => 'linkedin_link_widget',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Dribbble', 'egywebschool'),
		'desc' => __('هذه الايقوانات الاجتماعية سوف تظهر فقط فى التطبيقات المصغره', 'egywebschool'),
		'id' => 'dribbble_link_widget',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Forrst', 'egywebschool'),
		'desc' => __('هذه الايقوانات الاجتماعية سوف تظهر فقط فى التطبيقات المصغره', 'egywebschool'),
		'id' => 'forrst_link_widget',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Flickr', 'egywebschool'),
		'desc' => __('هذه الايقوانات الاجتماعية سوف تظهر فقط فى التطبيقات المصغره', 'egywebschool'),
		'id' => 'flickr_link_widget',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Google', 'egywebschool'),
		'desc' => __('هذه الايقوانات الاجتماعية سوف تظهر فقط فى التطبيقات المصغره', 'egywebschool'),
		'id' => 'google_link_widget',
		'std' => '',
		'type' => 'text');	

	
	$options[] = array(
		'name' => __('Youtube', 'egywebschool'),
		'desc' => __('هذه الايقوانات الاجتماعية سوف تظهر فقط فى التطبيقات المصغره', 'egywebschool'),
		'id' => 'youtube_link_widget',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Appearance', 'egywebschool'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('شعار أكتب.كوم', 'egywebschool'),
		'desc' => __('قم برفع شعار أكتب.كوم لكى يتم ادراجة فى الصفحة الرئيسية', 'egywebschool'),
		'id' => 'logo',
		"std" => get_template_directory_uri() . "/images/logo.png",
		'type' => 'upload');
	
	
	$options[] = array(
		'name' => __('عرض الشعار', 'egywebschool'),
		'desc' => __('قم باختيار عرض الشعار الذى تريده', 'egywebschool'),
		'id' => 'logo_width',
		'std' => '164',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('ايقونه المتصفح', 'egywebschool'),
		'desc' => __('قم برفع ايقونة المتصفح', 'egywebschool'),
		'id' => 'favicon',
		'type' => 'upload');
	
	
	$options[] = array(
		'name' => __('ارتفاع القائمة', 'egywebschool'),
		'desc' => __('قم باختيار ارتفاع القائمة', 'egywebschool'),
		'id' => 'navigation_height',
		'std' => '96',
		'class' => 'mini',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('خط موقع أكتب.كوم', 'egywebschool'),
		'desc' => __('قم باختيار الخط لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'main_font',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	
	$options[] = array(
		'name' => __('الخط الرئيسى لموقع أكتب.كوم', 'egywebschool'),
		'desc' => __('قم باختيار الخط الرئيسى لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'navigation_font',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('الخط الفرعى لموقع أكتب.كوم', 'egywebschool'),
		'desc' => __('قم باختيار الخط الفرعى لموقع أكتب.كوم', 'egywebschool'),
		'id' => 'secondary_font',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('خط العنواين المميزة', 'egywebschool'),
		'desc' => __('اختيار خطوط العنواين المميزة', 'egywebschool'),
		'id' => 'caption_font',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Tools', 'egywebschool'),
		'type' => 'heading');
	
	
	$options[] = array(
		'name' => __('عنوان الصفحة الرئيسية', 'egywebschool'),
		'desc' => __('قم باختيار عنوان الصفحة الرئيسية', 'egywebschool'),
		'id' => 'home_title',
		'std' => '',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('وصف الصفحة الرئيسية', 'egywebschool'),
		'desc' => __('قم بادخال وصف موقع أكتب.كوم .. 140 كلمة فقط', 'egywebschool'),
		'id' => 'home_meta',
		'std' => '',
		'type' => 'text');
		

		
	
	$options[] = array(
		'name' => __('تعقب رمز', 'egywebschool'),
		'desc' => __('قم بلصق الرمز التعقبى من جوجل انلايز', 'egywebschool'),
		'id' => 'tracking_code',
		'std' => '',
		'type' => 'textarea');
		
	
	$options[] = array(
		'name' => __('كود اضافى CSS', 'egywebschool'),
		'desc' => __('قم بلصق كود اضافى لcss', 'egywebschool'),
		'id' => 'custom_css',
		'std' => '',
		'type' => 'textarea');
	
	
	$options[] = array(
		'name' => __('كود اضافى Javascript', 'egywebschool'),
		'desc' => __('قم بلصق كود اضافى لJavaScript', 'egywebschool'),
		'id' => 'custom_js',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => __('Slider', 'egywebschool'),
		'type' => 'heading');
	
	
	
	$options[] = array(
		'name' => __('عرض حجم الصور فى السلايدر', 'egywebschool'),
		'desc' => __('حدد خانة الاختيار هذه لتمكين الشبكية الصور المنزلق الحجم. هذا يعني أنه سيتم تغيير حجم الصور إلى 2000px واسع من قبل 800px طويل القامة (متصفحك سوف ثم حجمه لتناسب في الإطار). إذا كنت إلغاء تحديد هذا المربع، سيتم تغيير حجم الصور المنزلق المميز ل1500px واسع من قبل 600px لطويل القامة.', 'egywebschool'),
		'id' => 'retina_slider_images',
		'std' => '1',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => __('تاثير السلايدر', 'egywebschool'),
		'desc' => __('قم باختيار التاثير للسلايدر', 'egywebschool'),
		'id' => 'slider_animation',
		'std' => 'تلاشى',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animations);
		

	$options[] = array(
		'name' => __('التشغيل التلقائى للسلايدر', 'egywebschool'),
		'desc' => __('التشغيل التلقائى للسلايدر', 'egywebschool'),
		'id' => 'slider_autoplay_play',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
	
	
	$options[] = array(
		'name' => __('سرعه التشغيل فى السلايدر', 'egywebschool'),
		'desc' => __('قم باختيار سرعه التشغيل فى هذه السلايدر', 'egywebschool'),
		'id' => 'slider_autoplay',
		'std' => '6500',
		'class' => 'mini',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('ايقونه السابق/التالى فى السلايدر', 'egywebschool'),
		'desc' => __('قم باختيار اذا كنت تريد تشفيل هذه الايقونات ام لا ', 'egywebschool'),
		'id' => 'slider_navigation',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
		

	
	$options[] = array(
		'name' => __('الايقونة للصوره البارزة', 'egywebschool'),
		'desc' => __('اختيار عرض الايقونة للصورة البارزه ام لا ', 'egywebschool'),
		'id' => 'slider_bullets',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
	
	
	
	$options[] = array(
		'name' => __('مقالات الوسائط للسلايدر', 'egywebschool'),
		'desc' => __('قم باختيار الاعدادات للسلايدر فى مقالات الوسائط', 'egywebschool'),
		'type' => 'info');	
	
	
	$options[] = array(
		'name' => __('تاثير السلايدر فى مقالات الوسائط', 'egywebschool'),
		'desc' => __('قم باختيار التاثير للسلايدر فى مقالات الوسائط المحتركة', 'egywebschool'),
		'id' => 'slider_animation_portfolio',
		'std' => 'تلاشى',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animations);
		

	$options[] = array(
		'name' => __('تشغيل تلقائى لمقالات الوسائط', 'egywebschool'),
		'desc' => __('قم باختيار ما اذا كنت تريد التشغيل التلقائى لمقالات الوسائط ام لا', 'egywebschool'),
		'id' => 'slider_autoplay_play_portfolio',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
	
	
	$options[] = array(
		'name' => __('سرعة تشغيل مقالات الوسائط', 'egywebschool'),
		'desc' => __('اختار سرعه تشغيل مقالات الوسائط فى السلايدر', 'egywebschool'),
		'id' => 'slider_autoplay_portfolio',
		'std' => '6500',
		'class' => 'mini',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('ايقونة السابق/التالى فى مقالات الوسائط', 'egywebschool'),
		'desc' => __('قم باختيار ما اذا كنت تريد ان تظهر ايقونات السابق/التالى فى مقالات الوسائط', 'egywebschool'),
		'id' => 'slider_navigation_portfolio',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
		

	
	$options[] = array(
		'name' => __('الايقونة للصوره البارزة', 'egywebschool'),
		'desc' => __('اختيار عرض الايقونة للصورة البارزه ام لا  ', 'egywebschool'),
		'id' => 'slider_bullets_portfolio',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
		
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>



<?php
}