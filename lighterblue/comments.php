<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/comment.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/base.js"></script>
<?php

// Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (_e('Please do not load this page directly. Thanks!','lighterblue'));
	
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'lighterblue'); ?></p> 
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"></h3>

	<ol class="commentlist">
	<?php wp_list_comments('type=comment&callback=custom_comments');?>
	</ol>
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
		<p class="nocomments"><?php _e('Comments are closed.', 'lighterblue'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">

<div id="cancel-comment-reply"> 
	<small><?php cancel_comment_reply_link() ?></small>
</div> 

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'lighterblue'), wp_login_url( get_permalink() )); ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'lighterblue'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'lighterblue'); ?>"><?php _e('Log out &raquo;', 'lighterblue'); ?></a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small><?php _e('Name', 'lighterblue'); ?> <?php if ($req) _e("(required)", "lighterblue"); ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small><?php _e('Mail (will not be published)', 'lighterblue'); ?> <?php if ($req) _e("(required)", "lighterblue"); ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo  esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e('Website', 'lighterblue'); ?></small></label></p>

<?php endif; ?>

<?php 
	$options = get_option('analytics_options');
?>
<p><textarea <?php if(!$options['commentads']) echo 'style="width:614px;"'; ?> name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>
<?php if(!$options['commentads']){
	$commentads = "";
} else {
	echo '<div class="google_ads_125_125">'.$options['commentads'].'</div>';
	}
?>
<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'lighterblue'); ?>" />
<?php comment_id_fields(); ?> 
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
