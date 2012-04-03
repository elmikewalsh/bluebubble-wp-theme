<?php


/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS from theme options
/*-----------------------------------------------------------------------------------*/

function bb_head_css() {

		$shortname =  get_option('bb_shortname'); 
		$output = '';
		
		$custom_css = get_option('bb_custom_css');
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
	
}

add_action('wp_head', 'bb_head_css');



/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function bb_favicon() {
	$shortname = get_option('bb_shortname');
	if (get_option($shortname . '_custom_favicon') != '') {
	echo '<link rel="shortcut icon" href="'. get_option('bb_custom_favicon') .'"/>'."\n";
	}
	else { ?>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico" />
	<?php }
}

add_action('wp_head', 'bb_favicon');



/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function bb_analytics(){
	$shortname =  get_option('bb_shortname');
	$output = get_option($shortname . '_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','bb_analytics');



// 



?>
