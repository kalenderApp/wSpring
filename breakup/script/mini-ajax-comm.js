/*
 * WordPress 內置嵌套評論專用 Ajax comments >> Mini-Ajax-Comments beta by Willin Kan.
 *
 * 安裝方式(此測試版僅供本地測試, 沒有再編輯功能):
 * 1. 先確定內置嵌套評論已正常運作.
 * 2. 將本文件置於模板路徑.
 * 3. 請在 wp_head(); 之前掛上 jQurey 1.3 以上版本:
 *   <?php wp_enqueue_script('jquery'); ?>
 * 4. 請在 wp_head(); 之後掛上:
 *   <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/mini-ajax-comm.js"></script>
 *
 * bug: IE 不能用, IE 對 live 語法支援有問題.
 *  如果有問題, 請移步 http://willin.heliohost.org/?p=1271 作者: Willin Kan
 */

var
   //pic_path = '<img src="' + document.styleSheets[0].href.replace(/wp-content(.*)/,'wp-admin/images/'), // WP 圖片路徑
   //pic_sb = pic_path + 'wpspin_dark.gif" />',    // 提交 icon
   //pic_no = pic_path + 'no.png" />',             // 錯誤 icon
   //pic_ys = pic_path + 'yes.png" />',            // 成功 icon
   //sb = '<div id="loading">' + pic_sb + '正在提交, 請稍候...</div>',
   //no = '<div id="error">#</div>',
   //ys = '<span class="success">' + pic_ys + '提交成功</span>',
   comments = '#comments';                       // 評論總數 id="comments"

/* jQ */
jQuery(document).ready(function($){
 function initialise(){
   $('#comment').after(sb + no);
   $loading = $('#loading').hide();
   $error = $('#error').hide();
   reply = false;
 }
// initialise();
   $('#submit').attr('disabled',false);
   $body = (window.opera) ? ( document.compatMode == "CSS1Compat" ? $('html') : $('body') ) : $('html,body'); // opera fix

// reply
$('.comment-reply-link').live('click', function(){
   $body.animate({ scrollTop: $('#respond').offset().top - 200}, 600);
   reply = $(this).parents('.comment').attr('id');
  })

// cancel reply
$('#cancel-comment-reply-link').live('click', function(){
   reply = false;
  })	

// submit
$('#commentform').live('submit', function(){
   $loading.show();
   $('#submit').attr('disabled',true).fadeTo(100, 0.5);

 $.ajax({
   url:  $(this).attr('action'),
   type: $(this).attr('method'),
   data: $(this).serialize(),

   error: function(request){
     var data = request.responseText.match(/<p>(.*)<\/p>/);
     $error.html( pic_no + data[1] ).fadeIn(600);
     $loading.hide();
     setTimeout( function(){ $('#submit').attr('disabled',false).fadeTo('slow', 1); $error.slideUp(200); }, 2000);
     },

   success: function(data){
    try {
      var response = $('<ol>').html(data);
      	$('.commentlist').replaceWith( response.find('.commentlist') );
        $(comments).replaceWith( response.find(comments) );

      ( reply != false ) ? ( 
        $new_comment = $('#' + reply + ' li:last'),
        $('.commentlist').after( response.find('#respond') ),
        initialise()
      ) : (
        $new_comment = ( $('.depth-1:first').attr('id') > $('.depth-1:last').attr('id') ) ? 
         $('.depth-1:first') : $new_comment = $('.depth-1:last')
      );
      $body.animate({ scrollTop: $new_comment.offset().top - 300}, 300);
      $loading.hide();
      $error.hide();
      $new_comment.hide().fadeIn(5000);
      $new_comment.find('div:last').append(ys);

    } catch (e) {
      alert('error!\n\n' + e);
    } // end try

      $('textarea').each( function(){ this.value='' });
      $('#submit').attr('disabled',true).fadeTo(100, 0.5);
      countdown();
   } // end success()

  }) // end ajaxSubmit()
  return false;

 }) // end #commentform.submit()

// countdown
var wait = 15, submit_val = $('#submit').val();
 function countdown(){
  ( wait > 0 ) ? (
    $('#submit').val(wait), wait--, setTimeout(countdown, 1000)
  ) : (
    $('#submit').val(submit_val).attr('disabled', false).fadeTo('slow', 1),
    wait = 15
  );
 }

}); // end jQ