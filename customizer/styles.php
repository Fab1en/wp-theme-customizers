<?php

/*
 * Applies the background color to the page.
 */
function artsite_background_css() {
  $color = get_theme_mod( 'artsite_background_color' );

  // Make sure colors are properly formatted
  $color = '#' . str_replace( '#', '', $color );
  ?>

  <style>
    body.custom-background, body{ background-color: <?php echo $color; ?>; }
    #wrap{ background: <?php echo $color; ?>; }
  </style>
  <?php
}
add_action( 'wp_head', 'artsite_background_css', 210 );
