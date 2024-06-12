<?php
/*
 * Template Name: Themen (Kategorien)
 * 
 * */

global $page;

get_header();

$_queried_object = get_queried_object();

$page_content = '';
$archive_pic_id = 0;
$archive_pic_html = '';

$categories = get_terms(array(
  'taxonomy'   => 'category',
  'hide_empty' => true,
  'parent' => 0,
  'orderby' => 'count',
  'order' => 'DESC'
));

?>
  <article class="post featured">
    <header class="major">
      <h1>Themen</h1>
    </header>
  </article>
  <section class="posts">
<?php

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

      <article>
        <header>
          <h2><a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name; ?></a></h2>
        </header>
        <?php if ($cat_pic_id) : ?>
            <a href="<?php echo get_term_link( $category ); ?>" class="image fit"><?php echo $cat_pic_html; ?></a>
        <?php endif; ?>
        <?php if ( ! empty($category->description)) : ?>
          <p class="the_excerpt"><?php echo $category->description; ?></p>
          <?php endif; ?>
        <ul class="actions special">
          <li><a href="<?php echo get_term_link( $category ); ?>" class="button">alles lesen</a></li>
        </ul>
      </article>

    <?php

    endforeach;

  else : ?>
    <p><?php esc_html_e( 'Sorry, found no themes here!' ); ?></p>
    <?php
  endif;
echo '</section>';

get_footer();