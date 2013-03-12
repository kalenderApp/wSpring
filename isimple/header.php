<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
<meta name="description" content="<?php echo get_bloginfo( 'description', 'display' ); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php rsd_link(); ?>
<?php wlwmanifest_link(); ?>
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<?php flush(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/jquery.min.js?v=1.7.2"></script>
<!--[if lte IE 7]>
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/kill-ie6.css" type="text/css" media="screen" />
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/kill-ie6.js"></script>
<![endif]-->
<!--[if lte IE 9]>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/ie-placeholder.js"></script>
<![endif]-->
<!--响应式设计-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--响应式设计-->
</head>
<body>
	<!--Header BEGIN-->
		<div id="header">
			<div id="logo">
			<h1 class="wpname"><a href="/"><?php bloginfo('name'); ?></a></h1><h5 class="description"><?php bloginfo('description'); ?></h5>
			</div>
			<div id="nav" class="navstatic">
				<ul>
					<?php wp_list_categories('title_li=0&orderby=name&show_count=0&depth=2'); ?>
					<?php if (function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' )){ ?>
								<?php wp_nav_menu(array( 'theme_location' => 'primary','container' => '','items_wrap' => '%3$s' ));?>
						<?php } ?>
				</ul>
				<div class="c"></div>
			</div>
	</div><!--Header END-->
	<div id="search"><!--Search Begin-->
		<div class="search">
			<form action="<?php bloginfo('home'); ?>" method="get">
				<input type="text" class="searchbox" name="s" ie-placeholder="<?php _e('Keywords', 'isimple'); ?>" placeholder="<?php _e('Keywords', 'isimple'); ?>" x-webkit-speech>
				<input type="submit" class="submit" value="<?php _e('Search', 'isimple'); ?>">
			</form>
		 </div>
	<div class="search-error" style="display:none;"><?php _e('Please input some keywords!', 'isimple'); ?></div>
	<span id="show" one="<?php _e('Search', 'isimple'); ?>" two="<?php _e('Cancel', 'isimple'); ?>"><?php _e('Search', 'isimple'); ?></span>
	</div><!--Search Begin-->