<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title>Oops! 404 Error</title>

<!-- ** META TAGS ** -->

<meta name="description" content="<?php echo stripslashes (get_option('bb_seo_description')); ?>" />
<meta name="keywords" content="<?php echo stripslashes (get_option('bb_seo_keywords')); ?>" />
<meta name="designer" content="Thomas Veit, with Mike Walsh" />
<meta name="ROBOTS" content="ALL" />
<meta name="title" content="<?php wp_title(); ?>" />


<!-- ** Stylesheets ** -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/css/404.css" rel="stylesheet" type="text/css" />

<!-- ** Links ** -->

<link rel="shortcut icon" href="<?php echo get_option('bb_favicon'); ?>"/>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
</head>

<body>
	<div id="wrapper">
		<img src="<?php bloginfo('template_directory'); ?>/images/404.png" alt="404 Error Oops!" title="404 Error Oops!" />
		<h1 class="loud">Sorry! Your page is very lost!</h1>
		<p class="loud">You are looking for a page or file which wandered off on its own...they sometimes have a habit of doing that.</p>
		<p class="small">Here are a few options to find what you are looking for.</p>
		<ol>
			<li><span>Cry and scream like a little child.</span></li>
			<li><span>Double check the web address for typos.</span></li>
			<li><span>Head back to our home page via the navigation below:</a></span></li>
		</ol>
		<ul>
<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => '404-nav', 'theme_location' => 'third-menu' ) ); ?>
		</ul>
	</div><!-- end div #wrapper -->
</body>
</html>