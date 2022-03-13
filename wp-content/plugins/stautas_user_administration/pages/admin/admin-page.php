<?php 
$title = get_admin_page_title();
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/header.php');
?>

<div class="wrap">
	<div class="dashboard">
		<a href="?page=stautas-clients" class="board">
			<i class="fa-solid fa-users"></i>
			<p>Klienter</p>
		</a>
		<a href="?page=stautas-settings" class="board">
			<i class="fa-solid fa-gear"></i>
			<p>Indstillinger</p>
		</a>
	</div>
</div>


<style type="text/css">
	
	.dashboard{
		display: grid;
		grid-gap: 1rem;
		grid-template-columns: repeat(4, 1fr);
	}

	.dashboard a{
		text-decoration: none;
	}

	.dashboard a:hover, .dashboard a:hover h2{
		color: var(--primary);
	}

	.board{
		border: solid 2px #c1c1c1;
		border-radius: 8px;
		display: flex;
		flex-direction: column;
		align-items: center;
		font-size: 30px;
		padding: 40px;
	}

	.board p{
		margin: 15px 0 0 0;
		font-size: 30px;
	}

</style>

<?php

include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/footer.php');
?>

