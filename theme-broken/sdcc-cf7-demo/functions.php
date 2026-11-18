<?php
/**
 * SDCC CF7 Demo theme — setup + asset loading.
 */

function sdcc_cf7_demo_setup() {
	add_theme_support( 'title-tag' );

	register_nav_menus( array(
		'primary' => 'Primary Menu',
	) );
}
add_action( 'after_setup_theme', 'sdcc_cf7_demo_setup' );

function sdcc_cf7_demo_assets() {
	wp_enqueue_style(
		'sdcc-cf7-demo-style',
		get_stylesheet_uri(),
		array(),
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'sdcc_cf7_demo_assets' );
