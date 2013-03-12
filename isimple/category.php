<?php get_header(); ?>
	<div id="content"><!--Conten Begin-->
	<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
		<div class="content" id="post-<?php the_ID(); ?>">
			<div class="title"><h2><a href="<?php the_permalink() ?>"  rel="bookmark"><?php the_title(); ?></a></h2></div>
			<div class="rich-content">
				<?php the_content(__('Read more...', 'isimple')); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Page', 'twentyeleven' ) . '</span>', 'after' => '</div><div class="c"></div>','link_before'=>'<span class="current">' ,'link_after'=>'</span>' ) ); ?>
			</div>
			<div class="under">
				<div class="tags-category"><span class="categories"><?php the_category(' '); ?></span><span class="tags"><?php the_tags('#', '#', ''); ?></span></div>
				<div class="date-comment"><a href="/<?php the_time('Y/m/j') ?>"><?php the_time(__('Y/m/j', 'isimple')) ?></a><?php comments_popup_link(__('No comments', 'isimple'), __('1 comment', 'isimple'), __('% comments', 'isimple'), '', __('Comments off', 'isimple')); ?></div>
			</div>
		</div>
		<!--<div class="shadow"></div>-->
		<?php endwhile; else : ?>
		<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'isimple'); ?>
		</div>
		<?php endif; ?>
		<div class="pagination clearfix">
			<?php if(function_exists('wp_pagenavi')) : ?>
				<?php wp_pagenavi() ?>
			<?php else : ?>
				<span class="newer"><?php previous_posts_link(__('Newer Entries', 'isimple')); ?></span>
				<span class="older"><?php next_posts_link(__('Older Entries', 'isimple')); ?></span>
			<?php endif; ?>
		</div>
	</div><!--Content End-->
<?php get_footer(); ?>