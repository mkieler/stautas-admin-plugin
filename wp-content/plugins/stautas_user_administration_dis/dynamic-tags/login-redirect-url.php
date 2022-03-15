<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class Elementor_Login_Redirect_Url extends \Elementor\Core\DynamicTags\Tag {


	public function get_name() {
		return 'login-redirect-url';
	}


	public function get_title() {
		return esc_html__( 'Login redirect url', 'elementor-login-redirect-url' );
	}


	public function get_group() {
		return [ 'stautas-dynamic-tags-for-elementor' ];
	}


	public function get_categories() {
		return [ \Elementor\Modules\DynamicTags\Module::URL_CATEGORY ];
	}


	public function render() {
		$pluginName = '/stautas_user_administration';
		$plugin_settings_json = file_get_contents(plugins_url() . $pluginName . '/API/plugin-settings/read-plugin-settings.php');
		$plugin_settings = json_decode($plugin_settings_json);

		echo $plugin_settings->login_redirect_url;
	}

}
?>