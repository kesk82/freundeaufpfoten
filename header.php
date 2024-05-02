<?php

$logo_id = get_theme_mod( 'custom_logo' );
$theme_dir_url = get_template_directory_uri();

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="description" content="<?php echo skke_get_meta_desc(); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php echo skke_get_seo_tags(); ?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class( ); ?>>
  <?php wp_body_open( ); ?>

  <header id="main-header">
    <div class="col-full">
      <?php

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
        $logo_height = 40;
        $logo_width = $logo_height / $logo_ratio;
        
        ?>

        <a class="h_logo_link" href="<?php echo get_bloginfo( 'url' ); ?>" aria-label="Startseite - <?php echo get_bloginfo( 'name' ); ?>">
          <img
            class="fade-in-effect"
            id="header-main-logo"
            src="<?php echo $h_logo_src; ?>"
            srcset="<?php echo $h_srcset; ?>"
            sizes="<?php echo $logo_width; ?>px"
            width="<?php echo intval($logo_width); ?>"
            height="<?php echo $logo_height; ?>"
            alt="<?php echo get_bloginfo( 'name' ); ?> Logo"
          >
        </a>

      <div class="header_page_title"><a href="<?php echo get_bloginfo( 'url' ); ?>"><?php echo get_bloginfo( 'name' ); ?></a></div>

      <button aria-expanded="false" aria-controls="main-site-navigation" id="main-navigation-btn" aria-labelledby="main-site-navigation">
        <span>&nbsp;</span>
        <span>&nbsp;</span>
        <span>&nbsp;</span>
      </button>
      
      <nav id="main-site-navigation" role="navigation" aria-owns="main-navigation-btn" aria-label="<?php echo wp_get_nav_menu_name( 'primary' ); ?>">
        <?php

          wp_nav_menu( array(
            'theme_location' => 'primary',
            'container' => false
          ) );

        ?>
      </nav>

    </div>
  </header>

  <div id="main-container">