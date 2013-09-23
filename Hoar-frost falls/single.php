<?php get_header(); ?>


  <?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
    <article id="post-<?php the_ID(); ?>">
      <?php get_template_part( 'content', get_post_format() ); ?>
      <?php wp_link_pages(array('before' =>'<div class="page-link"><span>'.__( 'Page', 'ospring' ).'</span>','after' => '</div>','link_before'=>'<span class="current">','link_after'=>'</span>'));?>
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
        <?php lt_next_post_link("%link") ?>
        <?php lt_previous_post_link('%link') ?>
      </div>
    </nav>


  </section>

<?php comments_template(); ?>

<?php get_footer(); ?>