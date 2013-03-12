<?php $options = get_option('oSpring_HFF_options'); ?>

<?php if($options['isshare']) : ?>
	<div id="share">
		<!-- JiaThis Button BEGIN -->
		<div class="jiathis_style_32x32">
			<a class="jiathis_button_qzone"></a>
			<a class="jiathis_button_tsina"></a>
			<a class="jiathis_button_tqq"></a>
			<a class="jiathis_button_renren"></a>
			<a class="jiathis_button_kaixin001"></a>
			<a class="jiathis_button_tsohu"></a>
			<a class="jiathis_button_tieba"></a>
			<a class="jiathis_button_douban"></a>
			<a class="jiathis_button_xiaoyou"></a>
			<a class="jiathis_button_meilishuo"></a>
			<a class="jiathis_button_mogujie"></a>
			<a class="jiathis_button_t163"></a>
			<a class="jiathis_button_huaban"></a>
			<a class="jiathis_button_sdonote"></a>
			<a class="jiathis_button_twitter"></a>
			<a class="jiathis_button_tumblr"></a>
			<a class="jiathis_button_fav"></a>
			<a class="jiathis_button_evernote"></a>
			<a class="jiathis_button_copy"></a>
		</div>
		<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=95490" charset="utf-8"></script>
		<!-- JiaThis Button END -->
	</div>
<?php endif; ?>

<?php
// Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (_e('Please do not load this page directly. Thanks!','ospring'));
	
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'ospring'); ?></p> 
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<div id="comments">
	<h3><?php comments_popup_link(__('No comments', 'ospring'), __('1 comment', 'ospring'), __('% comments', 'ospring'), '', __('Comments off', 'ospring'));?></h3>
<?php if ( have_comments() ) : ?>
	
		
		<nav class="commentnavgation">
			<?php paginate_comments_links('prev_text=«&next_text=»');?>
		</nav>

	<ul class="commentlist" >
	<?php wp_list_comments('type=comment&callback=oSpring_comment&max_depth=10'); ?>
	</ul>

	<nav class="commentnavgation">
		<?php paginate_comments_links('prev_text=«&next_text=»');?>
	</nav>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php __("Comments are closed.", "ospring" ); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
<div id="cancel-comment-reply"> 
	<small><?php cancel_comment_reply_link() ?></small>
</div> 

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'ospring'), wp_login_url( get_permalink() )); ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'ospring'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'ospring'); ?>"><?php _e('Log out &raquo;', 'ospring'); ?></a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author) ? esc_attr($comment_author) : ""; ?>" ie-placeholder="<?php echo _e('Name', 'ospring'); ?>" placeholder="<?php echo esc_attr($comment_author) ? esc_attr($comment_author) : _e('Name', 'ospring'); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<!--<label for="author"><small><?php _e('Name', 'ospring'); ?> <?php if ($req) _e("(required)", "ospring"); ?></small></label>-->

<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email) ? esc_attr($comment_author_email) : ""; ?>" ie-placeholder="<?php echo _e('Mail (required)', 'ospring'); ?>" placeholder="<?php echo esc_attr($comment_author_email) ? esc_attr($comment_author_email) : _e('Mail (required)', 'ospring'); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<!--<label for="email"><small><?php _e('Mail (will not be published)', 'ospring'); ?> <?php if ($req) _e("(required)", "ospring"); ?></small></label>--></p>

<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url) ? esc_attr($comment_author_url) : ""; ?>" ie-placeholder="<?php echo _e('Website', 'ospring'); ?>" placeholder="<?php echo  esc_attr($comment_author_url) ? esc_attr($comment_author_url) :  _e('Website', 'ospring'); ?>" size="22" tabindex="3" />
<!--<label for="url"><small><?php _e('Website', 'ospring'); ?></small></label>--></p>

<?php endif; ?>

<div id="smiley">
	<ul>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_arrow.gif" alt=":arrow:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_biggrin.gif" alt=":grin:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_confused.gif" alt=":???:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_cool.gif" alt=":cool:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_cry.gif" alt=":cry:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_eek.gif" alt=":shock:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_evil.gif" alt=":evil:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_exclaim.gif" alt=":!:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_idea.gif" alt=":idea:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_lol.gif" alt=":lol:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_mad.gif" alt=":mad:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_mrgreen.gif" alt=":mrgreen:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_neutral.gif" alt=":neutral:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_question.gif" alt=":?:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_razz.gif" alt=":razz:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_redface.gif" alt=":oops:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_rolleyes.gif" alt=":roll:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_sad.gif" alt=":sad:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_smile.gif" alt=":smile:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_surprised.gif" alt=":eek:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_twisted.gif" alt=":twisted:"></li>
		<li><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_wink.gif" alt=":wink:"></li>
	</ul>
</div>
<textarea  <?php if($options['commentads'] && $options['iscommentads']) echo 'style="width:557px;"'; ?> name="comment" id="comment" tabindex="4" ie-placeholder="<?php _e('Please Input Your Words', 'ospring'); ?>" placeholder="<?php _e('Please Input Your Words', 'ospring'); ?>"></textarea>
<?php if($options['commentads'] && $options['iscommentads']){
	echo '<div class="google_ads_125_125">'.$options['commentads'].'</div>';
}
?>
	<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'ospring'); ?>" />
	<?php comment_id_fields(); ?> 
	<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/comments.js"></script>
