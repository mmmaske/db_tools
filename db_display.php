<?php
function quickquery($sql) {
	global $db;
	$result = $db->query($sql);
	if($db->query($sql)) {
		if($result->num_rows > 0) {
			$data = array();
			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			$result->free();
			return $data;
		}
		else{
			return false;
		}
	}
	else {
		return false;
	}
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'abs_test');

$db		=	new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
$table	=	quickquery("SHOW TABLES");
foreach($table as $t) {
	$tablename	=	$t['Tables_in_'.DB_NAME];
	$structure	=	quickquery("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='".$tablename."' AND TABLE_SCHEMA='".DB_NAME."'");
	$tbl		=	"<table border=1><tr><th colspan=99 id='{$tablename}' class='dialog'><a href='".BASE_URL."index.php/Mastertables/list/".$tablename."'>".$tablename."</a></th></tr>";
	$tbl		.=	"<tr><th>Column Name</th><th>Data Type</th></tr>";
	foreach($structure as $s) {
		$bgcolor	=	"#FFF";
		if($s['COLUMN_KEY']=="PRI") $bgcolor="#FF0";
		elseif($s['COLUMN_KEY']!="" && $s['COLUMN_KEY']!="PRI") $bgcolor="#AFA";
		$colname	=	$s['COLUMN_NAME'];
		$datatype	=	$s['DATA_TYPE'];
		$maxlength	=	$s['CHARACTER_MAXIMUM_LENGTH'];
		$tbl		.=	"<tr><td style='background-color:$bgcolor;'>{$colname}</td><td style='background-color:$bgcolor;'>{$datatype} ({$maxlength})</td><td style='background-color:$bgcolor;'>".$s['COLUMN_KEY']."</td></tr>";
	}
	$count		=	quickquery("SELECT COUNT(id) AS cnt FROM ".$tablename);
	$tbl		.=	"<tr><td colspan=99>".$count[0]['cnt']." rows in table</td></tr>";
	$tbl		.=	"</table>";
	echo "<div style='float:left; margin:10px;'>".$tbl."</div>";
}
?>