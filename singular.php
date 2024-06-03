<?php

get_header();

while ( have_posts() ) :
  
  the_post();

  $post_pic_id = get_post_thumbnail_id();
  $post_pic_html = '';
  
  if ($post_pic_id) {
    $post_pic_html = wp_get_attachment_image($post_pic_id, 'thumbnail', false, array(
      'class' => 'single-post-img fade-in-effect',
      'loading' => 'eager',
      'srcset' => sk_get_srcset($post_pic_id),
      'sizes' => '(max-width: 60rem) 100vw, 60rem'
    ));
  }
  
  ?>
    <section class="post">
    <article>
      <header class="major">
        <span class="date">April 25, 2017</span>
        <h1><?php the_title(); ?></h1>

        <p>Aenean ornare velit lacus varius enim ullamcorper proin aliquam<br />
        facilisis ante sed etiam magna interdum congue. Lorem ipsum dolor<br />
        amet nullam sed etiam veroeros.</p>
      </header>

      <?php if ($post_pic_id) : ?>
        <div class="image main"><?php echo $post_pic_html; ?></div>
      <?php endif; ?>

      <div class="the_content"><?php the_content(); ?></div>

      <?php if ( is_singular( 'post' ) ) : ?>
        <footer class="postmetadata">
          <p>Kategorien: <?php the_category( ', ' ); ?></p>
        </footer>
      <?php endif; ?>

      <?php if ( comments_open() ) : ?>
        <section class="comments">
          <h2>Komentare</h2>
          <?php block_template_part( 'comments' ); ?>
        </section>
      <?php endif; ?>
    </article>
    </section>
<?php endwhile;

get_footer();