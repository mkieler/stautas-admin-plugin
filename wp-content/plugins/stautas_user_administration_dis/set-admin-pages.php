<?php

$icon = plugin_dir_url( __FILE__ ) . "/assets/img/icon.png";
add_role( "client_admin", "Klient admin" );
add_role( "client_sub_user", "Klient ansat" );
add_menu_page("Stautas Admin", "Stautas Admin", 4, "stautas-admin", "stautasAdmin", $icon );
add_submenu_page("stautas-admin", "Klienter", "Klienter", 4, "stautas-clients", "stautasAllClients");
add_submenu_page("stautas-all-company", 'Bruger detaljer','Bruger detaljer', 4, 'stautas-company-detail', 'stautasCompanyDetails');
add_submenu_page("stautas-admin", 'Indstillinger','Indstillinger', 4, 'stautas-settings', 'stautasSettings');



$GLOBALS["plugin_path"] = plugin_dir_path( __FILE__ );

function stautasAdmin(){	
	include( $GLOBALS["plugin_path"] . 'pages/admin/admin-page.php');
}



function stautasAllClients()
{	
	include( $GLOBALS["plugin_path"] . 'pages/admin/clients/index.php');
}




function stautasCompanyDetails()
{
	include( $GLOBALS["plugin_path"] . 'pages/admin/company-detail.php');
}



function stautasSettings()
{
	include( $GLOBALS["plugin_path"] . 'pages/admin/settings.php');
}

?>