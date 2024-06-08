<?php

$category = get_queried_object();
$cat_name = sanitize_text_field($category->name);
$cat_desc = sanitize_text_field($category->description);
$cat_pic_id = get_field('kategorie_bild', $category->taxonomy . '_' . $category->term_id);
$cat_pic_html = '';

if ($cat_pic_id) {
  $cat_pic_html = wp_get_attachment_image($cat_pic_id, 'post_pic_big', false, array(
    'class' => 'index-post-img fade-in-effect',
    'loading' => 'eager'
  ));
}

get_header();

?>
      <article class="post featured">
        <header class="major">
          <span class="desc">Kategorie</span>
          <h1><?php echo $cat_name; ?></h1>
          <?php if ( $cat_desc ) : ?>
            <p><?php echo $cat_desc; ?></p>
          <?php endif; ?>
        </header>
        <?php if ( $cat_pic_html ) : ?>
        <span class="image main"><?php echo $cat_pic_html; ?></span>
        <?php endif; ?>
      </article>
<?php

if ( have_posts() ) :

  echo '<section class="posts">';
  while ( have_posts() ) :
    
    the_post();
    $post_pic_id = get_post_thumbnail_id();
    $post_pic_html = '';

    if ($post_pic_id) {
      $post_pic_html = wp_get_attachment_image($post_pic_id, 'post_pic', false, array(
        'class' => 'index-post-img fade-in-effect',
        'loading' => 'lazy',
        // 'srcset' => sk_get_srcset($post_pic_id),
        // 'sizes' => '(max-width: 500px) 100vw, 500px'
      ));
    }
    ?>

    <article>
      <header>
        <span class="date"><time datetime="<?php echo get_the_date( 'Y-m-d H:i:s' ); ?>"><?php echo get_the_date( ); ?></time></span>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </header>
      <?php if ($post_pic_id) : ?>
          <a href="<?php the_permalink(); ?>" class="image fit"><?php echo $post_pic_html; ?></a>
      <?php endif; ?>
      <p class="the_excerpt"><?php echo get_the_excerpt(); ?></p>
      <ul class="actions special">
        <li><a href="<?php the_permalink(); ?>" class="button">alles lesen</a></li>
      </ul>
    </article>

  <?php

  endwhile;
  echo '</section>';

else : ?>
  <section>
  <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
  </section>
  <?php
endif;

echo '<footer>';
get_template_part('pagination');
echo '</footer>';

get_footer();