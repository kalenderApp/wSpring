<?php
remove_filter('the_content', 'wptexturize');
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
register_nav_menus(array(
	'primary' => __('Navigation','breakup')
));
/** l10n */
function theme_init(){
	load_theme_textdomain('breakup', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');
?>
<?php
 
/**
 * 选项组类型
 */
class analyticsOptions {
 
	/* -- 获取选项组 -- */
	function getOptions() {
		// 在数据库中获取选项组
		$options = get_option('analytics_options');
		// 如果数据库中不存在该选项组, 设定这些选项的默认值, 并将它们插入数据库
		if (!is_array($options)) {
			$options['analytics'] = false;
			$options['analytics_content'] = '';
			$options['twitter'] = '';
			$options['gplus'] = '';
			$options['description'] = '';
			$options['keywords'] = '';
			$options['logo'] = '';
			// TODO: 在这里追加其他选项
			update_option('analytics_options', $options);
		}
		// 返回选项组
		return $options;
	}
 
	/* -- 初始化 -- */
	function init() {
		// 如果是 POST 提交数据, 对数据进行限制, 并更新到数据库
		if(isset($_POST['analytics_save'])) {
			// 获取选项组, 因为有可能只修改部分选项, 所以先整个拿下来再进行更改
			$options = analyticsOptions::getOptions();
 
			// 数据限制
			if ($_POST['analytics']) {
				$options['analytics'] = (bool)true;
			} else {
				$options['analytics'] = (bool)false;
			}
			$options['analytics_content'] = stripslashes($_POST['analytics_content']);
			$options['gplus'] = stripslashes($_POST['gplus']);
			$options['twitter'] = stripslashes($_POST['twitter']);
			$options['description'] = stripslashes($_POST['description']);
			$options['keywords'] = stripslashes($_POST['keywords']);
			$options['logo'] = stripslashes($_POST['logo']);
			// TODO: 在这追加其他选项的限制处理
 
			// 更新数据
			update_option('analytics_options', $options);
 
		// 否则, 重新获取选项组, 也就是对数据进行初始化
		} else {
			analyticsOptions::getOptions();
		}
 
		// 在后台 Design 页面追加一个标签页, 叫 Current Theme Options
		add_theme_page("Theme Options", __('Theme Options','breakup'), 'edit_themes', basename(__FILE__), array('analyticsOptions', 'display'));
	}
 
	/* -- 标签页 -- */
	function display() {
		$options = analyticsOptions::getOptions();
?>
 
<form action="#" method="post" enctype="multipart/form-data" name="classic_form" id="analytics_form">
	<div class="wrap">
		<h2><?php _e('Current Theme Options', 'breakup'); ?></h2>
 
		<!-- 公告栏 -->
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Analytics', 'breakup'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'breakup') ?></small>
					</th>
					<td>
						<!-- 是否显示公告栏 -->
						<label>
							<input name="analytics" type="checkbox" value="checkbox" <?php if($options['analytics']) echo "checked='checked'"; ?> />
							 <?php _e('enabled analytics.', 'breakup'); ?>
						</label>
						<br/>
						<!-- 公告栏内容 -->
						<label>
							<textarea name="analytics_content" cols="50" rows="8" id="analytics_content" style="width:98%;font-size:12px;" class="code"><?php echo($options['analytics_content']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('Logo', 'breakup'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Logo url', 'breakup') ?></small>
					
				</th>
					<td>
						<!-- Logo -->
						<label>
							<textarea name="logo" cols="50" rows="1" id="logo" style="width:98%;font-size:12px;" class="code"><?php echo($options['logo']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('Twitter', 'breakup'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Username', 'breakup') ?></small>
					
				</th>
					<td>
						<!-- Twitter -->
						<label>
							<textarea name="twitter" cols="50" rows="1" id="twitter" style="width:98%;font-size:12px;" class="code"><?php echo($options['twitter']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('G+', 'breakup'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('G+ Number', 'breakup') ?></small>
					
				</th>
					<td>
						<!-- G+ Input box -->
						<label>
							<textarea name="gplus" cols="50" rows="1" id="gplus" style="width:98%;font-size:12px;" class="code"><?php echo($options['gplus']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('Description', 'breakup'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Site Description', 'breakup') ?></small>
					
				</th>
					<td>
						<!-- Description -->
						<label>
							<textarea name="description" cols="50" rows="3" id="description" style="width:98%;font-size:12px;" class="code"><?php echo($options['description']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('Keywords', 'breakup'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Site Keywords', 'breakup') ?></small>
					
				</th>
					<td>
						<!-- Keywords -->
						<label>
							<textarea name="keywords" cols="50" rows="3" id="keywords" style="width:98%;font-size:12px;" class="code"><?php echo($options['keywords']); ?></textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>
 
		<!-- TODO: 在这里追加其他选项内容 -->
 
		<!-- 提交按钮 -->
		<p class="submit">
			<input type="submit" name="analytics_save" value="<?php _e('Update Options', 'breakup'); ?>" />
		</p>
	</div>
 
</form>
 
<?php
	}
}
 
/**
 * 登记初始化方法
 */
add_action('admin_menu', array('analyticsOptions', 'init'));
?>
<?php
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' =>  __('Sidebar_top','breakup'), // 侧边栏的名称
		'before_widget' => '<li class="widget">', // widget 的开始标签
		'after_widget' => '</li>', // widget 的结束标签
		'before_title' => '<h3>', // 标题的开始标签
		'after_title' => '</h3>' // 标题的结束标签
 
	));
 
	register_sidebar(array(
		'name' =>  __('Sidebar_center','breakup'), // 侧边栏的名称
		'before_widget' => '<li class="widget">', // widget 的开始标签
		'after_widget' => '</li>', // widget 的结束标签
		'before_title' => '<h3>', // 标题的开始标签
		'after_title' => '</h3>' // 标题的结束标签
 
	));
	register_sidebar(array(
		'name' =>  __('Sidebar_bottom','breakup'), // 侧边栏的名称
		'before_widget' => '<li class="widget">', // widget 的开始标签
		'after_widget' => '</li>', // widget 的结束标签
		'before_title' => '<h3>', // 标题的开始标签
		'after_title' => '</h3>' // 标题的结束标签
 
	));
}
?>
<?php 
function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}

?>
	<li class="comment <?php if($comment->comment_author_email == get_the_author_email()) {echo 'admincomment';} else {echo 'regularcomment';} ?>" id="comment-<?php comment_ID() ?>">
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
				<?php printf(__('%1$s', 'breakup'), get_comment_time(__('Y.m.j', 'breakup')),'' ); ?>
			    <span class="action">
			    	<a class="reply" href="#comment-<?php comment_ID() ?>"></a>
					<a class="reply" href="#" ><?php _e('Reply', 'breakup'); ?></a> | 
					<a class="quote" href="#" ><?php _e('Quote', 'breakup'); ?></a>
					<?php
						if (function_exists("qc_comment_edit_link")) {
							qc_comment_edit_link('', ' | ', '', __('Edit', 'breakup'));
						}
						edit_comment_link(__('Edit', 'breakup'), ' | ', '');
					?>
				</span>
			</div>
			
			<div class="fixed"></div>
			<div class="content">
				<?php if ($comment->comment_approved == '0') : ?>
					<p><small><?php _e('Your comment is awaiting moderation.', 'breakup'); ?></small></p>
				<?php endif; ?>

				<div id="commentbody-<?php comment_ID() ?>">
					<?php comment_text(); ?>
				</div>
			</div>
		</div>
		<div class="clear"></div>
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