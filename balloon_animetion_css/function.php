<?php

//////////////////////////////////////////////////
//クイックタグの追加
//////////////////////////////////////////////////
function add_button_quicktag() {
	?>
	<script type="text/javascript">
	QTags.addButton('anime_sweat', 'ふきだし(汗)', '[anime_balloon position="left" name="名前" text="本文" img="アイコン画像のURL" animetion="icon_sweat"]');
	QTags.addButton('anime_up', 'ふきだし(UP)', '[anime_balloon position="left" name="名前" text="本文" img="アイコン画像のURL" animetion="icon_up"]');
	QTags.addButton('anime_angry', 'ふきだし(怒)', '[anime_balloon position="left" name="名前" text="本文" img="アイコン画像のURL" animetion="icon_angry"]');
	QTags.addButton('anime_heart', 'ふきだし(好き)', '[anime_balloon position="left" name="名前" text="本文" img="アイコン画像のURL" animetion="icon_heart"]');
	QTags.addButton('anime_shock', 'ふきだし(ガーン)', '[anime_balloon position="left" name="名前" text="本文" img="アイコン画像のURL" animetion="icon_shock"]');
	QTags.addButton('anime_down', 'ふきだし(ショック)', '[anime_balloon position="left" name="名前" text="本文" img="アイコン画像のURL" animetion="img_down"]');
	</script>
	<?php
}
add_action('admin_print_footer_scripts', 'add_button_quicktag');

//////////////////////////////////////////////////
//アニメ吹き出しを表示するショートコード
//////////////////////////////////////////////////
function anime_balloon_func($atts) {
	extract( shortcode_atts( array(
		'animetion' => '',
		'position' => '',
		'img' => '',
		'name' => '',
		'text' => '',
	), $atts ) );

	$code_balloon = <<<EOT
	<div class="balloon__contener $animetion">
    <div class="balloon__$position">
      <figure>
        <span class="icon_emotion"></span>
        <img src="$img" />
        <figcaption>$name</figcaption>
      </figure>
      <div class="balloon__text">
        $text
      </div>
    </div>
	</div>
EOT;
	return $code_balloon;

}

add_shortcode('anime_balloon', 'anime_balloon_func');
