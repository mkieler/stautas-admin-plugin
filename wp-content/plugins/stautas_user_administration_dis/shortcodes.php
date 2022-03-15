<?php
function create_sub_user(){
	ob_start();
	include(WP_PLUGIN_DIR . '/stautas_user_administration/pages/frontend/create-sub-user.php');
	return ob_get_clean();
}
add_shortcode("opret_underbruger_form", "create_sub_user" );
?>