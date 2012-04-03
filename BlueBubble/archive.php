<?php get_header(); ?>


	<div id="content">

<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for the', 'BlueBubble') ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category', 'BlueBubble') ?></h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle"><?php _e('Posts Tagged', 'BlueBubble') ?> &#8216;<?php single_tag_title(); ?>&#8217;</h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', 'BlueBubble') ?> <?php the_time('F jS, Y'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', 'BlueBubble') ?> <?php the_time('F, Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', 'BlueBubble') ?> <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle"><?php _e('Author Archive', 'BlueBubble') ?></h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle"><?php _e('Blog Archives', 'BlueBubble') ?></h2>
 	  <?php } ?>

	<?php if (have_posts()) : ?>
	 <?php query_posts('paged='.$paged.'&posts_per_page='.$bb_post_num); ?>
     

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
				
				<p class="postmetadata"><?php _e('by', 'BlueBubble') ?> <?php the_author_posts_link(); ?> <?php _e('on', 'BlueBubble') ?> <?php the_time('l, j F Y') ?> | <img src="<?php echo get_bloginfo('template_directory'); ?>/images/comments.png" alt="comments"> <?php comments_popup_link (__('No Comments', 'BlueBubble'), __('1 Comment', 'BlueBubble'), __('% Comments', 'BlueBubble')); ?></p>

<?php if (get_option('bb_last_updated') =='true' ) { ?><?php $u_time = get_the_time('U'); $u_modified_time = get_the_modified_time('U'); if ($u_modified_time != $u_time) { echo "<div class='update'>"; echo __("This post was last updated on: "); the_modified_time('j.m.y'); echo "</div>"; } ?><?php } // End check for Last Updated ?>
				
				<div class="entry">
					<?php the_content (__('Read the rest of this entry &raquo;', 'BlueBubble')); ?>
				</div> 
				
				
			</div> 
 
<?php comments_template(); ?> 

		<?php endwhile; ?>

        <div class="navigation">
        <?php if (function_exists("pagination")) { pagination($additional_loop->max_num_pages); } ?>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e('Not Found', 'BlueBubble') ?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that is not here.', 'BlueBubble') ?></p>
		

	<?php endif; ?>

	<?php wp_reset_query(); ?>
	</div> 


<?php get_sidebar('standard'); ?>
<?php get_footer(); ?>