<?php 
$pluginName = '/stautas_user_administration';
$plugin_settings_json = file_get_contents(plugins_url() . $pluginName . '/API/plugin-settings/read-plugin-settings.php');
$plugin_settings = json_decode($plugin_settings_json);

	

if(!is_user_logged_in()){
	header("Location:" . $plugin_settings->login_page_url);
	die();
}



session_start();
$user = $_SESSION["stautas-user"];
$client = $_SESSION["stautas-client"];
$WPuser = wp_get_current_user();




wp_head();

?>

<div id="user-area-wrap">

		<div id="user-area-menu">
		<?php
		echo get_custom_logo();
		if(in_array( 'client_admin', (array) $WPuser->roles ) || current_user_can( 'manage_options' )) :
			wp_nav_menu( array( 
			    'theme_location' => 'user-panel-admin-menu', 
			    'container_class' => 'user-panel-menu-wrap' ) 
			); 
		elseif (in_array( 'client_sub_user', (array) $WPuser->roles )):
			wp_nav_menu( array( 
			    'theme_location' => 'user-panel-employee-menu', 
			    'container_class' => 'user-panel-menu-wrap' ) 
			); 
		endif;	?>



		<div id="menu-footer">
			<a class="log-out" href="<?php echo wp_logout_url( home_url() ); ?>">
				<i class="fa-solid fa-arrow-right-from-bracket"></i>
				Log ud
			</a>
		</div>
	</div>
	

	<div id="user-area-content">
		<div id="content-header">
			<div>
				<a style="color: white" class="icon-box" href="<?php echo home_url()?>">
					<i class="fa-solid fa-share fa-flip-horizontal"></i>
					<p>Gå tilbage</p>
				</a>
			</div>
			
			<div>
				<div class="icon-box" style="margin-right: 20px;">
					<i class="fa-solid fa-user"></i>
					<p>Du er logget ind som <?php echo $user->display_name ?> fra <?php echo $client->company->name ?></p>
				</div>
				<a style="color: white" class="icon-box" href="">
					<i class="fa-solid fa-gear"></i>
					<p>Indstillinger</p>
				</a>
			</div>
		</div>
		<?php
		// the content
		if(have_posts()) : while (have_posts()) : the_post(); 

			the_content();

		endwhile; endif;
		?>
	</div>
</div>



<style type="text/css">
	
	#user-area-wrap{
		display: flex;
		align-items: stretch;
		<?php if(is_admin_bar_showing()) :?>
			min-height: calc(100vh - var(--wp-admin--admin-bar--height));
			min-height: -moz-calc(100vh - var(--wp-admin--admin-bar--height));
			min-height: -webkit-calc(100vh - var(--wp-admin--admin-bar--height));
			min-height: -o-calc(100vh - var(--wp-admin--admin-bar--height));
			min-height: calc(100vh - var(--wp-admin--admin-bar--height));
		<?php else : ?>
			min-height: 100vh;
		<?php endif; ?>
	}




	#user-area-menu{
		position: -webkit-sticky; /* Safari */
  		position: sticky;
  		top: var(--wp-admin--admin-bar--height);
		width: 300px;
		background: #323e4d;
		color: white;
		display: flex;
		flex-direction: column;
		align-items: center;
		padding: 35px;
		<?php if(is_admin_bar_showing()) :?>
			max-height: calc(100vh - var(--wp-admin--admin-bar--height));
			max-height: -moz-calc(100vh - var(--wp-admin--admin-bar--height));
			max-height: -webkit-calc(100vh - var(--wp-admin--admin-bar--height));
			max-height: -o-calc(100vh - var(--wp-admin--admin-bar--height));
			max-height: calc(100vh - var(--wp-admin--admin-bar--height));
		<?php else : ?>
			max-height: 100vh;
		<?php endif; ?>
	}


	#user-area-menu .current-menu-item a{
		color: #bf3318;
	}

	#menu-footer{
		flex: 1;
		display: flex;
		flex-wrap: wrap;
		align-items: flex-end;
	}

	#menu-footer .log-out{
		color: white;
	}

	#menu-footer .log-out i{
		font-size: 45px;
		display: block;
	}

	#user-area-content{
		flex: 1 1;
		background: #ebecf0;
	}

	#site-footer{
		padding: 0;
	}

	#content-header{
		position: -webkit-sticky; /* Safari */
  		position: sticky;
  		top: var(--wp-admin--admin-bar--height);
  		z-index: 999;
		display: flex;
		background: #3d4754;
		align-items: center;
		padding: 20px;
		color: white;
		justify-content: space-between;
	}


	#content-header .icon-box{
		display: flex;
		align-items: center;
	}

	#content-header .icon-box p{
		margin: 0 0 0 10px;
	}

	#content-header div{
		display: flex;
	}


	.user-panel-menu-wrap{
		padding-top: 35px;
		display: inline-block;
	}

	.user-panel-menu-wrap .menu-item{
		font-size: 20px;
		padding: 15px 0;
	}

	.user-panel-menu-wrap .menu-item a{
		color: white;
	}

	.user-panel-menu-wrap ul{
		padding: 0;
		margin: 0;
		list-style: none;
	}


	a:hover {
		color: red !important;
	}






</style>

<?php wp_footer();; ?>


