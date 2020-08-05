//スムーズスクロール

$(function(){
  $('a[href^="#"]').click(function(){
    var speed = 500;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });
});


// スクロールで要素が表示された時にclassを付与する
function add_class_in_scrolling(target) {
    var winScroll = $(window).scrollTop();
    var winHeight = $(window).height();
    var scrollPos = winScroll + winHeight;

    if(target.offset().top < scrollPos) {
        target.addClass('on');
    }
}

//スクロール連動アニメーション
$(window).on('load scroll', function() {

  if($('.div__scroll_page_1').length) {
    add_class_in_scrolling($('.svg_1'));
    add_class_in_scrolling($('.svg_2'));
    add_class_in_scrolling($('.svg_3'));
    add_class_in_scrolling($('.svg_4'));
    add_class_in_scrolling($('.svg_5'));

  } else if($('.div__scroll_page_2').length) {
    add_class_in_scrolling($('.svg_1'));
    add_class_in_scrolling($('.svg_2'));
    add_class_in_scrolling($('.svg_3'));
    add_class_in_scrolling($('.svg_4'));
  }

});
