<?php

/*-----------------------------------------------------------------------------------*/
/* Head Hook
/*-----------------------------------------------------------------------------------*/

function bb_head() { do_action( 'bb_head' ); }


/*-----------------------------------------------------------------------------------*/
/* Get the style path currently selected */
/*-----------------------------------------------------------------------------------*/

function bb_style_path() {
    $style = $_REQUEST['style'];
    if ($style != '') {
        $style_path = $style;
    } else {
        $stylesheet = get_option('bb_alt_stylesheet');
        $style_path = str_replace(".css","",$stylesheet);
    }
    if ($style_path == "default")
      echo 'images';
    else
      echo 'styles/'.$style_path;
}


/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/

if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	//Call action that sets
	add_action('admin_head','bb_option_setup');
}

function bb_option_setup(){

	//Update EMPTY options
	$bb_array = array();
	add_option('bb_options',$bb_array);

	$template = get_option('bb_template');
	$saved_options = get_option('bb_options');
	
	foreach($template as $option) {
		if($option['type'] != 'heading'){
			$id = $option['id'];
			$std = $option['std'];
			$db_option = get_option($id);
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$bb_array[$c_id] = $c_std; 
					}
				} else {
					update_option($id,$std);
					$bb_array[$id] = $std;
				}
			}
			else { //So just store the old values over again.
				$bb_array[$id] = $db_option;
			}
		}
	}
	update_option('bb_options',$bb_array);
}


/*-----------------------------------------------------------------------------------*/
/* Admin Backend */
/*-----------------------------------------------------------------------------------*/

function bbframework_admin_head() { 
	
	//Tweaked the message on theme activate
	?>
    <script type="text/javascript">
    jQuery(function(){
	var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=bbframework'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
}

add_action('admin_head', 'bbframework_admin_head'); 

?>