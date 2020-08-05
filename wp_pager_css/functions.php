<?php

//////////////////////////////////////////////////
//ページャー
//////////////////////////////////////////////////

function pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;//表示するページ数（５ページを表示）

     global $paged;//現在のページ値
     if(empty($paged)) $paged = 1;//デフォルトのページ

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;//全ページ数を取得
         if(!$pages)//全ページ数が空の場合は、１とする
         {
             $pages = 1;
         }
     }

     if(1 != $pages)//全ページが１でない場合はページネーションを表示する
     {
		 echo "<div class=\"pager\">\n";
		 echo "<ul class=\"pagination\">\n";
		 //Prev：現在のページ値が１より大きい場合は表示
         if($paged > 1) echo "<li class=\"pre\"><span><a href='".get_pagenum_link($paged - 1)."'&laquo;</span></a></li>\n";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                //三項演算子での条件分岐
                echo ($paged == $i)? "<li><a class=\"active\" href='".get_pagenum_link($i)."'><span>".$i."</span></a></li>\n":"<li><span><a href='".get_pagenum_link($i)."'>".$i."</span></a></li>\n";
             }
         }
		//Next：総ページ数より現在のページ値が小さい場合は表示
		if ($paged < $pages) echo "<li class=\"next\"><span><a href=\"".get_pagenum_link($paged + 1)."\"&raquo;</span></a></li>\n";
		echo "</ul>\n";
		echo "</div>\n";
     }
}

?>
