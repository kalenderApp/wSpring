;
$(function(){

var color= [
"691BB8","1FAEFF","1B58B8","56C5FF","569CE3","00D8CC","00AAAA","91D100","B81B6C","E1B700"
];





	var $search = $("#search"),
			$s      = $("#s");
	$search.hover(function(){
		$search.stop().animate({"width":"125px"},1000);
		$s.stop().animate({"width":"100px"},1000);
	},function(){
		$search.stop().animate({"width":"25px"},1000);
		$s.stop().animate({"width":"0px"},1000);
	});

	var $progress = $("#progress"),
			$pro      = $("#pro"),
			$top      = $("#top"),
			$bot      = $("#bot");
	$(window).scroll(function(){
		var sheight = $(window).scrollTop(),
				wheight = $(window).height(),
				bheght  = $("body").height(),
				height  = (sheight/(bheght-wheight))*100;

		if (height < 0) {
			$pro.css({"height":0});
		} else if (height > 100) {
			$pro.css({"height":100});
		} else {
			$pro.css({"height":height});
		};

	});

	$top.click(function(){
		$("body, html").animate({scrollTop: "0px"},500);
		console.log("Top");
		return false
	});
	/*
	$progress.click(function(){
		$("body, html").animate({scrollTop: $("body").height()/2-$(window).height()/2},500);
		console.log("progress");
		return false
	});
*/
	$bot.click(function(){
		$("body, html").animate({scrollTop: $("body").height()},500);
		console.log("bot");
		return false
	});

	function position(){
		var bwidth = $("body").width(),
				awidth = $("#posts").width();
		//$progress.css("left",bwidth/2+awidth/2+50);
		$progress.stop().animate({"right":bwidth/2-awidth/2-50},500);
	}
//position();
var isRead = eval($.cookie("isRead")) || false;
if (isRead && isSingle) {
	var t;
} else {
	var t = setTimeout(function(){position()},50);
};
	$(window).resize(function(){
		clearTimeout(t);
		var t = setTimeout(function(){position()},50);
	});




function getMenu(){
	var $article = $("#posts article");
	var $a       = $article.children("h2").children("a");
	var title  = [];
	var pos    = [];
	for (var i = 0, len = $article.length; i < len; i++) {
		pos.push($article.eq(i).offset().top);
		title.push($a.eq(i).text());
	};
	//console.log(pos);
	//console.log(title);
	return {
		"title" : title,
		"pos"   : pos
	}
}

function makeMenu(){
	var info = getMenu();
	var html = '';
	var len  = info.title.length;
	for (var i = 0; i < len; i++) {
		html += '<div class="menu" style="height:'+100/len+'px;background:#'+randomColor()+';" onclick="setPos('+info.pos[i]+')" title="'+info.title[i]+'"></div>';
	};
	$("#progress").append(html);
}




makeMenu();






});

function setPos(pos){
	$("html,body").animate({"scrollTop":pos},500);
	return false
}

function randomColor() {
    var rand = Math.floor(Math.random( ) * 0xFFFFFF).toString(16);
    if(rand.length == 6){
        return rand;
    }else{
        return randomColor();
    }
}