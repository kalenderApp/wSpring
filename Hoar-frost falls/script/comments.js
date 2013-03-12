$("#smiley ul li").click(function(){
	var smiley = $(this).children("img").attr("alt");

	//For IE PlaceHolder
	var defaultval = $("#comment").attr("placeholder");
	var thevalue = $("#comment").val();
	if (defaultval == thevalue){
		$("#comment").val("").css({"color":"#000"});
	}
	grin(smiley);
})

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