<?php get_header(); ?>


  <?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
    <article id="post-<?php the_ID(); ?>">
      <?php get_template_part( 'content', get_post_format() ); ?>
      <?php setPostViews(get_the_ID()); ?>
    </article>
    <?php endwhile; else : ?>
    <article id="errorbox">
      <style>
        .pagination {display:none;}
      </style>
    <?php _e('Sorry, no posts matched your criteria.', 'ospring'); ?>
    </article>
    <?php endif; ?>

    <nav class="pagination clearfix" id="single">
      <div class="wp-pagenavi">
        <span class="prev pages"><?php lt_next_post_link("%link") ?></span>
        <span class="next pages"><?php lt_previous_post_link('%link') ?></span>
      </div>
    </nav>


  </section>

    <!--<div id="comments">

      <h3><?php comments_popup_link(__('No comments', 'ospring'), __('1 comment', 'ospring'), __('% comments', 'ospring'), '', __('Comments off', 'ospring')); ?></h3>
      <ol class="page">
        <li><a class="prev" href="#">«</a></li>
        <li><a href="#">1</a></li>
        <li class="current"><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a class="next" href="#">»</a></li>
      </ol>-->


      <?php comments_template(); ?>
      
    </div>

<?php get_footer(); ?>