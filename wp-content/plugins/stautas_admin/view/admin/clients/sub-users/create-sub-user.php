<?php

$client;
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$clientController = new ClientController();
	$client = $clientController->getClientById($id);
}

$title = "Opret underbruger til " . $client->company->name;
include(STAUTAS_PLUGIN_DIR . 'view/admin/includes/header.php');



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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$role = 'client_sub_user';
	$adminUserID = $client->adminUser->userID;
	$companyID = $client->company->companyID;


	$userController = new UserController();
	$userController->createEmployeeUser($adminUserID, $companyID, $username, $password, $email, $fname, $lname, $role);
	
	header("Location: ?page=stautas-clients&tab=client-details&status=user-added-successfully&id=" . $client->company->companyID);
	die();
}

?>
<div id="loading-wrap">
	<div class="loader"></div>
</div>





<div class="wrap">
	<form id="create-sub-user-form" method="post" action="">
		<table>
			<tr>
				<th>Brugernavn (obligatorisk)</th>
				<td>
					<input required id="username" type="text" name="username">
				</td>
			</tr>
			<tr>
				<th>Fornavn (obligatorisk)</th>
				<td>
					<input required type="text" name="fname">
				</td>
			</tr>
			<tr>
				<th>Efternavn (obligatorisk)</th>
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
		
		<button type="submit">Opret klient</button>
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