<?php 



$title = $client->company->name;
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/header.php');

?>



<div style="display: flex; justify-content: space-between">
	<div>
		<h2>Virksomhedsoplysninger</h2>
		<ul>
			<li>Org nummer: NO22222222</li>
			<li>Email: test@test.no</li>
			<li>Telefon: +47 12345678</li>
		</ul>
	</div>
	<div>
		<h2>Direkte kontakt person</h2>
		<ul>
			<li>Navn: Mattias Molin</li>
			<li>Email: test@test.com</li>
			<li>Telefon: +47 12345678</li>
		</ul>
	</div>
</div>

<div>
	<h2>Kategorier vist til ansat</h2>
	<p>
		<?php 
			foreach ($client->company->categoriesToShow as $key => $value) {
				echo $value . ", ";
			}
		?>
	</p>
</div>


<h2 style="margin-top: 40px;">Brugere i virksomheden</h2>
<table class="clients-table">
	<tr>
		<th>Bruger ID</th>
		<th>Brugernavn</th>
		<th>Fulde navn</th>
	</tr>
	<?php foreach($client->subUsers as $currentSubuser) : ?>
		<tr>
			<td><a href="?page=stautas-clients&tab=client-subuser-details&id=<?php echo $currentSubuser->userID ?>"><?php echo $currentSubuser->userID ?></a></td>
			<td><a href="?page=stautas-clients&tab=client-subuser-details&id=<?php echo $currentSubuser->userID ?>"><?php echo $currentSubuser->username ?></a></td>
			<td><a href="?page=stautas-clients&tab=client-subuser-details&id=<?php echo $currentSubuser->userID ?>"><?php echo $currentSubuser->display_name ?></a></td>
		</tr>
	<?php endforeach ?>
</table>


<div class="actions-wrap">
	<a href="?page=stautas-clients&tab=create-sub-user&id=<?php echo $client->company->companyID?>">
		<p class="action-icon-text">Tilføj underbruger</p>
		<div class="action-icon actions-sub-icon">
			<i style="font-size: 20px;" class="fa-solid fa-user-plus"></i>
		</div>
	</a>
	<a href="?page=stautas-clients&tab=update-client&id=<?php echo $client->company->companyID?>">
		<p class="action-icon-text">Rediger</p>
		<div class="action-icon">
			<i style="font-size: 23px;" class="fa-solid fa-pen-to-square"></i>
		</div>
	</a>	
</div>

<?php
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/footer.php');
?>