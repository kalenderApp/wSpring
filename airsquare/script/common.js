$("a").click(function(){
	$(this).blur();  
});
$("#postcontent").hover(function(){
	$(".prepost,.nextpost").fadeIn(500);
	$("#search").stop(false,false).animate({"bottom":"30px"},500);
},function(){
	$(".prepost,.nextpost").fadeOut(500);
	$("#search").stop(false,false).animate({"bottom":"-40px"},500);
});

$(".tips").hover(function(){
	$(".tip").show();
},function(){
	$(".tip").hide();
});
$("#postlist").hover(function(){
	$(this).children(".list").stop(false,false).animate({"top":"0px"},500);//slideDown(600);
	$(".pre,.next").fadeIn(500);
	$("#nav").stop(false,false).animate({"bottom":"0"},500);
},function(){
	//$(this).children(".list").children("ul").slideUp(600);
	$(this).children(".list").stop(false,false).animate({"top":"-535px"},500);
	$(".pre,.next").fadeOut(500);
	$("#nav").stop(false,false).animate({"bottom":"-60px"},500);
});
/*
$(".list ul li").hover(function(){
	$(this).siblings().css({"background":"rgba(254,242,65,0.1)"});
},function(){
	$(this).siblings().css({"background":"rgb(135,148,159);"});
});
*/
$(".list ul li").click(function(){
	var level = $(this).attr("level");
	var href = $(this).children("a").attr("href");
	if (level == "a") {
		$.ajax({
		url:href,
		type:"GET",
		dateType:"html",
		success:function(data){
			var $content = $(data).find("#content").children(".title,.content,.under");
			$("#content").append($content);
		}
		});
	$(this).attr({"level":"b"});
	$(this).siblings("li").attr({"level":"a"});
	return false
	}else if (level == "b") {
		return true
	}
});

$("#nav li").hover(function(){
	$(this).children("ul").show();
},function(){
	$(this).children("ul").hide();
});

$("body").ajaxStart(function(){
	$("#content").children().remove();
	var loading = '<div id="loading"></div>';
	$("#content").append(loading);
});
$("body").ajaxStop(function(){
	$("#loading").remove();
});

$(".backtotop").live("click",function(){
	$("#content").scrollTop(0);
	return false
});
