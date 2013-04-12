<?php

/*
 * Creates the section, settings and the controls for the customizer
 */
function artsite_background_customizer( $wp_customize ){

  // Adds compatibility with wordpress's default background color control.
  $background_color = get_theme_mod( 'background_color' );
  $background_color = '#' . str_replace( '#', '', $background_color );
  set_theme_mod( 'background_color', get_theme_mod( 'artsite_background_color' ) );

  $settings   = array();
  // Color Settings
  $settings[] = array(
      'slug' => 'artsite_background_color',
      'default' => $background_color
    );
  $settings[] = array(
      'slug' => 'artsite_background_position',
      'default' => '0px 0px'
    );

  foreach( $settings as $setting ){
    $wp_customize->add_setting( $setting['slug'], array(
        'default' => $setting['default'],
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage'
      )
    );
  }

  // Remove the default "background" control
  $wp_customize->remove_control( 'background_color' );
  $wp_customize->remove_control( 'background_position_x' );

  /*
   * Color Controls
   */
  $color_controls   = array();

  // Background Color
  $color_controls[] = array( 'setting' => 'artsite_background_color', 'label' => 'Background Color', 'section' => 'artsite_colors', 'priority' => 6 );

  foreach( $color_controls as $control ){
    $wp_customize->add_control( new WP_Customize_Color_Control(
      $wp_customize,
      $control['setting'],
      array(
        'label'     => __( $control['label'], 'artsite' ),
        'section'   => $control['section'],
        'settings'  => $control['setting'],
        'priority'  => $control['priority'],
      )
    ));
  }
}
add_action( 'customize_register', 'artsite_background_customizer' );
