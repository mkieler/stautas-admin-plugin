<?php
$pluginName = '/stautas_user_administration';
$title = get_admin_page_title();
include(WP_PLUGIN_DIR . $pluginName . '/includes/header.php');

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<div class="wrap">
	<form method="post" action="<?php echo plugins_url() . $pluginName . '/functions/create-user.php' ?>">
		<table>
			<tr>
				<th>Brugernavn (obligatorisk)</th>
				<td>
					<input required type="text" name="username">
				</td>
			</tr>
			<tr>
				<th>Password</th>
				<td>
					<input required id="password" type="password" name="password" value="<?php echo randomPassword() ?>">
					<i class="far fa-eye" id="togglePassword"></i>
				</td>
			</tr>
			<tr>
				<th>Email (obligatorisk)</th>
				<td>
					<input required type="text" name="email">
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


<script>
	const togglePassword = document.getElementById('togglePassword');
  const password = document.getElementById('password');
 
  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>

<?php

include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/footer.php');
?>