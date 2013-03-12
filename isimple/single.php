<?php get_header(); ?>
	<div id="content"><!--Content Begin-->
	<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
		<div class="content" id="post-<?php the_ID(); ?>">
			<?php get_template_part( 'content', get_post_format() ); ?>
		</div>
		<?php endwhile; else : ?>
		<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'isimple'); ?>
		</div>
		<?php endif; ?>
		<?php $options = get_option('isimple_options'); ?>
		<?php 
			if ($options['commentsystem'] == 1) {
				echo '<!-- Duoshuo Comment BEGIN -->
				<div class="ds-thread"></div>
				<script type="text/javascript">
					var duoshuoQuery = {short_name:"'.$options['duoshuoQuery'].'"};
					(function() {
						var ds = document.createElement("script");
						ds.type = "text/javascript";ds.async = true;
						ds.src = "http://static.duoshuo.com/embed.js";
						ds.charset = "UTF-8";
						(document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0]).appendChild(ds);
					})();
				</script>
				<!-- Duoshuo Comment END -->';
			}else {
				comments_template();
			} 
		?>
		<div class="pagination clearfix">
			<span class="prev"><?php lt_next_post_link("%link") ?></span>
			<span class="next"><?php lt_previous_post_link('%link') ?></span>
		</div>
	</div><!--Content End-->
<?php get_footer(); ?>