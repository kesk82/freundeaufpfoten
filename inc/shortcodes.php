<?php

add_shortcode( 'sk_privacy_settings',   'sk_privacy_settings' );

function sk_privacy_settings($atts = [], $content = null) {
  $r = "";
  ob_start();

  // Render template:
  include get_template_directory() . '/templates/privacy-settings.php';

  $r = ob_get_contents();
  ob_end_clean();
  return $r;
}