$("a.reply").live("click",function(){
	//var reply_href = $(this).siblings(".reply:eq(0)").attr("href");
	var reply_href = $(this).attr("href");
	var reply_username = $(this).parents(".info").siblings(".author").children(".name").children("a").text();
	if (!reply_username){
		var reply_username = $(this).parents(".info").siblings(".author").children(".name").text();
	}
	var comments = $("#comment").val();
	if (comments) {
		var reply_html = comments + '\r<a href="'+reply_href+'">@'+$.trim(reply_username)+' </a>\r';
	}else {
		var reply_html = '<a href="'+reply_href+'">@'+$.trim(reply_username)+' </a>\r';	
	}
	$("#comment").val(reply_html).focus();
	return false; 
  });
  $("a.quote").live("click",function(){
  	var quote_href = $(this).siblings(".reply").attr("href");
	var quote_username = $(this).parents(".info").siblings(".author").children(".name").children("a").text();
	if (!quote_username){
		var quote_username = $(this).parents(".info").siblings(".author").children(".name").text();
	}
	var quote_html = '<strong><a href="'+quote_href+'">@'+$.trim(quote_username)+' </a>:</strong>';
	var quote_text = $(this).parents(".date").siblings(".content").children("div").html();
	var quote = '<blockquote>\n'+quote_html+'\n'+$.trim(quote_text)+'\n</blockquote>\n';
	$("#comment").val(quote).focus(); 
	return false;
  });

$("#submit").click(function(){
	var author = $("#author").val();
	var email = $("#email").val();
	var comments = $("#comment").val();
	var href =$("#commentform").attr("action"); //"http://i.w/wp-content/themes/isimple/demo.html";//
	var formData=$("#commentform").serialize();
	if (author == "" || email == "" || comments == "") {
		$("#submit").siblings(".required-error").show();
		return false
	}
	$(".comment-error, .comment-success, .required-error").hide("");
	$("#comment").removeClass("backgrounds").addClass("background");
  $.ajax({
	global:false,
    type:"POST",
	cache:false,
    dataType:"html",
    url:href,
    data:formData,
    success:function(data){
		//alert(data);
		ajaxGet();
		//var $content = $(data).find(".commentlist");//.children("li:last");
		//document.write($content.html());
		//return false;
		//$("#content").children(".commentlist").append($content);
		$("#comment").removeClass("background").addClass("backgrounds");
		$("#submit").siblings(".comment-success").show();
    },
	statusCode: {
    500:function() {
      $("#submit").siblings(".comment-error").show();
	  $("#comment").css({"background":"#FFF"});
    }
  }
  })
  return false;
}); 

$("body").keydown(function(e){
	var e = e || event,
	keycode = e.which || e.keyCode;
	if (keycode==13) {
		$("#submit").trigger("click");
		return false
	}
});

$("#smiley ul li").click(function(){
	var smiley = $(this).children("img").attr("alt");

	//For IE PlaceHolder
	var defaultval = $("#comment").attr("placeholder");
	var thevalue = $("#comment").val();
	if (defaultval == thevalue){
		$("#comment").val("").css({"color":"#000"});
	}
	//End

	grin(smiley);
});

function grin(tag) {
	var myField;
	tag = ' ' + tag + ' ';
	if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
		myField = document.getElementById('comment');
	} else {
		return false;
	}
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		sel.text = tag;
		myField.focus();
	}else if (myField.selectionStart || myField.selectionStart == '0') {
				var startPos = myField.selectionStart;
				var endPos = myField.selectionEnd;
				var cursorPos = endPos;
				myField.value = myField.value.substring(0, startPos)
							  + tag
							  + myField.value.substring(endPos, myField.value.length);
				cursorPos += tag.length;
				myField.focus();
				myField.selectionStart = cursorPos;
				myField.selectionEnd = cursorPos;
			}else {
				myField.value += tag;
				myField.focus();
			}
	}

String.prototype.Trim = function() 
{ 
return this.replace(/(^\s*)|(\s*$)/g, ""); 
} 
 
String.prototype.LTrim = function() 
{ 
return this.replace(/(^\s*)/g, ""); 
} 
 
String.prototype.RTrim = function() 
{ 
return this.replace(/(\s*$)/g, ""); 
} 

var ajaxGet = function(){
	var titlehref = $("#titlehref").attr("href")+"?time="+new Date().getTime();
	$.get(titlehref,function(datas){
			var $content = $(datas).find(".commentlist");//.children("li:last");
			$(".commentlist").remove();
			$("#respond").before($content);
		});
	return false
}