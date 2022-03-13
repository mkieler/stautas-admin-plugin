<?php
/**
 * Plugin Name: Elementor ACF Average Dynamic Tag
 * Description: Add dynamic tag that returns an ACF average.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-acf-average-dynamic-tag
 *
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function hello( $dynamic_tags_manager ) {

	$dynamic_tags_manager->register_group(
		'site',
		[
			'title' => esc_html__( 'Site', 'elementor-acf-average-dynamic-tag' )
		]
	);

}
add_action( 'elementor/dynamic_tags/register', 'hello' );


function cool( $dynamic_tags_manager ) {

	require_once( __DIR__ . '/dynamic-tags/acf-average-dynamic-tag.php' );

	$dynamic_tags_manager->register( new \Coool );

}
add_action( 'elementor/dynamic_tags/register', 'cool' );
?>