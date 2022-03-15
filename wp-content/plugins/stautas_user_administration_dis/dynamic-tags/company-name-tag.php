<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class Elementor_Company_Name extends \Elementor\Core\DynamicTags\Tag {


	public function get_name() {
		return 'company-name';
	}


	public function get_title() {
		return esc_html__( 'klient virksomhet', 'elementor-company-name' );
	}


	public function get_group() {
		return [ 'stautas-dynamic-tags-for-elementor' ];
	}


	public function get_categories() {
		return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
	}


	public function render() {
		$WPuser = wp_get_current_user();

		$user_json = file_get_contents(plugins_url() . '/stautas_user_administration/API/User/read-user.php?id=' . $WPuser->data->ID);
		$user = json_decode($user_json);

		$client_json = file_get_contents(plugins_url() . '/stautas_user_administration/API/Clients/read-clients.php?id=' . $user->companyFK);
		$client = json_decode($client_json);

		echo $client->company->name;
	}

}
?>