<!DOCTYPE html>
<html>
<head> 
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?><?php wp_title(); ?></title> 
<?php 
	$options = get_option('analytics_options');
	$description = "";
	$keywords = "";
	if(is_home()) {
		$description = $options['description'];
		$keywords = $options['keywords'];
	}else if(is_single()) {
		$description = substr(strip_tags($post->post_content),1,200);//the_excerpt();
		$keywords = strip_tags(get_the_tag_list('', ', ', '')); 
	}
?>
<?php
	function ShowSeoDescription($strings) {
		if ($strings) {
			echo $strings;
		}else echo bloginfo('name');
	}
	function ShowSeoKeywords($strings) {
		if ($strings) {
			echo $strings;
		}else echo bloginfo('description');
	}
?>
<meta name="description" content="<?php ShowSeoDescription($description); ?>" />
<meta name="keywords" content="<?php ShowSeoKeywords($keywords); ?>" />
<?php rsd_link(); ?>
<?php wlwmanifest_link(); ?>
<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all posts', 'iw'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all comments', 'iw'); ?>" href="<?php bloginfo('comments_rss2_url'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<!--[if lte IE 8]>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style/ie8.css" type="text/css" media="screen" />
  <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/html5.js"></script>
<![endif]-->
<!--[if lte IE 6]>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style/ie6.css" type="text/css" media="screen" />
  <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/ie6.js"></script>
<![endif]-->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel='index' title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>" />
</head>
<?php flush(); ?>
<body>
<!--Login form-->
<?php if (!(current_user_can('level_0'))){ ?>
<div id="layout">
	<div id="loginpop">
		<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
			<p>
				<label>
					<?php _e('Username:','breakup'); ?><input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" />
				</label>
			</p>
			<p>
				<label><?php _e('Password :','breakup'); ?><input type="password" name="pwd" id="pwd" size="20" /></label>
			</p>
			<p>
				<input type="submit" name="submit" value="<?php _e('Login','breakup'); ?>" class="submit center" />
			</p>
			<p class="remember">
				<label for="rememberme">
					<input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" />
						<?php _e('Remember','breakup'); ?>
				</label>
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" /> 
			</p> 
		</form>
		<a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword"><?php _e('Recover password','breakup'); ?></a>
	</div>
</div>
<?php }else { ?>
<div id="layout">
	<div id="loginpop">
	<a class="logout" href="<?php echo wp_logout_url($_SERVER['REQUEST_URI']); ?>"><?php _e('Logout','breakup'); ?></a><br />
	</div>
</div>
<?php } ?> 
<!--Login form-->
<div id="tips"><span></span></div>
<div class="color">
  <span class="one"></span><span class="two"></span><span class="three"></span><span class="four"></span>
</div>
<div id="header">
  <div class="nav_left"><?php if (is_single()) {next_post_link('%link');}else{previous_posts_link(__('', 'breakup'));} ?></div>
	<div class="nav">
	<?php if (function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' )){ ?>
	<ul class="menu">
      <li id="active">
        <a href="<?php bloginfo('url'); ?>"><?php _e('Home','breakup'); ?></a>
      </li>
	<?php wp_nav_menu(array( 'theme_location' => 'primary','container' => '','items_wrap' => '%3$s' ));?>
	</ul>
	<?php }else{ ?>
	<ul class="menu">
      <li id="active">
        <a href="<?php bloginfo('url'); ?>"><?php _e('Home','breakup'); ?></a>
      </li>
    <?php wp_list_categories('title_li=0&orderby=name&show_count=0&depth=0'); ?>
    </ul>
	<?php } ?>
    <?php 
					if($options['twitter']){
					 $twitter = $options['twitter'];	
					}else{
            $twitter = "#";  
          }
					if($options['gplus']){
						$gplus = $options['gplus'];
					}else{
            $gplus = "#";  
          }
		?>
		<!-- 获取选项 -->
    <ul class="right">
      <li class="rss">
        <a href="<?php bloginfo('rss2_url'); ?>"></a>
      </li>
      <li class="twitter">
        <a href="https://twitter.com/<?php echo $twitter; ?>" target= "_blank"></a>
      </li>
      <li class="gplus">
        <a href="https://plus.google.com/<?php echo $gplus; ?>" target= "_blank"></a>
      </li>
    </ul>
  </div>
  <div class="nav_right"><?php  if (is_single()) {previous_post_link('%link');}else{next_posts_link(__('', 'breakup'));} ?></div>
</div>