<?php get_header(); ?>
<div id="main">
  <div id="left">
    <div class="logo">
    	<?php
      $options = get_option('analytics_options'); 
			if($options['logo']){
				$logo = $options['logo'];
				echo '<a href="';?><?php bloginfo("url"); ?><?php echo '"><img src="'.$logo.'" alt="'; ?><?php bloginfo("name"); ?><?php echo '" /></a>';?>	
			<?php }	?>
      <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
    </div>
    <div class="desp">
      <h3><?php bloginfo('description'); ?></h3>
    </div>
    <div class="tips">
	<span><?php _e('You can scroll the page using PageUp and PageDown', 'breakup'); ?></span>
	<p> </p><p> </p>
	<p><span>此主题出售，<a href="http://yimi.in/2011/08/01/breakup.html">详情</a></span></p>
    </div>
  </div>
  
  
  
  
  
  
  
  <div id="right">
    <div class="comments">
      	<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
      	<?php
		    global $withcomments;
		    $withcomments = true;
		    comments_template("/inline-comments.php");
		?>
		<?php endwhile; else : ?>
    	<?php endif; ?>
     </div>
    <div class="clear"></div>
  </div>
  
  
  
  
  
  <div id="center" style="width:0px;min-width:390px;">
    <div class="title">
    <?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
      <h2><?php the_title(); ?></h2>
    </div>
    <div class="content">
     <?php the_content(); ?>
    </div>
	<div class="clear"></div>
    <div class="under">
      <span class="time"><?php _e('Date: ', 'breakup'); ?></span><span><?php the_time(__('Y.m.j', 'breakup')) ?></span><span class="categories"><?php _e('Categories: ', 'breakup'); ?></span><span><?php the_category(', '); ?></span><span class="tags"><?php _e('Tags: ', 'breakup'); ?></span><span><?php the_tags('', ', ', ''); ?></span>
    <?php endwhile; else : ?>
    <?php endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>