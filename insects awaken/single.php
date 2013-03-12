<?php get_header(); ?>

	<section id="posts">

		<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
		<article id="post-<?php the_ID(); ?>">
				<?php get_template_part( 'content', get_post_format() ); ?>
		</article>
		<?php endwhile; else : ?>
		<div id="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'silence'); ?>
		</div>
		<?php endif; ?>

		<!-- Duoshuo Comment BEGIN -->
		<!--<div class="ds-thread" name="comments"></div>
		<script type="text/javascript">
			var duoshuoQuery = {short_name:"yimity-com"};
			(function() {
				var ds = document.createElement("script");
				ds.type = "text/javascript";ds.async = true;
				ds.src = "http://static.duoshuo.com/embed.js";
				ds.charset = "UTF-8";
				(document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0]).appendChild(ds);
			})();
		</script>-->
		<!-- Duoshuo Comment END -->
		<?php comments_template(); ?>








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