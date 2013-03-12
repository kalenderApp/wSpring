<?php
remove_filter('the_content', 'wptexturize');
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
register_nav_menus(array(
	'primary' => __('Navigation','silence')
));
/** l10n */
function theme_init(){
	load_theme_textdomain('silence', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');

// Post Format 2012/5/25
add_theme_support( 'post-formats', array( 'aside','gallery','link','image','quote','status','video','audio','chat' ) );

// 链接自动识别播放, 来自 林木木，感谢
/*
function auto_player_urls($c) {
    $s = array('/^<p>(http:\/\/.*\.mp3)<\/p>$/m' => '<p><embed class="mp3_player" src="'.get_bloginfo("template_url").'/images/mp3player.swf?url=$1" width="645" height="60" style="margin-left:-32px;" type="application/x-shockwave-flash"></embed></p>',
    '/^<p>(http:\/\/.*\.swf)<\/p>$/m' => '<p><embed class="swf_player" src="$1" width="500" height="280" type="application/x-shockwave-flash"></embed></p>');
    foreach($s as $p => $r){
        $c = preg_replace($p,$r,$c);
    }
    return $c;
}
add_filter( 'the_content', 'auto_player_urls' );
*/

?>
<?php
/**
 * 选项组类型
 */
class silenceOptions {
	/* -- 获取选项组 -- */
	function getOptions() {
		// 在数据库中获取选项组
		$options = get_option('silence_options');
		// 如果数据库中不存在该选项组, 设定这些选项的默认值, 并将它们插入数据库
		if (!is_array($options)) {
			$options['analytics'] = false;
			$options['isavatarenabled'] = 1;
			$options['ismoudleenabled'] = 1;
			$options['avatarstyle'] = 0;
			$options['theavatar'] = '';
			$options['analytics_content'] = '';
			$options['background'] ='';
			//$options['description'] = '';
			//$options['keywords'] = '';
			//$options['logo'] = '';
			// TODO: 在这里追加其他选项
			update_option('silence_options', $options);
		}
		// 返回选项组
		return $options;
	}
	/* -- 初始化 -- */
	function init() {
		// 如果是 POST 提交数据, 对数据进行限制, 并更新到数据库
		if(isset($_POST['silence_save'])) {
			// 获取选项组, 因为有可能只修改部分选项, 所以先整个拿下来再进行更改
			$options = silenceOptions::getOptions();
 
			// 数据限制
			if ($_POST['analytics']) {
				$options['analytics'] = (bool)true;
			} else {
				$options['analytics'] = (bool)false;
			}
			if ($_POST['isavatarenabled']) {
				$options['isavatarenabled'] = 1;
			} else {
				$options['isavatarenabled'] = 0;
			}
			if ($_POST['ismoudleenabled']) {
				$options['ismoudleenabled'] = 1;
			} else {
				$options['ismoudleenabled'] = 0;
			}
			$options['avatarstyle'] = $_POST['avatarstyle'];
			$options['theavatar'] = $_POST['theavatar'];
			$options['analytics_content'] = stripslashes($_POST['analytics_content']);
			$options['background'] = stripslashes($_POST['background']);
			//$options['keywords'] = stripslashes($_POST['keywords']);
			//$options['logo'] = stripslashes($_POST['logo']);
			// TODO: 在这追加其他选项的限制处理
			// 更新数据
			update_option('silence_options', $options);
		// 否则, 重新获取选项组, 也就是对数据进行初始化
		} else {
			silenceOptions::getOptions();
		}
		// 在后台 Design 页面追加一个标签页, 叫 Current Theme Options
		add_theme_page("Theme Options", __('Theme Options','silence'), 'edit_themes', basename(__FILE__), array('silenceOptions', 'display'));
	}
	/* -- 标签页 -- */
	function display() {
		$options = silenceOptions::getOptions();
?>
<form action="#" method="post" enctype="multipart/form-data" name="classic_form" id="silence_form">
	<div class="wrap">
		<h2><?php _e('Current Theme Options', 'silence'); ?></h2>
		<!-- 公告栏 -->
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Analytics', 'silence'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'silence') ?></small>
					</th>
					<td>
						<!-- 是否启用统计功能 -->
						<label>
							<input name="analytics" type="checkbox" value="checkbox" <?php if($options['analytics']) echo "checked='checked'"; ?> />
							 <?php _e('enabled analytics.', 'silence'); ?>
						</label>
						<br/>
						<!-- 统计功能代码内容 -->
						<label>
							<textarea name="analytics_content" cols="50" rows="8" id="analytics_content" style="width:98%;font-size:12px;" class="code"><?php echo($options['analytics_content']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('Background', 'silence'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Background url', 'silence') ?></small>
				</th>
					<td>
						<!-- Logo -->
						<label>
							<textarea name="background" cols="50" rows="1" id="topbg" style="width:98%;font-size:12px;" class="code"><?php echo($options['background']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<?php _e('Avatar', 'silence'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Avatar url or email', 'silence') ?></small>
					</th>
					<td>
						<!-- 启用不同的评论系统 -->
						<label><input class="wp" name="isavatarenabled" type="Checkbox" value="1" <?php if($options['isavatarenabled'] == 1) echo "checked='checked'"; ?> /><?php _e('Enabled the avatar', 'silence'); ?></label>
						<br>
						<label><input class="wp" name="avatarstyle" type="radio" value="0" <?php if($options['avatarstyle'] == 0) echo "checked='checked'"; ?> /><?php _e('Use the email to avatar', 'silence'); ?></label>
						<label><input class="ds" name="avatarstyle" type="radio" value="1" <?php if($options['avatarstyle'] == 1) echo "checked='checked'"; ?> /><?php _e('Use the custom picture', 'silence'); ?> &nbsp; <a href="/wp-content/themes/silence/instruction/duoshuo.html" target="_blank"><?php _e('How to', 'silence'); ?></a></label>
						<br>
						<textarea name="theavatar" cols="50" rows="1" id="theavatar" style="width:98%;font-size:12px;" class="code"><?php echo $options['theavatar']; ?></textarea>
						<br>
						<label class="theavatar" for="theavatar" <?php if($options['isavatarenabled'] == 1) echo "style='display:block;'"; ?>><?php _e('Please input a email or a url or leave it blank for the admin\'s email .', 'silence'); ?>
						</label>
					</td>
				</tr>
				
				<tr>
				<th scope="row">
						<?php _e('Enabled Module', 'silence'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Enabled the read or show module', 'silence') ?></small>
				</th>
					<td>
						<!-- Twitter -->
						<label><input class="wp" name="ismoudleenabled" type="Checkbox" value="1" <?php if($options['ismoudleenabled'] == 1) echo "checked='checked'"; ?> /></label>

					</td>
				</tr>
				<!--<tr>
				<th scope="row">
						<?php _e('G+', 'silence'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('G+ Number', 'silence') ?></small>
				</th>
					<td>-->
						<!-- G+ Input box -->
						<!--<label>
							<input name="gplus" type="text" id="gplus" style="width:98%;font-size:12px;" class="code" value="<?php echo($options['gplus']); ?>" />
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('Tips', 'silence'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Tips Content HTML enabled,Separated by semicolons', 'silence') ?></small>
				</th>
					<td>-->
						<!-- tips Input box -->
						<!--<label>
							<textarea name="tips" cols="50" rows="8" id="tips" style="width:98%;font-size:12px;" class="code"><?php echo($options['tips']); ?></textarea>
						</label>
					</td>
				</tr>-->
				<!--<tr>
				<th scope="row">
						<?php _e('Comment Ads', 'silence'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Ads Code 125*125 HTML enabled', 'silence') ?></small>
				</th>
					<td>-->
						<!-- Comment Ads -->
						<!--<label>
							<textarea name="commentads" cols="50" rows="8" id="commentads" style="width:98%;font-size:12px;" class="code"><?php echo($options['commentads']); ?></textarea>
						</label>
					</td>
				</tr>-->
				<script type="text/javascript">
					var $=jQuery;
						$(".wp").click(function(){
							$(".dsname").hide();
						});
						$(".ds").click(function(){
							$(".dsname").show();
						});
				</script>
				<!--<tr>
				<th scope="row">
						<?php _e('Description', 'silence'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Site Description', 'silence') ?></small>
				</th>
					<td>
						<!-- Description -->
						<!--<label>
							<textarea name="description" cols="50" rows="3" id="description" style="width:98%;font-size:12px;" class="code"><?php echo($options['description']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('Keywords', 'silence'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Site Keywords', 'silence') ?></small>
				</th>
					<td>-->
						<!-- Keywords -->
						<!--<label>
							<textarea name="keywords" cols="50" rows="3" id="keywords" style="width:98%;font-size:12px;" class="code"><?php echo($options['keywords']); ?></textarea>
						</label>
					</td>
				</tr>-->
			</tbody>
		</table>
		<!-- TODO: 在这里追加其他选项内容 -->
		<!-- 提交按钮 -->
		<p class="submit">
			<input type="submit" name="silence_save" value="<?php _e('Update Options', 'silence'); ?>" />
		</p>
	</div>
 
</form>
<?php
	}
}
/**
 * 登记初始化方法
 */
add_action('admin_menu', array('silenceOptions', 'init'));
?>
<?php 
function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>
	<li <?php if($comment->comment_author_email == get_the_author_email()) {$admincomment = 'admincomment';} else {$admincomment = 'regularcomment';} ?> <?php comment_class($admincomment); ?> id="comment-<?php comment_ID() ?>">
		<div class="author">
			<div class="pic">
				<?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 32); } ?>
			</div>
			<div class="name">
				<?php if (get_comment_author_url()) : ?>
					<a id="commentauthor-<?php comment_ID() ?>" class="url" href="<?php comment_author_url() ?>" rel="external nofollow"><?php else : ?><span id="commentauthor-<?php comment_ID() ?>"><?php endif; ?><?php comment_author(); ?><?php if(get_comment_author_url()) : ?></a>
				<?php else : ?>
					</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="info">
			<div class="date">
				<?php printf(__('%1$s', 'silence'), get_comment_time(__('Y.m.j', 'silence')),'' ); ?>
			    <span class="action">
					<a class="reply" href="#comment-<?php comment_ID() ?>" ><?php _e('Reply', 'silence'); ?></a> | 
					<a class="quote" href="#" ><?php _e('Quote', 'silence'); ?></a>
					<?php
						if (function_exists("qc_comment_edit_link")) {
							qc_comment_edit_link('', ' | ', '', __('Edit', 'silence'));
						}
						edit_comment_link(__('Edit', 'silence'), ' | ', '');
					?>
				</span>
			</div>
			<div class="fixed"></div>
			<div class="content">
				<?php if ($comment->comment_approved == '0') : ?>
					<p><small><?php _e('Your comment is awaiting moderation.', 'silence'); ?></small></p>
				<?php endif; ?>

				<div id="commentbody-<?php comment_ID() ?>">
					<?php comment_text(); ?>
				</div>
			</div>
		</div>
		<div class="c"></div>
<?php
}
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
    $link = __('None', 'silence');
	$format = str_replace('%link', $link, $format);
    $adjacent = $previous ? __('Prev', 'silence') : __('Next', 'silence');
    echo apply_filters( "{$adjacent}_post_link", $format, $link );
	return;
	}

    $title = $post->post_title;
 
    if ( empty($post->post_title) )
        $title = $previous ? __('Previous Post', 'silence') : __('Next Post', 'silence');
 
    $title = apply_filters('the_title', $title, $post->ID);
    $date = mysql2date(get_option('date_format'), $post->post_date);
    $rel = $previous ? __('Next', 'silence') : __('Prev', 'silence');
	$rel = $rel ? $rel : __('None', 'silence');
	
    //$string = '<a href="'.get_permalink($post).'" title="'.$link.'" rel="'.$rel.'">';
    $link = str_replace('%title', $title, $link);
    $link = str_replace('%date', $date, $link);
	$string = '<a href="'.get_permalink($post).'" title="'.$link.'" rel="'.$rel.'">';
    $link = $string . $rel. '</a>';
    $format = str_replace('%link', $link, $format);
 
    $adjacent = $previous ? __('Prev', 'silence') : __('Next', 'silence');
    echo apply_filters( "{$adjacent}_post_link", $format, $link );
}
?>