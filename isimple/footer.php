<?php $options = get_option('isimple_options'); ?>
<?php
			global $wpdb;
			$post_datetimes = $wpdb->get_row($wpdb->prepare("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970"));
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes->firstyear;
				$lastpost_year = $post_datetimes->lastyear;

				$copyright = __('Copyright &copy; ', 'isimaple') . $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= '';
			}
?>

	<div id="footer">
		<div id="footerlinks">
				<?php $args = array(
					'orderby'          => 'rand',
					'title_li'         => ' ',
					'title_before'     => '',
					'title_after'      => '',
					'class'            => '',
					'limit'            => 20,
					'categorize'       => 0,
					'category_before'  => '',
					'category_after'   => '' ); 
				?>
				<?php wp_list_bookmarks( $args ); ?>
			<div class="c"></div>
		</div>
		<div class="hr"></div>
		<div id="copyright">
			<a href="http://wordpress.org"  target="_blank">WordPress</a><?php echo $copyright; ?><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a><a href="http://yimity.com/2012/06/01/isimple.html">iSimple</a><?php _e('by <a href="http://yimity.com" target="_blank">一米</a>','isimple'); ?>
			<!-- 如果用户选择显示统计代码, 并且有代码, 则显示出来 -->
			<?php if($options['analytics'] && $options['analytics_content']) : ?>
			<?php echo ($options['analytics_content']); ?>
			<?php endif; ?>
		</div>
	</div>
	<div data-widget='backtop'></div>
	<?php if(is_singular()){ ?>
		<script src="<?php bloginfo('template_url'); ?>/script/comments.js" charset="utf-8"></script>
	<?php } ?>
	<script src="<?php bloginfo('template_url'); ?>/script/global.js" charset="utf-8"></script>
	<script src="<?php bloginfo('template_url'); ?>/script/timeago.js" charset="utf-8"></script>
	<script src="<?php bloginfo('template_url'); ?>/script/slimbox2.js" charset="utf-8"></script>
	<?php wp_footer(); ?>
</body>
</html>