;
$(function(){
	var $posts = $("#posts");
	var $nav   = $("nav");
	var $pagination = $("#pagination");
	var $img   = $("article img");
	var $progress = $("#progress");
	var isRead = eval($.cookie("isRead")) || false;

	var lang   = ["阅读模式","浏览模式"];

	$("#read").click(function(){
		if (!isRead) {
			isRead = true;
			$.cookie("isRead","true", { expires: 7 });
		} else {
			isRead = false;
			$.cookie("isRead","false", { expires: 7 });
		};
		module();
		return false
	});

function module(){
	if (isRead) {
		$posts.stop().animate({"margin-top":"-300px","width":"1200px"},1000,function(){position()});
		$nav.stop().animate({"width":"1200px"},1000);
		$pagination.stop().animate({"width":"1200px"},1000);
		$img.css("max-width","1026px");
		$("#read").text(lang[1]);
	}else{
		$posts.stop().animate({"margin-top":"0px","width":"600px"},1000,function(){position()});
		$nav.stop().animate({"width":"600px"},1000);
		$pagination.stop().animate({"width":"600px"},1000);
		$img.css("max-width","426px");
		$("#read").text(lang[0]);
	};

}

module();


function position(){
	var bwidth = $("body").width(),
			awidth = $("#posts").width();
	$progress.stop().animate({"right":bwidth/2-awidth/2-50},500);
}

});