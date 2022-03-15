<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class Elementor_Dynamic_Tag_ACF_Average extends \Elementor\Core\DynamicTags\Tag {


	public function get_name() {
		return 'acf-average';
	}


	public function get_title() {
		return esc_html__( 'Test', 'elementor-acf-average-dynamic-tag' );
	}


	public function get_group() {
		return [ 'stautas-dynamic-tags-for-elementor' ];
	}


	public function get_categories() {
		return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
	}

	protected function register_controls() {
		$this->add_control(
			'fields',
			[
				'label' => esc_html__( 'Fields', 'elementor-acf-average-dynamic-tag' ),
				'type' => 'text',
			]
		);
		$this->add_control(
			'test',
			[
				'label' => esc_html__( 'Test', 'elementor-acf-average-dynamic-tag' ),
				'type' => 'text',
			]
		);
	}


	public function render() {
		$fields = $this->get_settings( 'fields' );
		$sum = 0;
		$count = 0;
		$value = 0;

		// Make sure that ACF if installed and activated
		if ( ! function_exists( 'get_field' ) ) {
			echo 0;
			return;
		}

		foreach ( explode( ',', $fields ) as $index => $field_name ) {
			$field = get_field( $field_name );
			if ( (int) $field > 0 ) {
				$sum += (int) $field;
				$count++;
			}
		}

		if ( 0 !== $count ) {
			$value = $sum / $count;
		}

		echo $value;
	}

}
?>