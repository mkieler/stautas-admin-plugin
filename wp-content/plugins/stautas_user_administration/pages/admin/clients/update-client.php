<?php
$title = "Opdater klient";
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/header.php');


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
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

include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/footer.php');
?>