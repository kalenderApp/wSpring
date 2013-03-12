//Nav
$('#nav').spasticNav();  

//Back To Top
	$(document).ready(function(){
	$('a[href*=#]').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
    && location.hostname == this.hostname) {
      var $target = $(this.hash);
      $target = $target.length && $target 
      || $('[name=' + this.hash.slice(1) +']');
      if ($target.length) {
        var targetOffset = $target.offset().top;
        $('html,body')
        .animate({scrollTop: targetOffset}, 1000);
       return false;
      }
    }
  });

});


//Close Footer Tips
$(function(){
    $('#closetip').click(function(){
        $('#footertips').hide();
            });
        return false;
    });


//Reply @ Float
//hover show comments
	$(".commentlist li p a").mouseover(function(e){		//鼠标悬浮在评论中有a标签的地方时
		var A=/^#comment-/;		/*正则表达式，用来筛选以#comment-的元素*/
		if ($(".commentlist li p a").attr("href").match(A)) 	//如果a里面的href里面的值与正则表达式里的相匹配，那么执行花括号里面的代码块
		{
			var t_link = $(this).attr("href");		//定义t_link来存储href里面的值
			var h_com = "<li class='hover-comment'>" + $(t_link).html() + "</li>";		//定义h_com，在里面赋上html代码
		} else h_com = "";
		$("body").append(h_com);	//将h_com里面的值追加到body里面
		$(".hover-comment").css({
			"top":(e.pageY+10) + "px",
			"left":(e.pageX+10) + "px"
		}).fadeIn("slow");		//让评论在鼠标悬浮于@user链接里面出现
	}).mouseout(function(){
		$(".hover-comment").fadeOut("slow",function(){$(this).remove()});		//鼠标移出链接时，将添加到body里面的h_com删掉
	}).mousemove(function(e){		//鼠标在@user上移动的时候，让显示出来的评论框也跟着移动
			$("#linktip").remove();
			$(".hover-comment").css({
			"top":(e.pageY+10) + "px",
			"left":(e.pageX+10) + "px"
		});
	});



// Footer Tips Fadein Out
jQuery(document).ready(function(){
	laodao(); // 先执行一次函数 laodao()
	setInterval('laodao()', 4000); // 然后每隔 6100 毫秒执行一下函数 laodao()
});
var laodao_i = 0, //span排序序号
	landao_span_arr = 0;
	laodao_span_num = 0; // 统计span数量并减 1 处理
function laodao() {
	if(landao_span_arr==0){
	landao_span_arr = $(".laodao").children("span");
	laodao_span_num = landao_span_arr.length - 1; // 统计span数量并减 1 处理
	}
	if (laodao_i > laodao_span_num) {laodao_i = 0;} // 如果计数器（span排序）大于 laodao_span_num 时归零
	$('.laodao span:eq('+laodao_i+')').fadeIn(1000); //渐显效果显示第 laodao_i 个span
	setTimeout(function() {$('.laodao span:eq('+laodao_i+')').fadeOut(1000);laodao_i++;},3000);
};
