<?php

$prefix = 'pageoptions_';

$fields = array(
	array( // Taxonomy Select box
		'label'	=> 'تصنيفات مقالات الوسائط', // <label>
		'desc'  => 'قم باختيار تصنيف المقالة التى سوف تظهر فى الصفحة الرئيسية',// the description is created in the callback function with a link to Manage the taxonomy terms
		'id'	=> 'portfolio_type', // field id and name, needs to be the exact name of the taxonomy
		'type'	=> 'tax_select' // type of field
	),
	array( // Taxonomy Select box
			'label'	=> 'تصنيف المقالات فى الصفحة الرئيسية', // <label>
			'desc'  => 'قم باختيار تصنيف المقالات التى تريد ان تنشرها فى الصفحة الرئيسية فقط',// the description is created in the callback function with a link to Manage the taxonomy terms
			'id'	=> 'category', // field id and name, needs to be the exact name of the taxonomy
			'type'	=> 'tax_select' // type of field
	),
	
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$pageoptions_box = new custom_add_meta_box( 'pageoptions_box', 'تعديل الصفحات', $fields, 'page', false );



$prefix = 'contactpage_';

$fields = array(
	array( // Text Input
		'label'	=> 'عنوان الخريطة لصفحة الاتصال', // <label>
		'desc'	=> 'قم باضاقة عنوان لسهولة الوصول الى شركة أكتب.كوم فى صفحة الاتصال بنا', // description
		'id'	=> $prefix.'textarea', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array( // Text Input
		'label'	=> 'البريد الإليكترونى لصفحة الاتصال', // <label>
		'desc'	=> 'قم باضافة عنوان بريد اليكترونى لصفحة الاتصال بنا', // description
		'id'	=> $prefix.'text', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$contactpage_box = new custom_add_meta_box( 'contactpage_box', 'إعداد صفحة الاتصال بنا', $fields, 'page', false );




$prefix = 'videoembed_';

$fields = array(
	array( // Text Input
		'label'	=> 'تضمين فديو', // <label>
		'desc'	=> 'قم بوضع التضمين للفديو المطلوب وسوف يتم استبدال الصوره البارزه', // description
		'id'	=> $prefix.'textarea', // field id and name
		'type'	=> 'textarea' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$videoembed_box = new custom_add_meta_box( 'videoembed_box', 'مشاركة الفديو', $fields, 'post', false );




$prefix = 'portfoliooptions_';

$fields = array(
	array( // Text Input
		'label'	=> 'العنوان الفرعى لمقالات الوسائط', // <label>
		'desc'	=> 'قم باضافة عنوان فرعى لمقالات الوسائط لكى يتم ادراجها تحت الصوره', // description
		'id'	=> $prefix.'subheadline', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'تضمين فديو', // <label>
		'desc'	=> 'قم بوضع التضمين للفديو المطلوب وسوف يتم استبدال الصوره البارزه', // description
		'id'	=> $prefix.'textarea', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array( // Text Input
		'label'	=> 'رابط اطار الفديو', // <label>
		'desc'	=> 'قم بلصق رابط لاطار الفديو التى سوف تقوم بفتحها', // description
		'id'	=> $prefix.'text', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'رابط خارجى', // <label>
		'desc'	=> 'الرجاء اضافة رابط خارجى فى هذا المجال', // description
		'id'	=> $prefix.'text_link', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'تضمين كود التويتر', // <label>
		'desc'	=> 'قم بتضمين مادة كود التويتر الى مقالة فى الصفحة الرئيسية', // description
		'id'	=> $prefix.'twitter_text', // field id and name
		'type'	=> 'textarea' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$portfoliooptions_box = new custom_add_meta_box( 'portfoliooptions_box', 'إعداد مقالة الوسائط', $fields, 'portfolio', false );


$prefix = 'slideroptions_';

$fields = array(
	array( // Text Input
		'label'	=> 'عرض هذه المقالة فى السلايدر', // <label>
		'desc'	=> 'قم بكتابة "true" لكى نقوم باضافة هذه المقالة فى السلايدر', // description
		'id'	=> $prefix.'slider_caption', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$portfoliooptions_box = new custom_add_meta_box( 'slideroptions_box', 'إعداد السلايدر', $fields, 'portfolio', false );




