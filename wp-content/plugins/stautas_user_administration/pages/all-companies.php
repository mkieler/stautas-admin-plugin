<?php
$title = get_admin_page_title();
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/header.php');

$plugin_url = plugins_url();
$userJson = file_get_contents($plugin_url . '/stautas_user_administration/API/Company/read-company.php');
$user = json_decode($userJson);


if(isset($_GET["id"])){

}

else{

	
	?>
	<div class="searchWrap">
		<input id="search" type="text" placeholder="Virksomhedsnavn" name="search">
		<button>Søg</button>
	</div>
	
	<div class="wrap">
	<table>
		<tr>
			<th>Virksomhed</th>
			<th>Admin bruger</th>
			<th>Brugere i alt</th>
		</tr>
		<?php
		foreach ( $user as $print ) {
		?>
		<tr>
			<td><a href="?page=stautas-company-detail&id=<?php echo $print->companyID ?>"><?php echo $print->name ?></a></td>
			<td><a href="?page=stautas-company-detail&id=<?php echo $print->companyID ?>"><?php echo $print->adminUser->username ?></a></td>
			<td><a href="?page=stautas-company-detail"><?php echo $print->numOfUsers ?></a></td>
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

.searchWrap{
	float: right;
	margin-top: 20px;
	display: flex;
}

.searchWrap input{
	height: 35px;
	border-radius: 5px 0 0 5px;
	margin: 0;
}

.searchWrap button{
	height: 35px;
	padding: 0 25px;
	border-radius: 0 5px 5px 0;
}

</style>
<?php
include(WP_PLUGIN_DIR . '/stautas_user_administration/includes/footer.php');

?>