<?php if ( get_option('bb_gzip_page') =='true' ) { ?>
<?php
	if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
		ob_start("ob_gzhandler");
	else
		ob_start();
?><?php } // End check for old menu ?>
<?php

/*-----------------------------------------------------------------------------------

	A. Register WP3.0+ Menus
    B. Register Sidebars
	C. Custom Post Formats (WP 3.1+)
	D. Custom Thumbnails Sizes (new as of BlueBubble 3.5)
	E. Custom Login Logo
	F. Pagination
	G. Change Default Excerpt Length
    H. Configure Excerpt String
	I. Limit Title Character Length
	J. Add Custom User Profile Fields
	K. 
	L. Add/Remove Widgets from WP Dashboard
	M. Load Theme Options

	--inactive-- a. Custom Post Type - Portfolio Projects

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	A. Register WP3.0+ Menus
/*-----------------------------------------------------------------------------------*/

function register_menu() {
		register_nav_menus(
	array(
			'first-menu' => __( 'main', 'Main Menu' ),
			'second-menu' => __( 'footer', 'Footer Menu' ),
			'third-menu' => __( '404', '404 Menu' ),
			'fourth-menu' => __( 'Top', 'Top Menu' ),
		));
}
add_action('init', 'register_menu');



/*-----------------------------------------------------------------------------------*/
/*	B. Register Sidebars
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') ) {
	
	register_sidebar(array(
		'name' => 'Main',
		'id' => 'standard',
        'before_widget' => '<div id="widget"><hr class="divider" />',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
	
	register_sidebar(array(
		'name' => __('Blog'),
		'id' => 'blog',
        'before_widget' => '<div id="widget"><hr class="divider" />',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
	
	register_sidebar(array(
		'name' => __('Portfolio'),
        'id' => 'portfolio',
		'before_widget' => '<div id="widget"><hr class="divider" />',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
	
	register_sidebar(array(
		'name' => __('Contact'),
        'id' => 'contact',
		'before_widget' => '<div id="widget"><hr class="divider" />',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
}


/*-----------------------------------------------------------------------------------*/
/*	C. Custom Post Formats (WP 3.1+)
/*-----------------------------------------------------------------------------------*/

if (get_option('bb_post_formats') == 'false' ) {
$formats = array( 
			'aside', 
			'gallery', 
			'link', 
			'image', 
			'quote', 
			'audio',
			'video');

add_theme_support( 'post-formats', $formats ); 

add_post_type_support( 'post', 'post-formats' );
}


/*-----------------------------------------------------------------------------------*/
/*	D. Custom Thumbnails Sizes (new as of BlueBubble 3.5)
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'post-thumbnails' );
add_image_size( 'portfolio-thumb', 310, 150, true );
add_image_size( 'portfolio-big', 657, 318, true );
add_image_size( '3col-thumb', 215, 104, true );
add_image_size( '3colfull-thumb', 300, 145, true );
add_image_size( '4colfull-thumb', 228, 110, true );


/*-----------------------------------------------------------------------------------*/
/*	E. Custom Login Logo
/*-----------------------------------------------------------------------------------*/

if ( get_option('bb_custom_login') ) {

function custom_login() { 
echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/css/custom-login/custom-login.css" />'; 
}
add_action('login_head', 'custom_login');
}


/*-----------------------------------------------------------------------------------*/
/*	F. Pagination
/*-----------------------------------------------------------------------------------*/

function pagination($pages = '', $range = 4)
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
         echo "<div class=\"pagination\"><span> ".__('Page')." ".$paged." ".__('of')." ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next')." &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last')." &raquo;</a>";
         echo "</div>\n";
     }
}


/*-----------------------------------------------------------------------------------*/
/*	G. Change Default Excerpt Length
/*-----------------------------------------------------------------------------------*/

function bb_excerpt_length($length) {
return 16; }
add_filter('excerpt_length', 'bb_excerpt_length');


/*-----------------------------------------------------------------------------------*/
/*	H. Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

function bb_excerpt_more($excerpt) {
return str_replace('[...]', '...', $excerpt); }
add_filter('wp_trim_excerpt', 'bb_excerpt_more');


/*-----------------------------------------------------------------------------------*/
/*	I. Limit Title Character Length
/*-----------------------------------------------------------------------------------*/

function short_title($before = '', $after = '', $echo = true, $length = false) {
$title = get_the_title();

if ( $length && is_numeric($length) && strlen($title) >= $length) {
$title = substr( $title, 0, $length ); // Trim title to 40 characters
$lastSpace = strrpos($title, ' '); // Locate the last space in the title
$title = substr($title, 0, $lastSpace); // Trim the portion of the last word off
}

if ( strlen($title)> 0 ) {

$title = apply_filters('short_title', $before . $title . $after, $before, $after);

if ( $echo )

echo $title;

else

return $title;
}
}


/*-----------------------------------------------------------------------------------*/
/*	J. Add Custom User Profile Fields
/*-----------------------------------------------------------------------------------*/

	// Add Custom User Contact Fields and remove Default Fields
	function add_contactmethod( $contactmethods ) {

		// Add Telephone
	    $contactmethods['phone'] = (__('Phone', 'BlueBubble'));
		
		// Add Facebook
	    $contactmethods['facebook'] = 'Facebook';
		
	    // Add Twitter
	    $contactmethods['twitter'] = 'Twitter';
		
		// Add Skype
	    $contactmethods['skype'] = 'Skype';
	 
	    // Remove User Contact Fields
	    unset($contactmethods['yim']);
	    unset($contactmethods['aim']);
		unset($contactmethods['jabber']);
		
	    return $contactmethods;
	}
	add_filter('user_contactmethods','add_contactmethod',10,1);


/*-----------------------------------------------------------------------------------*/
/*	K. 
/*-----------------------------------------------------------------------------------*/

function delete_comment_link($id) {
  if (current_user_can('edit_post')) {
    echo '<a href="'.admin_url("comment.php?action=cdc&c=$id").'">del</a> ';
    echo '<a href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">spam</a>';
  }
}


/*-----------------------------------------------------------------------------------*/
/* Register Custom Menus, and Create Default Menus, Assign to Theme Locations
/*-----------------------------------------------------------------------------------*/

if (isset($_GET['activated']) && is_admin() && current_user_can(‘edit_posts’)){

	$new_page_title = 'Blog';
	$new_page_content = __('This is a premade Blog Page');
	$new_page_template = 'blog.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.

	//don't change the code bellow, unless you know what you're doing

	$page_check = get_page_by_title($new_page_title);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_content' => $new_page_content,
		'post_status' => 'publish',
		'post_author' => 1,
	);
	if(!isset($page_check->ID)){
		$new_page_id = wp_insert_post($new_page);
		if(!empty($new_page_template)){
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
		}
	}

	$new_page_title = 'Portfolio';
	$new_page_content = __('This is a premade Portfolio Page');
	$new_page_template = 'portfolio.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.

	//don't change the code bellow, unless you know what you're doing

	$page_check = get_page_by_title($new_page_title);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_content' => $new_page_content,
		'post_status' => 'publish',
		'post_author' => 1,
	);
	if(!isset($page_check->ID)){
		$new_page_id = wp_insert_post($new_page);
		if(!empty($new_page_template)){
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
		}
	}

	$new_page_title = 'Contact';
	$new_page_content = __('This is a premade Contact Page');
	$new_page_template = 'contact.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.

	//don't change the code bellow, unless you know what you're doing

	$page_check = get_page_by_title($new_page_title);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_content' => $new_page_content,
		'post_status' => 'publish',
		'post_author' => 1,
	);
	if(!isset($page_check->ID)){
		$new_page_id = wp_insert_post($new_page);
		if(!empty($new_page_template)){
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
		}
	}

}


add_action('load-themes.php', 'themeit_register_custom_menu');

function themeit_register_custom_menu() {
  register_nav_menu( 'main_menu', __('Main Menu') );

  if ( isset( $_GET['activated'] ) && $_GET['activated'] ) {
    if ( !is_nav_menu( 'Main Menu' ) ) {
      $menu_id = wp_create_nav_menu( 'Main Menu' );

      $menu_home = array( 'menu-item-type' => 'custom',
	                      'menu-item-url' => home_url('/'),
						  'menu-item-title' => __('Home'), 
						  'menu-item-classes' => 'home', 
						  'menu-item-status' => 'publish' );
						  
      $menu_portfolio = array( 'menu-item-url' => home_url( '/portfolio/ '),
							   'menu-item-title' => __('Portfolio'), 
							   'menu-item-classes' => 'portfolio', 
							   'menu-item-status' => 'publish' );
							   
      $menu_blog = array( 'menu-item-url' => home_url('/blog/'),
	                      'menu-item-title' => __('Blog'), 
						  'menu-item-classes' => 'blog', 
	                      'menu-item-status' => 'publish' );
	  
      $menu_contact = array( 'menu-item-url' => home_url('/contact/'),
	                         'menu-item-title' => __('Contact'), 
	                         'menu-item-classes' => 'contact', 
	                         'menu-item-status' => 'publish' );

      wp_update_nav_menu_item( $menu_id, 0, $menu_home );
      wp_update_nav_menu_item( $menu_id, 0, $menu_portfolio );
      wp_update_nav_menu_item( $menu_id, 0, $menu_blog );
	  wp_update_nav_menu_item( $menu_id, 0, $menu_contact );

      set_theme_mod( 'nav_menu_locations', array(
        'first-menu' => $menu_id, 'second-menu' => $menu_id, 'third-menu' => $menu_id, 'fourth-menu' => $menu_id
      ) );
    }
  }
}


/*-----------------------------------------------------------------------------------*/
/*	--inactive-- a. Custom Post Type - Portfolio Projects
/*-----------------------------------------------------------------------------------*/
/*
// Adding Variable Excerpt Length
function folio_excerpt_length($length) {
    return 80;
}
function folio_excerpt_more($more) {
	return ' ... <span class="excerpt_more"><a href="'.get_permalink().'">Read more</a></span>';
}
function folio_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}

// Creating custom post type for project //
add_action('init', 'project_custom_init');
function project_custom_init()
{
  $labels = array(
    'name' => _x('Projects', 'post type general name'),
    'singular_name' => _x('Project', 'post type singular name'),
    'add_new' => _x('Add New', 'project'),
    'add_new_item' => __('Add New Project'),
    'edit_item' => __('Edit Project'),
    'new_item' => __('New Project'),
    'view_item' => __('View Project'),
    'search_items' => __('Search Projects'),
    'not_found' =>  __('No projects found'),
    'not_found_in_trash' => __('No projects found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Project'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','author','thumbnail','excerpt','comments')
  );
  register_post_type('project',$args);
}
*/


/*-----------------------------------------------------------------------------------*/
/*	L. Add/Remove Widgets from WP Dashboard
/*-----------------------------------------------------------------------------------*/

	
if (get_option('bb_dash_all') == 'true' ) {
add_action('admin_init', 'bb_remove_dashboard_widgets');
function bb_remove_dashboard_widgets() { 
 remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // right now
 remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // recent comments
 remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // incoming links
 remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // plugins

 remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');  // quick press
 remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');  // recent drafts
 remove_meta_box('dashboard_primary', 'dashboard', 'normal');   // wordpress blog
 remove_meta_box('dashboard_secondary', 'dashboard', 'normal');   // other wordpress news
}
}

add_action('admin_init', 'bb_remove_dashboard_widgets_uni');

function bb_remove_dashboard_widgets_uni() {

if (get_option('bb_dash_rightnow') == 'true' ) { 
 remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // right now
}

if (get_option('bb_dash_comments') == 'true' ) { 
 remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // recent comments
}

if (get_option('bb_dash_links') == 'true' ) { 
 remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); // recent comments
}

if (get_option('bb_dash_plugins') == 'true' ) { 
 remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); // recent comments
}

if (get_option('bb_dash_quickpress') == 'true' ) { 
 remove_meta_box('dashboard_quick_press', 'dashboard', 'normal'); // recent comments
}

if (get_option('bb_dash_drafts') == 'true' ) { 
 remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal'); // recent comments
}

if (get_option('bb_dash_primary') == 'true' ) { 
 remove_meta_box('dashboard_primary', 'dashboard', 'normal'); // recent comments
}

if (get_option('bb_dash_secondary') == 'true' ) { 
 remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); // recent comments
}
}


/*-----------------------------------------------------------------------------------*/
/*	M. Load Theme Options
/*-----------------------------------------------------------------------------------*/

define('bb_FILEPATH', TEMPLATEPATH);
define('bb_DIRECTORY', get_template_directory_uri());

require_once (bb_FILEPATH . '/admin/admin-functions.php');
require_once (bb_FILEPATH . '/admin/admin-interface.php');
require_once (bb_FILEPATH . '/admin/theme-options.php');
require_once (bb_FILEPATH . '/admin/theme-functions.php');
require_once (bb_FILEPATH . '/admin/update-notifier.php');
require_once (bb_FILEPATH . '/includes/bb-widgets.php');
include_once (bb_FILEPATH . '/includes/shortcodes.php');
include_once (bb_FILEPATH . '/includes/taxonomy/meta-box-3.2.2.class.php');
include (bb_FILEPATH . '/includes/taxonomy/meta-box-usage.php')

?>