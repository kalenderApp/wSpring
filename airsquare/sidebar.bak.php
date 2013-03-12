		<?php $options = get_option('airsquare_options'); ?>
		<?php 
		if($options['background']){
			$background = $options['background'];	
		}else{
			$background = "background0";  
		}
		?>
		<div id="postlist" class="l" style="background:url(/wp-content/themes/airsquare/images/background/<?php echo $background; ?>.png) no-repeat #DEDFDA;">
			<div class="list">
				<div id="header">
					<h1><?php bloginfo('name'); ?></h1>
					<h3><?php bloginfo('description'); ?></h3>
					<span class="tips"><?php _e('You can scroll the page using PageUp and PageDown', 'airsquare'); ?></span>
				</div>
					<?php $posts = get_posts( "numberposts=24&orderby=rand"); ?>
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
				<!--<ul>
					<li>
						<a href="http://i.w/?post=1"></a>
						<span></span>
					</li>
					<li>
						<a href="#"></a>
						<!--<span></span>
					</li>
					<li>
						<a href="#"></a>
						<!--<span></span>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
					<li>
						<a href="#"></a>
					</li>
				</ul>-->
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
							<!--<a href="#">分类</a>-->
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
							<!--<li><a href="#">工具</a></li>-->
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="c"></div>
