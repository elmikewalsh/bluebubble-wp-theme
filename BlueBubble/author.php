<?php get_header(); ?>

<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
		<div id="content">
			<div id="content" role="main">

<?php
	/* Queue the first post, that way we know who
	 * the author is when we try to get their name,
	 * URL, description, avatar, etc.
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

<?php
// If a user has filled out their description, show a bio on their entries.
if ( get_the_author_meta( 'description' ) ) : ?>
					<div id="entry-author-info">
						<div id="author-avatar">
						<img src="<?php bloginfo('template_directory') ?>/images/authors/<?php the_author_ID()?>.jpg" alt="<?php the_author(); ?>" title="<?php the_author(); ?>" />
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( __( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
							<p><?php the_author_meta( 'description' ); ?></p><br />
<h2>Contact <?php the_author_meta( 'nickname' ); ?></h2>

    <?php if ( get_the_author_meta( 'phone' ) ) { ?>
    <p>Phone: <?php the_author_meta( 'phone' ); ?></p>
    <?php } // End check for Phone ?>

    <?php if ( get_the_author_meta( 'skype' ) ) { ?>   
    <p>Skype: <?php the_author_meta( 'skype' ); ?></p>
    <?php } // End check for Skype ?> 
    
    <?php if ( get_the_author_meta( 'user_url' ) ) { ?>
    <p>Website: <a href="<?php the_author_meta( 'user_url' ); ?>" target="_blank"><?php the_author_meta( 'user_url' ); ?></a></p>
    <?php } // End check for Website ?>
   
	<?php if ( get_the_author_meta( 'twitter' ) ) { ?>
    <p>Twitter: <a href="http://twitter.com/<?php the_author_meta('twitter'); ?>" title="Follow <?php the_author_meta('display_name'); ?> on Twitter" target="_blank" class="twitter"><?php the_author_meta('twitter'); ?></a></p>
    <?php } // End check for Twitter ?>
    
    <?php if ( get_the_author_meta( 'facebook' ) ) { ?>   
    <p>Facebook: <a href="http://facebook.com/<?php the_author_meta('facebook'); ?>" title="Facebook page for <?php the_author_meta('display_name'); ?> on Twitter" target="_blank" class="twitter"><?php the_author_meta('facebook'); ?></a></p>
    <?php } // End check for Facebook ?>
    
    <p></p>
    </dl>

						</div><!-- #author-description	-->
					</div><!-- #entry-author-info -->
<?php endif; ?>

<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the author archive page to output the authors posts
	 * If you want to overload this in a child theme then include a file
	 * called loop-author.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'author' );
?>
			</div><!-- #content -->


	

<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h1 class="pagetitle">Author Posts</h1><br />
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">Blog Archives</h2><br />
 	  <?php } ?>

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="postsingle" id="post-<?php the_ID(); ?>">
							
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<p class="postmetadata">by <?php the_author_posts_link(); ?> on <?php the_time('l, F jS, Y') ?>  | <img src="<?php echo get_bloginfo('template_directory'); ?>/images/comments.png" alt="comments"> <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> | <?php the_tags(); ?> </p>

				
				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
				
				
			</div>
			
<?php comments_template(); ?>
			
			
			

		<?php endwhile; ?>

		

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		

	<?php endif; ?>

	</div>

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
