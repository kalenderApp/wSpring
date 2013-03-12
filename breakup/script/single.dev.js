$(function(){

	//l18n config
	words = ['加载中...','关键字','页码','请输入正确的页码','已经到头了','请输入评论哦']; //zh_CN
	//words = ['Loading...','Keywords','PageNum','Please input the correct page num','It is ended','Please input somethings']; //en_US
	//l18n config
	
	var host = location.protocol+'//'+location.hostname+'/';
	$(".color").css({"width":"1px"}).animate({"width":"100%"},1500);
	$("#tips").ajaxStart(function(){
		var text = words[0];
		$("#tips span").text(text);
		$("#tips").css("background","yellow").fadeIn(500);
	 });
	$("#tips").ajaxStop(function(){
		$("#tips").fadeOut(500);
		$("ul.commentlist li:odd .info").css({"background":"rgb(248,241,135)"});
		$("ul.commentlist li:even .info").css({"background":"rgb(204,224,157)"});
	 });
	$("ul.menu li").attr("id","");
	$("li.current-cat").attr("id","active");
	$("li.current-cat-parent").attr("id","active");
	$("li.current-cat-parent li.current-cat").attr("id","current");
  $("ul.menu li").click(function(){
    $("ul.children li").attr({"id":""});
	$(this).attr("id","active").siblings("li").attr("id","");
   /*
   var href = $(this).children("a").attr("href");
	var urlHash = href.slice(host.length);
	if (urlHash.slice(0,1) == '?') {
		urlHash = urlHash.slice(1);
	}else{
		urlHash = urlHash;
	}
    $.ajax({
    type:"POST",
    dataType:"html",
    url:href,
    success:function(data){
		//alert(data);
	  $("#center").children().remove();
	  $("#center").append($(data).children("#index_center").children());
      var $nav_left = $(data).children(".nav_left").children();
      var $nav_right = $(data).children(".nav_right").children();
     // var $content = $(data).children("#center").children();
     // var $comments = $(data).children("#right").children();
     $(".nav_left").children().remove().end().append($nav_left);
     $(".nav_right").children().remove().end().append($nav_right);
	 //alert($nav_right.html());
     // $("#center").append($content);
    //  $("#right").children().remove().end().append($comments);
	  window.location = '#'+urlHash;
    }
  })
    return false;
	*/
  });
	
	$(".keywords").hover(function(){
		$(this).focus();
		var text = $(this).val();
		if (text == words[1]){
			$(this).val("");    
		}
		},function(){
			var text = $(this).val();
			if (text == ""){
				$(this).val(words[1]);    
			}
	});


  $(".pagenum").hover(function(){
    $(this).focus();
	var text = $(this).val();
    if (text == words[2]){
		$(this).val("");    
    }
  },function(){
    var text = $(this).val();
    if (text == ""){
		$(this).val(words[2]);    
    }
  });

  
  $("ul.commentlist li:odd .info").css({"background":"rgb(248,241,135)"});
  $("ul.commentlist li:even .info").css({"background":"rgb(204,224,157)"});
  
  $("a").click(function(){
    $(this).blur();  
  });
  
  $("a.reply").live("click",function(){
	var reply_href = $(this).siblings(".reply:eq(0)").attr("href");
	var reply_username = $(this).parents(".info").siblings(".author").children(".name").children("a").text();
	if (!reply_username){
		var reply_username = $(this).parents(".info").siblings(".author").children(".name").text();
	}
	var comments = $("#comment").val();
	if (comments) {
		var reply_html = comments + '\r<a href="'+reply_href+'">@'+$.trim(reply_username)+'</a>\r';
	}else {
		var reply_html = '<a href="'+reply_href+'">@'+$.trim(reply_username)+'</a>\r';	
	}
	$("#comment").val(reply_html).focus();
	return false; 
  });
  $("a.quote").live("click",function(){
  	var quote_href = $(this).siblings(".reply:eq(0)").attr("href");
	var quote_username = $(this).parents(".info").siblings(".author").children(".name").children("a").text();
	if (!quote_username){
		var quote_username = $(this).parents(".info").siblings(".author").children(".name").text();
	}
	var quote_html = '<strong><a href="'+quote_href+'">@'+$.trim(quote_username)+'</a>:</strong>';
	var quote_text = $(this).parents(".date").siblings(".content").children("div").html();
	var quote = '<blockquote>\n'+quote_html+'\n'+$.trim(quote_text)+'\n</blockquote>\n';
	$("#comment").val(quote).focus(); 
	return false;
  });
	// Footer login
	$(".loginpop").click(function(){
		$("#layout").fadeIn(100);
		$("#loginpop").fadeIn(100);
		return false;
	})
	$(document).click(function(e){
		var id = $(e.target).attr("id");
		if (id == "layout") {
			$("#layout").fadeOut(200);
			$("#loginpop").fadeOut(200);
		}
		
	})
	
	
	
	$("ul.children li").click(function(){
		$("ul.children li").attr({"id":""});
		$(".nav ul.menu li").attr({"id":""});
		$(this).parents(".nav ul.menu li").attr({"id":"active"}).end().parents("ul.children li").attr({"id":"current"});
		$(this).attr({"id":"current"});
	})




// 右导航 Ajax
$(".nav_right a").live("click",function(){
  var url = $(this).attr("href");
  var urlHash = url.slice(host.length);
  if (urlHash.slice(0,1) == '?') {
		urlHash = urlHash.slice(1);
  }else{
		urlHash = urlHash;
  }
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
	  window.location = '#'+urlHash;
    }
  })
  return false;
});
// 左导航 Ajax
$(".nav_left a").live("click",function(){
  var url = $(this).attr("href");
  var urlHash = url.slice(host.length);
  if (urlHash.slice(0,1) == '?') {
		urlHash = urlHash.slice(1);
  }else{
		urlHash = urlHash;
  }
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
	  window.location = '#'+urlHash;
    }
  })
  return false;
});

// 转到 page Ajax
$(".go").live("click",function(){
  var url = $(".nav_right a").attr("href");
  var url= url.slice(0,(url.length-1));
  var page_num = $(".pagenum").val();
  var href = url+ page_num;
  if (!isNaN(page_num)){
  var urlHash = url.slice(host.length);
  if (urlHash.slice(0,1) == '?') {
		urlHash = urlHash.slice(1);
  }else{
		urlHash = urlHash;
  }
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
		window.location = '#'+urlHash;
	}
  })
  }else {
  	var text=words[3];
  	$("#tips span").text(text);
	$("#tips").css("background","red").fadeIn(500);
  	setTimeout($("#tips").fadeOut(1500),2000);
  }
  $(this).blur();
  return false;
});
// Submit Ajax

$("#submit").live("click",function(){
	var href = $("#commentform").attr("action");
	var formData=$("#commentform").serialize();
  $.ajax({
    type:"POST",
    dataType:"html",
    url:href,
    data:formData,
    success:function(data){
		var $comments = $(data).children("#right").children();
		$("#right").children().remove();
		$("#right").append($comments);
    }   
  })
  return false;
}); 

// Submit Ajax

// keyboard event

document.onkeydown = chang_page;
function chang_page(e) {
    var e = e || event,
    keycode = e.which || e.keyCode;
    if (keycode == 33){
		var url = $(".nav_left").children().attr("href");
		if (url == undefined || url == "") {
			var text=words[4];
			$("#tips span").text(text);
			$("#tips").css("background","red").fadeIn(500);
			setTimeout($("#tips").fadeOut(500),500);
		 }else{
			  var urlHash = url.slice(host.length);
			  if (urlHash.slice(0,1) == '?') {
					urlHash = urlHash.slice(1);
			  }else{
					urlHash = urlHash;
			  } 
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
			  window.location = '#'+urlHash;
			}
		  })
		 }
		  return false;
		}
    if (keycode == 34){
		 var url = $(".nav_right").children().attr("href");
		 if (url == undefined || url == "") {
			var text=words[4];
			$("#tips span").text(text);
			$("#tips").css("background","red").fadeIn(500);
			setTimeout($("#tips").fadeOut(1500),2000);
		 }else{
		   var urlHash = url.slice(host.length);
		  if (urlHash.slice(0,1) == '?') {
				urlHash = urlHash.slice(1);
		  }else{
				urlHash = urlHash;
		  }
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
			  window.location = '#'+urlHash;
			}
		  })
		 }
		  return false;
	}
	if(event.ctrlKey&&event.keyCode==13){
		var href = $("#commentform").attr("action");
		var formData=$("#commentform").serialize();
		var comment_text = $(".inputarea #comment").val();
		if (comment_text) {
			  $.ajax({
				type:"POST",
				dataType:"html",
				url:href,
				data:formData,
				success:function(data){
					var $comments = $(data).children("#right").children();
					$("#right").children().remove();
					$("#right").append($comments);
				}   
			  })
		}else{
				var text=words[5];
				$("#tips span").text(text);
				$("#tips").css("background","red").fadeIn(500);
				setTimeout($("#tips").fadeOut(1500),2000);
			  }
	  return false;
	}
}
$(".content form p").children("input[type=submit]").addClass("pwpsbmt");



// center width
	function onLoadResizeWidths (obj) {
		var width = $(window).width()-($(window).width()*0.64);
		$('#'+obj).animate({width:width},1000);
	}
	function resizeWidths (obj) {
		var width = $(window).width()-($(window).width()*0.64);
		$('#'+obj).css({width:width});
	}
	onLoadResizeWidths ("center");
	$(window).resize(function(){
		resizeWidths("center");

	})

// center width
	function onLoadResizeWidth (obj) {
		var width = $(window).width()-805;
		$('#'+obj).animate({width:width},1000);
	}
	function resizeWidth (obj) {
		var width = $(window).width()-805;
		$('#'+obj).css({width:width});
	}
	onLoadResizeWidth ("index_center");
	$(window).resize(function(){
		resizeWidth("index_center");

	})


});