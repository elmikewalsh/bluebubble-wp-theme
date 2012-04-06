<?php

/*-----------------------------------------------------------------------------------*/
/* Basic Theme Options and Definitions
/*-----------------------------------------------------------------------------------*/

add_action('init','bb_options');

if (!function_exists('bb_options')) {
function bb_options(){

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'BlueBubble', TEMPLATEPATH . '/languages' );
	
// VARIABLES
$themename = "BlueBubble";
$shortname = "bb";

// Populate option in array for use in theme
global $bb_options;
$bb_options = get_option('bb_options');

$GLOBALS['template_path'] = BB_DIRECTORY;

//Access the WordPress Categories via an Array
$bb_categories = array();  
$bb_categories_obj = get_categories('hide_empty=0');
foreach ($bb_categories_obj as $bb_cat) {
    $bb_categories[$bb_cat->cat_ID] = $bb_cat->cat_name;}
$categories_tmp = array_unshift($bb_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$bb_pages = array();
$bb_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($bb_pages_obj as $bb_page) {
    $bb_pages[$bb_page->ID] = $bb_page->post_name; }
$bb_pages_tmp = array_unshift($bb_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five");
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//Stylesheets Reader
$alt_stylesheet_path = bb_FILEPATH . '/css/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('bb_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
$my_options_dash = array('bb_dash_rightnow' => "Right Now","bb_dash_comments" => "Two","bb_dash_links" => "Three","bb_dash_plugins" => "Four","bb_dash_quickpress" => "Five","bb_dash_drafts" => "Five","bb_dash_primary" => "Five","bb_dash_secondary" => "Five");




/*-----------------------------------------------------------------------------------*/
/* Here are all the options for the Options Panel
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
$options = array();


$options[] = array( "name" => __('General Settings', 'BlueBubble'),
                    "type" => "heading");  

$options[] = array( "name" => __('Custom Logo', 'BlueBubble'),
					"desc" => __('Upload a logo for your theme, or specify the image address of your online logo. (http://example.com/logo.png)','BlueBubble'),
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => __('Custom Favicon', 'BlueBubble'),
					"desc" => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.','BlueBubble'),
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload");
                    
$options[] = array( "name" => __('Enable Plain Text Logo', 'BlueBubble'),
					"desc" => __('Check this to enable a plain text logo rather than an image.','BlueBubble'),
					"id" => $shortname."_plain_logo",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => __('GZIP Web Pages', 'BlueBubble'),
					"desc" => __('This option will compress your webpages so that they load faster. Depending on your server, it may cause errors. (it is turned off by default)','BlueBubble'),
					"id" => $shortname."_gzip_page",
					"std" => "false",
					"type" => "checkbox");
                    
$options[] = array( "name" => __('Disable Post Formats','BlueBubble'),
					"desc" => __('Custom Post Formats <strong>(aside, gallery, link, image, quote, audio, video)</strong> appear when creating a new Post. They are activated in BlueBubble by default. If you want to <strong>turn them off</strong>, check this box.','BlueBubble'),
					"id" => $shortname."_post_formats",
					"std" => "",
					"type" => "checkbox");
					
$options[] = array( "name" => __("Feedburner URL", 'BlueBubble'),
					"desc" => __("Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website", 'BlueBubble'),
					"id" => $shortname."_feedburner",
					"type" => "text",
					"std" => get_bloginfo('rss2_url'));

$options[] = array( "name" => __("Footer copyright text", 'BlueBubble'),
					"desc" => __("Enter text used in the left side of the footer. It can be HTML.", 'BlueBubble'),
					"id" => $shortname."_footer_text",
					"type" => "textarea",
					"std" => "");
	
$options[] = array( "name" => __("Google Analytics Code", 'BlueBubble'),
					"desc" => __("You can put your Google Analytics code or code from another tracking service here if you want.  It is automatically added to the footer. Just paste your code, without the &lt;script&gt;&lt;/script&gt; tags.", 'BlueBubble'),
					"id" => $shortname."_ga_code",
					"type" => "textarea",
					"std" => "");					
					
										
					
$options[] = array( "name" => __('Layout','BlueBubble'),
					"type" => "heading");
					
$options[] = array( "name" => __('Theme Stylesheet','BlueBubble'),
					"desc" => __('Select your themes alternative color scheme.','BlueBubble'),
					"id" => $shortname."_alt_stylesheet",
					"std" => "light.css",
					"type" => "select",
					"options" => array('light.css', 'dark.css'));
	
/*$url = bb_DIRECTORY . '/admin/images/';
$options[] = array( "name" => __('Main Layout','BlueBubble'),
					"desc" => __('Select main content and sidebar alignment.','BlueBubble'),
					"id" => $shortname."_layout",
					"std" => "layout-2cr",
					"type" => "images",
					"options" => array(
						'layout-2cr' => $url . '2cr.png',
						'layout-2cl' => $url . '2cl.png')
					);*/
					
$options[] = array( "name" => __("Sidebar Login", 'BlueBubble'),
					"desc" => __('Check if you want to <strong>turn on</strong> a login form in the sidebar','BlueBubble'),
					"id" => $shortname."_login_menu",
					"std" => "",
					"type" => "checkbox");

$options[] = array( "name" => __("Horizontal Top Menu", 'BlueBubble'),
	"desc" => __("Check if you want a horizontal menu on the top-right of your website, to the right of the logo.", 'BlueBubble'),
	"id" => $shortname."_top_menu",
	"type" => "checkbox",
	"std" => "");
	
$options[] = array( "name" => __("Legacy Menu Style", 'BlueBubble'),
	"desc" => __("Check if you want to <strong>turn on</strong> the old BlueBubble navigation menu style, used before BlueBubble 3.0", 'BlueBubble'),
	"id" => $shortname."_old_menus",
	"type" => "checkbox",
	"std" => "");

$options[] = array( "name" => __("Custom Login", 'BlueBubble'),
	"desc" => __("Check if you want to <strong>turn on</strong> a custom login screen. (replaces default Wordpress login screen.)", 'BlueBubble'),
	"id" => $shortname."_custom_login",
	"type" => "checkbox",
	"std" => "");
					
$options[] = array( "name" => __('Custom CSS','BlueBubble'),
                    "desc" => __('Quickly add some CSS to your theme by adding it to this block.','BlueBubble'),
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");



$options[] = array( "name" => __('WP Dashboard','BlueBubble'),
					"type" => "heading");					

$options[] = array( "name" => __("Remove All Dashboard Widgets", 'BlueBubble'),
                    "desc" => __("Selecting this option will remove <strong>all</strong> the widgets from the Wordpress Dashboard", 'BlueBubble'),
                    "id" => $shortname."_dash_all",
                    "type" => "checkbox",
                    "std" => "");

$options[] = array( "name" => __("Remove <em>Right Now</em> Dashboard Widget", 'BlueBubble'),
                    "desc" => __("Selecting this option will remove the <strong>Right Now</strong> Widget from the Wordpress Dashboard", 'BlueBubble'),
                    "id" => $shortname."_dash_rightnow",
                    "type" => "checkbox",
                    "std" => "");

$options[] = array( "name" => __("Remove <em>Recent Comments</em> Dashboard Widget", 'BlueBubble'),
                    "desc" => __("Selecting this option will remove the <strong>Recent Comments</strong> Widget from the Wordpress Dashboard", 'BlueBubble'),
                    "id" => $shortname."_dash_comments",
                    "type" => "checkbox",
                    "std" => "");

$options[] = array( "name" => __("Remove <em>Incoming Links</em> Dashboard Widget", 'BlueBubble'),
                    "desc" => __("Selecting this option will remove the <strong>Incoming Links</strong> Widget from the Wordpress Dashboard", 'BlueBubble'),
                    "id" => $shortname."_dash_links",
                    "type" => "checkbox",
                    "std" => "");

$options[] = array( "name" => __("Remove <em>Plugins</em> Dashboard Widget", 'BlueBubble'),
                    "desc" => __("Selecting this option will remove the <strong>Plugins</strong> Widget from the Wordpress Dashboard", 'BlueBubble'),
                    "id" => $shortname."_dash_plugins",
                    "type" => "checkbox",
                    "std" => "");

$options[] = array( "name" => __("Remove <em>Quick Press</em> Dashboard Widget", 'BlueBubble'),
                    "desc" => __("Selecting this option will remove the <strong>Quick Press</strong> Widget from the Wordpress Dashboard", 'BlueBubble'),
                    "id" => $shortname."_dash_quickpress",
                    "type" => "checkbox",
                    "std" => "");

$options[] = array( "name" => __("Remove <em>Recent Drafts</em> Dashboard Widget", 'BlueBubble'),
                    "desc" => __("Selecting this option will remove the <strong>Recent Drafts</strong> Widget from the Wordpress Dashboard", 'BlueBubble'),
                    "id" => $shortname."_dash_drafts",
                    "type" => "checkbox",
                    "std" => "");

$options[] = array( "name" => __("Remove <em>Wordpress Blog</em> Dashboard Widget", 'BlueBubble'),
                    "desc" => __("Selecting this option will remove the <strong>Wordpress Blog</strong> Widget from the Wordpress Dashboard", 'BlueBubble'),
                    "id" => $shortname."_dash_primary",
                    "type" => "checkbox",
                    "std" => "");

$options[] = array( "name" => __("Remove <em>Other Wordpress News</em> Dashboard Widget", 'BlueBubble'),
                    "desc" => __("Selecting this option will remove the <strong>Other Wordpress News</strong> Widget from the Wordpress Dashboard", 'BlueBubble'),
                    "id" => $shortname."_dash_secondary",
                    "type" => "checkbox",
                    "std" => "");
					

/*$options[] = array( "name" => __("Remove <em>Recent Comments</em> Dashboard Widget", 'BlueBubble'),
					"desc" => __("Selecting this option will remove the <strong>Recent Comments</strong> Widget from the Wordpress Dashboard", 'BlueBubble'),
					"id" => $shortname."_dash_turnoff",
					"std" => "",
				  	"type" => "multicheck",
					"options" => $my_options_dash);
*/					



$options[] = array( "name" => __('Portfolio','BlueBubble'),
					"type" => "heading");					

$options[] = array( "name" => __("Portfolio Category", 'BlueBubble'),
	"desc" => __("Enter the name of the Portfolio category. (you must create categories before they will show up in the list.)", 'BlueBubble'),
	"id" => $shortname."_portfolio_cat",
	"type" => "select",
	"options" => $bb_categories,
	"std" => __("Choose a category for your portfolio.", 'BlueBubble'));

$options[] = array( "name" => __("Portfolio Items Per Page", 'BlueBubble'),
	"desc" => __("How many portfolio items do you want to show on each page? (default is 6)", 'BlueBubble'),
	"id" => $shortname."_portfolio_num",
	"type" => "text",
	"std" => "");

$options[] = array( "name" => __("Entries disable?", 'BlueBubble'),
	"desc" => __("Check if you want to disable the entries that appear below the title and thumbnails on the portfolio page.", 'BlueBubble'),
	"id" => $shortname."_no_entry",
	"type" => "checkbox",
	"std" => "");

$options[] = array( "name" => __("Comments disable?", 'BlueBubble'),
	"desc" => __("Check if you want to disable comments on portfolio items.", 'BlueBubble'),
	"id" => $shortname."_comments",
	"type" => "checkbox",
	"std" => "");

$options[] = array( "name" => __("Turn Off Lightbox?", 'BlueBubble'),
	"desc" => __("Check if you want to <strong>turn off</strong> the Colorbox popup that appears when clicking an image on your portfolio page. (if turned off, clicking the image will take you to the single portfolio page with the larger image)", 'BlueBubble'),
	"id" => $shortname."_no_colorbox",
	"type" => "checkbox",
	"std" => "");
	
	
	
$options[] = array( "name" => __('Blog and Posts','BlueBubble'),
					"type" => "heading");	
	
$options[] = array( "name" => __("Blog Parent Category", 'BlueBubble'),
	"desc" => __("Enter the name of the Portfolio category. (you must create categories before they will show up in the list.)", 'BlueBubble'),
	"id" => $shortname."_blog_cat",
	"type" => "select",
	"options" => $bb_categories,
	"std" => __("Choose a category for your blog.", 'BlueBubble'));

$options[] = array( "name" => __("Blog Items Per Page", 'BlueBubble'),
	"desc" => __("How many blog items do you want to show on each page?", 'BlueBubble'),
	"id" => $shortname."_blog_num",
	"type" => "text",
	"std" => "");
	
/*$options[] = array( "name" => __("Oldest Posts First?", 'BlueBubble'),
	"desc" => __("BlueBubble 3.0 normally displays posts from newest to oldest. Check if you want to show oldest posts first. (Note: This will only change blog posts, not portfolio posts order)", 'BlueBubble'),
	"id" => $shortname."_post_order",
	"type" => "checkbox",
	"std" => "");*/

$options[] = array( "name" => __("Show Date Updated?", 'BlueBubble'),
	"desc" => __("Check this if you would like the <strong>last date updated</strong> to appear on Blog posts.", 'BlueBubble'),
	"id" => $shortname."_last_updated",
	"type" => "checkbox",
	"std" => "");
	
$options[] = array( "name" => __("Show Tweet Buttons?", 'BlueBubble'),
	"desc" => __("Check if you want to show the Twitter <strong>Tweet</strong> buttons that appear on posts and pages. (The buttons do not appear by default)", 'BlueBubble'),
	"id" => $shortname."_post_tweet",
	"type" => "checkbox",
	"std" => "");

$options[] = array( "name" => __("Show Google+ Buttons?", 'BlueBubble'),
	"desc" => __("Check if you want to show the <strong>Google+</strong> buttons that appear on posts and pages. (The buttons do not appear by default)", 'BlueBubble'),
	"id" => $shortname."_post_google",
	"type" => "checkbox",
	"std" => "");


$options[] = array( "name" => __('Twitter','BlueBubble'),
					"type" => "heading");

$options[] = array( "name" => __("Show Twitter Stream?", 'BlueBubble'),
	"desc" => __("Check if you want to show Twitter your stream. It will appear in the left sidebar above <strong>Other ways to reach me: </strong> (you must indicate your Twitter username in the next field)", 'BlueBubble'),
	"id" => $shortname."_twitter",
	"type" => "checkbox",
	"std" => "");

$options[] = array( "name" => __("Twitter Username", 'BlueBubble'),
	"desc" => __("Enter your Twitter username. In addition to the Twitter stream, your username will be used with the <strong>Tweet Button</strong> located on most pages. (you must check the box in the field above for your Twitter stream to show)", 'BlueBubble'),
	"id" => $shortname."_twitter_name",
	"type" => "text",
	"std" => "");

$options[] = array( "name" => __("Number of Twitter Feeds", 'BlueBubble'),
	"desc" => __("How many Twitter entries do you want to show? (default is 2; more than 5 is not recommended)", 'BlueBubble'),
	"id" => $shortname."_twitter_num",
	"type" => "text",
	"std" => "");

	

/*$options[] = array( "name" => __('Contact Form','BlueBubble'),
					"type" => "heading");
	
$options[] = array( "name" => __("Contact Form Email Address", 'BlueBubble'),
	"desc" => __("Where do you want the emails from the contact form to arrive? Place that email address here. (if no email address is entered, email will automatically be sent to the administrator email address)", 'BlueBubble'),
	"id" => $shortname."_contact_email",
	"type" => "text",
	"std" => "");

$options[] = array( "name" => __("<strong>Email Subject</strong>", 'BlueBubble'),
	"desc" => __("You can define here the subject of the emails sent from the website Contact Form.", 'BlueBubble'),
	"id" => $shortname."_email_subject",
	"type" => "text",
	"std" => "");

$options[] = array( "name" => __("General error message", 'BlueBubble'),
	"desc" => __("Write a custom error message to display if there is an error in general. (if no message is entered, the default message - <strong>There is an error</strong> - will be displayed)", 'BlueBubble'),
	"id" => $shortname."_general_error",
	"type" => "text",
	"std" => "");		

$options[] = array( "name" => __("Thank You message", 'BlueBubble'),
	"desc" => __("Write a custom error message to display if the message is successfully sent. (if no message is entered, the default message - <strong>Thank you for your message</strong> - will be displayed)", 'BlueBubble'),
	"id" => $shortname."_thanks_message",
	"type" => "text",
	"std" => "");		

$options[] = array( "name" => __("<strong>Name</strong> error message", 'BlueBubble'),
	"desc" => __("Write a custom error message to display if there is an error with the <strong>Name</strong> field of the Contact Form. (if no message is entered, the default message - <strong>Please enter your name</strong> - will be displayed)", 'BlueBubble'),
	"id" => $shortname."_name_error",
	"type" => "text",
	"std" => __("Please enter your name"));		

$options[] = array( "name" => __("<strong>Email</strong> error message", 'BlueBubble'),
	"desc" => __("Write a custom error message to display if there is an error with the <strong>Email</strong> field of the Contact Form. (if no message is entered, the default message - <strong>Please enter your email</strong> - will be displayed)", 'BlueBubble'),
	"id" => $shortname."_email_error",
	"type" => "text",
	"std" => __("Please enter your email address."));				

$options[] = array( "name" => __("<strong>Message</strong> error message", 'BlueBubble'),
	"desc" => __("Write a custom error message to display if there is an error with the <strong>Message</strong> field of the Contact Form. (if no message is entered, the default message - <strong>Please enter your message</strong> - will be displayed)", 'BlueBubble'),
	"id" => $shortname."_message_error",
	"type" => "text",
	"std" => __("Please enter a message."));*/				



$options[] = array( "name" => __('Social Icons','BlueBubble'),
					"type" => "heading");
						
$options[] = array( "name" => __("Show Social Sites Section", 'BlueBubble'),
	"desc" => __("Check if you want to show links to sites such as Facebook, Twitter, etc. It will appear in the left sidebar with the header <strong>Other ways to reach me: </strong>", 'BlueBubble'),
	"id" => $shortname."_social",
	"type" => "checkbox",
	"std" => "");


$options[] = array( "name" => __("Facebook Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Facebook page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_fb",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => __("Twitter Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Twitter page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_tw",
	"type" => "text",
	"std" => "");

$options[] = array( "name" => __("Google+ Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Google+ page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_goo",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => __("LinkedIn Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your LinkedIn page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_lnk",
	"type" => "text",
	"std" => "");


$options[] = array( "name" => __("Dribble Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Dribble page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_dri",
	"type" => "text",
	"std" => "");

$options[] = array( "name" => __("Behance Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Behance page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_beh",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => __("Delicious Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Delicious page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_de",
	"type" => "text",
	"std" => "");
		
$options[] = array( "name" => __("Digg Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Digg page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_dg",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => __("DeviantArt Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your DeviantArt page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_dva",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => __("MySpace Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your MySpace page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_ms",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => __("Evernote Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Evernote page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_ev",
	"type" => "text",
	"std" => "");

$options[] = array( "name" => __("Flickr Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Flickr page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_fl",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => __("Netvibes Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Netvibes page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_nv",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => __("Orkut Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Orkut page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_or",
	"type" => "text",
	"std" => "");

$options[] = array( "name" => __("Reddit Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Reddit page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_re",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => __("ShareThis Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your ShareThis page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_sh",
	"type" => "text",
	"std" => "");
		
$options[] = array( "name" => __("StumbleUpon Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your StumbleUpon page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_su",
	"type" => "text",
	"std" => "");

$options[] = array( "name" => __("Technorati Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Technorati page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_te",
	"type" => "text",
	"std" => "");

$options[] = array( "name" => __("Tumblr Social Link", 'BlueBubble'),
	"desc" => __("If you would like a link to your Tumblr page, paste the URL here. (<strong>Note:</strong> Enter complete URL, like: <strong>http://www.twitter.com/username</strong>)", 'BlueBubble'),
	"id" => $shortname."_soc_tu",
	"type" => "text",
	"std" => "");
	
	
	
$options[] = array( "name" => __('SEO','BlueBubble'),
					"type" => "heading");

$options[] = array( "name" => __("Meta Tag: Description", 'BlueBubble'),
	"desc" => __("The meta tag <strong>description</strong> is found in the header of your webpages and is used by search engines (i.e. Google) to rank and describe your site. Write an overall brief description of your site here.", 'BlueBubble'),
	"id" => $shortname."_seo_description",
	"type" => "textarea",
	"std" => "");

$options[] = array( "name" => __("Meta Tag: Keywords", 'BlueBubble'),
	"desc" => __("The meta tag <strong>keywords</strong> is found in the header of your webpages and is used by search engines (i.e. Google) to rank and describe your site. List here the keywords that describe your site. <strong>(Example: Blue,Bubble,portfolio,theme)</strong>", 'BlueBubble'),
	"id" => $shortname."_seo_keywords",
	"type" => "textarea",
	"std" => "");
	

update_option('bb_template',$options); 					  
update_option('bb_themename',$themename);   
update_option('bb_shortname',$shortname);

}
}
?>
