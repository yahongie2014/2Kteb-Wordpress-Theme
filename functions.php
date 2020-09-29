<?php
/**
 * egywebschool functions and definitions
 *
 * @package egywebschool
 * @since egywebschool 1.0
 */


// Post Thumbnails
add_theme_support('post-thumbnails');
add_image_size('egywebschool-slider-retina', 2000, 800, true);
add_image_size('egywebschool-slider', 1500, 600, true);
add_image_size('egywebschool-blog', 1140, 435, true);
add_image_size('egywebschool-portfolio-thumb', 600, 1200, false); //600 wide by 1200 tall Image isn't Cropping due to false setting
add_image_size('egywebschool-single', 1140, 550, true);
add_image_size('egywebschool-single-uncropped', 1140, 1000, false);


/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since egywebschool 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */


/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}


if ( ! function_exists( 'egywebschool_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since egywebschool 1.0
 */
function egywebschool_setup() {
	
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Custom template tags for this theme.  Blog Comments Found Here
	 */
	require( get_template_directory() . '/inc/template-tags.php' );


	/**
	 * Registering Custom Meta Boxes 
	 * https://github.com/tammyhart/Reusable-Custom-WordPress-Meta-Boxes
	 * Include the file that creates the class and a file that instantiates the class
	 */
	require( get_template_directory() . '/metaboxes/meta_box.php' );
	require( get_template_directory() . '/inc/custom_meta_boxes.php' );
	
	
	// Include widgets
	require( get_template_directory() . '/widgets/widgets.php' );
	
	
	// Shortcodes
	include_once('shortcodes.php');
	

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on egywebschool, use a find and replace
	 * to change 'egywebschool' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'egywebschool', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );



	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'القائمة الاولى', 'egywebschool' ),
	) );
	


}
endif; // egywebschool_setup
add_action( 'after_setup_theme', 'egywebschool_setup' );





/**
 * Recommended Plugins require( get_template_directory() . '/inc/recommended-plugins.php' );
 */





/**
 * Registering Custom Post Type
 */
add_action('init', 'pyre_init');
function pyre_init() {
	register_post_type(
		'portfolio',
		array(
			'labels' => array(
				'name' => 'مقالات السلايدر',
				'singular_name' => 'مقالات السلايدر'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => '2kteb'),
			'supports' => array('title', 'editor', 'thumbnail','comments'),
			'can_export' => true,
		)
	);

	register_taxonomy('portfolio_type', 'portfolio', array('hierarchical' => true, 'label' => 'التصنيفات', 'query_var' => true, 'rewrite' => true));
}




/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since egywebschool 1.0
 */
function egywebschool_widgets_init() {
	register_sidebar( array(
		'name' => __( 'القوائم الجانبية', 'egywebschool' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="sidebar-spacer"></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'قوائم الفوتر', 'egywebschool' ),
		'id' => 'footer-widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title"style="margin-right: 132px;">',
		'after_title' => '</h5>',
	) );
	
}
add_action( 'widgets_init', 'egywebschool_widgets_init' );




// Pagination
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span class='arrows'>&laquo;</span></a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><span class='arrows'>&lsaquo;</span></a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<a href='#' class='selected'>".$i."</a>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'><span class='arrows'>&rsaquo;</span></a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'><span class='arrows'>&raquo;</span></a>";
         echo "</div>\n";
     }
}





// Pagination
function infinite_kriesi_pagination($pages = '', $range = 1)
{  
     $showitems = ($range);  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }

     }   

     if(1 != $pages)
     {
         echo "";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "";

         if($paged > 1 && $showitems < $pages) echo "";


         for ($i=1; $i <= $pages; $i++)
         {
	
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range+1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "":"<nav id='page-nav'><a href='".get_pagenum_link($i)."'>".__('ادراج المزيد', 'egywebschool')."</a></nav>";
             }
			
         }
        
         echo "\n";
     }

	
}








/**
 * Enqueue scripts and styles
 */
function egywebschool_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array( 'style' ) );
	wp_enqueue_style( 'shortcodes', get_template_directory_uri() . '/css/shortcodes.css', array( 'style' ) );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.0.6.min.js', false, '20120206', false );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20120206', false );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206', false );
	wp_enqueue_script( 'shortcodes', get_template_directory_uri() . '/js/egywebschool-shortcodes-lib.js', array( 'jquery' ), '20120206', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_page_template('page-contact.php' && 'page-contact-full.php')  ) {
		wp_enqueue_script( 'google-maps', 'http://maps.google.com/maps/api/js?sensor=true', false, '20120206', false );
		wp_enqueue_script( 'go-mapsapi', get_template_directory_uri() . '/js/jquery.gomap-1.3.2.min.js', array( 'google-maps' ), '20120206', false );
	}
}
add_action( 'wp_enqueue_scripts', 'egywebschool_scripts' );



function bbsata_customize_register($wp_customize)
{
	
	$wp_customize->add_section( 'bbsata_text_scheme' , array(
	    'title'      => __('لون الخطوط','egywebschool'),
	    'priority'   => 35,
	) );
	
	$wp_customize->add_setting('body_text', array(
	    'default'     => '#777777'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_text', array(
		'label'        => __( 'لون جسم الموقع', 'egywebschool' ),
		'section'    => 'bbsata_text_scheme',
		'settings'   => 'body_text',
		'priority'   => 10,
	)));
	
	
	$wp_customize->add_setting('navigation_text', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_text', array(
		'label'        => __( 'لون خط القائمة', 'egywebschool' ),
		'section'    => 'bbsata_text_scheme',
		'settings'   => 'navigation_text',
		'priority'   => 20,
	)));
	
	
	$wp_customize->add_setting('page_title_text', array(
	    'default'     => '#2f2f2f'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_text', array(
		'label'        => __( 'لون عنوان الصفحة', 'egywebschool' ),
		'section'    => 'bbsata_text_scheme',
		'settings'   => 'page_title_text',
		'priority'   => 30,
	)));
	
	
	$wp_customize->add_setting('link_color', array(
	    'default'     => '#f46553'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
		'label'        => __( 'لون الروابط', 'egywebschool' ),
		'section'    => 'bbsata_text_scheme',
		'settings'   => 'link_color',
		'priority'   => 40,
	)));
	
	
	$wp_customize->add_setting('link_hover_color', array(
	    'default'     => '#484f61'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
		'label'        => __( 'لون الرابط الافتراضى', 'egywebschool' ),
		'section'    => 'bbsata_text_scheme',
		'settings'   => 'link_hover_color',
		'priority'   => 50,
	)));
	
	
	
	$wp_customize->add_setting('headings_default_color', array(
	    'default'     => '#2f2f2f'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'headings_default_color', array(
		'label'        => __( 'لون خط العنواين', 'egywebschool' ),
		'section'    => 'bbsata_text_scheme',
		'settings'   => 'headings_default_color',
		'priority'   => 60,
	)));
	
	
	$wp_customize->add_setting('sidebar_headings_default', array(
	    'default'     => '#444444'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sidebar_headings_default', array(
		'label'        => __( 'لون القوائم الجانبية', 'egywebschool' ),
		'section'    => 'bbsata_text_scheme',
		'settings'   => 'sidebar_headings_default',
		'priority'   => 70,
	)));
	
	
	$wp_customize->add_setting('footer_text_color', array(
	    'default'     => '#cbcbcb'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_text_color', array(
		'label'        => __( 'لون نصوص الفوتر', 'egywebschool' ),
		'section'    => 'bbsata_text_scheme',
		'settings'   => 'footer_text_color',
		'priority'   => 80,
	)));
	
	$wp_customize->add_setting('footer_link_color', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_link_color', array(
		'label'        => __( 'لون عناوين الفوتر', 'egywebschool' ),
		'section'    => 'bbsata_text_scheme',
		'settings'   => 'footer_link_color',
		'priority'   => 90,
	)));
	
	
	$wp_customize->add_setting('footer_link_hover', array(
	    'default'     => '#d3d3d3'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_link_hover', array(
		'label'        => __( 'لو روابط الفوتر', 'egywebschool' ),
		'section'    => 'bbsata_text_scheme',
		'settings'   => 'footer_link_hover',
		'priority'   => 100,
	)));
	
	
	$wp_customize->add_setting('button_text_color', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_text_color', array(
		'label'        => __( 'لون روابط الزر', 'egywebschool' ),
		'section'    => 'bbsata_text_scheme',
		'settings'   => 'button_text_color',
		'priority'   => 75,
	)));
	
	
	$wp_customize->add_section( 'bbsata_color_scheme' , array(
	    'title'      => __('لون الخلفية','egywebschool'),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting('header_bg', array(
	    'default'     => '#f46553'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg', array(
		'label'        => __( 'لون خلفية الهيدر', 'egywebschool' ),
		'section'    => 'bbsata_color_scheme',
		'settings'   => 'header_bg',
		'priority'   => 1,
	)));
	
	
	
	
	$wp_customize->add_setting('page_title_background', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_background', array(
		'label'        => __( 'لون خلفية العناوين', 'egywebschool' ),
		'section'    => 'bbsata_color_scheme',
		'settings'   => 'page_title_background',
		'priority'   => 10,
	)));
	
	
	$wp_customize->add_setting('body_bg', array(
	    'default'     => '#f1f1f1'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_bg', array(
		'label'        => __( 'لون خلفية جسم الموقع', 'egywebschool' ),
		'section'    => 'bbsata_color_scheme',
		'settings'   => 'body_bg',
		'priority'   => 20,
	)));
	
	
	$wp_customize->add_setting('content_bg', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'content_bg', array(
		'label'        => __( 'لون خلفية الحاويات', 'egywebschool' ),
		'section'    => 'bbsata_color_scheme',
		'settings'   => 'content_bg',
		'priority'   => 30,
	)));
	
	
	
	$wp_customize->add_setting('footer_bg', array(
	    'default'     => '#3d4352'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg', array(
		'label'        => __( 'لون خلفية الفوتر', 'egywebschool' ),
		'section'    => 'bbsata_color_scheme',
		'settings'   => 'footer_bg',
		'priority'   => 50,
	)));
	
	
	$wp_customize->add_setting('footer_top_bg', array(
	    'default'     => '#4c5365'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_top_bg', array(
		'label'        => __( 'لون قوائم خلفية الفوتر', 'egywebschool' ),
		'section'    => 'bbsata_color_scheme',
		'settings'   => 'footer_top_bg',
		'priority'   => 40,
	)));
	
	
	$wp_customize->add_setting('button_bg', array(
	    'default'     => '#f46553'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_bg', array(
		'label'        => __( 'لون خلفية الأزرار', 'egywebschool' ),
		'section'    => 'bbsata_color_scheme',
		'settings'   => 'button_bg',
		'priority'   => 60,
	)));
	
	
	
	$wp_customize->add_setting('button_hover_bg', array(
	    'default'     => '#484f61'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_hover_bg', array(
		'label'        => __( 'لون خلفية روابط الازرار', 'egywebschool' ),
		'section'    => 'bbsata_color_scheme',
		'settings'   => 'button_hover_bg',
		'priority'   => 70,
	)));
	
}
add_action('customize_register', 'bbsata_customize_register');


function bbsata_customize_css()
{
    ?>
 
<style type="text/css">
header, .sf-menu ul, .sf-menu ul ul, .sf-menu ul ul ul { background-color:<?php echo get_theme_mod('header_bg', '#f46553'); ?>; }
#highlight-container { background-color:<?php echo get_theme_mod('page_title_background', '#ffffff'); ?>; }
#main, body #main {background-color:<?php echo get_theme_mod('body_bg', '#f1f1f1'); ?>; }
.content-container { background-color:<?php echo get_theme_mod('content_bg', '#ffffff'); ?>; }
body, footer {background-color:<?php echo get_theme_mod('footer_bg', '#3d4352'); ?>;}
#footer-widgets {background-color:<?php echo get_theme_mod('footer_top_bg', '#4c5365'); ?>; }
.button, input.submit, input.wpcf7-submit, #respond input#submit {background-color:<?php echo get_theme_mod('button_bg', '#f46553'); ?>}
a.egywebschool-red {background:<?php echo get_theme_mod('button_bg', '#f46553'); ?>}
#sidebar .social-icons a {background-color: <?php echo get_theme_mod('button_bg', '#f46553'); ?>; }
#sidebar .social-icons a:before { border-color: transparent transparent <?php echo get_theme_mod('button_bg', '#f46553'); ?>;}
#sidebar .social-icons a:after {border-color:  <?php echo get_theme_mod('button_bg', '#f46553'); ?> transparent transparent;}
.button:hover, input.submit:hover, input.wpcf7-submit:hover, #respond input#submit:hover { background:<?php echo get_theme_mod('button_hover_bg', '#484f61'); ?>;  }
a.egywebschool-red:hover {background:<?php echo get_theme_mod('button_hover_bg', '#484f61'); ?>;}
#sidebar .social-icons a:hover {background-color: <?php echo get_theme_mod('button_hover_bg', '#484f61'); ?>; }
#sidebar .social-icons a:hover:before { border-color: transparent transparent <?php echo get_theme_mod('button_hover_bg', '#484f61'); ?>;}
#sidebar .social-icons a:hover:after {border-color:  <?php echo get_theme_mod('button_hover_bg', '#484f61'); ?> transparent transparent;}
body {color:<?php echo get_theme_mod('body_text', '#777777'); ?>;}
.sf-menu a, .sf-menu a:hover, .sf-menu a:visited, header .social-icons a  {color:<?php echo get_theme_mod('navigation_text', '#ffffff'); ?>; }
h1.page-title { color:<?php echo get_theme_mod('page_title_text', '#2f2f2f'); ?>; }
a, h3 a:hover, .content-container a:hover h4, .content-container a:hover h6.post-type-header {color:<?php echo get_theme_mod('link_color', '#f46553'); ?>; }
a:hover {color:<?php echo get_theme_mod('link_hover_color', '#484f61'); ?>;}
h1, h2, h3, h4, h5, h6, h3 a {color:<?php echo get_theme_mod('headings_default_color', '#2f2f2f'); ?>; }
#sidebar h5 {color:<?php echo get_theme_mod('sidebar_headings_default', '#444444'); ?>; }
footer {color:<?php echo get_theme_mod('footer_text_color', '#cbcbcb'); ?>; }
footer h1, footer h2, footer h3, footer h4, footer h5, footer h6, footer a {color:<?php echo get_theme_mod('footer_link_color', '#ffffff'); ?>;}
footer a:hover {color:<?php echo get_theme_mod('footer_link_hover', '#d3d3d3'); ?>;}
body .button, body a.button, input.submit, input.wpcf7-submit, #respond input#submit {color:<?php echo get_theme_mod('button_text_color', '#ffffff'); ?>;  }
</style>
    <?php
}
add_action('wp_head', 'bbsata_customize_css');


if ( current_user_can('contributor') && !current_user_can('upload_files') )
    add_action('admin_init', 'allow_contributor_uploads');

function allow_contributor_uploads() {
    $contributor = get_role('contributor');
    $contributor->add_cap('upload_files');
}

