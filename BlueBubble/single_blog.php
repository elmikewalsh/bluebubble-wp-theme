<?php get_header(); ?>


	<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="postsingle" id="post-<?php the_ID(); ?>">
							
<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><?php if (get_option('bb_post_tweet') == 'true') { ?>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
   <a href="http://twitter.com/share" class="twitter-share-button"
      data-url="<?php the_permalink(); ?>"
      data-via="<?php echo get_option('bb_twitter_name') ?>"
      data-text="<?php the_title(); ?>"
      data-related=""
      data-count="horizontal">Tweet</a><?php } // Check for Tweet Button Off ?>
<?php if (get_option('bb_post_google') == 'true') { ?>
<g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone><?php } // Check for Tweet Button Off ?></h1>
				
				<p class="postmetadata"><?php _e('by', 'BlueBubble') ?> <?php the_author_posts_link(); ?> <?php _e('on', 'BlueBubble') ?> <?php the_time('l, j F Y') ?>  | <img src="<?php echo get_bloginfo('template_directory'); ?>/images/comments.png" alt="comments"> <?php comments_popup_link (__('No Comments', 'BlueBubble'), __('1 Comment', 'BlueBubble'), __('% Comments', 'BlueBubble')); ?> 

				
				<div class="entry">
					<?php the_content (__('Read the rest of this entry &raquo;', 'BlueBubble')); ?>
				</div>
				
				
			</div>
			
<?php comments_template(); ?>
			
			
			

		<?php endwhile; ?>

		

	<?php else : ?>

		<h2 class="center"><?php _e('Not Found', 'BlueBubble') ?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that is not here.', 'BlueBubble') ?></p>
		

	<?php endif; ?>

	</div>



<?php get_sidebar('standard'); ?>
<?php get_footer(); ?>