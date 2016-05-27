<?php
/**
 * AIMS functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AIMS
 */

if ( ! function_exists( 'aims_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aims_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on AIMS, use a find and replace
	 * to change 'aims' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'aims', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'aims' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'aims_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'aims_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aims_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aims_content_width', 640 );
}
add_action( 'after_setup_theme', 'aims_content_width', 0 );

/**
* Create "News" custom post type
*/

add_action('init','create_my_post_types');

function create_my_post_types() {
	register_post_type('add_staff_to_sched', array(
		'labels' => array(
			'name' => __('Staff Member Scheduler'),
			'singular_name' => __('Staff Member Scheduler'),
			'add_new' => __('Add new person to schedule'),
			'add_new_item' => __('Add new person to schedule'),
			'edit' => __('Edit'),
			'edit_item' => __("Edit Staff Member's Schedule"),
			'new_item' => __('Add person to schedule'),
			'view' => __("View Staff Member's Schedule"),
			'view_item' => __("View Staff Member's Schedule"),
			),
		'public' => true,
			'menu_position' => 4,
			'rewrite' => array('slug' => 'add_staff_to_sched'),
			'supports' => array('title','editor','thumbnails'),
			'taxonomies' => array('category','post_tag'),
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
		)
	);
	register_post_type('news_items', array(
		'labels' => array(
			'name' => __('Home: News Items'),
			'singular_name' => __('News Item'),
			'add_new' => __('Add New'),
			'add_new_item' => __('Add News Item'),
			'edit' => __('Edit'),
			'edit_item' => __('Edit News Item'),
			'new_item' => __('New News Item'),
			'view' => __('View News Item'),
			'view_item' => __('View News Item'),
			'search_items' => __('Search News Items'),
			'not_found' => __('No News Items found'),
			'not_found_in_trash' => __('No News Items found in Trash'),
			'parent' => __('Parent News Item'),
			),
		'public' => true,
			'menu_position' => 6,
			'rewrite' => array('slug' => 'news_items'),
			'supports' => array('title','editor','thumbnails'),
			'taxonomies' => array('category','post_tag'),
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
		)
	);
	register_post_type('current_season', array(
		'labels' => array(
			'name' => __('Home: Current Season Info'),
			'singular_name' => __('Current Season Info'),
			'edit' => __('Edit'),
			'edit_item' => __('Edit Current Season Info'),
			'view' => __('View Current Season Info'),
			'view_item' => __('View Current Season Info'),
			'parent' => __('Parent Current Season Info'),
			),
		'public' => true,
			'menu_position' => 7,
			'rewrite' => array('slug' => 'current_season_info'),
			'supports' => array('title','editor','thumbnails'),
			'taxonomies' => array('category','post_tag'),
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
		)
	);
	register_post_type('staff_profile', array(
		'labels' => array(
			'name' => __('Staff Profiles'),
			'singular_name' => __('Staff Profile'),
			'add_new' => __('Add Staff Profile'),
			'add_new_item' => __('Add Staff Profile'),
			'edit' => __('Edit'),
			'edit_item' => __('Edit Staff Profile'),
			'new_item' => __('New Staff Profile'),
			'view' => __('View Staff Profile'),
			'view_item' => __('View Staff Profile'),
			'search_items' => __('Search Staff Profiles'),
			'not_found' => __('No Staff Profiles found'),
			'not_found_in_trash' => __('No Staff Profiles found in Trash'),
			'parent' => __('Parent Staff Profile'),
			),
		'public' => true,
			'menu_position' => 8,
			'rewrite' => array('slug' => 'staff_profile'),
			'supports' => array('title','editor','thumbnails'),
			'taxonomies' => array('category','post_tag'),
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
		)
	);
}


/**
* Code source for createDateRangeArray function: 
* http://stackoverflow.com/questions/4312439/php-return-all-dates-between-two-dates-in-an-array
*/
function createDateRangeArray($strDateFrom,$strDateTo) {
    // takes two dates formatted as YYYYMMDD and creates an
    // inclusive array of the dates between the from and to dates.
    // Returns date as MonYY

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,4,2),substr($strDateFrom,6,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,4,2),substr($strDateTo,6,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('M d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('M d',$iDateFrom));
        }
    }
    return $aryRange;
}

function getStartDay($strDateFrom) {
    $iDateFrom=mktime(1,0,0,substr($strDateFrom,4,2),substr($strDateFrom,6,2),substr($strDateFrom,0,4));
    $iStartDay=date( 'w', $iDateFrom); //returns the day of the week as a number: 0=Sunday -> 6=Saturday
	return $iStartDay;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aims_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'aims' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'aims' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'aims_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function aims_scripts() {
	wp_enqueue_style( 'aims-style', get_stylesheet_uri() );
        
    //Add Google fonts - Marcellus SC and Fira Sans
    wp_enqueue_style( 'aims-google-fonts', 'https://fonts.googleapis.com/css?family=Marcellus+SC|Fira+Sans:400,400italic,700,700italic|Merriweather');

    wp_enqueue_style( 'aims-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css');

	wp_enqueue_script( 'aims-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );
	wp_localize_script( 'aims-navigation', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'aims' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'aims' ) . '</span>',
	) );

	wp_enqueue_script( 'aims-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'aims_scripts' ); 

/* 
replacing the default "Enter title here" placeholder text in the title input box
with something more descriptive can be helpful for custom post types 
place this code in your theme's functions.php or relevant file
source: http://flashingcursor.com/wordpress/change-the-enter-title-here-text-in-wordpress-963
*/
function wpfstop_change_default_title( $title ){
    $screen = get_current_screen();
    if ( 'staff_profile' == $screen->post_type ) :
        $title = 'Enter your name';
    elseif ('add_staff_to_sched' == $screen->post_type ) :
    	$title = 'Enter staff name';
    return $title;
    endif;
}
add_filter( 'enter_title_here', 'wpfstop_change_default_title' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
