<?php
include("dblib.php");
$db		=	new mysqli($connect_params['dbhost'],$connect_params['dbuser'],$connect_params['dbpass']);
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
$tables = quickquery("SHOW DATABASES");
$string = '';
foreach($tables as $table) {
	$table_name = $table['Database'];
	$string .= "<tr><td><a class='link' href='?dbname=".$table_name."'>".$table_name."</a></td></tr>";
}
?>
<table style="margin:auto; text-align:center;">
	<tr><th><h1>Available Databases</h1></th></tr>
	<?php echo $string; ?>
</table>
