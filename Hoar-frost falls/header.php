<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
  <link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
  <!--[if lte IE 8]> 
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/html5shiv.js"></script>
  <![endif]-->
  <!--[if lte IE 7]>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style/kill-ie6.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/kill-ie6.js"></script>
  <![endif]-->
  <link rel='index' title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>" />
  <link rel="canonical" href="<?php bloginfo('url'); ?>" />
  <link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all posts', 'iw'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all comments', 'iw'); ?>" href="<?php bloginfo('comments_rss2_url'); ?>" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_head(); ?>
  <?php flush(); ?>
  <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/jquery-1.9.0.js?v=1.9"></script>
</head>
<body>
  <header id="header">
    <h1><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
    <h3><?php bloginfo('description'); ?></h3>
    <nav>
      <ul id="parent">
        <?php 
          wp_list_categories('title_li=0&orderby=name&show_count=0&depth=2');//分类列表
          $count_pages = wp_count_posts( 'page' ); //页面
          if ( $count_pages->publish > 0) { 
            wp_list_pages('title_li=&depth=1');
          }
          if (function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' )) { //自定义菜单
            wp_nav_menu(array( 'theme_location' => 'primary','container' => '','items_wrap' => '%3$s' ));
          }
        ?>


        <!--<li class="current"><a href="#">首页</a></li>
        <li><a href="#">团队</a></li>
        <li><a href="#">归档</a></li>
        <li><a href="#">留言</a></li>
        <li><a href="#">友链</a></li>
        <li><a href="#">关于</a></li>
        <li><a href="#">订阅</a></li>
        <li><a href="#">折腾</a></li>
        <li><a href="#">Typecho</a></li>-->
      </ul>
      <form onsubmit="javascript:if($('#searchbox').val() == ''){alert('请输入关键字！');return false}" id="search" action="<?php bloginfo('home'); ?>" method="get">
          <input type="text" id="searchbox" name="s" value=""><input type="submit" id="submitsearch" value="<?php _e('S', 'ospring'); ?>">
      </form>
    </nav>
  </header>

  <div id="bar">
    <div class="green"></div>
    <div class="ltergreen"></div>
    <div class="yellow"></div>
    <div class="deepred"></div>
    <div class="red"></div>
  </div>
  
  <section>