<?php
$title = "Opret klient";
include(STAUTAS_PLUGIN_DIR . 'view/admin/includes/header.php');


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Generate random password
 */
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 15; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


/**
 * When form is submitted
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	require_once STAUTAS_PLUGIN_DIR . 'controller/ClientController.php';

	$companyname = $_POST['company-name'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$role = 'client_admin';


	$categoriesSelected = $_POST['categories'];
	$categoriesJson = json_encode(array_keys($categoriesSelected)); 



	$clientController = new ClientController();
	$clientController->createClient($companyname, $username, $password, $email, $fname, $lname, $role, $categoriesJson);

	header("Location: ?page=stautas-clients&status=client-added-successfully");
	die();
}

?>

<div id="loading-wrap">
	<div class="loader"></div>
</div>

<div id="post-status-message">
	<div id="status-info">
		<i class="fa-solid"></i><p></p>
	</div>
	<i id="close-post-status-icon" class="fa-solid fa-times"></i>
</div>


<div class="wrap">
	<form id="create-client-form" method="post" action="">
		<table>
			<tr>
				<th>Firmanavn (obligatorisk)</th>
				<td>
					<input required type="text" name="company-name">
				</td>
			</tr>
			<tr>
				<th>Brugernavn (obligatorisk)</th>
				<td>
					<input required id="username" type="text" name="username">
				</td>
			</tr>
			<tr>
				<th>Fornavn på admin (obligatorisk)</th>
				<td>
					<input required type="text" name="fname">
				</td>
			</tr>
			<tr>
				<th>Efternavn på admin (obligatorisk)</th>
				<td>
					<input required type="text" name="lname">
				</td>
			</tr>
			<tr>
				<th>Email (obligatorisk)</th>
				<td>
					<input required type="text" name="email">
				</td>
			</tr>
			<tr>
				<th>Password</th>
				<td>
					<input required id="password" type="password" name="password" value="<?php echo randomPassword() ?>">
					<i class="far fa-eye" id="togglePassword"></i>
				</td>
			</tr>
		</table>

		<p style="font-size: 20px; font-weight: 600;">Hvilke kategorier kan kunden købe fra</p>

		<?php $product_cat_array = get_terms( 'product_cat' ); ?>
		<ul style="columns: 3; -webkit-columns: 3; -moz-columns: 3;">
		<?php foreach($product_cat_array as $curr_product_cat) : ?>
			<li>
				<input type="checkbox" name="categories[<?php echo $curr_product_cat->slug ?>]">
				<label for="<?php echo $curr_product_cat->slug ?>"><?php echo $curr_product_cat->name ?></label>
			</li>
		<?php endforeach; ?>
		</ul>
		
		<button type="submit">Opret klient</button>
	</form>
</div>




<?php

include(STAUTAS_PLUGIN_DIR . 'view/admin/includes/footer.php');
?>