<?php

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

function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');



/* Tweet This Post Links

if(!function_exists('dd_tiny_tweet_init')){
 
	function dd_tiny_tweet_init($content){
		//Thanks to http://briancray.com for the one line $tiny_tweet_url solution. 
		$tiny_tweet_url = file_get_contents('http://tinyurl.com/api-create.php?url=' . urlencode('http://' . $_SERVER['HTTP_HOST']  . '/' . $_SERVER['REQUEST_URI']));
		//Grab the title of the current post
		$tiny_tweet_title = get_the_title();
		//Reduce title to 100 characters
		$tiny_tweet_title = substr($tiny_tweet_title, 0,100);
		//Append an ellipsis to the end
		$tiny_tweet_title .='...';
		//Set up the status and url to send to twitter
		$tiny_tweet_status_url = 'http://twitter.com/home?status=Currently reading "'.$tiny_tweet_title."\" ".$tiny_tweet_url;
		//If the current page is an individual article, promote it with a Twitter link!
		if(is_single()){
			$content .=  '<div class=\'tiny_tweet\'>Have Twitter? <a href=\''.$tiny_tweet_status_url.'\' target="_blank">Tweet this post!</a></div>';
		}
	return $content;
  }
  add_filter('the_content', 'dd_tiny_tweet_init');
 
}*/


/* Add Custom User Profile Fields*/

	// Add Custom User Contact Fields and remove Default Fields
	function add_contactmethod( $contactmethods ) {

		// Add Telephone
	    $contactmethods['phone'] = 'Phone';
		
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
			"title" => "Image",
			"description" => "Using the \"<em>Add an Image</em>\" button, upload an image and paste the URL here.")
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






/*Start of Theme Options*/

$themename = "BlueBubble";
$shortname = "bb";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 

$options = array (

array( "name" => $themename." Options",
	"type" => "title"),

array( "name" => "General",
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Color Scheme",
	"desc" => "Choose a color scheme for the website.",
	"id" => $shortname."_color_scheme",
	"type" => "select",
	"options" => array("light gray (default)", "white", "lime", "forest", "red", "blue", "coffee", "black"),
	"std" => "white (default)"),

array( "name" => "Show Twitter Stream?",
	"desc" => "Check if you want to show Twitter your stream. It will appear in the left sidebar above <strong>Other ways to reach me: </strong> (you must indicate your Twitter username in the next field)",
	"id" => $shortname."_twitter",
	"type" => "checkbox",
	"std" => ""),

	
array( "name" => "Twitter Username",
	"desc" => "Enter your Twitter username. In addition to the Twitter stream, your username will be used with the <strong>Tweet Button</strong> located on most pages. (you must check the box in the field above for your Twitter stream to show)",
	"id" => $shortname."_twitter_name",
	"type" => "text",
	"std" => ""),
	
// Menu Option for Num. of Twitter Feeds 
array( "name" => "Number of Twitter Feeds",
	"desc" => "How many Twitter entries do you want to show? (default is 2; more than 5 is not recommended)",
	"id" => $shortname."_twitter_num",
	"type" => "text",
	"std" => ""),

array( "name" => "Feedburner URL",
	"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website",
	"id" => $shortname."_feedburner",
	"type" => "text",
	"std" => get_bloginfo('rss2_url')),
	
array( "name" => "Custom CSS",
	"desc" => "Place here any custom CSS you might need. (Note: This overrides any other stylesheets)",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""),		
	
array( "type" => "close"),



array( "name" => "Portfolio, Blog and Comments",
	"type" => "section"),	
array( "type" => "open"),
	
array( "name" => "Portfolio Category",
	"desc" => "Enter the name of the Portfolio category. (you must create categories before they will show up in the list.)",
	"id" => $shortname."_portfolio_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => "Choose a category for your portfolio."),

array( "name" => "Portfolio Items Per Page",
	"desc" => "How many portfolio items do you want to show on each page? (default is 6)",
	"id" => $shortname."_portfolio_num",
	"type" => "text",
	"std" => ""),

array( "name" => "Turn Off Lightbox?",
	"desc" => "Check if you want to <strong>turn off</strong> the Colorbox popup that appears when clicking an image on your portfolio page. (if turned off, clicking the image will take you to the single portfolio page with the larger image)",
	"id" => $shortname."_no_colorbox",
	"type" => "checkbox",
	"std" => ""),
	
array( "name" => "Blog Parent Category",
	"desc" => "Enter the name of the Portfolio category. (you must create categories before they will show up in the list.)",
	"id" => $shortname."_blog_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => "Choose a category for your blog."),

array( "name" => "Oldest Posts First?",
	"desc" => "BlueBubble 3.0 normally displays posts from newest to oldest. Check if you want to show oldest posts first. (Note: This will only change blog posts, not portfolio posts order)",
	"id" => $shortname."_post_order",
	"type" => "checkbox",
	"std" => ""),

array( "name" => "Comments disable?",
	"desc" => "Check if you want to disable comments on portfolio items.",
	"id" => $shortname."_comments",
	"type" => "checkbox",
	"std" => ""),

array( "type" => "close"),



array( "name" => "Header, Footer and Icons",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Logo",
	"desc" => "Enter full path to your Logo.<br /><strong>Ideal size is 192x77.</strong><br />
Example: http://www.yoursite.com/wp-content/uploads/logo.png" ,
	"id" => $shortname."_logo",
	"type" => "text",
	"std" => get_bloginfo('template_directory') ."/images/logo.png"),		
	
array( "name" => "Custom Favicon",
	"desc" => "A favicon is the 16x16 pixel icon that appears in the address bar of most browsers and represents your site; Upload a favicon to Wordpress, then paste the URL to the image that you want to use. (Note: Image should be in .ico format)",
	"id" => $shortname."_favicon",
	"type" => "text",
	"std" => get_bloginfo('url') ."/images/favicon.ico"),

array( "name" => "Footer copyright text",
	"desc" => "Enter text used in the right side of the footer. It can be HTML.",
	"id" => $shortname."_footer_text",
	"type" => "textarea",
	"std" => ""),
	
array( "type" => "close"),



array( "name" => "Contact Form and Social",
	"type" => "section"),	
array( "type" => "open"),

	
array( "name" => "Contact Form Email Address",
	"desc" => "Where do you want the emails from the contact form to arrive? Place that email address here. (if no email address is entered, email will automatically be sent to the administrator email address)",
	"id" => $shortname."_contact_email",
	"type" => "text",
	"std" => ""),

array( "name" => "Show Social Sites Section",
	"desc" => "Check if you want to show links to sites such as Facebook, Twitter, etc. It will appear in the left sidebar with the header <strong>Other ways to reach me: </strong>",
	"id" => $shortname."_social",
	"type" => "checkbox",
	"std" => ""),


array( "name" => "Facebook Social Link",
	"desc" => "If you would like a link to your Facebook page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_fb",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Twitter Social Link",
	"desc" => "If you would like a link to your Twitter page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_tw",
	"type" => "text",
	"std" => ""),
	
array( "name" => "LinkedIn Social Link",
	"desc" => "If you would like a link to your LinkedIn page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_lnk",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Delicious Social Link",
	"desc" => "If you would like a link to your Delicious page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_de",
	"type" => "text",
	"std" => ""),
		
array( "name" => "Digg Social Link",
	"desc" => "If you would like a link to your Digg page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_dg",
	"type" => "text",
	"std" => ""),
	
array( "name" => "DeviantArt Social Link",
	"desc" => "If you would like a link to your DeviantArt page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_dva",
	"type" => "text",
	"std" => ""),
	
array( "name" => "MySpace Social Link",
	"desc" => "If you would like a link to your MySpace page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_ms",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Evernote Social Link",
	"desc" => "If you would like a link to your Evernote page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_ev",
	"type" => "text",
	"std" => ""),

array( "name" => "Flickr Social Link",
	"desc" => "If you would like a link to your Flickr page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_fl",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Netvibes Social Link",
	"desc" => "If you would like a link to your Netvibes page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_nv",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Orkut Social Link",
	"desc" => "If you would like a link to your Orkut page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_or",
	"type" => "text",
	"std" => ""),

array( "name" => "Reddit Social Link",
	"desc" => "If you would like a link to your Reddit page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_re",
	"type" => "text",
	"std" => ""),
	
array( "name" => "ShareThis Social Link",
	"desc" => "If you would like a link to your ShareThis page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_sh",
	"type" => "text",
	"std" => ""),
		
array( "name" => "StumbleUpon Social Link",
	"desc" => "If you would like a link to your StumbleUpon page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_su",
	"type" => "text",
	"std" => ""),

array( "name" => "Technorati Social Link",
	"desc" => "If you would like a link to your Technorati page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_te",
	"type" => "text",
	"std" => ""),

array( "name" => "Tumblr Social Link",
	"desc" => "If you would like a link to your Tumblr page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)",
	"id" => $shortname."_soc_tu",
	"type" => "text",
	"std" => ""),


array( "type" => "close"),



array( "name" => "Search Engine Optimization",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Meta Tag: Description",
	"desc" => "The meta tag <strong>description</strong> is found in the header of your webpages and is used by search engines (i.e. Google) to rank and describe your site. Write an overall brief description of your site here.",
	"id" => $shortname."_seo_description",
	"type" => "textarea",
	"std" => ""),

array( "name" => "Meta Tag: Keywords",
	"desc" => "The meta tag <strong>keywords</strong> is found in the header of your webpages and is used by search engines (i.e. Google) to rank and describe your site. List here the keywords that describe your site. <strong>(Example: Blue,Bubble,portfolio,theme)</strong>",
	"id" => $shortname."_seo_keywords",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "Google Analytics Code",
	"desc" => "You can put your Google Analytics code or code from another tracking service here if you want.  It is automatically added to the footer. Just paste your code, without the <strong><script></script></strong> tags.",
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
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
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
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

 
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
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/includes/images/trans.gif" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
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
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
<div style="font-size:9px; margin-bottom:10px;">Icons: <a href="http://www.woothemes.com/2009/09/woofunction/" target="_blank">WooFunction</a></div>
<div style="font-size:9px; margin-bottom:10px;">Social Media Icons: <a href="http://www.komodomedia.com/blog/2009/06/social-network-icon-pack/" target="_blank">Komodo Media</a></div>
 </div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>