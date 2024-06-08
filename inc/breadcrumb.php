<?php

add_action('fap_before_main', 'fap_breadcrumb');

function fap_breadcrumb() {
  ?>
  <nav id="breadcrumb">
    <ul>
      <li><a href="#">Start</a></li>
      <li><a href="#">Step 1</a></li>
      <li><a href="#">Step 2</a></li>
      <li><span>Target</span></li>
    </ul>
  </nav>
  <?php
}