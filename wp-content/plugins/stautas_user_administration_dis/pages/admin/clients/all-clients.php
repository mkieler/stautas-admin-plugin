<?php

$title = get_admin_page_title();
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/header.php');

?>

<div class="searchWrap">
		<input id="search" type="text" placeholder="Virksomhedsnavn" name="search">
		<button>Søg</button>
	</div>
	
	<div class="wrap">
	<table class="clients-table">
		<tr>
			<th>Virksomhed</th>
			<th>Admin bruger</th>
			<th>Brugere i alt</th>
		</tr>
		<?php
		if($clients != null) :
			foreach ( $clients as $currClient ) :
			?>
			<tr>
				<td><a href="?page=stautas-clients&tab=client-details&id=<?php echo $currClient->company->companyID ?>"><?php echo $currClient->company->name ?></a></td>
				<td><a href="?page=stautas-clients&tab=client-details&id=<?php echo $currClient->company->companyID ?>"><?php echo $currClient->adminUser->display_name ?></a></td>
				<td><a href="?page=stautas-clients&tab=client-details&id=<?php echo $currClient->company->companyID ?>"><?php echo $currClient->numOfUsers ?></a></td>
			</tr>
			<?php
			endforeach;
		endif;
		?>
	</table>
	
	<div class="actions-wrap">
		<a href="?page=stautas-clients&tab=create-client">
			<p class="action-icon-text">Ny klient</p>
			<div class="action-icon">
				<i style="font-size: 35px" class="fa-solid fa-plus"></i>
			</div>
		</a>
	</div>

</div>


<?php
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/footer.php');
?>