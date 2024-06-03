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

if ( ! empty( $archive_pic_html ) ) {
  echo '<div class="single-thumb">' . $archive_pic_html . '</div>';
}

// if ( $page_content ) {
//   echo '<div class="arch_desc">' . $page_content . '</div>';
// }


?>
      <article class="post featured">
        <header class="major">
          <span class="date"><time datetime="2018-07-07T20:00:00">April 25, 2017</time></span>
          <h2><?php echo $page_title; ?></h2>
          <?php echo $page_content; ?>
          <p>Aenean ornare velit lacus varius enim ullamcorper proin aliquam<br>
            facilisis ante sed etiam magna interdum congue. Lorem ipsum dolor<br>
            amet nullam sed etiam veroeros.</p>
        </header>
        <a href="#" class="image main"><img src="images/pic01.jpg" alt=""></a>
        <ul class="actions special">
          <li><a href="#" class="button large">Full Story</a></li>
        </ul>
      </article>
<?php

echo '<section class="posts">';
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

      <article>
        <header>
          <span class="date">April 24, 2017</span>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </header>
        <?php if ($post_pic_id) : ?>
            <a href="<?php the_permalink(); ?>" class="image fit"><?php echo $post_pic_html; ?></a>
        <?php endif; ?>
        <p class="the_excerpt"><?php echo get_the_excerpt(); ?></p>
        <ul class="actions special">
          <li><a href="<?php the_permalink(); ?>" class="button">Full Story</a></li>
        </ul>
      </article>

    <?php

    endwhile;
  else : ?>
    <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php
  endif;
echo '</section>';

echo '<footer>';
the_posts_pagination(array(
  'next_text' => 'Nächste Seite »',
  'prev_text' => '« Vorherige Seite'
));
echo '</footer>';

get_footer();