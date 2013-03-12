			<h2><a href="<?php the_permalink() ?>"  rel="bookmark"><?php the_title(); ?></a></h2>
				<?php the_content(__('Read more...', 'silence')); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><div class="wp-pagenavi"><span>' . __( 'Page', 'silence' ) . '</span>', 'after' => '</div></div><div class="c"></div>','link_before'=>'<span class="current">' ,'link_after'=>'</span>' ) ); ?>

			<div class="under">
					<span class="date"><a class="timeago" title="<?php the_time('Y/m/d H:i:s') ?>" href="/<?php the_time('Y/m/d') ?>"><?php the_time(__('Y/m/d', 'silence')) ?></a></span>
					<span class="categories"><?php the_category(' '); ?></span>
					<span class="tags"><?php the_tags('#', '#', ''); ?></span>
					<span class="comments"><?php comments_popup_link(__('No comments', 'silence'), __('1 comment', 'silence'), __('% comments', 'silence'), '', __('Comments off', 'silence')); ?></span>
			</div>
