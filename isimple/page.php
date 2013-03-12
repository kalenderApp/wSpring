<?php get_header(); ?>
	<div id="content"><!--Content Begin-->
	<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
		<div class="content" id="post-<?php the_ID(); ?>">
			<div class="title"><h2><a id="titlehref" href="<?php the_permalink() ?>"  rel="bookmark"><?php the_title(); ?></a></h2></div>
			<div class="rich-content">
				<?php the_content(__('Read more...', 'isimple')); ?>
			</div>
			<div class="under">
				<div class="tags-category"><span class="categories"><?php the_category(' '); ?></span><span class="tags"><?php the_tags('#', '#', ''); ?></span></div>
				<div class="date-comment"><a href="/<?php the_time('Y/m/j') ?>"><?php the_time(__('Y/m/j', 'inove')) ?></a><?php comments_popup_link(__('No comments', 'isimple'), __('1 comment', 'isimple'), __('% comments', 'isimple'), '', __('Comments off', 'isimple')); ?></div>
			</div>
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