<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>><head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

<!-- ** META TAGS ** -->

<meta name="description" content="<?php echo stripslashes (get_option('bb_seo_description')); ?>" />
<meta name="keywords" content="<?php echo stripslashes (get_option('bb_seo_keywords')); ?>" />
<meta name="designer" content="Thomas Veit, with Mike Walsh" />
<meta name="ROBOTS" content="ALL" />
<meta name="title" content="<?php wp_title(); ?>" />


<!-- ** Stylesheets ** -->
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory'); ?>/style.css" />
<?php if ( get_option('bb_alt_stylesheet') != ('light.css') ) { ?><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo get_option('bb_alt_stylesheet'); ?>" type="text/css" media="screen" /><?php } // Check for non-Default ?>

<!-- ** Javascript ** -->

<script type="text/javascript">
	var ajaxgifpath = '<?php bloginfo('template_directory'); ?>/images/loader.gif';
</script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/scripts/js.js"></script>
<?php if (is_page_template('contact.php')) { ?>
<?php } // Check for Contact Form Template ?>
<?php if (get_option('bb_no_tweet') != 'false') { ?><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<?php } // Check for Tweet Button Off ?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/scripts/colorbox.css" />
<?php if (get_option('bb_no_colorbox') != '1') { ?><script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/scripts/jquery.colorbox-min.js"></script><?php } // Check for Tweet Button Off ?>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/scripts/mag-hover.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				$("a[rel='project']").colorbox({rel:'nofollow'});
				});
		</script>      

<!-- ** Links ** -->

<link rel="shortcut icon" href="<?php echo get_option('bb_favicon'); ?>" type="image/x-icon"/>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body>



<div id="container">


<div id="header">
<div class="topmenu-left">
             <?php if ( get_option('bb_top_menu') =='true' ) { ?>
                <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'header-nav', 'theme_location' => 'fourth-menu', 'depth' => '1' ) ); ?>
			 <?php } elseif (is_page_template('portfolio-full.php')) { ?>
              <?php echo "<p class='nomenu'>"; echo __('Please create a menu in the <a href="/wp-admin/nav-menus.php">Admin Panel</a> and activate the menu in <a href="/wp-admin/themes.php?page=bbframework">Theme Options</a>.'); echo "</p>";
              } // End check for old menu ?>
</div> <!-- END .topmenu -->

        	<!-- BEGIN #logo -->
			<div class="logo">

				<?php /*
                    If "plain text logo" is set in theme options then use text
                    if a logo url has been set in theme options then use that
                    if none of the above then use the default logo.png */
                    if (get_option('bb_plain_logo') == 'true') { ?>
                    <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
                    <p id="tagline"><?php bloginfo( 'description' ); ?></p>
                    <?php } elseif (get_option('bb_logo')) { ?>
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('bb_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
                    <?php } else { ?>
                            <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
                    <?php } ?>
          
			<!-- END #logo -->
			</div>

</div> <!-- END #header -->

