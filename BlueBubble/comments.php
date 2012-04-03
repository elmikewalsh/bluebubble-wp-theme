<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (_e('Please do not load this page directly. Thanks!', 'BlueBubble'));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'BlueBubble') ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number( __('No Responses', 'BlueBubble'), __('One Response', 'BlueBubble'), __('% Responses', 'BlueBubble') );?> <?php _e('to', 'BlueBubble') ?> &#8220;<?php the_title(); ?>&#8221;</h3>


	<div id="commentlist">
		<ol class="commentlist">
			<?php wp_list_comments("avatar_size=64&style=li"); ?>
		</ol>
	</div>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'BlueBubble') ?></p>

	<?php endif; ?>
<?php endif; ?>

<?php comment_form(array('title_reply'=> __('Please inspire the world with your comments.'))); ?>