 <div id="footer">
	<div id="copyright">
       <?php
			global $wpdb;
			$post_datetimes = $wpdb->get_row($wpdb->prepare("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970"));
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes->firstyear;
				$lastpost_year = $post_datetimes->lastyear;

				$copyright = __('Copyright &copy; ', 'lighterblue') . $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= ' ';

				echo $copyright;
				bloginfo('name');
			}
		?>
	</div>
	<div id = "themeinfo">
		<?php printf(__('<a href="http://wordpress.org/">WordPress</a> | <a href="http://yimi.in/2011/05/09/lighterblue.html">LighterBlue</a>','lighterblue')) ?>
		 | <a href="<?php bloginfo('rss2_url') ?>" class="rss" title="RSS">RSS</a> 
		<?php $options = get_option('analytics_options'); ?>
		<?php 
					if($options['twitter']){
						$twitter = $options['twitter'];
						echo '<a href="https://twitter.com/'.$twitter.'" target= "_blank" class="twitter" title="Twitter">Twitter</a>';}
		?>
		<!-- 获取选项 -->

		
		<!-- 如果用户选择显示统计代码, 并且有代码, 则显示出来 -->
		<?php if($options['analytics'] && $options['analytics_content']) : ?>
			<?php echo($options['analytics_content']); ?>
		<?php endif; ?>
	</div>
       <div class="cl"> </div>
    </div>
    <br><br>
</div>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/gls_c.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.spasticNav.js"></script>

<script type="text/javascript">
$('#closesidebar a').toggle(function(){
	$(this).text("<?php echo (_e('show siderbar','lighterblue')); ?>");
	$('#sidebar').hide();
	$('#content').animate({width: "920px"}, 1000);
	$('#respond textarea').animate({width: "750px"}, 1000);
	},function(){
	$(this).text("<?php echo (_e('close siderbar','lighterblue')); ?>");
	$('#sidebar').delay(800).show(0);
	$('#content').animate({width: "634px"}, 800);
	$('#respond textarea').animate({width: "460px"}, 1000);

});
</script>

<?php if($options['tips']){
	$tips= $options['tips'];
	$arr = list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o) = split(";",$tips);
	echo '<div id="footertips">
	<a id="closetip" href="javascript:void(0);">Close</a>
	<div id="tips"><div class="laodao">';
	foreach ($arr as $value) {
			echo '<span style="display:none;">'.$value."</span>";
		}
	echo '</div></div>
</div>';}
?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scrolltopcontrol.js"></script>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/searchtips.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/extern_footer.js"></script>


</body>
</html>