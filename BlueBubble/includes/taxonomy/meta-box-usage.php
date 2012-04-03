<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value instead of boolean as before
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */

/********************* BEGIN EXTENDING CLASS ***********************/

/**
 * Extend bb_Meta_Box class
 * Add field type: 'taxonomy'
 */
class bb_Meta_Box_Taxonomy extends bb_Meta_Box {
	
	function add_missed_values() {
		parent::add_missed_values();
		
		// add 'multiple' option to taxonomy field with checkbox_list type
		foreach ($this->_meta_box['fields'] as $key => $field) {
			if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) {
				$this->_meta_box['fields'][$key]['multiple'] = true;
			}
		}
	}
	
	// show taxonomy list
	function show_field_taxonomy($field, $meta) {
		global $post;
		
		if (!is_array($meta)) $meta = (array) $meta;
		
		$this->show_field_begin($field, $meta);
		
		$options = $field['options'];
		$terms = get_terms($options['taxonomy'], $options['args']);
		
		// checkbox_list
		if ('checkbox_list' == $options['type']) {
			foreach ($terms as $term) {
				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";
			}
		}
		// select
		else {
			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";
		
			foreach ($terms as $term) {
				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";
			}
			echo "</select>";
		}
		
		$this->show_field_end($field, $meta);
	}
}

/********************* END EXTENDING CLASS ***********************/

/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_bb_';
// you also can make prefix empty to disable it
$prefix = 'bb_';

$meta_boxes = array();


// Portfolio item options
$meta_boxes[] = array(
'id' => 'project-url',// meta box id, unique per meta box
'title' => __('Project Details'),// meta box title
'pages' => array('project', 'post'),// post types, accept custom post types as well, default is array('post'); optional
'context' => 'normal',// where the meta box appear: normal (default), advanced, side; optional
'priority' => 'high',// order of meta box: high (default), low; optional

'fields' => array(// list of meta fields
array(
'name' => __('Client\'s Website URL'),
'desc' =>  __('URL of the client\'s website such as http://www.websitename.com Please leave blank if the website is currently incomplete.'), // field description, optional
'id' => $prefix . 'port_client_url', // field id, i.e. the meta key
'type' => 'text', // text box
'style' => 'width: 100px', // custom style for field, added in v3.1
),

		array(
			'name' => __('Project Date'),
			'desc' =>  __('The year the project was finished.'), // field description, optional
			'id' => $prefix . 'port_client_date', // field id, i.e. the meta key
			'type' => 'text', // text box
			'style' => 'width: 100px', // custom style for field, added in v3.1
),
)
);



foreach ($meta_boxes as $meta_box) {
	new bb_Meta_Box_Taxonomy($meta_box);
}

/********************* END DEFINITION OF META BOXES ***********************/

/********************* BEGIN VALIDATION ***********************/

/**
 * Validation class
 * Define ALL validation methods inside this class
 * Use the names of these methods in the definition of meta boxes (key 'validate_func' of each field)
 */
class bb_Meta_Box_Validate {
	function check_name($text) {
		if ($text == 'Anh Tran') {
			return 'He is Rilwis';
		}
		return $text;
	}
}

/********************* END VALIDATION ***********************/
?>
