				<div class="title">
					<h2 class="l"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2><?php edit_post_link( __( 'Edit', 'airsquare' ), '<span class="edit-link r">', '</span>' ); ?>
					<div class="c"></div>
				</div>
				<div class="content">
					<?php the_content(); ?>
				</div>
				<div class="under">
					<span class="time"><?php _e('Date: ', 'airsquare'); ?></span><span><?php the_time(__('Y.m.j', 'airsquare')) ?></span><span class="categories"><?php _e('Categories: ', 'airsquare'); ?></span><span><?php the_category(', '); ?></span><span class="tags"><?php _e('Tags: ', 'airsquare'); ?></span><span><?php the_tags('', ', ', ''); ?></span>
				</div>
