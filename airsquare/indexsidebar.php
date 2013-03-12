<?php 
		if($options['background']){
			$background = $options['background'];	
		}else{
			$background = "background0";  
		}
		?>
		<div id="postlist" style="background:url(/wp-content/themes/airsquare/images/background/<?php echo $background; ?>.png) no-repeat #DEDFDA;">
			<div id="header">
				<h1><?php bloginfo('name'); ?></h1>
				<h3><?php bloginfo('description'); ?></h3>
			</div>
			<div class="list">
					<?php $posts = get_posts( "numberposts=24"); ?>
					<?php if( $posts ) : ?>
					<ul>
						<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
						<li level="a">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'iw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
							<span class="date"><?php the_time('Y.m.j'); ?></span>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
			</div>
			<div class="pre"><?php previous_posts_link(__('Old Posts', 'airsquare')); ?></div>
			<div class="next"><?php next_posts_link(__('New posts', 'airsquare')); ?></div>
			<div class="c"></div>
			<div id="nav">
					<ul>
						<li class="first selected">
							<a href="/"><?php _e('Home', 'airsquare'); ?></a>
						</li>
						<li>
							<a href="#"><?php _e('Categories', 'airsquare'); ?></a>
							<ul>
								<?php wp_list_categories('title_li=0&orderby=name&show_count=0&depth=2'); ?>
							</ul>
						</li>
						<?php $count_pages = wp_count_posts( 'page' ); ?>
						<?php if ( $count_pages->publish > 0) { ?>
						<li>
							<a href="#"><?php _e('Pages', 'airsquare'); ?></a>
							<ul>
								<?php wp_list_pages('title_li='); ?>
							</ul>
						</li>
						<?php } ?>
						<?php if (function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' )){ ?>
						<li>
							<a href="#"><?php _e('Menu', 'airsquare'); ?></a>
							<ul>
								<?php wp_nav_menu(array( 'theme_location' => 'primary','container' => '','items_wrap' => '%3$s' ));?>
							</ul>
						</li>
						<?php } ?>
					</ul>
			</div>