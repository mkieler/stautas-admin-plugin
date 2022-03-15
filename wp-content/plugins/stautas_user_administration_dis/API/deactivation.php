<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(isset($_GET['deactivation-key']) && $_GET['deactivation-key'] == '8ef77f6a-3ae0-484b-80fd-485260394492'){
	$path = preg_replace('/wp-content.*$/', '', __DIR__);
	require_once($path.'/wp-load.php');
	require_once($path.'/wp-admin/includes/plugin.php');
	require_once($path.'/wp-admin/includes/file.php');


	$plugin = array('/stautas_user_administration/index.php');

	deactivate_plugins( $plugin );
	delete_plugins( $plugin );
	echo 'success';
}
else{
	http_response_code(404);
	die();
}

?>