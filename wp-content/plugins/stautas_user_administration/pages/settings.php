<?php
$title = get_admin_page_title();
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/header.php');
?>


<form>
	<table>
		<tr>
			<th>Brugerpanel side (Shortcode)</th>
			<td>
				["stautas_user_panel_page"]
					<?php
					//	$pages = get_pages(); 
					//	foreach ($pages as $page_data) {
					//	  echo '<option>' . $page_data->post_title . '</option>'; 
					//	}
					?>
			</td>
		</tr>
		<tr>
			<th>Login side (Shortcode)</th>
			<td>
				["stautas_user_login_page"]
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