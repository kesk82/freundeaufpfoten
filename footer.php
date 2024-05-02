  </div>

  <footer>
    <div class="col-full main-footer-container">
      <div class="footer_brand">
        <?php
        $logo_id = get_theme_mod( 'custom_logo' );
        $theme_dir_url = get_template_directory_uri();

        $h_logo_src = $theme_dir_url . '/img/Logo2_li_64.webp';
        $h_logo_w = 64;
        $h_logo_h = 76;

        $h_logos = array(
          $theme_dir_url . '/img/Logo2_li_64.webp' => 64,
          $theme_dir_url . '/img/Logo2_li_100.webp' => 100,
          $theme_dir_url . '/img/Logo2_li_128.webp' => 128,
          $theme_dir_url . '/img/Logo2_li_150.webp' => 150,
          $theme_dir_url . '/img/Logo2_li_200.webp' => 200,
          $theme_dir_url . '/img/Logo2_li_300.webp' => 300,
          $theme_dir_url . '/img/Logo2_li_400.webp' => 400,
          $theme_dir_url . '/img/Logo2_li_600.webp' => 600
        );

        $h_srcset = '';

        foreach ($h_logos as $logo_f => $logo_w) {
          if (! empty($h_srcset)) {
            $h_srcset .= ', ';
          }
          $h_srcset .= $logo_f . ' ' . $logo_w . 'w';
        }

        $logo_ratio = $h_logo_h / $h_logo_w;
        $logo_height = 200;
        $logo_width = $logo_height / $logo_ratio;

        ?>
          <img
            class="fade-in-effect"
            src="<?php echo $h_logo_src; ?>"
            srcset="<?php echo $h_srcset; ?>"
            sizes="<?php echo intval($logo_width); ?>px"
            width="<?php echo intval($logo_width); ?>"
            height="<?php echo $logo_height; ?>"
            alt="<?php echo get_bloginfo( 'name' ); ?> Logo"
            loading="lazy"
          >


        <div class="footer_page_title"><?php echo get_bloginfo( 'name' ); ?></div>
        <p>&copy; Copyright <?php echo date('Y'); ?> - Alle Rechte vorbehalten.</p>
      </div>
      <nav class="footer_navigation" role="navigation" aria-label="<?php echo wp_get_nav_menu_name( 'footer-menu' ); ?>">
        <?php

        wp_nav_menu( array(
          'theme_location' => 'footer-menu',
          'container' => false
        ) );

        ?>
      </nav>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>

</html>