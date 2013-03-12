<?php
remove_filter('the_content', 'wptexturize');
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
register_nav_menus(array(
	'primary' => __('Navigation','ospring')
));
/** l10n */
function theme_init(){
	load_theme_textdomain('ospring', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');

// Post Format 2012/5/25
add_theme_support( 'post-formats', array( 'aside','gallery','link','image','quote','status','video','audio','chat' ) );

?>
<?php
/**
 * 选项组类型
 */
class oSpringHFFOptions {
	/* -- 获取选项组 -- */
	function getOptions() {
		// 在数据库中获取选项组
		$options = get_option('oSpring_HFF_options');
		// 如果数据库中不存在该选项组, 设定这些选项的默认值, 并将它们插入数据库
		if (!is_array($options)) {
			$options['analytics'] = false;
			$options['isshare'] = false;
			$options['iscommentads'] = false;
			//$options['shareid'] = '';
			$options['analytics_content'] = '';
			$options['linenumb'] ='';
			$options['commentads'] = '';
			//$options['keywords'] = '';
			//$options['logo'] = '';
			// TODO: 在这里追加其他选项
			update_option('oSpring_HFF_options', $options);
		}
		// 返回选项组
		return $options;
	}
	/* -- 初始化 -- */
	function init() {
		// 如果是 POST 提交数据, 对数据进行限制, 并更新到数据库
		if(isset($_POST['oSpring_HFF_save'])) {
			// 获取选项组, 因为有可能只修改部分选项, 所以先整个拿下来再进行更改
			$options = oSpringHFFOptions::getOptions();
 
			// 数据限制
			if ($_POST['analytics']) {
				$options['analytics'] = (bool)true;
			} else {
				$options['analytics'] = (bool)false;
			}
			if ($_POST['isshare']) {
				$options['isshare'] = (bool)true;
			} else {
				$options['isshare'] = (bool)false;
			}
			if ($_POST['iscommentads']) {
				$options['iscommentads'] = (bool)true;
			} else {
				$options['iscommentads'] = (bool)false;
			}

			//$options['shareid'] = $_POST['shareid'];
			$options['linenumb'] = $_POST['linenumb'];
			$options['analytics_content'] = stripslashes($_POST['analytics_content']);
			$options['commentads'] = stripslashes($_POST['commentads']);
			//$options['logo'] = stripslashes($_POST['logo']);
			// TODO: 在这追加其他选项的限制处理
			// 更新数据
			update_option('oSpring_HFF_options', $options);
		// 否则, 重新获取选项组, 也就是对数据进行初始化
		} else {
			oSpringHFFOptions::getOptions();
		}
		// 在后台 Design 页面追加一个标签页, 叫 Current Theme Options
		add_theme_page("Theme Options", __('Theme Options','ospring'), 'edit_themes', basename(__FILE__), array('oSpringHFFOptions', 'display'));
	}
	/* -- 标签页 -- */
	function display() {
		$options = oSpringHFFOptions::getOptions();
?>
<form action="#" method="post" enctype="multipart/form-data" name="classic_form" id="ospring_form">
	<div class="wrap">
		<h2><?php _e('Current Theme Options', 'ospring'); ?></h2>
		<!-- 公告栏 -->
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Analytics', 'ospring'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'ospring') ?></small>
					</th>
					<td>
						<!-- 是否启用统计功能 -->
						<label>
							<input name="analytics" type="checkbox" value="checkbox" <?php if($options['analytics']) echo "checked='checked'"; ?> />
							 <?php _e('enabled analytics.', 'ospring'); ?>
						</label>
						<br/>
						<!-- 统计功能代码内容 -->
						<label>
							<textarea name="analytics_content" cols="50" rows="8" id="analytics_content" style="width:98%;font-size:12px;" class="code"><?php echo($options['analytics_content']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<?php _e('Share', 'ospring'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Baidu Share ID', 'ospring') ?></small>
					</th>
					<td>
						<!-- 是否启用统计功能 -->
						<label>
							<input name="isshare" type="checkbox" value="checkbox" <?php if($options['isshare']) echo "checked='checked'"; ?> />
							 <?php _e('enabled Share.', 'ospring'); ?>
						</label>
						<br/>
						<!-- 统计功能代码内容 -->
						<!--<label>
							<input name="shareid" cols="50" rows="8" id="shareid" style="width:98%;font-size:12px;" class="code" value=<?php echo($options['shareid']); ?>>
						</label>-->
					</td>
				</tr>
						
				<tr>
				<th scope="row">
						<?php _e('Footer line Number', 'ospring'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('The number of the new comments, rand post and link in footer ', 'ospring') ?></small>
				</th>
					<td>
						<!-- Twitter -->
						<label><input class="wp" name="linenumb" cols="50" rows="8" type="input" value="<?php if($options['linenumb']); ?>"  /></label>

					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('Comment Ads', 'ospring'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Ads Code 125*125 HTML enabled', 'ospring') ?></small>
				</th>
					<td>
						<label>
							<input name="iscommentads" type="checkbox" value="checkbox" <?php if($options['iscommentads']) echo "checked='checked'"; ?> />
							 <?php _e('enabled comment ad.', 'ospring'); ?>
						</label>
						<br/>
						<!-- Comment Ads -->
						<label>
							<textarea name="commentads" cols="50" rows="8" id="commentads" style="width:98%;font-size:12px;" class="code"><?php echo($options['commentads']); ?></textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- TODO: 在这里追加其他选项内容 -->
		<!-- 提交按钮 -->
		<p class="submit">
			<input type="submit" name="oSpring_HFF_save" value="<?php _e('Update Options', 'ospring'); ?>" />
		</p>
	</div>
 
</form>
<?php
	}
}
/**
 * 登记初始化方法
 */
add_action('admin_menu', array('oSpringHFFOptions', 'init'));
?>
<?php  
function oSpring_comment($comment, $args, $depth) { // 来源于 iArtWork 主题，感谢作者
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
	 <?php echo get_avatar($comment,$size='38'); ?>
     <div id="comment-<?php comment_ID(); ?>">
	  <div class="comment-meta">
	   <?php printf(__('<span class="name">%s</span>'), get_comment_author_link()) ?>
		<span class="comment_mete_time"><?php echo time_ago(); ?></span>
		<span class="comment_meta_edit"><?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply','ospring'),'depth' => $depth, 'max_depth' => $args['max_depth']))); edit_comment_link(__('Edit','ospring')); ?></span>
	  </div>
	  
	  <?php if ($comment->comment_approved == '0') : ?>
         <em><span class="moderation"><?php _e('Your comment is awaiting moderation.','ospring') ?></span></em>
         <br />
      <?php endif; ?>
	  
      <div class="text">
		  <?php comment_text() ?>
	  </div>
	  
      
     </div>
<?php } ?>
<?php 
// Time Ago by Fanr 来源于 iArtWork 主题，感谢作者
	function time_ago( $type = 'commennt', $day = 30 ) {
		$d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
		$timediff = time() - $d('U');
		if ($timediff <= 60*60*24*$day){
		echo  human_time_diff($d('U'), strtotime(current_time('mysql', 0))), __('ago','ospring');
		}
		if ($timediff > 60*60*24*$day){
		echo  date('Y/m/d',get_comment_date('U')), ' ', get_comment_time('H:i');
		};
	}
?>
<?php
/*标签云变色*/
function colorCloud($text) { 
    $text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text); 
    return $text; 
} 
function colorCloudCallback($matches) { 
    $text = $matches[1]; 
    $color = dechex(rand(0,16777215)); 
    $pattern = '/style=(\'|\")(.*)(\'|\")/i'; 
    $text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text); 
    return "<a $text>"; 
} 
add_filter('wp_tag_cloud', 'colorCloud', 1);
function tag_cloud_filter($args = array()) { 
    $args['smallest'] = 10; 
    $args['largest'] = 20; 
    $args['unit'] = 'px'; 
    return $args; 
} 
add_filter('widget_tag_cloud_args','tag_cloud_filter', 90);
/*标签云变色*/
?>
<?php
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src, $img, $siteurl){
    return get_bloginfo('template_directory').'/images/smilies/'.$img;
}
/**
 * Display previous post link that is adjacent to the current post.
 *
 * @since 1.5.0
 *
 * @param string $format Optional. Link anchor format.
 * @param string $link Optional. Link permalink format.
 * @param bool $in_same_cat Optional. Whether link should be in same category.
 * @param string $link_title Optional. Define the link title what is display when mouse hover the link.
 * @param string $excluded_categories Optional. Excluded categories IDs.
 */
function lt_previous_post_link($format='« %link', $link='%title', $in_same_cat = false, $link_title = '', $excluded_categories = '') {
    lt_adjacent_post_link($format, $link, $in_same_cat, $link_title, $excluded_categories, true);
}
/**
 * Display next post link that is adjacent to the current post.
 *
 * @since 1.5.0
 *
 * @param string $format Optional. Link anchor format.
 * @param string $link Optional. Link permalink format.
 * @param bool $in_same_cat Optional. Whether link should be in same category.
 * @param string $link_title Optional. Define the link title what is display when mouse hover the link.
 * @param string $excluded_categories Optional. Excluded categories IDs.
 */
function lt_next_post_link($format='%link »', $link='%title', $in_same_cat = false, $link_title = '', $excluded_categories = '') {
    lt_adjacent_post_link($format, $link, $in_same_cat, $link_title, $excluded_categories, false);
}
/**
 * Display adjacent post link.
 *
 * Can be either next post link or previous.
 *
 * @since 2.5.0
 *
 * @param string $format Link anchor format.
 * @param string $link Link permalink format.
 * @param bool $in_same_cat Optional. Whether link should be in same category.
 * @param string $link_title Optional. Define the link title what is display when mouse hover the link.
 * @param string $excluded_categories Optional. Excluded categories IDs.
 * @param bool $previous Optional, default is true. Whether display link to previous post.
 */
function lt_adjacent_post_link($format, $link, $in_same_cat = false, $link_title = '', $excluded_categories = '', $previous = true) {
    if ( $previous && is_attachment() )
        $post = & get_post($GLOBALS['post']->post_parent);
    else
        $post = get_adjacent_post($in_same_cat, $excluded_categories, $previous);
 
    if ( !$post ){
      //  return;
	$string = '';
    $link = __('None', 'ospring');
	$format = str_replace('%link', $link, $format);
    $adjacent = $previous ? __('Prev', 'ospring') : __('Next', 'ospring');
    echo apply_filters( "{$adjacent}_post_link", $format, $link );
	return;
	}

    $title = $post->post_title;
 
    if ( empty($post->post_title) )
        $title = $previous ? __('Previous Post', 'ospring') : __('Next Post', 'ospring');
 
    $title = apply_filters('the_title', $title, $post->ID);
    $date = mysql2date(get_option('date_format'), $post->post_date);
    $rel = $previous ? __('Next', 'ospring') : __('Prev', 'ospring');
	$rel = $rel ? $rel : __('None', 'ospring');
	
    //$string = '<a href="'.get_permalink($post).'" title="'.$link.'" rel="'.$rel.'">';
    $link = str_replace('%title', $title, $link);
    $link = str_replace('%date', $date, $link);
	$string = '<a href="'.get_permalink($post).'" title="'.$link.'" rel="'.$rel.'">';
    $link = $string . $rel. '</a>';
    $format = str_replace('%link', $link, $format);
 
    $adjacent = $previous ? __('Prev', 'ospring') : __('Next', 'ospring');
    echo apply_filters( "{$adjacent}_post_link", $format, $link );
}
?>
<?php 
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
?>