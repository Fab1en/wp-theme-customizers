<?php

/*
 * ArtSite theme customizer custom background image settings
 */
function artsite_background_image_customizer( $wp_customize ){
    $wp_customize->remove_control('background_position_x');
}
add_action( 'customize_register', 'artsite_background_image_customizer' );

/*
 * Javascript code used in the customizer iframe to move the background image
 */
function artsite_customize_live_apply(){
    wp_enqueue_script('artsite_customize_background_image', get_template_directory_uri().'/customizer/javascript/customize-theme.js', array('jquery'), false, true);
}
add_action('customize_preview_init', 'artsite_customize_live_apply');
