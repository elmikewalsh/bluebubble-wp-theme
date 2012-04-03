<?php get_header(); ?>


	<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="postsingle" id="post-<?php the_ID(); ?>">
				
				<div class="boxsingle">						
					<?php echo the_post_thumbnail('portfolio-big'); ?>				
				</div>
			
				<h2><?php the_title(); ?><?php $projDate = __(get_post_meta(get_the_ID(), 'bb_port_client_date', TRUE)); if($projDate != ''){ ?><?php } ?><?php if (get_option('bb_post_tweet') == 'true') { ?>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
   <a href="http://twitter.com/share" class="twitter-share-button"
      data-url="<?php the_permalink(); ?>"
      data-via="<?php echo get_option('bb_twitter_name') ?>"
      data-text="<?php the_title(); ?>"
      data-related=""
      data-count="horizontal">Tweet</a><?php } // Check for Tweet Button Off ?>
<?php if (get_option('bb_post_google') == 'true') { ?>
<g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone><?php } // Check for Tweet Button Off ?></h2>
<p><?php if ($projDate != '') { ?><?php echo __('Year:' . $projDate); } ?>

                
				<?php $link = __(get_post_meta(get_the_ID(), 'bb_port_client_url', TRUE)); if($link != ''){ ?> -- <?php echo __('Link:'); ?> <a href="<?php echo $link; ?>" target="blank"><?php echo __('Visit Site'); ?></a></p><?php } ?>
				<div class="entry">
					<?php the_content (__('Read the rest of this entry &raquo;', 'BlueBubble')); ?>
					
					<a class="homelink" title="<?php echo bloginfo('blog_name'); ?>" href="<?php echo get_option('home'); ?>/"> &larr; <?php _e('Back', 'BlueBubble') ?> </a>
					
				</div>

			</div>
			
<?php 
if (get_option('bb_comments') =='true') {
	 echo "";
} else {
	 echo comments_template();
}
?>			

		<?php endwhile; ?>

		

	<?php else : ?>

		<h2 class="center"><?php _e('Not Found', 'BlueBubble') ?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that is not here.', 'BlueBubble') ?></p>
		

	<?php endif; ?>

	</div>



<?php get_sidebar('standard'); ?>
<?php get_footer(); ?>
