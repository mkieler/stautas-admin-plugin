<?php
$pluginName = '/stautas_user_administration';
$title = get_admin_page_title();
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/header.php');

$plugin_settings_json = file_get_contents(plugins_url() . $pluginName . '/API/plugin-settings/read-plugin-settings.php');

$plugin_settings = json_decode($plugin_settings_json);



$hasRedirectUrl = false;
if($plugin_settings->login_redirect_url != null){
	$hasRedirectUrl = true;
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

<form id="settings-form" method="post" action="<?php echo plugins_url() . $pluginName . '/API/plugin-settings/update-plugin-settings.php' ?>">
	<table>
		<tr>
			<th>Login side (Shortcode)</th>
			<td>
				<select name="login-page-url">
					<option selected disabled>Vælg login side</option>
					<?php
					$pages = get_pages(); 
					foreach ($pages as $page_data) {
						$curr_page_url = parse_url(get_page_link( $page_data->ID ))["path"];
						$selected = "";
						if($plugin_settings->login_page_url == $curr_page_url){
							$selected = "selected";
						}
					  	echo '<option ' . $selected . ' value="' . $curr_page_url . '">' . $page_data->post_title . '</option>'; 
					}
					?>
				</select>
				
			</td>
		</tr>
		<tr>
			<th>redirect til side efter login</th>
			<td>
				<select name="login-redirect-url">
					<option <?php if(!$hasRedirectUrl) echo 'selected' ?> disabled>Vælg side at redirecte til</option>
					<?php
					$pages = get_pages(); 
					foreach ($pages as $page_data) {
						$curr_page_url = parse_url(get_page_link( $page_data->ID ))["path"];
						$selected = "";
						if($plugin_settings->login_redirect_url == $curr_page_url){
							$selected = "selected";
						}
					  	echo '<option ' . $selected . ' value="' . $curr_page_url . '">' . $page_data->post_title . '</option>'; 
					}
					?>
				</select>
				
			</td>
			

					

				
			</td>
		</tr>
	</table>
	<button type="submit">Opdater</button>
</form>

<style>
	form td, form th{
		padding: 10px 0;
	}

	form th{
		width: 300px;
		text-align: left;
	}

	form td{
		min-width: 300px;
		text-align: left;
		position: relative;
		display: flex;
		align-items: center;
	}

	form td input, form td select{
		flex: 1;
	}

	form button{
		margin-top: 30px;
	}
</style>


<?php

include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/footer.php');
?>