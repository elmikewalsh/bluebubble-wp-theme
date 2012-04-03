<?php
/*
Template Name: Contact
*/
?>
<?php
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = _e(get_option('bb_name_error'));
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = __(get_option('bb_email_error'));
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = _e('You entered an invalid email address.');
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = __(get_option('bb_message_error'));
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		
		if ( get_option('bb_contact_email') ) {  $emailTo = get_option('bb_contact_email'); 
          }else{ $emailTo = get_option('admin_email'); } //change this with your email address

	    $ipaddress = $_SERVER['REMOTE_ADDR'];
	    $date = date('d/m/Y');
	    $time = date('H:i:s');

		if (get_option('bb_email_subject') !='') {$subject = get_option('bb_email_subject');
		 }else{ $subject = 'Email from:' .$name; }

		$headers = 'From: ' .$name.' <'.$emailTo.'>' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$emailbody = "<p><strong>Name: </strong> {$name} </p>
					  <p><strong>Email: </strong> {$email} </p>
					  <p><strong>Subject: </strong> {$subject} </p>
					  <p><strong>Message: </strong> {$comments} </p>
					  <p>This message was sent from the IP Address: {$ipaddress} on {$date} at {$time}</p>";

		wp_mail($emailTo, $subject, $emailbody, $headers);
		$emailSent = true;
	}

} ?>
<?php get_header(); ?> 

  <div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="postsingle" id="post-<?php the_ID(); ?>">

				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><?php if (get_option('bb_no_fblike') == 'true') { ?><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fdevelopers.facebook.com%2F&amp;layout=standard&amp;show-faces=true&amp;width=450&amp;action=like&amp;font=arial&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:450px; height:px"></iframe>Like<?php } // Check for Facebook Like Button Off ?><?php if (get_option('bb_no_tweet') == '1') { ?><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="<?php echo get_option('bb_twitter_name') ?>">Tweet</a>
<?php } // Check for Tweet Button Off ?></h1>

				<div class="entry">

					<?php the_content(); ?>

				</div>

<div id="contact-form">

					<div class="entry-content">
						<?php if(isset($emailSent) && $emailSent == true) { ?>
							<div class="thanks">
								<p><?php if (get_option('bb_thanks_message') != '') { ?><?php echo get_option('bb_thanks_message'); ?><?php } else { ?><?php echo _e('Thanks, your email was sent successfully.'); } ?></p>
							</div>
						<?php } else { ?>
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p id="error-box"><?php if (get_option('bb_general_error') != '') { ?><?php echo get_option('bb_general_error'); ?><?php } else { ?><?php echo _e('Sorry, an error occured.'); } ?><p>
							<?php } ?>

						<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
							<ul class="contactform">
							<li>
								<label for="contactName"><?php echo __('Name');?></label>
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" placeholder="John Doe" autofocus / />
								<?php if($nameError != '') { ?>
									<span class="error"><?php echo $nameError;?></span>
                                    <div class="clear-margin"></div>
								<?php } ?>
							</li>

							<li>
								<label for="email"><?php echo __('Email');?></label>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" placeholder="johndoe@example.com" />
								<?php if($emailError != '') { ?>
									<span class="error"><?php echo $emailError;?></span>
                                    <div class="clear-margin"></div>
								<?php } ?>
							</li>

							<li><label for="commentsText"><?php echo __('Message');?></label>
								<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField" placeholder="Please write a message here." /><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
								<?php if($commentError != '') { ?>
									<span class="error"><?php echo $commentError;?></span>
                                    <div class="clear-margin"></div>
								<?php } ?>
							</li>
                            <span id="loading"></span>
							<li>
				<input type="hidden" name="submitted" id="submitted" value="true" /><input type="submit" id="submit" value="<?php echo __('Send Email'); ?>"></input>
							</li>
						</ul>
						
					</form>
				<?php } ?><?php endwhile; endif; ?>
				</div><!-- .entry-content -->
            </div>
    </div>
</div>


<?php get_sidebar('standard'); ?>
<?php get_footer(); ?> 