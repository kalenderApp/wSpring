//<![CDATA[
function to_reply(commentID,author) {
var nNd='@'+author+':';
var myField;
if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
myField = document.getElementById('comment');
} else {
return false;
}
if (document.selection) {
myField.focus();
sel = document.selection.createRange();
sel.text = nNd;
myField.focus();
}
else if (myField.selectionStart || myField.selectionStart == '0') {
var startPos = myField.selectionStart;
var endPos = myField.selectionEnd;
var cursorPos = endPos;
myField.value = myField.value.substring(0, startPos)
+ nNd
+ myField.value.substring(endPos, myField.value.length);
cursorPos += nNd.length;
myField.focus();
myField.selectionStart = cursorPos;
myField.selectionEnd = cursorPos;
}
else {
myField.value += nNd;
myField.focus();
}
}
//]]>
