<?php
			global $wpdb;
			$post_datetimes = $wpdb->get_row($wpdb->prepare("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970"));
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes->firstyear;
				$lastpost_year = $post_datetimes->lastyear;

				$copyright = __('Copyright &copy; ', 'inove') . $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= ' ';
			}
?>

<div id="footer">
  <div id="copyright">
    <span><a href="http://wordpress.org" target="_blank">WordPress</a></span><span><?php echo $copyright;  bloginfo('name'); ?></span><span>BreakUp <?php _e('by <a href="http://yimity.com" target="_blank">一米</a>','breakup'); ?></span> | 
	<?php 
		if ( is_user_logged_in() ) { 
			wp_loginout(); ?>
		<?php } else { 
		echo '<a class="loginpop" href="#">'; ?><?php _e("Login","breakup"); ?><?php echo '</a> '; ?>
		<?php } ?>
		<?php wp_register('',''); ?> |
    <!-- 如果用户选择显示统计代码, 并且有代码, 则显示出来 -->
    <?php $options = get_option('analytics_options'); ?>
    <?php if($options['analytics'] && $options['analytics_content']) : ?>
    <?php echo($options['analytics_content']); ?>
    <?php endif; ?>
  </div>
  <div id="footermenu">
    <ul>
      <li>
      	<form action="<?php bloginfo('home'); ?>" method="get">
        	<input  name="s" class="keywords" type="text" value="<?php _e('Keywords', 'breakup'); ?>" />
			<input class="search" type="submit" value="<?php _e('Search', 'breakup'); ?>" />
        </form>
      </li>
      <li>
        <input class="pagenum" type="text" value="<?php _e('PageNum', 'breakup'); ?>" />
		<input class="go" type="button" value="<?php _e('Go', 'breakup'); ?>" />
      </li>
    </ul>
  </div>
</div>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/<?php if (is_home()){echo 'home.dev.js';}else{echo 'single.dev.js';} ?>"></script>
</body>
</html>