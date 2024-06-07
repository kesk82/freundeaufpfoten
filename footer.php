  </main> <!-- #main -->

  <footer id="footer">
    <?php block_template_part( 'footer' ); ?>
  </footer>

  <a href="#navPanel" aria-hidden="true" id="navPanelToggle" class=""><svg><use xlink:href="#icon-navmenu"></use></svg> Menu</a>
  </div>

  <div id="navPanel" style="display: none;">
  <nav>
    <?php 
      wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_class' => 'links',
            'container' => false
          ) );
    ?>
    <ul class="icons alt">
      <li><a href="<?php echo get_permalink( get_page_by_path('about') ); ?>" title="Über uns" aria-label="Über uns"><span class="label"><svg><use xlink:href="#icon-info"></use></svg></span></a></li>
      <li><a href="<?php echo get_privacy_policy_url(); ?>" title="Datenschutzerklärung" aria-label="Datenschutzerklärung"><span class="label"><svg><use xlink:href="#icon-fingerprint"></use></svg></span></a></li>
    </ul>
  </nav>
  <a href="#navPanel" class="close" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></a>
  </div>

  <?php wp_footer(); ?>
</body>

</html>