<?php
/**
 * Contains the post embed content template part
 *
 * When a post is embedded in an iframe, this file is used to create the content template part
 * output if the active theme does not include an embed-content.php template.
 *
 * @package WordPress
 * @subpackage Theme_Compat
 * @since 4.5.0
 */
?>
<style>

a {
  text-decoration: none;
}

.wp-embed {
  padding: 3% 3% 1% 3%;
  line-height: 120%;
  font-size: 14px;
}


.wp-embed-featured-image {
    width: 40%;
    overflow: hidden;
    float: left;
    margin-bottom: 10px;
}

.wp-embed-heading {
	width: 60%;
	float: right;
}

.wp-embed-heading a{
  padding-left:20px;
	font-size: 120%;
  font-weight: bold ;
  color: #333 ;
  line-height: 120%;
	display: block;
}

.wp-embed-site-title {
  font-size: 80%;
  line-height: 120%;
  padding-right: 10px;
}

.wp-embed-footer {
	padding-top: 0px;
  margin-top: 0;
}

.wp-embed-excerpt {
  clear: both;
  padding-left:20px;
  padding-top: 10px;
  color: #333 ;
}

.wp-embed__sp{
  padding: 0;
  line-height: 120%;
  font-size: 12px;
  display: table;
  border: solid 1px #ccc;
}

.wp-embed__sp-box {
  padding: 0;
  line-height: 120%;
  font-size: 12px;
  display: table;

}

.wp-embed__sp-box img{
  width: 100%;
  height: auto;
  vertical-align: top;
}

.wp-embed__sp-featured-image {
    display: table-cell;
    width: 50%;
}

.wp-embed__sp-heading {
	display: table-cell;
  vertical-align: middle;
  font-weight: bold ;
  color: #333 ;
  width: 50%;
  line-height: 120%;
  padding:1% 1% 1% 2%;
}

.wp-embed__sp-heading span{
  display: block;
  margin-top: 5px;
  color: #ddd;
  font-size: 80%;
}

.wp-embed__sp .wp-embed-footer {
  display: block;
	padding: 3%;
}


</style>

<?php
$thumbnail_id = 0;

if ( has_post_thumbnail() ) {
  $thumbnail_id = get_post_thumbnail_id();
}

if ( 'attachment' === get_post_type() && wp_attachment_is_image() ) {
  $thumbnail_id = get_the_ID();
}

$thumbnail_id = apply_filters( 'embed_thumbnail_id', $thumbnail_id );

if ( $thumbnail_id ) {
  $aspect_ratio = 1;
  $measurements = array( 1, 1 );
  $image_size   = 'large'; // （'thumbnail', 'medium', 'large', 'full'）

  $meta = wp_get_attachment_metadata( $thumbnail_id );
  if ( ! empty( $meta['sizes'] ) ) {
    foreach ( $meta['sizes'] as $size => $data ) {
      if ( $data['height'] > 0 && $data['width'] / $data['height'] > $aspect_ratio ) {
        $aspect_ratio = $data['width'] / $data['height'];
        $measurements = array( $data['width'], $data['height'] );
        $image_size   = $size;
      }
    }
  }

  $image_size = apply_filters( 'embed_thumbnail_image_size', $image_size, $thumbnail_id );
  $shape = $measurements[0] / $measurements[1] >= 1.75 ? 'rectangular' : 'square';
  $shape = apply_filters( 'embed_thumbnail_image_shape', $shape, $thumbnail_id );
}

  $ua = $_SERVER['HTTP_USER_AGENT'];
  if (preg_match('/(iPhone|Android.*Mobile|Windows.*Phone)/', $ua)) {
    ?>
    <div class="wp-embed__sp">

    <div class="wp-embed__sp-box">
      <?php
      if ( $thumbnail_id && 'rectangular' === $shape ) : ?>
        <div class="wp-embed__sp-featured-image">
            <?php echo wp_get_attachment_image( $thumbnail_id, $image_size ); ?>

        </div>
      <?php endif; ?>
      <div class="wp-embed__sp-heading">
        <a href="<?php the_permalink(); ?>" target="_top">
          <?php the_title(); ?>
        </a>
      </div>

      <?php if ( $thumbnail_id && 'square' === $shape ) : ?>
        <div class="wp-embed__sp-featured-image square">
            <?php echo wp_get_attachment_image( $thumbnail_id, $image_size ); ?>
        </div>
      <?php endif; ?>
      <?php
      /**
       * Prints additional content after the embed excerpt.
       *
       * @since 4.4.0
       */
      do_action( 'embed_content' );
      ?>
    </div>

    <div class="wp-embed-footer">
      <?php the_embed_site_title() ?>
    </div>

  </div>
    <?php
  }else {
    ?>
    <div <?php post_class( 'wp-embed' ); ?>>
      <?php
      if ( $thumbnail_id && 'rectangular' === $shape ) : ?>
        <div class="wp-embed-featured-image">
          <a href="<?php the_permalink(); ?>" target="_top">
            <?php echo wp_get_attachment_image( $thumbnail_id, $image_size ); ?>
          </a>
        </div>
      <?php endif; ?>

      <div class="wp-embed-heading">
        <a href="<?php the_permalink(); ?>" target="_top">
          <?php the_title(); ?>
        </a>
            <div class="wp-embed-excerpt"><?php echo mb_substr(str_replace(array("\r\n", "\r", "\n"), '', strip_tags(get_the_excerpt())), 0, 150). '...続きを読む' ?></div>
      </div>

      <?php if ( $thumbnail_id && 'square' === $shape ) : ?>
        <div class="wp-embed-featured-image square">
          <a href="<?php the_permalink(); ?>" target="_top">
            <?php echo wp_get_attachment_image( $thumbnail_id, $image_size ); ?>
          </a>
              <div class="wp-embed-excerpt"><?php echo mb_substr(str_replace(array("\r\n", "\r", "\n"), '', strip_tags(get_the_excerpt())), 0, 150). '...続きを読む' ?></div>
        </div>
      <?php endif; ?>
      <?php
      /**
       * Prints additional content after the embed excerpt.
       *
       * @since 4.4.0
       */
      do_action( 'embed_content' );
      ?>

      <div class="wp-embed-footer">
        <?php the_embed_site_title() ?>

        <div class="wp-embed-meta">
          <?php
          /**
           * Prints additional meta content in the embed template.
           *
           * @since 4.4.0
           */
          do_action( 'embed_content_meta');
          ?>
        </div>
      </div>
    </div>

    <?php
  }
  ?>
