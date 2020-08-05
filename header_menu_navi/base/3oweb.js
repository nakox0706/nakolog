
/*/////////////////////////////////////////////////
//追撃ヘッダー
/////////////////////////////////////////////////*/
$(function(){
  var _window = $(window),
  _header = $('.l-header'),
  _extra = $('.l-extra'),
  extraBottom,
  extraWidth,
  headerBottom;

  _window.on('scroll',function(){
    headerBottom = _header.height();
    extraBottom = _extra.height() + 10;
    extraWidth = _window.width();

    if(extraWidth < 767){
      _extra.next('.breadcrumb').css('padding-top',headerBottom + 20 + 'px');
    }else{
      _extra.next('.breadcrumb').css('padding-top',headerBottom +'px');
    }

    if(_window.scrollTop() > extraBottom){
      _extra.addClass('fixed');
    }else{
      _extra.removeClass('fixed');
    }
  });

  _window.trigger('scroll');
});


/*/////////////////////////////////////////////////
//ナビのカレント保持
/////////////////////////////////////////////////*/

$(document).ready( function(){

  var _globalnavi = $(".globalNavi"),
  _current = $(".current");
  extraWidth = $(window).width(),
  leftOffset = _current.offset().left,
  scrollvalue = -20 + leftOffset;

  if(extraWidth < 767){
    _globalnavi.scrollLeft(scrollvalue);
  }

});

/*/////////////////////////////////////////////////
//コピーボタンとツールチップ表示
/////////////////////////////////////////////////*/


var clipboard = new ClipboardJS('.btn_copy');

clipboard.on('success', function(e) {
   // [?]の座標を取得
   var position = $('.btn_copy').offset();
   var newPositionTop = position.top +23;        /* + 数値で下方向へ移動 */
   var newPositionLeft = position.left + 20;      /* + 数値で右方向へ移動 */

   // ツールチップの位置を調整
   $('.toolTip').css({'top': newPositionTop + 'px', 'left': newPositionLeft + 'px'});

   // ツールチップの class="invisible" を削除
   $('.toolTip').removeClass('invisible');
    });

    // 表示されたツールチップを隠す処理（マウスクリックで全て隠す）
    $('html').mousedown(function(){
      $('.toolTip').addClass('invisible');
    });
