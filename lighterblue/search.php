<?php get_header(); ?>
    <div id="main">
        <div id="content">
	<div class="boxcaption"><h3><?php _e('Search Results', 'lighterblue'); ?></h3></div>
	<div class="box"><?php printf( __('Keyword: &#8216;%1$s&#8217;', 'lighterblue'), wp_specialchars($s, 1) ); ?></div>

<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
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
			<?php endwhile; else : ?>
			<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'lighterblue'); ?>
	</div>
<?php endif; ?>

<?php if(function_exists('wp_pagenavi')) : ?>
				<?php wp_pagenavi() ?>
			<?php else : ?>
				<div id = "pagenavi">
                <span class="newer"><?php previous_posts_link(__('Newer Entries', 'lighterblue')); ?></span>
				<span class="older"><?php next_posts_link(__('Older Entries', 'lighterblue')); ?></span>
				</div>
			<?php endif; ?>
			<div class="fixed"></div>
        </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
