<?php

global $page;

get_header();

$_queried_object = get_queried_object();

$page_title = '';
$page_content = '';
$archive_pic_id = 0;
$archive_pic_html = '';

if ( isset( $_queried_object->post_title ) ) {
  $page_title = sanitize_text_field( $_queried_object->post_title );
  // $page_content = apply_filters( 'the_content', $_queried_object->post_content );
  // $page_content = str_replace( ']]>', ']]&gt;', $page_content );
} elseif ( isset( $_queried_object->name ) ) {
  // $page_content = $_queried_object->description;
  $page_title = sanitize_text_field( $_queried_object->name );
}

if ( is_home() ) {
  $page_title = get_bloginfo( 'description' );
}

// if ( $_queried_object && function_exists( 'get_field' ) && 'WP_Term' == get_class( $_queried_object ) ) {
//   $archive_pic_id = get_field('kategorie_bild', $_queried_object->taxonomy . '_' . $_queried_object->term_id);

//   if ( is_int( $archive_pic_id ) && $archive_pic_id) {
//     $archive_pic_html = wp_get_attachment_image($archive_pic_id, 'thumbnail', false, array(
//       'class' => 'single-post-img fade-in-effect',
//       'loading' => 'eager',
//       'srcset' => sk_get_srcset($archive_pic_id),
//       'sizes' => '(max-width: 64rem) 100vw, 64rem'
//     ));
//   }
// }

?>
<main><?php

if ( $page_title ) {
  echo '<h1>' . $page_title . '</h1>';
}

if ( ! empty( $archive_pic_html ) ) {
  echo '<div class="single-thumb">' . $archive_pic_html . '</div>';
}

// if ( $page_content ) {
//   echo '<div class="arch_desc">' . $page_content . '</div>';
// }

echo '<div class="the_content archive-list">';
  if ( have_posts() ) :
    while ( have_posts() ) :
      
      the_post();
      $post_pic_id = get_post_thumbnail_id();
      $post_pic_html = '';

      if ($post_pic_id) {
        $post_pic_html = wp_get_attachment_image($post_pic_id, 'thumbnail', false, array(
          'class' => 'index-post-img fade-in-effect',
          'loading' => 'lazy',
          'srcset' => sk_get_srcset($post_pic_id),
          'sizes' => '(max-width: 500px) 100vw, 500px'
        ));
      }
      ?>

      <article class="post-index-item<?php echo ($post_pic_id ? ' post-index-item--with-pic' : ' post-index-item--no-pic' ); ?> <?php echo esc_attr( implode( ' ', get_post_class() ) ); ?>">
        <a href="<?php the_permalink(); ?>">
          <?php if ($post_pic_id) : ?>
            <div class="index-thumb"><?php echo $post_pic_html; ?></div>
          <?php endif; ?>

          <h2><?php the_title(); ?></h2>
        </a>
      </article>

    <?php

    endwhile;

    the_posts_pagination(array(
      'next_text' => 'Nächste Seite »',
      'prev_text' => '« Vorherige Seite'
    ));

    ?>
      <div class="tag_cloud"><?php echo wp_tag_cloud(); ?></div>
    <?php

  else : ?>
    <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php
  endif;
echo '</div>';

?>
</main><?php

get_footer();