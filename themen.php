<?php
/*
 * Template Name: Themen (Kategorien)
 * 
 * */

global $page;

get_header();

$_queried_object = get_queried_object();

$page_title = '';
$page_content = '';
$archive_pic_id = 0;
$archive_pic_html = '';

if ( isset( $_queried_object->post_title ) ) {
  $page_title = sanitize_text_field( $_queried_object->post_title );
} elseif ( isset( $_queried_object->name ) ) {
  $page_title = sanitize_text_field( $_queried_object->name );
}

$categories = get_terms(array(
  'taxonomy'   => 'category',
  'hide_empty' => true,
  'parent' => 0,
  'orderby' => 'count',
  'order' => 'DESC'
));

?>
<main><?php

if ( $page_title ) {
  echo '<h1>' . $page_title . '</h1>';
}

if ( ! empty( $archive_pic_html ) ) {
  echo '<div class="single-thumb">' . $archive_pic_html . '</div>';
}

echo '<div class="the_content archive-list">';
  if ( ! empty( $categories ) ) :
    foreach ( $categories as $category ) :
      
      $cat_pic_id = get_field('kategorie_bild', $category->taxonomy . '_' . $category->term_id);
      $cat_pic_html = '';

      if ($cat_pic_id) {
        $cat_pic_html = wp_get_attachment_image($cat_pic_id, 'thumbnail', false, array(
          'class' => 'index-post-img fade-in-effect',
          'loading' => 'lazy',
          'srcset' => sk_get_srcset($cat_pic_id),
          'sizes' => '(max-width: 30rem) 100vw, 30rem'
        ));
      }
      ?>

      <article class="post-index-item<?php echo ($cat_pic_id ? ' post-index-item--with-pic' : ' post-index-item--no-pic' ); ?>">
        <a href="<?php echo get_term_link( $category ); ?>">
          <?php if ($cat_pic_id) : ?>
            <div class="index-thumb"><?php echo $cat_pic_html; ?></div>
          <?php endif; ?>

          <h2><?php echo $category->name; ?></h2>

          <?php if ( ! empty($category->description)) : ?>
            <p class="the_excerpt"><?php echo $category->description; ?></p>
          <?php endif; ?>
        </a>
      </article>

    <?php

    endforeach;

    ?>
      <div class="tag_cloud"><?php echo wp_tag_cloud(); ?></div>
    <?php

  else : ?>
    <p><?php esc_html_e( 'Sorry, found no themes here!' ); ?></p>
    <?php
  endif;
echo '</div>';

?>
</main><?php

get_footer();