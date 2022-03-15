<?php

$icon = STAUTAS_PLUGIN_URI . "/assets/img/icon.png";
add_role( "client_admin", "Klient admin" );
add_role( "client_sub_user", "Klient ansat" );
add_menu_page("Stautas Admin", "Stautas Admin", 4, "stautas-admin", "stautasAdmin", $icon );
add_submenu_page("stautas-admin", "Klienter", "Klienter", 4, "stautas-clients", "stautasClientsCRUD");
add_submenu_page("stautas-all-company", 'Bruger detaljer','Bruger detaljer', 4, 'stautas-company-detail', 'stautasCompanyDetails');
add_submenu_page("stautas-admin", 'Indstillinger','Indstillinger', 4, 'stautas-settings', 'stautasSettings');





function stautasAdmin(){	
	include( STAUTAS_PLUGIN_DIR . 'view/admin/dashboard.php');
}


/**
 * CRUD pages for clients
 */
function stautasClientsCRUD(){	

	$tab = isset($_GET['tab']) ? $_GET['tab'] : "";

	switch ($tab) {
		case 'create-client':
			include(STAUTAS_PLUGIN_DIR . 'view/admin/clients/create-client.php');
			break;


		case 'client-details':
			$title = "Opret klient";

			include(STAUTAS_PLUGIN_DIR . 'view/admin/clients/client-details.php');
			break;


		case 'client-subuser-details':
			$title = "Opret klient";

			include(STAUTAS_PLUGIN_DIR . 'view/admin/clients/sub-users/details.php');
			break;


		case 'update-client':
			$title = "Opret klient";

			include(STAUTAS_PLUGIN_DIR . 'view/admin/clients/update-client.php');
			break;


		case 'create-sub-user':
			$title = "Opret klient";

			include(STAUTAS_PLUGIN_DIR . 'view/admin/clients/sub-users/create-sub-user.php');
			break;
		
		default:

			include(STAUTAS_PLUGIN_DIR . 'view/admin/clients/all-clients.php');
	}
}





/**
 * Settings page
 */
function stautasSettings()
{
	include( STAUTAS_PLUGIN_DIR . 'view/admin/settings.php');
}

?>