// Windows Phone 7 Style
var length = $('.list li').length;
for (i=0;i<=length ;i++ ){
	var color = '#' + randomColor();//'#' + Math.floor(Math.random()*1000000);
	$('.list li').eq(i).css({"background":color});
}
function randomColor() {
    var rand = Math.floor(Math.random( ) * 0xFFFFFF).toString(16);
    if(rand.length == 6){
        return rand;
    }else{
        return randomColor();
    }
}