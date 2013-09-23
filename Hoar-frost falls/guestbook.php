<?php
/*
Template Name:guestbook
*/
?>

<?php get_header(); ?>


  <?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
    <article id="post-<?php the_ID(); ?>">
        <div class="title">
            <h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        </div>
        <?php the_content(); ?>
    </article>
    <?php endwhile; else : ?>
    <article id="errorbox">
    <?php _e('Sorry, no posts matched your criteria.', 'ospring'); ?>
    </article>
    <?php endif; ?>
  </section>

<?php comments_template(); ?>

<?php get_footer(); ?>