<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>

<?php
	if ( get_option('bb_portfolio_num') ) {  $portfolio_num = get_option('bb_portfolio_num'); 
    }else{ $portfolio_num = '6'; } //sets number of portfolio items per page
?>

<?php $bb_portfolio_cat = get_option('bb_portfolio_cat');  ?>


       <div id="content">
         
	<?php if (have_posts()) : ?>
    
	 <?php
	 /* Mali Studio dummy fix */
	if (is_front_page()){
		$bb_portfolio_page_param = 'page';
		}	 	
	else{
		$bb_portfolio_page_param = 'paged';
		}
		
	 $paged = (get_query_var($bb_portfolio_page_param)) ? get_query_var($bb_portfolio_page_param) : 1; 
	 /* END Mali Studio dummy fix */
	 ?>  
     
    <?php query_posts('paged='.$paged.'&category_name='.$bb_portfolio_cat.'&posts_per_page='.$portfolio_num); ?>
        <?php while (have_posts()) : the_post(); ?>


            <div class="post" id="post-<?php the_ID(); ?>">

				
				<div class="box-new">
                <?php if ( get_option('bb_no_colorbox') !='false' ) { ?>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"> 
                <?php }else{ ?>
                <?php if (has_post_thumbnail()=='') { ?><img width='310' height='150' src="<?php echo bloginfo('template_directory'); ?>/images/no-img/no-img657x318.png" /><?php } else { ?>
                <?php $thumbID = get_post_thumbnail_id($post->ID); ?>
                <a href="<?php echo wp_get_attachment_url($thumbID); ?>" rel="project">
				<span class="roll" ></span><?php } // End check for No Colorbox ?>
         		<?php echo the_post_thumbnail('portfolio-thumb'); ?>
				</a><?php } ?>
                
				
				</div>
			
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php short_title('','',true, '29'); ?></a></h2>
				
                <?php if ( get_option('bb_no_entry') !='true' ) { ?>
				<div class="entry">
					<p><?php echo substr(strip_tags($post->post_content), 0, 120); ?>... <a href="<?php the_permalink(); ?>">
					<?php _e('Details', 'BlueBubble') ?></a></p>
				</div><?php } // End check for No Colorbox ?>

			</div>

		<?php endwhile; ?>

		<!-- if you set portfolio.php as the homepage via wp-admin the pagintaion doesnt't work. -->
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
