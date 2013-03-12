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
	var comment = $("#comment").val();
	var href = $("#commentform").attr("action");
	var formData=$("#commentform").serialize();
	if (author == "" || email == "" || comment == "") {
		$("#submit").siblings(".required-error").show();
		return false
	}
	$(".comment-error, .comment-success, .required-error").hide("");
	$("#comment").css({"background":"#FFF url(/wp-content/themes/airsquare/images/loading.gif) center center no-repeat"});
  $.ajax({
	global:false,
    type:"POST",
    dataType:"html",
    url:href,
    data:formData,
    success:function(data){
		var $content = $(data).find("#content").children(".commentlist").children("li:last");
		$("#content").children(".commentlist").append($content);
		$("#comment").css({"background":"#FFF"});
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
