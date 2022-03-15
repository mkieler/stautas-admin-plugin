<?php

$client;
if(isset($_GET['id'])){
	$clientID = $_GET['id'];
	$pluginName = '/stautas_user_administration';
	$client_json = file_get_contents(plugins_url() . $pluginName . '/API/Clients/read-clients.php?id=' . $clientID);
	$client = json_decode($client_json);
}

$title = "Opret underbruger til " . $client->company->name;
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/header.php');



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
	<form id="create-sub-user-form" method="post" action="<?php echo plugins_url() . $pluginName . '/API/User/create-sub-user.php?id=' . $client->company->companyID ?>">
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

include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/footer.php');
?>