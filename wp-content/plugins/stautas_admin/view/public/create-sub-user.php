<?php 
wp_enqueue_script( 'toggle-password', $GLOBALS["plugin_url"] . 'assets/js/togglepassword.js', false, false );
	$pluginName = '/stautas_user_administration';
	$WPuser = wp_get_current_user();


	$user_json = file_get_contents(plugins_url() . $pluginName . '/API/User/read-user.php?id=' . $WPuser->data->ID);
	$user = json_decode($user_json);


	$client_json = file_get_contents(plugins_url() . $pluginName . '/API/Clients/read-clients.php?id=' . $user->companyFK);
	$client = json_decode($client_json);

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


<style>

	#create-sub-user-form table{
	    border: none;
	}


	#create-sub-user-form th{
	    text-align: left;
	    width: 350px;
	    border: none;
	}

	#create-sub-user-form td{
	    display: flex;
	    align-items: center;
	    border: none;
	}


	#create-sub-user-form tr:hover th, #create-sub-user-form tr:hover td{
	    background: unset;
	}

	#togglePassword{
	    position: absolute;
	    right: 25px;
	    cursor: pointer;
	}

	#create-sub-user-form button{
		float: right;
	}

	#create-sub-user-form input{
    	width: 100%;
	}	

	</style>
	<div id="loading-wrap">
		<div class="loader"></div>
	</div>


	<div id="post-status-message">
		<div id="status-info">
			<i class="fa-solid"></i><p></p>
		</div>
		<i id="close-post-status-icon" class="fa-solid fa-times"></i>
	</div>

	<form id="create-sub-user-form" method="post" action="<?php echo plugins_url() . '/stautas_user_administration/API/User/create-sub-user.php?id=' . $client->company->companyID ?>">
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