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
	$(".commentlist li p a").mouseover(function(e){		//�����������������a��ǩ�ĵط�ʱ
		var A=/^#comment-/;		/*������ʽ������ɸѡ��#comment-��Ԫ��*/
		if ($(".commentlist li p a").attr("href").match(A)) 	//���a�����href�����ֵ��������ʽ�����ƥ�䣬��ôִ�л���������Ĵ����
		{
			var t_link = $(this).attr("href");		//����t_link���洢href�����ֵ
			var h_com = "<li class='hover-comment'>" + $(t_link).html() + "</li>";		//����h_com�������渳��html����
		} else h_com = "";
		$("body").append(h_com);	//��h_com�����ֵ׷�ӵ�body����
		$(".hover-comment").css({
			"top":(e.pageY+10) + "px",
			"left":(e.pageX+10) + "px"
		}).fadeIn("slow");		//�����������������@user�����������
	}).mouseout(function(){
		$(".hover-comment").fadeOut("slow",function(){$(this).remove()});		//����Ƴ�����ʱ������ӵ�body�����h_comɾ��
	}).mousemove(function(e){		//�����@user���ƶ���ʱ������ʾ���������ۿ�Ҳ�����ƶ�
			$("#linktip").remove();
			$(".hover-comment").css({
			"top":(e.pageY+10) + "px",
			"left":(e.pageX+10) + "px"
		});
	});



// Footer Tips Fadein Out
jQuery(document).ready(function(){
	laodao(); // ��ִ��һ�κ��� laodao()
	setInterval('laodao()', 4000); // Ȼ��ÿ�� 6100 ����ִ��һ�º��� laodao()
});
var laodao_i = 0, //span�������
	landao_span_arr = 0;
	laodao_span_num = 0; // ͳ��span�������� 1 ����
function laodao() {
	if(landao_span_arr==0){
	landao_span_arr = $(".laodao").children("span");
	laodao_span_num = landao_span_arr.length - 1; // ͳ��span�������� 1 ����
	}
	if (laodao_i > laodao_span_num) {laodao_i = 0;} // �����������span���򣩴��� laodao_span_num ʱ����
	$('.laodao span:eq('+laodao_i+')').fadeIn(1000); //����Ч����ʾ�� laodao_i ��span
	setTimeout(function() {$('.laodao span:eq('+laodao_i+')').fadeOut(1000);laodao_i++;},3000);
};
