<html>
	<?php require_once('config.php'); ?>
<body>
	<?php
		if(isset($_GET['dbname'])) {
			require_once('table_input.php'); echo "<hr/>";
			require_once('key_connect_input.php'); echo "<hr/>";
			require_once('db_display.php'); echo "<hr/>";
		}
	?>
</body>
</html>