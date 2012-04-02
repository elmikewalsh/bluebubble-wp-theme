<?php get_header(); ?>

<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

	<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="postsingle" id="post-<?php the_ID(); ?>">
			
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="<?php echo get_option('bb_twitter_name') ?>">Tweet</a></h1>
				
				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
					
					<a class="homelink" title="<?php echo bloginfo('blog_name'); ?>" href="<?php echo get_option('home'); ?>/"> &larr; Back </a>
					
				</div>

			</div>

		<?php endwhile; ?>

		

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>


	<?php endif; ?>

	</div>



<?php get_sidebar('standard'); ?>
<?php get_footer(); ?>
