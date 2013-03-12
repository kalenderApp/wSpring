	</section>
	<div id="progress">
		<div id="top"></div>
		<div id="pro"></div>
		<div id="bot"></div>
	</div>
	

	<!--<footer class="pagination clearfix" id="pagination">
		<div class="wp-pagenavi">
			<span class="pages">38/1</span>
			<span class="current">1</span>
			<a href="http://yimity.com/page/2" class="page larger">2</a>
			<a href="http://yimity.com/page/3" class="page larger">3</a>
			<a href="http://yimity.com/page/4" class="page larger">4</a>-->
			<!--<span class="extend">...</span>-->
			<!--<a href="http://yimity.com/page/10" class="larger page">10</a>
			<a href="http://yimity.com/page/20" class="larger page">20</a>
			<a href="http://yimity.com/page/30" class="larger page">30</a>-->
			<!--<span class="extend">...</span>-->
			<!--<a href="http://yimity.com/page/2" class="nextpostslink">»</a>-->
			<!--<a href="http://yimity.com/page/30" class="larger page">38</a>
			<a href="http://yimity.com/page/38" class="last">最后</a>
		</div>
		<footer><p>© <a href="/">一米</a> | Powered by <a href="http://www.wordpress.org/">WordPress</a></p></footer>
		
	</footer>-->
<?php if(is_home()): ?>	
<footer class="pagination clearfix" id="pagination">
			<?php if(function_exists('wp_pagenavi')) : ?>
				<?php wp_pagenavi() ?>
			<?php else : ?>
			<div class="wp-pagenavi" id="singlepage">
				<span class="newer pages">
					<?php 
						if (get_previous_posts_link()) {
							previous_posts_link(__('Newer', 'silence')); 
						}else {
							echo __('None','silence');
						}
					?>
				</span>
				<span class="older pages">
					<?php 
						if (get_next_posts_link()){
							next_posts_link(__('Older', 'silence'));
						}else {
							echo __('None','silence');
						}
					?>
				</span>
			</div>
			<?php endif; ?>
			
<?php else : ?>
<footer class="pagination clearfix" id="pagination">
	<div class="wp-pagenavi" id="singlepage">
		<span class="prev pages"><?php lt_next_post_link("%link") ?></span>
		<span class="next pages"><?php lt_previous_post_link('%link') ?></span>
	</div>
<?php endif; ?>
	<footer><p>© <a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> <?php echo __('Theme <a href="http://yimity.com/2013/04/01/wordpress-free-theme-hoar-frost-falls.html">Hoar-frost Falls</a> by <a href="https://yimity.com/" target="_blank">一米</a> Thanks <a href="http://www.diandian.com/themes/110/show" target="_blank">咖啡因折页</a>','silence'); ?> <?php echo __('Proudly powered by','silence'); ?><a title="<?php echo __('Proudly powered by WordPress','silence'); ?>" href="http://WordPress.org" target="_blank">WordPress</a></p></footer>
</footer>




<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/jquery.cookie.js"></script> 
 
	<?php //if(is_single()): ?>
	<!--<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/post.js"></script>-->
	<?php //else: ?>
	<!--<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/silence.js"></script>-->
	<?php //endif; ?>


	<?php if(is_single()): ?>
	<script type="text/javascript">
	var isSingle = true;
	</script>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/silence.js"></script>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/single.js"></script>
	<?php else: ?>
	<script type="text/javascript">
	var isSingle = false;
	</script>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/silence.js"></script>
	<?php endif; ?>

	<?php $options = get_option('silence_options'); ?>
	<?php if($options['analytics'] && $options['analytics_content']) : ?>
	<?php echo ($options['analytics_content']); ?>
	<?php endif; ?>


	<!--[if lte IE 7]>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style/kill-ie6.css" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/kill-ie6.js"></script>
	<![endif]-->
</body>
</html> 