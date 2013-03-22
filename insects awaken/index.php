<?php get_header(); ?>

	<section id="posts">

		<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
		<article id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink() ?>"  rel="bookmark"><?php the_title(); ?></a></h2>
				<?php the_content(__('Read more...', 'silence')); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><div class="wp-pagenavi"><span>' . __( 'Page', 'silence' ) . '</span>', 'after' => '</div></div><div class="c"></div>','link_before'=>'<span class="current">' ,'link_after'=>'</span>' ) ); ?>

			<div class="under">
					<span class="date"><a class="timeago" title="<?php the_time('Y/m/d H:i:s') ?>" href="/<?php the_time('Y/m/d') ?>"><?php the_time(__('Y/m/d', 'silence')) ?></a></span>
					<span class="categories"><?php the_category(' '); ?></span>
					<span class="tags"><?php the_tags('#', '#', ''); ?></span>
					<span class="comments"><?php comments_popup_link(__('No comments', 'silence'), __('1 comment', 'silence'), __('% comments', 'silence'), '', __('Comments off', 'silence')); ?></span>
			</div>
		</article>
		<!--<div class="shadow"></div>-->
		<?php endwhile; else : ?>
		<div id="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'silence'); ?>
		</div>
		<?php endif; ?>








		<!--<article>
				<h4><a href="http://yimity.114059e10cf6506e899b.tpl.diandian.com/post/2012-03-15/18425592">战马</a></h4>
				<p>战马720.mkv 6.54 GB<br>英文片名: War Horse<br>国家地区: 美国<br>影片类型: 剧情片<br>资源格式: 720P,1080P,掌上设备<br>上影时间: 2011<br>导 演: 史蒂文·斯皮尔伯格 Steve...</p>
				<a href="http://yimity.114059e10cf6506e899b.tpl.diandian.com/post/2012-03-15/18425592"><span class="date">15 Mar 2012</span></a>
		</article>
		<article>
				<h4><a href="http://yimity.114059e10cf6506e899b.tpl.diandian.com/post/2012-03-15/18425592">战马</a></h4>
				<p>战马720.mkv 6.54 GB<br>英文片名: War Horse<br>国家地区: 美国<br>影片类型: 剧情片<br>资源格式: 720P,1080P,掌上设备<br>上影时间: 2011<br>导 演: 史蒂文·斯皮尔伯格 Steve...</p>
				<a href="http://yimity.114059e10cf6506e899b.tpl.diandian.com/post/2012-03-15/18425592"><span class="date">15 Mar 2012</span></a>
		</article>
		<article>
				<h4><a href="http://yimity.114059e10cf6506e899b.tpl.diandian.com/post/2012-03-15/18425592">战马</a></h4>
				<p>战马720.mkv 6.54 GB<br>英文片名: War Horse<br>国家地区: 美国<br>影片类型: 剧情片<br>资源格式: 720P,1080P,掌上设备<br>上影时间: 2011<br>导 演: 史蒂文·斯皮尔伯格 Steve...</p>
				<a href="http://yimity.114059e10cf6506e899b.tpl.diandian.com/post/2012-03-15/18425592"><span class="date">15 Mar 2012</span></a>
		</article>
		<article>
				<h4><a href="http://yimity.114059e10cf6506e899b.tpl.diandian.com/post/2012-03-15/18425592">战马</a></h4>
				<p>战马720.mkv 6.54 GB<br>英文片名: War Horse<br>国家地区: 美国<br>影片类型: 剧情片<br>资源格式: 720P,1080P,掌上设备<br>上影时间: 2011<br>导 演: 史蒂文·斯皮尔伯格 Steve...</p>
				<a href="http://yimity.114059e10cf6506e899b.tpl.diandian.com/post/2012-03-15/18425592"><span class="date">15 Mar 2012</span></a>
		</article>-->
<?php get_footer(); ?>