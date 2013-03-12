      <div class="title">
        <h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <span class="info"><a class="timeago" title="<?php the_time('Y/m/d H:i:s') ?>" href="/<?php the_time('Y/m/d') ?>"><?php the_time(__('Y/m/d', 'ospring')) ?></a>  /  <?php comments_popup_link(__('No comments', 'ospring'), __('1 comment', 'ospring'), __('% comments', 'ospring'), '', __('Comments off', 'ospring')); ?>  /  <?php echo getPostViews(get_the_ID()); echo __(" views", 'ospring'); ?></span>
      </div>
      	<a href="<?php the_permalink() ?>"><?php echo get_avatar($post->post_author, 64); ?></a>
        <?php the_content(__('Read more...', 'ospring')); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-link"><div class="wp-pagenavi"><span>' . __( 'Page', 'ospring' ) . '</span>', 'after' => '</div></div><div class="c"></div>','link_before'=>'<span class="current">' ,'link_after'=>'</span>' ) ); ?>
