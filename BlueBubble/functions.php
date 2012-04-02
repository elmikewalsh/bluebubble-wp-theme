<?php


// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'BlueBubble', TEMPLATEPATH . '/languages' );

// Check for New Versions
 include("theme-updates.php");


/*Sidebar Widget*/

if ( function_exists('register_sidebar') )
    register_sidebar(array(
    	'name' => 'Sidebar',
        'before_widget' => '<div id="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));


/* Add Post Image Theme Support */
add_theme_support( 'post-thumbnails' );
add_image_size( 'portfolio-thumb', 310, 150, true );
add_image_size( 'portfolio-big', 657, 318, true );


/* Enable Custom Background WP 3.0 Feature */
add_custom_background();

/* Making Menus Compatible with Wordpress 3.0 */
add_theme_support('menus');
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
			'first-menu' => __( 'main', 'Main Menu' ),
			'second-menu' => __( 'footer', 'Footer Menu' ),
			'third-menu' => __( '404', '404 Menu' ),
		)
	);
}



/* Remove Wordpress Ver. Number from HTML - For Security Reasons */

function bb_remove_version() {
return '';
}
add_filter('the_generator', 'bb_remove_version');



/* Add Custom User Profile Fields*/

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



/*Custom Write Panel*/

$meta_boxes =
	array(
		"image" => array(
			"name" => "post_image",
			"type" => "text",
			"std" => "",
			"title" => _("Image"),
			"description" => __("Using the \"<em>Add an Image</em>\" button, upload an image and paste the URL here.", 'BlueBubble'))
	);


function meta_boxes() {
	global $post, $meta_boxes;
	
	echo'
		<table class="widefat" cellspacing="0" id="inactive-plugins-table">
		
			<tbody class="plugins">';
	
			foreach($meta_boxes as $meta_box) {
				$meta_box_value = get_post_meta($post->ID, $pre.'_value', true);
				
				if($meta_box_value == "")
					$meta_box_value = $meta_box['std'];
				
				echo'<tr>
						<td width="100" align="center">';		
							echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
							echo'<h2>'.$meta_box['title'].'</h2>';
				echo'	</td>
						<td>';
							echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.get_post_meta($post->ID, $meta_box['name'].'_value', true).'" size="100" /><br />';
							echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].' </label></p>';
				echo'	</td>
					</tr>';
			}
	
	echo'
			</tbody>
		</table>';		
}


/* Shortcodes */
	function alert($atts, $content = null) {
	    return '<div class="alert">'.$content.'</div>';}
    add_shortcode('alert', 'alert');
	function alertbig($atts, $content = null) {
	    return '<div class="alertbig">'.$content.'</div>';}
    add_shortcode('alertbig', 'alertbig');
	function dload($atts, $content = null) {
	    return '<div class="download">'.$content.'</div>';}
    add_shortcode('dload', 'dload');
	function dloadbig($atts, $content = null) {
	    return '<div class="dloadbig">'.$content.'</div>';}
    add_shortcode('dloadbig', 'dloadbig');
	function info($atts, $content = null) {
	    return '<div class="info">'.$content.'</div>';}
    add_shortcode('info', 'info');
	function infobig($atts, $content = null) {
	    return '<div class="infobig">'.$content.'</div>';}
    add_shortcode('infobig', 'infobig');
	function idea($atts, $content = null) {
	    return '<div class="idea">'.$content.'</div>';}
    add_shortcode('idea', 'idea');
	function ideabig($atts, $content = null) {
	    return '<div class="ideabig">'.$content.'</div>';}
    add_shortcode('ideabig', 'ideabig');

function gbutton($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => ''
	), $atts));
	return '<a class="gbutton" href="'.$url.'">'.$content.'</a>';
}
add_shortcode('gbutton', 'gbutton');


function bbutton($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => ''
	), $atts));
	return '<a class="bbutton" href="'.$url.'">'.$content.'</a>';
}
add_shortcode('bbutton', 'bbutton');


/* Allows Shortcodes in Sidebars */
add_filter('widget_text', 'do_shortcode');


/*Start of Theme Options*/

$themename = "BlueBubble";
$shortname = "bb";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats,_("Choose a category")); 

$options = array (

array( "name" => $themename." Options",
	"type" => "title"),

array( "name" => __("General", 'BlueBubble'),
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => __("Color Scheme", 'BlueBubble'),
	"desc" => __("Choose a color scheme for the website.", 'BlueBubble'),
	"id" => $shortname."_color_scheme",
	"type" => "select",
	"options" => array( __("light gray (default)", 'BlueBubble'), __("white", 'BlueBubble'), __("lime", 'BlueBubble'), __("forest", 'BlueBubble'), __("red", 'BlueBubble'), __("blue", 'BlueBubble'), __("coffee", 'BlueBubble'), __("black", 'BlueBubble')),
	"std" =>__("light gray (default)", 'BlueBubble')),

array( "name" => __("Show Twitter Stream?", 'BlueBubble'),
	"desc" => __("Check if you want to show Twitter your stream. It will appear in the left sidebar above <strong>Other ways to reach me: </strong> (you must indicate your Twitter username in the next field)", 'BlueBubble'),
	"id" => $shortname."_twitter",
	"type" => "checkbox",
	"std" => ""),

array( "name" => __("Hide Tweet Buttons?", 'BlueBubble'),
	"desc" => __("Check if you want to hide the Twitter <strong>Tweet</strong> buttons that appear on posts and pages. (The buttons appear by default)", 'BlueBubble'),
	"id" => $shortname."_no_tweet",
	"type" => "checkbox",
	"std" => ""),

array( "name" => __("Twitter Username", 'BlueBubble'),
	"desc" => __("Enter your Twitter username. In addition to the Twitter stream, your username will be used with the <strong>Tweet Button</strong> located on most pages. (you must check the box in the field above for your Twitter stream to show)", 'BlueBubble'),
	"id" => $shortname."_twitter_name",
	"type" => "text",
	"std" => ""),
	
// Menu Option for Num. of Twitter Feeds 
array( "name" => __("Number of Twitter Feeds", 'BlueBubble'),
	"desc" => __("How many Twitter entries do you want to show? (default is 2; more than 5 is not recommended)", 'BlueBubble'),
	"id" => $shortname."_twitter_num",
	"type" => "text",
	"std" => ""),

array( "name" => __("Feedburner URL", 'BlueBubble'),
	"desc" => __("Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website", 'BlueBubble'),
	"id" => $shortname."_feedburner",
	"type" => "text",
	"std" => get_bloginfo('rss2_url')),
	
array( "name" => __("Custom CSS", 'BlueBubble'),
	"desc" => __("Place here any custom CSS you might need. (Note: This overrides any other stylesheets)", 'BlueBubble'),
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""),		
	
array( "type" => "close"),



array( "name" => __("Portfolio, Blog and Comments", 'BlueBubble'),
	"type" => "section"),	
array( "type" => "open"),
	
array( "name" => __("Portfolio Category", 'BlueBubble'),
	"desc" => __("Enter the name of the Portfolio category. (you must create categories before they will show up in the list.)", 'BlueBubble'),
	"id" => $shortname."_portfolio_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => __("Choose a category for your portfolio.", 'BlueBubble')),

array( "name" => __("Portfolio Items Per Page", 'BlueBubble'),
	"desc" => __("How many portfolio items do you want to show on each page? (default is 6)", 'BlueBubble'),
	"id" => $shortname."_portfolio_num",
	"type" => "text",
	"std" => ""),

array( "name" => __("Turn Off Lightbox?", 'BlueBubble'),
	"desc" => __("Check if you want to <strong>turn off</strong> the Colorbox popup that appears when clicking an image on your portfolio page. (if turned off, clicking the image will take you to the single portfolio page with the larger image)", 'BlueBubble'),
	"id" => $shortname."_no_colorbox",
	"type" => "checkbox",
	"std" => ""),
	
array( "name" => __("Blog Parent Category", 'BlueBubble'),
	"desc" => __("Enter the name of the Portfolio category. (you must create categories before they will show up in the list.)", 'BlueBubble'),
	"id" => $shortname."_blog_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => __("Choose a category for your blog.", 'BlueBubble')),

array( "name" => __("Oldest Posts First?", 'BlueBubble'),
	"desc" => __("BlueBubble 3.0 normally displays posts from newest to oldest. Check if you want to show oldest posts first. (Note: This will only change blog posts, not portfolio posts order)", 'BlueBubble'),
	"id" => $shortname."_post_order",
	"type" => "checkbox",
	"std" => ""),

array( "name" => __("Comments disable?", 'BlueBubble'),
	"desc" => __("Check if you want to disable comments on portfolio items.", 'BlueBubble'),
	"id" => $shortname."_comments",
	"type" => "checkbox",
	"std" => ""),

array( "type" => "close"),



array( "name" => __("Header, Footer and Icons", 'BlueBubble'),
	"type" => "section"),
array( "type" => "open"),

array( "name" => __("Logo", 'BlueBubble'),
	"desc" => __("Enter the full path to your logo.<br /><strong>Ideal size is 192 x 77.</strong>", 'BlueBubble'),
	"id" => $shortname."_logo",
	"type" => "text",
	"std" => get_bloginfo('template_directory') ."/images/logo.png"),		

array( "name" => __("Custom Favicon", 'BlueBubble'),
	"desc" => __("A favicon is the 16x16 pixel icon that appears in the address bar of most browsers and represents your site; Upload a favicon to Wordpress, then paste the URL to the image that you want to use. (Note: Image should be in .ico format)", 'BlueBubble'),
	"id" => $shortname."_favicon",
	"type" => "text",
	"std" => get_bloginfo('url') ."/images/favicon.ico"),

array( "name" => __("Footer copyright text", 'BlueBubble'),
	"desc" => __("Enter text used in the left side of the footer. It can be HTML.", 'BlueBubble'),
	"id" => $shortname."_footer_text",
	"type" => "textarea",
	"std" => ""),
	
array( "type" => "close"),



array( "name" => __("Contact Form and Social Icons", 'BlueBubble'),
	"type" => "section"),	
array( "type" => "open"),

	
array( "name" => __("Contact Form Email Address", 'BlueBubble'),
	"desc" => __("Where do you want the emails from the contact form to arrive? Place that email address here. (if no email address is entered, email will automatically be sent to the administrator email address)", 'BlueBubble'),
	"id" => $shortname."_contact_email",
	"type" => "text",
	"std" => ""),

array( "name" => __("Show Social Sites Section", 'BlueBubble'),
	"desc" => __("Check if you want to show links to sites such as Facebook, Twitter, etc. It will appear in the left sidebar with the header <strong>Other ways to reach me: </strong>", 'BlueBubble'),
	"id" => $shortname."_social",
	"type" => "checkbox",
	"std" => ""),


array( "name" => __("Facebook Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Facebook page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_fb",
	"type" => "text",
	"std" => ""),
	
array( "name" => __("Twitter Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Twitter page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_tw",
	"type" => "text",
	"std" => ""),
	
array( "name" => __("LinkedIn Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your LinkedIn page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_lnk",
	"type" => "text",
	"std" => ""),

array( "name" => __("Behance Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Behance page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_beh",
	"type" => "text",
	"std" => ""),
	
array( "name" => __("Delicious Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Delicious page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_de",
	"type" => "text",
	"std" => ""),
		
array( "name" => __("Digg Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Digg page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_dg",
	"type" => "text",
	"std" => ""),
	
array( "name" => __("DeviantArt Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your DeviantArt page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_dva",
	"type" => "text",
	"std" => ""),
	
array( "name" => __("MySpace Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your MySpace page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_ms",
	"type" => "text",
	"std" => ""),
	
array( "name" => __("Evernote Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Evernote page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_ev",
	"type" => "text",
	"std" => ""),

array( "name" => __("Flickr Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Flickr page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_fl",
	"type" => "text",
	"std" => ""),
	
array( "name" => __("Netvibes Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Netvibes page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_nv",
	"type" => "text",
	"std" => ""),
	
array( "name" => __("Orkut Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Orkut page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_or",
	"type" => "text",
	"std" => ""),

array( "name" => __("Reddit Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Reddit page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_re",
	"type" => "text",
	"std" => ""),
	
array( "name" => __("ShareThis Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your ShareThis page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_sh",
	"type" => "text",
	"std" => ""),
		
array( "name" => __("StumbleUpon Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your StumbleUpon page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_su",
	"type" => "text",
	"std" => ""),

array( "name" => __("Technorati Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Technorati page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_te",
	"type" => "text",
	"std" => ""),

array( "name" => __("Tumblr Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Tumblr page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_tu",
	"type" => "text",
	"std" => ""),


array( "type" => "close"),



array( "name" =>(__("Search Engine Optimization", 'BlueBubble')),
	"type" => "section"),
array( "type" => "open"),

array( "name" => __("Meta Tag: Description", 'BlueBubble'),
	"desc" => __("The meta tag <strong>description</strong> is found in the header of your webpages and is used by search engines (i.e. Google) to rank and describe your site. Write an overall brief description of your site here.", 'BlueBubble'),
	"id" => $shortname."_seo_description",
	"type" => "textarea",
	"std" => ""),

array( "name" => __("Meta Tag: Keywords", 'BlueBubble'),
	"desc" => __("The meta tag <strong>keywords</strong> is found in the header of your webpages and is used by search engines (i.e. Google) to rank and describe your site. List here the keywords that describe your site. <strong>(Example: Blue,Bubble,portfolio,theme)</strong>", 'BlueBubble'),
	"id" => $shortname."_seo_keywords",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => __("Google Analytics Code", 'BlueBubble'),
	"desc" => __("You can put your Google Analytics code or code from another tracking service here if you want.  It is automatically added to the footer. Just paste your code, without the &lt;script&gt;&lt;/script&gt; tags.", 'BlueBubble'),
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""),	

array( "type" => "close")
 
);


function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=functions.php&saved=true");
die;
 
} 
else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=functions.php&reset=true");
die;
 
}
}
 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin', get_bloginfo('template_url'). '/includes/images/bb-admin-icon.png');
}
 
function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/includes/bb-admin.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/includes/rm_script.js", false, "1.0");

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename. (__(' settings saved.</strong></p></div>', 'BlueBubble'));
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename. (__(' settings reset.</strong></p></div>', 'BlueBubble'));
 
?>
<div class="wrap rm_wrap">
<h2><img class="logo" src="<?php bloginfo('template_directory'); ?>/includes/images/bb-icon32x32.png" alt="BlueBubble 3.0" /> <?php echo $themename; ?> Settings</h2>
 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p><?php _e('To easily use the', 'BlueBubble') ?> <?php echo $themename;?> <?php _e('theme, you can use the menu below.', 'BlueBubble') ?></p>

 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/includes/images/trans.gif" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="<?php _e('Save changes', 'BlueBubble') ?>" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>
 
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="<?php _e('Reset', 'BlueBubble') ?>" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
<div style="font-size:9px; margin-bottom:10px;"><?php _e('Icons:', 'BlueBubble') ?> <a href="http://www.woothemes.com/2009/09/woofunction/" target="_blank">WooFunction</a></div>
<div style="font-size:9px; margin-bottom:10px;"><?php _e('Social Media Icons:', 'BlueBubble') ?> <a href="http://www.komodomedia.com/blog/2009/06/social-network-icon-pack/" target="_blank">Komodo Media</a></div>
 </div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>