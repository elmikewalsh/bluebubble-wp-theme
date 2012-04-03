

<div id="sidebar">
             <?php if ( get_option('bb_old_menus') =='true' ) { ?>
                <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'main-nav', 'menu_class' => 'oldmenu', 'theme_location' => 'first-menu', 'depth' => '2' ) ); ?> 
                <?php }else{ ?>
                <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'main-nav', 'menu_class' => 'main-nav', 'theme_location' => 'first-menu', 'depth' => '2' ) ); ?>
			 <?php } // End check for old menu ?>
	<br />
		                           
            <?php if(is_page_template('portfolio.php')) :?>
            
            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Portfolio') ) ?>

            <?php elseif(is_page_template('blog.php')) :?>
            
            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog') ) ?>

            <?php elseif(is_page_template('contact.php')) :?>
            
            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Contact') ) ?>
            
   			<?php elseif ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Main') ) : ?>
            
					
<?php _e('<strong>Hi there.</strong> I am BlueBubble, a brand-new minimal y elegant Wordpress portfolio theme exclusively designed for <strong>you</strong>  <br /> - por <a href="http://www.thomasveit.com" target="_blank">Thomas Veit</a> with love on a Mac.', 'BlueBubble') ?>
<br />
<br />
<?php _e('<strong>New!</strong> BlueBubble 3.0, compatible with Wordpress 3.0, has been released. <strong>Version 3.0 Updates</strong> <br /> - by <a href="http://arte.dosmundoscafe.com" target="_blank">Mike Walsh</a> with love on a PC.', 'BlueBubble') ?>
<br />
<br />
<?php _e('You can place a widget here to remove the text above.', 'BlueBubble') ?>
<?php endif; ?>

<?php if (get_option('bb_twitter') == 'true' ) { ?>  
<hr class="divider" />
<div id="twitter_div">
<strong><?php _e('From Twitter', 'BlueBubble') ?></strong> 
    <ul id="twitter_update_list"></ul>  
</div> 
 
<?php } ?>

<?php if (get_option('bb_social') == 'true') { ?>
<hr class="divider" />            
<strong><?php _e('Other ways to reach me:', 'BlueBubble') ?></strong> <br /><br />

<ul class="social">
<?php if (get_option('bb_soc_fb') != '' ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_fb'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/facebook_32.png" /></a></li>
<?php } // End check for Social Badges ?> 	
<?php if ( get_option( 'bb_soc_tw' ) != '' ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_tw'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/twitter_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if (get_option('bb_soc_goo') != '' ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_goo'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/google_plus_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if (get_option('bb_soc_dri') != '' ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_dri'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/dribble_32.png" /></a></li>
<?php } // End check for Social Badges ?> 	 	
<?php if ( get_option( 'bb_soc_lnk' ) != '' ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_lnk'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/linkedin_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_beh' ) != '' ) { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_beh'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/behance_32.png" /></a></li>
<?php } // End check for Social Badges ?>	
<?php if ( get_option( 'bb_soc_de' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_de'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/delicious_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_dg' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_dg'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/digg_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_dva' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_dva'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/deviantart_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_ms' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_ms'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/myspace_32.png" /></a></li>
<?php } // End check for Social Badges ?>	
<?php if ( get_option( 'bb_soc_ev' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_ev'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/evernote_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_fl' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_fl'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/flickr_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_nv' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_nv'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/netvibes_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_or' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_or'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/orkut_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_re' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_re'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/reddit_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_sh' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_sh'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/sharethis_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_su' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_su'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/stumbleupon_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_te' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_te'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/technorati_32.png" /></a></li>
<?php } // End check for Social Badges ?>
<?php if ( get_option( 'bb_soc_tu' ) == 'true') { ?>
<li class="soc"><a href="<?php echo get_option('bb_soc_tu'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/social/tumblr_32.png" /></a></li>
<?php } // End check for Social Badges ?>


<?php } // End check for Social Sites section ?>


<?php $side_login = get_option('bb_login_menu'); if($side_login == 'true') {
echo '<hr class="divider" />';
global $user_login;
if (is_user_logged_in()) {
    echo __('Welcome, '), $user_login, '. </p><p><a href="/wp-admin/post-new.php" title="Write New Post">Write New Post</a><p><a href="/wp-admin/themes.php?page=bbframework" title="Admin Panel">Options Panel</a><p><a href="', wp_logout_url('index.php'), '" title="Logout">Logout</a></p>';
} else {
    wp_login_form();
}
?>

<?php } // End check for Login Menu ?>

</ul>
</div>
