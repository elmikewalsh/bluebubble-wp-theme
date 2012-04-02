<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<?php if ( get_option('bb_color_scheme') != ('light gray (default)') ) { ?><link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory'); ?>/css/<?php echo get_option('bb_color_scheme'); ?>.css" /><?php } // Check for non-Default ?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/scripts/colorbox.css" />


<!-- ** Javascript ** -->

<script type="text/javascript">
	var ajaxgifpath = '<?php bloginfo('template_directory'); ?>/images/loader.gif';
</script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/scripts/js.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/scripts/contact-form.js"></script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<?php if (get_option('bb_no_colorbox') == '') { ?><script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/scripts/jquery.colorbox-min.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				$("a[rel='project']").colorbox({rel:'nofollow'});
				});
		</script>
<?php } // Check for Colorbox Off ?>        

<!-- ** Links ** -->

<link rel="shortcut icon" href="<?php echo get_option('bb_favicon'); ?>"/>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body>

<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<div id="container">


<div id="header">
		<a class="homelink" title="<?php echo bloginfo('blog_name'); ?>" href="<?php echo get_option('home'); ?>/"><img class="logotype" alt="logo" src="<?php echo $bb_logo; ?>" /></a>
</div> <!-- END #header -->

