<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="utf-8"> 
	<title>一米</title>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/jquery-1.9.0.js"></script>
	<!--[if lte IE 8]> 
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style/ie8.css" type="text/css" /> 
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/html5shiv.js"></script> 
	<![endif]-->
	<link rel='index' title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>" />
	<link rel="canonical" href="<?php bloginfo('url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all posts', 'iw'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all comments', 'iw'); ?>" href="<?php bloginfo('comments_rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
	<?php flush(); ?>
</head> 
<body>
	<?php $options = get_option('silence_options'); ?>
	<nav>
		<ul>
			<li><a href="/"><?php _e('Home', 'silence'); ?></a></li>
			<li>
				<a href="#"><?php _e('Categories', 'silence'); ?></a>
				<ul>
					<?php wp_list_categories('title_li=0&orderby=name&show_count=0&depth=2'); ?>
				</ul>
			</li>
			<?php $count_pages = wp_count_posts( 'page' ); ?>
			<?php if ( $count_pages->publish > 0) { ?>
			<li>
				<a href="#"><?php _e('Pages', 'silence'); ?></a>
				<ul>
					<?php wp_list_pages('title_li='); ?>
				</ul>
			</li>
			<?php } ?>
			<?php if (function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' )){ ?>
			<li>
				<a href="#"><?php _e('Menu', 'silence'); ?></a>
				<ul>
					<?php wp_nav_menu(array( 'theme_location' => 'primary','container' => '','items_wrap' => '%3$s' ));?>
				</ul>
			</li>
			<?php } ?>
			<!--<li><a href="#">烦乱</a></li>
			<li><a href="#">技术</a></li>
			<li><a href="#">心情</a></li>
			<li><a href="#">评论</a></li>-->
		</ul>
		<?php if(is_single()): ?>
		<?php if($options['ismoudleenabled']) : ?>
		<section id="tab">
			<a href="#" id="read" role="button"><?php _e('Reading', 'silence'); ?></a>
		</section>
		<?php endif; ?>
		<?php endif; ?>
	</nav>
	<div class="cl"></div>

		
	<?php if($options['background']) : ?>
	<header style="background:#2F2D37 url(<?php echo ($options['background']); ?>) no-repeat;">
	<?php else : ?>
	<header>
	<?php endif; ?>
    <section id="avatar">
    	<?php if($options['isavatarenabled']) : ?>
    	
      <a href="/" class="cover" title="<?php bloginfo('name'); ?>">
      	<?php if($options['avatarstyle'] == 1 ) : ?>
      	<?php if($options['theavatar']) : ?>
        <img src="<?php echo $options['theavatar']; ?>" class="cover" alt="<?php bloginfo('name'); ?>">
        <?php else : ?>
        <?php echo get_avatar($post->post_author, 64,bloginfo('name')); ?>
      	<?php endif; ?>
      	<?php else : ?>
      	<?php if($options['theavatar']) : ?>
        <?php echo get_avatar($options['theavatar'], 64,bloginfo('name')); ?>
        <?php else : ?>
        <?php echo get_avatar($post->post_author, 64,bloginfo('name')); ?>
      	<?php endif; ?>
      	<?php endif; ?>
        <span class="coverbg"></span>
      </a>
    	<?php else : ?>
  		<?php endif; ?>
    	

    </section>

  	<footer>
		  <h1><a href="/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
		  <h3><?php bloginfo('description'); ?></h3>
	  	<form id="search" action="<?php bloginfo('home'); ?>" method="get">
	  		<input type="text" name="s" id="s"><input type="submit" id="submit" value="<?php _e('S', 'silence'); ?>">
	  	</form>
  	</footer>
	</header>