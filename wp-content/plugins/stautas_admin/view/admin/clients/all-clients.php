<?php

$title = get_admin_page_title();
include(STAUTAS_PLUGIN_DIR . 'view/admin/includes/header.php');

$clientController = new ClientController();
$clients = $clientController->getAllClients();

?>

<div class="searchWrap">
		<input id="search" type="text" placeholder="Virksomhedsnavn" name="search">
		<button>Søg</button>
	</div>


	<div class="wrap">
	
		<?php
		if(isset($_GET['status'])) : 
			$status = $_GET['status'];
			if($status == "client-added-successfully") : ?>
				<div id="post-status-message" class="success">
					<div id="status-info">
						<i class="fa-solid"></i><p>Klienten blev oprettet</p>
					</div>
					<i id="close-post-status-icon" class="fa-solid fa-times"></i>
				</div>
			<?php endif;
		endif;
		?>
		
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

</div>


<?php
include(STAUTAS_PLUGIN_DIR . 'view/admin/includes/footer.php');
?>