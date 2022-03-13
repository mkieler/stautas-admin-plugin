<?php


$plugin_url = plugins_url();
$clientJson = file_get_contents($plugin_url . '/stautas_user_administration/API/Clients/read-clients.php');
$clients = json_decode($clientJson);

$client;
if(isset($_GET['id'])){
	$clientID = $_GET['id'];
	$pluginName = '/stautas_user_administration';
	$client_json = file_get_contents(plugins_url() . $pluginName . '/API/Clients/read-clients.php?id=' . $clientID);
	$client = json_decode($client_json);
}


$tab = isset($_GET['tab']) ? $_GET['tab'] : "";

switch ($tab) {
	case 'create-client':
		include(WP_PLUGIN_DIR . '/stautas_user_administration/pages/admin/clients/create-client.php');
		break;


	case 'client-details':
		$title = "Opret klient";

		include(WP_PLUGIN_DIR . '/stautas_user_administration/pages/admin/clients/client-details.php');
		break;


	case 'client-subuser-details':
		$title = "Opret klient";

		include(WP_PLUGIN_DIR . '/stautas_user_administration/pages/admin/clients/sub-users/details.php');
		break;


	case 'update-client':
		$title = "Opret klient";

		include(WP_PLUGIN_DIR . '/stautas_user_administration/pages/admin/clients/update-client.php');
		break;


	case 'create-sub-user':
		$title = "Opret klient";

		include(WP_PLUGIN_DIR . '/stautas_user_administration/pages/admin/clients/sub-users/create-sub-user.php');
		break;
	
	default:

		include(WP_PLUGIN_DIR . '/stautas_user_administration/pages/admin/clients/all-clients.php');
}






include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/footer.php');

?>