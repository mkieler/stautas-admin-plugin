<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class Elementor_Logout_Url extends \Elementor\Core\DynamicTags\Tag {


	public function get_name() {
		return 'logout-url';
	}


	public function get_title() {
		return esc_html__( 'Logout url', 'elementor-logout-url' );
	}


	public function get_group() {
		return [ 'stautas-dynamic-tags-for-elementor' ];
	}


	public function get_categories() {
		return [ \Elementor\Modules\DynamicTags\Module::URL_CATEGORY ];
	}


	public function render() {
		echo wp_logout_url( home_url() );
	}

}
?>