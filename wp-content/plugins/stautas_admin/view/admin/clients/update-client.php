<?php
$title = "Opdater klient";
include(STAUTAS_PLUGIN_DIR . 'view/admin/includes/header.php');


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


$client;
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$clientController = new ClientController();
	$client = $clientController->getClientById($id);
}


?>



<div class="wrap">
	<form method="post" action="">
		<table>
			<tr>
				<th>Firmanavn </th>
				<td>
					<input required type="text" name="company-name" value="<?php echo $client->company->name ?>">
				</td>
			</tr>
			<tr>
				<th>Admin brugernavn </th>
				<td>
					<input required id="username" type="text" name="username" value="<?php echo $client->adminUser->username ?>">
				</td>
			</tr>
			<tr>
				<th>Admin fornavn </th>
				<td>
					<input required type="text" name="fname" value="<?php echo $client->adminUser->fname ?>">
				</td>
			</tr>
			<tr>
				<th>Admin efternavn </th>
				<td>
					<input required type="text" name="lname" value="<?php echo $client->adminUser->lname ?>">
				</td>
			</tr>
			<tr>
				<th>Admin email </th>
				<td>
					<input required type="text" name="email" value="<?php echo $client->adminUser->email ?>">
				</td>
			</tr>
			

		</table>
		

		<p style="font-size: 20px; font-weight: 600;">Hvilke kategorier kan kunden købe fra</p>

		<?php $product_cat_array = get_terms( 'product_cat' ); ?>
		<ul style="columns: 3; -webkit-columns: 3; -moz-columns: 3;">
		<?php foreach($product_cat_array as $curr_product_cat) : ?>	
			<li>
				<?php if(in_array($curr_product_cat->slug, $client->company->categoriesToShow) ) : ?>
					<input type="checkbox" checked  name="categories[<?php echo $curr_product_cat->slug ?>]">	
				<?php else : ?>
					<input type="checkbox"  name="categories[<?php echo $curr_product_cat->slug ?>]">
				<?php endif; ?>
				
				<label for="<?php echo $curr_product_cat->slug ?>"><?php echo $curr_product_cat->name ?></label>
			</li>
		<?php endforeach; ?>
		</ul>


		<button type="submit">Opdater klient</button>
	</form>
</div>

<style>
	form td, form th{
		padding: 10px 0;
	}

	form th{
		width: 300px;
		text-align: left;
	}

	form td{
		width: 300px;
		text-align: left;
		position: relative;
		display: flex;
		align-items: center;
	}

	form td input{
		flex: 1;
	}

	form button{
		margin-top: 30px;
	}


	#togglePassword{
		position: absolute;
		right: 10px;
		cursor: pointer;
	}

	#togglePassword:hover{
		color: blue;
	}


</style>

<?php

include(STAUTAS_PLUGIN_DIR . 'view/admin/includes/footer.php');
?>