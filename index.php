<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style>
		*.unselectable, input {
			-moz-user-select: -moz-none;
			-khtml-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		body {
			color: #FFF;
			background-color: #000;
		}
		input {
			margin:5px;
		}
		.link {
			color: #FF1111;
		}
	</style>
</head>
<body>
	<?php require_once('config.php'); ?>
	<?php
		if(isset($_GET['dbname'])) {
			require_once('table_input.php');
			require_once('key_connect_input.php'); 
		}
	?>
</body>
</html>