;
$(function(){
	var $posts = $("#posts");
	var $nav   = $("nav");
	var $pagination = $("#pagination");
	//$section.children("article:first").css("height","230px");
	/*$("#read").click(function(){
		$posts.animate({"margin-top":"-300px","width":"600px"},1000);
		$nav.animate({"width":"600px"},1000);
		return false
	});
	$("#show").click(function(){
		$posts.animate({"margin-top":"0px","width":"400px"},1000);
		$nav.animate({"width":"400px"},1000);
		return false
	});
	*/
	/*
	$("#read").toggle(function(){
		$posts.animate({"margin-top":"-300px","width":"600px"},1000);
		$nav.animate({"width":"600px"},1000);
		$(this).text("浏览模式");
		return false
	},function(){
		$posts.animate({"margin-top":"0px","width":"400px"},1000);
		$nav.animate({"width":"400px"},1000);
		$(this).text("阅读模式");
		return false
	});
	*/
	var isRead = eval($.cookie("isRead")) || false;

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
	/*
	if (isRead) {
		$posts.stop().animate({"margin-top":"-300px","width":"600px"},1000);
		$nav.stop().animate({"width":"600px"},1000);
		$pagination.stop().animate({"width":"600px"},1000);
		$("#read").text("浏览模式");
	}else{
		$posts.stop().animate({"margin-top":"0px","width":"400px"},1000);
		$nav.stop().animate({"width":"400px"},1000);
		$pagination.stop().animate({"width":"400px"},1000);
		$("#read").text("阅读模式");
	};
	*/
}

module();




var $search = $("#search");
var $s      = $("#s");
$search.hover(function(){
	$search.stop().animate({"width":"125px"},1000);
	$s.stop().animate({"width":"100px"},1000);
},function(){
	$search.stop().animate({"width":"25px"},1000);
	$s.stop().animate({"width":"0px"},1000);
});

});

