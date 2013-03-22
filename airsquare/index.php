<?php get_header(); ?>
	<div id="wapper">
		<div id="postcontent" class="r">
			<div class="prepost"><!--<a href="#">上一页</a>--><?php previous_post_link('%link') ?></div>
			<div id="content">
				<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
					<?php comments_template(); ?>
				<?php endwhile; else : ?>
				<?php endif; ?>
				    <?php
						$options = get_option('airsquare_options');
						if($options['twitter']){
							$twitter = $options['twitter'];	
						}else{
							$twitter = "#";  
						}
						if($options['gplus']){
							$gplus = $options['gplus'];
						}else{
							$gplus = "#";  
						 }
						?>
			<!-- 获取选项 -->
			</div>
			<div id="search">
				<ul class="l">
					<li class="rss">
						<a href="<?php bloginfo('rss2_url'); ?>"></a>
					</li>
					<li class="twitter">
						<a href="https://twitter.com/<?php echo $twitter; ?>" target="_blank"></a>
					</li>
					<li class="gplus">
						<a href="https://plus.google.com/<?php echo $gplus; ?>" target="_blank"></a>
					</li>
				</ul>
				<a href="#" class="backtotop r"><?php _e('BacktoTop', 'airsquare'); ?></a><a class="home r" href="/"><?php _e('Home', 'airsquare'); ?></a>
				<form action="<?php bloginfo('home'); ?>" method="get" class="r">
					<input  name="s" class="keywords" type="text" value="" placeholder="<?php _e('Keywords', 'airsquare'); ?>" />
					<input class="search" type="submit" value="<?php _e('Search', 'airsquare'); ?>" />
				</form>
			</div>
			<div class="nextpost"><!--<a href="#">下一页</a>--><?php next_post_link('%link') ?></div>
		</div>
		<?php include_once("indexsidebar.php"); ?>
		</div>
<?php get_footer(); ?>