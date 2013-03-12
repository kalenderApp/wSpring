jQuery(document).ready(
	function(){
		// 当鼠标聚焦在搜索框
		jQuery('#search .searchfield').focus(
			function() {
				// 如果搜索框的内容是 "Type text to search here...", 文字颜色变深, 内容清空.
				if(jQuery(this).val() == 'Search') {
					jQuery(this).css({color:"#555"}).val('');
				}
			}
		// 当鼠标在搜索框失去焦点
		).blur(
			function(){
				// 如果搜索框的内容是空, 则文字颜色变浅, 显示 "Type text to search here..." 字样.
				if(jQuery(this).val() == '') {
					jQuery(this).css({color:"#999"}).val('Search');
				}
			}
		);
		// 当点击搜索按钮时
		jQuery('#search .searchbutton').click(
			function() {
				// 如果搜索框内容是 "Type text to search here..." 或者是空, 不进行任何操作.
				if(jQuery('#search .searchfield').val() == '' || jQuery('#search .searchfield').val() == 'Search') {
					return false;
				// 否则提交并进行搜索
				} else {
					jQuery(this).submit();
				}
			}
		);
		// DOM 加载完毕时发生的事件
		jQuery(
			function() {
				// 如果搜索框内容是 "Type text to search here..." 或者是空, 文字颜色变浅, 显示 "Type text to search here..." 字样.
				if(jQuery('#search .searchfield').val() == '' || jQuery('#search .searchfield').val() == 'Search') {
					jQuery('#search .searchfield').css({color:"#999"}).val('Search');
				}
			}
		);
	}
)