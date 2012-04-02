<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<div id="sidebar">
	
		<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'main-nav', 'menu_class' => 'main-nav', 'theme_location' => 'first-menu', 'depth' => '2' ) ); ?>
	<br />
		
<hr class="divider" />	
	<?php 	/* Widgetized sidebar */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
					
		<b>Hi there.</b> I am BlueBubble, a brand-new minimal &amp; elegant wordpress portfolio theme 
		exclusivey designed for <strong>you</strong> <br /> - by <a href="http://www.thomasveit.com">Thomas Veit</a> with love on Mac. <br />
<br />
<strong>New!</strong> BlueBubble 3.0, compatible with Wordpress 3.0, has been released. <strong>Version 3.0 Updates</strong> <br /> - by <a href="http://arte.dosmundoscafe.com" target="_blank">Mike Walsh</a> with love on a PC.
<br />
<br />
You can place a widget here to remove the text above.
<?php endif; ?>

<?php if (get_option('bb_twitter') ) { ?>  
<hr class="divider" />
<div id="twitter_div">
<strong>From Twitter</strong> 
    <ul id="twitter_update_list"></ul>  
</div> 
 
<?php } ?>

<?php if (get_option('bb_social') ) { ?>
<hr class="divider" />            
<strong>Other ways to reach me:</strong> <br /><br />


<ul class="social">
<?php if ( get_option( 'bb_soc_fb' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_fb'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/facebook_32.png" /></a></li>
<?php } // End check for Social Badges ?> 	
<?php if ( get_option( 'bb_soc_tw' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_tw'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/twitter_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_lnk' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_lnk'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/linkedin_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_de' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_de'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/delicious_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_dg' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_dg'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/digg_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_dva' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_dva'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/deviantart_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_ms' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_ms'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/myspace_32.png" /></a></li>
<?php } // End check for Social Badges ?>	
<?php if ( get_option( 'bb_soc_ev' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_ev'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/evernote_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_fl' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_fl'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/flickr_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_nv' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_nv'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/netvibes_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_or' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_or'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/orkut_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_re' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_re'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/reddit_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_sh' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_sh'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/sharethis_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_su' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_su'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/stumbleupon_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_te' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_te'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/technorati_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_tu' ) ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_tu'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/tumblr_32.png" /></a></li>
<?php } // End check for Social Badges ?>	

<?php } // End check for Social Sites section ?>
</ul>
</div>
