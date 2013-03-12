options = {
        second : '秒前',
        minite : '分钟前',
        hour : '小时前',
        day : '天前',
        month : '月前',
        year : '年前',
        seconds : '秒前',
        minites : '分钟前',
        hours : '小时前',
        days : '天前',
        months : '月前',
        years : '年前',
        outofdate : '穿越了？！'
}
var getElementsByClass = function(searchClass,node,tag) {
        if (document.getElementsByClassName){
                return document.getElementsByClassName(searchClass);
        }
        var classElements = [];
        if ( node == null )
                node = document;
        if ( tag == null )
                tag = '*';
        var els = node.getElementsByTagName(tag);
        var elsLen = els.length;
        var pattern = new RegExp("(^|\\s)"+searchClass+"(\\s|$)");
        for (i = 0, j = 0; i < elsLen; i++) {
                if ( pattern.test(els[i].className) ) {
                        classElements[j] = els[i];
                        j++;
                }
        }
        return classElements;
}
var microSecond = function(searchclass,node,tag){
        var classElements = getElementsByClass(searchclass,node,tag);
        var microsecond = [];
        //console.log(classElements.length);
        for (var i = 0,j = classElements.length; i < j; i++) {
                var timestrig = Date.parse(classElements[i].getAttribute('title'));
                if (!isNaN(timestrig)){
                        microsecond.push(timestrig);
                }else {
                        microsecond.push(classElements[i].innerHTML);
                }
                //console.log(typeof (Date.parse(classElements[i].getAttribute('title') || classElements[i].innerHTML)));
        }
        //console.log(microsecond);
        return microsecond
}
var timestamp = function(){
        return new Date().getTime();
}
var timePass = function(searchclass,node,tag){
        var microsecond = microSecond(searchclass,node,tag);
        var timeago = [];
        for (var i = 0,j = microsecond.length; i < j; i++) {
                if (isNaN(microsecond[i])){
                        timeago.push(microsecond[i]);
                }else {
                        timeago.push(timestamp() - microsecond[i]);
                }
        }
        return timeago
}
var timeToWords = function(searchclass,node,tag){
        var seconds = '', minutes = '', hours = '', days = '', years = '', text = '';
        var time_array = timePass(searchclass,node,tag);
        //console.log(timeago);
        var words = [];
        for (var i = 0,j = time_array.length; i < j; i++) {
                var timeago = time_array[i];
                if(isNaN(timeago)){
                        words[i] = timeago;
                }else {
                        timeago = parseInt(timeago/1000);
                        if(timeago < 0){
                                words[i] = options.outofdate;
                        }else if(timeago > 0 && timeago < 60){
                                words[i] = parseInt(timeago) + ' ' + ((parseInt(timeago > 1)) ? options.seconds : options.second); //秒
                        }else if(timeago > 60 && timeago < 3600){
                                words[i] = parseInt(timeago / 60) + ' ' + ((parseInt(timeago / 60) > 1) ? options.minites : options.minite); //分
                        }else if(timeago > 3600 && timeago < 86400){
                                words[i] = parseInt(timeago / 3600) + ' ' + ((parseInt(timeago / 3600) > 1) ? options.hours : options.hour); //时
                        }else if(timeago > 86400 && timeago < 2592000){
                                words[i] = parseInt(timeago / 86400) + ' ' + ((parseInt(timeago / 86400) > 1) ? options.days : options.day); //天
                        }else if(timeago > 2592000 && timeago < 31104000){
                                words[i] = parseInt(timeago / 2592000) + ' ' + ((parseInt(timeago / 2592000)) > 1 ? options.months : options.month); //月
                        }else if(timeago > 31104000){
                                words[i] = parseInt(timeago / 31104000) + ' ' + ((parseInt(timeago / 31104000)) > 1 ? options.years : options.year); //年
                        }
                }
                        //text = ;
        }
        //console.log(words);
        return words
}
var timeAgo = function(searchclass,node,tag){
        var classElements = getElementsByClass(searchclass,node,tag);
        var HTMLtext = timeToWords(searchclass,node,tag);
        for (var i = 0,j = classElements.length; i < j; i++) {
                classElements[i].innerHTML = HTMLtext[i];
        }
}
/*
var seconds = Math.abs(distanceMillis) / 1000;
var minutes = seconds / 60;
var hours = minutes / 60;
var days = hours / 24;
var years = days / 365;
*/