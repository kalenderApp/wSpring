jQuery(document).ready(
	function(){
		var id=/^#comment-/;
		var at=/^@/;
		jQuery('#thecomments li p a').each(
			function() {
				if(jQuery(this).attr('href').match(id)&& jQuery(this).text().match(at)) {
					jQuery(this).addClass('atreply');
				}
			}
		);
		jQuery('.atreply').hover(
			function() {
				jQuery(jQuery(this).attr('href')).clone().hide().insertAfter(jQuery(this).parents('li')).attr('id','').addClass('tip').fadeIn(200);
			}, 
			function() {
				jQuery('.tip').fadeOut(400, function(){jQuery(this).remove();});
			}
		);
		jQuery('.atreply').mousemove(
			function(e) {
				jQuery('.tip').css({left:(e.clientX+18),top:(e.pageY+18)})
			}
		);
	}
)