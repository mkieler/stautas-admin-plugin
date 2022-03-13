<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class Coool extends \Elementor\Core\DynamicTags\Tag {


	public function get_name() {
		return 'acf-average';
	}


	public function get_title() {
		return esc_html__( 'ACF Average', 'elementor-acf-average-dynamic-tag' );
	}


	public function get_group() {
		return [ 'site' ];
	}


	public function get_categories() {
		return [ \Elementor\Modules\DynamicTags\Module::URL_CATEGORY ];
	}



	public function render() {
		echo 'https://google.com';
	}

}