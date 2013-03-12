			<h2><a href="<?php the_permalink() ?>"  rel="bookmark"><?php the_title(); ?></a></h2>
				<?php 
					$lines = preg_split("/[\r\n]+/", $post->post_content);
					if(is_array($lines)) {
						$i=2;
						foreach($lines as $line) {
							if(trim($line) != '' ) 
					?>
						<?php if( $i%2 == 1 ){ echo '<div class="even chat">';}else {echo '<div class="odd chat">';}; ?><?php echo $line.'</div>';$i++ ?>
					<?php
						}
					}
				?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><div class="wp_pagenavi"><span>' . __( 'Page', 'silence' ) . '</span>', 'after' => '</div></div><div class="c"></div>','link_before'=>'<span class="current">' ,'link_after'=>'</span>' ) ); ?>

			<div class="under">
					<span class="date"><a class="timeago" title="<?php the_time('Y/m/d H:i:s') ?>" href="/<?php the_time('Y/m/d') ?>"><?php the_time(__('Y/m/d', 'silence')) ?></a></span>
					<span class="categories"><?php the_category(' '); ?></span>
					<span class="tags"><?php the_tags('#', '#', ''); ?></span>
					<span class="comments"><?php comments_popup_link(__('No comments', 'silence'), __('1 comment', 'silence'), __('% comments', 'silence'), '', __('Comments off', 'isimple')); ?></span>
			</div>
