$(function(){

$("#tips").ajaxStart(function(){
	var text="加载中...";
  	$("#tips span").text(text);
	$("#tips").css("background","blue").fadeIn(500);
 });
$("#tips").ajaxStop(function(){
	$("#tips").fadeOut(500);
 });

  $("ul.menu li").click(function(){
    $(this).attr("id","active").siblings("li").attr("id","");
    var href = $(this).children("a").attr("href");
    $.ajax({
    type:"POST",
    dataType:"html",
    url:href,
    success:function(data){
	  $("#center").children().remove();
      var $nav_left = $(data).children(".nav_left").children();
      var $nav_right = $(data).children(".nav_right").children();
      var $content = $(data).children("#center").children();
      var $comments = $(data).children("#right").children();
      $(".nav_left").children().remove().end().append($nav_left);
      $(".nav_right").children().remove().end().append($nav_right);
      $("#center").append($content);
      $("#right").children().remove().end().append($comments);
    }
  })
    return false;
  });

  $(".keywords").click(function(){
    var text = $(this).val();
    if (text == "关键字"){
      $(this).val("");    
    }
  });
  $(".keywords").blur(function(){
    var text = $(this).val();
    if (text == ""){
      $(this).val("关键字");    
    }
  });

  $(".pagenum").click(function(){
    var text = $(this).val();
    if (text == "页码"){
      $(this).val("");    
    }
  });
  $(".pagenum").blur(function(){
    var text = $(this).val();
    if (text == ""){
      $(this).val("页码");    
    }
  });
  
  $("ul.commentlist li:odd .info").css({"background":"rgb(248,241,135)"});
  $("ul.commentlist li:even .info").css({"background":"rgb(204,224,157)"});
  
  $("a").click(function(){
    $(this).blur();  
  });
  
  $("a.reply").click(function(){
	var reply_href = $(this).siblings(".reply:eq(0)").attr("href");
	var reply_username = $(this).parents(".info").siblings(".author").children(".name").children("a").text();
	if (!reply_username){
		var reply_username = $(this).parents(".info").siblings(".author").children(".name").text();
	}
	var $reply_html = '<a href="'+reply_href+'">@'+$.trim(reply_username)+'</a>';
	$("#comment").text($reply_html);
	return false; 
  });
  $("a.quote").click(function(){
  	var quote_href = $(this).siblings(".reply:eq(0)").attr("href");
	var quote_username = $(this).parents(".info").siblings(".author").children(".name").children("a").text();
	if (!quote_username){
		var quote_username = $(this).parents(".info").siblings(".author").children(".name").text();
	}
	var quote_html = '<strong><a href="'+quote_href+'">@'+$.trim(quote_username)+'</a>:</strong>';
	var quote_text = $(this).parents(".date").siblings(".content").children("div").html();
	var quote = '<blockquote>\n'+quote_html+'\n'+$.trim(quote_text)+'\n</blockquote>\n';
	$("#comment").text(quote).focus(); 
	return false;
  });
  
  
});



// 右导航 Ajax
$(".nav_right a").live("click",function(){
  var url = $(this).attr("href");
  $.ajax({
    type:"POST",
    dataType:"html",
    url:url,
    success:function(data){
    $("#center").children().remove();
      var $nav_left = $(data).children(".nav_left").children();
      var $nav_right = $(data).children(".nav_right").children();
      var $content = $(data).children("#center").children();
      var $comments = $(data).children("#right").children();
      $(".nav_left").children().remove().end().append($nav_left);
      $(".nav_right").children().remove().end().append($nav_right);
      $("#center").append($content);
      $("#right").children().remove().end().append($comments);
    }
  })
  return false;
})
// 左导航 Ajax
$(".nav_left a").live("click",function(){
  var url = $(this).attr("href");
  $.ajax({
    type:"POST",
    dataType:"html",
    url:url,
    success:function(data){
    	$("#center").children().remove();
      var $nav_left = $(data).children(".nav_left").children();
      var $nav_right = $(data).children(".nav_right").children();
      var $content = $(data).children("#center").children();
      var $comments = $(data).children("#right").children();
      $(".nav_left").children().remove().end().append($nav_left);
      $(".nav_right").children().remove().end().append($nav_right);
      $("#center").append($content);
      $("#right").children().remove().end().append($comments);
    }
  })
  return false;
})

// 转到 page Ajax
$(".go").live("click",function(){
  var url = $(".nav_right a").attr("href");
  var url= url.slice(0,(url.length-1));
  var page_num = $(".pagenum").val();
  var href = url+ page_num;
  if (!isNaN(page_num)){
  	$.ajax({
    type:"POST",
    dataType:"html",
    url:href,
    success:function(data){
    	$("#center").children().remove();
        var $nav_left = $(data).children(".nav_left").children();
        var $nav_right = $(data).children(".nav_right").children();
        var $content = $(data).children("#center").children();
        var $comments = $(data).children("#right").children();
        $(".nav_left").children().remove().end().append($nav_left);
        $(".nav_right").children().remove().end().append($nav_right);
        $("#center").append($content);
        $("#right").children().remove().end().append($comments);
	}
  })
  }else {
  	var text="请输入正确的页码";
  	$("#tips span").text(text);
	$("#tips").css("background","red").fadeIn(500);
  	setTimeout($("#tips").fadeOut(1500),2000);
  }
  $(this).blur();
  return false;
})

