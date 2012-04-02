<?php
/*
Plugin Name: Update Notify
Plugin URI: http://jameslao.com
Description: Notifies you when there is a new theme update.
Version: 1.0
Author: James Lao
Author URI: http://jameslao.com
*/

define('UN_UPDATE_URL', 'http://bluebubble.dosmundoscafe.com/versions.txt');

add_action('admin_init', 'un_periodic_update');

function un_periodic_update() {
  $last_update = get_option('un_last_update');
  $one_minute_ago = strtotime('-1 minute');

  // $last_update is false if this is the first time running
  if ( $last_update === false || $last_update < $one_minute_ago ) {
    un_check_for_update();
    update_option('un_last_update', time());
  }

  $current_theme = get_current_theme();
  $current_version = un_get_current_version($current_theme);

  if ( $last_update === false )
    add_option('un_latest_version', $current_version);
  
  $latest_version = get_option('un_latest_version');
  $compare = un_compare_versions($current_version, $latest_version);

  if ( $compare < 0 )
    un_display_notice();
}


function un_get_update_info() {
  $response = wp_remote_get(UN_UPDATE_URL);
  if ( $response['response']['code'] != 200 )
    return false;
  $response = $response['body'];


  $lines = split("\n", trim($response));
  $info = array();
  foreach ( $lines as $line ) {
    $tmp = split(',', $line);
    $info[$tmp[0]] = un_parse_version_str($tmp[1]);
  }
  return $info;
}

function un_check_for_update() {
  $info = un_get_update_info();
  if ( $info === false )
    return;
  $current_theme = get_current_theme();

  if ( array_key_exists($current_theme, $info) ) {
    $latest_version = $info[$current_theme];
    update_option('un_latest_version', $latest_version);
  }
}


function un_display_notice() {
  add_action('admin_notices', 'un_admin_notice');
}


function un_get_current_version($name) {
  $theme_info = get_theme($name);
  return un_parse_version_str($theme_info['Version']);
}


function un_admin_notice() {
  $theme_name = get_current_theme();
  $version = $themes[$current_theme]['Version'];
?>
<div class="error fade">
	<p><?php _e('There is a newer version of', 'BlueBubble') ?> <?php echo $theme_name; ?> <?php _e('available. Go to the', 'BlueBubble') ?> <a href="http://bluebubble.dosmundoscafe.com/downloads/" target="_blank"><?php _e('BlueBubble 3.0 Theme Page', 'BlueBubble') ?></a> <?php _e('or the <a href="http://www.flexible7.com/" target="_blank">Flexible 7</a> website', 'BlueBubble') ?> <?php _e('to download the latest version.', 'BlueBubble') ?></p>
</div>
<?php
}


function un_parse_version_str($str) {
  return split('\.', trim($str));
}


function un_get_version_str($v) {
  return join('.', $v);
}


function un_compare_versions($v1, $v2) {
  $v1 = un_remove_trailing_zeroes($v1);
  $v2 = un_remove_trailing_zeroes($v2);
  $v1_count = count($v1);
  $v2_count = count($v2);
  $count = min($v1_count, $v2_count);

  for ($i = 0; $i < $count; $i++) {
    if ( $v1[$i] > $v2[$i] )
      return 1;
    elseif ( $v1[$i] < $v2[$i] )
      return -1;
  }

  // Compare number of decimal points
  if ( $v1_count > $v2_count )
    return 1;
  elseif ( $v1_count < $v2_count )
    return -1;
  else
    return 0;
}


function un_remove_trailing_zeroes($v) {
  $size = count($v);
  if ( $size <= 0 ) return $v;
  for ($i = $size-1; $i >= 0 && $v[$i] == 0; $i--)
      array_pop($v);
  return $v;
}


// Everything after this point is for debugging.

/*

function un_admin() {
?>
  <div class='wrap'>
    <h2>Foobar</h2>
    <pre style='background: #eee; border: 1px solid #aaa; padding: 10px;'>
<?php un_unit_tests(); ?>
<?php
$request = wp_remote_get(UN_UPDATE_URL);
var_dump($request);
?>
    </pre>
  </div>
<?php
}

add_action('admin_menu', "un_admin_init");


function un_admin_init() {
	add_options_page('Update Notify', 'Update Notify', 8, 'un_admin', 'un_admin');
}


function un_unit_tests() {
  $current = un_parse_version_str("1.0.1");
  $latest = un_parse_version_str("2.0.2.1");
  $old = un_parse_version_str("1.0");
  $mid = un_parse_version_str("2.0");

  echo "Running unit tests\n";
  echo "==================\n";
  un_assert("1.0.1 should be less than 2.0", un_compare_versions($current, $latest) < 0 );
  un_assert("2.0 should be greater than 1.0.1", un_compare_versions($latest, $current) > 0 );
  un_assert("1.0.1 should be greater than 1.0", un_compare_versions($current, $old) > 0 );
  un_assert("1.0 should be less than 1.0.1", un_compare_versions($old, $current) < 0 );
  un_assert("1.0.1 should be equal to 1.0.1", un_compare_versions($latest, $latest) == 0 );
  un_assert("2.0.2.1 should be greater than 2.0", un_compare_versions($latest, $mid) > 0 );
  un_assert("2.0 should be less than 2.0.2.1", un_compare_versions($mid, $latest) < 0 );

  $v1 = un_parse_version_str("1.2.0.0");
  echo "Before remove_trailing_zeroes = " . un_get_version_str($v1) . "\n";
  $v1 = un_remove_trailing_zeroes($v1);
  echo "After remove_trailing_zeroes = " . un_get_version_str($v1) . "\n";

  $v2 = un_parse_version_str("1.2.0.0.1");
  echo "Before remove_trailing_zeroes = " . un_get_version_str($v2) . "\n";
  $v2 = un_remove_trailing_zeroes($v2);
  echo "After remove_trailing_zeroes = " . un_get_version_str($v2) . "\n";

  $last_update = get_option('un_last_update');
  echo 'Last updated at ' . date('r', $last_update) . "\n";
  echo 'Current time: ' . date('r') . "\n";

  $latest_version = get_option('un_latest_version');
  echo 'Latest version in database: ' . un_get_version_str($latest_version) . "\n";
}


function un_assert($msg, $assert) {
  if ( !$assert )
    echo $msg . "\n";
  else
    echo "Passed!\n";
}

*/

?>
