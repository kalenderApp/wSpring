<?php $options = get_option('airsquare_options'); ?>
<?php
			global $wpdb;
			$post_datetimes = $wpdb->get_row($wpdb->prepare("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970"));
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes->firstyear;
				$lastpost_year = $post_datetimes->lastyear;

				$copyright = __('Copyright &copy; ', 'airsquare') . $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= ' ';
			}
?>
		<div id="footer">
				<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/common.js"></script>
				<?php if (is_single() || is_page() ){ ?>
					<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/comment.js"></script>
				<?php } ?>
				<?php if($options['windowsp7']) { ?>
					<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/windowsp7.js"></script>
				<?php } ?>
			<span><a href="http://wordpress.org"  target="_blank">WordPress</a><?php echo $copyright; ?><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>AirSquare <?php _e('by <a href="http://yimity.com" target="_blank">一米</a>','airsquare'); ?></span>
			<!-- 如果用户选择显示统计代码, 并且有代码, 则显示出来 -->
			<?php if($options['analytics'] && $options['analytics_content']) : ?>
			<?php echo ($options['analytics_content']); ?>
			<?php endif; ?>
		</div>
	</div>
</body>
</html>
