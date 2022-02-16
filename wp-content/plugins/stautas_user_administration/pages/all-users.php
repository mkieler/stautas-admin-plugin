<?php
$title = get_admin_page_title();
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/header.php');

global $wpdb;
$result = $wpdb->get_results ( "SELECT * FROM wp_stautas_users" );


if(isset($_GET["id"])){

}

else{
	?>
	<div class="wrap">
	<table>
		<tr>
			<th>Admin klient</th>
			<th>Antal underbrugere</th>
		</tr>
		<?php
		foreach ( $result as $print ) {
		?>
		<tr>
			<td><a href="?page=stautas-user-detail&id=<?php echo $print->ID ?>"><?php echo $print->Company_name ?></a></td>
			<td><a href="?page=stautas-user-detail">100</a></td>
		</tr>
		<?php
		}
		?>
	</table>

</div>
<?php
}
?>


<style>
	
	table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

table td, table th {
  border: 1px solid #ddd;
  padding: 0px;
}

table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {
	background-color: #ddd;
}

table th {
  padding: 12px;
  text-align: left;
  background-color: var(--primary);
  color: white;
}

table a{
	display: block;
	padding: 8px;
	text-decoration: none;
	color: black;
}

table tr:hover a{
	color: var(--primary);
}

</style>
<?php
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/footer.php');

?>