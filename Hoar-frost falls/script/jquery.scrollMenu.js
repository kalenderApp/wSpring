;
(function($) {
  $.fn.extend({
    "scrollMenu":function(options){
      //设置默认值
      options=$.extend({
        height   : "100", /* 菜单总高度 */
        iheight  : "15",
        showText : false,
        color    : ["#691BB8","#1FAEFF","#1B58B8","#56C5FF","#569CE3","#00D8CC","#00AAAA","#91D100","#B81B6C","#E1B700"]
      },options);

      var $text  = $(this);
      var len    = $(this).length;
      var title  = [];
      var pos    = [];
      var html   = '<div id="scrollmenu"><div id="backtotop" style="height:'+parseInt(options.iheight,10)+'px;" title="backtotop"></div>';

      for (var i = 0; i < len; i++) {
        pos.push($text.eq(i).offset().top);
        title.push($text.eq(i).text());
      };

      for (var j = 0; j < len; j++) {
        html += '<div class="menu" style="height:'+parseInt(options.height,10)/len+'px;background:'+((typeof (options.color)).toLowerCase() == 'function'?options.color():options.color[j])+';" data-pos="'+pos[j]+'" title="'+title[j]+'">'+(options.showText?title[j]:"")+'</div>';
      };
      html += '<div id="backtobottom" style="height:'+parseInt(options.iheight,10)+'px;" title="GoToBottom"></div></div>';
      $("body").append(html);

      $("body").on("click","#backtobottom",function(){
        $("html,body").animate({"scrollTop":$("body").height()},500);
      });
      $("body").on("click","#backtotop",function(){
        $("html,body").animate({"scrollTop":0},500);
      });
      $("body").on("click","#scrollmenu .menu",function(){
        $("html,body").animate({"scrollTop":$(this).attr("data-pos")},500);
      });

    }
  });
})(jQuery)