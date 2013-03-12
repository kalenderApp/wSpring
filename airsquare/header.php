<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
<meta name="description" content="<?php echo get_bloginfo( 'description', 'display' ); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php rsd_link(); ?>
<?php wlwmanifest_link(); ?>
<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all posts', 'iw'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all comments', 'iw'); ?>" href="<?php bloginfo('comments_rss2_url'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel='index' title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>" />
<link rel="canonical" href="<?php bloginfo('url'); ?>" />
<?php flush(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/jquery-1.7.min.js"></script>
<!--[if lte IE 8]>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style/ie8.css" type="text/css" media="screen" />
<![endif]-->
<!--[if lte IE 7]>
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style/ie6.css" type="text/css" media="screen" />
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/ie6.js"></script>
<![endif]-->
</head>
<body>
