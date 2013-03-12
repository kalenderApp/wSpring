<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
<?php 
	$options = get_option('analytics_options');
	$description = "";
	$keywords = "";
	if(is_home()) {
		$description = $options['description'];
		$keywords = $options['keywords'];
	}else if(is_single()) {
		$description = mb_strimwidth(strip_tags($post->post_content),1,200);//the_excerpt();
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
<link rel="canonical" href="<?php bloginfo('url'); ?>" />
</head>
<body>
<div id="page">
<?php if(!is_404()) : ?>
	<div id="closesidebar"><a href="javascript:void(0);"><?php echo (_e('close siderbar','lighterblue')); ?></a></div>

<?php endif; ?>
    <div id="header">
        <div id="logo">
             <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> 
			 <div class="description"><?php bloginfo('description'); ?></div>
        </div>
        <div id="search">
            <form method="get" action="<?php bloginfo('home'); ?>">
                 <input class="searchfield" type="text" gyunsu="enabled" name="s" title="Search" value="<?php _e('Search','lighterblue'); ?>">
                 <input class="searchbutton" type="submit" value="">
             </form>
        </div>
        <div class="cl"> </div>
		
        <div id="navs">
            <ul id="nav">
			<li id="selected"><a href="<?php bloginfo('url'); ?>" title="<?php _e('home','lighterblue'); ?>"><?php _e('home','lighterblue'); ?></a></li>
			<?php wp_list_categories('title_li=0&orderby=name&show_count=0&style=list'); ?>
            </ul>
        </div>
    </div>