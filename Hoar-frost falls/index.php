<?php get_header(); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
    <article id="post-<?php the_ID(); ?>">
      <div class="title">
        <h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <span class="info"><a class="timeago" title="<?php the_time('Y/m/d H:i:s') ?>" href="/<?php the_time('Y/m/d') ?>"><?php the_time(__('Y/m/d', 'ospring')) ?></a>  /  <?php comments_popup_link(__('No comments', 'ospring'), __('1 comment', 'ospring'), __('% comments', 'ospring'), '', __('Comments off', 'ospring')); ?>  /  <?php echo getPostViews(get_the_ID()); echo __(" views", 'ospring'); ?></span>
      </div>
        <?php the_content(__('Read more...', 'ospring')); ?>
        <?php wp_link_pages(array('before' =>'<div class="page-link"><span>'.__( 'Page', 'ospring' ).'</span>','after' => '</div>','link_before'=>'<span class="current">','link_after'=>'</span>'));?>
    </article>
    <?php endwhile; else : ?>
    <article id="errorbox">
      <style>
        .pagination {display:none;}
      </style>
    <?php _e('Sorry, no posts matched your criteria.', 'ospring'); ?>
    </article>
    <?php endif; ?>


    <nav class="pagination clearfix" id="pagination">
        <?php if(function_exists('wp_pagenavi')) : ?>
          <?php wp_pagenavi() ?>
        <?php else : ?>
        <div class="wp-pagenavi">
          <!--<span class="newer pages">-->
            <?php 
              if (get_previous_posts_link()) {
                previous_posts_link(__('Newer', 'ospring')); 
              }else {
                echo '<span>'.__('None','ospring').'</span>';
              }
            ?>
          <!--</span>-->
          <!--<span class="older pages">-->
            <?php 
              if (get_next_posts_link()){
                next_posts_link(__('Older', 'ospring'));
              }else {
                echo '<span>'.__('None','ospring').'</span>';
              }
            ?>
          <!--</span>-->
        </div>
    <?php endif; ?>
  </nav>
  </section>

<?php get_footer(); ?>