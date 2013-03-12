(function(){
	var lang = [
			'非常抱歉，本站不支持 ',
			' ！',
			'请不要惊奇为什么您使用的是 ',
			'360/腾讯TT/世界之窗/遨游/搜狗',
			' 等浏览器，还会收到此提示，那是因为这些浏览器只是 IE 的外壳，其内核仍为 IE6 ，所以您实际上使用的还是 IE6 浏览器（双核中的高速模式除外）。',
			'请下载：',
			'安装之后再浏览'
		   ];
	var isClose = 0; //是否可以关闭

	var html = '<p>'+lang[0]+'<strong style="color:#F00;">IE6</strong>'+lang[1]+'</p><p>'+lang[2]+'<strong>'+lang[3]+'</strong>'+lang[4]+'</p><p>'+lang[5]+'</p><ul><li><a href="http://chrome.google.com" target="_blank"><img src="http://yimity.com/wp-content/themes/isimple/images/chrome.gif"><span>CHROME</span></a></li><li><a href="http://firefox.com.cn/" target="_blank"><img src="http://yimity.com/wp-content/themes/isimple/images/firefox.gif"><span>FIREFOX</span></a></li><li><a href="http://www.apple.com/safari/download/" target="_blank"><img src="http://yimity.com/wp-content/themes/isimple/images/safari.gif"><span>SAFARI</span></a></li><li><a href="http://www.opera.com/download/" target="_blank"><img src="http://yimity.com/wp-content/themes/isimple/images/opera.gif"><span>OPERA</span></a></li><li><a href="http://windows.microsoft.com/zh-CN/internet-explorer/downloads/ie-9/worldwide-languages" target="_blank"><img src="http://yimity.com/wp-content/themes/isimple/images/ie9.gif"><span>IE9</span></a></li></ul><p>'+lang[6]+'</p>'+(isClose == 1 ?('<a href="javascript:;" id="kill-ie6-close" onclick="this.blur();closeKillIe6();">'):"")+'</a>';

	var layoutiframe           = document.createElement("div");
		layoutiframe.id        = "kill-ie6";
		layoutiframe.innerHTML = '<iframe id="kill-ie6-iframe" frameborder="no" border="0"></iframe>';
	document.getElementsByTagName("body")[0].appendChild(layoutiframe);

	var kill_ie6_show           = document.createElement("div");
		kill_ie6_show.id        = "kill-ie6-show";
		kill_ie6_show.innerHTML = html;
	document.getElementsByTagName("body")[0].appendChild(kill_ie6_show);

	

})();

var closeKillIe6 = function(){
		var kill_ie6      = document.getElementById("kill-ie6"),
				kill_ie6_show = document.getElementById("kill-ie6-show"),
				body          = document.getElementsByTagName("body")[0],
				html          = document.getElementsByTagName("html")[0];
		kill_ie6.style.display = "none";
		kill_ie6_show.style.display = "none";
		body.style.overflow = "visible";
		html.style.overflow = "visible";
	}