<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function register_tag_group( $dynamic_tags_manager ) {

	$dynamic_tags_manager->register_group(
		'stautas-dynamic-tags-for-elementor',
		[
			'title' => esc_html__( 'Stautas', 'stautas-dynamic-tags-for-elementor' )
		]
	);

}
add_action( 'elementor/dynamic_tags/register', 'register_tag_group' );





function register_dynamic_tags( $dynamic_tags_manager ) {
	
	//path to dynamic tag files
	require_once( __DIR__ . '/dynamic-tags/acf-average-dynamic-tag.php' );
	require_once( __DIR__ . '/dynamic-tags/login-redirect-url.php' );
	require_once( __DIR__ . '/dynamic-tags/logout-url.php' );
	require_once( __DIR__ . '/dynamic-tags/company-name-tag.php' );

	//tags to be registered
	$dynamic_tags_manager->register( new \Elementor_Dynamic_Tag_ACF_Average );
	$dynamic_tags_manager->register( new \Elementor_Login_Redirect_Url );
	$dynamic_tags_manager->register( new \Elementor_Logout_Url );
	$dynamic_tags_manager->register( new \Elementor_Company_Name );
	
}
add_action( 'elementor/dynamic_tags/register_tags', 'register_dynamic_tags' );




?>
