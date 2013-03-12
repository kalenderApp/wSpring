<?php

// Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (_e('Please do not load this page directly. Thanks!','airsquare'));
	
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'airsquare'); ?></p> 
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<ol class="commentlist">
	<?php wp_list_comments('type=comment&callback=custom_comments');?>
	</ol>
	<div class="c"></div>
<?php
	if (get_option('page_comments')) {
		$comment_pages = paginate_comments_links('echo=0');
		if ($comment_pages) {
?>
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
		<div class="cl"></div>
	</div>
<?php
		}
	}
?>	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'airsquare'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">

<div id="cancel-comment-reply"> 
	<small><?php cancel_comment_reply_link() ?></small>
</div> 

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'airsquare'), wp_login_url( get_permalink() )); ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'airsquare'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'airsquare'); ?>"><?php _e('Log out &raquo;', 'airsquare'); ?></a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small><?php _e('Name', 'airsquare'); ?> <?php if ($req) _e("(required)", "airsquare"); ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small><?php _e('Mail (will not be published)', 'airsquare'); ?> <?php if ($req) _e("(required)", "airsquare"); ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo  esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e('Website', 'airsquare'); ?></small></label></p>

<?php endif; ?>

<?php 
	$options = get_option('airsquare_options');
?>
<div id="smiley">
	<ul>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_arrow.gif" alt=":arrow:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_biggrin.gif" alt=":grin:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_confused.gif" alt=":???:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_cool.gif" alt=":cool:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_cry.gif" alt=":cry:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_eek.gif" alt=":shock:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_evil.gif" alt=":evil:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_exclaim.gif" alt=":!:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_idea.gif" alt=":idea:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_lol.gif" alt=":lol:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_mad.gif" alt=":mad:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_mrgreen.gif" alt=":mrgreen:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_neutral.gif" alt=":neutral:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_question.gif" alt=":?:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_razz.gif" alt=":razz:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_redface.gif" alt=":oops:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_rolleyes.gif" alt=":roll:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_sad.gif" alt=":sad:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_smile.gif" alt=":smile:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_surprised.gif" alt=":eek:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_twisted.gif" alt=":twisted:">
		</li>
		<li>
			<img src="/wp-content/themes/airsquare/images/smilies/icon_wink.gif" alt=":wink:">
		</li>
	</ul>
</div>
<textarea  <?php if($options['commentads']) echo 'style="width:430px;"'; ?> name="comment" id="comment" tabindex="4" placeholder="<?php _e('Please Input Your Word', 'airsquare'); ?>"></textarea>
<?php if($options['commentads']){
	echo '<div class="google_ads_125_125">'.$options['commentads'].'</div>';
}
?>
<p>
	<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'airsquare'); ?>" />
	<span class="comment-error"><?php _e('Comments Failure, Maybe Repeated Comments or Server is Gone!', 'airsquare'); ?></span>
	<span class="required-error"><?php _e('The Nickname Email and Comment are Required!', 'airsquare'); ?></span>
	<span class="comment-success"><?php _e('Comments Success!', 'airsquare'); ?></span>
	<?php comment_id_fields(); ?> 
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
