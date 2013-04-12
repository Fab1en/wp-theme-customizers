<?php

// Register Fonts section in theme customizer
function artsite_register_sections( $wp_customize ) {


	$wp_customize->add_section( 'artsite_colors', array(
			'title' => __( 'Colors', 'artsite' ),
			'priority' => 1
		) );

	$wp_customize->add_section( 'artsite_fonts', array(
			'title' => __( 'Fonts', 'artsite' ),
			'priority' => 2
		) );

	$wp_customize->add_section( 'artsite_buttons_links', array(
			'title' => __( 'Links & Buttons', 'artsite' ),
			'priority' => 3
		) );

	$wp_customize->add_section( 'artsite_general', array(
			'title' => __( 'General Settings', 'artsite' ),
			'priority' => 4
		) );
}
add_action( 'customize_register', 'artsite_register_sections', 1 );
