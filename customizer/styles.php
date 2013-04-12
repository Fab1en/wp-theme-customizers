<?php

/*
 * Applies the background color to the page.
 */
function artsite_background_css() {
  $color = get_theme_mod( 'artsite_background_color' );
  $bg_image = get_theme_mod('background_image');
  $bg_repeat = get_theme_mod('background_repeat');
  $bg_position = get_theme_mod('artsite_background_position');
  $bg_attachment = get_theme_mod('background_attachment');

  // Make sure colors are properly formatted
  $color = '#' . str_replace( '#', '', $color );
  ?>

  <style>
    body.custom-background, body{ background-color: <?php echo $color; ?>; }
    #wrap{ background: <?php echo "$color url($bg_image) $bg_repeat $bg_position $bg_attachment" ?>; }
  </style>
  <?php
}
add_action( 'wp_head', 'artsite_background_css', 210 );
