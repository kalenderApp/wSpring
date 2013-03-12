<?php
// Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (_e('Please do not load this page directly. Thanks!','breakup'));
	
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'breakup'); ?></p> 
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<ul class="commentlist">
	<?php wp_list_comments('type=comment&callback=custom_comments');?>
	</ul>
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
		<p class="nocomments"><?php _e('Comments are closed.', 'breakup'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">

<div id="cancel-comment-reply"> 
	<small><?php cancel_comment_reply_link() ?></small>
</div> 

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p>
		<?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'breakup'), wp_login_url( get_permalink() )); ?>
	</p>
<?php else : ?>
<div class="clear"></div>
<div class="inputarea">
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

	<p>
		<?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'breakup'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'breakup'); ?>"><?php _e('Log out &raquo;', 'breakup'); ?></a>
	</p>

<?php else : ?>

	<p>
		<input type="text"  placeholder="<?php _e('NikeName', 'breakup'); ?>" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> required />
		<label for="author"><small><?php _e('Name', 'breakup'); ?> <?php if ($req) _e("(required)", "breakup"); ?></small></label>
	</p>
	<p>
		<input type="text" placeholder="E-mail" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> required />
		<label for="email"><small><?php _e('Mail', 'breakup'); ?> <?php if ($req) _e("(required)", "breakup"); ?></small></label>
	</p>
	<p>
		<input type="text" placeholder="<?php _e('Website', 'breakup'); ?>" name="url" id="url" value="<?php echo  esc_attr($comment_author_url); ?>" size="22" tabindex="3" required />
		<label for="url"><small><?php _e('Website', 'breakup'); ?></small></label>
	</p>
<?php endif; ?>
	<p>
		<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4" placeholder="<?php _e('Please input some words', 'breakup'); ?>" required ></textarea>
	</p>
	<p>
		<input name="submit" type="submit" id="submit" class="submit" tabindex="5" value="<?php _e('Submit(Ctrl+Enter)', 'breakup'); ?>" />
		<?php comment_id_fields(); ?> 
	</p>

<?php do_action('comment_form', $post->ID); ?>

</form>
</div>
<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
