<?php
/*
Template Name: Blog
*/
?>

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
	 <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>

        <?php while (have_posts()) : the_post(); ?>

			<div class="postsingle" id="post-<?php the_ID(); ?>">
							
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="<?php echo get_option('bb_twitter_name') ?>">Tweet</a></h1>
				
				<p class="postmetadata">by <?php the_author_posts_link(); ?> on <?php the_time('l, F jS, Y') ?>  | <img src="<?php echo get_bloginfo('template_directory'); ?>/images/comments.png" alt="comments"> <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> | <?php the_tags(); ?> </p>

				
				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div> 
				
				
			</div> 

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&larr; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &rarr;') ?></div>
		</div> 

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		

	<?php endif; ?>

	<?php wp_reset_query(); ?>
	</div> 


<?php get_sidebar('standard'); ?>
<?php get_footer(); ?>

