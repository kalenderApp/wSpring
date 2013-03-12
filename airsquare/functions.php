<?php
remove_filter('the_content', 'wptexturize');
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
register_nav_menus(array(
	'primary' => __('Navigation','airsquare')
));
/** l10n */
function theme_init(){
	load_theme_textdomain('airsquare', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');

// Post Format 2012/5/25
add_theme_support( 'post-formats', array( 'aside','gallery','link','image','quote','status','video','audio','chat' ) );

// 链接自动识别播放, 来自 林木木，感谢
function auto_player_urls($c) {
    $s = array('/^<p>(htt(p|ps):\/\/.*\.mp3)<\/p>$/m' => '<p><embed class="mp3_player" src="'.get_bloginfo("template_url").'/images/mp3player.swf?url=$1&amp;color=#DDE0E0" width="645" height="60" style="margin-left:-32px;" type="application/x-shockwave-flash"></embed></p>',
    '/^<p>(http:\/\/.*\.swf)<\/p>$/m' => '<p><embed class="swf_player" src="$1" width="500" height="280" type="application/x-shockwave-flash"></embed></p>');
    foreach($s as $p => $r){
        $c = preg_replace($p,$r,$c);
    }
    return $c;
}
add_filter( 'the_content', 'auto_player_urls' );


?>
<?php
 
/**
 * 选项组类型
 */
class airSquareOptions {
 
	/* -- 获取选项组 -- */
	function getOptions() {
		// 在数据库中获取选项组
		$options = get_option('airsquare_options');
		// 如果数据库中不存在该选项组, 设定这些选项的默认值, 并将它们插入数据库
		if (!is_array($options)) {
			$options['windowsp7'] = false;
			$options['analytics'] = false;
			$options['analytics_content'] = '';
			$options['twitter'] = '';
			$options['gplus'] = '';
			$options['tips'] = '';
			$options['commentads'] = '';
			$options['background'] = '';
			//$options['description'] = '';
			//$options['keywords'] = '';
			//$options['logo'] = '';
			// TODO: 在这里追加其他选项
			update_option('airsquare_options', $options);
		}
		// 返回选项组
		return $options;
	}
 
	/* -- 初始化 -- */
	function init() {
		// 如果是 POST 提交数据, 对数据进行限制, 并更新到数据库
		if(isset($_POST['airsquare_save'])) {
			// 获取选项组, 因为有可能只修改部分选项, 所以先整个拿下来再进行更改
			$options = airSquareOptions::getOptions();
 
			// 数据限制
			if ($_POST['analytics']) {
				$options['analytics'] = (bool)true;
			} else {
				$options['analytics'] = (bool)false;
			}
			if ($_POST['windowsp7']) {
				$options['windowsp7'] = (bool)true;
			} else {
				$options['windowsp7'] = (bool)false;
			}
			$options['analytics_content'] = stripslashes($_POST['analytics_content']);
			$options['gplus'] = stripslashes($_POST['gplus']);
			$options['twitter'] = stripslashes($_POST['twitter']);
			$options['tips'] = stripslashes($_POST['tips']);
			$options['commentads'] = stripslashes($_POST['commentads']);
			$options['background'] = stripslashes($_POST['background']);
			//$options['description'] = stripslashes($_POST['description']);
			//$options['keywords'] = stripslashes($_POST['keywords']);
			//$options['logo'] = stripslashes($_POST['logo']);
			// TODO: 在这追加其他选项的限制处理
 
			// 更新数据
			update_option('airsquare_options', $options);
 
		// 否则, 重新获取选项组, 也就是对数据进行初始化
		} else {
			airSquareOptions::getOptions();
		}
 
		// 在后台 Design 页面追加一个标签页, 叫 Current Theme Options
		add_theme_page("Theme Options", __('Theme Options','airsquare'), 'edit_themes', basename(__FILE__), array('airSquareOptions', 'display'));
	}
 
	/* -- 标签页 -- */
	function display() {
		$options = airSquareOptions::getOptions();
?>
 
<form action="#" method="post" enctype="multipart/form-data" name="classic_form" id="airsquare_form">
	<div class="wrap">
		<h2><?php _e('Current Theme Options', 'airsquare'); ?></h2>
 
		<!-- 公告栏 -->
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Analytics', 'airsquare'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'airsquare') ?></small>
					</th>
					<td>
						<!-- 是否显示公告栏 -->
						<label>
							<input name="analytics" type="checkbox" value="checkbox" <?php if($options['analytics']) echo "checked='checked'"; ?> />
							 <?php _e('enabled analytics.', 'airsquare'); ?>
						</label>
						<br/>
						<!-- 公告栏内容 -->
						<label>
							<textarea name="analytics_content" cols="50" rows="8" id="analytics_content" style="width:98%;font-size:12px;" class="code"><?php echo($options['analytics_content']); ?></textarea>
						</label>
					</td>
				</tr>
				<!--<tr>
				<th scope="row">
						<?php _e('Logo', 'airsquare'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Logo url', 'airsquare') ?></small>
				</th>
					<td>
						<!-- Logo -->
						<!-- <label>
							<textarea name="logo" cols="50" rows="1" id="logo" style="width:98%;font-size:12px;" class="code"><?php echo($options['logo']); ?></textarea>
						</label>
					</td>
				</tr>-->
				<tr>
				<th scope="row">
						<?php _e('Twitter', 'airsquare'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Username', 'airsquare') ?></small>
				</th>
					<td>
						<!-- Twitter -->
						<label>
							<input name="twitter" type="text" id="twitter" style="width:98%;font-size:12px;" class="code" value="<?php echo($options['twitter']); ?>" />
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('G+', 'airsquare'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('G+ Number', 'airsquare') ?></small>
				</th>
					<td>
						<!-- G+ Input box -->
						<label>
							<input name="gplus" type="text" id="gplus" style="width:98%;font-size:12px;" class="code" value="<?php echo($options['gplus']); ?>" />
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('Tips', 'airsquare'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Tips Content HTML enabled,Separated by semicolons', 'airsquare') ?></small>
				</th>
					<td>
						<!-- tips Input box -->
						<label>
							<textarea name="tips" cols="50" rows="8" id="tips" style="width:98%;font-size:12px;" class="code"><?php echo($options['tips']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('Commentads', 'airsquare'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Ads Code 125*125 HTML enabled', 'airsquare') ?></small>
				</th>
					<td>
						<!-- Commentads -->
						<label>
							<textarea name="commentads" cols="50" rows="8" id="commentads" style="width:98%;font-size:12px;" class="code"><?php echo($options['commentads']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr>
				<th scope="row">
						<?php _e('Background', 'airsquare'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('The Left Background Image', 'airsquare') ?></small>
				</th>
					<td>
						<!-- Commentads -->
						<input type="hidden" name="background" id="background" value="<?php echo ($options['background']) ? ($options['background']) : ('background0'); ?>" />
						<ul class="background" style="border:1px solid #CCC;overflow:hidden;width:98%;padding:3px 0;">
							<li style="float:left;padding:5px;cursor:pointer;margin:0;" val="background0"><img style="width:80px;height:120px;" src="../wp-content/themes/airsquare/images/background/background0-thumbs.png" /></li>
							<li style="float:left;padding:5px;cursor:pointer;margin:0;" val="background1"><img style="width:80px;height:120px;" src="../wp-content/themes/airsquare/images/background/background1-thumbs.png" /></li>
							<li style="float:left;padding:5px;cursor:pointer;margin:0;" val="background2"><img style="width:80px;height:120px;" src="../wp-content/themes/airsquare/images/background/background2-thumbs.png" /></li>
							<li style="float:left;padding:5px;cursor:pointer;margin:0;" val="background3"><img style="width:80px;height:120px;" src="../wp-content/themes/airsquare/images/background/background3-thumbs.png" /></li>
							<li style="float:left;padding:5px;cursor:pointer;margin:0;" val="background4"><img style="width:80px;height:120px;" src="../wp-content/themes/airsquare/images/background/background4-thumbs.png" /></li>
							<li style="float:left;padding:5px;cursor:pointer;margin:0;" val="background5"><img style="width:80px;height:120px;" src="../wp-content/themes/airsquare/images/background/background5-thumbs.png" /></li>
							<li style="float:left;padding:5px;cursor:pointer;margin:0;" val="background6"><img style="width:80px;height:120px;" src="../wp-content/themes/airsquare/images/background/background6-thumbs.png" /></li>
							<li style="float:left;padding:5px;cursor:pointer;margin:0;" val="background7"><img style="width:80px;height:120px;" src="../wp-content/themes/airsquare/images/background/background7-thumbs.png" /></li>
							<li style="float:left;padding:5px;cursor:pointer;margin:0;" val="background8"><img style="width:80px;height:120px;" src="../wp-content/themes/airsquare/images/background/background8-thumbs.png" /></li>
							<li style="float:left;padding:5px;cursor:pointer;margin:0;" val="background9"><img style="width:80px;height:120px;" src="../wp-content/themes/airsquare/images/background/background9-thumbs.png" /></li>
						</ul>
					</td>
				</tr>
				<script type="text/javascript">
					var $=jQuery;
					$(".background li[val=<?php echo ($options['background']) ? ($options['background']) : ('background0'); ?>]").css({"background":"blue"});
					$(".background li").click(function(){
							var bg = $(this).attr("val");
							$("#background").val(bg);
							$(".background li").css({"background":"#FFF"});
							$(this).css({"background":"blue"});
						})
				</script>
				<tr>
					<th scope="row">
						<?php _e('Windows Phone 7 Style', 'airsquare'); ?>
					</th>
					<td>
						<!-- 是否启用 Windows Phone 7 风格 -->
						<label>
							<input name="windowsp7" type="checkbox" value="checkbox" <?php if($options['windowsp7']) echo "checked='checked'"; ?> />
							 <?php _e('enabled Windows Phone 7 Style.', 'airsquare'); ?>
						</label>
					</td>
				</tr>
				<!--<tr>
				<th scope="row">
						<?php _e('Description', 'airsquare'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Site Description', 'airsquare') ?></small>
					
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
						<?php _e('Keywords', 'airsquare'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Site Keywords', 'airsquare') ?></small>
					
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
			<input type="submit" name="airsquare_save" value="<?php _e('Update Options', 'airsquare'); ?>" />
		</p>
	</div>
 
</form>
 
<?php
	}
}
 
/**
 * 登记初始化方法
 */
add_action('admin_menu', array('airSquareOptions', 'init'));
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
				<?php printf(__('%1$s', 'airsquare'), get_comment_time(__('Y.m.j', 'airsquare')),'' ); ?>
			    <span class="action">
					<a class="reply" href="#comment-<?php comment_ID() ?>" ><?php _e('Reply', 'airsquare'); ?></a> | 
					<a class="quote" href="#" ><?php _e('Quote', 'airsquare'); ?></a>
					<?php
						if (function_exists("qc_comment_edit_link")) {
							qc_comment_edit_link('', ' | ', '', __('Edit', 'airsquare'));
						}
						edit_comment_link(__('Edit', 'airsquare'), ' | ', '');
					?>
				</span>
			</div>
			
			<div class="fixed"></div>
			<div class="content">
				<?php if ($comment->comment_approved == '0') : ?>
					<p><small><?php _e('Your comment is awaiting moderation.', 'airsquare'); ?></small></p>
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
?>