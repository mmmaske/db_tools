<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style>
		body {
			color: #FFF;
			background-color: #000;
		}
		h1, h2, h3, h4, h5 {
			color: #666;
		}
		input {
			margin:5px;
		}
		* {
			-moz-user-select: -moz-none;
			-khtml-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		.selectable {
			-moz-user-select: -moz-all;
			-khtml-user-select: all;
			-webkit-user-select: all;
			-ms-user-select: all;
			user-select: all;
		}
	</style>
</head>
<?php
$populate['tables']		=	array();
$populate['count']		=	10; // default counting value

$output['debug']		=	false;
$output['echo']			=	true;
$output['autoquery']	=	false;

$connect_params	=	array(
	'dbhost'	=>	'localhost',
	'dbuser'	=>	'root',
	'dbpass'	=>	'',
	'dbname'	=>	'',
);
if(!empty($_GET['dbname'])) {
	$connect_params['dbname']	=	($_GET['dbname']);
	
	$db		=	new mysqli($connect_params['dbhost'],$connect_params['dbuser'],$connect_params['dbpass'],$connect_params['dbname']);
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

}
else {
	include("nodb.php");
}