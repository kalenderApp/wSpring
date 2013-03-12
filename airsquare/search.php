<?php get_header(); ?>
	<div id="wapper">
		<div id="postcontent" class="r">
			<!--<div class="prepost"><?php previous_post_link('%link') ?></div>-->
			<div id="content">
				<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
				<div class="title">
					<h2 class="l"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2><?php edit_post_link( __( 'Edit', 'airsquare' ), '<span class="edit-link r">', '</span>' ); ?>
					<div class="c"></div>
				</div>
				<div class="content">
					<?php the_content(); ?>
				</div>
				<div class="under">
					<span class="time"><?php _e('Date: ', 'airsquare'); ?></span><span><?php the_time(__('Y.m.j', 'airsquare')) ?></span><span class="categories"><?php _e('Categories: ', 'airsquare'); ?></span><span><?php the_category(', '); ?></span><span class="tags"><?php _e('Tags: ', 'airsquare'); ?></span><span><?php the_tags('', ', ', ''); ?></span>
				</div>
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
			<!--<div class="nextpost"><?php next_post_link('%link') ?></div>-->
		</div>
		<?php get_sidebar(); ?>
		</div>
<?php get_footer(); ?>