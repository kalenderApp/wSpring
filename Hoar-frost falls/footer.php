<?php
  $options  = get_option('oSpring_HFF_options');
  $linenumb = $options['linenumb'] ? $options['linenumb'] : 10;
?>

  <!--<nav class="pagination clearfix" id="pagination">
    <div class="wp-pagenavi">
      <span class="pages">3 /1</span>
      <span class="current">1</span>
      <a href="http://i.w/?paged=2" class="page larger">2</a>
      <a href="http://i.w/?paged=3" class="page larger">3</a>
      <a href="http://i.w/?paged=2" class="nextpostslink">&gt;</a>
    </div>            
  </nav>-->


  <footer id="footer">
    <div id="newcomments">
      <span class="title">最近回复</span>
      <ul>
        <?php
          $args = array('number'=>$linenumb,'status'=>'approve','user_id'=>0,'type'=>'comment');
          $comments = get_comments($args);
          foreach($comments as $comment) :
            if (mb_strlen($comment->comment_author.$comment->comment_content) >= 16) {
              $commenttext = mb_substr($comment->comment_content,0,(14-mb_strlen($comment->comment_author)),'utf-8');
            } else {
              $commenttext = $comment->comment_content;
            }
            
            echo('<li>'.$comment->comment_author. '：'.'<a title="'.$comment->comment_content.'" href="index.php?p='.$comment->comment_post_ID.'#'.$comment->comment_ID.'">' . $commenttext.'</a></li>');
          endforeach;
        ?>
        <!--<li>Typecho : <a href="http://localhost/typecho/index.php/archives/1/#comment-1">欢迎加入Typecho大家族</a></li>-->
      </ul>
    </div>
    <div id="randposts">
      <span class="title">随机文章</span>
      <ul>
        <?php $rand_post = get_posts('numberposts='.$linenumb.'&orderby=rand'); 
        foreach( $rand_post as $post ) : ?> 
        <?php if (mb_strlen($post->post_title) >= 17) : ?>
          <?php $post_title = mb_substr($post->post_title,0,16,'utf-8'); ?>
        <?php else : ?>
          <?php $post_title = $post->post_title; ?>
        <?php endif; ?>
        <?php //print_r($rand_post); ?>
        <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo $post_title; ?></a></li> 
        
        <?php endforeach; ?>
        <!--<li><a href="http://localhost/typecho/index.php/archives/1/#comment-1">欢迎加入Typecho大家族</a></li>-->
      </ul>
    </div>
    <div id="links">
      <span class="title">友情链接</span>
        <?php 
        $args = array('orderby'=>'rand','title_li'=>' ','title_before'=>'','title_after'=>'','class'=>'','limit'=>$linenumb,'categorize'=>0,'category_before'=>'','category_after'=>'' ); 
        wp_list_bookmarks( $args );
        ?>
        <!--<li><a href="http://localhost/typecho/index.php/archives/1/#comment-1">欢迎加入Typecho大家族</a></li>-->
    </div>
    <footer>© <a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> <?php echo __('Theme <a href="http://yimity.com/2013/03/20/wordpress-free-theme-hoar-frost-falls.html">Hoar-frost Falls</a> by <a href="https://yimity.com/" target="_blank">一米</a> Thanks <a href="http://ben-lab.com/" target="_blank">Ben</a> & <a target="_blank" href="https://www.dnshh.com/">Hang</a>','ospring'); ?> <?php echo __('Proudly powered by','ospring'); ?><a title="<?php echo __('Proudly powered by WordPress','ospring'); ?>" href="http://WordPress.org" target="_blank">WordPress</a></footer>
  </footer>

  <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/hoar-frost-falls.js?v=1"></script>

  <?php //if (!is_single() && !is_page()) : ?>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/jquery.scrollMenu.js?v=1"></script>
  <script type="text/javascript">
    $(".title h3 a").scrollMenu({
		color:function randomColor() {
				var rand = Math.floor(Math.random( ) * 0xFFFFFF).toString(16);
				if(rand.length == 6){
					return "#"+rand;
				}else{
					return randomColor();
				}
			}
	});
  </script>
  <?php //endif; ?>

<?php 
  if($options['analytics'] && $options['analytics_content']) {
    echo ($options['analytics_content']);
  }
?>
  <!--[if lte IE 8]> 
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script/ie-placeholder.js"></script>
  <![endif]-->
</body>
</html>