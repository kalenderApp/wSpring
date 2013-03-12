$(function(){
	$(".formatlink p a").hover(function(){
		$_this = $(this);
		thumbshots.insertDiv();
	},function(){
		thumbshots.removeDiv();
	});
});
var thumbshots= {
	
	newDiv:function(){
		var href = $_this.attr("href");
		var html = '<div class="thumbshots"><img src="http://open.thumbshots.org/image.aspx?url=' + href + '"></div>';
		return html;
	},

	insertDiv:function(){
		var html = thumbshots.newDiv();
		$_this.append(html);
	},

	removeDiv:function(){
		$(".thumbshots").remove();
	}
};




//function newDiv(){
//
//}