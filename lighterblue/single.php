<?php get_header(); ?>

    <div id="main">
        <div id="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div id="postpath">
		<a title="<?php _e('Go to homepage', 'lighterblue'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'lighterblue'); ?></a>
		 &gt; <?php the_category(', '); ?>
		 &gt; <?php the_title(); ?>
	</div>

	<div class="entry">
                <h1 class="entry_title">
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'lighterblue'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
                </h1>
                <div class="entry_meta">
                    <div class="meta_date">
                       <span class="meta_month"><?php the_time(__('F', 'lighterblue')) ?></span>
                       <span class="meta_day"><?php the_time(__('d', 'lighterblue')) ?></span>
                    </div>
                    <span class="meta_author"><?php the_author_posts_link(); ?></span>
                    <span class="meta_category"><?php the_category(', '); ?></span>
					<span class="meta_comment"><?php comments_popup_link(__('No comments', 'lighterblue'), __('1 comment', 'lighterblue'), __('% comments', 'lighterblue'), '', __('Comments off', 'lighterblue')); ?></span>
                    <div class="cl"> </div>          
                </div>
                <div class="entry_body">
                     <?php the_content(__('Read more...', 'lighterblue')); ?>
                     <div class="cl"> </div>
                     <p> </p>
                </div>
                <div class="entry_meta_end">
                     <span class="tags"><?php the_tags('', ', ', ''); ?></span>
                </div>
            </div>
			<?php comments_template(); ?>
			<?php endwhile; else : ?>
			<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'lighterblue'); ?>
	</div>
<?php endif; ?>


<?php if(function_exists('wp_pagenavi')) : ?>
				<?php wp_pagenavi() ?>
			<?php else : ?>
				<div id = "pagenavi">
                <span class="newer"><?php previous_post_link('%link'); ?></span>
				<span class="older"><?php next_post_link('%link'); ?></span>
				</div>
			<?php endif; ?>
			<div class="fixed"></div>
        </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>